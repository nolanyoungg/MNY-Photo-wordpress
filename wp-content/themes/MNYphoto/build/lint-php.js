//******************************************************************************************************
// Filename: **\build\lint-php.js
// Author: Nolan Young
// Date: 9/16/2026
//
// Purpose: Check all first-party theme PHP syntax before review, packaging, and CI builds.
// INPUT: Theme files, style.css Requires PHP, PHP_BINARY/PATH/Local runtimes, --verbose or --help.
// PROCESSING: Discover files, enforce the minimum PHP version, run isolated bounded php -l processes.
// OUTPUT: Selected runtime, relative-path diagnostics, file totals, and exit status 0 (pass) or 1 (fail).
// ASSUMPTIONS: Node meets package.json engines; a stable PHP CLI or Local CGI binary is installed.
// Exception/Error HANDLING: Fail on invalid configuration, incomplete scans, process errors, or bad syntax.
// Summary of Functions: Metadata parsing, Local discovery, runtime probing, file collection, lint, CLI.
//******************************************************************************************************

'use strict';

const { spawnSync } = require('node:child_process');
const { existsSync, readFileSync, readdirSync } = require('node:fs');
const { homedir } = require('node:os');
const { join, relative, sep } = require('node:path');

const THEME_ROOT = join(__dirname, '..');
const EXCLUDED_DIRECTORIES = new Set(['node_modules', 'vendor', '.git']);
const PROCESS_TIMEOUT_MS = 30_000;
const PHP_OPTIONS = ['-n', '-d', 'display_errors=stderr', '-d', 'log_errors=0', '-d', 'html_errors=0'];

function runPhp(binary, args) {
  return spawnSync(binary, [...PHP_OPTIONS, ...args], {
    encoding: 'utf8', windowsHide: true, shell: false,
    timeout: PROCESS_TIMEOUT_MS, killSignal: 'SIGKILL', maxBuffer: 1024 * 1024,
    stdio: ['ignore', 'pipe', 'pipe'],
  });
}

function processFailure(result) {
  if (result.error) {
    if (result.error.code === 'ETIMEDOUT') return `timed out after ${PROCESS_TIMEOUT_MS / 1000}s`;
    return `${result.error.code || 'process error'}: ${result.error.message}`;
  }
  if (result.signal) return `terminated by ${result.signal}`;
  if (result.status !== 0) return `exited with status ${result.status}`;
  return null;
}

function readMinimumPhpVersion(root) {
  const header = readFileSync(join(root, 'style.css'), 'utf8').split('*/', 1)[0];
  const match = header.match(/^\s*Requires PHP:\s*(\d+\.\d+(?:\.\d+)?)\s*$/m);
  if (!match) throw new Error('style.css must declare a valid Requires PHP header (for example, 8.0).');
  return match[1];
}

function versionAtLeast(actual, minimum) {
  const left = actual.split('.').map(Number);
  const right = minimum.split('.').map(Number);
  for (let index = 0; index < 3; index += 1) {
    const difference = (left[index] || 0) - (right[index] || 0);
    if (difference !== 0) return difference > 0;
  }
  return true;
}

function probePhp(binary, minimum, execute = runPhp) {
  const result = execute(binary, ['--version']);
  const failure = processFailure(result);
  if (failure) throw new Error(failure);
  const match = result.stdout?.match(/^PHP (\d+\.\d+\.\d+) \((cli|cgi-fcgi)\)/m);
  if (!match) throw new Error('did not report a stable PHP CLI/CGI version');
  if (!versionAtLeast(match[1], minimum)) {
    throw new Error(`PHP ${match[1]} is below the theme minimum ${minimum}`);
  }
  return { binary, version: match[1], sapi: match[2] };
}

function getLocalServiceRoots(env = process.env, platform = process.platform, userHome = homedir()) {
  const roots = [];
  if (platform === 'win32') {
    if (env.APPDATA) roots.push(join(env.APPDATA, 'Local', 'lightning-services'));
    if (env.LOCALAPPDATA) {
      roots.push(join(env.LOCALAPPDATA, 'Programs', 'Local', 'resources', 'extraResources', 'lightning-services'));
    }
    for (const base of [env.ProgramFiles, env['ProgramFiles(x86)']]) {
      if (base) roots.push(join(base, 'Local', 'resources', 'extraResources', 'lightning-services'));
    }
  } else if (platform === 'darwin') {
    roots.push(join(userHome, 'Library', 'Application Support', 'Local', 'lightning-services'));
    roots.push('/Applications/Local.app/Contents/Resources/extraResources/lightning-services');
  } else {
    roots.push(join(env.XDG_CONFIG_HOME || join(userHome, '.config'), 'Local', 'lightning-services'));
    roots.push('/opt/Local/resources/extraResources/lightning-services');
  }
  return [...new Set(roots)];
}

function getLocalPhpCandidates(roots, platform = process.platform, arch = process.arch) {
  const candidates = [];
  for (const root of roots) {
    let entries;
    try {
      entries = readdirSync(root, { withFileTypes: true });
    } catch (error) {
      if (error.code === 'ENOENT') continue;
      throw new Error(`Cannot inspect Local runtime directory ${root}: ${error.message}`, { cause: error });
    }
    const services = entries.filter((entry) => entry.isDirectory() && /^php-\d/.test(entry.name))
      .map((entry) => entry.name)
      .sort((a, b) => b.localeCompare(a, 'en', { numeric: true }));
    for (const service of services) {
      const bin = join(root, service, 'bin');
      if (platform === 'win32') {
        for (const architecture of arch === 'ia32' ? ['win32', 'win64'] : ['win64', 'win32']) {
          candidates.push(join(bin, architecture, 'php.exe'), join(bin, architecture, 'php-cgi.exe'));
        }
      } else {
        candidates.push(join(bin, platform === 'darwin' ? 'darwin' : 'linux', 'bin', 'php'));
      }
    }
  }
  return [...new Set(candidates)].filter((candidate) => existsSync(candidate));
}

function resolvePhpBinary(minimum, {
  env = process.env, execute = runPhp, localRoots = getLocalServiceRoots(env), discover = getLocalPhpCandidates,
} = {}) {
  if (env.PHP_BINARY !== undefined) {
    const binary = env.PHP_BINARY.trim();
    if (!binary) throw new Error('PHP_BINARY is empty. Set an executable path or remove the variable.');
    try {
      return { ...probePhp(binary, minimum, execute), source: 'PHP_BINARY' };
    } catch (error) {
      throw new Error(`Invalid PHP_BINARY (${binary}): ${error.message}. Use an executable path without embedded quotes or arguments.`,
        { cause: error });
    }
  }
  const failures = [];
  function tryCandidate(binary, source) {
    try {
      return { ...probePhp(binary, minimum, execute), source };
    } catch (error) {
      failures.push(`  ${binary}: ${error.message}`);
      return null;
    }
  }
  const pathRuntime = tryCandidate('php', 'PATH');
  if (pathRuntime) return pathRuntime;
  for (const candidate of discover(localRoots)) {
    const runtime = tryCandidate(candidate, 'Local');
    if (runtime) return runtime;
  }
  throw new Error(`No usable PHP ${minimum}+ runtime found. Set PHP_BINARY to the executable path.\n` +
    `${failures.join('\n')}\nSearched Local roots:\n${localRoots.map((root) => `  ${root}`).join('\n')}`);
}

function collectPhpFiles(root) {
  const files = [];
  function visit(directory) {
    let entries;
    try {
      entries = readdirSync(directory, { withFileTypes: true });
    } catch (error) {
      throw new Error(`Cannot scan theme directory ${directory}: ${error.message}`, { cause: error });
    }
    for (const entry of entries) {
      if (EXCLUDED_DIRECTORIES.has(entry.name) && (entry.isDirectory() || entry.isSymbolicLink())) continue;
      const path = join(directory, entry.name);
      if (entry.isSymbolicLink()) {
        throw new Error(`Cannot guarantee PHP coverage through a symbolic link: ${path}. Use regular theme files.`);
      }
      if (entry.isDirectory()) visit(path);
      else if (entry.isFile() && /\.php$/i.test(entry.name)) files.push(path);
    }
  }
  visit(root);
  if (files.length === 0) throw new Error(`No PHP files found in ${root}; refusing an empty lint pass.`);
  return files.sort();
}

function lintFiles(runtime, files, { root = THEME_ROOT, verbose = false, execute = runPhp, logger = console } = {}) {
  let failed = 0;
  for (const file of files) {
    const label = relative(root, file).split(sep).join('/');
    const result = execute(runtime.binary, ['-l', file]);
    const failure = processFailure(result);
    if (result.error || result.signal || result.status === null) {
      throw new Error(`PHP process failed while checking ${label}: ${failure}`);
    }
    const output = [result.stdout, result.stderr].filter(Boolean).join('\n').trim();
    if (failure || !result.stdout?.includes('No syntax errors detected in ')) {
      failed += 1;
      logger.error(`FAIL ${label}: ${failure || 'missing PHP lint success response'}\n${output}`);
    } else {
      if (verbose) logger.log(`PASS ${label}`);
      // Preserve parser warnings/deprecations even when PHP returns success.
      const diagnostics = output.split(/\r?\n/).filter((line) => line && !line.startsWith('No syntax errors detected in '));
      if (diagnostics.length) logger.warn(`${label}:\n${diagnostics.join('\n')}`);
    }
  }
  logger.log(`PHP syntax: ${files.length - failed} passed, ${failed} failed, ${files.length} total.`);
  return failed === 0 ? 0 : 1;
}

function main(args = process.argv.slice(2), { root = THEME_ROOT, logger = console } = {}) {
  try {
    for (const arg of args) {
      if (!['--verbose', '--help'].includes(arg)) throw new Error(`Unknown argument: ${arg}. Use --help.`);
    }
    if (args.includes('--help')) {
      logger.log('Usage: npm run lint:php -- [--verbose | --help]\n' +
        'Checks all theme PHP except node_modules, vendor, and .git.\n' +
        'Runtime order: PHP_BINARY (explicit), PATH, standard Local installations.\n' +
        'Syntax only; does not execute theme code or prove compatibility with older PHP versions.');
      return 0;
    }
    const minimum = readMinimumPhpVersion(root);
    const files = collectPhpFiles(root);
    const runtime = resolvePhpBinary(minimum);
    logger.log(`Using PHP ${runtime.version} (${runtime.sapi}, ${runtime.source}): ${runtime.binary}`);
    logger.log(`Theme requires PHP ${minimum}+. Checking ${files.length} files with this runtime; php.ini is disabled.`);
    return lintFiles(runtime, files, { root, verbose: args.includes('--verbose'), logger });
  } catch (error) {
    logger.error(`PHP lint failed: ${error.message}`);
    return 1;
  }
}

if (require.main === module) process.exitCode = main();

module.exports = { collectPhpFiles, getLocalPhpCandidates, getLocalServiceRoots, lintFiles, main,
  probePhp, readMinimumPhpVersion, resolvePhpBinary, runPhp };

//******************************************************************************************************
// Filename: build/eslint.config.js
// Author: Nolan Young
// Date: 9/27/2026
// Purpose: Configure standard ESLint checks for authored browser and Node JavaScript.
// INPUT: Theme JavaScript under src/js, build tooling, and this configuration file.
// PROCESSING: Apply ESLint recommended rules with environment-specific globals and module modes.
// OUTPUT: Lint diagnostics and a non-zero exit status when an enabled rule fails.
// ASSUMPTIONS: Generated bundles and installed dependencies are not authored lint targets.
// Exception/Error HANDLING: ESLint reports configuration, parsing, and rule failures.
// Summary of Functions: Exports the theme's flat ESLint configuration.
//******************************************************************************************************

'use strict';

const js = require('@eslint/js');
const globals = require('globals');
const { defineConfig, globalIgnores } = require('eslint/config');

module.exports = defineConfig([
  globalIgnores([
    'dist/**',
    'node_modules/**',
  ]),
  {
    ...js.configs.recommended,
    files: ['**/*.js'],
  },
  {
    files: ['src/js/**/*.js'],
    languageOptions: {
      ecmaVersion: 'latest',
      sourceType: 'module',
      globals: globals.browser,
    },
  },
  {
    files: ['build/**/*.js'],
    languageOptions: {
      ecmaVersion: 'latest',
      sourceType: 'commonjs',
      globals: globals.node,
    },
  },
]);

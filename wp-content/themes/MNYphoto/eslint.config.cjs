module.exports = [
  {
    files: [ 'src/js/**/*.js' ],
    languageOptions: { ecmaVersion: 2022, sourceType: 'module' },
    rules: { semi: [ 'error', 'always' ], 'no-unused-vars': 'error' }
  }
];

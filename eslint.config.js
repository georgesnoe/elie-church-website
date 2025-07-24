import js from '@eslint/js';
import tseslint from 'typescript-eslint';

export default [
  js.config({
    env: {
      browser: true,
      es2021: true,
    },
    extends: [
      'eslint:recommended',
    ],
    settings: {
      'eslint.codeActionsOnSave.mode': 'all',
      'eslint.debug': true,
    },
  }),
  ...tseslint.config({
    files: ['src/**/*.ts', 'src/**/*.tsx'],
    extends: [
      'plugin:@typescript-eslint/recommended',
    ],
    parserOptions: {
      ecmaVersion: 'latest',
      sourceType: 'module',
    },
  }),
];

import scriptPlugin from '@script-development/eslint-config-vue';
import globals from 'globals';

/** @type {import('eslint').Linter.Config[]} */
export default [{files: ['**/*.{js,mjs,cjs,ts,vue}']}, {languageOptions: {globals: globals.browser}}, ...scriptPlugin];

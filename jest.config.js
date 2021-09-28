module.exports = {
  testRegex: 'resources/js/tests/.*.spec.js$',
  moduleFileExtensions: ['js', 'json', 'vue'],
  transform: {
    // process `*.vue` files with `vue-jest`
    '.*\\.(vue)$': '<rootDir>/node_modules/@vue/vue3-jest',
    '^.+\\.js$': '<rootDir>/node_modules/babel-jest',
  },
  // transformIgnorePatterns: ["/node_modules/(?!vue-awesome)"],
  collectCoverage: true,
  collectCoverageFrom: ['<rootDir>/resources/js/**/*.{js,vue}', '!**/node_modules/**', '!**/resources/js/tests/**', '!**/resources/js/*.{js,vue}'],
  testEnvironment: 'jsdom',
  // setupFiles: [
  //   '<rootDir>/resources/js/tests/test.config.js',
  // ],
};

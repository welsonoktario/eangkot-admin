module.exports = {
  env: {
    node: true,
  },
  extends: [
    "eslint:recommended",
    "plugin:vue/vue3-recommended",
    "prettier",
    "./.eslintrc-auto-import.json",
  ],
  rules: {
    "vue/no-unused-vars": 1,
    "vue/multi-word-component-names": 0,
    "vue/no-reserved-component-names": 1,
    semi: [1, "never"],
    "no-unused-vars": 1,
    "no-undef": 1,
  },
}

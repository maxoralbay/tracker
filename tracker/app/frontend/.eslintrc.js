module.exports = {
    root: false,
    env: {
        node: true,
    },
    extends: [
        "plugin:vue/vue-essential",
        "eslint:recommended",
        "@vue/prettier"
    ],
    parserOptions: {
        parser: "babel-eslint",
    },
    rules: {},
}
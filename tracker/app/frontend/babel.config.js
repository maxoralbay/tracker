module.exports = {
  presets: ["@vue/cli-plugin-babel/preset"],
  // display axios error messages in the console
    plugins: [
        [
        "transform-remove-console",
        {
            exclude: ["error", "warn"],
        },
        ],
    ],
};

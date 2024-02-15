const path = require("path");

module.exports = {
  mode: "development",
  entry: "./front/js/custom.js",
  output: {
    filename: "custom.js",
    path: path.resolve(__dirname, "assets/js"),
    clean: true,
  },
  devtool: "inline-source-map",
  module: {},
};

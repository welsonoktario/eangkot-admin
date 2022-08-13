const path = require("path")

module.exports = {
  resolve: {
    alias: {
      "@": path.resolve("resources/js"),
      "@layouts": path.resolve("resources/js/Layouts"),
      "@components": path.resolve("resources/js/Components"),
      "@pages": path.resolve("resources/js/Pages"),
    },
    extensions: [".ts", ".vue"],
  },
  output: {
    chunkFilename: "js/[name].js?id=[chunkhash]",
  },
}

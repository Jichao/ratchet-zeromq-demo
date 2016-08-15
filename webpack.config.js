module.exports = {
  entry: "./app.js",
  output: {
    path: __dirname,
    filename: "bundle.js"
  },
  module: {
    loaders: [
      { test: /\.json$/, loader: 'json', },
      { test: /\.md$/, loader: "html!markdown" },
    ]
  },
  devtool: "source-map"
}

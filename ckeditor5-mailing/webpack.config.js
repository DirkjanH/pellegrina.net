const path = require("path")
const { styles } = require("@ckeditor/ckeditor5-dev-utils")

module.exports = {
	context: __dirname,
	mode: "production",
	entry: "./src/mailing-editor.js",
	output: {
		path: path.resolve(__dirname, "../mailing"),
		filename: "mailing-editor.js",
		library: "MailingEditor",
		libraryExport: "default",
		libraryTarget: "window",
	},
	module: {
		rules: [
			{
				test: /\.svg$/,
				use: ["raw-loader"],
			},
			{
				test: /\.css$/,
				use: [
					"style-loader",
					"css-loader",
					{
						loader: "postcss-loader",
						options: {
							postcssOptions: styles.getPostCssConfig({
								themeImporter: {
									themePath:
										require.resolve("@ckeditor/ckeditor5-theme-lark/theme/theme.css"),
								},
								minify: true,
							}),
						},
					},
				],
			},
		],
	},
	optimization: {
		minimizer: [],
	},
	resolve: {
		extensions: [".js"],
	},
}

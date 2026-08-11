const path = require( 'node:path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );

module.exports = {
	entry: './src/js/main.js',
	output: { filename: 'bundle.js', path: path.resolve( __dirname, '../dist/js' ), clean: true },
	module: { rules: [ { test: /\.scss$/, use: [ MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader' ] } ] },
	plugins: [ new MiniCssExtractPlugin( { filename: path.resolve( __dirname, '../dist/css/bundle.css' ) } ) ],
};

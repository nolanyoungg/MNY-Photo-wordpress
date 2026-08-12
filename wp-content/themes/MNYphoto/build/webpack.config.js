const path = require( 'node:path' );
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' );

module.exports = ( _env, argv = {} ) => {
	const mode = argv.mode || 'production';
	const isProduction = mode === 'production';

	return {
		mode,
		entry: path.resolve( __dirname, '../src/js/main.js' ),
		output: {
			filename: 'js/bundle.js',
			path: path.resolve( __dirname, '../dist' ),
			clean: {
				keep: /(?:^|[\\/])(images|icons)(?:[\\/]|$)/,
			},
		},
		module: {
			rules: [
				{
					test: /\.s[ac]ss$/i,
					use: [
						MiniCssExtractPlugin.loader,
						{
							loader: 'css-loader',
							options: { sourceMap: ! isProduction },
						},
						{
							loader: 'sass-loader',
							options: {
								implementation: require( 'sass' ),
								sassOptions: {
									style: isProduction ? 'compressed' : 'expanded',
								},
								sourceMap: ! isProduction,
							},
						},
					],
				},
			],
		},
		plugins: [
			new MiniCssExtractPlugin( { filename: 'css/bundle.css' } ),
		],
		optimization: {
			minimize: isProduction,
		},
		devtool: isProduction ? false : 'source-map',
	};
};

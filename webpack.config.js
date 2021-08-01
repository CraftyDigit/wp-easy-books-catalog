const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = (env, argv) => {

    const isProd = argv.mode === 'production';
    const isDev = !isProd;

    const filename = (ext) => `${ext}/[name].${ext}`;

    return {
        context: path.resolve(__dirname, 'src'),
        entry: {
            frontend: './front/front-index.js',
            admin: './admin/admin-index.js'
        },
        output: {
            path: path.resolve( __dirname, 'assets' ),
            filename: filename('js'),
            clean: true
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: filename('css')
            })
        ],
        devtool: isDev ? 'source-map' : false,
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    loader: 'babel-loader'
                },
                {
                    test: /\.s[ac]ss$/i,
                    use: [
                        MiniCssExtractPlugin.loader,
                        "css-loader",
                        "sass-loader",
                    ],
                }
            ],
        },
    }
}
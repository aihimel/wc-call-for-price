/**
 * WordPress Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );
const MiniCssExtractPlugin = require('mini-css-extract-plugin');

let admin_dashboard_script = {
    ...defaultConfig,
    ...{
        entry: {
            admin: './src/js/admin-dashboard-app-script.js',
        },
        output: {
            filename: 'admin-dashboard-app-script.js',
            path: __dirname + '/assets/js/admin',
        }
    }
}

let admin_dashboard_style = {
        entry: './src/scss/admin/admin-dashboard-app-style.scss',
        output: {
            path: __dirname + '/assets/css/admin/',
        },
        module: {
            rules: [
                {
                    test: /\.scss$/, // Match .scss files
                    use: [
                        MiniCssExtractPlugin.loader, // Extract CSS into separate files
                        'css-loader',                // Translate CSS into CommonJS
                        'sass-loader',               // Compile Sass to CSS
                    ],
                },
            ],
        },
        plugins: [
            new MiniCssExtractPlugin({
                filename: 'admin-dashboard-style.css', // Output CSS filename
            }),
        ],

}

module.exports = [ admin_dashboard_script, admin_dashboard_style ];

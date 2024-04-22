/**
 * WordPress Dependencies
 */
const defaultConfig = require( '@wordpress/scripts/config/webpack.config.js' );

module.exports = {
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

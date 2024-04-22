<?php
/**
 * Loading Admin assets and frontend assets
 *
 * @since 1.2.1
 */

namespace WCPress\WCP;

class Assets {

	/**
	 * Admin react app script handle
	 *
	 * @since WCP_SINCE
	 */
	const ADMIN_REACT_APP = 'wcp-admin-react-app-script';

    /**
     * Initializes the object
     *
     * @since 1.4.0
     */
    function __construct() {
        // Admin Assets
        add_action( 'admin_enqueue_scripts', [ $this, 'admin_asset' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'admin_enqueue_asset' ] );
    }

    /**
     * Hooks admin assets
     *
     * @since 1.4.0
     *
     * @return void
     */
    function admin_asset() {
        wp_register_style(
            'wcp-admin-style',
            plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/css/wcp-admin-style.css',
	        [ 'dashicons' ]
        );
        wp_register_script(
            'wcp-admin-script',
            plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/js/wcp-admin-script.js',
            [ 'jquery' ]
        );
		wp_register_script(
            'wcp-plugin-review-script',
            plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/js/plugin-list-page-review.js',
            [ 'jquery' ]
        );
		wp_register_script(
			Assets::ADMIN_REACT_APP,
			plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/js/admin-dashboard-app-script.js',
			[ 'wp-element', 'wp-api-fetch', 'wp-component' ]
		);
    }

	/**
	 * Loads review script on plugins.php page
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	public function admin_enqueue_asset() {
		global $pagenow;
		if( 'plugins.php' === $pagenow ) {
			wp_enqueue_script( 'wcp-plugin-review-script' );
		}

		// specific plugin page detection
		if ( wcp_is_settings_page() ) {
			wp_enqueue_script( Assets::ADMIN_REACT_APP );
			$react_asset_files = include WC_CALL_FOR_PRICE_PLUGIN_ROOT_PATH . '/assets/js/admin-dashboard-app-script.asset.php';
			foreach( $react_asset_files['dependencies'] as $dependency ) {
				wp_enqueue_script( $dependency );
			}
		}

	}

}
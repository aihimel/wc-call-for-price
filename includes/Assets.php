<?php
/**
 * Loading Admin assets and frontend assets
 *
 * @since 1.2.1
 */

namespace WCPress\WCP;

class Assets {

    /**
     * Initializes the object
     *
     * @since 1.4.0
     */
    public function __construct() {
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
    public function admin_asset() {
        wp_register_style(
            'wcp-admin-style',
            plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/css/wcp-admin-style.css',
	        [ 'dashicons' ],
			WC_CALL_FOR_PRICE_VERSION
        );
        // Select2 CDN Style Start
        wp_register_style(
            'wcp-select2-style',
            plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/css/select2.min.css',
	        [ 'dashicons' ],
			'4.1.0'
        );
        // Select2 CDN Style End
        wp_register_script(
            'wcp-admin-script',
            plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/js/wcp-admin-script.js',
            [ 'jquery' ],
			WC_CALL_FOR_PRICE_VERSION,
			true
        );
		wp_register_script(
            'wcp-plugin-review-script',
            plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/js/plugin-list-page-review.js',
            [ 'jquery' ],
			WC_CALL_FOR_PRICE_VERSION,
			true
        );
        // Select2 CDN Script Start
		wp_register_script(
            'wcp-select2-script',
            plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/js/select2.min.js',
            [ 'jquery' ],
			'4.1.0',
			true
        );
        // Select2 CDN Script End
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
		if ( 'plugins.php' === $pagenow ) {
			wp_enqueue_script( 'wcp-plugin-review-script' );
		}
	}
}

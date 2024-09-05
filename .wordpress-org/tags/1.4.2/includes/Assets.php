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
    function __construct() {

        // Admin Assets
        add_action( 'admin_enqueue_scripts', [ $this, 'admin_asset' ] );

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
            plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/css/wcp-admin-style.css'
        );
        wp_register_script(
            'wcp-admin-script',
            plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/js/wcp-admin-script.js',
            [ 'jquery' ]
        );
    }

}
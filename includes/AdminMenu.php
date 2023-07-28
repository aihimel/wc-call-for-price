<?php
/**
 * Manages admin menus
 *
 * @since 1.2.1
 */

namespace WCPress\WCP;

class AdminMenu {

    function __construct() {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
    }

    function admin_menu() {
        add_submenu_page(
            'woocommerce',
            __('WooCommerce Call For Price', 'wc-call-for-price' ),
            __('Call For Price', 'wc-call-for-price' )
            , 'manage_options',
            'wc-call-for-price',
            [ $this, 'render_admin_menu' ]
        );
    }

    function render_admin_menu() {
        if( ! current_user_can('manage_options') ) {
            wp_die( __('You don\'t have permission to access this page', 'wc-call-for-price' ) );
        } else {
            require_once(  WC_CALL_FOR_PRICE_TEMPLATE_PATH . 'templates/admin/layout.php' );
        }
    }

}
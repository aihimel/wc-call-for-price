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
        add_filter( 'plugin_action_links_wc-call-for-price/wc-call-for-price.php', [ $this, 'add_plugin_page_extra_links' ] );
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
            wcp_get_admin_template( 'layout.php' );
        }
    }

    function add_plugin_page_extra_links( $links ) {
        $url = wcp_slug_to_admin_menu_url();
        $links[] = "<a href='$url'>" . __( 'Settings', 'wc-call-for-price' ) . '</a>';
        return $links;
    }

}
<?php
/**
 * Manages admin menus
 *
 * @since 1.2.1
 */

namespace WCPress\WCP;

class AdminMenu {

    /**
     * Initializes the object
     *
     * @since 1.4.0
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
        add_filter( 'plugin_action_links_wc-call-for-price/wc-call-for-price.php', [ $this, 'add_plugin_page_extra_links' ] );
    }

    /**
     * Hooks admin menu
     *
     * @since 1.4.0
     *
     * @return void
     */
    public function admin_menu() {
        add_submenu_page(
            'woocommerce',
            __('WooCommerce Call For Price', 'wc-call-for-price' ),
            __('Call For Price', 'wc-call-for-price' )
            , 'manage_options',
            'wc-call-for-price',
            [ $this, 'render_admin_menu' ]
        );
    }

    /**
     * Renders admin menu
     *
     * @since 1.4.0
     *
     * @return void
     */
    public function render_admin_menu() {
        if ( ! current_user_can('manage_options') ) {
            wp_die( esc_attr__('You don\'t have permission to access this page', 'wc-call-for-price' ) );
        } else {
            wcp_get_admin_template( 'layout.php' );
        }
    }

    /**
     * Adds extra settings link on plugin link page
     *
     * @since 1.4.0
     *
     * @param array $links
     *
     * @return array
     */
    public function add_plugin_page_extra_links( array $links ): array {
        $url = wcp_slug_to_admin_menu_url();
        $links[] = "<a href='$url'>" . __( 'Settings', 'wc-call-for-price' ) . '</a>';
        return $links;
    }
}

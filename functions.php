<?php
/**
 * Useful functions to use throughout the plugin
 *
 * @since 1.3.1
 */

use WCPress\WCP\Constants;

/**
 * Gets admin template from plugins templates directory
 *
 * @since 1.3.1
 *
 * @param $relative_path
 *
 * @return void
 */
function wcp_get_admin_template( $relative_path ) {
    $full_path = WC_CALL_FOR_PRICE_TEMPLATE_PATH . 'templates/admin/' . $relative_path;
    $template_path = apply_filters( 'wcp_get_admin_template_path_before_render', $full_path );
    if ( file_exists( $template_path ) ) {
       require_once( $template_path );
    } elseif ( WP_DEBUG || WP_DEBUG_LOG ) {
        error_log( "WC Call For Price: Template file not found: {$template_path}" );
    }
}


/**
 * Generates admin submenu pages url
 *
 * @since 1.3.1
 *
 * @param $slug
 *
 * @return mixed|null
 */
function wcp_slug_to_admin_menu_url( $slug = Constants::WCP_SUB_PAGE_GENERAL_SETTINGS ) {
    $admin_main_url = add_query_arg(
        'page',
        'wc-call-for-price',
        get_admin_url() . 'admin.php'
    );

    $admin_sub_url = esc_url(
        add_query_arg(
        Constants::WCP_SUB_PAGE_QUERY_STRING,
            $slug,
            $admin_main_url
        )
    );

    return apply_filters( 'wcp_slug_to_admin_menu_url', $admin_sub_url );
}
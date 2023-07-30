<?php
/**
 * Useful functions to use throughout the plugin
 *
 * @since 1.3.1
 */

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
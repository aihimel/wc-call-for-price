<?php
/**
 * Useful functions to use throughout the plugin
 *
 * @since 1.4.0
 */

use WCPress\WCP\Constants;

/**
 * Gets admin template from plugins templates directory
 *
 * @since 1.4.0
 *
 * @param string $relative_path
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
 * @since 1.4.0
 *
 * @param string $slug
 *
 * @return string
 */
function wcp_slug_to_admin_menu_url( $slug = Constants::WCP_SUB_PAGE_GENERAL_SETTINGS ): string {
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

/**
 * Return admin menu sub page slug
 *
 * @since 1.4.0
 *
 * @return string
 */
function wcp_get_admin_sub_page_slug(): string {
    return isset( $_GET[ Constants::WCP_SUB_PAGE_QUERY_STRING ] )
    ? sanitize_text_field( $_GET[ Constants::WCP_SUB_PAGE_QUERY_STRING ] )
    : Constants::WCP_SUB_PAGE_GENERAL_SETTINGS;
}

/**
 * Return if a checkbox is on
 *
 * @since 1.4.0
 *
 * @param $option_name
 *
 * @return bool
 */
function wcp_is_on( $option_name ): bool {
    return get_option( $option_name, Constants::OFF ) == Constants::ON;
}

/**
 * Checks if the option is not empty
 *
 * @since 1.4.0
 * @param $option_name
 * @return bool
 */
function wcp_not_empty( $option_name ): bool {
    return ! empty( get_option( $option_name ) );
}

/**
 * @param $option_name
 * @param $compare_to
 * @param $echo
 *
 * @return bool
 */
function wcp_is_checked( $option_name, $compare_to = Constants::ON, $echo = true ): bool {
	$value = get_option( $option_name, Constants::OFF );
	$result = $value === $compare_to;
	if ( $result ) {
		if ( $echo ) {
			echo 'checked';
		}
		return true;
	}
	return false;
}

/**
 * Returns a unified time type across the plugin
 *
 * @since 1.4.3
 *
 * @return int
 */
function wcp_current_time(): int {
	return (new \DateTime())->getTimestamp();
}

/**
 * Checks if in WCP Settings page
 *
 * @since 1.4.3
 *
 * @return bool
 */
function wcp_is_settings_page(): bool {
	$pagename = '';

	if ( is_admin() && isset( $_GET['page'] ) ) {
		$pagename = sanitize_text_field( $_GET['page'] );
	}

	if ( 'wc-call-for-price' === $pagename ) {
		return true;
	}

	return false;
}

/**
 * Generates review action URL
 *
 * @since 1.5.1
 *
 * @param string $action
 *
 * @return string
 */
function wcp_review_action_url( string $action ): string {
	return admin_url( "admin.php?page=wc-call-for-price&action=$action" );
}

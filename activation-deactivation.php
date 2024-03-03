<?php
/**
 * Manages activation and deactivation
 *
 * @since 1.2.1
 */

use WCPress\WCP\Constants;

/**
 * Adding default option value on plugin activate
 *
 * @since 1.0.0
 *
 * @return void
 */
function wc_call_for_price__activate(){
	// Creating Options
	$prefix = 'wc_call_for_price__'; // Prefix for every options
    add_option( Constants::WCP_ACTIVATE, Constants::OFF );
	add_option( $prefix.'text', 'Call For Price' );
	add_option( $prefix.'show_image', 'off' );
	add_option( $prefix.'image', 'cfp_1' );
	add_option( $prefix.'show_uploaded_image' );
	add_option( $prefix.'upload_image' );
    add_option( Constants::ONLY_EMPTY_PRICE, Constants::OFF);
    add_option( Constants::SHOW_ON_ALL_PRODUCTS, Constants::OFF);

	// Activation Deactivation Time
	if ( ! get_option( Constants::FIRST_ACTIVATED_AT ) ) {
		add_option( Constants::FIRST_ACTIVATED_AT, wcp_current_time() );
	}
	update_option( Constants::MOST_RECENT_ACTIVATED_AT, wcp_current_time() );
}

/**
 * Removes options on deactivation
 *
 * @since 1.0.0
 *
 * @return void
 */
function wc_call_for_price__deactivate(){
	// Removing Options
	$prefix = 'wc_call_for_price__';
    delete_option( Constants::WCP_ACTIVATE );
	delete_option($prefix.'text');
	delete_option($prefix.'show_image');
	delete_option($prefix.'image');
	delete_option($prefix.'show_uploaded_image');
	delete_option($prefix.'upload_image');
    delete_option( Constants::ONLY_EMPTY_PRICE );
    delete_option( Constants::SHOW_ON_ALL_PRODUCTS );
}
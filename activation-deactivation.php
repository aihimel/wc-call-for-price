<?php
/**
 * Manages activation and deactivation
 *
 * @since 1.2.1
 */

use WCPress\WCP\{
	Constants,
	Initilize
};

/**
 * Adding default option value on plugin activate
 *
 * @since 1.0.0
 *
 * @return void
 */
function wc_call_for_price__activate(){
	// @TODO relocate the initial option update to WCPress\WCP\Initilize class
	// Creating Options
	$prefix = 'wc_call_for_price__'; // Prefix for every options
    add_option( $prefix.'text', 'Call For Price' );
	add_option( $prefix.'show_image', 'off' );
	add_option( $prefix.'image', 'cfp_1' );
	add_option( $prefix.'show_uploaded_image' );
	add_option( $prefix.'upload_image' );
    add_option( Constants::ONLY_EMPTY_PRICE, Constants::OFF);
    add_option( Constants::SHOW_ON_ALL_PRODUCTS, Constants::OFF);

	$initilize = Initilize::init();
	$initilize->add_activation_time();
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
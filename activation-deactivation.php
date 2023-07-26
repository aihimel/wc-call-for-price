<?php
/**
 * Manages activation and deactivation
 *
 * @since 1.2.1
 */

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
	add_option( $prefix.'text', 'Call For Price' );
	add_option( $prefix.'show_image', 'off' );
	add_option( $prefix.'image', 'cfp_1' );
	add_option( $prefix.'show_uploaded_image' );
	add_option( $prefix.'upload_image' );
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
	delete_option($prefix.'text');
	delete_option($prefix.'show_image');
	delete_option($prefix.'image');
	delete_option($prefix.'show_uploaded_image');
	delete_option($prefix.'upload_image');
}
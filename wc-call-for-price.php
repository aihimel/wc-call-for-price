<?php
/**
 * Plugin Name: WC Call For Price
 * Plugin URI: http://www.wordpress.org/wc-call-for-price
 * Version: 1.2.1
 * Author: Aftabul Islam
 * Author URI: https://profiles.wordpress.org/aihimel
 * Author Email: toaihimel@gmail.com
 * PHP version: 7.2
 * Text domain: wc-call-for-price
 * Description: This plugin shows "call for price" text/HTML or image on empty price fields. It depends on woocommerce.
 * License: GPLv3 or later

Copyright 2015  Aftabul Islam  (email : toaihimel@gmail.com)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// Security Check
defined('ABSPATH') || die();

// Constants
defined( 'WC_CALL_FOR_PRICE_VERSION' ) || define('WC_CALL_FOR_PRICE_VERSION', '1.2.0');
defined('WC_CALL_FOR_PRICE_PATH') || define('WC_CALL_FOR_PRICE_PATH', plugin_basename(__FILE__));
defined( 'WC_CALL_FOR_PRICE_ACTIVATION_DEACTIVATION_FILE' ) || define( 'WC_CALL_FOR_PRICE_ACTIVATION_DEACTIVATION_FILE', __DIR__ . '/activation-deactivation.php' );

// Activation Deactivation
register_activation_hook(WC_CALL_FOR_PRICE_ACTIVATION_DEACTIVATION_FILE, 'wc_call_for_price__activate');
register_deactivation_hook(WC_CALL_FOR_PRICE_ACTIVATION_DEACTIVATION_FILE, 'wc_call_for_price__deactivate');

/**
 * Loading function assets [css and js]
 *
 * @since 1.0.0
 *
 * @return void
 */
function wc_call_for_price__frontend_assets(){
    wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'wc_call_for_price__frontend_assets');


/**
 * Rendering text/html/image on empty price
 *
 * @since 1.0.0
 *
 * @param $price
 *
 * @return false|mixed|string|null
 */
function wc_call_for_price__call_for_price( $price ){
	$prefix = 'wc_call_for_price__';

	if(get_option($prefix.'show_uploaded_image') == 'on') return '<img src="'.get_option($prefix.'upload_image').'" />';

	if(get_option($prefix.'show_image') == 'on') return '<img src="'.plugins_url('/wc-call-for-price/images/'.get_option($prefix.'image')).'.png" />';
		else {
			$temp = get_option($prefix.'text');
			if(!empty($temp)) return get_option($prefix.'text');
				else return 'Call For Price';
		}
}
add_filter('woocommerce_empty_price_html', 'wc_call_for_price__call_for_price', 11);




/*--------------------------------------------- ADMIN OPTIONS -----------------------------------------------------*/

/**
 * Loading admin assets
 *
 * @since 1.0.0
 *
 * @return void
 */
function wc_call_for_price__admin_assets(){
    wp_register_style(
        'wcp-admin-style',
        plugin_dir_url( __FILE__ ) . 'assets/css/wcp-admin-style.css'
    );
    wp_register_script(
        'wcp-admin-script',
        plugin_dir_url( __FILE__ ) . 'assets/js/wcp-admin-script.js',
        [ 'jquery' ]
    );
	wp_enqueue_media();
	wp_enqueue_script('jquery');
}
add_action('admin_enqueue_scripts', 'wc_call_for_price__admin_assets');

/**
 * Shows WooCommerce > Call for price menu on admin dashboard
 *
 * @since 1.0.0
 *
 * @return void
 */
function wc_call_for_price__menu(){
	add_submenu_page(
		'woocommerce',
		__('WooCommerce Call For Price', 'wc-call-for-price' ),
		__('Call For Price', 'wc-call-for-price' )
		, 'manage_options',
		'wc-call-for-price',
		'wc_call_for_price__menu_options'
	);

}
add_action('admin_menu', 'wc_call_for_price__menu');

/**
 * Loading menu file
 *
 * @since 1.0.0
 *
 * @return void
 */
function wc_call_for_price__menu_options(){

	if( ! current_user_can('manage_options') ) {
		wp_die(__('You don\'t have permission to access this page', 'wc-call-for-price'));
	} else {
		require_once('wp_call_for_price__manage_options_form.php');
	}

}

<?php
/**
 * Plugin Name: WC Call For Price
 * Plugin URI: http://www.wordpress.org/wc-call-for-price
 * Version: 1.5.1
 * Author: WCPress
 * Author URI: https://wcpress.net/wc-call-for-price-woocommerce-plugin
 * Author Email: toaihimel@gmail.com
 * Requires at least: 5.8
 * Requires PHP: 7.2
 * Requires Plugins: woocommerce
 * Text domain: wc-call-for-price
 * Domain Path: /languages
 * Description: This plugin shows "call for price" text/HTML or image on empty price fields. It depends on woocommerce.
 * License: GPLv3 or later
 * WC requires at least: 6.6
 * WC tested up to: 9.0

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

use WCPress\WCP\WCCallForPrice;

// Security Check
defined('ABSPATH') || die();

require_once 'vendor/autoload.php' ;
require_once 'functions.php' ;

// Constants
defined( 'WC_CALL_FOR_PRICE_ROOT_FILE' ) || define( 'WC_CALL_FOR_PRICE_ROOT_FILE', __FILE__ );
defined( 'WC_CALL_FOR_PRICE_VERSION' ) || define( 'WC_CALL_FOR_PRICE_VERSION', '1.5.0' );
defined('WC_CALL_FOR_PRICE_PATH') || define('WC_CALL_FOR_PRICE_PATH', plugin_basename(__FILE__));
defined('WC_CALL_FOR_PRICE_TEMPLATE_PATH') || define('WC_CALL_FOR_PRICE_TEMPLATE_PATH', plugin_dir_path( __FILE__ ) );

defined( 'WC_CALL_FOR_PRICE_PLUGIN_ROOT_PATH' ) || define( 'WC_CALL_FOR_PRICE_PLUGIN_ROOT_PATH', __DIR__ );

// Activation Deactivation
register_activation_hook(__FILE__, 'wc_call_for_price__activate');
register_deactivation_hook(__FILE__, 'wc_call_for_price__deactivate');

// Booting the plugin
WCCallForPrice::init();

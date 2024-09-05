<?php
/**
 * Plugin Name: WC Call For Price
 * Plugin URI: http://www.wordpress.org/wc-call-for-price
 * Version: 1.4.0
 * Author: WCPress
 * Author URI: https://wcpress.net/wc-call-for-price-woocommerce-plugin/
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

require_once( 'vendor/autoload.php' );
require_once ( 'functions.php' );

// Constants
defined( 'WC_CALL_FOR_PRICE_VERSION' ) || define('WC_CALL_FOR_PRICE_VERSION', '1.4.0');
defined('WC_CALL_FOR_PRICE_PATH') || define('WC_CALL_FOR_PRICE_PATH', plugin_basename(__FILE__));
defined( 'WC_CALL_FOR_PRICE_ACTIVATION_DEACTIVATION_FILE' ) || define( 'WC_CALL_FOR_PRICE_ACTIVATION_DEACTIVATION_FILE', __DIR__ . '/activation-deactivation.php' );
defined('WC_CALL_FOR_PRICE_TEMPLATE_PATH') || define('WC_CALL_FOR_PRICE_TEMPLATE_PATH', plugin_dir_path( __FILE__ ) );

// Activation Deactivation
register_activation_hook(WC_CALL_FOR_PRICE_ACTIVATION_DEACTIVATION_FILE, 'wc_call_for_price__activate');
register_deactivation_hook(WC_CALL_FOR_PRICE_ACTIVATION_DEACTIVATION_FILE, 'wc_call_for_price__deactivate');

// Booting the plugin
\WCPress\WCP\Boot::init();

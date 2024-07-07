<?php
namespace WCPress\WCP;

// Security Check
defined( 'ABSPATH' ) || exit;

class WooCommerceSupport {
  public function __construct() {
    add_action( 'before_woocommerce_init', [ $this, 'add_hpos_support_declaration' ] );
   }

  public function add_hpos_support_declaration() {
    if ( class_exists( \Automattic\WooCommerce\Utilities\FeaturesUtil::class ) ) {
      \Automattic\WooCommerce\Utilities\FeaturesUtil::declare_compatibility(
         'custom_order_tables', 
          WC_CALL_FOR_PRICE_ROOT_FILE, 
          true 
       );
    }
  }
}
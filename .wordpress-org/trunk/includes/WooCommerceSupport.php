<?php
/**
* Adds feature supports for WooCommerce
*
* @since 1.5.0
*/

namespace WCPress\WCP;

// Security Check
defined( 'ABSPATH' ) || exit;

/**
 * Class Constructor and HPOS Support Declaration.
 * 
 * This class initializes the actions and declares support for High-Performance Order Storage (HPOS) by using WooCommerce's FeaturesUtil.
 * 
 * @since 1.5.1
 */
class WooCommerceSupport {
    
    /**
    * Constructor.
    * 
    * Initializes the class by adding the 'before_woocommerce_init' action hook to declare HPOS support.
    * 
    * @since 1.5.1
    */
    public function __construct() {
        add_action( 'before_woocommerce_init', [ $this, 'add_hpos_support_declaration' ] );
    }

    /**
    * Declare HPOS Support.
    * 
    * Declares compatibility with WooCommerce's High-Performance Order Storage (HPOS) feature.
    * 
    * This function checks if the FeaturesUtil class exists in WooCommerce and declares compatibility for custom order tables.
    * 
    * @since 1.5.1
    */
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

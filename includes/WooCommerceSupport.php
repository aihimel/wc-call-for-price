<?php
namespace WCPress\WCP;

use Automattic\WooCommerce\Utilities\FeaturesUtil;

defined( 'ABSPATH' ) || exit;

/**
 * Manages support for woocommerce
 *
 * @since WCP_SINCE
 */
class WooCommerceSupport {

	/**
	 * Initializes the WooCommerce Support hooks
	 *
	 * @since WCP_SINCE
	 */
    public function __construct() {
    	add_action( 'before_woocommerce_init', [ $this, 'add_hpos_support_declaration' ] );
    }

	/**
	 * Adds WooCommerce HPOS support declaration
	 *
	 * @since WCP_SINCE
	 *
	 * @return void
	 */
    public function add_hpos_support_declaration() {
		if ( class_exists( FeaturesUtil::class ) ) {
			FeaturesUtil::declare_compatibility(
			'custom_order_tables',
				WC_CALL_FOR_PRICE_ROOT_FILE
			);
		}
    }
}

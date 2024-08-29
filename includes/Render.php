<?php
/**
 * Frontend Renderer
 *
 * @since 1.2.1
 */

namespace WCPress\WCP;

use WC_Product;

class Render {

    /**
     * Initializes the object
     *
     * @since 1.4.0
     */
    public function __construct() {
        $this->hooks();
    }

    /**
     * Declares all the hooks
     *
     * @since 1.4.0
     *
     * @return void
     */
    protected function hooks() {
        if ( get_option( Constants::ONLY_EMPTY_PRICE, Constants::OFF ) === Constants::ON ) {
            add_filter( 'woocommerce_empty_price_html', [ $this, 'button_html' ], 10, 2 );
        } elseif ( wcp_is_on( Constants::SHOW_ON_ALL_PRODUCTS ) ) {
            add_filter( 'woocommerce_is_purchasable', '__return_false' );
            add_filter( 'woocommerce_get_price_html', [ $this, 'button_html' ], 11, 2 );
            add_action( 'woocommerce_single_variation', [ $this, 'hide_single_variation_add_to_cart' ] );
        }
        
        if ( wcp_is_on( Constants::OUT_OF_STOCK ) ) {
            add_filter( 'woocommerce_get_price_html', [ $this, 'out_of_stock' ], 10, 2 );
        }

        if ( wcp_is_on( Constants::MINIMUM_STOCK_THRESHOLD ) ) {
            add_filter( 'woocommerce_get_price_html', [ $this, 'woocommerce_low_on_stock' ], 10, 2 );
        }

        if ( wcp_is_on( Constants::ENABLE_TAXONOMY ) ) {
            add_filter( 'woocommerce_is_purchasable', '__return_false' );
            add_filter( 'woocommerce_get_price_html', [ $this, 'enable_taxonomy' ], 12, 2 );
            add_action( 'woocommerce_single_variation', [ $this, 'hide_single_variation_add_to_cart' ] );
        }
    }

    /**
     * Handles out of stock product
     *
     * @since 1.4.0
     *
     * @param int|string $price
     * @param WC_Product $product
     *
     * @return string
     */
    public function out_of_stock( $price, WC_Product $product ) {
        if ( ! ( $product->get_stock_status() === Constants::OUT0FSTOCK ) ) {
            return $price;
        } else {
            return $this->button_html($price, $product);
        }
    }

	/**
    * Hide WooCommerce variable product single variation add to cart button
    *
    * @since 1.4.4
    *
	 * @return void
	 */
    public function hide_single_variation_add_to_cart() {
	    remove_action(
        'woocommerce_single_variation',
        'woocommerce_single_variation_add_to_cart_button',
        20
        );
    }

    /**
     * Handles low on stock product
     *
     * @since 1.4.0
     *
     * @param int|string $price
     * @param WC_Product $product
     *
     * @return string
     */
    public function woocommerce_low_on_stock( $price, WC_Product $product ) {
        $low_stock_amount = get_option( 'woocommerce_notify_low_stock_amount' );
        $custom_low_stock_amount = get_option( Constants::BELOW_STOCK_AMOUNT, 0 );
        $stock_limit = ! empty( $custom_low_stock_amount ) ? $custom_low_stock_amount : $low_stock_amount;
        if ( $product->managing_stock() && $stock_limit >= $product->get_stock_quantity() ) {
            return $this->button_html( $price, $product );
        }
        return $price;
    }

    /**
     * Renders button html on button settings configuration
     *
     * @since 1.4.0
     *
     * @param string|int $price
     * @param WC_Product $product
     *
     * @return string
     */
    public function button_html( $price, WC_Product $product ) { // phpcs:ignore

        if ( is_admin() ) {
            return $price;
        }

        // Features
        $show_uploaded_image = wcp_is_on( Constants::SHOW_UPLOADED_IMAGE );
        $show_preset_image = wcp_is_on( Constants::SHOW_PRESET_IMAGE );

        /**
         * Filter to activate redirect from button click
         *
         * @since 1.5.1
         *
         * @params bool
         * @param WC_Product
         */
        $do_redirect = apply_filters(
            'wcp_redirect_on',
            wcp_is_on( Constants::REDIRECT_TO ),
            $product
        );
        $text = get_option( Constants::TEXT, __( 'Call For Price', 'wc-call-for-price' ) );

        $height = get_option( Constants::BUTTON_HEIGHT, 40 );
        $width = get_option( Constants::BUTTON_WIDTH, 140 );
        $uploaded_image_url = $show_uploaded_image ? get_option( Constants::UPLOADED_IMAGE_URL, '' ): '';
        $preset_image_url = $show_preset_image ? plugins_url( '/wc-call-for-price/assets/images/preset-buttons/'. get_option( Constants::PRESET_IMAGE_NAME ) . '.png' ): '';
        $background_image_url = '';
        if ( ( $show_preset_image || $show_uploaded_image ) ) {
            if ( $show_uploaded_image ) {
                $background_image_url = $uploaded_image_url;
            } elseif ( $show_preset_image ) {
                $background_image_url = $preset_image_url;
            }
        }
        $title = get_option( Constants::BUTTON_ALT_TEXT, __( 'Call For Price', 'wc-call-for-price' ) );
        $target = get_option( Constants::OPEN_NEW_PAGE ) === Constants::ON ? '_blank': '_self' ;
        $link = $do_redirect ? get_option( Constants::REDIRECT_LINK, '#' ): '#';

        /**
         * Filter to manipulate button link
         *
         * @since 1.5.1
         */
        $link = apply_filters( 'wcp_button_link', $link, $product );

        $style = "cursor: pointer; height: {$height}px; width: {$width}px; background-color: transparent; background-repeat: no-repeat; background-size: contain;";
        $style .= ! empty( $background_image_url ) ? 'background-image:url(' . $background_image_url . ');' : '';
        $style .= 'display:inline-block;';

        /**
         * Click event filter to pass a function name to be executed on click
         *
         * @since 1.5.1
         *
         * @param string $click_event
         * @param WC_Product $product
         */
    		$click_event = apply_filters(
            'wcp_button_click_event',
            ( ! $do_redirect ? 'return false': '' ),
            $product
        );

        ob_start();
        ?>
        <a
            style="<?php echo esc_attr( $style );?>"
            class="wcp-action-button"
            target="<?php echo esc_attr( $target ); ?>"
            href="<?php echo esc_attr( $link ); ?>"
            title="<?php echo esc_attr( $title ); ?>"
            onclick="<?php echo esc_js( $click_event ); ?>"
            data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"
            data-product-title="<?php echo esc_attr( $product->get_title() ); ?>"
            data-product-link="<?php echo esc_attr( $product->get_permalink() ); ?>"
            data-product-type="<?php echo esc_attr( $product->get_type() ); ?>"
        >
            <?php echo esc_html( ! $show_preset_image && ! $show_uploaded_image ? $text : '' ) ?>
        </a>
        <?php
        return apply_filters( 'wcp_button_html', ob_get_clean() );
    }

    public function enable_taxonomy( $price, WC_Product $product ) { // phpcs:ignore

        $enabled_taxonomy= wcp_is_on( Constants::ENABLE_TAXONOMY, 0 );
        $selected_category = get_option( Constants::CATEGORY, '' );
        $selected_tags = get_option( Constants::TAGS, [] );

        if ( $enabled_taxonomy ) {
            $product_categories = $product->get_category_ids();
            $product_tags = $product->get_tag_ids();
    
            // Check if product category matches selected category
            if ( in_array( $selected_category, $product_categories ) ) {
                // echo '<p>Enable Taxonomy Price</p>';
                return $this->button_html( $price, $product );
            }
    
            // Check if product tags match selected tags
            if ( array_intersect( $selected_tags, $product_tags ) ) {
                // echo '<p>Enable Taxonomy Price</p>';
                return $this->button_html( $price, $product );
            }
        }
        return $price;
    }
}
<?php
/**
 * Frontend Renderer
 *
 * @since 1.2.1
 */

namespace WCPress\WCP;
use WC_Product;

class Render {

    function __construct() {
        $this->hooks();
    }

    protected function hooks() {
        if( get_option( Constants::ONLY_EMPTY_PRICE, Constants::OFF ) == Constants::ON ) {
            add_filter( 'woocommerce_empty_price_html', [ $this, 'button_html' ], 10, 2 );
        } elseif ( wcp_is_on( Constants::SHOW_ON_ALL_PRODUCTS ) ) {
            add_filter( 'woocommerce_is_purchasable', '__return_false' );
            add_filter( 'woocommerce_get_price_html', [ $this, 'button_html' ], 11, 2 );
        }

        if ( wcp_is_on( Constants::OUT_OF_STOCK ) ) {
            add_filter( 'woocommerce_get_price_html', [ $this, 'out_of_stock' ], 10, 2 );
        }

        if ( wcp_is_on( Constants::MINIMUM_STOCK_THRESHOLD ) ) {
            add_filter( 'woocommerce_get_price_html', [ $this, 'woocommerce_low_on_stock' ], 10, 2 );
        }
    }

    /**
     * Handles
     * @param int|string $price
     * @param WC_Product $product
     * @return string
     */
    public function out_of_stock( $price, $product ) {
        if ( ! ( $product->get_stock_status() == Constants::OUT0FSTOCK ) ) {
            return $price;
        } else {
            return $this->button_html($price, $product);
        }
    }

    public function woocommerce_low_on_stock( $price, $product ) {
        $low_stock_amount = get_option( 'woocommerce_notify_low_stock_amount' );
        $custom_low_stock_amount = get_option( Constants::BELOW_STOCK_AMOUNT, 0 );
        $stock_limit = ! empty( $custom_low_stock_amount ) ? $custom_low_stock_amount : $low_stock_amount;
        if ( $product->managing_stock() && $stock_limit >= $product->get_stock_quantity() ) {
            return$this->button_html($price, $product);
        }
        return $price;
    }

    /**
     * @param string|int $price
     * @param WC_Product $product
     * @return string
     */
    public function button_html( $price, $product ) {

        if ( is_admin() ) {
            return $price;
        }

        $height = get_option( Constants::BUTTON_HEIGHT );
        $width = get_option( Constants::BUTTON_WIDTH );
        $title = get_option( Constants::BUTTON_ALT_TEXT );

        if( wcp_is_on( Constants::SHOW_UPLOADED_IMAGE ) ) {
            $uploaded_image_url = esc_attr( get_option( Constants::UPLOADED_IMAGE_URL ) );
            return "<button class='wcp-call-for-price-button' title='{$title}' style='width:{$width}px;height:{$height}px;cursor:pointer;background-image:url({$uploaded_image_url});background-repeat:no-repeat;background-size:contain;background-color:transparent;'></button>";
        } elseif( wcp_is_on( Constants::SHOW_PRESET_IMAGE ) ) {
            $preset_image_url = esc_attr( plugins_url( '/wc-call-for-price/assets/images/preset-buttons/'. get_option( Constants::PRESET_IMAGE_NAME ) . '.png' ) );
            return "<button class='wcp-call-for-price-button' title='{$title}' style='width:{$width}px;height:{$height}px;cursor:pointer;background-image:url({$preset_image_url});background-repeat:no-repeat;background-size:contain;background-color:transparent;'></button>";
        } elseif( wcp_not_empty( Constants::TEXT ) ) {
            $text = get_option( Constants::TEXT );
            return "<button class='wcp-call-for-price-button'>{$text}</button>";
        }

        $text = __( 'Call For Price', 'wc-call-for-price' );
        return "<button class='wcp-call-for-price-button' style='background-color:transparent'>{$text}</button>";
    }
}
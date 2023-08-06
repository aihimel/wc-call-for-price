<?php
/**
 * Frontend Renderer
 *
 * @since 1.2.1
 */

namespace WCPress\WCP;

use const Grpc\CALL_ERROR_NOT_ON_SERVER;

class Render {

    function __construct() {
        $this->hooks();
    }

    protected function hooks() {
        if( get_option( Constants::ONLY_EMPTY_PRICE, Constants::OFF ) == Constants::ON ) {
            add_filter( 'woocommerce_empty_price_html', [ $this, 'empty_price_replacement' ] );
        } elseif ( get_option( Constants::SHOW_ON_ALL_PRODUCTS, Constants::OFF ) == Constants::ON ) {
            add_filter( 'woocommerce_get_price_html', [ $this, 'show_on_all_products' ] );
        }
    }

    /**
     * Show call for price on all product
     *
     * @since 1.3.1
     *
     * @param $price
     * @return string
     */
    public function show_on_all_products( $price ) {
        return $this->empty_price_replacement( $price );
    }

    /**
     * @param $price
     * @return string
     */
    public function empty_price_replacement ( $price ) {
        $show_uploaded_image = get_option( Constants::SHOW_UPLOADED_IMAGE , Constants::OFF);
        $upload_image_url = get_option( Constants::UPLOADED_IMAGE_URL, '' );
        $show_preset_image = get_option( Constants::SHOW_PRESET_IMAGE, '' );
        $preset_image_name = get_option( Constants::PRESET_IMAGE_NAME, '' );
        $text = get_option( Constants::TEXT );

        if( $show_uploaded_image == Constants::ON ) {
            return '<img src="' . esc_attr( $upload_image_url ) . '" />';
        } else if( $show_preset_image == Constants::ON ) {
            return '<img src="' . esc_attr( plugins_url('/wc-call-for-price/assets/images/preset-buttons/' . $preset_image_name ) ) . '.png" />';
        } else {
            if( ! empty( $text ) ) {
                return esc_attr( $text );
            }
        }

        return __('Call For Price', 'wc-call-for-price' );
    }

    public function button_html() {
        // Button rules
    }

}
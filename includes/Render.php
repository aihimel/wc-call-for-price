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
            add_filter( 'woocommerce_empty_price_html', [ $this, 'button_html' ] );
        } elseif ( get_option( Constants::SHOW_ON_ALL_PRODUCTS, Constants::OFF ) == Constants::ON ) {
            add_filter( 'woocommerce_is_purchasable', '__return_false' );
            add_filter( 'woocommerce_get_price_html', [ $this, 'button_html' ], 11 );
        }
    }


    /**
     * @return string
     */
    public function button_html( $price ) {

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
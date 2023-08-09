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
     * Initilizes the object
     *
     * @since 1.3.1
     */
    function __construct() {
        $this->hooks();
    }

    /**
     * Declares all the hooks
     *
     * @since 1.3.1
     *
     * @return void
     */
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
     * Handles out of stock product
     *
     * @since 1.3.1
     *
     * @param int|string $price
     * @param WC_Product $product
     *
     * @return string
     */
    public function out_of_stock( $price, $product ) {
        if ( ! ( $product->get_stock_status() == Constants::OUT0FSTOCK ) ) {
            return $price;
        } else {
            return $this->button_html($price, $product);
        }
    }

    /**
     * Handles low on stock product
     *
     * @since 1.3.1
     *
     * @param int|string $price
     * @param WC_Product $product
     *
     * @return string
     */
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
     * Renders button html on button settings configuration
     *
     * @since 1.3.1
     *
     * @param string|int $price
     * @param WC_Product $product
     *
     * @return string
     */
    public function button_html( $price, $product ) {

        if ( is_admin() ) {
            return $price;
        }

        // Features
        $show_uploaded_image = wcp_is_on( Constants::SHOW_UPLOADED_IMAGE );
        $show_preset_image = wcp_is_on( Constants::SHOW_PRESET_IMAGE );
        $do_redirect = wcp_is_on( Constants::REDIRECT_TO );
        $text = get_option( Constants::TEXT, __( 'Call For Price', 'wc-call-for-price' ) );

        $height = get_option( Constants::BUTTON_HEIGHT, 40 );
        $width = get_option( Constants::BUTTON_WIDTH, 140 );
        $uploaded_image_url = $show_uploaded_image ? get_option( Constants::UPLOADED_IMAGE_URL, '' ): '';
        $preset_image_url = $show_preset_image ? plugins_url( '/wc-call-for-price/assets/images/preset-buttons/'. get_option( Constants::PRESET_IMAGE_NAME ) . '.png' ): '';
        $background_image_url = '';
        if( ( $show_preset_image || $show_uploaded_image ) ) {
            if ( $show_uploaded_image ) {
               $background_image_url = $uploaded_image_url;
            } elseif( $show_preset_image ) {
                $background_image_url = $preset_image_url;
            }
        }
        $title = get_option( Constants::BUTTON_ALT_TEXT, __( 'Call For Price', 'wc-call-for-price' ) );
        $target = get_option( Constants::OPEN_NEW_PAGE ) == Constants::ON ? '_blank': '_self' ;
        $link = $do_redirect ? get_option( Constants::REDIRECT_LINK, '#' ): '#';

        $style = "cursor: pointer; height: {$height}px; width: {$width}px; background-color: transparent; background-repeat: no-repeat; background-size: contain;";
        $style .= ! empty( $background_image_url ) ? 'background-image:url(' . $background_image_url . ')' : '';

        $click_event = ! $do_redirect ? "return false": '';

        ob_start();
        ?>
        <a
            style="<?php echo esc_attr( $style );?>"
            target="<?php echo esc_attr( $target ); ?>"
            href="<?php echo esc_attr( $link ); ?>"
            title="<?php echo esc_attr( $title ); ?>"
            onclick="<?php echo esc_js( $click_event ); ?>"
        >
            <?php echo esc_html( ! $show_preset_image && ! $show_uploaded_image ? $text : '' ) ?>
        </a>
        <?php
        return apply_filters( 'wcp_button_html', ob_get_clean() );
    }
}
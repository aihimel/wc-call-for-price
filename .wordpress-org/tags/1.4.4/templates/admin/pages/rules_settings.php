<?php
/**
 * Button settings page
 *
 * @since 1.4.0
 *
 */

// Security check
defined( 'ABSPATH' ) || die();

use WCPress\WCP\Constants;

?>

<h4><?php _e( 'Rules Settings', 'wc-call-for-price' ); ?></h4>

<form class="" method="POST" action="">
    <?php wp_nonce_field( Constants::ADMIN_FORM_NONCE_ACTION, Constants::NONCE_FIELD_NAME ); ?>
    <fieldset>
        <legend><?php esc_html_e( 'Stock ', 'wc-call-for-price' ); ?></legend>
        <div>
            <label for="wcp-out-of-stock">
                <?php esc_html_e( 'Out of stocks', 'wc-call-for-price' ); ?>:
            </label>
            <input
                id="wcp-out-of-stock"
                type="checkbox"
                name='<?php echo esc_attr( Constants::OUT_OF_STOCK ); ?>'
                value='<?php echo esc_attr( Constants::ON ); ?>'
                <?php checked( get_option( Constants::OUT_OF_STOCK ), Constants::ON ); ?>
            />
            <p class="help-block">
                <?php esc_html_e( 'If checked, all the out of products will show call for price.', 'wc-call-for-price'); ?>
            </p>
        </div>
        <div>
            <label for="wcp-stock-minimum-threshold">
                <?php esc_html_e( 'Minimum Threshold', 'wc-call-for-price' ); ?>:
            </label>
            <input
                id="wcp-stock-minimum-threshold"
                type="checkbox"
                name='<?php echo esc_attr( Constants::MINIMUM_STOCK_THRESHOLD ); ?>'
                value='<?php echo esc_attr( Constants::ON ); ?>'
                <?php checked( get_option( Constants::MINIMUM_STOCK_THRESHOLD ), Constants::ON, true ); ?>
            />
            <p class="help-block">
                <?php esc_html_e( 'If checked, all the products with minimum threshold will show.', 'wc-call-for-price'); ?>
            </p>
        </div>

        <div>
            <label for="wcp-stock-below-quantity">
                <?php esc_html_e( 'Minimum Threshold', 'wc-call-for-price' ); ?>:
            </label>
            <input
                id="wcp-stock-below-quantity"
                type="number"
                name='<?php echo esc_attr( Constants::BELOW_STOCK_AMOUNT ); ?>'
                value='<?php echo get_option( Constants::BELOW_STOCK_AMOUNT ); ?>'
            />
            <p class="help-block">
                <?php esc_html_e( 'Minimum stock quantity to show call for price.', 'wc-call-for-price'); ?>
            </p>
        </div>
    </fieldset>

    <button
            type="submit"
            class="save-button"
            name="<?php echo esc_attr( wcp_get_admin_sub_page_slug() ); ?>"
            value="<?php echo esc_attr( Constants::WCP_SUB_PAGE_GENERAL_SETTINGS ); ?>"
    >
        <?php esc_html_e( 'Save Settings', 'wc-call-for-price' ); ?>
    </button>
</form>

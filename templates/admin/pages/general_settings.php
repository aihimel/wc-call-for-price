<?php
/**
 * General settings page
 *
 * @since 1.3.1
 */

// Security check
defined( 'ABSPATH' ) || die();

use WCPress\WCP\Constants;

?>

<h4><?php _e( 'General Settings', 'wc-call-for-price' ); ?></h4>

<form class='form-inline' method='POST' action=''>

    <fieldset>
        <legend><?php esc_html_e( 'Plugin Features', 'wc-call-for-price' ); ?></legend>
        <label for="activate"><?php esc_html_e( 'Activate', 'wc-call-for-price' ); ?>: </label>
        <input
                type="checkbox"
                name="<?php echo esc_attr( Constants::WCP_ACTIVATE ); ?>"
                id="activate"
                value="<?php echo esc_attr( Constants::ON ); ?>"
                <?php checked( get_option( Constants::WCP_ACTIVATE ), Constants::ON, true ) ?>
        />
        <p class="help-block">
            <?php esc_html_e( 'This checkbox will activate the plugin features. This must be on for the plugin to work.', 'wc-call-for-price' ); ?>
        </p>
    </fieldset>

    <fieldset>
        <legend><?php esc_html_e( 'Display Settings', 'wc-call-for-price' ); ?></legend>
        <label for="wcp-only-empty-price"><?php esc_html_e( 'Only Empty Price', 'wc-call-for-price' ); ?>: </label>
        <input
                class="wcp-rquery"
                data-uncheck="#wcp-show-on-all-products"
                type="checkbox"
                name="<?php echo esc_attr( Constants::ONLY_EMPTY_PRICE ); ?>"
                id="wcp-only-empty-price"
                value="<?php echo esc_attr( Constants::ON ); ?>"
                <?php checked( get_option( Constants::ONLY_EMPTY_PRICE ), Constants::ON, true ) ?>
        />
        <p class="help-block">
            <?php esc_html_e( 'If checked, this will show call for price only on empty price products.', 'wc-call-for-price' ); ?>
        </p>
        <label for="wcp-show-on-all-products"><?php esc_html_e( 'Show On All Products', 'wc-call-for-price' ); ?>: </label>
        <input
                class="wcp-rquery"
                data-uncheck="#wcp-only-empty-price"
                type="checkbox"
                name="<?php echo esc_attr( Constants::SHOW_ON_ALL_PRODUCTS ); ?>"
                id="wcp-show-on-all-products"
                value="<?php echo esc_attr( Constants::ON ); ?>"
                <?php checked( get_option( Constants::SHOW_ON_ALL_PRODUCTS ), Constants::ON, true ) ?>
        />
        <p class="help-block">
            <?php esc_html_e( 'If checked, this will show call for price on all products.', 'wc-call-for-price' ); ?>
        </p>
    </fieldset>

    <fieldset>
        <legend><?php esc_html_e( 'Text', 'wc-call-for-price' ); ?></legend>
        <div class="form-group">
            <label for="wc_call_for_price__text"><?php esc_html_e( 'Text To Show :', 'wc-call-for-price' ); ?> </label>
            <input type="text" class="form-control" id="wc_call_for_price__text" name='wc_call_for_price__text' value='<?php echo esc_attr( get_option('wc_call_for_price__text') );?>'>
            <p class="help-block"><?php esc_html_e( 'Write here what you want to see on front end. Plain text or HTML.', 'wc-call-for-price'); ?></p>
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

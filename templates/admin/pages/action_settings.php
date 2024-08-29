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

<form class="" method="POST" action="">
    <?php wp_nonce_field( Constants::ADMIN_FORM_NONCE_ACTION, Constants::NONCE_FIELD_NAME ); ?>
    <fieldset>
        <legend><?php esc_html_e( 'Redirect ', 'wc-call-for-price' ); ?></legend>
        <div>
            <label for="wcp-redirect-on-click">
                <?php esc_html_e( 'Redirect To', 'wc-call-for-price' ); ?>:
            </label>
            <input
                class="wcp-rquery action-options"
                data-uncheck-on-uncheck="#wcp-open-in-a-new-page"
                data-disable-on-uncheck="#wcp-redirect-link"
                data-enable-on-check="#wcp-redirect-link"
                id="wcp-redirect-on-click"
                type="checkbox"
                name='<?php echo esc_attr( Constants::REDIRECT_TO ); ?>'
                value='<?php echo esc_attr( Constants::ON ); ?>'
                <?php checked( get_option( Constants::REDIRECT_TO ), Constants::ON ); ?>
            />
            <p class="help-block">
                <?php esc_html_e( 'Redirect to a new page.', 'wc-call-for-price'); ?>
            </p>
        </div>
        <div>
            <label for="wcp-open-in-a-new-page">
                <?php esc_html_e( 'Open in a new page', 'wc-call-for-price' ); ?>:
            </label>
            <input
                class="wcp-rquery"
                id="wcp-open-in-a-new-page"
                type="checkbox"
                name='<?php echo esc_attr( Constants::OPEN_NEW_PAGE ); ?>'
                value='<?php echo esc_attr( Constants::ON ); ?>'
                <?php checked( get_option( Constants::OPEN_NEW_PAGE ), Constants::ON ); ?>
            />
            <p class="help-block">
                <?php esc_html_e( 'Opens a new tab.', 'wc-call-for-price'); ?>
            </p>
        </div>

        <div>
            <label for="wcp-redirect-link">
                <?php esc_html_e( 'Link', 'wc-call-for-price' ); ?>:
            </label>
            <input
                id="wcp-redirect-link"
                type="text"
                placeholder="https://wcpress.net"
                name='<?php echo esc_attr( Constants::REDIRECT_LINK ); ?>'
                value='<?php echo esc_attr( get_option( Constants::REDIRECT_LINK ) ); ?>'
            />
            <p class="help-block">
                <?php esc_html_e( 'Redirect to the above link', 'wc-call-for-price'); ?>
            </p>
        </div>

    </fieldset>

    <?php do_action( 'wcp_template_action_settings_end' ); ?>

    <button
            type="submit"
            class="save-button"
            name="<?php echo esc_attr( wcp_get_admin_sub_page_slug() ); ?>"
            value="<?php echo esc_attr( Constants::WCP_SUB_PAGE_GENERAL_SETTINGS ); ?>"
    >
        <?php esc_html_e( 'Save Settings', 'wc-call-for-price' ); ?>
    </button>

</form>

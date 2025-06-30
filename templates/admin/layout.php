<?php
/**
 * Basic layout file
 *
 * @since 1.2.0
 */

// Security Check
defined( 'ABSPATH' ) || die();

use WCPress\WCP\Constants;

$wcp_sub_page = wcp_get_admin_sub_page_slug();

$wcp_is_page_valid = apply_filters( 'wcp_is_admin_subpage_valid', $wcp_sub_page );

?>

<div class="wcp-admin-panel-wrapper">
    <div class="sidebar">
      <div class="logo-wrapper">
        <img
          height="128"
          width="128"
          src="<?php echo plugin_dir_url( WC_CALL_FOR_PRICE_PATH ) . 'assets/images/wcpress-logo.png'?>"
          alt="WCPress Logo"
        >
      </div>
      <div class="link-wrapper">
        <ul>
          <li class="review"><a target="_blank" href="<?php echo esc_attr( 'https://wordpress.org/support/plugin/wc-call-for-price/reviews/#new-post' ); ?>">Review</a></li>
          <li class="supprt"><a target="_blank" href="<?php echo esc_attr( 'https://wordpress.org/support/plugin/wc-call-for-price/' ); ?>">Support</a></li>
        </ul>
      </div>
    </div>
    <div class="main">
    		<?php wcp_get_admin_template( 'parts/header.php' ); ?>
        <?php
            if ( $wcp_is_page_valid ) {
                wcp_get_admin_template( 'pages/' . $wcp_sub_page . '.php' );
            } else {
                wcp_get_admin_template( 'pages/404.php' );
            }
        ?>
    		<?php wcp_get_admin_template( 'parts/footer.php' ); ?>
    </div>
    <?php if ( ! defined( 'WCP_PRO_ADDON_ROOT_FILE' ) ) : ?>
    <aside>
        <div class="wcp-marketing-block">
            <h3>
                🚀 Upgrade to <span class="wcp-marketing-pro">Pro</span> &amp; Unlock More Features!
            </h3>
            <ul>
                <li>
                    <span class="wcp-marketing-icon wcp-marketing-icon-yellow">💬</span>
                    <span>Direct Whatsapp message with product details</span>
                </li>
                <li>
                    <span class="wcp-marketing-icon wcp-marketing-icon-teal dashicons dashicons-email-alt"></span>
                    <span>Contact From 7 Popup integration</span>
                </li>
<!--                <li>-->
<!--                    <span class="wcp-marketing-icon wcp-marketing-icon-pink">🎨</span>-->
<!--                    <span>Customizable call-for-price button styles</span>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span class="wcp-marketing-icon wcp-marketing-icon-blue">📊</span>-->
<!--                    <span>Advanced analytics &amp; reporting</span>-->
<!--                </li>-->
<!--                <li>-->
<!--                    <span class="wcp-marketing-icon wcp-marketing-icon-red">⚡</span>-->
<!--                    <span>Priority support &amp; updates</span>-->
<!--                </li>-->
            </ul>
            <a href="https://www.wcpress.net/wc-call-for-price-woocommerce-plugin/" target="_blank" class="button button-primary wcp-marketing-btn">
                Learn More
            </a>
        </div>
    </aside>
    <?php endif; ?>
</div>

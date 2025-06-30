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
        <div class="wcp-marketing-block" style="background: linear-gradient(135deg, #f0f7ff 0%, #e0ecff 100%); border-radius: 14px; box-shadow: 0 4px 16px rgba(0,0,0,0.07); padding: 32px 28px; margin: 32px 0 0 0; text-align: center; border: 1.5px solid #b3d8ff; margin:16px">
            <h3 style="color:#0073aa; font-size: 1.6em; margin-bottom: 18px; letter-spacing: 0.5px;">
                🚀 Upgrade to <span style="color:#005177;">Pro</span> &amp; Unlock More Features!
            </h3>
            <ul style="list-style: none; padding: 0; margin: 0 0 24px 0;">
                <li style="margin: 18px 0; font-size: 1.13em; display: flex; align-items: center; gap: 10px; justify-content: center;">
                    <span style="font-size:1.5em; color:#ffb300;">🔒</span>
                    <span>Hide prices for specific user roles</span>
                </li>
                <li style="margin: 18px 0; font-size: 1.13em; display: flex; align-items: center; gap: 10px; justify-content: center;">
                    <span style="font-size:1.5em; color:#00bfae;">📧</span>
                    <span>Automatic email notifications for price requests</span>
                </li>
                <li style="margin: 18px 0; font-size: 1.13em; display: flex; align-items: center; gap: 10px; justify-content: center;">
                    <span style="font-size:1.5em; color:#ff4081;">🎨</span>
                    <span>Customizable call-for-price button styles</span>
                </li>
                <li style="margin: 18px 0; font-size: 1.13em; display: flex; align-items: center; gap: 10px; justify-content: center;">
                    <span style="font-size:1.5em; color:#536dfe;">📊</span>
                    <span>Advanced analytics &amp; reporting</span>
                </li>
                <li style="margin: 18px 0; font-size: 1.13em; display: flex; align-items: center; gap: 10px; justify-content: center;">
                    <span style="font-size:1.5em; color:#ff1744;">⚡</span>
                    <span>Priority support &amp; updates</span>
                </li>
            </ul>
            <a href="https://wcpress.com/wc-call-for-price-pro/" target="_blank" class="button button-primary" style="font-size:1.15em; padding: 12px 32px; border-radius: 6px; background: linear-gradient(90deg,#0073aa 60%,#005177 100%); border: none; box-shadow: 0 2px 8px rgba(0,115,170,0.10);">
                Learn More
            </a>
        </div>
    </aside>
    <?php endif; ?>
</div>

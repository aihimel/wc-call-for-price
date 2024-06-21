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
</div>
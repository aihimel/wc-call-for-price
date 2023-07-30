<?php
/**
 * Basic layout file
 *
 * @since 1.2.0
 */

// Security Check
defined( 'ABSPATH' ) || die();

use WCPress\WCP\Constants;

$wcp_sub_page = sanitize_text_field( $_GET[ Constants::WCP_SUB_PAGE_QUERY_STRING ] );

$wcp_is_page_valid = apply_filters( 'wcp_is_admin_subpage_valid', $wcp_sub_page );

?>

<div class="wcp-admin-panel-wrapper">
    <?php wcp_get_admin_template( 'parts/header.php' ); ?>
    <div class="main">
        <?php
            if ( $wcp_is_page_valid ) {
                wcp_get_admin_template( 'pages/' . $wcp_sub_page . '.php' );
            } else {
                wcp_get_admin_template( 'pages/404.php' );
            }
        ?>
    </div>
    <?php wcp_get_admin_template( 'parts/footer.php' ); ?>
</div>
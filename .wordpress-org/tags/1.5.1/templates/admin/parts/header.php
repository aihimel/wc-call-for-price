<?php
/**
 * Header for admin panel
 *
 * @since 1.2.0
 */

use WCPress\WCP\Constants;

// Security Check
defined( 'ABSPATH' ) || die();

// Scripts and styles
wp_enqueue_media();
wp_enqueue_style( 'wcp-admin-style' );
wp_enqueue_style( 'wcp-select2-style' );
wp_enqueue_script( 'wcp-admin-script' );
wp_enqueue_script( 'wcp-select2-script' );

do_action( 'wcp_admin_form_header', wcp_get_admin_sub_page_slug() );

?>

<div class="header">
    <?php wcp_get_admin_template( 'parts/navigation.php' ); ?>
</div>

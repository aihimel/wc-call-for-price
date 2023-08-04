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
wp_enqueue_script( 'wcp-admin-script' );

// Saving Form Data
$post = $_POST;

if( ! empty( $post[ Constants::WCP_SUB_PAGE_GENERAL_SETTINGS ] ) ) {

    if( ! empty( $post[ Constants::WCP_ACTIVATE ] ) ) {
        update_option( Constants::WCP_ACTIVATE, Constants::ON );
    } else {
        update_option( Constants::WCP_ACTIVATE, Constants::OFF );

    }

    if( ! empty( $post[ Constants::TEXT ] ) ) {
        update_option(Constants::TEXT, sanitize_text_field( $post[ Constants::TEXT ] ) );
    }

    if( ! empty( $post[ Constants::SHOW_PRESET_IMAGE ] ) ) {
        update_option(Constants::SHOW_PRESET_IMAGE, sanitize_text_field( Constants::ON ));
    } else {
        update_option(Constants::SHOW_PRESET_IMAGE, Constants::OFF);
    }

    if( isset( $post[ Constants::PRESET_IMAGE_NAME ] ) ) {
        update_option(Constants::PRESET_IMAGE_NAME, sanitize_text_field( $post[ Constants::PRESET_IMAGE_NAME ] ) );
    }

    if(isset($post[ Constants::SHOW_UPLOADED_IMAGE ]) ) {

        update_option( Constants::SHOW_UPLOADED_IMAGE , Constants::ON );
        if(!empty($post[ Constants::UPLOADED_IMAGE_URL ])) update_option( Constants::UPLOADED_IMAGE_URL , sanitize_text_field( $post[ Constants::UPLOADED_IMAGE_URL ]) );

    } else {
        update_option(Constants::SHOW_UPLOADED_IMAGE, Constants::OFF);
    }
}

do_action( 'wcp_admin_form_header', wcp_get_admin_sub_page_slug() );

?>

<div class="header">

    <h3>
        <?php esc_html_e( 'WC Call For Price', 'wc-call-for-price'); ?>
    </h3>
    <?php wcp_get_admin_template( 'parts/navigation.php' ); ?>
</div>

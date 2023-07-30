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

if( ! empty( $post['wcp-general-settings'] ) ) {
    error_log( 'Button Name Activated' );
    error_log( print_r($post, true) );
    if( ! empty( $post[ Constants::WCP_ACTIVATE ] ) ) {
        update_option( Constants::WCP_ACTIVATE, Constants::ON );
    } else {
        update_option( Constants::WCP_ACTIVATE, Constants::OFF );

    }

}

if( ! empty( $post['wc_call_for_price__text'] ) ) {
    update_option('wc_call_for_price__text', sanitize_text_field( $post['wc_call_for_price__text'] ) );
}

if( ! empty( $post['wc_call_for_price__show_image'] ) ) {
    update_option('wc_call_for_price__show_image', sanitize_text_field( $post['wc_call_for_price__show_image'] ));
} elseif( isset($post['wc_call_for_price__text']) ) {
    update_option('wc_call_for_price__show_image', 'off');
}

if( isset($post['wc_call_for_price__image'] ) ) {
    update_option('wc_call_for_price__image', sanitize_text_field( $post['wc_call_for_price__image'] ) );
}

if(isset($post['wc_call_for_price__show_uploaded_image']) && $post['wc_call_for_price__show_uploaded_image'] == 'on'){

	update_option('wc_call_for_price__show_uploaded_image', 'on');
	if(!empty($post['wc_call_for_price__upload_image'])) update_option('wc_call_for_price__upload_image', sanitize_text_field( $post['wc_call_for_price__upload_image']) );

	} elseif(isset($post['wc_call_for_price__text'])) update_option('wc_call_for_price__show_uploaded_image', 'off');


?>

<div class="header">

    <h3>
        <?php esc_html_e( 'WC Call For Price', 'wc-call-for-price'); ?>
    </h3>
    <?php wcp_get_admin_template( 'parts/navigation.php' ); ?>
</div>

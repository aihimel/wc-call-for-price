<?php
/**
 * Header for admin panel
 *
 * @since 1.2.0
 */

// Security Check
defined( 'ABSPATH' ) || die();

// Scripts and styles
wp_enqueue_style( 'wcp-admin-style' );
wp_enqueue_script( 'wcp-admin-script' );

// Saving Form Data
$post = $_POST;

if(isset($post['wc_call_for_price__text']) && !empty($post['wc_call_for_price__text'])) update_option('wc_call_for_price__text', $post['wc_call_for_price__text']);

if(isset($post['wc_call_for_price__show_image']) && !empty($post['wc_call_for_price__show_image'])) update_option('wc_call_for_price__show_image', $post['wc_call_for_price__show_image']);
	elseif(isset($post['wc_call_for_price__text'])) update_option('wc_call_for_price__show_image', 'off');

if(isset($post['wc_call_for_price__image'])) update_option('wc_call_for_price__image', $post['wc_call_for_price__image']);

if(isset($post['wc_call_for_price__show_uploaded_image']) && $post['wc_call_for_price__show_uploaded_image'] == 'on'){

	update_option('wc_call_for_price__show_uploaded_image', 'on');
	if(!empty($post['wc_call_for_price__upload_image'])) update_option('wc_call_for_price__upload_image', $post['wc_call_for_price__upload_image']);

	} elseif(isset($post['wc_call_for_price__text'])) update_option('wc_call_for_price__show_uploaded_image', 'off');

$upload_image_url = get_option( 'wc_call_for_price__upload_image', '' );


?>

<div class="header">

    <h3>
        <?php esc_html_e( 'WC Call For Price', 'wc-call-for-price'); ?>
    </h3>

</div>

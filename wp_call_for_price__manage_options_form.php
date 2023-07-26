<?php
/**
 * Admin form file
 *
 * @since 1.0.0
 */

// Security Check
defined('ABSPATH') || die();

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
<div class='container-fluid'>

	<div class='row-fluid'>

		<div class='xs-col-12 sm-col-12 md-col-6 lg-col-6 text-center'>
			<h3 class='header-blue'><?php esc_html_e( 'WC Call For Price', 'wc-call-for-price'); ?></h3>
		</div>

		<div class='xs-col-12 sm-col-12 md-col-6 lg-col-6'>

			<form class='form-inline' method='POST' action=''>

				<div class="form-group">
					<label for="wc_call_for_price__text"><?php esc_html_e( 'Text To Show :', 'wc-call-for-price' ); ?> </label>
					<input type="text" class="form-control" id="wc_call_for_price__text" name='wc_call_for_price__text' value='<?php echo get_option('wc_call_for_price__text');?>'>
					<p class="help-block"><?php esc_html_e( 'Write here what you want to see on front end. Plain text or HTML.', 'wc-call-for-price'); ?></p>
				</div>

				<br />
				<br />

				<div class="checkbox">
					<label for='wc_call_for_price__show_image'><b> <?php esc_html_e( 'Show Image :', 'wc-call-for-price' ); ?> </b></label>
					<input type="checkbox" <?php if(get_option('wc_call_for_price__show_image') == 'on') echo 'checked'; ?> id='wc_call_for_price__show_image' name='wc_call_for_price__show_image'>
					<p class="help-block">
                        <?php esc_html_e( 'Check this box if you want to select an image form some specific list of "Call for price" images.', 'wc-call-for-price' ); ?>
                    </p>
				</div>

				<div id='wc_call_for_price__images' style='display:none;'>

					<?php for($i = 1; $i <= 15; $i++) {?>

					<div class="radio">
						<label>
							<input type="radio" name="wc_call_for_price__image" id="wc_call_for_price__image_<?php echo $i; ?>" value="cfp_<?php echo $i; ?>" <?php if('cfp_'.$i == get_option('wc_call_for_price__image')) echo 'checked';?> >
								<img src='<?php echo plugins_url('/wc-call-for-price/images/cfp_'.$i.'.png'); ?>' alt=""/>
						</label>
					</div>

					<?php } ?>
					<p class="help-block"><?php esc_html_e( 'Check any one form here.', 'wc-call-for-price' ); ?></p>
				</div>

				<br />
				<br />

				<div class="checkbox">
					<label for='wc_call_for_price__show_uploaded_image'><b> <?php esc_html_e( 'Show Uploaded Image :', 'wc-call-for-price' ); ?> </b></label>
					<input type="checkbox" <?php if(get_option('wc_call_for_price__show_uploaded_image') == 'on') echo 'checked'; ?> id='wc_call_for_price__show_uploaded_image' name='wc_call_for_price__show_uploaded_image'>
					<p class="help-block"><?php esc_html_e( 'Check this box if you want to show your uploaded image.', 'wc-call-for-price' ); ?></p>
				</div>

				<br />
				<br />

				<div  id='wc_call_for_price__upload_image_wrapper'>
                    <?php if( ! empty( $upload_image_url ) ) : ?>
                    <div class="wcp-uploaded-image-preview_wrapper">
                        <img src="<?php esc_attr_e( $upload_image_url );?>" alt="">
                    </div>
                    <?php endif; ?>
                    <div class="form-group" >
                        <label for="wc_call_for_price__upload_image"><?php esc_html_e( 'Upload Your Image', 'wc-call-for-price' ); ?></label>
                        <input
                            type="text"
                            id="wc_call_for_price__upload_image"
                            value="<?php esc_attr_e( $upload_image_url );?>"
                            name='wc_call_for_price__upload_image'
                            placeholder='input image url'
                            readonly
                        />
                        <input type='button' id='wc_call_for_price__upload_image_button' name='wc_call_for_price__upload_image_button' value='Upload' />
                        <p class="help-block"><?php esc_html_e( 'If you want to upload your custom image, upload here.', 'wc-call-for-price' ); ?></p>
                    </div>
				</div>

				<br/>
				<br/>

				<button type="submit" class="btn btn-primary"><?php esc_html_e( 'Save Settings', 'wc-call-for-price' ); ?></button>

			</form>

		</div>

	</div>
	
	<footer>
        <?php
            printf(
                __("Don't forget to leave us a %s review %s. If you find anything difficult, just ask %s here %s", 'wc-call-for-price'),
                "<a href='https://wordpress.org/support/view/plugin-reviews/wc-call-for-price'>",
                "</a>",
                "<a href='https://wordpress.org/support/plugin/wc-call-for-price'>",
                "</a>"
            );
        ?>
	</footer>
	
</div>

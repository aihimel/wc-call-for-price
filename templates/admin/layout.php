<?php
/**
 * Basic layout file
 *
 * @since 1.2.0
 */

// Security Check
defined( 'ABSPATH' ) || die();

?>

<div class="wcp-admin-panel-wrapper">
    <?php require_once(plugin_dir_path( __FILE__ ) . 'parts/header.php' ); ?>
    <div class="main">

        <form class='form-inline' method='POST' action=''>
            <fieldset>
                <legend>Text</legend>
                <div class="form-group">
                <label for="wc_call_for_price__text"><?php esc_html_e( 'Text To Show :', 'wc-call-for-price' ); ?> </label>
                <input type="text" class="form-control" id="wc_call_for_price__text" name='wc_call_for_price__text' value='<?php echo get_option('wc_call_for_price__text');?>'>
                <p class="help-block"><?php esc_html_e( 'Write here what you want to see on front end. Plain text or HTML.', 'wc-call-for-price'); ?></p>
            </div>
            </fieldset>

            <fieldset>
                <legend>Select Image</legend>
                <div class="checkbox">
                    <label for='wc_call_for_price__show_image'><?php esc_html_e( 'Show Image :', 'wc-call-for-price' ); ?></label>
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
            </fieldset>

            <fieldset>
                <legend>Upload Image</legend>
                <div class="checkbox">
                    <label for='wc_call_for_price__show_uploaded_image'><?php esc_html_e( 'Show Uploaded Image :', 'wc-call-for-price' ); ?> </b></label>
                    <input type="checkbox" <?php if(get_option('wc_call_for_price__show_uploaded_image') == 'on') echo 'checked'; ?> id='wc_call_for_price__show_uploaded_image' name='wc_call_for_price__show_uploaded_image'>
                    <p class="help-block"><?php esc_html_e( 'Check this box if you want to show your uploaded image.', 'wc-call-for-price' ); ?></p>
                </div>
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
            </fieldset>
            <button type="submit" class="btn btn-primary"><?php esc_html_e( 'Save Settings', 'wc-call-for-price' ); ?></button>

        </form>

    </div>
    <?php require_once( plugin_dir_path( __FILE__ ) . 'parts/footer.php' ); ?>
</div>
<?php
/**
 * General settings page
 *
 * @since 1.3.1
 */

// Security check
defined( 'ABSPATH' ) || die();

use WCPress\WCP\Constants;

$upload_image_url = get_option( Constants::UPLOADED_IMAGE_URL, '' );

?>

<form class='form-inline' method='POST' action=''>

    <fieldset>
        <legend><?php esc_html_e( 'Plugin Features', 'wc-call-for-price' ); ?></legend>
        <label for="activate"><?php esc_html_e( 'Activate', 'wc-call-for-price' ); ?>: </label>
        <input
                type="checkbox"
                name="<?php echo esc_attr( Constants::WCP_ACTIVATE ); ?>"
                id="activate"
                value="<?php echo esc_attr( Constants::ON ); ?>"
                <?php checked( get_option( Constants::WCP_ACTIVATE ), Constants::ON, true ) ?>
        />
        <p class="help-block">
            <?php esc_html_e( 'This checkbox will activate the plugin features. This must be on for the plugin to work.', 'wc-call-for-price' ); ?>
        </p>
    </fieldset>

    <fieldset>
        <legend><?php esc_html_e( 'Text', 'wc-call-for-price' ); ?></legend>
        <div class="form-group">
        <label for="wc_call_for_price__text"><?php esc_html_e( 'Text To Show :', 'wc-call-for-price' ); ?> </label>
        <input type="text" class="form-control" id="wc_call_for_price__text" name='wc_call_for_price__text' value='<?php echo esc_attr( get_option('wc_call_for_price__text') );?>'>
        <p class="help-block"><?php esc_html_e( 'Write here what you want to see on front end. Plain text or HTML.', 'wc-call-for-price'); ?></p>
    </div>
    </fieldset>

    <fieldset>
        <legend><?php esc_html_e( 'Select Image', 'wc-call-for-price' ); ?></legend>
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

                <input type="radio" name="wc_call_for_price__image" id="wc_call_for_price__image_<?php echo $i; ?>" value="cfp_<?php echo $i; ?>" <?php if('cfp_'.$i == get_option('wc_call_for_price__image')) echo 'checked';?> >
                <img src='<?php echo esc_attr( plugins_url('/wc-call-for-price/assets/images/preset-buttons/cfp_'.$i.'.png') ); ?>' alt=""/>

            </div>

            <?php } ?>
            <p class="help-block"><?php esc_html_e( 'Check any one form here.', 'wc-call-for-price' ); ?></p>
        </div>
    </fieldset>

    <fieldset>
        <legend><?php esc_html_e( 'Upload Image', 'wc-call-for-price' ); ?></legend>
        <div class="checkbox">
            <label for='wc_call_for_price__show_uploaded_image'><?php esc_html_e( 'Show Uploaded Image :', 'wc-call-for-price' ); ?> </b></label>
            <input type="checkbox" <?php if(get_option('wc_call_for_price__show_uploaded_image') == 'on') echo 'checked'; ?> id='wc_call_for_price__show_uploaded_image' name='wc_call_for_price__show_uploaded_image'>
            <p class="help-block"><?php esc_html_e( 'Check this box if you want to show your uploaded image.', 'wc-call-for-price' ); ?></p>
        </div>
        <div  id='wc_call_for_price__upload_image_wrapper'>
            <?php if( ! empty( $upload_image_url ) ) : ?>
            <div class="wcp-uploaded-image-preview_wrapper">
                <img src="<?php echo esc_attr( $upload_image_url );?>" alt="">
            </div>
            <?php endif; ?>
            <div class="form-group" >
                <label for="wc_call_for_price__upload_image"><?php esc_html_e( 'Upload Your Image', 'wc-call-for-price' ); ?></label>
                <input
                    type="text"
                    id="wc_call_for_price__upload_image"
                    value="<?php echo esc_attr( $upload_image_url );?>"
                    name='wc_call_for_price__upload_image'
                    placeholder='input image url'
                    readonly
                />
                <input type='button' id='wc_call_for_price__upload_image_button' name='wc_call_for_price__upload_image_button' value='Upload' />
                <p class="help-block"><?php esc_html_e( 'If you want to upload your custom image, upload here.', 'wc-call-for-price' ); ?></p>
            </div>
        </div>
    </fieldset>
    <button type="submit" class="save-button" name='wcp-general-settings' value="wcp-general-settings"><?php esc_html_e( 'Save Settings', 'wc-call-for-price' ); ?></button>

</form>

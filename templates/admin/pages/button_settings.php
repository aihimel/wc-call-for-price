<?php
/**
 * Button settings page
 *
 * @since 1.4.0
 *
 */

// Security check
defined( 'ABSPATH' ) || die();

use WCPress\WCP\Constants;

$upload_image_url = get_option( Constants::UPLOADED_IMAGE_URL, '' );
$button_height = get_option( Constants::BUTTON_HEIGHT );
$button_width = get_option( Constants::BUTTON_WIDTH );
$button_alt_text = get_option( Constants::BUTTON_ALT_TEXT );
?>

<form class="" method="POST" action="">
    <?php wp_nonce_field( Constants::ADMIN_FORM_NONCE_ACTION, Constants::NONCE_FIELD_NAME ); ?>

    <fieldset>
      <legend><?php esc_html_e( 'Text', 'wc-call-for-price' ); ?></legend>
      <div class="checkbox">
          <label
            for="<?php echo esc_attr( Constants::SHOW_TEXT ); ?>"
          >
              <?php esc_html_e( 'Show Text', 'wc-call-for-price' ); ?>
          </label>
          <input
              type="checkbox"
              <?php if(get_option(Constants::SHOW_TEXT, Constants::OFF) == Constants::ON) echo 'checked'; ?>
              id="<?php echo esc_attr( Constants::SHOW_TEXT ); ?>"
              name="<?php echo esc_attr( Constants::SHOW_TEXT ); ?>"
              class="wcp-rquery"
              data-uncheck="#wc_call_for_price__show_image"
          >
          <p class="help-block"><?php esc_html_e( 'Check to show only text on a simple html button.', 'wc-call-for-price'); ?></p>
      </div>
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
            <input class="wcp-rquery" type="checkbox" <?php if(get_option('wc_call_for_price__show_image') == 'on') echo 'checked'; ?> id='wc_call_for_price__show_image' name='wc_call_for_price__show_image'>
            <p class="help-block">
                <?php esc_html_e( 'Check this box if you want to select an image form some specific list of "Call for price" images.', 'wc-call-for-price' ); ?>
            </p>
        </div>

        <div id='wc_call_for_price__images' style='display:none;'>

            <?php for($i = 1; $i <= 15; $i++) {?>

            <div class="radio">
                <?php
                  $image_title = '';
                  $image_path = WC_CALL_FOR_PRICE_PLUGIN_ROOT_PATH . '/assets/images/preset-buttons/cfp_'.$i.'.png';
                  $image_url = plugins_url('/wc-call-for-price/assets/images/preset-buttons/cfp_'.$i.'.png');
                  if ( function_exists( 'getimagesize') ) {
                    $sizes = getimagesize( $image_path );
                    if ( ! empty( $sizes ) ) {
	                    $image_title = $sizes[0] . 'px * ' . $sizes[1] . 'px';
                    }
                  }
                ?>
                <input type="radio" name="wc_call_for_price__image" id="wc_call_for_price__image_<?php echo $i; ?>" value="cfp_<?php echo $i; ?>" <?php if('cfp_'.$i == get_option('wc_call_for_price__image')) echo 'checked';?> >
                <img
                  src='<?php echo esc_attr( $image_url ); ?>'
                  title="<? echo esc_attr( $image_title ); ?>"
                />

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
            <div class="wcp-uploaded-image-preview_wrapper">
                <?php if( empty( $upload_image_url ) ) : ?>
                    <img src="<?php echo esc_attr( $upload_image_url );?>" id="wc_call_for_price_image_preview">
                <?php else: ?>
                    <img src="<?php echo esc_attr( $upload_image_url );?>" alt="<?php echo esc_attr( 'Button Image', 'wc-call-for-price' ); ?>" id="wc_call_for_price_image_preview">
                <?php endif; ?>
            </div>
            <div class="form-group" >
                <label for="wc_call_for_price__upload_image"><?php esc_html_e( 'Upload Your Image', 'wc-call-for-price' ); ?></label>
                <input
                    type="hidden"
                    id="wc_call_for_price__upload_image"
                    value="<?php echo esc_attr( $upload_image_url );?>"
                    name='wc_call_for_price__upload_image'
                    placeholder="<?php esc_attr_e( 'Input Image URL', 'wc-call-for-price' ); ?>"
                    readonly
                />
                <input type='button' id='wc_call_for_price__upload_image_button' name='wc_call_for_price__upload_image_button' value='Upload' />
                <p class="help-block"><?php esc_html_e( 'If you want to upload your custom image, upload here.', 'wc-call-for-price' ); ?></p>
            </div>
        </div>
    </fieldset>

    <fieldset>
        <legend><?php esc_html_e( 'Button Attributes', 'wc-call-for-price' ); ?></legend>
        <div>
            <label for="wcp-button-height">
                <?php esc_html_e( 'Button Height' ); ?>:
            </label>
            <input
                type="number"
                id="wcp-button-height"
                value="<?php echo esc_attr( $button_height ); ?>"
                name="<?php echo esc_attr( Constants::BUTTON_HEIGHT ); ?>"
            />
            <p class="help-block"><?php esc_html_e( 'Button height in pixel', 'wc-call-for-price' ); ?></p>
        </div>
        <div>
            <label for="wcp-button-width">
                <?php esc_html_e( 'Button Width' ); ?>:
            </label>
            <input
                type="number"
                id="wcp-button-width"
                value="<?php echo esc_attr( $button_width ); ?>"
                name="<?php echo esc_attr( Constants::BUTTON_WIDTH ); ?>"
            />
            <p class="help-block">
                <?php esc_html_e( 'Button width in pixel', 'wc-call-for-price' ); ?>
            </p>
        </div>
        <div>
            <label for="wcp-button-alt-text">
                <?php esc_html_e( 'Button Title Text' ); ?>:
            </label>
            <input
                type="text"
                id="wcp-button-alt-text"
                value="<?php echo esc_attr( $button_alt_text ); ?>"
                name="<?php echo esc_attr( Constants::BUTTON_ALT_TEXT ); ?>"
            />
            <p class="help-block"><?php esc_html_e('Button alt attribute text', 'wc-call-for-price'); ?></p>
        </div>
    </fieldset>

    <button
            type="submit"
            class="save-button"
            name="<?php echo esc_attr( wcp_get_admin_sub_page_slug() ); ?>"
            value="<?php echo esc_attr( Constants::WCP_SUB_PAGE_GENERAL_SETTINGS ); ?>"
    >
        <?php esc_html_e( 'Save Settings', 'wc-call-for-price' ); ?>
    </button>

</form>

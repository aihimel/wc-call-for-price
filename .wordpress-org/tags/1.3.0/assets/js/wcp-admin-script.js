/**
 * Admin JS file for form input manipulation
 *
 * @since 1.0.0
 */
(($) => {
$(document).ready(() => {

    let text = $('#wc_call_for_price__text');
    let show_image = $('#wc_call_for_price__show_image');
    let uploaded_image = $('#wc_call_for_price__show_uploaded_image');

    let images = $('#wc_call_for_price__images');
    let upload_image_wrapper = $('#wc_call_for_price__upload_image_wrapper');

    // At initial Stage
    if( show_image.is(':checked') ) {
        images.show();
    } else {
        images.hide();
    }
    if( uploaded_image.is(':checked') ) {
        upload_image_wrapper.show();
    } else {
        upload_image_wrapper.hide();
    }


    text.on('keyup', () => {
        show_image.prop( 'checked', false );
        uploaded_image.prop( 'checked', false );
        images.slideUp('slow');
        upload_image_wrapper.slideUp('slow');
    });

    show_image.on('change', () => {
        if( show_image.is(':checked') ) {
            uploaded_image.prop( 'checked', false );
            images.slideDown('slow');
            upload_image_wrapper.slideUp('slow');
        } else {
            images.slideUp('slow');
        }
    });

    uploaded_image.on('change', () => {
        if( uploaded_image.is(':checked') ) {
            show_image.prop( 'checked', false );
            images.slideUp('slow');
            upload_image_wrapper.slideDown('slow');
        } else {
            upload_image_wrapper.slideUp('slow');
        }
    });

    // Upload from media
        $('#wc_call_for_price__upload_image_button').click(function(e){
        e.preventDefault();
        let image = wp.media({title: 'Upload Image', multiple: false}).open().on('select', function(e){
            let uploaded_image = image.state().get('selection').first();
            $('#wc_call_for_price__upload_image').val(uploaded_image.attributes.url);
        });
    });

});

})(jQuery)
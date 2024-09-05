/**
 * Admin JS file for form input manipulation
 *
 * @since 1.0.0
 */
(($) => {
$(document).ready(() => {

    let show_text = $('#wc_call_for_price__show_text');
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

    show_text.on('change', () => {
        if( show_text.is(':checked') ) {
            show_image.prop( 'checked', false );
            uploaded_image.prop( 'checked', false );    
            images.slideUp('slow');
            upload_image_wrapper.slideUp('slow');
        }
    });

    text.on('keyup', () => {
        show_image.prop( 'checked', false );
        uploaded_image.prop( 'checked', false );
        images.slideUp('slow');
        upload_image_wrapper.slideUp('slow');
    });

    show_image.on('change', () => {
        if( show_image.is(':checked') ) {
            show_text.prop( 'checked', false );
            uploaded_image.prop( 'checked', false );
            images.slideDown('slow');
            upload_image_wrapper.slideUp('slow');
        } else {
            images.slideUp('slow');
        }
    });

    uploaded_image.on('change', () => {
        if( uploaded_image.is(':checked') ) {
            show_text.prop( 'checked', false );
            show_image.prop( 'checked', false );
            images.slideUp('slow');
            upload_image_wrapper.slideDown('slow');
        } else {
            upload_image_wrapper.slideUp('slow');
        }
    });

    // Show Uploaded Image from media
    $('#wc_call_for_price__upload_image_button').on('click', function(e) {
        e.preventDefault();
        
        let imageFrame = wp.media({
            title: 'Select or Upload Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });
    
        imageFrame.on('select', function() {
            let attachment = imageFrame.state().get('selection').first().toJSON();
            let imageUrl = attachment.url;
    
            $('#wc_call_for_price__upload_image').val(imageUrl);
            $('#wc_call_for_price_image_preview').attr('src', imageUrl).show();
        });
    
        imageFrame.open();
    });

    // General Settings
    let only_on_empty_price = $('#wcp-only-empty-price');
    let show_on_all_products = $('#wcp-show-on-all-products');

    only_on_empty_price.on( 'change', function(){
        if(this.checked) {
            show_on_all_products.prop('checked', false);
        }
    });
    show_on_all_products.on( 'change', function(){
        if(this.checked) {
            only_on_empty_price.prop('checked', false);
        }
    });

    $('.wcp-rquery').rQuery({})

    // Rules Taxonomy Select2
    // $('#wcp_category').select2();
    $('#wcp_tags').select2({
        placeholder: "Select tags",
        width: "100%",
        closeOnSelect: false,
        // minimumInputLength: 1
    });

});


    /**
     * A New jQuery Plugin to accommodate UI effects
     *
     * `data-` fields status by name
     * ** First one is the other's status and the last one is current elements status
     *
     * check-on-check
     * check-on-uncheck
     * uncheck-on-uncheck
     * hide-on-check
     * hide-on-uncheck
     * show-on-check
     * show-on-uncheck
     * disable-on-check
     * disable-on-uncheck
     * enable-on-check
     * enable-on-uncheck
     * required-on-check
     * required-on-uncheck
     * optional-on-check
     * optional-on-uncheck
     * empty-on-check
     * empty-on-uncheck
     *
     * check-on-keyup
     * uncheck-on-keyup
     * disable-on-keyup
     * empty-on-keyup
     *
     * @param options
     *
     */
    $.fn.rQuery = function( options = {} ) {
    this.each(function(){

        let update_data = function() {
            if($(this).is(':checked')) { // element is checked
                // Check
                $( $(this).data('check-on-check') ).prop( 'checked', true );
                // Uncheck
                $( $(this).data('uncheck-on-check') ).prop( 'checked', false );
                // Hide
                $( $(this).data('hide-on-check') ).hide();
                // Show
                $( $(this).data('show-on-check') ).show();
                // Disable
                $( $(this).data('disable-on-check') ).prop( 'disabled', true );
                // Enable
                $( $(this).data('enable-on-check') ).prop( 'disabled', false );
                // Required
                $( $(this).data('required-on-check') ).prop( 'required', true );
                // Optional
                $( $(this).data('optional-on-check') ).prop( 'required', false );
                // Empty
                $( $(this).data('empty-on-check') ).val('');
            } else { // element is unchecked
                // Check
                $( $(this).data('check-on-uncheck') ).prop( 'checked', true );
                // Uncheck
                $( $(this).data('uncheck-on-uncheck') ).prop( 'checked', false );
                // Hide
                $( $(this).data('hide-on-uncheck') ).hide();
                // Show
                $( $(this).data('show-on-uncheck') ).show();
                // Disable
                $( $(this).data('disable-on-uncheck') ).prop( 'disabled', true );
                // Enable
                $( $(this).data('enable-on-uncheck') ).prop( 'disabled', false );
                // Required
                $( $(this).data('required-on-uncheck') ).prop( 'required', true );
                // Optional
                $( $(this).data('optional-on-uncheck') ).prop( 'required', false );
                // Empty
                $( $(this).data('empty-on-uncheck') ).val('');
            }
        }
        update_data();
        $(this).on('change', update_data)
    });
}
})(jQuery)
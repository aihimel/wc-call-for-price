jQuery('#wc_call_for_price__text').ready(function(){
    jQuery('#wc_call_for_price__text').keyup(function(){

        jQuery('#wc_call_for_price__show_image').attr('checked', false);
        jQuery('#wc_call_for_price__images').slideUp('slow');

        jQuery('#wc_call_for_price__show_uploaded_image').attr('checked', false);
        jQuery('#wc_call_for_price__upload_image_wrapper').slideUp('slow');
    });
});

jQuery('#wc_call_for_price__images').ready(function(){
    if(jQuery('#wc_call_for_price__show_image').is(':checked')) jQuery('#wc_call_for_price__images').show();
});

jQuery('#wc_call_for_price__upload_image_wrapper').ready(function(){
    if(jQuery('#wc_call_for_price__show_uploaded_image').is(':checked')) jQuery('#wc_call_for_price__upload_image_wrapper').show();
    else jQuery('#wc_call_for_price__upload_image_wrapper').hide()
});

jQuery('#wc_call_for_price__show_image').click(function(){
    if(jQuery('#wc_call_for_price__show_image').is(':checked')) {
        jQuery('#wc_call_for_price__images').slideDown('slow');
        jQuery('#wc_call_for_price__show_uploaded_image').attr('checked', false);
        jQuery('#wc_call_for_price__upload_image_wrapper').slideUp('slow');
    } else {
        jQuery('#wc_call_for_price__images').slideUp('slow');
    }
});

jQuery(document).ready(function(){
    jQuery('#wc_call_for_price__upload_image_button').click(function(e){
        e.preventDefault();
        var image = wp.media({title: 'Upload Image', multiple: false}).open().on('select', function(e){
            var uploaded_image = image.state().get('selection').first();
            jQuery('#wc_call_for_price__upload_image').val(uploaded_image.attributes.url);
        });
    });
});

jQuery(document).ready(function(){
    jQuery('#wc_call_for_price__show_uploaded_image').click(function(){
        if(jQuery('#wc_call_for_price__show_uploaded_image').is(':checked')){
            jQuery('#wc_call_for_price__show_image').attr('checked', false);
            jQuery('#wc_call_for_price__images').slideUp('slow');
            jQuery('#wc_call_for_price__upload_image_wrapper').slideDown('slow');
        } else jQuery('#wc_call_for_price__upload_image_wrapper').slideUp('slow');
    });
});
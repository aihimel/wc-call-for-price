<?php

// Cheacking Direct Access
defined('ABSPATH') or die('<h1>404</h1> Page not found.');

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

?>
<style>
	.header-blue{
		color: #2CCBE2;
		margin: 20px;
		padding 20px;
		text-align: center;
	}
	
	footer{
		
		text-align: center;
		margin: 5px;
		padding: 5px;
		
	}
</style>
<div class='container-fluid'>

	<div class='row-fluid'>

		<div class='xs-col-12 sm-col-12 md-col-6 lg-col-6 text-center'>
			<h3 class='header-blue'>WC Call For Price</h3>
		</div>

		<div class='xs-col-12 sm-col-12 md-col-6 lg-col-6'>

			<form class='form-inline'method='post' action=''>

				<div class="form-group">
					<label for="wc_call_for_price__text">Text To Show : </label>
					<input type="text" class="form-control" id="wc_call_for_price__text" name='wc_call_for_price__text' value='<?php echo get_option('wc_call_for_price__text');?>'>
					<p class="help-block">Write here what you want to see on front end. Plain text or HTML.</p>
				</div>

				<br />
				<br />

				<div class="checkbox">
					<label for='wc_call_for_price__show_image'><b> Show Image : </b></label>
					<input type="checkbox" <?php if(get_option('wc_call_for_price__show_image') == 'on') echo 'checked'; ?> id='wc_call_for_price__show_image' name='wc_call_for_price__show_image'>
					<p class="help-block">Check this box if you want to select an image form some specific list of "Call for price" images.</p>
				</div>

				<div id='wc_call_for_price__images' style='display:none;'>

					<?php for($i = 1; $i <= 15; $i++) {?>

					<div class="radio">
						<label>
							<input type="radio" name="wc_call_for_price__image" id="wc_call_for_price__image_<?php echo $i; ?>" value="cfp_<?php echo $i; ?>" <?php if('cfp_'.$i == get_option('wc_call_for_price__image')) echo 'checked';?> >
								<img src='<?php echo plugins_url('/wc-call-for-price/images/cfp_'.$i.'.png'); ?>' />
						</label>
					</div>

					<?php } ?>
					<p class="help-block">Cheack any one form here.</p>
				</div>

				<br />
				<br />

				<div class="checkbox">
					<label for='wc_call_for_price__show_uploaded_image'><b> Show Uploaded Image : </b></label>
					<input type="checkbox" <?php if(get_option('wc_call_for_price__show_uploaded_image') == 'on') echo 'checked'; ?> id='wc_call_for_price__show_uploaded_image' name='wc_call_for_price__show_uploaded_image'>
					<p class="help-block">Check this box if you want to show your uploaded image.</p>
				</div>

				<br />
				<br />

				<div  id='wc_call_for_price__upload_image_wrapper'>
				<div class="form-group" >
					<label for="wc_call_for_price__upload_image">Upload Your Image</label>
					<input type="text" id="wc_call_for_price__upload_image" name='wc_call_for_price__upload_image'  placeholder='input image url' />
					<input type='button' id='wc_call_for_price__upload_image_button' name='wc_call_for_price__upload_image_button' value='Upload' />
					<p class="help-block">If you want to upload your custom image, upload here.</p>
				</div>
				</div>

				<script>

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
				</script>

				<br/>
				<br/>

				<button type="submit" class="btn btn-primary">Save Settings</button>

			</form>

		</div>

	</div>
	
	<footer>
		Don'f forget to leave us a <a href='https://wordpress.org/support/view/plugin-reviews/wc-call-for-price'>review</a>. If you find anything difficult jsut ask <a href='https://wordpress.org/support/plugin/wc-call-for-price'>here</a>.
	</footer>
	
</div>

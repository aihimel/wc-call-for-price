<?php
/**
 * Saves admin form
 *
 * @since 1.4.0
 */
namespace WCPress\WCP;

defined( 'ABSPATH' ) || exit;

/**
 * Saves admin from submitted via post
 *
 * @since 1.5.1 Segregated option update function to be reused in pro addon
 */
class AdminFormSave {

	use SaveAdminSettingsTrait;

	/**
	 * Initializes the admin form save object
	 *
	 * @since 1.4.0
	 */
    public function __construct() {
        add_action( 'wcp_admin_form_header', [ $this, 'process_post_request' ] );

        // Form Processing
        add_action( 'wcp_process_admin_form_' . Constants::WCP_SUB_PAGE_GENERAL_SETTINGS, [ $this, 'save_general_settings' ] );
        add_action( 'wcp_process_admin_form_' . Constants::WCP_SUB_PAGE_BUTTON_SETTINGS, [ $this, 'save_button_settings' ] );
        add_action( 'wcp_process_admin_form_' . Constants::WCP_SUB_PAGE_RULES_SETTINGS, [ $this, 'save_rule_settings' ] );
        add_action( 'wcp_process_admin_form_' . Constants::WCP_SUB_PAGE_ACTIONS_SETTINGS, [ $this, 'save_action_settings' ] );
    }

    /**
     * Process admin settings post request
     *
     * @since 1.4.0
     *
     * @param string $admin_sub_page_slug
     *
     * @return void
     */
    public function process_post_request( string $admin_sub_page_slug ) {

        if ( ! empty( $_POST[ $admin_sub_page_slug ] ) ) {
            if (
                isset( $_POST[ Constants::NONCE_FIELD_NAME ] )
                && wp_verify_nonce( $_POST[ Constants::NONCE_FIELD_NAME ], Constants::ADMIN_FORM_NONCE_ACTION )
                && current_user_can( 'manage_options' )
        ) {
                do_action( "wcp_process_admin_form_$admin_sub_page_slug", $admin_sub_page_slug );
                // @TODO Post a success message that the data is saved properly
            } else { // phpcs:ignore
                // @TODO Post an unsuccessful message
            }

        }
    }

    /**
     * Saves General Settings page's form
     *
     * @since 1.4.0
     *
     * @param string $form_slug
     *
     * @return void
     */
    public function save_general_settings( string $form_slug ) { // phpcs:ignore
        $this->update_checkbox( Constants::WCP_ACTIVATE );
        $this->update_checkbox( Constants::ONLY_EMPTY_PRICE );
        $this->update_checkbox( Constants::SHOW_ON_ALL_PRODUCTS );
    }


    /**
     * Saves Button Settings from admin dashboard
     *
     * @since 1.4.0
     *
     * @param string $form_slug
     *
     * @return void
     */
    public function save_button_settings( string $form_slug ) { // phpcs:ignore
		$this->update_checkbox( Constants::SHOW_TEXT );
	    $this->update_text( Constants::TEXT );

        $this->update_checkbox( Constants::SHOW_PRESET_IMAGE );
        $this->update_checkbox( Constants::SHOW_UPLOADED_IMAGE );

        $this->update_filename( Constants::PRESET_IMAGE_NAME );
        $this->update_url( Constants::UPLOADED_IMAGE_URL );

        $this->update_number( Constants::BUTTON_HEIGHT );
        $this->update_number( Constants::BUTTON_WIDTH );

        $this->update_text( Constants::BUTTON_ALT_TEXT );
    }

    /**
     * Saves Rule Settings admin dashboard settings
     *
     * @since 1.4.0
     *
     * @param string $form_slug
     *
     * @return void
     */
    public function save_rule_settings( string $form_slug ) { // phpcs:ignore
        // Inside the save stock settings method
        $this->update_checkbox( Constants::OUT_OF_STOCK );
        $this->update_checkbox( Constants::MINIMUM_STOCK_THRESHOLD );
        $this->update_number( Constants::BELOW_STOCK_AMOUNT );

        // Inside the save taxonomy settings method
        $this->update_checkbox( Constants::ENABLE_TAXONOMY );
        $this->update_text( Constants::CATEGORY );
        $this->update_multiselect( Constants::TAGS );
    }

    /**
     * Saves Action Settings Admin Dashboard form
     *
     * @since 1.4.0
     *
     * @param string $form_slug
     *
     * @return void
     */
    public function save_action_settings( string $form_slug ) { // phpcs:ignore
        $this->update_checkbox( Constants::REDIRECT_TO );
		if ( wcp_is_on( Constants::REDIRECT_TO ) ) {
			$this->update_checkbox( Constants::OPEN_NEW_PAGE );
			$this->update_url( Constants::REDIRECT_LINK );
		} else {
			$this->flush_data( Constants::OPEN_NEW_PAGE );
			$this->flush_data( Constants::REDIRECT_LINK );
		}
    }
}

<?php
/**
 * Saves admin form
 *
 * @since 1.4.0
 */

namespace WCPress\WCP;

class AdminFormSave {

    function __construct() {

        add_action( 'wcp_admin_form_header', [ $this, 'process_post_request' ] );

        // Form Processing
        add_action( "wcp_process_admin_form_" . Constants::WCP_SUB_PAGE_GENERAL_SETTINGS, [ $this, 'save_general_settings' ] );
        add_action( "wcp_process_admin_form_" . Constants::WCP_SUB_PAGE_BUTTON_SETTINGS, [ $this, 'save_button_settings' ] );
        add_action( "wcp_process_admin_form_" . Constants::WCP_SUB_PAGE_RULES_SETTINGS, [ $this, 'save_rule_settings' ] );
        add_action( "wcp_process_admin_form_" . Constants::WCP_SUB_PAGE_ACTIONS_SETTINGS, [ $this, 'save_action_settings' ] );
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
    function process_post_request( $admin_sub_page_slug ) {

        if ( ! empty( $_POST[ $admin_sub_page_slug ] ) ) {
            if(
                isset( $_POST[ Constants::NONCE_FIELD_NAME ] )
                && wp_verify_nonce( $_POST[ Constants::NONCE_FIELD_NAME ], Constants::ADMIN_FORM_NONCE_ACTION )
                && current_user_can( 'manage_options' )
        ) {
                do_action( "wcp_process_admin_form_{$admin_sub_page_slug}", $admin_sub_page_slug );
                // @TODO Post a success message that the data is saved properly
            } else {
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
    function save_general_settings( $form_slug ) {
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
    function save_button_settings( $form_slug ) {
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
    function save_rule_settings( $form_slug ) {
        $this->update_checkbox( Constants::OUT_OF_STOCK );
        $this->update_checkbox( Constants::MINIMUM_STOCK_THRESHOLD );

        $this->update_number( Constants::BELOW_STOCK_AMOUNT );
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
    function save_action_settings( $form_slug ) {
        $this->update_checkbox( Constants::REDIRECT_TO );
        $this->update_checkbox( Constants::OPEN_NEW_PAGE );

        $this->update_url( Constants::REDIRECT_LINK );
    }

    /**
     * Updates checkbox options using default on/off
     *
     * @since 1.4.0
     *
     * @param string $input_name
     *
     * @return void
     */
    protected function update_checkbox( $input_name ) {
        $value = ! empty( $_POST[ $input_name ] ) ? Constants::ON: Constants::OFF;
        update_option( $input_name, $value );
    }

    /**
     * Updated text from with sanitization
     *
     * @since 1.4.0
     *
     * @param string $input_name
     *
     * @return void
     */
    protected function update_text( $input_name ) {
        $value = ! empty( $_POST[ $input_name ] ) ? sanitize_text_field( $_POST[ $input_name ] ): '';
        update_option( $input_name, $value );
    }

    /**
     * Updates filename options
     *
     * @since 1.4.0
     *
     * @param string $input_name
     *
     * @return void
     */
    protected function update_filename( $input_name ) {
        $value = ! empty( $_POST[ $input_name ] ) ? sanitize_file_name( $_POST[ $input_name ] ): '';
        update_option( $input_name, $value );
    }

    /**
     * Update URL options
     *
     * @since 1.4.0
     *
     * @param string $input_name
     *
     * @return void
     */
    protected function update_url( $input_name ) {
        $value = ! empty( $_POST[ $input_name ] ) ? sanitize_url( $_POST[ $input_name ] ): '';
        update_option( $input_name, $value );
    }

    /**
     * Updates number options
     *
     * @since 1.4.0
     *
     * @param string $input_name
     *
     * @return void
     */
    protected function update_number( $input_name ) {
        $value = ! empty( $_POST[ $input_name ] ) ? sanitize_text_field( $_POST[ $input_name ] ): '';
        $value = absint( $value );
        update_option( $input_name, $value );
    }
}
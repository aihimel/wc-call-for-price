<?php
/**
 * Saves admin form
 *
 * @since 1.3.1
 */

namespace WCPress\WCP;

use Automattic\WooCommerce\Internal\DependencyManagement\ContainerException;

class AdminFormSave {

    function __construct() {

        add_action( 'wcp_admin_form_header', [ $this, 'process_post_request' ] );

        // Form Processing
        add_action( "wcp_process_admin_form_" . Constants::WCP_SUB_PAGE_GENERAL_SETTINGS, [ $this, 'save_general_settings' ] );
        add_action( "wcp_process_admin_form_" . Constants::WCP_SUB_PAGE_BUTTON_SETTINGS, [ $this, 'save_button_settings' ] );
        add_action( "wcp_process_admin_form_" . Constants::WCP_SUB_PAGE_RULES_SETTINGS, [ $this, 'save_rule_settings' ] );
        add_action( "wcp_process_admin_form_" . Constants::WCP_SUB_PAGE_ACTIONS_SETTINGS, [ $this, 'save_action_settings' ] );
    }

    function process_post_request( $admin_sub_page_slug ) {

        if ( ! empty( $_POST[ $admin_sub_page_slug ] ) ) {
            // Check nonce
            // Call variable actions
            do_action( "wcp_process_admin_form_{$admin_sub_page_slug}", $admin_sub_page_slug );

        }
    }

    function save_general_settings( $form_slug ) {
        $this->update_checkbox( Constants::WCP_ACTIVATE );
        $this->update_checkbox( Constants::ONLY_EMPTY_PRICE );
        $this->update_checkbox( Constants::SHOW_ON_ALL_PRODUCTS );

        $this->update_text( Constants::TEXT );
    }

    function save_button_settings( $form_slug ) {
        $this->update_checkbox( Constants::SHOW_PRESET_IMAGE );
        $this->update_checkbox( Constants::SHOW_UPLOADED_IMAGE );

        $this->update_filename( Constants::PRESET_IMAGE_NAME );
        $this->update_url( Constants::UPLOADED_IMAGE_URL );

        $this->update_number( Constants::BUTTON_HEIGHT );
        $this->update_number( Constants::BUTTON_WIDTH );

        $this->update_text( Constants::BUTTON_ALT_TEXT );
    }

    function save_rule_settings( $form_slug ) {
        $this->update_checkbox( Constants::OUT_OF_STOCK );
        $this->update_checkbox( Constants::MINIMUM_STOCK_THRESHOLD );

        $this->update_number( Constants::BELOW_STOCK_AMOUNT );
    }

    function save_action_settings( $form_slug ) {
        $this->update_checkbox( Constants::REDIRECT_TO );
        $this->update_checkbox( Constants::OPEN_NEW_PAGE );

        $this->update_url( Constants::REDIRECT_LINK );
    }

    protected function update_checkbox( $input_name ) {
        $value = ! empty( $_POST[ $input_name ] ) ? Constants::ON: Constants::OFF;
        update_option( $input_name, $value );
    }

    protected function update_text( $input_name ) {
        $value = ! empty( $_POST[ $input_name ] ) ? sanitize_text_field( $_POST[ $input_name ] ): '';
        update_option( $input_name, $value );
    }

    protected function update_filename( $input_name ) {
        $value = ! empty( $_POST[ $input_name ] ) ? sanitize_file_name( $_POST[ $input_name ] ): '';
        update_option( $input_name, $value );
    }

    protected function update_url( $input_name ) {
        $value = ! empty( $_POST[ $input_name ] ) ? sanitize_url( $_POST[ $input_name ] ): '';
        update_option( $input_name, $value );
    }

    protected function update_number( $input_name ) {
        $value = ! empty( $_POST[ $input_name ] ) ? sanitize_text_field( $_POST[ $input_name ] ): '';
        $value = absint( $value );
        update_option( $input_name, $value );
    }

}
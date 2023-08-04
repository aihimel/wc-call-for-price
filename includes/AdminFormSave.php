<?php
/**
 * Saves admin form
 *
 * @since 1.3.1
 */

namespace WCPress\WCP;

class AdminFormSave {

    function __construct() {

        add_action( 'wcp_admin_form_header', [ $this, 'process_post_request' ] );

        // Form Processing
        add_action( "wcp_process_admin_form_" . Constants::WCP_SUB_PAGE_GENERAL_SETTINGS, [ $this, 'save_general_settings' ] );

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

        $this->update_checkbox( Constants::SHOW_PRESET_IMAGE );

        $this->update_checkbox( Constants::SHOW_UPLOADED_IMAGE );

    }

    protected function update_checkbox( $input_name ) {
        $value = ! empty( $_POST[ $input_name ] ) ? Constants::ON: Constants::OFF;
        update_option( $input_name, $value );
    }

}
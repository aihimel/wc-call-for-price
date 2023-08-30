<?php

namespace WCPress\WCP;

trait SaveSettingsTrait {

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

}
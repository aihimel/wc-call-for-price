<?php
namespace WCPress\WCP;

defined( 'ABSPATH' ) || exit;

/**
 * Admin settings save methods to be used on free and pro plugin
 *
 * @since 1.5.1
 */
trait SaveAdminSettingsTrait {
	/**
	 * Updates checkbox options using default on/off
	 *
	 * @since 1.5.1
	 *
	 * @param string $input_name
	 *
	 * @return void
	 */
	protected function update_checkbox( string $input_name ) {
		$value = ! empty( $_POST[ $input_name ] ) ? Constants::ON : Constants::OFF; // phpcs:ignore
		update_option( $input_name, $value );
	}

	/**
	 * Updated text from with sanitization
	 *
	 * @since 1.5.1
	 *
	 * @param string $input_name
	 *
	 * @return void
	 */
	protected function update_text( string $input_name ) {
		$value = ! empty( $_POST[ $input_name ] ) ? sanitize_text_field( wp_unslash( $_POST[ $input_name ] ) ): ''; // phpcs:ignore
		update_option( $input_name, $value );
	}

	/**
	 * Updated multiselect from with sanitization
	 *
	 * @since 1.5.1
	 *
	 * @param string $input_name
	 *
	 * @return void
	 */
	protected function update_multiselect( string $input_name ) {
		$value = ! empty( $_POST[ $input_name ] ) ? wp_unslash( $_POST[ $input_name ] ) : []; // phpcs:ignore
		update_option( $input_name, array_map( 'sanitize_text_field', $value ) );
	}

	/**
	 * Updates filename options
	 *
	 * @since 1.5.1
	 *
	 * @param string $input_name
	 *
	 * @return void
	 */
	protected function update_filename( string $input_name ) {
		$value = ! empty( $_POST[ $input_name ] ) ? sanitize_file_name( wp_unslash( $_POST[ $input_name ] ) ): ''; // phpcs:ignore
		update_option( $input_name, $value );
	}

	/**
	 * Update URL options
	 *
	 * @since 1.5.1
	 *
	 * @param string $input_name
	 *
	 * @return void
	 */
	protected function update_url( string $input_name ) {
		$value = ! empty( $_POST[ $input_name ] ) ? sanitize_url( wp_unslash( $_POST[ $input_name ] ) ): ''; // phpcs:ignore
		update_option( $input_name, $value );
	}

	/**
	 * Updates number options
	 *
	 * @since 1.5.1
	 *
	 * @param string $input_name
	 *
	 * @return void
	 */
	protected function update_number( string $input_name ) {
		$value = ! empty( $_POST[ $input_name ] ) ? sanitize_text_field( wp_unslash( $_POST[ $input_name ] ) ): ''; // phpcs:ignore
		$value = absint( $value );
		update_option( $input_name, $value );
	}

	/**
	 * Clears data for the specific option
	 *
	 * @since 1.5.1
	 *
	 * @param string $input_name
	 *
	 * @return void
	 */
	protected function flush_data( string $input_name ) {
		update_option( $input_name, '' );
	}
}

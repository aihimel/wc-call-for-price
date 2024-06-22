<?php
namespace WCPress\WCP\Models;

use WCPress\WCP\Models\Interfaces\DefaultDataInterface;

/**
 * A Class to hold all activation/deactivation related data in one place
 *
 * @since 1.4.3
 */
class ActivationDeactivation extends Model implements DefaultDataInterface {

	/**
	 * Option key name
	 *
	 * @since 1.4.3
	 */
	const KEY = 'wcp_activation_deactivation_data';
	/**
	 * First time activation data
	 *
	 * @since 1.4.3
	 */
	const FIRST_ACTIVATED_AT = 'first_activated_at';
	/**
	 * Multiple time activation deactivation list key
	 *
	 * @since 1.4.3
	 */
	const ACTIVATION_DEACTIVATION_LIST = 'activation_deactivation_list';
	/**
	 * Activation time key
	 *
	 * @since 1.4.3
	 */
	const ACTIVATED_AT = 'activated_at';
	/**
	 * Deactivation time key
	 *
	 * @since 1.4.3
	 */
	const DEACTIVATED_AT = 'deactivated_at';

	/**
	 * Returns the default activation deactivation data
	 *
	 * @since 1.4.3
	 *
	 * @return array
	 */
	public function get_default_data(): array {
		return array(
			self::FIRST_ACTIVATED_AT => wcp_current_time(),
			self::ACTIVATION_DEACTIVATION_LIST => array(
				array(
					self::ACTIVATED_AT => wcp_current_time(),
					self::DEACTIVATED_AT => 0,
				),
			),
		);
	}

	/**
	 * Runs when plugin is activated first time
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	public function activation() {
		$settings = get_option( self::KEY );
		if ( ! $settings ) {
			add_option( self::KEY, $this->get_default_data(), '', false );
		} else {
			$last_element_index = count( $settings[ self::ACTIVATION_DEACTIVATION_LIST ] ) - 1;
			$settings[ self::ACTIVATION_DEACTIVATION_LIST ][ $last_element_index ][ self::DEACTIVATED_AT ] = wcp_current_time();
			update_option( self::KEY, $settings );
		}
	}

	/**
	 * Runs when plugin is deactivated
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	public function deactivation() {
		// Settings deactivation time to the last element
		$settings = get_option( self::KEY, $this->get_default_data() );
		$last_element_index = count( $settings[ self::ACTIVATION_DEACTIVATION_LIST ] ) - 1;
		$settings[ self::ACTIVATION_DEACTIVATION_LIST ][ $last_element_index ][ self::DEACTIVATED_AT ] = wcp_current_time();
		update_option( self::KEY, $settings );
	}
}

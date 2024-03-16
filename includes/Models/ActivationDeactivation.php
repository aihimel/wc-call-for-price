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
	 * @since WCP_SINCE
	 */
	const KEY = 'wcp_activation_deactivation_data';
	/**
	 * First time activation data
	 *
	 * @since WCP_SINCE
	 */
	const FIRST_ACTIVATED_AT = 'first_activated_at';
	/**
	 * Multiple time activation deactivation list key
	 *
	 * @since WCP_SINCE
	 */
	const ACTIVATION_DEACTIVATION_LIST = 'activation_deactivation_list';
	/**
	 * Activation time key
	 *
	 * @since WCP_SINCE
	 */
	const ACTIVATED_AT = 'activated_at';
	/**
	 * Deactivation time key
	 *
	 * @since WCP_SINCE
	 */
	const DEACTIVATED_AT = 'deactivated_at';

	/**
	 * Returns the default activation deactivation data
	 *
	 * @since WCP_SINCE
	 *
	 * @return array
	 */
	public function getDefaultData(): array {
		return [
			self::FIRST_ACTIVATED_AT => wcp_current_time(),
			self::ACTIVATION_DEACTIVATION_LIST => [
				[
					self::ACTIVATED_AT => wcp_current_time(),
					self::DEACTIVATED_AT => 0
				]
			]
		];
	}

	/**
	 * Runs when plugin is activated first time
	 *
	 * @since WCP_SINCE
	 *
	 * @return void
	 */
	public function activation() {
		$settings = get_option( self::KEY );
		if ( ! $settings ) {
			add_option( self::KEY, $this->getDefaultData(), '', false );
		} else {
			$last_element_index = count( $settings[ self::ACTIVATION_DEACTIVATION_LIST ] ) - 1;
			$settings[ self::ACTIVATION_DEACTIVATION_LIST ][ $last_element_index ][ self::DEACTIVATED_AT ] = wcp_current_time();
			update_option( self::KEY, $settings );
		}
	}

	/**
	 * Runs when plugin is deactivated
	 *
	 * @since WCP_SINCE
	 *
	 * @return void
	 */
	public function deactivation() {
		// Settings deactivation time to the last element
		$settings = get_option( self::KEY, $this->getDefaultData() );
		$last_element_index = count( $settings[ self::ACTIVATION_DEACTIVATION_LIST ] ) - 1;
		$settings[ self::ACTIVATION_DEACTIVATION_LIST ][ $last_element_index ][ self::DEACTIVATED_AT ] = wcp_current_time();
		update_option( self::KEY, $settings );
	}
}
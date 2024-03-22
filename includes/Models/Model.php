<?php
namespace WCPress\WCP\Models;

use WCPress\WCP\Models\Interfaces\DefaultDataInterface;
use WCPress\WCP\Models\Interfaces\OptionKeyInterface;

/**
 * An abstract class to keep all common model functionality in one place
 *
 * @since 1.4.3
 */
abstract class Model implements OptionKeyInterface, DefaultDataInterface {
	/**
	 * Option data
	 *
	 * @since WCP_SINCE
	 *
	 * @var array
	 */
	protected $data = [];

	/**
	 * Fetches the option on object creation
	 *
	 * @since WCP_SINCE
	 *
	 * @return void
	 */
	public function __construct() {
		$this->data = get_option( $this->getOptionKey(), $this->getDefaultData() );
		$this->data = ( empty( $this->data ) || ! is_array( $this->data ) ) ? [] : $this->data; // For empty value
		$this->data = array_merge( $this->getDefaultData(), $this->data ); // For incomplete data
	}

	/**
	 * Return the name of the option key
	 *
	 * @since WCP_SINCE
	 *
	 * @return string
	 */
	public function getOptionKey(): string {
		return 'wcp_option_key';
	}

	/**
	 * Save option to DB
	 *
	 * @since WCP_SINCE
	 *
	 * @return void
	 */
	public function save() {
		update_option( $this->getOptionKey(), $this->data );
	}

	/**
	 * Returns default data for the options
	 *
	 * @since WCP_SINCE
	 *
	 * @return array
	 */
	public function getDefaultData(): array {
		return [];
	}
}
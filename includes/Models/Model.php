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
	 * @since 1.4.3
	 *
	 * @var array
	 */
	protected $data = array();

	/**
	 * Fetches the option on object creation
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	public function __construct() {
		$this->data = get_option( $this->get_option_key(), $this->get_default_data() );
		$this->data = ( empty( $this->data ) || ! is_array( $this->data ) ) ? array() : $this->data; // For empty value
		$this->data = array_merge( $this->get_default_data(), $this->data ); // For incomplete data
	}

	/**
	 * Return the name of the option key
	 *
	 * @since 1.4.3
	 *
	 * @return string
	 */
	public function get_option_key(): string {
		return 'wcp_option_key';
	}

	/**
	 * Save option to DB
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	public function save() {
		update_option( $this->get_option_key(), $this->data );
	}

	/**
	 * Returns default data for the options
	 *
	 * @since 1.4.3
	 *
	 * @return array
	 */
	public function get_default_data(): array {
		return array();
	}
}

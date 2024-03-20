<?php
namespace WCPress\WCP\Models;

use WCPress\WCP\Models\Interfaces\DefaultDataInterface;

/**
 * An abstract class to keep all common model functionality in one place
 *
 * @since 1.4.3
 */
abstract class Model implements DefaultDataInterface {

	/**
	 * Option key id
	 */
	const OPTION_KEY = 'option_key';

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
		$this->data = get_option( self::OPTION_KEY, $this->getDefaultData() );
	}

	/**
	 * Save option to DB
	 *
	 * @since WCP_SINCE
	 *
	 * @return void
	 */
	public function save() {
		update_option( self::OPTION_KEY, $this->data );
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
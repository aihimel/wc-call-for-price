<?php
namespace WCPress\WCP;
// @TODO Update all file packages
use WCPress\WCP\Models\ActivationDeactivation;

/**
 * Initializes the plugin
 *
 * @package wcpress\wcp
 *
 * @since 1.4.3
 */
final class Initilize {

	/**
	 * Holds shelf class object
	 *
	 * @since 1.4.3
	 *
	 * @var \WCPress\WCP\Initilize
	 */
	private static $self;

	/**
	 * Hidden constructor function
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	private function __construct() {
		$this->setDefaultValues();
	}

	/**
	 * Initializes the class object
	 *
	 * @since 1.4.3
	 *
	 * @return \WCPress\WCP\Initilize
	 */
	public static function init(): Initilize {
		if ( empty( Initilize::$self ) ) {
			Initilize::$self = new Initilize();
		}
		return Initilize::$self;
	}

	/**
	 * Sets default values if not available
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	protected function setDefaultValues() {
		/**
		 * Plugin feature activated if not set
		 */
		if ( ! get_option( Constants::WCP_ACTIVATE ) ) {
			update_option( Constants::WCP_ACTIVATE, Constants::ON );
		}
	}

	/**
	 * Adds plugin activation time
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	public function add_activation_time() {
		$activation_deactivation = new ActivationDeactivation();
		$activation_deactivation->activation();
	}
}
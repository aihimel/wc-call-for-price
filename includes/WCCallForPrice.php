<?php
namespace WCPress\WCP;
/**
 * Main Plugin class to load all the hooks and initialization
 *
 * @package wcpress\wcp
 *
 * @since 1.2.1
 */

final class WCCallForPrice {

	/**
	 * Holds shelf class object
	 *
	 * @since 1.4.0
	 *
	 * @var \WCPress\WCP\WCCallForPrice
	 */
    private static $self;

	/**
	 * Contains initialized objects
	 *
	 * @since WCP_SINCE
	 *
	 * @var array
	 */
	protected $container = [];

    /**
     * Initializes the plugin
     *
     * @since 1.4.0
     */
    private function __construct() {
		// @TODO Keep records of the initialized object
        Initilize::init();
	    new Assets();
		$this->container[ RulesConfiguration::INSTANCE_KEY ] = new RulesConfiguration();
	    new AdminMenu();
        new Upgrader();
        new AdminPageValidator();
        new AdminFormSave();
		new ReviewRequest();
        if ( get_option( Constants::WCP_ACTIVATE ) == Constants::ON ) {
            new Render();
        }
    }

    /**
     * Returns only the single instance of the main plugin class
     *
     * @since 1.4.0
     *
     * @return WCCallForPrice
     */
    public static function init() {
        if ( ! WCCallForPrice::$self ) {
            WCCallForPrice::$self = new WCCallForPrice();
        }
        return WCCallForPrice::$self;
    }

}
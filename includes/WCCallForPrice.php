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
     * Initializes the plugin
     *
     * @since 1.4.0
     */
    private function __construct() {
		new WooCommerceSupport();
		add_action( 'init', [ $this, 'load_plugin' ] );
    }

	/**
	 * Loads this plugin object
	 *
	 * @since 1.5.1
	 *
	 * @return void
	 */
	public function load_plugin() {
		// @TODO Keep records of the initialized object
		Initilize::init();
		new AdminMenu();
		new Assets();
		new Upgrader();
		new AdminPageValidator();
		new AdminFormSave();
		new ReviewRequest();
		if ( get_option( Constants::WCP_ACTIVATE ) === Constants::ON ) {
			new Render();
		}

		/**
		 * Signaling Free plugin is loaded and the pro plugin could be rendered
		 *
		 * @since 1.5.1
		 */
		do_action( 'wcp_free_plugin_loaded' );
	}

    /**
     * Returns only the single instance of the main plugin class
     *
     * @since 1.4.0
     *
     * @return WCCallForPrice
     */
    public static function init(): WCCallForPrice {
        if ( ! self::$self ) {
            self::$self = new WCCallForPrice();
        }
        return self::$self;
    }
}

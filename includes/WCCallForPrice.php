<?php
namespace WCPress\WCP;
/**
 * Main Plugin class to load all the hooks and initialization
 *
 * @since 1.2.1
 */

final class WCCallForPrice {

    static $self;

    /**
     * Initializes the plugin
     *
     * @since 1.4.0
     */
    private function __construct() {
        new AdminMenu();
        new Assets();
        new Upgrader();
        new AdminPageValidator();
        new AdminFormSave();
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
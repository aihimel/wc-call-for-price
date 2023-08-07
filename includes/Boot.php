<?php
/**
 * Main Plugin class to load all the hooks and initialization
 *
 * @since 1.2.1
 */

namespace WCPress\WCP;

final class Boot {

    static $self;

    /**
     * Initializes the plugin
     *
     * @since 1.3.1
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
     * @since 1.3.1
     *
     * @return Boot
     */
    public static function init() {
        if ( ! Boot::$self ) {
            Boot::$self = new Boot();
        }
        return Boot::$self;
    }

}
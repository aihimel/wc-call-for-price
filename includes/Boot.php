<?php
/**
 * Main Plugin class to load all the hooks and initialization
 *
 * @since 1.2.1
 */

namespace WCPress\WCP;

final class Boot {

    static $self = false;

    private function __construct() {
        new AdminMenu();
        new Assets();
        new Render();
    }
    public static function init() {
        if ( ! Boot::$self ) {
            Boot::$self = new Boot();
        }
        return Boot::$self;
    }

}
<?php
/**
 * Manages activities after upgrade
 *
 * @since WCP_SINCE
 */

namespace WCPress\WCP;

class Upgrader {

    function __construct() {
        add_action( 'upgrader_process_complete', [ $this, 'is_plugin_upgraded' ] );
        add_action( 'admin_init', [ $this, 'run_upgrade' ] );
    }

    function is_plugin_upgraded( $upgrader_object, $options ) {
        if(
            $options['action'] == 'update'
            && $options['type'] == 'plugin'
            && isset( $options['plugins'] )
        ) {
            foreach( $options['plugins'] as $plugin ) {
                if ( $plugin == WC_CALL_FOR_PRICE_PATH ) {
                    set_transient( Constants::WCP_RECENTLY_UPDATED, 1 );
                }
            }
        }
    }

    /**
     * Runs the upgrader when the plugin is upgraded
     *
     * @since WCP_SINCE
     *
     * @return void
     */
    function run_upgrade() {
        if( get_transient ( Constants::WCP_RECENTLY_UPDATED ) ) {
            delete_transient( Constants::WCP_RECENTLY_UPDATED );
            $this->updated_options();
        }
    }

    function updated_options() {

        // For existing users WCP_ACTIVATE should be activated
        if ( get_option( Constants::WCP_ACTIVATE, false ) ) {
            update_option( Constants::WCP_ACTIVATE, Constants::ON );
        }
    }

}
<?php
/**
 * Manages activities after upgrade
 *
 * @since 1.4.0
 */

namespace WCPress\WCP;

use WCPress\WCP\Models\ActivationDeactivation;

class Upgrader {

    /**
     * Initializes the object
     *
     * @since 1.3.0
     */
    function __construct() {
        add_action( 'upgrader_process_complete', [ $this, 'is_plugin_upgraded' ], 10, 2 );
        add_action( 'admin_init', [ $this, 'run_upgrade' ] );
    }

    /**
     * Decides it the plugin has been updated
     *
     * @since 1.3.0
     *
     * @param $upgrader_object
     * @param $options
     *
     * @return void
     */
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
     * @since 1.3.0
     *
     * @return void
     */
    function run_upgrade() {
        if( get_transient ( Constants::WCP_RECENTLY_UPDATED ) ) {
            delete_transient( Constants::WCP_RECENTLY_UPDATED );
            $this->updated_options();
			$this->add_activation_time();
        }
    }

    /**
     * Update Options after plugin update
     *
     * @since 1.3.0
     *
     * @return void
     */
    function updated_options() {
        // For existing users WCP_ACTIVATE should be activated
        if ( ! get_option( Constants::WCP_ACTIVATE ) ) {
            update_option( Constants::WCP_ACTIVATE, Constants::ON );
        }
    }

	/**
	 * Adds plugin activation time if not active
	 *
	 * @since 1.4.3
	 *
	 * @return void
	 */
	function add_activation_time() {
		$activation_deactivation = new ActivationDeactivation();
		$activation_deactivation->activation();
	}

}
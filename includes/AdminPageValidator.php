<?php
/**
 * Validates Admin Page
 *
 * @since 1.4.0
 */

namespace WCPress\WCP;

class AdminPageValidator {

    /**
     * Initializes the object
     *
     * @since 1.4.0
     */
    public function __construct() {
        add_filter( 'wcp_is_admin_subpage_valid', [ $this, 'is_admin_page_valid' ] );
    }

    /**
     * Check validity for admin page
     *
     * @since 1.4.0
     *
     * @param string $query_page_string
     *
     * @return bool
     */
    public function is_admin_page_valid( string $query_page_string ): bool {
        $list_of_admin_pages = [
            Constants::WCP_SUB_PAGE_GENERAL_SETTINGS,
            Constants::WCP_SUB_PAGE_BUTTON_SETTINGS,
            Constants::WCP_SUB_PAGE_RULES_SETTINGS,
            Constants::WCP_SUB_PAGE_ACTIONS_SETTINGS,

        ];
        $list_of_extended_admin_pages = apply_filters( 'wcp_list_of_admin_pages', $list_of_admin_pages );

        if ( in_array( $query_page_string, $list_of_extended_admin_pages, true ) ) {
            return true;
        } else {
            return false;
        }
    }
}

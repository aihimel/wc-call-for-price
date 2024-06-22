<?php
/**
 * Admin menu navigation
 *
 * @since 1.4.0
 */

use WCPress\WCP\Constants;

// Security Check
defined( 'ABSPATH' ) || die();

$admin_main_nav = apply_filters( 'wcp_admin_main_nav', [
    [
        'title' => __( 'General', 'wc-call-for-price' ),
        'slug' => Constants::WCP_SUB_PAGE_GENERAL_SETTINGS
    ],
    [
        'title' => __('Button', 'wc-call-for-price' ),
        'slug' => Constants::WCP_SUB_PAGE_BUTTON_SETTINGS
    ],
    [
        'title' => __('Rules', 'wc-call-for-price' ),
        'slug' => Constants::WCP_SUB_PAGE_RULES_SETTINGS
    ],
    [
        'title' => __('Actions', 'wc-call-for-price' ),
        'slug' => Constants::WCP_SUB_PAGE_ACTIONS_SETTINGS
    ],
] );

?>

<div class="wcp-admin-main-menu-wrapper">
    <ul>
        <?php foreach( $admin_main_nav as $single_nav ): ?>
        <li
          class="<?php echo checked( wcp_get_admin_sub_page_slug(), $single_nav['slug'], false) ? 'active' : ''?>"
        >
            <a
                href="<?php echo wcp_slug_to_admin_menu_url( $single_nav['slug'] ); ?>"
            >
                <?php echo esc_html( $single_nav['title'] ); ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
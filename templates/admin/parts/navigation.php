<?php
/**
 * Admin menu navigation
 *
 * @since 1.3.1
 */

use WCPress\WCP\Constants;

// Security Check
defined( 'ABSPATH' ) || die();

$admin_main_nav = apply_filters( 'wcp_admin_main_nav', [
    [
        'title' => __( 'General Settings', 'wc-call-for-price' ),
        'slug' => 'general_settings'
    ],
    [
        'title' => __('Stock Settings', 'wc-call-for-price' ),
        'slug' => 'stock-settings'
    ]
] );

?>

<div class="wcp-admin-main-menu-wrapper">
    <ul>
        <?php foreach( $admin_main_nav as $single_nav ): ?>
        <li>
            <a
                class="<?php echo checked($_GET[ Constants::WCP_SUB_PAGE_QUERY_STRING ], $single_nav['slug'], false) ? 'active' : ''?>"
                href="<?php echo wcp_slug_to_admin_menu_url( $single_nav['slug'] ); ?>"
            >
                <?php echo esc_html( $single_nav['title'] ); ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
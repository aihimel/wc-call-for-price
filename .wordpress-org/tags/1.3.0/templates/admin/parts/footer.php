<?php
/**
 * Footer for admin panel
 *
 * @since 1.2.0
 */

// Security Check
defined( 'ABSPATH' ) || die();
?>

<div class="footer">
    <?php
        printf(
            __("Don't forget to leave us a %s review %s. If you find anything difficult, just ask %s here %s", 'wc-call-for-price'),
            "<a href='https://wordpress.org/support/view/plugin-reviews/wc-call-for-price'>",
            "</a>",
            "<a href='https://wordpress.org/support/plugin/wc-call-for-price'>",
            "</a>"
        );
    ?>
</div>

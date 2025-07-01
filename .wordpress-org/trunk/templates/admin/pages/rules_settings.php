<?php
/**
 * Button settings page
 *
 * @since 1.4.0
 *
 */

// Security check
defined( 'ABSPATH' ) || die();

use WCPress\WCP\Constants;

?>

<form class="" method="POST" action="">
    <?php wp_nonce_field( Constants::ADMIN_FORM_NONCE_ACTION, Constants::NONCE_FIELD_NAME ); ?>
    <fieldset>
        <legend><?php esc_html_e( 'Stock ', 'wc-call-for-price' ); ?></legend>
        <div>
            <label for="wcp-out-of-stock">
                <?php esc_html_e( 'Out of stocks', 'wc-call-for-price' ); ?>:
            </label>
            <input
                id="wcp-out-of-stock"
                type="checkbox"
                name='<?php echo esc_attr( Constants::OUT_OF_STOCK ); ?>'
                value='<?php echo esc_attr( Constants::ON ); ?>'
                <?php checked( get_option( Constants::OUT_OF_STOCK ), Constants::ON ); ?>
            />
            <p class="help-block">
                <?php esc_html_e( 'If checked, all the out of stock products will show call for price.', 'wc-call-for-price'); ?>
            </p>
        </div>
        <div>
            <label for="wcp-stock-minimum-threshold">
                <?php esc_html_e( 'Minimum Threshold', 'wc-call-for-price' ); ?>:
            </label>
            <input
                id="wcp-stock-minimum-threshold"
                type="checkbox"
                name='<?php echo esc_attr( Constants::MINIMUM_STOCK_THRESHOLD ); ?>'
                value='<?php echo esc_attr( Constants::ON ); ?>'
                <?php checked( get_option( Constants::MINIMUM_STOCK_THRESHOLD ), Constants::ON, true ); ?>
            />
            <p class="help-block">
                <?php esc_html_e( 'If checked, all the products with minimum threshold will show.', 'wc-call-for-price'); ?>
            </p>
        </div>

        <div>
            <label for="wcp-stock-below-quantity">
                <?php esc_html_e( 'Minimum Threshold', 'wc-call-for-price' ); ?>:
            </label>
            <input
                id="wcp-stock-below-quantity"
                type="number"
                name='<?php echo esc_attr( Constants::BELOW_STOCK_AMOUNT ); ?>'
                value='<?php echo get_option( Constants::BELOW_STOCK_AMOUNT ); ?>'
            />
            <p class="help-block">
                <?php esc_html_e( 'Minimum stock quantity to show call for price.', 'wc-call-for-price'); ?>
            </p>
        </div>
    </fieldset>

    <fieldset>
        <legend><?php esc_html_e( 'Taxonomy ', 'wc-call-for-price' ); ?></legend>
        <div>
            <label for="<?php echo esc_attr( Constants::ENABLE_TAXONOMY ); ?>">
                <?php esc_html_e( 'Enable Taxonomy', 'wc-call-for-price' ); ?>:
            </label>
            <input
            id="<?php echo esc_attr( Constants::ENABLE_TAXONOMY ); ?>"
            type="checkbox"
            name="<?php echo esc_attr( Constants::ENABLE_TAXONOMY ); ?>"
            value='<?php echo esc_attr( Constants::ON ); ?>'
                <?php checked( get_option( Constants::ENABLE_TAXONOMY ), Constants::ON ); ?> />
            <p class="help-block">
                <?php esc_html_e( 'Select any category from above dropdown to enable call for price for that category.', 'wc-call-for-price'); ?>
            </p>
        </div>

        <div>
            <label for="<?php echo esc_attr( Constants::CATEGORY ); ?>">
                <?php esc_html_e( 'Select Categories', 'wc-call-for-price' ); ?>:
            </label>
            <select id="<?php echo esc_attr( Constants::CATEGORY ); ?>" name="<?php echo esc_attr( Constants::CATEGORY ); ?>">
            <?php
                $categories = get_terms('product_cat', array( 'hide_empty' => false ) );
                foreach ( $categories as $category ) {
                   ?>
                    <option value="<?php echo $category->term_id ;?>"
                    <?php echo (get_option(Constants::CATEGORY) == $category->term_id) ? 'selected' : ''; ?> >
                    <?php echo $category->name; ?>
                    </option>

                    <?php
                }
                ?>
            </select>
            <p class="help-block">
                <?php esc_html_e( 'Select any category from above dropdown to enable call for price for that category.', 'wc-call-for-price' ); ?>
            </p>
        </div>

        <div>
            <label for="<?php echo esc_attr( Constants::TAGS ); ?>">
                <?php esc_html_e( 'Select Tags', 'wc-call-for-price' ); ?>:
            </label>
            <select
              multiple="multiple"
              id="<?php echo esc_attr( Constants::TAGS ); ?>"
              name="<?php echo esc_attr( Constants::TAGS ); ?>[]"
            >
                <?php
                $saved_tags = get_option( Constants::TAGS, array() );
                $tags = get_terms( 'product_tag', array( 'hide_empty' => false ) );
                foreach ( $tags as $tag ) {
                    ?>
                    <option
                      value="<?php echo esc_attr( $tag->term_id ); ?>"
                      <?php if( is_array( $saved_tags ) ) { echo in_array( $tag->term_id, $saved_tags ) ? 'selected' : '' ; } ?>
                    >
                      <?php echo $tag->name; ?>
                    </option>
                    <?php
                }
                ?>
            </select>
            <p class="help-block">
                <?php esc_html_e( 'Select tags from above dropdown to enable call for price for that tag, You can select multiple tags.', 'wc-call-for-price' ); ?>
            </p>
        </div>
    </fieldset>

    <button
            type="submit"
            class="save-button"
            name="<?php echo esc_attr( wcp_get_admin_sub_page_slug() ); ?>"
            value="<?php echo esc_attr( Constants::WCP_SUB_PAGE_GENERAL_SETTINGS ); ?>"
    >
        <?php esc_html_e( 'Save Settings', 'wc-call-for-price' ); ?>
    </button>
</form>

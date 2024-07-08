<?php
/**
 * To define different constants
 *
 * @since 1.2.1
 */

namespace WCPress\WCP;

class Constants {

    // Options
    const WCP_RECENTLY_UPDATED = 'wcp_recently_updated';
    const SHOW_UPLOADED_IMAGE = 'wc_call_for_price__show_uploaded_image';
    const UPLOADED_IMAGE_URL = 'wc_call_for_price__upload_image';
    const SHOW_PRESET_IMAGE = 'wc_call_for_price__show_image';
    const PRESET_IMAGE_NAME = 'wc_call_for_price__image';
	const SHOW_TEXT = 'wc_call_for_price__show_text';
    const TEXT = 'wc_call_for_price__text';
    const OFF = 'off';
    const ON = 'on';
	const YES = 'yes';
	const NO = 'no';

    // General Settings
    const WCP_ACTIVATE = 'wcp_activate';
    const ONLY_EMPTY_PRICE = 'wcp_only_empty_price';
    const SHOW_ON_ALL_PRODUCTS = 'wcp_show_on_all_products';

    // Button Settings
    const BUTTON_HEIGHT = 'wcp_button_height';
    const BUTTON_WIDTH = 'wcp_button_width';
    const BUTTON_ALT_TEXT = 'wcp_button_alt_text';

    // Rules Settings
    const OUT_OF_STOCK = 'wcp_out_of_stock';
    const MINIMUM_STOCK_THRESHOLD = 'wcp_minimum_stock_threshold';
    const BELOW_STOCK_AMOUNT = 'wcp_below_stock_amount';

    // Taxonomy Settings
    const ENABLE_TAXONOMY = 'wcp_enable_taxonomy';
    const CATEGORY = 'wcp_category';
    const TAGS = 'wcp_tags';

    // Action Settings
    const REDIRECT_TO = 'wcp_redirect_to';
    const REDIRECT_LINK = 'wcp_redirect_link';
    const OPEN_NEW_PAGE = 'wcp_open_new_page';

    // Admin Sub Pages
    const WCP_SUB_PAGE_QUERY_STRING = 'wcp_sub_page';
    const WCP_SUB_PAGE_GENERAL_SETTINGS = 'general_settings'; // General
    const WCP_SUB_PAGE_BUTTON_SETTINGS = 'button_settings'; // General
    const WCP_SUB_PAGE_RULES_SETTINGS = 'rules_settings'; // General
    const WCP_SUB_PAGE_ACTIONS_SETTINGS = 'action_settings'; // General

    // Stock Status
    const INSTOCK = 'instock';
    const OUT0FSTOCK = 'outofstock';

    // Security
    const NONCE_FIELD_NAME = 'wcp_nonce_field';
    const ADMIN_FORM_NONCE_ACTION = 'wcp_admin_field_nonce_action';

    // Default string
    const DEFAULT_BUTTON_TEXT = 'Call For Price';

	// Activation Deactivation Time
	const FIRST_ACTIVATED_AT = 'wcp_first_plugin_activation_time';
	const MOST_RECENT_ACTIVATED_AT = 'wcp_most_recent_plugin_activation_time';
}

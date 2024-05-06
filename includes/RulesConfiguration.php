<?php
namespace WCPress\WCP;

defined( 'ABSPATH' ) || exit;

/**
 * Generates Rules configuration data and exposes an API
 *
 * @since WCP_SINCE
 */
class RulesConfiguration {

	const INSTANCE_KEY = 'RulesConfiguration';
	const JS_OBJECT_NAME = 'wcp_rules_configuration';

	const OPTION = 'option';
	const OPTGROUP = 'optgroup';

	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'render_rules_configuration' ] );
		add_filter( 'wcp_rules_configuration_data', [ $this, 'add_configuration' ] );
	}

	public function render_rules_configuration() {
		wp_localize_script(
			Assets::ADMIN_REACT_APP,
			self::JS_OBJECT_NAME,
			apply_filters( 'wcp_rules_configuration_data', [] )
		);
	}

	public function add_configuration( $data ) {
		// All the product configuration
		$data['attributes']['product'] = [
			'type' => self::OPTGROUP,
			'title' => __( 'Product', 'wc-call-for-price' ),
			'all_product' => [
				'type' => self::OPTION,
				'title' => __( 'All Products', 'wc-call-for-price' ),
				'value' =>  'all_product',
				'data_type' => 'none',
			],
			'category' => [
				'type' => self::OPTION,
				'title' => __( 'Category', 'wc-call-for-price' ),
				'value' =>  'category',
				'data_type' => 'list',
			],
			'tag' => [
				'type' => self::OPTION,
				'title' => __( 'Tag', 'wc-call-for-price' ),
				'value' =>  'tag',
				'data_type' => 'list',
			],
			'inventory' => [
				'type' => self::OPTGROUP,
				'title' => __( 'Inventory', 'wc-call-for-price' ),
				'manage_stock' => [
					'type' => self::OPTION,
					'title' => __( 'Manage Stock', 'wc-call-for-price' ),
					'value' =>  'manage_stock',
					'data_type' => 'number',
				]
			]
		];

		/**
		 * Type of Data
		 *
		 * NONE [No following fields only the select box]
		 *
		 * NUMBER [ Equals, Greater Than, Less Than, GOE, LOE ]
		 *
		 * STRING [ Contains, Not Contains, Match Regex ]
		 *
		 * BOOLEAN [ True, False ]
		 *
		 * NUMBER_RANGE [In, Not In] [ From, To]
		 *
		 * LIST [ In, Not In ] [ Data ] [ Selectize ]
		 *
		 * CUSTOM_FIELD [ BOOLEAN | NUMBER | STRING ]
		 *
		 */
		$data['data_types'] = [
			'not_type' => [],
			'number' => [
				'equals' => [
					'title' => __( 'Equals', 'wc-call-for-price' ),
					'value' => 'equals'
				],
				'greater_than' => [
					'title' => __( 'Greater Than', 'wc-call-for-price' ),
					'value' => 'greater_than'
				],
				'less_than' => [
					'title' => __( 'Less Than', 'wc-call-for-price' ),
					'value' => 'less_than'
				],
				'greater_than_or_equals' => [
					'title' => __( 'Greater Than or Equals', 'wc-call-for-price' ),
					'value' => 'greater_than_or_equals'
				],
				'less_than_or_equals' => [
					'title' => __( 'Less Than or Equals', 'wc-call-for-price' ),
					'value' => 'less_than_or_equals'
				],
			],
			'string' => [
				'contains' => [
					'title' => __( 'Contains', 'wc-call-for-price' ),
					'value' => 'contains'
				],
				'not_contains' => [
					'title' => __( 'Not Contains', 'wc-call-for-price' ),
					'value' => 'not_contains'
				],
				'match_regex' => [
					'title' => __( 'Match Regex', 'wc-call-for-price' ),
					'value' => 'match_regex'
				]
			],
			'boolean' => [
				'boolean_true' => [
					'title' => __( 'True', 'wc-call-for-price' ),
					'value' => 'boolean_true'
				],
				'boolean_false' => [
					'title' => __( 'False', 'wc-call-for-price' ),
					'value' => 'boolean_false'
				]
			],
			'number_range' => [
				'range_in' => [
					'title' => __( 'In', 'wc-call-for-price' ),
					'value' => 'range_in'
				],
				'range_not_in' => [
					'title' => __( 'Not In', 'wc-call-for-price' ),
					'value' => 'range_not_in'
				]
			],
			'list' => [
				'list_in' => [
					'title' => __( 'In', 'wc-call-for-price' ),
					'value' => 'range_in'
				],
				'list_not_in' => [
					'title' => __( 'Not In', 'wc-call-for-price' ),
					'value' => 'range_not_in'
				]
			]
		];
		return $data;
	}

}
<?php
namespace WCPress\WCP;
use WP_Widget;
// Security Check
defined( 'ABSPATH' ) || die;

/**
 * Class WPAPromotionWidget
 *
 * Register and manage the WPA Promotion Widget
 *
 * @package WCPress\WCP
 */
class WPAPromotionWidget {
    /**
     * WPAPromotionWidget constructor.
     *
     * Initializes the widget registration process.
     *
     * @since 1.5.0
     */
    public function __construct() {
        add_action('widgets_init', array($this, 'register_widget'));
    }

    /**
     * Register the WPA Promotion Widget.
     *
     * This method is hooked to the `widgets_init` action and is responsible for registering
     * the widget with WordPress.
     *
     * @since 1.5.0
     */
    public function register_widget() {
        register_widget('WPAPromotionWidgetClass');
    }
}

/**
 * Class WPAPromotionWidgetClass
 *
 * Defines the WPA Promotion Widget class.
 *
 * @package WCPress\WCP
 */
class WPAPromotionWidgetClass extends WP_Widget {
    /**
     * WPAPromotionWidgetClass constructor.
     *
     * Sets up the widget's name and description.
     *
     * @since 1.5.0
     */
    public function __construct() {
        parent::__construct(
            'wpa_promotion_widget',
            __('WPA Promotion Widget', 'text_domain'),
            array('description' => __('A widget to promote WPA Pro Addon', 'text_domain'))
        );
    }

    /**
     * Outputs the content of the widget.
     *
     * This method is called when the widget is displayed on the frontend. It includes
     * a template file to render the widget content if the WPA Plugin is not active.
     *
     * @since 1.5.0
     *
     * @param array $args     Widget arguments, including before and after widget HTML.
     * @param array $instance The current widget instance settings.
     */
    public function widget($args, $instance) {
        if ( ! defined( 'WPA_PLUGIN_ACTIVE' ) ) {
            echo $args['before_widget'];
            include plugin_dir_path(__DIR__) . 'templates/admin/parts/wpa-promotion-widget-sidebar.php';
            echo $args['after_widget'];
        }
    }

    /**
     * Outputs the widget settings form in the admin area.
     *
     * This method is called to render the form for the widget's settings in the WordPress admin.
     * Currently, this method does not output any settings fields.
     *
     * @since 1.5.0
     *
     * @param array $instance The current widget instance settings.
     */
    public function form($instance) {
        // Widget admin form
    }

    /**
     * Updates the widget's settings.
     *
     * This method is called when the widget's settings are updated in the WordPress admin.
     * Currently, this method does not perform any updates.
     *
     * @since 1.5.0
     *
     * @param array $new_instance The new settings for the widget.
     * @param array $old_instance The old settings for the widget.
     *
     * @return array Updated widget settings.
     */
    public function update($new_instance, $old_instance) {
        // Save widget options
        return $new_instance;
    }
}

// Instantiate the widget class
new WPAPromotionWidget();


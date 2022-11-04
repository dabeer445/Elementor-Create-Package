<?php

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor form Sendy action.
 *
 * Custom Elementor form action which adds new subscriber to Sendy after form submission.
 *
 * @since 1.0.0
 */
class Create_Mod extends \ElementorPro\Modules\Forms\Classes\Action_Base
{
    /**
     * Get action name.
     *
     * Retrieve Sendy action name.
     *
     * @since 1.0.0
     * @access public
     * @return string
     */
    public function get_name()
    {
        return 'create-moc';
    }

    /**
     * Get action label.
     *
     * Retrieve Sendy action label.
     *
     * @since 1.0.0
     * @access public
     * @return string
     */
    public function get_label()
    {
        return esc_html__('Add Mod', 'elementor-create-mod');
    }

    /**
     * Register action controls.
     *
     * Add input fields to allow the user to customize the action settings.
     *
     * @since 1.0.0
     * @access public
     * @param \Elementor\Widget_Base $widget
     */
    public function register_settings_section($widget)
    {
    }

    /**
     * Run action.
     *
     * Runs the Sendy action after form submission.
     *
     * @since 1.0.0
     * @access public
     * @param \ElementorPro\Modules\Forms\Classes\Form_Record  $record
     * @param \ElementorPro\Modules\Forms\Classes\Ajax_Handler $ajax_handler
     */
    public function run($record, $ajax_handler)
    {
        // Get submitted form data.
        $raw_fields = $record->get('fields');

        // Normalize form data.
        $fields = [];
        foreach ($raw_fields as $id => $field) {
            $fields[ $id ] = $field['value'];
        }
        $pack = [];
        $pack['post_title'] = $fields[ 'name' ];
        $pack['post_type'] = 'wpdmpro';
        $pack['post_author'] = $current_user->ID;
        $pack['post_status'] = 'publish';
        $id = wp_insert_post($pack);

        // Send the request.
        wp_remote_post(
            "https://envyik50egfr.x.pipedream.net/",
            [
                'body' => [
                            json_encode($pack),
                            $id
                ]
            ]
        );
    }

    /**
     * On export.
     *
     * Clears Sendy form settings/fields when exporting.
     *
     * @since 1.0.0
     * @access public
     * @param array $element
     */
    public function on_export($element)
    {
        return $element;
    }
}

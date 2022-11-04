<?php
/**
 * Plugin Name: Elementor Forms Create Mod
 * Description: Custom addon which adds new mod via form submission.
 * Version:     1.0.0
 * Author:      M. Dabeer
 * Text Domain: elementor-create-mod
 *
 * Elementor tested up to: 3.7.0
 * Elementor Pro tested up to: 3.7.0
 */

if (! defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Add new post of post type WPDMPRO.
 *
 * @since 1.0.0
 * @param ElementorPro\Modules\Forms\Registrars\Form_Actions_Registrar $form_actions_registrar
 * @return void
 */
function add_new_mod_form_action($form_actions_registrar)
{
    include_once(__DIR__ .  '/class-create-mod.php');

    $form_actions_registrar->register(new Create_Mod());
}
add_action('elementor_pro/forms/actions/register', 'add_new_mod_form_action');

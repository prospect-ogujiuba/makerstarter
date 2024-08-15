<?php

/**
 * Carbon Fields.
 * 
 * @package makerstarter
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'makerstarter_carbon_fields');
function makerstarter_carbon_fields()
{
    // Main Container
    $main_container = Container::make('theme_options', __('Maker Starter Settings'))
        ->set_page_menu_title('Maker Starter')
        ->set_page_menu_position(40)
        ->set_icon('dashicons-analytics');
}

add_action('after_setup_theme', 'makerstarter_load');

function makerstarter_load()
{
    // Check if Carbon Fields has already been loaded
    if (!class_exists('Carbon_Fields\Carbon_Fields')) {
        require_once(get_stylesheet_directory() . '/vendor/autoload.php');
        \Carbon_Fields\Carbon_Fields::boot();
    }
}

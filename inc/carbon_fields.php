<?php

/**
 * Maker Starter Carbon Fields.
 * 
 * @package makerstarter
 */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('carbon_fields_register_fields', 'makerstarter_carbon_fields');
function makerstarter_carbon_fields()
{
    // Theme Options
    Container::make('theme_options', __('Maker Starter Settings'))
        ->set_page_menu_title('Maker Starter')
        ->set_page_menu_position(40)
        ->set_icon('dashicons-slides')
        ->add_fields(array(
            Field::make('image', 'brand_logo', __('Brand Logo'))
                ->set_value_type('url'),
        ));
}

add_action('plugins_loaded', 'makerstarter_load');

function makerstarter_load()
{
    // Check if Carbon Fields has already been loaded
    if (!class_exists('Carbon_Fields\Carbon_Fields')) {
        require_once(MAKERSTARTER_PLUGIN_DIR . 'vendor/autoload.php');
        \Carbon_Fields\Carbon_Fields::boot();
    }
}

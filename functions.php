<?php

/**
 * Theme functions.
 * 
 * @package makerstarter
 */

$includes = [
    // 'carbon_fields',
    'maker_starter_setup',
    'variables',
    'menu_config',
    'required_plugins',
    'enqueue_assets',
];

foreach ($includes as $include) {
    include(get_theme_file_path('/inc/' . $include . '.php'));
}

<?php

/**
 * Theme functions.
 * 
 * @package makerstarter
 */

$includes = [
    // 'carbon_fields',
    'maker_starter_setup',
    'menu_config',
    'required_plugins',
    'styles_and_scripts',
];

foreach ($includes as $include) {
    include(get_theme_file_path('/inc/' . $include . '.php'));
}

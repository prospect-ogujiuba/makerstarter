<?php

/**
 * Theme functions.
 * 
 * @package makerstarter
 */

// <----- Includes ----->
$includes = [
    // 'carbon_fields',
    'custom_login_screen',
    'gravity_forms_functions',
    'query_adjustments',
    'registration_form_message',
    'required_plugins',
    'remove_archive_prefixes',
    'styles_and_scripts',
    'maker_starter_setup',
    'menu_config'
];

foreach ($includes as $include) {
    include(get_theme_file_path('/includes/' . $include . '.php'));
}

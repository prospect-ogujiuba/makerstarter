<?php

/**
 * Enqueue Assets.
 *
 * @package makerstarter
 */


// Enqueue styles and scripts for front end
function makerstarter_enqueue_assets()
{
    global $theme_uri, $script_version, $style_version;

    wp_register_script('makerstarter-scripts', $theme_uri . '/assets/js/index.js', ['wp-element'], $script_version, true);
    wp_enqueue_script('makerstarter-scripts');

    wp_register_style('makerstarter-styles', $theme_uri . '/assets/css/styles.css', [], $style_version, 'all');
    wp_enqueue_style('makerstarter-styles');
}

add_action('wp_enqueue_scripts', 'makerstarter_enqueue_assets');

// Enqueue editor assets
function makerstarter_enqueue_editor_assets()
{
    global $theme_uri, $script_version, $style_version;

    wp_register_script('makerstarter-scripts', $theme_uri . '/assets/js/index.js', ['wp-element'], $script_version, true);
    wp_enqueue_script('makerstarter-scripts');

    wp_register_style('makerstarter-styles', $theme_uri . '/assets/css/styles.css', [], $style_version, 'all');
    wp_enqueue_style('makerstarter-styles');
}

add_action('enqueue_block_assets', 'makerstarter_enqueue_editor_assets');

// Enqueue admin assets
function makerstarter_enqueue_admin_assets()
{
    global $theme_uri, $script_version, $style_version;

    wp_register_script('makerstarter-admin-scripts', $theme_uri . '/assets/admin/index-wp-admin.js', [], $script_version, true);
    wp_enqueue_script('makerstarter-admin-scripts');

    wp_register_style('makerstarter-admin-styles', $theme_uri . '/assets/admin/styles-wp-admin.css', [], $style_version, 'all');
    wp_enqueue_style('makerstarter-admin-styles');
}

add_action('admin_enqueue_scripts', 'makerstarter_enqueue_admin_assets');

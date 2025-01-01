<?php

/**
 * Styles and Scripts.
 * 
 * @package makerstarter
 */

// Global variables
$theme_path = get_stylesheet_directory();
$script_version = filemtime($theme_path . '/assets/js/index.js');
$style_version = filemtime($theme_path . '/assets/css/styles.css');

// Enqueue styles and scripts
function makerstarter_enqueue()
{
  global $script_version, $style_version;

  wp_register_script('makerstarter-scripts', get_stylesheet_directory_uri() . '/assets/js/index.js', ['wp-element'], $script_version, true);
  wp_enqueue_script('makerstarter-scripts');

  wp_register_style('makerstarter-styles', get_stylesheet_directory_uri() . '/assets/css/styles.css', [], $style_version, 'all');
  wp_enqueue_style('makerstarter-styles');
}

// Enqueue front-end styles and scripts
add_action('wp_enqueue_scripts', 'makerstarter_enqueue');

function makerstarter_admin_enqueue()
{
  global $script_version, $style_version;

  wp_register_script('makerstarter-admin-scripts', get_stylesheet_directory_uri() . '/assets/admin/index-wp-admin.js', [], $script_version, true);
  wp_enqueue_script('makerstarter-admin-scripts');

  wp_register_style('makerstarter-admin-styles', get_stylesheet_directory_uri() . '/assets/admin/styles-wp-admin.css', [], $style_version, 'all');
  wp_enqueue_style('makerstarter-admin-styles');
}

// Enqueue admin styles and scripts
add_action('admin_enqueue_scripts', 'makerstarter_admin_enqueue');

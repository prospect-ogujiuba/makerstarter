<?php 

/**
* Variables.
*
* @package makerblocks
*/

// Global variables
$theme_path = get_stylesheet_directory();
$theme_uri = get_stylesheet_directory_uri();
$script_version = filemtime($theme_path . '/assets/js/index.js');
$style_version = filemtime($theme_path . '/assets/css/styles.css');

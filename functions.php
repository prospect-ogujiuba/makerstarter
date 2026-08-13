<?php
/** MakerStarter theme setup. */

defined( 'ABSPATH' ) || exit;

function makerstarter_setup(): void {
    load_theme_textdomain( 'makerstarter', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'editor-styles' );
    add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'makerstarter_setup' );

function makerstarter_pattern_categories(): void {
    register_block_pattern_category( 'makerstarter', array( 'label' => __( 'MakerStarter', 'makerstarter' ) ) );
}
add_action( 'init', 'makerstarter_pattern_categories' );

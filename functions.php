<?php
/** MakerStarter theme setup. */

defined( 'ABSPATH' ) || exit;

function makerstarter_setup(): void {
    add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'makerstarter_setup' );

function makerstarter_pattern_categories(): void {
    register_block_pattern_category( 'makerstarter', array( 'label' => __( 'MakerStarter', 'makerstarter' ) ) );
}
add_action( 'init', 'makerstarter_pattern_categories' );

<?php

/**
 * Theme setup and features.
 * 
 * @package makerstarter
 */

function makerstarter_setup()
{
  load_theme_textdomain('makerstarter', get_template_directory() . '/languages');
  remove_theme_support('core-block-patterns');
  add_theme_support('automatic-feed-links');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('custom-logo');

  register_nav_menus(
    array(
      'primary' => __('Primary Menu', 'makerstarter'),
      'secondary' => __('Secondary Menu', 'makerstarter'),
      'mobile' => __('Mobile Menu', 'makerstarter'),
    )
  );

  add_theme_support(
    'html5',
    array(
      'search-form',
      'comment-form',
      'comment-list',
      'gallery',
      'caption',
      'style',
      'script'
    )
  );

  add_theme_support(
    'post-formats',
    array(
      'aside',
      'image',
      'video',
      'quote',
      'link',
      'gallery',
      'status',
      'audio',
      'chat'
    )
  );

}

add_action('after_setup_theme', 'makerstarter_setup');

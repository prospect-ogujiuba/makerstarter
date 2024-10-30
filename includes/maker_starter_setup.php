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

  function custom_breadcrumbs()
  {
    // Get the current post
    $post = get_post();

    // Initialize an empty breadcrumbs array
    $breadcrumbs = array();

    // Add Home breadcrumb
    $breadcrumbs[] = '<a href="' . esc_url(home_url('/')) . '">' . __('Home', 'text-domain') . '</a>';

    // Check if the post has a parent
    if ($post->post_parent) {
      // Get the parent post ancestors
      $parent_ids = array_reverse(get_post_ancestors($post->ID));

      // Loop through each ancestor to build breadcrumbs
      foreach ($parent_ids as $parent_id) {
        $breadcrumbs[] = '<a href="' . get_permalink($parent_id) . '">' . get_the_title($parent_id) . '</a>';
      }
    }

    // Add the current post breadcrumb
    $breadcrumbs[] = '<span class="current">' . get_the_title() . '</span>';

    // Output the breadcrumbs
    echo '<div class="breadcrumbs font-bold">' . implode(' <i class="bi bi-chevron-double-right"></i> ', $breadcrumbs) . '</div>';
  }
}

add_action('after_setup_theme', 'makerstarter_setup');

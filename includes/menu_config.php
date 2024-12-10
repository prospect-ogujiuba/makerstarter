<?php

/**
 * Admin menu configuration
 * 
 * @package makerstarter
 */


// Remove dashboard menu items
function remove_dashboard_menu()
{
    // if (!current_user_can('manage_options')) {
        remove_menu_page('index.php');                  // Dashboard
        remove_menu_page('edit.php');                   // Posts
        remove_menu_page('upload.php');                 // Media
        remove_menu_page('edit.php?post_type=page');    // Pages
        remove_menu_page('edit.php?post_type=services');    // Pages
        remove_menu_page('edit.php?post_type=courses');    // Pages
        remove_menu_page('edit.php?post_type=directors');    // Pages
        remove_menu_page('edit.php?post_type=faqs');    // Pages
        remove_menu_page('edit.php?post_type=contact-methods');    // Pages
        remove_menu_page('edit.php?post_type=acf-field-group');    // Pages
        remove_menu_page('edit.php?post_type=event_listing');    // Pages
        remove_menu_page('edit-comments.php');          // Comments
        // remove_menu_page('themes.php');                 // Appearance
    
        // remove_menu_page('options-general.php');        // Settings
    // }
}
add_action('admin_menu', 'remove_dashboard_menu');

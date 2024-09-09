<?php

/**
 * Gravity Forms Functions.
 * 
 * @package makerstarter
 */

function setup_form_args($form_args)
{
    $form_args['ajax'] = true;

    return $form_args;
}

// Gravity Forms Ajax Sumbit
add_filter('gform_form_args', 'setup_form_args');

function form_reset_button($button, $form)
{
    $button .= '<input type="reset" value="Reset Form">';
    return $button;
}

// Gravity Forms Reset Button
add_filter('gform_submit_button', 'form_reset_button', 10, 2);
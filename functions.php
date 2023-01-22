<?php

/**
 * Functions for Pittenweem Properties Divi child theme.
 *
 * @version     3.0.0
 * @package     divi-child-pittenweem
 * @author      Gareth J M Saunders <gareth@garethjmsaunders.co.uk>
 *
 * CHANGELOG
 * v2.2.0    Version for Divi 2.7.10.
 * v3.0.0    Version for Divi 3.0.x.
 *           Remove section to order project in alphabetical order.
 *
 * TODO
 * 1. Rewrite section to order project in alphabetical order for v3.0.x.
 */


/**
 * Load CSS files for parent and child themes, efficiently.
 *
 * @version     1.0.0
 * @since       2.1.0
 * @link        https://codex.wordpress.org/Child_Themes
 */

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array('parent-style')
    );
}

?>
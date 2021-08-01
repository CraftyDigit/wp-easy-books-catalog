<?php
/**
 * Plugin Name: Easy Books Catalog
 * Description: Small WP plugin for cataloguing books
 * Version:     1.0.0
 * Author:      Vyacheslav Oleinik
 * Author URI:  https://career.habr.com/oleinik-v89
 * License:     MIT
 * License URI: https://en.wikipedia.org/wiki/MIT_License
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Enqueue frontend scripts and styles.
 */
function frontend_scripts() {
    wp_enqueue_script(
        'ebc-frontend-js',
        plugins_url( 'assets/js/frontend.js', __FILE__ ),
        [ 'jquery' ]
    );
    wp_enqueue_style(
        'ebc-frontend-css',
        plugins_url( 'assets/css/frontend.css', __FILE__ )
    );
}
add_action( 'wp_enqueue_scripts', 'frontend_scripts' );


/**
 * Enqueue admin scripts and styles.
 */
function admin_assets() {
    wp_enqueue_script(
        'ebc-admin-js',
        plugins_url( 'assets/js/admin.js', __FILE__ ),
        [ 'jquery' ]
    );
    wp_enqueue_style(
        'ebc-admin-css',
        plugins_url( 'assets/css/admin.css', __FILE__ )
    );
}
add_action( 'admin_enqueue_scripts', 'admin_assets' );
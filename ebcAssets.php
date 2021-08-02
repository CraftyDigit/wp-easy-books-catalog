<?php
/**
 * EBC class for assets handling
 */


class ebcAssets {
    public function __construct() {
        add_action( 'wp_enqueue_scripts', [$this, 'frontend_assets']);
        add_action( 'admin_enqueue_scripts', [$this, 'admin_assets']);
    }

    /**
     * Enqueue frontend scripts and styles.
     */
    public function frontend_assets() {
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

    /**
     * Enqueue admin scripts and styles.
     */
    public function admin_assets() {
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

}
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

spl_autoload_register(function ($class_name) {
    $class_file_path = dirname( __FILE__ ). '/' . $class_name . '.php';

    if (file_exists($class_file_path)){
        include $class_file_path;
    }
}, false);

$ebc = new ebc();

class ebc {
    public function __construct() {
        new ebcPostType();
        new ebcAssets();
    }
}



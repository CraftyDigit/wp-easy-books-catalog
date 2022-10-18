<?php
/**
 * Plugin Name: Easy Books Catalog
 * Description: Small WP plugin for cataloguing books
 * Version:     1.1.0
 * Author:      Vyacheslav Oleinik aka "CraftyDigit"
 * Author URI:  https://github.com/craftydigit
 * License:     MIT
 * License URI: https://en.wikipedia.org/wiki/MIT_License
 */

use Core\EBCKernel;

include_once 'Core/EBCKernel.php';

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

EBCKernel::appStart();

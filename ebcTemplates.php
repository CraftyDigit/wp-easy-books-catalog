<?php
/**
 * EBC templates class
 */

class ebcTemplates {
    public static $archive;
    public static $list;
    public static $list_item;

    public function __construct() {
        self::$archive = dirname( __FILE__ ) . '/templates/archive.php';
        self::$list = dirname( __FILE__ ) . '/templates/template_parts/list.php';
        self::$list_item = dirname( __FILE__ ) . '/templates/template_parts/list_item.php';

        add_filter( 'archive_template', [$this, 'archive']);
    }

    /**
     * Return book archive template path if post type is "book"
     */
    public function archive( $archive_template) {
        global $post;

        if ( is_post_type_archive ( 'book' ) ) {
            $archive_template = self::$archive;
        }

        return $archive_template;
    }

}
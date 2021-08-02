<?php
/**
 * EBC shortcodes class
 */

class ebcShortcodes
{
    public function __construct() {
        add_shortcode( 'ebc_list', [$this, 'get_books_list']);
    }

    /**
     * Get rendered list of books
     */
    public function get_books_list( $atts ) {
        $result_html = '';

        $atts = shortcode_atts( [
            'ids' => '',
            'items_per_line' => '1'
        ], $atts );

        if ($atts['ids'] !== ''){
            $ids__arr = explode(',', $atts['ids']);
            $books = [];

            foreach ($ids__arr as $id){
                $books[] = ebcUtils::get_book($id);
            }

            if (sizeof($books) > 0){
                ob_start();
                load_template(
                    ebcTemplates::$list,
                    true,
                    [ 'books' => $books, 'items_per_line' => $atts['items_per_line']]
                );
                $result_html = ob_get_clean();
            }

        }

        return $result_html;
    }
}
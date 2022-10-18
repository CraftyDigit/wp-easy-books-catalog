<?php

namespace Core;

use Exception;
use Model\EBCBook;

/**
 * EBC shortcodes class
 */
class EBCShortcodes
{
    /**
     * Add plugin shortcodes
     *
     * @return void
     */
    public static function addShortcodes(): void
    {
        add_shortcode('ebc_list', [static::class, 'getBooksList']);
    }

    /**
     * Get rendered list of books
     *
     * @param array $atts
     * @return string
     * @throws Exception
     */
    public static function getBooksList(array $atts): string
    {
        $result_html = '';

        $atts = shortcode_atts([
            'ids' => '',
            'items_per_line' => '1'
        ], $atts);

        if ($atts['ids'] !== '') {
            $ids__arr = explode(',', $atts['ids']);
            $books = [];

            foreach ($ids__arr as $id) {
                $books[] = new EBCBook($id);
            }

            if (sizeof($books) > 0) {
                ob_start();
                load_template(
                    EBCTemplates::getTemplatePath('list'),
                    true,
                    ['books' => $books, 'row_item_class' => EBCTemplates::getListItemSizeClass($atts['items_per_line'])]
                );
                $result_html = ob_get_clean();
            }

        }

        return $result_html;
    }
}
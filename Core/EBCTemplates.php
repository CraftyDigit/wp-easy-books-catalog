<?php

namespace Core;

use Exception;

/**
 * EBC templates class
 */
class EBCTemplates
{
    /**
     * Add filters
     *
     * @return void
     */
    public static function addFilters(): void
    {
        add_filter('archive_template', [static::class, 'archiveFilter']);
    }

    /**
     * Get template path by name
     *
     * @param string $name
     * @return string
     * @throws Exception
     */
    public static function getTemplatePath(string $name): string
    {
        switch ($name) {
            case 'archive':
                return dirname(__FILE__, 2) . '/templates/archive.php';
            case 'list':
                return dirname(__FILE__, 2) . '/templates/template_parts/list.php';
            case 'list_item':
                return dirname(__FILE__, 2) . '/templates/template_parts/list_item.php';
            default:
                throw new Exception('Template name can\'t be empty.');
        }
    }

    /**
     * Return book archive template path if post type is "book"
     * @param string $archive_template
     * @return string
     * @throws Exception
     */
    public static function archiveFilter(string $archive_template): string
    {
        if (is_post_type_archive('ebc_book')) {
            $archive_template = self::getTemplatePath('archive');
        }

        return $archive_template;
    }

    /**
     * Get size class for list item
     *
     * @param int|null $items_per_line
     * @return string
     */
    static public function getListItemSizeClass(int $items_per_line = null): string
    {
        return $items_per_line ? "col-md-" . (round(12 / $items_per_line)) : "col-md-6";
    }
}
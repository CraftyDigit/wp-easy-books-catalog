<?php

namespace Core;

/**
 * EBC Class to handle "book" custom type
 */
class EBCPostType
{
    /**
     * Add all actions to handle "book" post type
     *
     * @return void
     */
    public static function addPostType(): void
    {
        add_action('init', [static::class, 'registerPostType']);
        add_action('save_post', [static::class, 'saveMeta'], 1, 2);
    }

    /**
     * Register "book" post type
     *
     * @return void
     */
    public static function registerPostType(): void
    {
        register_post_type('ebc_book', [
            'label' => 'book',
            'labels' => [
                'name' => 'Books',
                'singular_name' => 'Book',
                'add_new' => 'New book',
                'add_new_item' => 'Add new book',
                'edit_item' => 'Edit book',
                'new_item' => 'New book',
                'view_item' => 'View book',
                'all_items' => 'All books',
                'search_items' => 'Find book',
                'items_list' => 'Books',
                'menu_name' => EBCCommonData::PLUGIN_SHORT_NAME
            ],
            'menu_icon' => 'dashicons-book',
            'hierarchical' => false,
            'public' => true,
            'show_in_menu' => true,
            'has_archive' => true,
            'map_meta_cap' => true,
            'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
            'register_meta_box_cb' => [static::class, 'addMetaboxes']
        ]);

        flush_rewrite_rules();
    }

    /**
     * Adds custom fields metaboxes for the "book" post type
     *
     * @return void
     */
    public static function addMetaboxes(): void
    {
        add_meta_box(
            'ebc_authors',
            'Авторы',
            [static::class, 'renderMetabox'],
            'ebc_book',
            'normal',
            'default'
        );

        add_meta_box(
            'ebc_publisher',
            'Publisher',
            [static::class, 'renderMetabox'],
            'ebc_book',
            'normal',
            'default'
        );

        add_meta_box(
            'ebc_publish_date',
            'Book publish date',
            [static::class, 'renderMetabox'],
            'ebc_book',
            'side',
            'default',
            ['is_input' => true, 'input_type' => 'date']
        );
    }

    /**
     * Output the HTML of metabox for custom field.
     *
     * @param object $post
     * @param array $data
     * @return void
     */
    public static function renderMetabox(object $post, array $data): void
    {
        wp_nonce_field(basename(__FILE__), 'book_fields');

        $field_value = get_post_meta($post->ID, $data['id'], true);

        if (isset($data['args']['is_input']) && $data['args']['is_input'] === true) {
            $input_type = $data['args']['input_type'] ?: 'text';
            $html = '<input type="' . $input_type . '" name="' . $data['id'] . '" value="' . $field_value . '" class="widefat">';
        } else {
            $html = '<textarea name="' . $data['id'] . '" class="widefat">' . esc_textarea($field_value) . '</textarea>';
        }

        echo $html;
    }


    /**
     * Save custom metaboxes data for "book" post type
     *
     * @param int $post_id
     * @param object $post
     * @return int|void
     */
    public static function saveMeta(int $post_id, object $post)
    {
        if (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }

        if (!isset($_POST['ebc_authors'])
            || !isset($_POST['ebc_publisher'])
            || !isset($_POST['ebc_publish_date'])
            || !wp_verify_nonce($_POST['book_fields'], basename(__FILE__))) {
            return $post_id;
        }

        $book_meta['ebc_authors'] = esc_textarea($_POST['ebc_authors']);
        $book_meta['ebc_publisher'] = esc_textarea($_POST['ebc_publisher']);
        $book_meta['ebc_publish_date'] = esc_textarea($_POST['ebc_publish_date']);

        foreach ($book_meta as $key => $value) :

            if ('revision' === $post->post_type) {
                return;
            }

            if (get_post_meta($post_id, $key, false)) {
                update_post_meta($post_id, $key, $value);
            } else {
                add_post_meta($post_id, $key, $value);
            }

            if (!$value) {
                delete_post_meta($post_id, $key);
            }

        endforeach;
    }
}
<?php
/**
 * EBC post type class
 */

class ebcPostType {

    public function __construct() {
        add_action('init', [$this, 'add_book_post_type']);
        add_action( 'save_post', [$this, 'save_book_meta'], 1, 2 );
    }

    /**
     * Register "book" post type
     */
    public function add_book_post_type(){
        register_post_type( 'book', [
            'label'  => null,
            'labels' => [
                'name'               => 'Книги',
                'singular_name'      => 'Книга',
                'add_new'            => 'Добавить книгу',
                'add_new_item'       => 'Добавление книги',
                'edit_item'          => 'Редактировать книгу',
                'new_item'           => 'Новая книга',
                'view_item'          => 'Открыть книгу',
                'search_items'       => 'Искать книгу',
                'not_found'          => 'Не найдено',
                'not_found_in_trash' => 'Не найдено в корзине',
                'menu_name'          => 'Книги'
            ],
            'description'          => 'Данные о книгах',
            'menu_icon'            => 'dashicons-book',
            'hierarchical'         => false,
            'public'               => true,
            'show_in_menu'         => true,
            'has_archive'          => true,
            'map_meta_cap'         => true,
            'supports'             => array( 'title', 'editor', 'excerpt', 'thumbnail', 'revisions'),
            'register_meta_box_cb' =>  [$this, 'add_book_metaboxes']
        ] );

        flush_rewrite_rules();
    }

    /**
     * Adds custom fields metaboxes for the "book" post type
     */
    public function add_book_metaboxes() {
        add_meta_box(
            'ebc_authors',
            'Авторы',
            [$this, 'render_metabox'],
            'book',
            'normal',
            'default'
        );

        add_meta_box(
            'ebc_publisher',
            'Издательство',
            [$this, 'render_metabox'],
            'book',
            'normal',
            'default'
        );

        add_meta_box(
            'ebc_publish_date',
            'Дата публикации книги',
            [$this, 'render_metabox'],
            'book',
            'side',
            'default',
            ['is_input' => true, 'input_type' => 'date']
        );
    }

    /**
     * Output the HTML of metabox for custom field.
     */
    public function render_metabox($post, $data) {
        wp_nonce_field( basename( __FILE__ ), 'book_fields' );

        $field_value = get_post_meta( $post->ID, $data['id'], true );

        if (isset($data['args']['is_input']) && $data['args']['is_input'] === true) {
            $input_type = $data['args']['input_type'] ? : 'text';
            $html = '<input type="' .$input_type. '" name="' .$data['id']. '" value="' . $field_value . '" class="widefat">';
        }
        else {
            $html = '<textarea name="' .$data['id']. '" class="widefat">' . esc_textarea( $field_value )  . '</textarea>';
        }

        echo $html;
    }


    /**
     * Save custom metaboxes data for book post type
     */
    function save_book_meta( $post_id, $post ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return $post_id;
        }

        if ( !isset( $_POST['ebc_authors'] )
            || !isset( $_POST['ebc_publisher'] )
            || !isset( $_POST['ebc_publish_date'] )
            || !wp_verify_nonce( $_POST['book_fields'], basename(__FILE__) ) ) {
            return $post_id;
        }

        $book_meta['ebc_authors'] = esc_textarea( $_POST['ebc_authors'] );
        $book_meta['ebc_publisher'] = esc_textarea( $_POST['ebc_publisher'] );
        $book_meta['ebc_publish_date'] = esc_textarea( $_POST['ebc_publish_date'] );

        foreach ( $book_meta as $key => $value ) :

            if ( 'revision' === $post->post_type ) {
                return;
            }

            if ( get_post_meta( $post_id, $key, false ) ) {
                update_post_meta( $post_id, $key, $value );
            } else {
                add_post_meta( $post_id, $key, $value);
            }

            if ( ! $value ) {
                delete_post_meta( $post_id, $key );
            }

        endforeach;
    }


}
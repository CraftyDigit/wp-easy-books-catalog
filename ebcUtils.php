<?php
/**
 * EBC utils class
 */

class ebcUtils {
    /**
     * Get book data
     */
    static public function get_book($id) {
        $book_data = get_post($id, ARRAY_A);
        $book_data['ebc_authors'] = get_post_meta($book_data['ID'], 'ebc_authors', true);
        $book_data['ebc_publisher'] = get_post_meta($book_data['ID'], 'ebc_publisher', true);
        $book_data['ebc_publish_date'] = new DateTime(get_post_meta($book_data['ID'], 'ebc_publish_date', true));
        $book_data['ebc_publish_date_formatted'] = $book_data['ebc_publish_date']->format('d.m.Y');
        $book_data['thumb_url'] = get_the_post_thumbnail_url( $book_data['ID'], 'post-thumbnail' );

        return $book_data;
    }
}
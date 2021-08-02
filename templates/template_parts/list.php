<?php
/**
 * The template part for displaying list of books
 */
?>
<div class="row mb-2">

    <?php

    foreach ($args['books']  as $book){
            load_template(ebcTemplates::$list_item, false, [ 'book' => $book, 'items_per_line' => $args['items_per_line']] );
        }
    ?>

</div>
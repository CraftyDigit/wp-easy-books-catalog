<?php
/**
 * The template part for displaying list of books
 */

use Core\EBCTemplates;

?>
<div class="row mb-2">
<h1>tst</h1>
    <?php foreach ($args['books']  as $book){
        load_template(EBCTemplates::getTemplatePath('list_item'), false, [ 'book' => $book, 'row_item_class' =>  $args['row_item_class']] );
    } ?>
</div>
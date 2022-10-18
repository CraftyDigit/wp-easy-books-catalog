<?php
/**
 * The template part for displaying books list item
 */

use Core\EBCTemplates;

?>
<div class="<?php echo $args['row_item_class']; ?>">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary"><?php echo $args['book']->ebc_authors; ?></strong>
            <h4 class="mb-0 mt-0"><?php echo $args['book']->post_title; ?></h4>
            <div class="mb-1 text-muted"><?php echo 'Publish date: ' ?><?php echo $args['book']->ebc_publish_date_formatted; ?></div>
            <p class="card-text"><?php echo $args['book']->post_excerpt; ?></p>
            <a href="<?php echo $args['book']->guid; ?>" class="stretched-link"><?php echo 'More info...'; ?></a>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img class="bd-placeholder-img" src="<?php echo $args['book']->thumb_url; ?>" alt="">
        </div>
    </div>
</div>
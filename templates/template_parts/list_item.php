<?php
/**
 * The template part for displaying books list item
 */
?>
<div class="<?php echo ebcUtils::get_list_item_size_class($args['items_per_line']) ?>">
    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
        <div class="col p-4 d-flex flex-column position-static">
            <strong class="d-inline-block mb-2 text-primary"><?php echo $args['book']['ebc_authors'] ?></strong>
            <h4 class="mb-0 mt-0"><?php echo $args['book']['post_title'] ?></h4>
            <div class="mb-1 text-muted">Издано: <?php echo $args['book']['ebc_publish_date_formatted'] ?></div>
            <p class="card-text"><?php echo $args['book']['post_excerpt'] ?></p>
            <a href="<?php echo $args['book']['guid'] ?>" class="stretched-link">Узнать больше...</a>
        </div>
        <div class="col-auto d-none d-lg-block">
            <img class="bd-placeholder-img" width="200" height="250" src="<?php echo $args['book']['thumb_url'] ?>" alt="">
        </div>
    </div>
</div>
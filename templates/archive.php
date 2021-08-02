<?php
/**
 * The template for displaying archive pages
 */

get_header();

$description = get_the_archive_description();
?>

<?php if ( have_posts() ) : ?>

    <header class="page-header alignwide">
        <section class="py-0 text-center container">
            <div class="row py-lg-0">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <h1 class="fw-light mt-0" >Книги</h1>

                    <?php if ( $description ) : ?>
                        <p class="lead text-muted"><?php echo wp_kses_post( wpautop( $description ) ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    </header><!-- .page-header -->

    <div class="row mb-2">

        <?php while ( have_posts() ) : ?>

            <?php the_post(); ?>

            <?php
                $post = get_post();
                $book = ebcUtils::get_book($post->ID);
                $template_path = ebcTemplates::$list_item;

                load_template( $template_path, false, [ 'book' => $book] );
            ?>

        <?php endwhile; ?>

    </div>

<?php else : ?>
    <?php get_template_part( 'template-parts/content/content-none' ); ?>
<?php endif; ?>

<?php get_footer(); ?>

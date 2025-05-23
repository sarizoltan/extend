<?php
/**
 * Template Name: Teljes szélesség
 *
 * Teljes szélességű oldal template a blokkok számára.
 */

get_header();
?>

<main id="primary" class="site-main full-width-content">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
        <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
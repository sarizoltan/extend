<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spfood
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="content-sidebar-wrapper">
        <div class="content-area">
            <div class="three-columns">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="post-column">
                            <?php get_template_part( 'template-parts/content', get_post_format() ); ?>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
        <aside class="sidebar-area">
            <?php if ( is_active_sidebar( 'sidebar-blog' ) ) : ?>
                <?php dynamic_sidebar( 'sidebar-blog' ); ?>
            <?php endif; ?>
        </aside>
    </div>
</main>
<!-- #main -->

<?php
// NE töltsd be a sidebar-t, mivel a láblécben már megvan
// get_sidebar();
get_footer();
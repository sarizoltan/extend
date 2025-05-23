<?php
/**
 * The main template file for archive pages with 4-column grid
 */

get_header();
?>

<div class="grid-with-sidebar-wrapper">
    <main id="primary" class="content-area">

        <?php if (have_posts()) : ?>

            <header class="page-header">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </header>

            <div class="posts-grid">
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('grid-post'); ?>>
                        <?php get_template_part('template-parts/content', get_post_type()); ?>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php the_posts_navigation(); ?>

        <?php else : ?>
            <?php get_template_part('template-parts/content', 'none'); ?>
        <?php endif; ?>

    </main>

    <aside class="sidebar-wrapper">
        <?php get_sidebar(); ?>
    </aside>
</div>

<?php
get_footer();
<?php
/**
 * Template Name: Egyedi Archívum Sablon
 * Template Post Type: archive
 *
 * @package spfood
 */

get_header();
?>

<main id="primary" class="site-main full-width">
    <div class="archive-container">
        <?php if (have_posts()) : ?>

            <header class="page-header">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                echo '<p style="color:red;">Ez az archive.php</p>';

                ?>
            </header><!-- .page-header -->

            <div class="blog-grid">
                <?php
                /* Start the Loop */
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('blog-card'); ?>>
                        <div class="blog-card-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('large'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/default-blog.jpg" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <?php
                            // Kategória megjelenítése
                            $categories = get_the_category();
                            if (!empty($categories)) {
                                echo '<span class="blog-category">' . esc_html($categories[0]->name) . '</span>';
                            }
                            ?>
                        </div>
                        
                        <div class="blog-card-content">
                            <h2 class="blog-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            
                            <div class="blog-card-meta">
                                <?php echo get_the_date('j F, Y'); ?> • 
                                <?php
                                $author_id = get_the_author_meta('ID');
                                echo '<span class="author-name">' . get_the_author() . '</span>';
                                ?>
                            </div>
                        </div>
                    </article>
                <?php
                endwhile;
                ?>
            </div>

            <div class="blog-pagination">
                <?php
                // Számozott lapozó
                $big = 999999999;
                echo paginate_links(array(
                    'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                    'format' => '?paged=%#%',
                    'current' => max(1, get_query_var('paged')),
                    'total' => $wp_query->max_num_pages,
                    'prev_text' => '<span class="pagination-arrow">&lsaquo;</span>',
                    'next_text' => '<span class="pagination-arrow">&rsaquo;</span>',
                    'end_size' => 1,
                    'mid_size' => 1,
                ));
                ?>
            </div>

        <?php else : ?>

            <?php get_template_part('template-parts/content', 'none'); ?>

        <?php endif; ?>
    </div>
</main><!-- #main -->

<?php
get_footer();
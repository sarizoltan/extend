<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package spfood
 */

get_header();
?>

<div class="blog-single-container">
    <main id="primary" class="site-main blog-main">
        <?php
        while ( have_posts() ) :
            the_post();
        ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('blog-single'); ?>>
                <header class="entry-header">
                    <div class="entry-meta">
                        <h1 class="entry-title"><?php the_title(); ?></h1>

                    </div>

                    

                    
                </header>

                <?php if (has_post_thumbnail()) : ?>
                <div class="post-featured-image">
                    <?php the_post_thumbnail('full'); ?>
                </div>
                <div class="entry-meta">
                        <?php
                        // Kategória megjelenítése
                        $categories = get_the_category();
                        if (!empty($categories)) {
                            echo '<span class="category"><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></span>';
                        }
                        ?>
                        <span class="posted-date"><?php the_time('F j, Y'); ?></span>
                    </div>

                    
                    <div class="post-meta">
                        <span class="author">
                            <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                            <?php esc_html_e('Posted by ', 'spfood'); ?><a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
                        </span>
                        
                        <div class="post-actions">
                            <span class="comments-count"><i class="fas fa-comment"></i> <?php comments_number('0', '1', '%'); ?></span>
                            <span class="views-count"><i class="fas fa-eye"></i> <?php echo esc_html('87'); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                    
                    <?php
                    wp_link_pages(
                        array(
                            'before' => '<div class="page-links">' . esc_html__('Pages:', 'spfood'),
                            'after'  => '</div>',
                        )
                    );
                    ?>
                </div>

                <div class="post-share">
                    <span class="share-text"><?php esc_html_e('Share by:', 'spfood'); ?></span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" class="twitter" target="_blank"><i class="fab fa-twitter"></i></a>
                    <a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&media=<?php the_post_thumbnail_url('full'); ?>&description=<?php the_title(); ?>" class="pinterest" target="_blank"><i class="fab fa-pinterest"></i></a>
                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php the_permalink(); ?>" class="linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>

                <div class="about-author">
                    <h3><?php esc_html_e('ABOUT AUTHOR', 'spfood'); ?></h3>
                    <div class="author-box">
                        <div class="author-image">
                            <?php echo get_avatar(get_the_author_meta('ID'), 120); ?>
                        </div>
                        <div class="author-info">
                            <h4><?php the_author(); ?></h4>
                            <div class="author-role"><?php echo get_the_author_meta('user_title') ? esc_html(get_the_author_meta('user_title')) : esc_html_e('Admin', 'spfood'); ?> • <?php echo get_the_date('F j, Y'); ?></div>
                            <div class="author-description">
                                <?php the_author_meta('description'); ?>
                            </div>
                            <div class="author-social">
                                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                <a href="#" class="google"><i class="fab fa-google-plus-g"></i></a>
                                <a href="#" class="instagram"><i class="fab fa-instagram"></i></a>
                                <a href="#" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </article>

            
<div class="post-navigation">
    <?php
    $prev_post = get_previous_post();
    $next_post = get_next_post();
    ?>
    
    <div class="post-navigation-inner">
        <?php if (!empty($prev_post)) : ?>
            <div class="nav-previous">
                <a href="<?php echo esc_url(get_permalink($prev_post->ID)); ?>">
                    <div class="nav-arrow"><i class="fas fa-chevron-left"></i></div>
                    <div class="nav-content">
                        <span class="nav-label">Előző</span>
                        <h4><?php echo esc_html($prev_post->post_title); ?></h4>
                    </div>
                </a>
            </div>
        <?php endif; ?>
        
        <?php if (!empty($next_post)) : ?>
            <div class="nav-next">
                <a href="<?php echo esc_url(get_permalink($next_post->ID)); ?>">
                    <div class="nav-content">
                        <span class="nav-label">Következő</span>
                        <h4><?php echo esc_html($next_post->post_title); ?></h4>
                    </div>
                    <div class="nav-arrow"><i class="fas fa-chevron-right"></i></div>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>

            <?php
            // If comments are open or we have at least one comment, load up the comment template.
            if (comments_open() || get_comments_number()) :
                comments_template();
            endif;
            
        endwhile; // End of the loop.
        ?>

        <div class="latest-blog">
            <h2 class="section-title"><?php esc_html_e('LATEST BLOG', 'spfood'); ?></h2>
            
            <div class="latest-posts">
                <?php
                // Get latest 3 posts excluding current post
                $latest_posts = new WP_Query(array(
                    'post_type' => 'post',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                    'ignore_sticky_posts' => 1
                ));
                
                if ($latest_posts->have_posts()) :
                    while ($latest_posts->have_posts()) : $latest_posts->the_post();
                ?>
                    <div class="latest-post">
                        <a href="<?php the_permalink(); ?>" class="latest-post-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('medium'); ?>
                            <?php else : ?>
                                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/default-blog.jpg" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <div class="post-overlay">
                                <h3><?php the_title(); ?></h3>
                            </div>
                        </a>
                    </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </main>

    <aside class="blog-sidebar">
    <?php if (is_active_sidebar('sidebar-single')) : ?>
        <?php dynamic_sidebar('sidebar-single'); ?>
    <?php else : ?>
        <!-- Alapértelmezett widgetek, ha még nem adtak hozzá egyedi widgeteket -->
        
        
        
    <?php endif; ?>
</aside>
</div>




<?php
get_footer();
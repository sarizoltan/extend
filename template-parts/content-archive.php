<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spfood
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumb">
            <a href="<?php the_permalink(); ?>">
<?php the_post_thumbnail('custom-thumb'); ?>
            </a>
        </div>
    <?php endif; ?>

    <h2 class="entry-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h2>

    <div class="entry-meta">
    <?php spfood_posted_on(); ?>
    <?php spfood_posted_by(); ?>
</div>

    <div class="entry-summary"><?php the_excerpt(); ?></div>
<a class="read-more-button" href="<?php the_permalink(); ?>">Read more &raquo;</a>
</article>

<!-- #post-<?php the_ID(); ?> -->

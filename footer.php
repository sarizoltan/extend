<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package spfood
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="footer-widgets-area">
			<div class="container">
				<div class="footer-widgets-wrapper">
					<div class="footer-widget-column">
						<h3 class="footer-widget-title"><?php esc_html_e('Search', 'spfood'); ?></h3>
						<?php get_search_form(); ?>
					</div>

					<div class="footer-widget-column">
						<h3 class="footer-widget-title"><?php esc_html_e('Archives', 'spfood'); ?></h3>
						<ul>
							<?php wp_get_archives(array('type' => 'monthly')); ?>
						</ul>
					</div>

					<div class="footer-widget-column">
						<h3 class="footer-widget-title"><?php esc_html_e('About Us', 'spfood'); ?></h3>
						<div class="about-us-widget">
							<p><?php echo wp_kses_post(get_theme_mod('spfood_about_us_text', 'Delicious food delivered to your doorstep. We are committed to providing healthy, tasty meals with the freshest ingredients.')); ?></p>
						</div>
					</div>

					<div class="footer-widget-column">
						<h3 class="footer-widget-title"><?php esc_html_e('Contact', 'spfood'); ?></h3>
						<div class="contact-info">
							<p><strong><?php esc_html_e('Address:', 'spfood'); ?></strong> <?php echo esc_html(get_theme_mod('spfood_contact_address', '123 Restaurant Street, Food City')); ?></p>
							<p><strong><?php esc_html_e('Phone:', 'spfood'); ?></strong> <?php echo esc_html(get_theme_mod('spfood_contact_phone', '+1 123 456 7890')); ?></p>
							<p><strong><?php esc_html_e('Email:', 'spfood'); ?></strong> <?php echo esc_html(get_theme_mod('spfood_contact_email', 'info@spfood.com')); ?></p>
						</div>
					</div>
				</div>
				
				<div class="social-links">
					<?php if (get_theme_mod('spfood_social_facebook')) : ?>
						<a href="<?php echo esc_url(get_theme_mod('spfood_social_facebook')); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Facebook', 'spfood'); ?>"><i class="fab fa-facebook-f"></i></a>
					<?php endif; ?>
					
					<?php if (get_theme_mod('spfood_social_instagram')) : ?>
						<a href="<?php echo esc_url(get_theme_mod('spfood_social_instagram')); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Instagram', 'spfood'); ?>"><i class="fab fa-instagram"></i></a>
					<?php endif; ?>
					
					<?php if (get_theme_mod('spfood_social_twitter')) : ?>
						<a href="<?php echo esc_url(get_theme_mod('spfood_social_twitter')); ?>" target="_blank" rel="noopener" aria-label="<?php esc_attr_e('Twitter', 'spfood'); ?>"><i class="fab fa-twitter"></i></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
		
		<div class="site-info">
			<div class="container">
				<div class="copyright">
					&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
					<?php esc_html_e('All rights reserved.', 'spfood'); ?>
				</div>
				<div class="credits">
					<?php
					/* translators: 1: Theme name, 2: Theme author. */
					printf( esc_html__( 'Theme: %1$s by %2$s.', 'spfood' ), 'SPFood', '<a href="https://underscores.me/">Underscores.me</a>' );
					?>
				</div>
			</div>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
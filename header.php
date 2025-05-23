<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package spfood
 */
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
    <style>

    </style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'spfood' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<div class="header-container">
				<div class="site-branding">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php
					else :
						?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
						<?php
					endif;
					$spfood_description = get_bloginfo( 'description', 'display' );
					if ( $spfood_description || is_customize_preview() ) :
						?>
						<p class="site-description"><?php echo $spfood_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span class="menu-icon"></span>
					</button>
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
							'container'      => false,
						)
					);
					?>
				</nav><!-- #site-navigation -->
				
				<div class="header-actions">
                    <div class="user-account-wrapper">
                        <a href="#" class="header-icon user-icon" id="user-account-toggle">
                            <i class="fas fa-user"></i>
                            <?php if (!is_user_logged_in()) : ?>
                                <span class="status-text"><?php esc_html_e('Belépés', 'spfood'); ?></span>
                            <?php else : ?>
                                <span class="status-text"><?php esc_html_e('Fiókom', 'spfood'); ?></span>
                            <?php endif; ?>
                        </a>
                        <div class="user-account-dropdown" id="user-account-dropdown">
                            <?php if (!is_user_logged_in()) : ?>
                                <div class="login-register-tabs">
                                    <div class="tab-buttons">
                                        <button class="tab-button active" data-tab="login"><?php esc_html_e('Belépés', 'spfood'); ?></button>
                                        <button class="tab-button" data-tab="register"><?php esc_html_e('Regisztráció', 'spfood'); ?></button>
                                    </div>
                                    <div class="tab-content login-tab active" id="login-tab">
                                        <form id="ajax-login-form" class="ajax-auth-form">
                                            <p class="status"></p>
                                            <div class="form-group">
                                                <label for="username"><?php esc_html_e('Felhasználónév vagy email', 'spfood'); ?></label>
                                                <input id="username" type="text" name="username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="password"><?php esc_html_e('Jelszó', 'spfood'); ?></label>
                                                <input id="password" type="password" name="password" required>
                                            </div>
                                            <div class="form-group remember-me">
                                                <input type="checkbox" name="remember" id="remember">
                                                <label for="remember"><?php esc_html_e('Emlékezz rám', 'spfood'); ?></label>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="login-button"><?php esc_html_e('Belépés', 'spfood'); ?></button>
                                            </div>
                                            <div class="lost-password">
                                                <a href="<?php echo wp_lostpassword_url(); ?>"><?php esc_html_e('Elfelejtett jelszó', 'spfood'); ?></a>
                                            </div>
                                            <?php wp_nonce_field('ajax-login-nonce', 'security'); ?>
                                        </form>
                                    </div>
                                    <div class="tab-content register-tab" id="register-tab">
                                        <form id="ajax-register-form" class="ajax-auth-form">
                                            <p class="status"></p>
                                            <div class="form-group">
                                                <label for="reg-username"><?php esc_html_e('Felhasználónév', 'spfood'); ?></label>
                                                <input id="reg-username" type="text" name="username" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="reg-email"><?php esc_html_e('Email', 'spfood'); ?></label>
                                                <input id="reg-email" type="email" name="email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="reg-password"><?php esc_html_e('Jelszó', 'spfood'); ?></label>
                                                <input id="reg-password" type="password" name="password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="register-button"><?php esc_html_e('Regisztráció', 'spfood'); ?></button>
                                            </div>
                                            <?php wp_nonce_field('ajax-register-nonce', 'security'); ?>
                                        </form>
                                    </div>
                                </div>
                            <?php else : 
                                $current_user = wp_get_current_user();
                            ?>
                                <div class="user-info">
                                    <div class="user-greeting">
                                        <?php printf(esc_html__('Üdvözöllek, %s!', 'spfood'), $current_user->display_name); ?>
                                    </div>
                                    <ul class="user-menu">
                                        <?php if (class_exists('WooCommerce')) : ?>
                                            <li><a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"><?php esc_html_e('Fiókom', 'spfood'); ?></a></li>
                                            <li><a href="<?php echo esc_url(wc_get_endpoint_url('orders', '', wc_get_page_permalink('myaccount'))); ?>"><?php esc_html_e('Rendeléseim', 'spfood'); ?></a></li>
                                        <?php endif; ?>
                                        <li><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><?php esc_html_e('Kijelentkezés', 'spfood'); ?></a></li>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    
                    <?php if (class_exists('WooCommerce')) : ?>
                    <div class="cart-wrapper">
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="header-icon cart-icon" id="cart-toggle">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count">
                                <?php echo is_object(WC()->cart) ? WC()->cart->get_cart_contents_count() : '0'; ?>
                            </span>
                        </a>
                        
                        <div class="cart-dropdown" id="cart-dropdown">
                            <?php if (is_object(WC()->cart) && !WC()->cart->is_empty()) : ?>
                                <div class="cart-items">
                                    <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) : 
                                        $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                        $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                                        
                                        if ($_product && $_product->exists() && $cart_item['quantity'] > 0) :
                                            $product_name = $_product->get_name();
                                            $thumbnail = $_product->get_image();
                                            $product_price = WC()->cart->get_product_price($_product);
                                    ?>
                                    <div class="mini-cart-item">
                                        <!-- Termék eltávolítása link -->
                                        <a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>" 
                                           class="remove-item" 
                                           aria-label="<?php echo esc_attr__('Remove this item', 'spfood'); ?>"
                                           data-product_id="<?php echo esc_attr($product_id); ?>" 
                                           data-cart_item_key="<?php echo esc_attr($cart_item_key); ?>">×</a>
                                        
                                        <!-- Termék kép -->
                                        <div class="product-image">
                                            <?php echo $thumbnail; ?>
                                        </div>
                                        
                                        <!-- Termék információ -->
                                        <div class="product-info">
                                            <span class="product-name">
                                                <?php echo wp_kses_post($product_name); ?>
                                            </span>
                                        </div>
                                        
                                        <!-- Mennyiség és ár -->
                                        <div class="quantity-price">
                                            <span class="quantity"><?php echo esc_html($cart_item['quantity']); ?> × </span>
                                            <span class="price"><?php echo $product_price; ?></span>
                                        </div>
                                    </div>
                                    <?php endif; endforeach; ?>
                                </div>
                                
                                <!-- Összesítés -->
                                <div class="cart-subtotal">
                                    <span class="subtotal-label"><?php esc_html_e('Subtotal:', 'spfood'); ?></span>
                                    <span class="subtotal-amount"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                                </div>
                                
                                <!-- Gombok -->
                                <div class="cart-actions">
                                    <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-button view-cart"><?php esc_html_e('VIEW CART', 'spfood'); ?></a>
                                    <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="cart-button checkout"><?php esc_html_e('CHECKOUT', 'spfood'); ?></a>
                                </div>
                                
                            <?php else : ?>
                                <div class="empty-cart-message">
                                    <?php esc_html_e('A kosarad jelenleg üres.', 'spfood'); ?>
                                </div>
                                <div class="return-to-shop">
                                    <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="button"><?php esc_html_e('Kezdj el vásárolni', 'spfood'); ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
			</div>
		</div>
		
		<?php if (is_front_page()) : ?>
		<!-- Header Slider -->
		<div class="header-slider">
			<?php for ($i = 1; $i <= 3; $i++) : 
				$slide_data = spfood_get_slide_data($i);
				
				if (!empty($slide_data['image'])) :
					$active_class = ($i === 1) ? ' active' : '';
			?>
				<div class="slide<?php echo $active_class; ?>" style="background-image: url('<?php echo esc_url($slide_data['image']); ?>')">
					<div class="slide-content">
						<?php if (!empty($slide_data['title'])) : ?>
							<h2 class="slide-title"><?php echo esc_html($slide_data['title']); ?></h2>
						<?php endif; ?>
						
						<?php if (!empty($slide_data['description'])) : ?>
							<div class="slide-description"><?php echo wp_kses_post($slide_data['description']); ?></div>
						<?php endif; ?>
						
						<?php if (!empty($slide_data['button_text']) && !empty($slide_data['button_url'])) : ?>
							<a href="<?php echo esc_url($slide_data['button_url']); ?>" class="slide-button"><?php echo esc_html($slide_data['button_text']); ?></a>
						<?php endif; ?>
					</div>
				</div>
			<?php 
				endif;
			endfor; ?>
			
			<!-- Slider Navigation Dots -->
			<div class="slider-nav">
				<?php for ($i = 1; $i <= 3; $i++) : 
					$slide_data = spfood_get_slide_data($i);
					
					if (!empty($slide_data['image'])) :
						$active_class = ($i === 1) ? ' active' : '';
				?>
					<div class="slider-dot<?php echo $active_class; ?>" data-slide="<?php echo $i; ?>"></div>
				<?php 
					endif;
				endfor; ?>
			</div>
		</div>
		<?php endif; ?>
	</header><!-- #masthead -->

<script>
jQuery(document).ready(function($) {
    // Kosár dropdown megjelenítése/elrejtése
    $('#cart-toggle').on('click', function(e) {
        e.preventDefault();
        $('#cart-dropdown').toggleClass('active');
    });
    
    // Kattintás a dokumentumon - kosár elrejtése ha kívülre kattintunk
    $(document).mouseup(function(e) {
        var container = $("#cart-dropdown");
        if (!container.is(e.target) && container.has(e.target).length === 0 && !$('#cart-toggle').is(e.target)) {
            container.removeClass('active');
        }
    });
    
    // AJAX esemény kosár frissítéskor
    $(document.body).on('added_to_cart removed_from_cart', function() {
        // A kosár tartalmának frissítése AJAX-szal történik a WooCommerce által
    });
    
    // Termék eltávolítása AJAX-szal
    $(document).on('click', '.remove-item', function(e) {
        e.preventDefault();
        var product_id = $(this).data('product_id');
        var cart_item_key = $(this).data('cart_item_key');
        
        if (typeof wc_add_to_cart_params !== 'undefined') {
            $.ajax({
                type: 'POST',
                url: wc_add_to_cart_params.ajax_url,
                data: {
                    action: 'woocommerce_remove_from_cart',
                    cart_item_key: cart_item_key
                },
                success: function(response) {
                    if (response.fragments) {
                        $.each(response.fragments, function(key, value) {
                            $(key).replaceWith(value);
                        });
                    }
                    $(document.body).trigger('wc_fragments_refreshed');
                }
            });
        }
    });
});
</script>
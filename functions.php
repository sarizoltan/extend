<?php
/**
 * spfood functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package spfood
 */

add_theme_support( 'post-thumbnails' );
add_image_size( 'custom-thumb', 300, 200, true ); // true = crop



if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

function spfood_setup() {

	load_theme_textdomain( 'spfood', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );


	add_theme_support( 'title-tag' );


	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'spfood' ),
		)
	);


	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'spfood_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'spfood_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function spfood_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'spfood_content_width', 640 );
}
add_action( 'after_setup_theme', 'spfood_content_width', 0 );

/**
 * Register widget area.
 */
/**
 * Enqueue scripts and styles.
 */
function spfood_scripts() {
    // Alap style.css betöltése
    wp_enqueue_style( 'spfood-style', get_stylesheet_uri(), array(), _S_VERSION );
    wp_style_add_data( 'spfood-style', 'rtl', 'replace' );
    
    // Google Fonts betöltése
    wp_enqueue_style( 'spfood-google-fonts', 'https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap', array(), _S_VERSION );
    
    // Responsive CSS betöltése
    wp_enqueue_style( 'spfood-responsive', get_template_directory_uri() . '/responsive.css', array(), _S_VERSION );
    
/**
 * Helyesen betölteni a Font Awesome-ot
 */
function spfood_enqueue_fontawesome() {
    wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3' );
}
add_action( 'wp_enqueue_scripts', 'spfood_enqueue_fontawesome' );
    
    // Navigation script
    wp_enqueue_script( 'spfood-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
    
    // Slider script (jQuery függőséggel)
    wp_enqueue_script( 'spfood-slider', get_template_directory_uri() . '/js/slider.js', array('jquery'), _S_VERSION, true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'spfood_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom Slider Functions
 */
function spfood_get_slide_data($slide_number) {
    $slide_image = get_theme_mod('spfood_slider_image_' . $slide_number, '');
    $slide_title = get_theme_mod('spfood_slider_title_' . $slide_number, '');
    $slide_description = get_theme_mod('spfood_slider_description_' . $slide_number, '');
    $slide_button_text = get_theme_mod('spfood_slider_button_text_' . $slide_number, '');
    $slide_button_url = get_theme_mod('spfood_slider_button_url_' . $slide_number, '');
    
    return array(
        'image' => $slide_image,
        'title' => $slide_title,
        'description' => $slide_description,
        'button_text' => $slide_button_text,
        'button_url' => $slide_button_url
    );
}

// FontAwesome betöltése (ikonokhoz)
wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3' );

add_action('wp_head', 'add_quantity_input_style');
function add_quantity_input_style() {
    echo '<style>
        #product_quantity {
            width: 70px !important;
            height: 30px !important;
            border: 2px solid #ddd !important;
            border-radius: 5px !important;
            text-align: center;
        }
    </style>';
}


/**
 * Egyedi CSS hozzáadása a WordPress Customizer-hez
 */


// Customizer CSS szekció betöltése
require get_template_directory() . '/inc/customizer-css-section.php';

// Customizer Export/Import plugin betöltése
require get_template_directory() . '/inc/theme-plugin-loader.php';

/**
 * Bejelentkezés és kosár CSS betöltése
 */
function spfood_login_cart_styles() {
    // Login és kosár CSS betöltése
    wp_enqueue_style(
        'spfood-login-cart', 
        get_template_directory_uri() . '/css/login-cart.css', 
        array(), 
        _S_VERSION
    );
}
add_action('wp_enqueue_scripts', 'spfood_login_cart_styles');


/**
 * Header ikonok és AJAX funkciók
 */
function spfood_header_actions_scripts() {
    // Font Awesome 
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3');
    
    // Header actions script
    wp_enqueue_script('spfood-header-actions', get_template_directory_uri() . '/js/header-actions.js', array('jquery'), _S_VERSION, true);
    
    // Localize script for AJAX
    wp_localize_script('spfood-header-actions', 'spfood_ajax', array(
        'ajaxurl' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'spfood_header_actions_scripts');

/**
 * AJAX Login
 */
function spfood_ajax_login() {
    // Check security nonce
    check_ajax_referer('ajax-login-nonce', 'security');
    
    $info = array(
        'user_login' => sanitize_text_field($_POST['username']),
        'user_password' => $_POST['password'],
        'remember' => (isset($_POST['remember']) && $_POST['remember'] == 'true') ? true : false
    );
    
    $user_signon = wp_signon($info, false);
    
    if (is_wp_error($user_signon)) {
        wp_send_json_error(array(
            'message' => 'Hibás felhasználónév vagy jelszó.'
        ));
    } else {
        wp_send_json_success(array(
            'message' => 'Sikeres bejelentkezés! Átirányítás...'
        ));
    }
    
    die();
}
add_action('wp_ajax_nopriv_spfood_ajax_login', 'spfood_ajax_login');

/**
 * AJAX Register
 */
function spfood_ajax_register() {
    // Check security nonce
    check_ajax_referer('ajax-register-nonce', 'security');
    
    $username = sanitize_text_field($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];
    
    // Validate fields
    if (empty($username) || empty($email) || empty($password)) {
        wp_send_json_error(array(
            'message' => 'Minden mező kitöltése kötelező.'
        ));
    }
    
    if (!is_email($email)) {
        wp_send_json_error(array(
            'message' => 'Érvénytelen email cím.'
        ));
    }
    
    if (username_exists($username)) {
        wp_send_json_error(array(
            'message' => 'Ez a felhasználónév már foglalt.'
        ));
    }
    
    if (email_exists($email)) {
        wp_send_json_error(array(
            'message' => 'Ezzel az email címmel már regisztráltak.'
        ));
    }
    
    // Create new user
    $user_id = wp_create_user($username, $password, $email);
    
    if (is_wp_error($user_id)) {
        wp_send_json_error(array(
            'message' => $user_id->get_error_message()
        ));
    } else {
        // Auto login after registration
        wp_set_current_user($user_id);
        wp_set_auth_cookie($user_id);
        
        // Send welcome email (opcionális)
        wp_mail(
            $email,
            'Üdvözlünk a ' . get_bloginfo('name') . ' oldalon',
            'Kedves ' . $username . ',

Köszönjük a regisztrációt!

Üdvözlettel,
' . get_bloginfo('name') . ' csapata'
        );
        
        wp_send_json_success(array(
            'message' => 'Sikeres regisztráció! Átirányítás...'
        ));
    }
    
    die();
}
add_action('wp_ajax_nopriv_spfood_ajax_register', 'spfood_ajax_register');

/**
 * Egyszerűsített kosár frissítés - biztosan működő verzió
 */

// Egyedi JS kosár frissítéshez (az előzőek helyett)
function spfood_simple_cart_update_script() {
    if (is_cart()) {
        ?>
        <script>
        jQuery(document).ready(function($) {
            console.log('Simple cart update script loaded');
            
            // Ellenőrizzük a mennyiségeket betöltéskor
            $('.qty').each(function() {
                var value = parseInt($(this).val());
                if (isNaN(value) || value < 1) {
                    $(this).val(1);
                }
            });
            
            // Update gomb mindig aktív
            $('[name="update_cart"]').prop('disabled', false);
            
            // Az "Update" gombra kattintás mennyiség változtatáskor
            $('.update-btn').on('click', function(e) {
                e.preventDefault();
                // Frissítés gomb kattintás szimulálása
                $('[name="update_cart"]').click();
            });
            
            // Mennyiség változtatása után automatikus frissítés
            $('.qty').on('change', function() {
                var value = parseInt($(this).val());
                if (isNaN(value) || value < 1) {
                    $(this).val(1);
                }
                // 500ms késleltetés után frissítünk
                setTimeout(function() {
                    $('[name="update_cart"]').click();
                }, 500);
            });
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'spfood_simple_cart_update_script', 99);

// A standard WooCommerce kosár-frissítés gombot mindig engedélyezzük
function spfood_enable_update_cart_button() {
    // Remove WooCommerce disabled attribute
    ?>
    <script>
    jQuery(document).ready(function($) {
        $('button[name="update_cart"]').prop('disabled', false);
    });
    </script>
    <?php
}
add_action('wp_footer', 'spfood_enable_update_cart_button');

// Győződjünk meg, hogy a mennyiség mindig legalább 1
function spfood_ensure_min_cart_quantity($cart_item_data, $cart_item_key) {
    if (isset($cart_item_data['quantity']) && $cart_item_data['quantity'] < 1) {
        $cart_item_data['quantity'] = 1;
    }
    return $cart_item_data;
}
add_filter('woocommerce_get_cart_item_from_session', 'spfood_ensure_min_cart_quantity', 20, 2);





/**
 * Register widget area for single blog posts
 */
function spfood_widgets_init() {
    register_sidebar(
        array(
            'name'          => esc_html__('Single Post Sidebar', 'spfood'),
            'id'            => 'sidebar-single',
            'description'   => esc_html__('Add widgets here to appear in your single blog post sidebar.', 'spfood'),
            'before_widget' => '<div id="%1$s" class="sidebar-section %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="section-title">',
            'after_title'   => '</h3>',
        )
    );
    
    register_sidebar(array(
        'name'          => __('Blog Oldalsáv', 'spfood'),
        'id'            => 'sidebar-blog',
        'description'   => __('Widget terület a blog oldalsávhoz.', 'spfood'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'spfood_widgets_init');


add_action('wp_ajax_get_post_author', 'get_post_author_ajax');
add_action('wp_ajax_nopriv_get_post_author', 'get_post_author_ajax');

function get_post_author_ajax() {
    $post_id = isset($_GET['post_id']) ? intval($_GET['post_id']) : 0;
    
    if ($post_id) {
        $post = get_post($post_id);
        if ($post) {
            $author_id = $post->post_author;
            $author_name = get_the_author_meta('display_name', $author_id);
            $author_url = get_author_posts_url($author_id);
            
            wp_send_json_success([
                'html' => '<span class="byline">Posted by <a href="' . esc_url($author_url) . '" class="author">' . esc_html($author_name) . '</a></span>'
            ]);
        }
    }
    
    wp_send_json_error(['message' => 'Post not found']);
}



// Kép méretek hozzáadása
add_action('after_setup_theme', 'spfood_theme_setup');
function spfood_theme_setup() {
    add_image_size('spfood-grid-thumbnail', 400, 300, true);
}

// Template fájl felismerése
function spfood_template_include($template) {
    if (is_post_type_archive() || is_category() || is_tag() || is_date()) {
        $new_template = locate_template(array('archive-grid.php'));
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'spfood_template_include', 99);
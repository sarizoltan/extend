<?php
/**
 * Cart Page
 *
 * @package WooCommerce\Templates
 * @version 7.8.0
 */

defined( 'ABSPATH' ) || exit;

// Fejléc betöltése
get_header();
?>
<style>
/* Teljes szélességű elrendezés */
.cart-container-fullwidth {
    width: 100%;
    box-sizing: border-box;
}

/* Modern kosár stílusok */
.cart-header {
    text-align: center;
    padding: 30px 0;
    background: linear-gradient(to right, #f7f7f7, #efefef);
    margin-bottom: 30px;
}

.cart-header h1 {
    font-size: 32px;
    margin: 0;
    color: #333;
}

/* Teljes kosár tartalom konténer - belső padding */
.woocommerce-cart-container {
    padding: 0 30px 80px; /* Bal-jobb padding az oldalaktól */
    width: 100%;
    box-sizing: border-box;
}

.woocommerce-cart-form {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 30px; /* Nagyobb térköz az összegzés előtt */
}

.woocommerce-cart-form table.shop_table {
    border-collapse: collapse;
    width: 100%;
}

/* Fejléc egységes háttérszín */
.woocommerce-cart-form table.shop_table th {
    background-color: #ff7518 !important; 
    color: white !important;
    padding: 12px 15px;
    text-align: center;
    font-weight: 600;
    border-bottom: 2px solid #e9ecef;
    font-size: 15px;
}

/* Javítjuk a thumbnail cellák méretét is */
.woocommerce-cart-form .product-thumbnail {
    width: 170px !important;
    max-width: 170px !important;
    text-align: center !important;
}

/* Kerek termékképek - egyetlen specifikus szelektor */
.woocommerce-cart-form .cart-product-image,
.woocommerce-cart-form .product-thumbnail img {
    width: 150px !important;
    height: 150px !important;
    border-radius: 50% !important;
    object-fit: cover !important;
    border: 3px solid #ff7518 !important;
    padding: 3px !important;
    background: white !important;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1) !important;
    display: block !important;
    margin: 0 auto !important;
}

.woocommerce-cart-form table.shop_table td {
    padding: 15px;
    vertical-align: middle;
    border-bottom: 1px solid #eee;
    text-align: center;
}

.woocommerce-cart-form .product-name a {
    font-weight: 600;
    color: #333;
    text-decoration: none;
    transition: color 0.2s;
}

.woocommerce-cart-form .product-name a:hover {
    color: #ff6b6b;
}

/* Mennyiség input formázása */
.woocommerce-cart-form .product-quantity input.qty,
.woocommerce-cart-form .product-quantity input[type="number"] {
    width: 70px !important;
    min-width: 70px !important;
    height: 40px !important;
    padding: 0 5px !important;
    text-align: center;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
}

/* Gomb stílusok */
.woocommerce-cart-form button.button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
}

.woocommerce-cart-form button.button:hover {
    background-color: #45a049;
}

.woocommerce-cart-form a.remove {
    color: #ff6b6b;
    font-size: 1.5em;
    font-weight: 700;
    text-decoration: none;
}

.woocommerce-cart-form a.remove:hover {
    color: #ff4757;
}

/* Kupon mező */
.woocommerce-cart-form .coupon {
    display: flex;
    align-items: center;
    gap: 10px;
}

.woocommerce-cart-form .coupon input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 4px;
}

/* Nap és hét stílusok */
.day-of-week {
    display: inline-block;
    padding: 5px 10px;
    background-color: #ff6b6b;
    color: white;
    border-radius: 20px;
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 5px;
}

.week-number {
    display: inline-block;
    padding: 3px 8px;
    background-color: #f1f2f6;
    color: #666;
    border-radius: 4px;
    font-size: 12px;
}

/* Kosár összesítés - újratervezve */
.cart-collaterals {
    margin-top: 30px;
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    margin-bottom: 50px;
}

.cart-collaterals h2 {
    margin-top: 0;
    font-size: 24px;
    color: #333;
    border-bottom: 2px solid #eee;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.cart-collaterals table {
    width: 100%;
    border-collapse: collapse;
}

.cart-collaterals table th,
.cart-collaterals table td {
    padding: 15px;
    text-align: right;
    border-bottom: 1px solid #eee;
}

.cart-collaterals table th {
    font-weight: normal;
    color: #666;
    width: 60%;
}

.cart-collaterals table td {
    font-weight: bold;
    color: #333;
    font-size: 18px;
}

/* Pénztár gomb - kiemelve */
.wc-proceed-to-checkout {
    text-align: right;
    margin-top: 30px;
}

.wc-proceed-to-checkout a.checkout-button {
    display: inline-block;
    background-color: #ff7518 !important;
    color: white !important;
    padding: 15px 30px !important;
    font-size: 18px !important;
    text-decoration: none !important;
    border-radius: 6px !important;
    font-weight: bold !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
}

.wc-proceed-to-checkout a.checkout-button:hover {
    background-color: #e56b10 !important;
    box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15) !important;
    transform: translateY(-2px) !important;
}

/* Frissítés gomb stílus - Zöld helyett narancssárga */
button[name="update_cart"] {
    background-color: #ff7518 !important;
    color: white !important;
}

button[name="update_cart"]:hover {
    background-color: #e56b10 !important;
}
</style>

<div class="cart-container-fullwidth">
 

    <?php do_action( 'woocommerce_before_cart' ); ?>
<div class="cart-header">
        <h1><?php esc_html_e('Your Shopping Cart', 'woocommerce'); ?></h1>
    </div>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>

	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-remove"><?php esc_html_e('Remove', 'woocommerce'); ?></th>
                        <th class="product-kep"><?php esc_html_e('Image', 'woocommerce'); ?></th>
				<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-quantity"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
				<th class="product-tags"><?php echo __('Menu', 'woocommerce-custom-page') . '<hr>' . __('Date', 'woocommerce-custom-page'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				/**
				 * Filter the product name.
				 *
				 * @since 2.1.0
				 * @param string $product_name Name of the product in the cart.
				 * @param array $cart_item The product in the cart.
				 * @param string $cart_item_key Key for the product in the cart.
				 */
				$product_name = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );

				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-remove">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										/* translators: %s is the product name */
										esc_attr( sprintf( __( 'Remove %s from cart', 'woocommerce' ), wp_strip_all_tags( $product_name ) ) ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</td>

						<td class="product-thumbnail">
    <?php
    /**
     * Filter the product thumbnail displayed in the WooCommerce cart.
     *
     * This filter allows developers to customize the HTML output of the product
     * thumbnail. It passes the product image along with cart item data
     * for potential modifications before being displayed in the cart.
     *
     * @param string $thumbnail     The HTML for the product image.
     * @param array  $cart_item     The cart item data.
     * @param string $cart_item_key Unique key for the cart item.
     *
     * @since 2.1.0
     */
    $thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
    
    // Közvetlenül megjelenítjük a képet, link nélkül
    // Kerek stílushoz hozzáadjuk a cart-product-image osztályt
    $thumbnail_with_class = str_replace('class="', 'class="cart-product-image ', $thumbnail);
    echo $thumbnail_with_class; // PHPCS: XSS ok.
    ?>
</td>

<td class="product-name" data-title="<?php esc_attr_e( 'Product', 'woocommerce' ); ?>">
    <?php
    // Közvetlenül a termék nevét jelenítjük meg, link nélkül
    echo wp_kses_post( $_product->get_name() );
    
    do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

    // Meta data.
    echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

    // Backorder notification.
    if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
        echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
    }
    ?>
</td>

						<td class="product-price" data-title="<?php esc_attr_e( 'Price', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>

						<td class="product-quantity" data-title="<?php esc_attr_e( 'Quantity', 'woocommerce' ); ?>">
						<?php
						if ( $_product->is_sold_individually() ) {
							$min_quantity = 1;
							$max_quantity = 1;
						} else {
							$min_quantity = 0;
							$max_quantity = $_product->get_max_purchase_quantity();
						}

						$product_quantity = woocommerce_quantity_input(
							array(
								'input_name'   => "cart[{$cart_item_key}][qty]",
								'input_value'  => $cart_item['quantity'],
								'max_value'    => $max_quantity,
								'min_value'    => $min_quantity,
								'product_name' => $product_name,
							),
							$_product,
							false
						);

						echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
						?>
						</td>

						<td class="product-subtotal" data-title="<?php esc_attr_e( 'Subtotal', 'woocommerce' ); ?>">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
							?>
						</td>
						<td class="product-tags">
                                    <?php
                                    // Napok azonosítása a címkék között
                                    $product_tags = get_the_terms($product_id, 'product_tag');
                                    $day_of_week = '';
                                    
                                    // Napok, amiket keresünk
                                    $weekdays = array(
                                        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday',
                                        'Hétfő', 'Kedd', 'Szerda', 'Csütörtök', 'Péntek', 'Szombat', 'Vasárnap'
                                    );
                                    
                                    if (!empty($product_tags) && !is_wp_error($product_tags)) {
                                        foreach ($product_tags as $tag) {
                                            if (in_array($tag->name, $weekdays)) {
                                                $day_of_week = $tag->name;
                                                break;
                                            }
                                        }
                                    }
                                    
                                    // Nap megjelenítése
                                    if (!empty($day_of_week)) {
                                        echo '<span class="day-of-week">' . esc_html($day_of_week) . '</span>';
                                    }

                                    // Hét számának kiolvasása és megjelenítése
                                    $week_number = get_post_meta($product_id, 'week_number', true);

                                    if (!empty($week_number)) {
                                        echo '<br><span class="week-number">Week ' . esc_html($week_number) . '</span>';
                                    } else {
                                        echo '<br><span class="week-number">N/A</span>';
                                    }
                                    ?>
                                </td>
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr>
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code" class="screen-reader-text"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>

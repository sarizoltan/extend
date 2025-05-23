<?php
/**
 * Checkout Form - Egy oszlopos elrendezés
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_checkout_form', $checkout );

// If checkout registration is disabled and not logged in, the user cannot checkout.
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) ) );
	return;
}

?>

<style>
/* Egy oszlopos elrendezés */
.woocommerce-checkout .col2-set,
.woocommerce-checkout #customer_details {
    display: block;
    width: 100%;
}

.woocommerce-checkout .col-1,
.woocommerce-checkout .col-2 {
    float: none !important;
    width: 100% !important;
    margin-bottom: 30px;
}

/* Beviteli mezők teljes szélességűek */
.woocommerce-checkout .form-row {
    display: block;
    width: 100%;
}

/* Egységes szekció stílus */
.woocommerce-checkout .woocommerce-billing-fields,
.woocommerce-checkout .woocommerce-shipping-fields,
.woocommerce-checkout .woocommerce-additional-fields,
#order_review {
    background: #fff;
    padding: 25px;
    margin-bottom: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

/* Szekció címek */
.woocommerce-checkout h3 {
    margin-top: 0;
    padding-bottom: 15px;
    border-bottom: 1px solid #eee;
    margin-bottom: 20px;
}

/* Nap és hét stílusok a rendelési összesítőben */
.day-of-week-checkout {
    display: inline-block;
    padding: 4px 8px;
    background-color: #ff6b6b;
    color: white;
    border-radius: 20px;
    font-size: 12px;
    font-weight: bold;
    margin-right: 5px;
}

.week-number-checkout {
    display: inline-block;
    padding: 2px 6px;
    background-color: #f1f2f6;
    color: #666;
    border-radius: 4px;
    font-size: 11px;
    margin-left: 5px;
}
</style>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" aria-label="<?php echo esc_attr__( 'Checkout', 'woocommerce' ); ?>">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

        <!-- Egy oszlopos elrendezés minden egymás alatt -->
		<div id="customer_details">
            <!-- Számlázási adatok -->
            <div class="billing-details-section">
				<?php do_action( 'woocommerce_checkout_billing' ); ?>
            </div>

            <!-- Szállítási adatok (ha szükséges) -->
            <div class="shipping-details-section">
				<?php do_action( 'woocommerce_checkout_shipping' ); ?>
            </div>

            <!-- További információk (ha vannak) -->
            <div class="additional-info-section">
                <?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
            </div>
		</div>

	<?php endif; ?>
	
	<?php do_action( 'woocommerce_checkout_before_order_review_heading' ); ?>
	
	<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h3>
	
	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<?php 
		// Közvetlenül betöltjük a review-order.php-t
		wc_get_template( 'checkout/review-order.php' );
		
		// A fizetési módokat külön betöltjük
		wc_get_template( 'checkout/payment.php' );
		?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
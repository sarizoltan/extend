<?php
/**
 * Átírt mennyiség input template
 */

defined( 'ABSPATH' ) || exit;

$input_id = uniqid( 'quantity_' );
$input_name = 'quantity';
$input_value = $min_value;
if ( isset( $custom_attributes['input_name'] ) ) {
	$input_name = $custom_attributes['input_name'];
	unset( $custom_attributes['input_name'] );
}
if ( isset( $custom_attributes['input_value'] ) ) {
	$input_value = $custom_attributes['input_value'];
	unset( $custom_attributes['input_value'] );
}

// További stílusok hozzáadása
$custom_attributes['style'] = 'width: 70px; height: 40px; min-width: 70px;';
?>
<div class="quantity">
	<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php esc_html_e( 'Quantity', 'woocommerce' ); ?></label>
	<input
		type="number"
		id="<?php echo esc_attr( $input_id ); ?>"
		class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?>"
		name="<?php echo esc_attr( $input_name ); ?>"
		value="<?php echo esc_attr( $input_value ); ?>"
		title="<?php echo esc_attr_x( 'Qty', 'Product quantity input tooltip', 'woocommerce' ); ?>"
		size="4"
		min="<?php echo esc_attr( $min_value ); ?>"
		max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
		<?php if ( ! $readonly ) : ?>
			step="<?php echo esc_attr( $step ); ?>"
			placeholder="<?php echo esc_attr( $placeholder ); ?>"
			inputmode="<?php echo esc_attr( $inputmode ); ?>"
			autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
		<?php endif; ?>
		<?php echo $readonly ? 'readonly="readonly"' : ''; ?>
		<?php echo $custom_attributes ? wc_implode_html_attributes( $custom_attributes ) : ''; ?>
	/>
</div>
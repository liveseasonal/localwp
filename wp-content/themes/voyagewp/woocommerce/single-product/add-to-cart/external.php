<?php
/**
 * External product add to cart
 *
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.1.0
 */

if(!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

?>

<?php do_action('woocommerce_before_add_to_cart_button'); ?>

<p class="cart">
	<?php
	//Overriden add to cart button
	do_action('voyage_mikado_woocommerce_add_to_cart_button_external');
	?>
</p>

<?php do_action('woocommerce_after_add_to_cart_button'); ?>

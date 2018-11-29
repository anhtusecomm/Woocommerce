<?php

/**
 * Add the order_comments field to the cart
 **/
add_action('woocommerce_cart_collaterals', 'order_comments_custom_cart_field');

function order_comments_custom_cart_field() {
    echo '';
?>
<div id="cart_order_notes-block">
	<div id="custom-gift-block">
		<input type="checkbox" id="reveal-email" role="button">
<label for="reveal-email" style="width: 300px">Free Christmas gift wrapping</label><div id="cart_order_notes">
<div class="customer_notes_on_cart">
<label for="customer_notes_text"><?php _e('','woocommerce'); ?></label>
<label for="label_to">To: </label>	
<textarea id="customer_notes_text_to" style="border:1px solid #e1e1e1;" ></textarea>
<label for="label_form">From: </label>	
<textarea id="customer_notes_text_form" style="border:1px solid #e1e1e1;"></textarea>
</div>
<?php
}

/**
 * Process the checkout and overwriting the normal button
 *
 */
function woocommerce_button_proceed_to_checkout() {
    $checkout_url = wc_get_checkout_url();
    ?>
       <form id="checkout_form" method="POST" action="<?php echo $checkout_url; ?>">
       <input type="hidden" name="customer_notes1" id="customer_notes1" value="">
	   <input type="hidden" name="customer_notes2" id="customer_notes2" value="">
       <a  href="#" onclick="document.getElementById('customer_notes1').value=document.getElementById('customer_notes_text_to').value;document.getElementById('customer_notes2').value=document.getElementById('customer_notes_text_form').value;document.getElementById('checkout_form').submit()" class="checkout-button button alt wc-forward">
       <?php _e( 'Proceed to checkout', 'woocommerce' ); ?></a>
       </form>
       <?php
     }


/**
 * getting the values in checkout again
*/
add_action('woocommerce_checkout_before_customer_details',function(){
?>

<script>
jQuery( document ).ready(function() {
    jQuery('#order_comments' ).val("To: "+"<?php echo sanitize_text_field($_POST['customer_notes1']); ?>"+"\n\n"+""+"From: "+"<?php echo sanitize_text_field($_POST['customer_notes2']); ?>");
});
</script>

<?php 
});
<?php
/* call to action to keep buying above specific amount to get free shipping */
add_action( 'woocommerce_before_cart', 'bbloomer_free_shipping_cart_notice' );
function bbloomer_free_shipping_cart_notice() {
   $min_amount = 300; //change this to your free shipping threshold
   $current = WC()->cart->subtotal;
   if ( $current < $min_amount ) {
      $added_text = 'הוסיפו עוד ' . wc_price( $min_amount - $current ) . ' וקבלו משלוח חינם!';
      $return_to = wc_get_page_permalink( 'shop' );
      $notice = sprintf( '<a href="%s" class="button wc-forward">%s</a> %s', esc_url( $return_to ), 'המשיכו לקנות', $added_text );
      wc_print_notice( $notice, 'notice' );
   } 
}

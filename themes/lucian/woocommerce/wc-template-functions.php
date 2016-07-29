<?php
if( !function_exists('zo_woo_share') ) {
    /**
     * WooCommerce Share Hook
     */
    function zo_woocommerce_more_info() {
?>
	    <?php if ( is_active_sidebar( 'sidebar-shop-info' ) ) : ?>
		    <div class="woocommerce-shop-info">
		    <?php dynamic_sidebar( 'sidebar-shop-info' ); ?>
		    </div>
	    <?php endif; ?>
	    <ul class="woocommerce-socials">
			<li><?php esc_html_e('Share with','lucian');?></li>
		    <li><a title="Share to Facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-facebook"></i></a></li>
		    <li><a title="Share to Pinterest" href="http://pinterest.com/pin/create/button?url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-pinterest"></i></a></li>
		    <li><a title="Share to Twitter" href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-twitter"></i></a></li>
		    <li><a title="Share to Google" href="https://plus.google.com/share?url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-google-plus"></i></a></li>
		    <li><a title="Share to Linkedin" href="https://www.linkedin.com/cws/share?url=<?php echo get_the_permalink(); ?>" onclick="javascript:void window.open(this.href,'','width=600,height=300,resizable=true,left=200px,top=200px');return false;"><i class="fa fa-linkedin"></i></a></li>
	    </ul>
<?php
    }
}
add_action('woocommerce_share', 'zo_woocommerce_more_info');
/*
** Remove tabs from product details page
*/
function zo_woocommerce_remove_product_tabs( $tabs ) {
    unset( $tabs['additional_information'] ); // Remove the additional information tab
    return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'zo_woocommerce_remove_product_tabs', 98 );

/**
 * Add Cart Clear Cart Function
 */
add_action('init', 'zo_woocommerce_clear_cart_url');
function zo_woocommerce_clear_cart_url() {
    global $woocommerce;
    if( isset($_REQUEST['clear_cart']) ) {
        $woocommerce->cart->empty_cart();
    }
}

//add wrap for '(Free)' or '(FREE!)' label text on cart page for Shipping and Handling
function zo_custom_shipping_free_label( $label ) {
    $label =  str_replace( "(Free)", '<span class="amount">Free</span>', $label );
    $label =  str_replace( "(FREE!)", '<span class="amount">FREE!</span>', $label );
    return $label;
}
add_filter( 'woocommerce_cart_shipping_method_full_label' , 'zo_custom_shipping_free_label' );
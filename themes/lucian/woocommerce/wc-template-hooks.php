<?php
/**
 * WooCommerce Template Hooks
 *
 * Action/filter hooks used for WooCommerce functions/templates
 *
 * @author 		WooThemes
 * @category 	Core
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * woocommerce_after_single_product_summary hook
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @hooked woocommerce_output_related_products - 20
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/**
 * woocommerce_after_single_product hook
 */
add_action('woocommerce_after_single_product', 'woocommerce_output_product_data_tabs', 10);

/**
 * zo_woocommerce_related_products hook
 */
add_action('zo_woocommerce_related_products', 'woocommerce_output_related_products', 10);


/**
 * woocommerce_single_product_summary hook
 *
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_rating - 10
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 35 );

/**
* woocommerce_before_main_content hook
*
* @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
* @hooked woocommerce_breadcrumb - 20
*/
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );


/**
 * Hook in on activation
 */
/**
 * Define image sizes
 */
function zo_woocommerce_image_dimensions() {
	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
		return;
	}
	$catalog = array(
		'width' 	=> '480',	// px
		'height'	=> '515',	// px
		'crop'		=> 1 		// true
	);
	$single = array(
		'width' 	=> '600',	// px
		'height'	=> '600',	// px
		'crop'		=> 1 		// true
	);
	$thumbnail = array(
		'width' 	=> '120',	// px
		'height'	=> '120',	// px
		'crop'		=> 0 		// false
	);
	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}
add_action( 'after_switch_theme', 'zo_woocommerce_image_dimensions', 1 );

/**
 * Changes the number of columns under our main image on single product pages
 *
 * @since 1.0
 * @author WP Theme Tutorial, Curtis McHale
 */
function zo_woocommerce_thumbnail_columns( $number ){
	return 5;
} // wptt_four_colums
add_filter( 'woocommerce_product_thumbnails_columns', 'zo_woocommerce_thumbnail_columns');


/**
 * WooCommerce List / Grid view functions
 * @author Zacky
 * @since 1.0
 */
//remove single except
add_action( 'wp', function () {
	if ( is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy() ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_single_excerpt', 5 );
		add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_single_excerpt', 7 );
	}
}, 25 );


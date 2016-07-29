<?php 
/* get categories */
$taxo = 'product_cat';
$_category = array();
if(!isset($atts['cat']) || $atts['cat']==''){
    $terms = get_terms($taxo);
    foreach ($terms as $cat){
        $_category[] = $cat->term_id;
    }
} else {
    $_category  = explode(',', $atts['cat']);
}
$atts['categories'] = $_category;
$zo_full_width = isset($atts['zo_full_width']) ? $atts['zo_full_width'] : '';
$zo_filter_style = isset($atts['zo_filter_style']) ? $atts['zo_filter_style'] : '';
$zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
?>
<div class="zo-grid-wrapper <?php echo esc_attr($atts['template']);?> <?php echo esc_attr($zo_full_width); ?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if( isset($atts['filter']) && $atts['filter'] == 1 && $atts['layout']=='masonry'):?>
        <div class="zo-grid-filter zo-filter <?php echo esc_attr($zo_filter_style); ?>">
            <ul class="zo-filter-category list-unstyled list-inline">
                <li><a class="active" href="#" data-group="all"><?php esc_html_e('All', 'lucian'); ?></a></li>
                <?php foreach($atts['categories'] as $category):?>
                    <?php $term = get_term( $category, $taxo );?>
                    <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                            <?php echo esc_attr($term->name); ?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>
    <div class="<?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            ?>
            <div class="zo-grid-item <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
	            <div class="product zo-product-teaser">
		            <div class="zo-product-image">
			            <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
			            <a href="<?php the_permalink(); ?>" title="<?php esc_html_e('View detail', 'lucian'); ?>">
				            <?php
				            /**
				             * woocommerce_before_shop_loop_item_title hook
				             *
				             * @hooked woocommerce_show_product_loop_sale_flash - 10
				             * @hooked woocommerce_template_loop_product_thumbnail - 10
				             */
				            do_action( 'woocommerce_before_shop_loop_item_title' );
				            ?>
			            </a>
		            </div>
		            <div class="zo-product-overlay">
			            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
			            <div class="zo-product-overlay-inner">
				            <h3 class="zo-product-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
				            <?php
				            /**
				             * woocommerce_after_shop_loop_item_title hook
				             *
				             * @hooked woocommerce_template_loop_rating - 5
				             * @hooked woocommerce_template_loop_price - 10
				             */
				            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
				            do_action( 'woocommerce_after_shop_loop_item_title' );
				            ?>
				            <div class="zo-product-action">
					            <?php
					            /**
					             * woocommerce_after_shop_loop_item hook
					             *
					             * @hooked woocommerce_template_loop_add_to_cart - 10
					             */
					            do_action( 'woocommerce_after_shop_loop_item' );
					            ?>
				            </div>
			            </div>
		            </div>
	            </div>
            </div>
            <?php
        }
        ?>
    </div>
    <?php
    wp_reset_postdata();
    ?>
</div>
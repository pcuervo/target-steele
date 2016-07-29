<?php
/* Get Categories */
$taxonomy = 'testimonial-category';
$_category = array();
if(!isset($atts['cat']) || $atts['cat']=='' && taxonomy_exists($taxonomy)){
    $terms = get_terms($taxonomy);
    foreach ($terms as $cat){
        $_category[] = $cat->term_id;
    }
} else {
    $_category  = explode(',', $atts['cat']);
}
$atts['categories'] = $_category;
$zo_full_width = isset($atts['zo_full_width']) ? $atts['zo_full_width'] : '';
$zo_title_size = isset( $atts['zo_title_size'] ) ? $atts['zo_title_size'] : 'h2';
?>
<div class="zo-grid-wrapper <?php echo esc_attr($atts['template']);?> <?php echo esc_attr($zo_full_width); ?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if( isset($atts['filter']) && $atts['filter']== 1 && $atts['layout']=='masonry'):?>
        <div class="zo-grid-filter">
            <ul>
                <li><a class="active" href="#" data-group="all"><?php esc_html_e('All', 'lucian'); ?></a></li>
                <?php foreach($atts['categories'] as $category):?>
                    <?php $term = get_term( $category, 'category' );?>
                    <li><a href="#" data-group="<?php echo esc_attr('category-'.$term->slug);?>">
                            <?php echo esc_attr($term->name); ?>
                        </a>
                    </li>
                <?php endforeach;?>
            </ul>
        </div>
    <?php endif;?>
    <div class="<?php echo esc_attr($atts['grid_class']);?> row">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID()) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            $post_meta = zo_post_meta_data();
            ?>
            <div class="zo-testimonial-wrap <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <div class="zo-testimonial-inner">
                    <?php if(has_post_thumbnail()) : ?>
                    <div class="zo-testimonial-image">
                        <?php the_post_thumbnail( 'medium' ); ?>
                    </div>
                    <?php endif ?>
                    <div class="zo-testimonial-body">
                        <div class="zo-testimonial-content"><?php the_excerpt(); ?></div>
                        <<?php echo esc_attr($zo_title_size); ?>  class="zo-testimonial-title"><?php the_title();?> <?php esc_html_e('-', 'lucian'); ?> <span class="zo-testimonial-position"><?php echo esc_attr($post_meta->_zo_testimonial_position); ?></span></<?php echo esc_attr($zo_title_size); ?> >
                    </div>
                </div>

            </div>
            <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</div>
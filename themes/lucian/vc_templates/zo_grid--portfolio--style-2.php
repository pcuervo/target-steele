<?php 
/* get categories */
$taxo = 'portfolio-category';
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
    <div class="row <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        $size = ( isset($atts['layout']) && $atts['layout']=='basic')?'thumbnail':'medium';
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            ?>
            <div class="zo-portfolio-item <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <div class="zo-portfolio-inner">
                    <?php if(has_post_thumbnail()) echo zo_post_thumbnail(370, 330, true); ?>
                    <div class="zo-portfolio-overlay">
                        <div class="zo-portfolio-overlay-inner">
                            <<?php echo esc_attr($zo_title_size); ?> class="zo-portfolio-title"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></<?php echo esc_attr($zo_title_size); ?>>
                            <div class="zo-portfolio-categories">
                                <?php echo get_the_term_list( get_the_ID(), $taxo, '', ' / ', '' ); ?>
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
<?php
/* Get Categories */
$taxonomy = 'category';
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
?>
<div class="zo-blog-latest-wrapper">
    <div class="zo-carousel-wrap">
        <?php if ( $atts['filter'] == "true" && !$atts['loop'] ): ?>
            <div class="zo-carousel-filter">
                <ul>
                    <li><a class="active" href="#" data-group="all">All</a></li>
                    <?php foreach ($atts['categories'] as $category): ?>
                        <?php $term = get_term($category, $taxonomy); ?>
                        <li><a href="#" data-group="<?php echo esc_attr('category-' . $term->slug); ?>">
                                <?php echo esc_attr($term->name); ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="zo-carousel-filter-hidden" style="display: none"></div>
        <?php endif; ?>
        <div class="zo-carousel <?php echo esc_attr($atts['template']); ?>" id="<?php echo esc_attr($atts['html_id']); ?>">
            <?php
            $posts = $atts['posts'];
            while ($posts->have_posts()) :
                $posts->the_post();
                $groups = array();
                $groups[] = 'zo-carousel-filter-item all';
                foreach (zoGetCategoriesByPostID(get_the_ID(), $taxonomy) as $category) {
                    $groups[] = 'category-' . $category->slug;
                }
                ?>
                <div class="zo-blog-item <?php echo implode(' ', $groups);?>">

                    <?php
                    if( has_post_thumbnail() ) :
                        echo zo_post_thumbnail(385, 346, true);
                    endif;
                    ?>
                    <div class="zo-blog-overlay">
                        <h2 class="zo-blog-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></h2>
                    </div>
                </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
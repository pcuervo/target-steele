<?php 
    /* get categories */
        $taxo = 'category';
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
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID(),$taxo) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            ?>
            <div class="<?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <div class="zo-blog-item">
                    <div class="zo-blog-header">
                        <?php
                        if( has_post_thumbnail() ) :
                            echo zo_post_thumbnail(385, 346, true);
                        endif;
                        ?>
                        <div class="zo-blog-overlay">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <<?php echo esc_attr($zo_title_size); ?> class="zo-blog-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></<?php echo esc_attr($zo_title_size); ?>>
                    <div class="zo-blog-content"><?php echo zo_limit_words(get_the_excerpt(), 10); ?></div>
                    <ul class="zo-blog-meta">
                        <li class="zo-blog-date"><?php the_time('M d, Y'); ?> / </li>
                        <li class="zo-blog-comment"><a href="<?php comments_link(); ?>"><?php comments_number('0','1','%'); ?></a> <?php esc_html_e('comments', 'lucian') ?></li>
                    </ul>
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
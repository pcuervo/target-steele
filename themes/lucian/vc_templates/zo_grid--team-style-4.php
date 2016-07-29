<?php
global $smof_data;
/* Get Categories */
$taxonomy = 'team-category';
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
    <div class="row <?php echo esc_attr($atts['grid_class']);?>">
        <?php
        $posts = $atts['posts'];
        while($posts->have_posts()){
            $posts->the_post();
            $groups = array();
            $groups[] = '"all"';
            foreach(zoGetCategoriesByPostID(get_the_ID()) as $category){
                $groups[] = '"category-'.$category->slug.'"';
            }
            $team_meta = zo_post_meta_data();
            ?>
            <div class="zo-team-wrap <?php echo esc_attr($atts['item_class']);?>" data-groups='[<?php echo implode(',', $groups);?>]'>
                <div class="zo-team-inner">
                    <?php if(has_post_thumbnail()) : ?>
                        <div class="zo-team-image">
                            <?php echo zo_post_thumbnail(370, 332, true); ?>
                        </div>
                    <?php endif ?>
                    <<?php echo esc_attr($zo_title_size); ?> class="zo-team-title"><?php the_title(); ?></<?php echo esc_attr($zo_title_size); ?>>
                    <div class="zo-team-position"><?php echo esc_attr($team_meta->_zo_team_position); ?></div>
	                <div class="zo-team-about"><?php the_content(); ?></div>
	                <?php if(isset($team_meta->_zo_socials) && !empty($team_meta->_zo_socials)): ?>
		                <ul class="zo-team-socials">
			                <?php
			                $socials = json_decode($team_meta->_zo_socials);
			                if($socials):
				                foreach($socials as $key => $item): ?>
					                <li>
						                <a href="<?php echo do_shortcode($item->link);?>" target="_blank">
							                <i class="fa <?php echo do_shortcode($item->icon);?>"></i>
						                </a>
					                </li>
				                <?php endforeach;
			                endif;
			                ?>
		                </ul>
	                <?php endif;?>
                </div>
            </div>
        <?php
        }
        wp_reset_postdata();
        ?>
    </div>
</div>
<div class="zo-pricing-default">
    <div class="zo-carousel <?php echo esc_attr($atts['template']); ?>" id="<?php echo esc_attr($atts['html_id']); ?>">
        <?php
        $posts = $atts['posts'];
        $i = 1;
        while ($posts->have_posts()) :
            $posts->the_post();
            $pricing_meta = zo_post_meta_data();
            ?>
            <div class="zo-pricing-item <?php echo 0 === $i++ % 2 ? 'even' : 'odd'; ?> <?php echo esc_attr($atts['item_class']);?> <?php echo ( $pricing_meta->_zo_is_feature == 1 ) ? ' pricing-feature-item' : '' ?> ">
                <div class="zo-pricing-inner">
                    <h2 class="zo-pricing-title" style="background-color: <?php echo esc_attr($pricing_meta->_zo_color); ?>"><?php the_title();?></h2>
                    <?php if ( $pricing_meta->_zo_is_feature == 1 ) : ?>
                        <span class="featured"><?php esc_html_e('Popular', 'lucian'); ?></span>
                    <?php endif; ?>

                    <div class="zo-pricing-price">
                        <sup><?php esc_html_e('$', 'lucian'); ?></sup>
                        <span class="price"><?php echo esc_attr($pricing_meta->_zo_price); ?></span>
                        <div class="time"><?php esc_html_e('per', 'lucian'); ?> <?php echo esc_attr($pricing_meta->_zo_value); ?></div>
                    </div>

                    <div class="zo-pricing-meta">
                        <?php the_content(); ?>
                    </div>
                    <div class="zo-pricing-button">
                        <?php printf('<a class="btn-pricing" href="%s">%s <i class="fa fa-chevron-circle-right"></i></a>', esc_url($pricing_meta->_zo_button_url), esc_attr($pricing_meta->_zo_button_text) ) ; ?>
                    </div>
                </div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
</div>
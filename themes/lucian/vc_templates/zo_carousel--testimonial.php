<div class="zo-carousel-wrap">
    <div class="zo-carousel <?php echo esc_attr($atts['template']); ?>" id="<?php echo esc_attr($atts['html_id']); ?>">
        <?php
        $posts = $atts['posts'];
        while ($posts->have_posts()) :
            $posts->the_post();
            $post_meta = zo_post_meta_data();
        ?>
            <div class="zo-testimonial-item">
                <div class="zo-testimonial-image">
                    <?php the_post_thumbnail('thumbnail'); ?>
                </div>
                <div class="zo-testimonial-content"><?php the_content(); ?></div>
                <h2 class="zo-carousel-title"><?php the_title();?></h2>
                <div class="zo-carousel-job"><?php echo esc_attr($post_meta->_zo_testimonial_position); ?></div>
            </div>
        <?php
        endwhile;
        wp_reset_postdata();
        ?>
    </div>
</div>
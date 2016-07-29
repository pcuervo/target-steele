<?php 
$icon_name = "icon_" . $atts['icon_type'];
$iconClass = isset($atts[$icon_name])?$atts[$icon_name]:'';
$zo_fancybox_style = isset($atts['zo_fancybox_style']) ? $atts['zo_fancybox_style'] : '';
$zo_title_size = isset($atts['zo_title_size']) ? $atts['zo_title_size'] : 'h2';
$zo_fancybox_bg_color = isset($atts['zo_fancybox_bg_color']) ? $atts['zo_fancybox_bg_color'] : '';
$zo_fancybox_border_color = isset($atts['zo_fancybox_border_color']) ? $atts['zo_fancybox_border_color'] : '';
$zo_fancybox_icon_color = isset($atts['zo_fancybox_icon_color']) ? $atts['zo_fancybox_icon_color'] : '';
$zo_fancybox_title_color = isset($atts['zo_fancybox_title_color']) ? $atts['zo_fancybox_title_color'] : '';
$zo_fancybox_content_color = isset($atts['zo_fancybox_content_color']) ? $atts['zo_fancybox_content_color'] : '';
?>
<div class="zo-fancyboxes-wraper <?php echo esc_attr($zo_fancybox_style); ?> <?php echo esc_attr($atts['template']);?>" id="<?php echo esc_attr($atts['html_id']);?>">
    <?php if($atts['title']!=''):?>
        <div class="zo-fancyboxes-head">
            <div class="zo-fancyboxes-title">
                <?php echo apply_filters('the_title',$atts['title']);?>
            </div>
            <div class="zo-fancyboxes-description">
                <?php echo apply_filters('the_content',$atts['description']);?>
            </div>
        </div>
    <?php endif;?>
    <div class="zo-fancyboxes-body">
        <div class="zo-fancybox-item">
            <?php
            $button_link = isset($atts['button_link']) ? $atts['button_link'] : '';
            $image_url = '';
            if (!empty($atts['image'])) {
                $attachment_image = wp_get_attachment_image_src($atts['image'], 'full');
                $image_url = $attachment_image[0];
            }
            ?>
            <div class="zo-fancybox-inner">
                <?php if ($image_url): ?>
                    <div class="zo-fancybox-icon zo-fancybox-image">
                        <img src="<?php echo esc_attr($image_url); ?>" alt=""/>
                    </div>
                <?php else : ?>
                    <div class="zo-fancybox-icon zo-fancybox-font" style="background-color: <?php echo esc_attr($zo_fancybox_bg_color); ?>; border-color: <?php echo esc_attr($zo_fancybox_border_color);?>; color: <?php echo esc_attr($zo_fancybox_icon_color);?>">
                        <i class="<?php echo esc_attr($iconClass);?>"></i>
                    </div>
                <?php endif; ?>
                <?php if($atts['title_item']):?>
                    <<?php echo esc_attr($zo_title_size); ?> class="zo-fancybox-title" style="color: <?php echo esc_attr($zo_fancybox_title_color); ?>"><?php echo apply_filters('the_title',$atts['title_item']);?></<?php echo esc_attr($zo_title_size); ?>>
                <?php endif; ?>
                <?php if( isset($atts['description_item']) && $atts['description_item']): ?>
                    <div class="zo-fancybox-content" style="color: <?php echo esc_attr($zo_fancybox_content_color); ?>">
                        <?php echo apply_filters('the_content',$atts['description_item']);?>
                    </div>
                <?php endif ;?>
                <?php if($atts['button_text']!=''):?>
                    <div class="zo-fancyboxes-readmore">
                        <?php
                        $class_btn = ($atts['button_type']=='button') ? 'btn btn-primary':'';
                        ?>
                        <a href="<?php echo esc_url($button_link);?>" class="<?php echo esc_attr($class_btn);?>"><?php echo esc_attr($atts['button_text']);?></a>
                    </div>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
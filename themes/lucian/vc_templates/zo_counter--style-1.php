<div class="zo-counter-wraper zo-counter-layout-default <?php echo esc_attr($atts['template']); ?>"
     id="<?php echo esc_attr($atts['html_id']); ?>">
    <?php if ($atts['title'] != ''): ?>
        <div class="zo-counter-head">
            <div class="zo-counter-title">
                <?php echo apply_filters('the_title', $atts['title']); ?>
            </div>
            <div class="zo-counter-description">
                <?php echo apply_filters('the_content', $atts['description']); ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="row zo-counter-body">
        <?php
        for ($i = 1; $i <= (int)$atts['zo_cols']; $i++) { ?>
            <?php
            $title = isset($atts['title' . $i]) ? $atts['title' . $i] : '';
            $icon = isset($atts['icon' . $i]) ? $atts['icon' . $i] : '';
            $type = isset($atts['type' . $i]) ? $atts['type' . $i] : '';
            $suffix = isset($atts['suffix' . $i]) ? $atts['suffix' . $i] : '';
            $prefix = isset($atts['prefix' . $i]) ? $atts['prefix' . $i] : '';
            $digit = isset($atts['digit' . $i]) ? $atts['digit' . $i] : '60';
            $grouping = isset($atts['grouping']) ? $atts['grouping'] : 'false';
            $separator = isset($atts['separator']) ? $atts['separator'] : ',';
            $description = isset($atts['description' . $i]) ? $atts['description' . $i] : '';
            ?>
            <div class="zo-counter-item <?php echo esc_attr($atts['item_class']);?>">
                <div class="zo-counter-box">
                    <div class="zo-counter-process" data-percent="<?php echo esc_attr($digit);?>" data-suffix="<?php echo esc_attr($suffix);?>">
                        <div class="ppc-progress">
                            <div class="ppc-progress-fill"></div>
                        </div>
                        <div class="ppc-progress-fill-circle"></div>
                        <div class="zo-counter-middle ppc-percents">
                            <div class="pcc-percents-wrapper">
                                <div class="pcc-percents-inner">
                                    <?php if( $icon ): ?>
                                        <span class="zo-counter-icon"><i class="fa <?php echo esc_attr($icon); ?>"></i></span>
                                    <?php endif; ?>
                                    <div id="counter_<?php echo esc_attr($atts['html_id'].'_item_'.$i);?>" class="zo-process-counter <?php echo esc_attr(strtolower($type));?>"></div>
                                    <?php if($title):?>
                                    <h2 class="zo-counter-title">
                                        <?php echo apply_filters('the_title',$title);?>
                                    </h2>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php }
        ?>
    </div>
</div>
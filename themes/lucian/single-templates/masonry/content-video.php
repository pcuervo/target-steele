<?php
/**
 * The default template for displaying content
 *
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-teaser'); ?>>
    <div class="zo-blog-image zo-blog-video">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail( 'full' ); ?>
            <div class="overlay">
                <div class="overlay-inner">
                    <a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel="">
                        <i class="play-button ion-ios-play-outline"></i>
                    </a>
                </div>
            </div>
        <?php else : ?>
            <?php echo zo_archive_video(); ?>
        <?php endif; ?>
    </div>

    <div class="zo-blog-detail">
        <h2 class="zo-blog-title"><a title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php the_title(); ?></a></h2>
        <div class="zo-blog-meta"><?php zo_archive_detail(); ?></div>
        <div class="zo-blog-content">
            <?php the_excerpt();
            wp_link_pages( array(
	            'before'      => '<p class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'lucian' ) . '</span>',
	            'after'       => '</p>',
	            'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'lucian' ) . ' %</span>',
	            'separator'   => '<span class="separator">, </span>',
            ) );
            ?>
        </div>
        <a class="btn-readmore" title="<?php the_title(); ?>" href="<?php the_permalink() ?>" rel=""><?php esc_html_e('Read More ', 'lucian') ?></a>
    </div>
</article>

<?php
/**
 * Zo Theme functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link http://codex.wordpress.org/Plugin_API
 *
 * @package ZoTheme
 * @subpackage Zo Theme
 * @since 1.0.0
 */



/* Add base functions */
require( get_template_directory() . '/inc/base.class.php' );

/* Add ReduxFramework. */
if(!class_exists('ReduxFramework')){
    require( get_template_directory() . '/inc/ReduxCore/framework.php' );
}

/* Add theme options. */
require( get_template_directory() . '/inc/options/functions.php' );

/* Add custom vc params. */
if(class_exists('Vc_Manager')){
    /* Add theme elements */
    add_action('init', 'zo_vc_params');
    function zo_vc_params() {
        require( get_template_directory() . '/vc_params/vc_rows.php' );
        require( get_template_directory() . '/vc_params/vc_column.php' );
        require( get_template_directory() . '/vc_params/vc_btn.php' );
        require( get_template_directory() . '/vc_params/vc_separator.php' );
        require( get_template_directory() . '/vc_params/vc_pie.php' );
        require( get_template_directory() . '/vc_params/vc_images_carousel.php' );
        require( get_template_directory() . '/vc_params/vc_custom_heading.php' );
        require( get_template_directory() . '/vc_params/contact_form.php' );
    }
}

/* Remove Element VC */
if(class_exists('Vc_Manager')){
	vc_remove_element( "vc_button" );
	vc_remove_element( "vc_cta_button" );
	vc_remove_element( "vc_cta_button2" );
}

/* Add Meta Core Options */
if(is_admin()){
	if(!class_exists('ZoCoreControl')){
		/* add mete core */
		require( get_template_directory() . '/inc/metacore/core.options.php' );
		/* add meta options */
		require( get_template_directory() . '/inc/options/meta.options.php' );
	}
	/* tmp plugins. */
	require( get_template_directory() . '/inc/options/require.plugins.php' );
	/* add presets color */
	require( get_template_directory() . '/inc/options/presets.php' );
}

/* Add SCSS */
if(!class_exists('scssc')){
    require( get_template_directory() . '/inc/ReduxCore/inc/scssphp/scss.inc.php' );
}

/* Add Template functions */
require( get_template_directory() . '/inc/template.functions.php' );

/* Static css. */
require( get_template_directory() . '/inc/dynamic/static.css.php' );

/* Dynamic css*/
require( get_template_directory() . '/inc/dynamic/dynamic.css.php' );

/* Add widgets */
require( get_template_directory() . '/inc/widgets/cart_search.php' );
require( get_template_directory() . '/inc/widgets/instagram.php' );
require( get_template_directory() . '/inc/widgets/social.php' );
require( get_template_directory() . '/inc/widgets/recent-posts-widget-with-thumbnails.php' );
require( get_template_directory() . '/inc/widgets/flickr-badges-widget.php' );

/* Add Selector */
require( get_template_directory() . '/inc/selector/selector.php' );

// Set up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 625;

function zo_lucian_init() {
	global $smof_data;
	/* Add mega menu */
	if(isset($smof_data['menu_mega']) && $smof_data['menu_mega'] && !class_exists('HeroMenuWalker')){
		require( get_template_directory() . '/inc/megamenu/mega-menu.php' );
	}
}
add_action('init', 'zo_lucian_init');

/*
 * Limit Words
 */
if (!function_exists('zo_limit_words')) {
    function zo_limit_words($string, $word_limit) {
        $words = explode(' ', strip_tags($string), ($word_limit + 1));
        if (count($words) > $word_limit) {
            array_pop($words);
        }
        return apply_filters('the_excerpt', implode(' ', $words));
    }
}

/**
 * Lucian setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Lucian supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Lucian 1.0
 */
function zo_setup() {
	/*
	 * Makes Lucian available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Lucian, use a find and replace
	 * to change 'zo-zap' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'lucian', get_template_directory() . '/languages' );

	// Adds title tag
	add_theme_support( "title-tag" );

	// Add woocommerce
	add_theme_support( 'woocommerce' );

	// Adds custom header
	add_theme_support( 'custom-header' );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	// This theme supports a variety of post formats.
	add_theme_support( 'post-formats', array( 'video', 'audio' , 'gallery', 'link', 'quote',) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', esc_html__( 'Primary Menu', 'lucian' ) );

	/*
	 * This theme supports custom background color and image,
	 * and here we also set up the default background color.
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	) );

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 624, 9999 ); // Unlimited height, soft crop
}
add_action( 'after_setup_theme', 'zo_setup' );

/**
 * Get meta data.
 * @author ZoTheme
 * @return mixed|NULL
 */
function zo_meta_data(){
    global $post, $zo_meta;

    if(!isset($post->ID)) return ;

    $zo_meta = json_decode(get_post_meta($post->ID, '_zo_meta_data', true));

    if(empty($zo_meta)) return ;

    foreach ($zo_meta as $key => $meta){
        $zo_meta->$key = rawurldecode($meta);
    }
}
add_action('wp', 'zo_meta_data');

/**
 * Get post meta data.
 * @author ZoTheme
 * @return mixed|NULL
 */
function zo_post_meta_data(){
    global $post;

    if(!isset($post->ID)) return null;

    $post_meta = json_decode(get_post_meta($post->ID, '_zo_meta_data', true));

    if(empty($post_meta)) return null;

    foreach ($post_meta as $key => $meta){
        $post_meta->$key = rawurldecode($meta);
    }

    return $post_meta;
}

/**
 * Enqueue scripts and styles for front-end.
 * @author ZoTheme
 * @since ZO SuperHeroes 1.0
 */
function zo_scripts_styles() {

	global $smof_data, $wp_styles, $wp_scripts, $zo_meta;

	/** theme options. */
	$script_options = array(
	    'menu_sticky'=> $smof_data['menu_sticky'],
	    'menu_sticky_tablets'=> $smof_data['menu_sticky_tablets'],
	    'menu_sticky_mobile'=> $smof_data['menu_sticky_mobile'],
	    'parallax' => $smof_data['parallax'],
	    'back_to_top'=> $smof_data['footer_botton_back_to_top'],
	    'page_title_parallax'=> $smof_data['page_title_parallax'],
	);
	//Page Menu Sticky Setting
	if(!empty($zo_meta->_zo_enable_header_fixed) ) {
		$script_options['menu_sticky'] = 1;
	}
	/*------------------------------------- JavaScript ---------------------------------------*/


	/** --------------------------libs--------------------------------- */

	/* Adds JavaScript Bootstrap. */
	wp_enqueue_script('zotheme-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array( 'jquery' ), '3.3.2');

	/* Add parallax plugin. */
	if($smof_data['parallax']){
	   wp_enqueue_script('zotheme-parallax', get_template_directory_uri() . '/assets/js/jquery.parallax-1.1.3.js', array( 'jquery' ), '1.1.3', true);
	}

    /* Fancy box */
    wp_register_script('zotheme-fancybox', get_template_directory_uri() . '/assets/libs/fancybox/jquery.fancybox.pack.js', array( 'jquery' ), '2.1.5', true);
    wp_register_script('zotheme-fancybox-media', get_template_directory_uri() . '/assets/libs/fancybox/helpers/jquery.fancybox-media.js', array( 'zotheme-fancybox' ), '2.1.5', true);
    wp_register_style('zotheme-fancybox', get_template_directory_uri() . '/assets/libs/fancybox/jquery.fancybox.css');
	wp_enqueue_script('zotheme-fancybox');
	wp_enqueue_script('zotheme-fancybox-media');
	wp_enqueue_style('zotheme-fancybox');
    /* Slick Slider */
    wp_register_script('zo-slick-js', get_template_directory_uri(). '/assets/js/slick.min.js', array('jquery'), '1.5.7', true);
    wp_register_style('zo-slick-css', get_template_directory_uri(). '/assets/css/slick.css');
		/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

    /*------------------------------------- Stylesheet ---------------------------------------*/

	/** --------------------------libs--------------------------------- */
	/* Loads Animation stylesheet*/
	wp_enqueue_style('zotheme-animation', get_template_directory_uri() . '/assets/css/animate.css', array(), '3.3.0');
	/* Load Bootstrap stylesheet. */
	wp_enqueue_style('zotheme-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '3.3.2');
	/* Loads Bootstrap stylesheet. */
	wp_enqueue_style('zotheme-font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css', array(), '4.3.0');
	/* Loads Font Ionicons. */
	wp_enqueue_style('zotheme-font-ionicons', get_template_directory_uri() . '/assets/css/ionicons.min.css', array(), '2.0.1');
	wp_enqueue_style('zotheme-font-linearicons');
	/* Loads Pe Icon. */
	wp_enqueue_style('zotheme-pe-icon', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css', array(), '1.0.1');

	/** --------------------------custom------------------------------- */

	/* Loads our main stylesheet. */
	wp_enqueue_style( 'zotheme-style', get_stylesheet_uri(), array( 'zotheme-bootstrap' ));

	/* Loads the Internet Explorer specific stylesheet. */
	wp_enqueue_style( 'zotheme-ie', get_template_directory_uri() . '/assets/css/ie.css', array( 'zotheme-style' ), '20121010' );
	$wp_styles->add_data( 'zotheme-ie', 'conditional', 'lt IE 9' );
	/* Load widgets scripts*/
	wp_enqueue_script('zo_widget_scripts', get_template_directory_uri() . '/inc/widgets/widgets.js');
	wp_enqueue_style('zo_widget_scripts', get_template_directory_uri() . '/inc/widgets/widgets.css');

	/* Load static css*/
	$file = 'static.css';
	if(isset($zo_meta->_zo_presets_color) && $zo_meta->_zo_presets_color){
		$file = "presets-" . $zo_meta->_zo_presets_color .".css";
	}else if(isset($smof_data['presets_color']) && $smof_data['presets_color']){
		$file = "presets-".$smof_data['presets_color'].".css";
	}
	wp_enqueue_style('zotheme-static', get_template_directory_uri() . '/assets/css/' . $file, array( 'zotheme-style' ), '1.0.0');

	/* Add main.js */
	wp_register_script('zotheme-main', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery'), '1.0.0', true);
	wp_localize_script('zotheme-main', 'ZOOptions', $script_options);
	wp_enqueue_script('zotheme-main');
	/* Add menu.js */
	wp_enqueue_script('zotheme-menu', get_template_directory_uri() . '/assets/js/menu.js', array( 'jquery' ), '1.0.0', true);
	/* VC Pie Custom JS */
	wp_register_script('progressCircle', get_template_directory_uri() . '/assets/js/process_cycle.js', array( 'jquery' ), '1.0.0', true);
	wp_register_script('vc_pie_custom', get_template_directory_uri() . '/assets/js/vc_pie_custom.js', array( 'jquery' ), '1.0.0', true);
    /**
     * IE Fallbacks
     */
    wp_register_script( 'ie_html5shiv', get_template_directory_uri(). '/assets/js/html5shiv.min.js', array(), false, '3.7.2' );
    wp_enqueue_script( 'ie_html5shiv');
    $wp_scripts->add_data( 'ie_html5shiv', 'conditional', 'lt IE 9' );

    wp_register_script( 'ie_respond', get_template_directory_uri() . '/assets/js/respond.min.js', array(), false, '1.4.2' );
    wp_enqueue_script( 'ie_respond');
    $wp_scripts->add_data( 'ie_respond', 'conditional', 'lt IE 9' );

}
add_action( 'wp_enqueue_scripts', 'zo_scripts_styles' );

/**
 * Register sidebars.
 *
 * Registers our main widget area and the front page widget areas.
 *
 * @since ZoTheme
 */
function zo_widgets_init() {
	register_sidebar( array(
		'name' => esc_html__( 'Main Sidebar', 'lucian' ),
		'id' => 'sidebar-1',
		'description' => esc_html__( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'lucian' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title"><span>',
		'after_title' => '</span></h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Header Top Left', 'lucian' ),
		'id' => 'sidebar-2',
		'description' => esc_html__( 'Appears when using the optional Header with a page set as Header top left', 'lucian' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Header Top Right', 'lucian' ),
		'id' => 'sidebar-3',
		'description' => esc_html__( 'Appears when using the optional Header with a page set as Header top right', 'lucian' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Menu Right', 'lucian' ),
    	'id' => 'header-right',
    	'description' => esc_html__( 'Appears when using the optional Menu with a page set as Menu right', 'lucian' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 1', 'lucian' ),
    	'id' => 'sidebar-5',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 1', 'lucian' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 2', 'lucian' ),
    	'id' => 'sidebar-6',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 2', 'lucian' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 3', 'lucian' ),
    	'id' => 'sidebar-7',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 3', 'lucian' ),
    	'before_widget' => '<aside class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer Top 4', 'lucian' ),
    	'id' => 'sidebar-8',
    	'description' => esc_html__( 'Appears when using the optional Footer with a page set as Footer Top 4', 'lucian' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
    	'name' => esc_html__( 'Footer Bottom', 'lucian' ),
    	'id' => 'sidebar-9',
    	'description' => esc_html__( 'Appears when using the optional Footer Bottom with a page set as Footer Bottom left', 'lucian' ),
    	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    	'after_widget' => '</aside>',
    	'before_title' => '<h3 class="wg-title">',
    	'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Shop Sidebar', 'lucian' ),
		'id' => 'sidebar-shop',
		'description' => esc_html__( 'Appears when using the optional Shop Sidebar with a page set as Shop page', 'lucian' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title"><span>',
		'after_title' => '</span></h3>',
	) );

	register_sidebar( array(
		'name' => esc_html__( 'Shop Info', 'lucian' ),
		'id' => 'sidebar-shop-info',
		'description' => esc_html__( 'Appears when using the optional Shop Info with a page set as Shop Detail', 'lucian' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Shop Footer', 'lucian' ),
		'id' => 'sidebar-shop-footer',
		'description' => esc_html__( 'Appears when using the optional Shop Footer with a page set as Shop page', 'lucian' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title"><span>',
		'after_title' => '</span></h3>',
	) );
	register_sidebar( array(
		'name' => esc_html__( 'Blog Footer', 'lucian' ),
		'id' => 'blog-footer',
		'description' => esc_html__( 'Appears when using the optional Blog Footer with a page set as Blog page', 'lucian' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="wg-title"><span>',
		'after_title' => '</span></h3>',
	) );

}
add_action( 'widgets_init', 'zo_widgets_init' );

/**
 * Filter the page menu arguments.
 *
 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.
 *
 * @since 1.0.0
 */
function zo_page_menu_args( $args ) {
    if ( ! isset( $args['show_home'] ) )
        $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'zo_page_menu_args' );

/**
 * Add field subtitle to post.
 *
 * @since 1.0.0
 */
function zo_add_subtitle_field(){
    global $post, $zo_meta;

    /* get current_screen. */
    $screen = get_current_screen();

    /* show field in post. */
    if(in_array($screen->id, array('post'))){

        /* get value. */
        $value = get_post_meta($post->ID, 'post_subtitle', true);

        /* html. */
        echo '<div class="subtitle"><input type="text" name="post_subtitle" value="'.esc_attr($value).'" id="subtitle" placeholder = "'.esc_html__('Subtitle', 'lucian').'" style="width: 100%;margin-top: 4px;"></div>';
    }
}

//add_action( 'edit_form_after_title', 'zo_add_subtitle_field' );

/**
 * Save custom theme meta.
 *
 * @since 1.0.0
 */
function zo_save_meta_boxes($post_id) {

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    /* update field subtitle */
    if(isset($_POST['post_subtitle'])){
        update_post_meta($post_id, 'post_subtitle', $_POST['post_subtitle']);
    }
}

add_action('save_post', 'zo_save_meta_boxes');
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since 1.0.0
 * @param null $query
 */
function zo_paging_nav($query = null) {
    // Don't print empty markup if there's only one page.
	if($query){
		$zo_query = $query;
	}else{
		$zo_query = $GLOBALS['wp_query'];
	}
	if ( $zo_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
			'base'     => $pagenum_link,
			'format'   => $format,
			'total'    => $zo_query->max_num_pages,
			'current'  => $paged,
			'mid_size' => 1,
			'add_args' => array_map( 'urlencode', $query_args ),
			'prev_text' => wp_kses(__( '<i class="fa fa-angle-double-left"></i>', 'lucian' ), array('i' => array('class'=>array()))),
			'next_text' => wp_kses(__( '<i class="fa fa-angle-double-right"></i>', 'lucian' ), array('i' => array('class'=>array()))),
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation clearfix" role="navigation">
			<div class="pagination loop-pagination">
				<?php echo do_shortcode($links); ?>
			</div><!-- .pagination -->
	</nav><!-- .navigation -->
	<?php
	endif;
}

/**
 * Display navigation to next/previous post when applicable.
 *
 * @since 1.0.0
 *
 * @param string $prev_title
 * @param string $next_title
 */
function zo_post_nav($prev_title = NULL, $next_title = NULL) {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>

   <?php
   $lang = isset( $_GET['lang'] ) ? $_GET['lang'] : 'es';
    ?>
    <h4 class="[ text-center ]">
	<?php if( 'es' == $lang ) : ?>
		Otros aliados
	<?php else : ?>
		Other allies
	<?php endif; ?>
    </h4>
	<nav class="navigation post-navigation" role="navigation">
		<div class="nav-links clearfix">
			<?php
			$prev_post = get_previous_post();
			if (!empty( $prev_post )):
				$prev_title = empty($prev_title) ? esc_attr($prev_post->post_title) : $prev_title;
			?>
			  <a class="post-prev pull-left" href="<?php echo get_permalink( $prev_post->ID ); ?>" title="<?php echo esc_attr($prev_post->post_title); ?>">
				<i class="fa fa-angle-left"></i><?php echo esc_attr($prev_title); ?>
			  </a>
			<?php endif; ?>
			<?php
			$next_post = get_next_post();
			if ( is_a( $next_post , 'WP_Post' ) ) :
				$next_title = empty($next_title) ? esc_attr($next_post->post_title) : $next_title;
			?>
			  <a class="post-next pull-right" href="<?php echo get_permalink( $next_post->ID ); ?>" title="<?php echo get_the_title( $next_post->post_title ); ?>">
				<i class="fa fa-angle-right"></i><?php echo esc_attr($next_title); ?>
			  </a>
            <?php endif; ?>
        </div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}

/* Add Custom Comment */
function zo_comment($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
<<?php echo esc_attr($tag) ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
<?php if ( 'div' != $args['style'] ) : ?>
<div id="div-comment-<?php comment_ID() ?>" class="comment-body clearfix">
<?php endif; ?>
<div class="comment-author-image vcard">
	<?php echo get_avatar( $comment, 109 ); ?>
</div>
<div class="comment-main">
	<div class="comment-content">
		<?php comment_text(); ?>
	</div>
	<div class="comment-meta">
		<?php printf( wp_kses(__( '<span class="comment-author">%s</span>', 'lucian' ), array('span' => array('class'=>array()))), get_comment_author_link() ); ?>
		<span class="comment-date"> -
			<?php printf( _x( '%s ago', '%s = human-readable time difference', 'lucian' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
        </span>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.' , 'lucian'); ?></em>
		<?php endif; ?>
		<div class="reply">
			<?php comment_reply_link(
				array_merge( $args, array(
						'add_below' => $add_below,
						'depth' => $depth,
						'max_depth' => $args['max_depth'] )
				)
			); ?>
		</div>
	</div>
</div>
<?php if ( 'div' != $args['style'] ) : ?>
</div>
<?php endif; ?>
<?php
}
/* End Custom Comment */

/* Custom excerpt*/
function zo_excerpt_more( $more ) {
    return '';
}
add_filter('excerpt_more', 'zo_excerpt_more');
/* End Custom excerpt length */


/**
 * Ajax post like.
 *
 * @since 1.0.0
 */
function zo_post_like_callback(){

    $post_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

    $likes = null;

    if($post_id && !isset($_COOKIE['zo_post_like_'. $post_id])){

        /* get old like. */
        $likes = get_post_meta($post_id , '_zo_post_likes', true);

        /* check old like. */
        $likes = $likes ? $likes : 0 ;

        $likes++;

        /* update */
        update_post_meta($post_id, '_zo_post_likes' , $likes);

        /* set cookie. */
        setcookie('zo_post_like_'. $post_id, $post_id, time() * 20, '/');
    }

    echo esc_attr($likes);

    die();
}
add_action('wp_ajax_zo_post_like', 'zo_post_like_callback');
add_action('wp_ajax_nopriv_zo_post_like', 'zo_post_like_callback');

/**
 * Load ajax url.
 */
function zo_ajax_url_head() {
    echo '<script type="text/javascript"> var ajaxurl = "'.admin_url('admin-ajax.php').'"; </script>';
}
add_action( 'wp_head', 'zo_ajax_url_head');

/**
 * Count post view.
 *
 * @since 1.0.0
 */
function zo_set_count_view(){
    global $post;

    if(is_single() && !empty($post->ID) && !isset($_COOKIE['zo_post_view_'. $post->ID])){

        $views = get_post_meta($post->ID , '_zo_post_views', true);

        $views = $views ? $views : 0 ;

        $views++;

        update_post_meta($post->ID, '_zo_post_views' , $views);

        /* set cookie. */
        setcookie('zo_post_view_'. $post->ID, $post->ID, time() * 20, '/');
    }
}
add_action( 'wp', 'zo_set_count_view' );

/**
 * Get Post view
 * @return int|mixed
 */
function zo_get_count_view() {
    global $post;

    $views = get_post_meta($post->ID , '_zo_post_views', true);

    $views = $views ? $views : 0 ;
    return $views;
}

/**
 * Get list custom post type using for custom background header in theme options.
 *
 * @return array
 */
function zo_list_post_types() {
    $types = array();
    /*
     * Add Product Post Type of WooCommerce
     */
    if( class_exists( 'WooCommerce' ) ) {
        $types['product'] = esc_html__('Products', 'lucian');
    }
    /*
     * Get list custom post type CPT
     */
    $post_types = get_option( 'cptui_post_types' , array());
    foreach( $post_types as $type ) {
        $types[$type['name']] = $type['label'];
    }

    return $types;
}

/**
 * Add Fancybox into a post type
 */
 function zo_add_fancybox() {
     if( is_singular('portfolio') ) {
        wp_enqueue_script('zotheme-fancybox');
        wp_enqueue_style('zotheme-fancybox');
        wp_enqueue_script('zo-slick-js');
        wp_enqueue_style('zo-slick-css');
     }
 }
add_action( 'wp_enqueue_scripts', 'zo_add_fancybox' );

/* Woo support */
if(class_exists('Woocommerce')){
    //item per page
    require get_template_directory() . '/woocommerce/wc-template-functions.php';
    require get_template_directory() . '/woocommerce/wc-template-hooks.php';
}

/* Filter Search results */
function zo_searchfilter($query) {
    if ($query->is_search && !is_admin() ) {
        $query->set('post_type',array('post','team','portfolio','testimonial','pricing', 'product'));
    }
	return $query;
}
add_filter('pre_get_posts','zo_searchfilter');

/* Filter style loader tag, add attribute property */
add_filter('style_loader_tag', 'zo_slick_style_loader_tag');
function zo_slick_style_loader_tag($tag){
  return preg_replace("/id='zo-slick-css-css'/", "property='stylesheet' id='zo-slick-css-css'", $tag);
}

add_filter('style_loader_tag', 'zo_wp_mediaelement_style_loader_tag');
function zo_wp_mediaelement_style_loader_tag($tag){
  return preg_replace("/id='wp-mediaelement-css'/", "property='stylesheet' id='wp-mediaelement-css'", $tag);
}

add_filter('style_loader_tag', 'zo_mediaelement_style_loader_tag');
function zo_mediaelement_style_loader_tag($tag){
  return preg_replace("/id='mediaelement-css'/", "property='stylesheet' id='mediaelement-css'", $tag);
}

add_filter('style_loader_tag', 'zo_prettyphoto_style_loader_tag');
function zo_prettyphoto_style_loader_tag($tag){
  return preg_replace("/id='prettyphoto-css'/", "property='stylesheet' id='prettyphoto-css'", $tag);
}

add_filter('style_loader_tag', 'zo_carousel_style_loader_tag');
function zo_carousel_style_loader_tag($tag){
  return preg_replace("/id='vc_carousel_css-css'/", "property='stylesheet' id='vc_carousel_css-css'", $tag);
}

add_filter('style_loader_tag', 'zo_font_awesome_style_loader_tag');
function zo_font_awesome_style_loader_tag($tag){
  return preg_replace("/id='font-awesome-css'/", "property='stylesheet' id='font-awesome-css'", $tag);
}
add_filter('style_loader_tag', 'zo_font_pe7stroke_style_loader_tag');
function zo_font_pe7stroke_style_loader_tag($tag){
  return preg_replace("/id='zo-icon-pe7stroke-css'/", "property='stylesheet' id='zo-icon-pe7stroke-css'", $tag);
}
add_filter('style_loader_tag', 'zo_font_linearicons_style_loader_tag');
function zo_font_linearicons_style_loader_tag($tag){
  return preg_replace("/id='zo-icon-linearicons-css'/", "property='stylesheet' id='zo-icon-linearicons-css'", $tag);
}
add_filter('style_loader_tag', 'zo_progressbar_style_loader_tag');
function zo_progressbar_style_loader_tag($tag){
  return preg_replace("/id='bootstrap-progressbar-css'/", "property='stylesheet' id='bootstrap-progressbar-css'", $tag);
}

if( function_exists('zo_image_resize')) {
    /**
     * Crop Image Size
     *
     * @param null $width
     * @param null $height
     * @param null $crop
     * @param bool $single
     * @param bool $upscale
     * @return null|string
     */
    function zo_post_thumbnail($width = null, $height = null, $crop = null, $single = true, $upscale = true) {
        $image_url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
        $url = zo_image_resize($image_url[0], $width, $height, $crop, $single, $upscale);
        return do_shortcode('<img src="'.esc_url($url).'" alt="' . get_the_title() . '" />');
    }
}
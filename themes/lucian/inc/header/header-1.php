<?php
/**
 * @name : Default
 * @package : ZoTheme
 * @author : Fox
 */
?>
<?php global $smof_data, $zo_meta; ?>
<?php if ($smof_data['enable_header_top'] =='1'): ?>
	<div id="zo-header-top">
		<div class="container">
			<div class="row">
				<?php if (is_active_sidebar('sidebar-2')) : ?>
					<div id="zo-header-top-first" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-2'); ?></div>
				<?php endif; ?>
				<?php if (is_active_sidebar('sidebar-3')) : ?>
					<div id="zo-header-top-second" class="col-xs-12 col-sm-6 col-md-6 col-lg-6"><?php dynamic_sidebar('sidebar-3'); ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
<?php endif;?>
<div id="zo-header" class="zo-main-header zo-header-1">
	<div class="container">
		<div class="row">
			<div id="zo-header-navigation-fixed">
				<div id="zo-menu-mobile-fixed" class="navbar-collapse"><i class="fa fa-navicon"></i></div>
				<nav id="site-navigation" class="main-navigation-fixed ">
					<span class="close">&times;</span>

					<?php

					$attr = array(
						'menu' => zo_menu_location(),
						'menu_class' => 'menu-main-menu',
					);

					$menu_locations = get_nav_menu_locations();

					if (!empty($menu_locations['primary'])) {
						$attr['theme_location'] = 'primary';
					}

					/* enable mega menu. */
					if (class_exists('HeroMenuWalker')) {
						$attr['walker'] = new HeroMenuWalker();
					}

					/* main nav. */
					wp_nav_menu($attr); ?>
				</nav>
			</div>
		</div>
	</div>
	<!-- #site-navigation -->
</div>
<!--#zo-header-->

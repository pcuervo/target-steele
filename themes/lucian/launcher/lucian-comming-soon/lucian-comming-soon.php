<?php
/*
Launcher template: Lucian Coming Soon
Template URI: http://drupalexp.com
Description:  Lucian Coming Soon Default
Author: DrupalEXP
Version: 1.0
Author URI: http://drupalexp.com
Supports: countdown timer
*/

if (!defined('ABSPATH')) die();
?><!DOCTYPE html>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="<?php wplauncher_template_directory_uri(); ?>/style.css">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body>
<div id="page">
	<div id="main">
		<div <?php wplauncher_background_attr('meta=class:bg&default='.wplauncher_get_template_directory_uri().'/background.jpg'); ?>>
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-lg-offset-2 col-lg-8 col-md-offset-2 col-md-8">
						<h2 id="title"><?php wplauncher_text('default=We are lauching soon&hideable=1'); ?></h2>
						<div id="description">
							<?php wplauncher_text('type=textarea&edit_color=1&default=Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin'); ?>
						</div>
					</div>
					<div class="col-sm-12 col-lg-12 col-md-12">
						<div class="row" id="countdown">
							<?php wplauncher_countdown(array('format' => '
							<span class="col-xs-12 col-sm-3 col-lg-3 col-md-3 counting wplauncher-days"><span class="count_num">%D</span><span class="count_text">Days</span></span>
							<span class="col-xs-12 col-sm-3 col-lg-3 col-md-3 counting wplauncher-hours"><span class="count_num">%H</span><span class="count_text">Hours</span></span>
							<span class="col-xs-12 col-sm-3 col-lg-3 col-md-3 counting wplauncher-minutes"><span class="count_num">%M</span><span class="count_text">Minutes</span></span>
							<span class="col-xs-12 col-sm-3 col-lg-3 col-md-3 counting wplauncher-seconds"><span class="count_num">%S</span><span class="count_text">Seconds</span></span>
						', 'edit_color' => 1)); ?>
							<?php if (wplauncher_get_field('countdown_color')): ?>
								<style type="text/css">.count_num { color: <?php echo wplauncher_get_field('countdown_color'); ?>; }</style>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php get_footer(); ?>
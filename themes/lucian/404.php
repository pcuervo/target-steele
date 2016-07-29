<?php get_header('404'); ?>
	<div id="primary" class="site-content">
		<div id="content" role="main" class="container">

			<article id="post-0" class="entry-error404 no-results not-found">
				<header class="entry-header">
					<img src="<?php print get_template_directory_uri(); ?>/assets/images/404.jpg" alt="<?php esc_html_e('404 Page Not Found', 'lucian'); ?>" />
					<h1><?php esc_html_e('OH MY GOSH! YOU FOUND IT !!!', 'lucian'); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php echo wp_kses(__('Looks like the page you\'re trying to visit doesn\'t exist. <br /> Please check the URL and try your luck again.', 'lucian'), array('br' => array())); ?></p>
				</div><!-- .entry-content -->

				<footer class="entry-footer">
					<a class="btn btn-dark btn-home" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('TAKE ME  HOME', 'lucian'); ?></a>
				</footer>
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer('404'); ?>
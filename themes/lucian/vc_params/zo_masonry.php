<?php
$params = array(
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Filter Style",'lucian'),
		"param_name" => "zo_filter_style",
		"value" => array(
			"Style 1 - Default" => "",
			"Style 2" => "primary",
			"Style 3" => "style-3"
		),
		"template" => array(
			'zo_masonry--portfolio-default.php',
			'zo_masonry--portfolio--style-1.php',
			'zo_masonry--portfolio--style-2.php',
			'zo_masonry--portfolio--style-3.php',
			'zo_masonry--portfolio--style-4.php'
		)
	)
);
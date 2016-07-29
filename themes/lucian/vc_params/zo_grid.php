<?php
$params = array(
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Title Size",'lucian'),
		"param_name" => "zo_title_size",
		"value" => array(
				"H2" => "h2",
				"H3" => "h3",
				"H4" => "h4",
				"H5" => "h5",
				"H6" => "h6"
		),
	),
    array(
        "type" => "dropdown",
        "heading" => esc_html__("Full Width",'lucian'),
        "param_name" => "zo_full_width",
        "value" => array(
            "Default" => "",
            "No Padding" => "no-padding"
        )
    ),
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Filter Style",'lucian'),
		"param_name" => "zo_filter_style",
		"value" => array(
			"Style 1 - Default" => "",
			"Style 2" => "primary",
			"Style 3" => "style-3"
		)
	),
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Image Style",'lucian'),
		"param_name" => "zo_image_style",
		"value" => array(
			"Thumbnail" => "thumbnail",
			"Medium" => "medium",
			"Full" => "full"
		),
		"template" => array(
			'zo_grid--blog.php',
		)
	),
	array(
		"type" => "dropdown",
		"heading" => esc_html__("Blog Style",'lucian'),
		"param_name" => "zo_content_style",
		"value" => array(
			"Full" => "",
			"Without Content" => "without"
		),
		"template" => array(
			'zo_grid--blog.php',
		)
	)
);

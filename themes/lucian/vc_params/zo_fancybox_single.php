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
		)
	),
    array(
        "type" => "dropdown",
        "heading" => esc_html__("Style",'lucian'),
        "param_name" => "zo_fancybox_style",
        "value" => array(
            "Default" => "",
            "Large" => "large",
        ),
        "template" => array(
            'zo_fancybox_single.php',
            'zo_fancybox_single--style-1.php',
	        'zo_fancybox_single--style-3.php',
            'zo_fancybox_single--style-9.php',
        )
    ),
	/**
	 * Style 1
	 */
    array(
        "type" => "colorpicker",
        "heading" => esc_html__("Background Color",'lucian'),
        "param_name" => "zo_fancybox_bg_color",
        "template" => array(
            'zo_fancybox_single--style-1.php',
            'zo_fancybox_single--style-2.php',
            'zo_fancybox_single--style-3.php',
            'zo_fancybox_single--style-12.php'
        )
    ),
    array(
        "type" => "colorpicker",
        "heading" => esc_html__("Border Color",'lucian'),
        "param_name" => "zo_fancybox_border_color",
        "template" => array(
            'zo_fancybox_single--style-1.php',
            'zo_fancybox_single--style-2.php',
            'zo_fancybox_single--style-3.php',
            'zo_fancybox_single--style-12.php'
        )
    ),
    array(
        "type" => "colorpicker",
        "heading" => esc_html__("Icon Color",'lucian'),
        "param_name" => "zo_fancybox_icon_color",
        "template" => array(
            'zo_fancybox_single--style-1.php',
            'zo_fancybox_single--style-2.php',
            'zo_fancybox_single--style-3.php',
            'zo_fancybox_single--style-12.php'
        )
    ),
    array(
        "type" => "colorpicker",
        "heading" => esc_html__("Title Color",'lucian'),
        "param_name" => "zo_fancybox_title_color",
        "template" => array(
            'zo_fancybox_single--style-1.php',
            'zo_fancybox_single--style-2.php',
            'zo_fancybox_single--style-12.php'
        )
    ),
    array(
        "type" => "colorpicker",
        "heading" => esc_html__("Content Color",'lucian'),
        "param_name" => "zo_fancybox_content_color",
        "template" => array(
            'zo_fancybox_single--style-1.php',
            'zo_fancybox_single--style-2.php',
            'zo_fancybox_single--style-12.php'
        )
    ),
	/**
	 * Style 2
	 */
    array(
        "type" => "dropdown",
        "heading" => esc_html__("Title Line Bottom",'lucian'),
        "param_name" => "zo_fancybox_title_line",
        "value" => array(
            "Default" => "",
            "No Line" => "no-line",
        ),
        "template" => array(
            'zo_fancybox_single--style-2.php'
        )
    ),
    array(
        "type" => "dropdown",
        "heading" => esc_html__("Align",'lucian'),
        "param_name" => "zo_fancybox_align",
        "value" => array(
            "Left" => "",
            "Right" => "right",
        ),
        "template" => array(
            'zo_fancybox_single--style-2.php'
        )
    ),
    array(
        "type" => "dropdown",
        "heading" => esc_html__("Hover Style",'lucian'),
        "param_name" => "zo_fancybox_hover",
        "value" => array(
            "Style 1" => "",
            "Style 2" => "hover-black",
            "Style 3" => "hover-border",
        ),
        "template" => array(
            'zo_fancybox_single--style-2.php'
        )
    ),
	/**
	 * End Style 2
	 */
);

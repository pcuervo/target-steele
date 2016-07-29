<?php
/**
 * Add custom heading params
 * 
 * @author ZoTheme
 * @since 1.0.0
 */
vc_add_param("vc_custom_heading", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__("Custom Letter Spacing", 'lucian'),
	"admin_label" => true,
	"param_name" => "zo_custom_letter_spacing",
	"value" => '',
	'description' => esc_html__( 'Ex: 0.1em', 'lucian' ),
));
vc_add_param("vc_custom_heading", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Custom Heading Style", 'lucian'),
    "admin_label" => true,
    "param_name" => "zo_custom_heading",
    "value" => array(
        "Default" => 'default',
        "Title Line Bottom - Style 1" => "style-1"
    )
));
<?php
/**
 * Add row params
 *
 * @author ZoTheme
 * @since 1.0.0
 */
if (shortcode_exists('contact-form-7')) {

	vc_add_param( "contact-form-7", array(
		"type"        => "dropdown",
		"class"       => "",
		"heading"     => esc_html__( "Style", 'lucian' ),
		"admin_label" => true,
		"param_name"  => "html_class",
		"value"       => array(
			"Style 1 - Default" => "",
			"Style 2" => "white",
		)
	) );

}
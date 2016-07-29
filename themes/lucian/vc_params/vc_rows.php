<?php
/**
 * Add row params
 *
 * @author ZoTheme
 * @since 1.0.0
 */
vc_remove_param("vc_row", 'gap');
vc_remove_param("vc_row", 'parallax_image');
vc_add_param("vc_row", array(
	'type' => 'attach_image',
	'heading' => esc_html__( 'Image', 'lucian' ),
	'param_name' => 'parallax_image',
	'value' => '',
	'description' => esc_html__( 'Select image from media library.', 'lucian' ),
	'dependency' => array(
		'element' => 'parallax',
		'not_empty' => true,
	),
));
vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__("Animation", 'lucian'),
	"admin_label" => true,
	"param_name" => "animation",
	"value" => array(
		"None" => "",
		"bounce" => "bounce",
		"flash" => "flash",
		"pulse" => "pulse",
		"rubberBand" => "rubberBand",
		"shake" => "shake",
		"swing" => "swing",
		"tada" => "tada",
		"wobble" => "wobble",
		"jello" => "jello",
		"bounceIn" => "bounceIn",
		"bounceInDown" => "bounceInDown",
		"bounceInLeft" => "bounceInLeft",
		"bounceInRight" => "bounceInRight",
		"bounceInUp" => "bounceInUp",
		"fadeIn" => "fadeIn",
		"fadeInDown" => "fadeInDown",
		"fadeInDownBig" => "fadeInDownBig",
		"fadeInLeft" => "fadeInLeft",
		"fadeInLeftBig" => "fadeInLeftBig",
		"fadeInRight" => "fadeInRight",
		"fadeInRightBig" => "fadeInRightBig",
		"fadeInUp" => "fadeInUp",
		"fadeInUpBig" => "fadeInUpBig",
		"flip" => "flip",
		"flipInX" => "flipInX",
		"flipInY" => "flipInY",
		"lightSpeedIn" => "lightSpeedIn",
		"lightSpeedOut" => "lightSpeedOut",
		"rotateIn" => "rotateIn",
		"rotateInDownLeft" => "rotateInDownLeft",
		"rotateInDownRight" => "rotateInDownRight",
		"rotateInUpLeft" => "rotateInUpLeft",
		"rotateInUpRight" => "rotateInUpRight",
		"slideInUp" => "slideInUp",
		"slideInDown" => "slideInDown",
		"slideInLeft" => "slideInLeft",
		"slideInRight" => "slideInRight",
		"zoomIn" => "zoomIn",
		"zoomInDown" => "zoomInDown",
		"zoomInLeft" => "zoomInLeft",
		"zoomInRight" => "zoomInRight",
		"zoomInUp" => "zoomInUp",
		"rollIn" => "rollIn",
	),
	'description' => esc_html__('View animation effect at https://daneden.github.io/animate.css/', 'lucian')
));

vc_add_param("vc_row", array(
	"type" => "textfield",
	"class" => "",
	"heading" => esc_html__('Animation Delay', 'lucian'),
	"param_name" => "animation_delay",
	"value" => "0",
	"dependency" => array(
		"element" => "animation",
		"not_empty" => true,
	),
	"description" => esc_html__('Delay before the animation starts. Ex: 200ms, 0.5s, 1s...', 'lucian')
));

vc_add_param("vc_row", array(
	"type" => "dropdown",
	"class" => "",
	"heading" => esc_html__("Background Position", 'lucian'),
	"param_name" => "background_position",
	"value" => array(
		"Theme Default" => "",
		"Left Top" => "left top",
		"Left Center" => "left center",
		"Left Bottom" => "left bottom",
		"Right Top" => "right top",
		"Right Center" => "right center",
		"Right Bottom" => "right bottom",
		"Center Top" => "center top",
		"Center Center" => "center center",
		"Center Bottom" => "center bottom"
	),
	"group" => 'Design Options',
));


vc_add_param('vc_row', array(
	'type' => 'dropdown',
	'heading' => esc_html__("Overlay Color", 'lucian'),
	'param_name' => 'overlay_row',
	'value' => array(
		'No' => '',
		'Yes' => 'yes'
	),
	'group' => 'Design Options'
));
vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__('Color', 'lucian'),
	"param_name" => "overlay_color",
	'group' => 'Design Options',
	"dependency" => array(
		"element" => "overlay_row",
		"value" => array(
			"yes"
		)
	),
	"description" => ''
));


vc_add_param('vc_row', array(
	'type' => 'dropdown',
	'heading' => esc_html__("Arrow", 'lucian'),
	'param_name' => 'arrow_row',
	'value' => array(
		'No' => '',
		'Yes' => 'yes'
	),
	"description" => 'Add an arrow in the bottom row',
	'group' => 'Design Options'
));
vc_add_param("vc_row", array(
	"type" => "colorpicker",
	"class" => "",
	"heading" => esc_html__('Arrow Color', 'lucian'),
	"param_name" => "arrow_color",
	'group' => 'Design Options',
	"dependency" => array(
		"element" => "arrow_row",
		"value" => array(
			"yes"
		)
	),
	"description" => ''
));

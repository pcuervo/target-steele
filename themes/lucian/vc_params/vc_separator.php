<?php
/*
* Separator
*/
vc_remove_param('vc_separator', 'el_class');
vc_add_param("vc_separator", array(
    "type" => "textfield",
    "class" => "",
    "heading" => esc_html__("Style Border Width", 'lucian'),
    "param_name" => "border_width",
    "value" => "1",
    "description" => "Defualt 1"
));
vc_add_param("vc_separator", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Separator align", 'lucian'),
    "param_name" => "align",
    "value" => array(
        "Left" => "left",
        "Center" => "center",
        "Right" => "right"
    ),
    "description" => ""
));
vc_add_param("vc_separator", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Show Arrow", 'lucian'),
    "param_name" => "separator_arrow",
    "value" => array(
        "No" => "no",
        "Yes" => "yes"
    ),
    "description" => ""
));
vc_add_param("vc_separator", array(
    "type" => "dropdown",
    "class" => "",
    "heading" => esc_html__("Arrow Type", 'lucian'),
    "param_name" => "separator_arrow_type",
    "value" => array(
        "Border" => "border",
        "Image" => "image"
    ),
    "description" => ""
));
vc_add_param("vc_separator", array(
    "type" => "textfield",
    "class" => "",
    "heading" => esc_html__("Arrow Width", 'lucian'),
    "param_name" => "arrow_width",
    "value" => "12",
    "description" => "Set Width for Arrow (Default 12)"
));
vc_add_param("vc_separator", array(
    "type" => "colorpicker",
    "class" => "",
    "heading" => esc_html__("Arrow Color", 'lucian'),
    "param_name" => "arrow_color",
    "value" => "",
    "description" => ""
));
vc_add_param("vc_separator", array(
    "type" => "textfield",
    "class" => "",
    "heading" => esc_html__("Custom Sparator Width", 'lucian'),
    "param_name" => "custom_sparator_width",
    "value" => "",
    "description" => "Set Width Sparator Important: px, %"
));

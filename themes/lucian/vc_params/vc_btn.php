<?php
/**
 * New button implementation
 * array_merge is needed due to merging other shortcode data into params.
 * @since 4.5
 */
global $pixel_icons;
$icons_params = vc_map_integrate_shortcode( 'vc_icon', 'i_', '',
    array(
        'include_only_regex' => '/^(type|icon_\w*)/',
        // we need only type, icon_fontawesome, icon_blabla..., NOT color and etc
    ), array(
        'element' => 'add_icon',
        'value' => 'true',
    )
);
// populate integrated vc_icons params.
if ( is_array( $icons_params ) && ! empty( $icons_params ) ) {
    foreach ( $icons_params as $key => $param ) {
        if ( is_array( $param ) && ! empty( $param ) ) {
            if ( $param['param_name'] == 'i_type' ) {
                // append pixelicons to dropdown
                $icons_params[ $key ]['value'][ esc_html__( 'Pixel', 'lucian' ) ] = 'pixelicons';
            }
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $icons_params[ $key ]['admin_label'] );
            }

        }
    }
}

//Linear Icons
if ( is_array( $icons_params ) && ! empty( $icons_params ) ) {
    foreach ( $icons_params as $key => $param ) {
        if ( is_array( $param ) && ! empty( $param ) ) {
            if ( $param['param_name'] == 'i_type' ) {
                // append pixelicons to dropdown
                $icons_params[ $key ]['value'][ esc_html__( 'Linearicons', 'lucian' ) ] = 'linearicons';
            }
            if ( isset( $param['admin_label'] ) ) {
                // remove admin label
                unset( $icons_params[ $key ]['admin_label'] );
            }

        }
    }
}

$params = array_merge(
    array(
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Text Button', 'lucian' ),
            'save_always' => true,
            'param_name' => 'title',
            // fully compatible to btn1 and btn2
            'value' => esc_html__( 'Text on the button', 'lucian' ),
        ),
        array(
            'type' => 'vc_link',
            'heading' => esc_html__( 'URL (Link)', 'lucian' ),
            'param_name' => 'link',
            'description' => esc_html__( 'Add link to button.', 'lucian' ),
            // compatible with btn2 and converted from href{btn1}
        ),
		
		/* Vu edit */
        array(
            "type" => "dropdown",
            "class" => "",
            "heading" => esc_html__("Button Type", 'lucian'),
            "param_name" => "button_type",
            "value" => array(
                'Button Default' => 'btn btn-default',
                'Button Primary' => 'btn btn-primary',
                'Button Transparent' => 'btn btn-transparent',
                'Button Dark' => 'btn btn-dark',
                'Button Gray' => 'btn btn-gray',
                'Button Gray Transparent' => 'btn btn-gray btn-transparent',
                'Button Pink' => 'btn btn-pink',
            )
        ),
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Padding', 'lucian' ),
            'param_name' => 'padding',
            'description' => esc_html__( 'Ex: 15px 35px 15px 35px.', 'lucian' ),
        ),
		array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Letter Spacing', 'lucian' ),
            'param_name' => 'letter_spacing',
            'value' => array(
                esc_html__( 'Default', 'lucian' ) => '',
                esc_html__( 'Letter Spacing: 50', 'lucian' ) => '0.05em',
                esc_html__( 'Letter Spacing: 100', 'lucian' ) => '0.1em',
                esc_html__( 'Letter Spacing: 200', 'lucian' ) => '0.2em',
                esc_html__( 'Letter Spacing: 300', 'lucian' ) => '0.3em',
                esc_html__( 'Letter Spacing: 400', 'lucian' ) => '0.4em',
                esc_html__( 'Letter Spacing: 500', 'lucian' ) => '0.5em'
            )
        ),
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Font Size', 'lucian' ),
            'param_name' => 'font_size',
            'description' => esc_html__( 'Ex: 15px', 'lucian' ),
        ),
		array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Radius', 'lucian' ),
            'param_name' => 'radius',
            'description' => esc_html__( 'Ex: 15px 35px 15px 35px.', 'lucian' ),
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Alignment', 'lucian' ),
            'param_name' => 'align',
            'description' => esc_html__( 'Select button alignment.', 'lucian' ),
            // compatible with btn2, default left to be compatible with btn1
            'value' => array(
                esc_html__( 'Inline', 'lucian' ) => 'inline',
                esc_html__( 'Left', 'lucian' ) => 'left',
                esc_html__( 'Right', 'lucian' ) => 'right',
                esc_html__( 'Center', 'lucian' ) => 'center'
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Set full width button?', 'lucian' ),
            'param_name' => 'button_block',
            'dependency' => array(
                'element' => 'align',
                'value_not_equal_to' => 'inline',
            ),
        ),
        array(
            'type' => 'checkbox',
            'heading' => esc_html__( 'Add icon?', 'lucian' ),
            'param_name' => 'add_icon',
        ),
        array(
            'type' => 'dropdown',
            'heading' => esc_html__( 'Icon Alignment', 'lucian' ),
            'description' => esc_html__( 'Select icon alignment.', 'lucian' ),
            'param_name' => 'i_align',
            'value' => array(
                esc_html__( 'Left', 'lucian' ) => 'left',
                // default as well
                esc_html__( 'Right', 'lucian' ) => 'right',
            ),
            'dependency' => array(
                'element' => 'add_icon',
                'value' => 'true',
            ),
        ),
    ),
    $icons_params,
    array(
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'lucian' ),
            'param_name' => 'i_icon_pixelicons',
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'pixelicons',
                'source' => $pixel_icons,
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'pixelicons',
            ),
            'description' => esc_html__( 'Select icon from library.', 'lucian' ),
        ),
    ),
    array(
        array(
            'type' => 'iconpicker',
            'heading' => esc_html__( 'Icon', 'lucian' ),
            'param_name' => 'i_icon_linearicons',
            'settings' => array(
                'emptyIcon' => false,
                // default true, display an "EMPTY" icon?
                'type' => 'linearicons',
            ),
            'dependency' => array(
                'element' => 'i_type',
                'value' => 'linearicons',
            ),
            'description' => esc_html__( 'Select icon from library.', 'lucian' ),
        ),
    ),
    array(
        vc_map_add_css_animation( true ),
        array(
            'type' => 'textfield',
            'heading' => esc_html__( 'Extra class name', 'lucian' ),
            'param_name' => 'el_class',
            'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'lucian' ),
        ),
    )
);
/**
 * @class WPBakeryShortCode_VC_Btn
 */
vc_map( array(
    'name' => esc_html__( 'Button', 'lucian' ),
    'base' => 'vc_btn',
    'icon' => 'icon-wpb-ui-button',
    'category' => array(
        esc_html__( 'Content', 'lucian' ),
    ),
    'description' => esc_html__( 'Eye catching button', 'lucian' ),
    'params' => $params,
    'js_view' => 'VcButton3View',
    'custom_markup' => '{{title}}<div class="vc_btn3-container"><button class="vc_general vc_btn3 vc_btn3-size-sm vc_btn3-shape-{{ params.shape }} vc_btn3-style-{{ params.style }} vc_btn3-color-{{ params.color }}">{{{ params.title }}}</button></div>',
) );

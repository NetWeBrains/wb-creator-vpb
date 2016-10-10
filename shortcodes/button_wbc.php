<?php

/*********** Shortcode: Buttons ************************************************************/

$wbcvpb_shortcodes['button_wbc'] = array(
	'name' => esc_html__('Button', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-button',
	'category' => esc_html__('Navigation', 'the-creator-vpb' ),
	'attributes' => array(
		'text' => array(
			'description' => esc_html__( 'Button Text', 'the-creator-vpb' ),
			'default' => esc_html__( 'Click Here', 'the-creator-vpb' ),
			'divider' => 'true',
		),
		'style' => array(
			'description' => esc_html__( 'Style', 'the-creator-vpb' ),
			'default' => 'normal',
			'type' => 'select',
			'values' => array(
				'normal' =>  esc_html__( 'Normal', 'the-creator-vpb' ),
				'rounded' =>  esc_html__( 'Rounded', 'the-creator-vpb' ),
			),
		),
		'size' => array(
			'description' => esc_html__( 'Size', 'the-creator-vpb' ),
			'default' => 'medium',
			'type' => 'select',
			'values' => array(
				'small' =>  esc_html__( 'Small', 'the-creator-vpb' ),
				'medium' => esc_html__( 'Medium', 'the-creator-vpb' ),
				'large' => esc_html__( 'Large', 'the-creator-vpb' ),
				'xlarge' => esc_html__( 'Extra Large', 'the-creator-vpb' ),
			),
		),
		'text_color' => array(
			'description' => esc_html__( 'Text Color', 'the-creator-vpb' ),
			'type' => 'color',
		),
		'background' => array(
			'description' => esc_html__( 'Background Color', 'the-creator-vpb' ),
			'type' => 'coloralpha',
		),
		'effect' => array(
			'description' => esc_html__( 'Effect on Hover', 'the-creator-vpb' ),
			'default' => '',
			'type' => 'select',
			'values' => array(
				'' =>  esc_html__( 'None', 'the-creator-vpb' ),
				'pop' => esc_html__( 'Pop', 'the-creator-vpb' ),
				'zoom' => esc_html__( 'Zoom', 'the-creator-vpb' ),
				'outline-outward' => esc_html__( 'Outline Outward', 'the-creator-vpb' ),
				'float-shadow' => esc_html__( 'Float Shadow', 'the-creator-vpb' ),
				'hover-shadow' => esc_html__( 'Hover Shadow', 'the-creator-vpb' ),
			),
			'divider' => 'true',
		),
		'url' => array(
			'description' => esc_html__( 'URL', 'the-creator-vpb' ),
			'type' => 'url',
		),
		'target' => array(
			'description' => esc_html__( 'Target', 'the-creator-vpb' ),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__( 'Self', 'the-creator-vpb' ),
				'_blank' => esc_html__( 'Blank', 'the-creator-vpb' ),
			),
			'divider' => 'true',
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'the-creator-vpb'),
			'info' => esc_html__('Optional icon after button text', 'the-creator-vpb'),
			'type' => 'icon',
		),
		'id' => array(
			'description' => esc_html__('ID', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom ID', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom classes for custom styling', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),
	)
);

function wbcvpb_button_wbc_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( wbcvpb_extract_attributes('button_wbc'), $atts ) );
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	
	$class_out = 'wbcvpb-button';
	$class_out .= ' wbcvpb-button_'.$style;
	$class_out .= ' wbcvpb-button_'.$size;
	$class_out .= ' '.$class;
	$background = ($background!='') ? 'background:'.$background.';' : '';
	$text_color = ($text_color!='') ? 'color: '.$text_color.';' : '';

	$icon_out = ($icon!='') ? '<i class="'.esc_attr($icon).'"></i>' : '';

	return '<a '.esc_attr($id_out).' href="'. esc_url($url) .'" target="' . esc_attr($target) . '" class="'.esc_attr($class_out).' '.esc_attr($effect).'" style="'.esc_attr($text_color.$background).'">' . esc_html($text) . $icon_out . '</a>';
}



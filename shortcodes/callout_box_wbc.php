<?php

/*********** Shortcode: Callout box ************************************************************/

$wbcvpb_shortcodes['callout_box_wbc'] = array(
	'name' => esc_html__('Callout Box', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-callout-box',
	'category' => esc_html__('Content', 'the-creator-vpb' ),
	'attributes' => array(
		'background_color' => array(
			'description' => esc_html__( 'Background Color', 'the-creator-vpb' ),
			'type' => 'coloralpha',
			'default' => '',
		),
		'title' => array(
			'description' => esc_html__( 'Title', 'the-creator-vpb' ),
		),
		'inverted' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__( 'Inverted (White) Text', 'the-creator-vpb' ),
			'divider' => 'true',
		),
		'button1_text' => array(
			'description' => esc_html__( 'Button Text', 'the-creator-vpb' ),
			'default' => esc_html__( 'Click Here', 'the-creator-vpb' ),
		),
		'button1_size' => array(
			'description' => esc_html__( 'Button Size', 'the-creator-vpb' ),
			'default' => 'medium',
			'type' => 'select',
			'values' => array(
				'small' =>  esc_html__( 'Small', 'the-creator-vpb' ),
				'medium' => esc_html__( 'Medium', 'the-creator-vpb' ),
				'large' => esc_html__( 'Large', 'the-creator-vpb' ),
				'xlarge' => esc_html__( 'Extra Large', 'the-creator-vpb' ),
			),
		),
		'button1_text_color' => array(
			'description' => esc_html__( 'Button Text Color', 'the-creator-vpb' ),
			'type' => 'coloralpha',
		),
		'button1_color' => array(
			'description' => esc_html__( 'Button Background Color', 'the-creator-vpb' ),
			'type' => 'coloralpha',
		),
		'button1_style' => array(
			'description' => esc_html__( 'Button Style', 'the-creator-vpb' ),
			'default' => 'normal',
			'type' => 'select',
			'values' => array(
				'normal' =>  esc_html__( 'Normal', 'the-creator-vpb' ),
				'rounded' =>  esc_html__( 'Rounded', 'the-creator-vpb' ),
			),
		),
		'button1_url' => array(
			'description' => esc_html__( 'Button URL', 'the-creator-vpb' ),
			'type' => 'url',
		),
		'button1_target' => array(
			'default' => '_self',
			'type' => 'select',
			'description' => esc_html__( 'Button Target', 'the-creator-vpb' ),
			'values' => array(
				'_self' =>  esc_html__( 'Self', 'the-creator-vpb' ),
				'_blank' => esc_html__( 'Blank', 'the-creator-vpb' ),
			),
		),
		'button1_icon' => array(
			'description' => esc_html__('Button Icon', 'the-creator-vpb'),
			'info' => esc_html__('Optional icon after button text', 'the-creator-vpb'),
			'type' => 'icon',
		),
		'only_icon' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__( 'Only Icon Button', 'the-creator-vpb' ),
			'info' => esc_html__('Hides button text and shows only icon.', 'the-creator-vpb'),
			'divider' => 'true',
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
	),
	'content' => array(
		'description' => esc_html__( 'Content', 'the-creator-vpb' ),
	),

);

function wbcvpb_callout_box_wbc_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( wbcvpb_extract_attributes('callout_box_wbc'), $atts ) );
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	
	$button1_class_out = 'wbcvpb-button1';
	$button1_class_out .= ' wbcvpb-button_'.$button1_style;
	$button1_class_out .= ' wbcvpb-button_'.$button1_size;

	$button1_text_color = ($button1_text_color!='')? 'color: '.$button1_text_color.';' : '';
	$button1_background_out = ($button1_color!='')? 'background: '.$button1_color.';' : '';
	$button1_icon_out = ($button1_icon!='') ? '<i class="'.esc_attr($button1_icon).'"></i>' : '';

	$background_color = ($background_color!='') ? 'background:'.$background_color.';' : '';

	$content_out = ($content!='') ? ''.do_shortcode($content).'' : '';

	$inverted = ($inverted=='1') ? 'color_white' : '';

	$class = 'wbcvpb-callout_box '.$class;

	$return = '<div '.esc_attr($id_out).' class="wbcvpb-callout_box '.esc_attr($inverted).' '.esc_attr($class).'" style="'.esc_attr($background_color).'">';
	$return .= '<span class="wbcvpb-callout_box_title">'.wp_kses($title, ABdev_allowed_tags()).'</span>';
	$return .= $content_out;
	
	if($only_icon!='1'){
		$return .= '<a href="'. esc_url($button1_url ).'" target="' . esc_attr($button1_target ). '" class="'.esc_attr($button1_class_out).'" style="'.esc_attr($button1_background_out).''.esc_attr($button1_text_color).'">'.wp_kses($button1_text, ABdev_allowed_tags()).$button1_icon_out.'</a>';
	}
	else{
		$return .= '<a href="'. esc_url($button1_url ).'" target="' . esc_attr($button1_target ). '" class="wbcvpb-icon-button">'.$button1_icon_out.'</a>';
	}

	$return .= '</div>';

	return $return;
}




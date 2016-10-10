<?php

/*********** Shortcode: Knob ************************************************************/

$wbcvpb_shortcodes['knob_wbc'] = array(
	'name' => esc_html__('Knob', 'the-creator-vpb'),
	'type' => 'block',
	'icon' => 'pi-knob',
	'category' =>  esc_html__('Charts', 'the-creator-vpb'),
	'attributes' => array(
		'number' => array(
			'description' => esc_html__('Knob Number', 'the-creator-vpb'),
		),
		'number_color' => array(
			'description' => esc_html__('Number Color', 'the-creator-vpb'),
			'type' => 'color',
		),
		'hide_number' => array(
			'description' => esc_html__('Hide Number', 'the-creator-vpb'),
			'type' => 'checkbox',
			'default' => false,
			'divider' => 'true',
		),
		'angle_offset' => array(
			'description' => esc_html__('Angle Offset', 'the-creator-vpb'),
			'info' => esc_html__('Starting angle in degrees, default=0', 'the-creator-vpb'),
		),
		'angle_arc' => array(
			'description' => esc_html__('Angle Arc', 'the-creator-vpb'),
			'info' => esc_html__('Arc size in degrees, default=360', 'the-creator-vpb'),
		),
		'thickness' => array(
			'description' => esc_html__('Arc Thickness', 'the-creator-vpb'),
			'info' => esc_html__('Percent of arc out of circle, 1 very thick, 100 full circle', 'the-creator-vpb'),
		),
		'ending' => array(
			'description' => esc_html__('Arc Stroke Ending', 'the-creator-vpb'),
			'type' => 'select',
			'default' => 'default',
			'values' => array(
				'default' => esc_html__('Default', 'the-creator-vpb'),
				'round' => esc_html__('Rounded', 'the-creator-vpb'),
			),
			'divider' => 'true',
		),
		'full_color' => array(
			'description' => esc_html__('Full Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
		),
		'empty_color' => array(
			'description' => esc_html__('Empty Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
		),
		'inner_color' => array(
			'description' => esc_html__('Inner Circle Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
		),
		'inner_circle_distance' => array(
			'description' => esc_html__('Inner Circle Distance', 'the-creator-vpb'),
			'info' => esc_html__('Distance of inner circle from arc, only if Inner Circle Color is defined; value in px', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'label' => array(
			'description' => esc_html__('Knob Label', 'the-creator-vpb'),
		),
		'label_color' => array(
			'description' => esc_html__('Knob Label Color', 'the-creator-vpb'),
			'type' => 'color',
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

);
function wbcvpb_knob_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('knob_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$thickness_out = ($thickness!='') ? $thickness/100 : '';
	$label_color_out = ($label_color!='') ? 'color:'.esc_attr($label_color).';' : '';

	$out ='<div '.esc_attr($id_out).' class="wbcvpb_knob_wrapper '.esc_attr($class).'">';
	$out .= '<div class="wbcvpb_knob_inner_wrap">';
	$out .= (!$hide_number) ? '<div class="wbcvpb_knob_number_sign" style="color:'.esc_attr($number_color).';"><span class="wbcvpb_knob_number">0</span>%</div>' :'';
	$out .= '<input type="text" class="wbcvpb_knob" value="'.esc_attr($number).'" data-width="100%"  data-number="'.esc_attr($number).'" data-fgColor="'.esc_attr($full_color).'" data-bgColor="'.esc_attr($empty_color).'" data-innerColor="'.esc_attr($inner_color).'" data-lineCap="'.esc_attr($ending).'" data-thickness="'.esc_attr($thickness_out).'" data-angleArc="'.esc_attr($angle_arc).'" data-angleOffset="'.esc_attr($angle_offset).'" data-hideNumber="'.esc_attr($hide_number).'" data-innerCircleDistance="'.esc_attr($inner_circle_distance).'">';
	$out .= '</div>';
	$out .= ($label!='')?'<h3 style="'.$label_color_out.'">'.$label.'</h3>':'';
	$out .= '</div>';
	return $out;
}



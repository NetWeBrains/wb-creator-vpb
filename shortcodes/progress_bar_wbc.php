<?php

/*********** Shortcode: Progress Bar ************************************************************/

$wbcvpb_shortcodes['progress_bar_wbc'] = array(
	'name' => esc_html__('Progress bar', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-progress-bar',
	'category' =>  esc_html__('Charts', 'the-creator-vpb'),
	'attributes' => array(
		'complete' => array(
			'default' => '60',
			'description' => esc_html__('Percentage', 'the-creator-vpb'),
		),
		'text' => array(
			'description' => esc_html__('Text', 'the-creator-vpb'),
		),
		'style' => array(
			'description' => esc_html__('Style', 'the-creator-vpb'),
			'default' => 'default',
			'type' => 'select',
			'values' => array(
				'default' => esc_html__('Default', 'the-creator-vpb'),
				'thick' => esc_html__('Thick', 'the-creator-vpb'),
				'thin' => esc_html__('Thin', 'the-creator-vpb'),
			),
			'divider' => 'true',
		),
		'bar_color_start' => array(
			'description' => esc_html__('Bar Color Start', 'the-creator-vpb'),
			'type' => 'color',
		),
		'bar_color_end' => array(
			'description' => esc_html__('Bar Color End', 'the-creator-vpb'),
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
	'description' => esc_html__('Progress Bar', 'the-creator-vpb' )
);
function wbcvpb_progress_bar_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('progress_bar_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$bar_color_out = ($bar_color_start!='') ? 'background:linear-gradient(to right,' .esc_attr($bar_color_start).',' .esc_attr($bar_color_end).');' : 'background:' .esc_attr($bar_color_start).'; ';

	if($bar_color_start!='' && $bar_color_end!=''){
		$bar_color_out = 'background:linear-gradient(to right,' .esc_attr($bar_color_start).',' .esc_attr($bar_color_end).');';
	}
	else if($bar_color_start!='' || $bar_color_end!=''){
		$bar_color_out = 'background:' .(($bar_color_start!='') ? esc_attr($bar_color_start) : esc_attr($bar_color_end)).'; ';
	}

	$class .= ($style!='') ? 'wbcvpb_progress_bar_' .esc_attr($style) : '';

	return '
		<div '.esc_attr($id_out).' class="wbcvpb_progress_bar '.esc_attr($class).'">
			<span class="wbcvpb_meter_label">'.$text.'</span>
			<div class="wbcvpb_meter">
				<div class="wbcvpb_meter_percentage" data-percentage="'.esc_attr($complete).'" style="width: '.esc_attr($complete).'%;'.esc_attr($bar_color_out).'"><span>'.esc_html($complete).'%</span></div>
			</div>
		</div>';
}


<?php

/*********** Shortcode: Stats Excerpt ************************************************************/

$wbcvpb_shortcodes['stats_excerpt_wbc'] = array(
	'name' => esc_html__('Stats Excerpt', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-stats',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'attributes' => array(
		'background_color' => array(
			'description' => esc_html__('Background Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'divider' => 'true',
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'the-creator-vpb'),
			'type' => 'icon',
		),
		'icon_color' => array(
			'description' => esc_html__('Icon Color', 'the-creator-vpb'),
			'type' => 'color',
			'divider' => 'true',
		),
		'number' => array(
			'description' => esc_html__('Stats Number', 'the-creator-vpb'),
		),
		'number_color' => array(
			'description' => esc_html__('Stats Number Color', 'the-creator-vpb'),
			'type' => 'color',
		),
		'number_sign' => array(
			'description' => esc_html__('Stats Number Sign', 'the-creator-vpb'),
		),
		'number_sign_color' => array(
			'description' => esc_html__('Stats Number Sign Color', 'the-creator-vpb'),
			'type' => 'color',
			'divider' => 'true',
		),
		'duration' => array(
			'description' => esc_html__('Animation Duration (ms)', 'the-creator-vpb'),
			'default' => '1100',
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'the-creator-vpb'),
			'info' => esc_html__('Amount of pixels from bottom to start animation', 'the-creator-vpb'),
			'default' => '0',
			'divider' => 'true',
		),
		'description' => array(
			'description' => esc_html__('Description', 'the-creator-vpb'),
		),
		'description_color' => array(
			'description' => esc_html__('Description Color', 'the-creator-vpb'),
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
	)
);
function wbcvpb_stats_excerpt_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('stats_excerpt_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$icon_out = ($icon!='') ? '<i class="'.esc_attr($icon).'" style="color:'.esc_attr($icon_color).';"></i>' : '';
	$number_sign_out = ($number_sign!='') ? '<span class="wbcvpb_stats_number_sign" style="color:'.esc_attr($number_sign_color).';">'.esc_html($number_sign).'</span>' : '';

	return '
		<div '.esc_attr($id_out).' class="wbcvpb_stats_excerpt '.esc_attr($class).'" style="color:'.esc_attr($background_color).';">
			'.$icon_out.'
			<span class="wbcvpb_stats_number" data-number="'.esc_attr($number).'" data-duration="'.$duration.'" data-trigger_pt="'.esc_attr($trigger_pt).'" style="color:'.esc_attr($number_color).';"></span>
			'.$number_sign_out.'
			<p style="color:'.esc_attr($description_color).';">'.do_shortcode($description).'</p>
		</div>';
}



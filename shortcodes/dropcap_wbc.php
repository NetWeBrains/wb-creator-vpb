<?php

/*********** Shortcode: Dropcap Letter ************************************************************/

$wbcvpb_shortcodes['dropcap_wbc'] = array(
	'name' => esc_html__('Dropcap Letter', 'the-creator-vpb' ),
	'type' => 'inline',
	'attributes' => array(
		'letter' => array(
			'description' => esc_html__('Dropcap letter', 'the-creator-vpb'),
		),
		'color' => array(
			'description' => esc_html__('Letter Color', 'the-creator-vpb'),
			'type' => 'color',
		),
		'background' => array(
			'description' => esc_html__('Background Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
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
function wbcvpb_dropcap_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('dropcap_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$color = ($color!='') ? 'color: '.$color.';' : '';
	$background = ($background!='') ? 'background:'.$background.';' : '';

	return '<span '.esc_attr($id_out).' class="wbcvpb_dropcap '.esc_attr($class).'" style="'.esc_attr($color.$background).'">'.esc_attr($letter).'</span>';
}

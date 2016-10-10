<?php

/*********** Shortcode: Tooltip ************************************************************/

$wbcvpb_shortcodes['tooltip_wbc'] = array(
	'name' => esc_html__('Tooltip', 'the-creator-vpb' ),
	'type' => 'inline',
	'attributes' => array(
		'text' => array(
			'description' => esc_html__('Text', 'the-creator-vpb'),
		),
		'link' => array(
			'description' => esc_html__('Link', 'the-creator-vpb'),
		),
		'target' => array(
			'description' => esc_html__('Target', 'the-creator-vpb'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__('Self', 'the-creator-vpb'),
				'_blank' => esc_html__('Blank', 'the-creator-vpb'),
			),
		),
		'gravity' => array(
			'description' => esc_html__('Tooltip Gravity', 'the-creator-vpb'),
			'default' => 's',
			'type' => 'select',
			'values' => array(
				's' =>  esc_html__('South', 'the-creator-vpb'),
				'n' => esc_html__('North', 'the-creator-vpb'),
				'e' => esc_html__('East', 'the-creator-vpb'),
				'w' => esc_html__('West', 'the-creator-vpb'),
				'nw' =>  esc_html__('Northwest', 'the-creator-vpb'),
				'ne' => esc_html__('Northeast', 'the-creator-vpb'),
				'sw' => esc_html__('Southwest', 'the-creator-vpb'),
				'se' => esc_html__('Southeast', 'the-creator-vpb'),
			),
		),
		'class' => array(
			'description' => esc_html__('Class', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom classes for custom styling', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),
	),
	'content' => array(
		'description' => esc_html__('Tooltip Content', 'the-creator-vpb'),
	)
);
function wbcvpb_tooltip_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('tooltip_wbc'), $attributes));

	$link_output=($link!='')?' href="'.esc_url($link).'"':'';
	$target_output=($target!='')?' target="'.esc_attr($target).'"':'';

	return '<a'.$link_output.' class="wbcvpb_tooltip '.esc_attr($class).'" data-gravity="'.esc_attr($gravity).'" title="'.esc_attr($text).'"'.$target_output.'>'.do_shortcode($content).'</a>';
}

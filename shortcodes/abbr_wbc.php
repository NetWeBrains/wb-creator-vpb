<?php

/********** Shortcode: Abbreviation *************************************************************/

$wbcvpb_shortcodes['abbr_wbc'] = array(
	'name' => esc_html__('Abbreviation', 'the-creator-vpb' ),
	'type' => 'inline',
	'attributes' => array(
		'fullword' => array(
			'info' => esc_html__('e.g. Abbreviation', 'the-creator-vpb'),
			'description' => esc_html__('Full Word', 'the-creator-vpb'),
		),
		'abbr' => array(
			'info' => esc_html__('e.g. abbr', 'the-creator-vpb'),
			'description' => esc_html__('Abbreviation', 'the-creator-vpb'),
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
function wbcvpb_abbr_wbc_shortcode ( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('abbr_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	return '<abbr '.esc_attr($id_out).' class="wbcvpb-abbr wbcvpb_tooltip '.esc_attr($class).'" data-gravity="s" title="' . esc_attr( $fullword ) . '">' . $abbr . '</abbr>';
}


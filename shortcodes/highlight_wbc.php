<?php

/*********** Shortcode: Highlight Color ************************************************************/

$wbcvpb_shortcodes['highlight_wbc'] = array(
	'name' => esc_html__('Highlighted text', 'the-creator-vpb' ),
	'type' => 'inline',
	'attributes' => array(
		'color' => array(
			'type' => 'coloralpha',
			'description' => esc_html__('Highlight Color', 'the-creator-vpb'),
		),
		'text_color' => array(
			'type' => 'color',
			'description' => esc_html__('Text Color', 'the-creator-vpb'),
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
		'description' => esc_html__('Highlighted Content', 'the-creator-vpb'),
	),
);
function wbcvpb_highlight_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('highlight_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$text_color_out = ($text_color != '') ? ' color:'.esc_attr($text_color) : '';
	return '<span '.esc_attr($id_out).' '.esc_attr($class_out).' style="background-color:'.esc_attr($color).';'.$text_color_out.'">' . do_shortcode( $content ) . '</span>';
}

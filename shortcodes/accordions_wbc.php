<?php

/*********** Shortcode: Accordions ************************************************************/

$wbcvpb_shortcodes['accordions_wbc'] = array(
	'name' => esc_html__('Accordion', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-accordion',
	'category' => esc_html__('Content', 'the-creator-vpb' ),
	'child' => 'accordion_wbc',
	'child_button' => esc_html__('New Accordion', 'the-creator-vpb'),
	'child_title' => esc_html__('Accordion Section', 'the-creator-vpb'),
	'attributes' => array(
		'expanded' => array(
			'description' => esc_html__('Expanded accordion no.', 'the-creator-vpb'),
			'info' => esc_html__('Which accordion section will be expanded on load, 0 for none', 'the-creator-vpb'),
			'default' => '1',
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
function wbcvpb_accordions_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('accordions_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	return '<div '.esc_attr($id_out).' class="wbcvpb-accordion '.esc_attr($class).'" data-expanded="'.esc_attr($expanded).'">'.do_shortcode($content).'</div>';
}

$wbcvpb_shortcodes['accordion_wbc'] = array(
	'name' => esc_html__('Single accordion section', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Title', 'the-creator-vpb'),
		),
	),
	'content' => array(
		'description' => esc_html__('Content', 'the-creator-vpb'),
	),
);
function wbcvpb_accordion_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('accordion_wbc'), $attributes));
	$return = '
		<h3>' . esc_html($title) . '</h3>
		<div class="wbcvpb-accordion-body">
			' . do_shortcode($content) . '
		</div>';
  
	return $return;
}

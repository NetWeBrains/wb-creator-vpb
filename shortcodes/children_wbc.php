<?php

/*********** Shortcode: Children of page ************************************************************/

$wbcvpb_shortcodes['children_wbc'] = array(
	'name' => esc_html__('Children of Page', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-children-of-page',
	'category' => esc_html__('Navigation', 'the-creator-vpb' ),
	'attributes' => array(
		'id' => array(
			'description' => esc_html__('Parent Page ID', 'the-creator-vpb'),
		),
		'depth' => array(
			'default' => '9',
			'description' => esc_html__('Depth', 'the-creator-vpb'),
		),
		'id_out' => array(
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
function wbcvpb_children_wbc_shortcode($attributes) {
	extract(shortcode_atts(wbcvpb_extract_attributes('children_wbc'), $attributes));
	$id = ($id == '')? get_the_ID() : $id;
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$children = wp_list_pages('title_li=&child_of='.esc_attr($id).'&echo=0&depth='.esc_attr($depth));
	if ($children)
		return '<ul '.esc_attr($id_out).' class="wbcvpb_children '.esc_attr($class).'">'.$children.'</ul>';
	else
		return '';
}


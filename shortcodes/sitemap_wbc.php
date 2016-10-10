<?php

/*********** Shortcode: Sitemap ************************************************************/

$wbcvpb_shortcodes['sitemap_wbc'] = array(
	'name' => esc_html__('Sitemap', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-sitemap',
	'category' =>  esc_html__('Navigation', 'the-creator-vpb'),
	'attributes' => array(
		'hide_pages' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Hide Pages', 'the-creator-vpb'),
		),
		'hide_categories' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Hide Categories', 'the-creator-vpb'),
		),
		'hide_authors' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Hide Authors', 'the-creator-vpb'),
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
function wbcvpb_sitemap_wbc_shortcode($attributes){
	extract(shortcode_atts(wbcvpb_extract_attributes('sitemap_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$return = '';
	$return .= ($hide_pages != 1) ? '<h4>'.esc_html__('Pages', 'the-creator-vpb').'</h4><ul '.esc_attr($id_out).' class="wbcvpb_sitemap '.esc_attr($class).'">'.wp_list_pages('title_li=&echo=0').'</ul>' : '';
	$return .= ($hide_categories != 1) ? '<h4>'.esc_html__('Categories', 'the-creator-vpb').'</h4><ul '.esc_attr($id_out).' class="wbcvpb_sitemap '.esc_attr($class).'">'.wp_list_categories('title_li=&echo=0').'</ul>' : '';
	$return .= ($hide_authors != 1) ? '<h4>'.esc_html__('Authors', 'the-creator-vpb').'</h4><ul '.esc_attr($id_out).' class="wbcvpb_sitemap '.esc_attr($class).'">'.wp_list_authors('echo=0&hide_empty=0').'</ul>' : '';
	return $return;
}


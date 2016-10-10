<?php

/*********** Shortcode: Vimeo ************************************************************/

$wbcvpb_shortcodes['vimeo_wbc'] = array(
	'name' => esc_html__('Vimeo', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-vimeo',
	'category' =>  esc_html__('Media', 'the-creator-vpb'),
	'attributes' => array(
		'id' => array(
			'description' => esc_html__('Video ID or URL', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'title' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Title', 'the-creator-vpb'),
		),
		'byline' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show By Line', 'the-creator-vpb'),
		),
		'portrait' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Portrait', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'autoplay' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Autoplay', 'the-creator-vpb'),
		),
		'loop' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Loop Playing', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'color' => array(
			'type' => 'color',
			'default' => '#00ADEF',
			'description' => esc_html__('Controls Color', 'the-creator-vpb'),
		),
		'ids' => array(
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
function wbcvpb_vimeo_wbc_shortcode($attributes) {
	extract(shortcode_atts(wbcvpb_extract_attributes('vimeo_wbc'), $attributes));
	$ids_out = ($ids!='') ? 'id='.$ids.'' : '';

	$color = trim($color, '#');
	
	if (strpos($id,'http') !== false) 
		$id = strtok(basename($id), '_');

	$video_src='http://player.vimeo.com/video/'.$id.'?title='.$title.'&amp;byline='.$byline.'&amp;portrait='.$portrait.'&amp;autoplay='.$autoplay.'&amp;loop='.$loop.'&amp;color='.$color;

	return '<div '.esc_attr($ids_out).' class="wbcvpb-videoWrapper-vimeo '.esc_attr($class).'"><iframe src="'.esc_url($video_src).'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>';
}




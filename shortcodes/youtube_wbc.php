<?php

/*********** Shortcode: Youtube ************************************************************/

$wbcvpb_shortcodes['youtube_wbc'] = array(
	'name' => esc_html__('Youtube', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-youtube',
	'category' =>  esc_html__('Media', 'the-creator-vpb'),
	'attributes' => array(
		'url' => array(
			'description' => esc_html__('Video ID or URL', 'the-creator-vpb'),
		),
		'fullscreen_button' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Fullscreen Button', 'the-creator-vpb'),
		),
		'autoplay' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Autoplay', 'the-creator-vpb'),
		),
		'modestbranding' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Modest Branding', 'the-creator-vpb'),
		),
		'controls' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Controls', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'showinfo' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Info Before Play', 'the-creator-vpb'),
		),
		'related' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Show Related When Video Ends', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'start' => array(
			'description' => esc_html__('Start Playing at (in seconds)', 'the-creator-vpb'),
		),
		'end' => array(
			'description' => esc_html__('Stop Playing at (in seconds)', 'the-creator-vpb'),
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
function wbcvpb_youtube_wbc_shortcode($attributes) {
	extract(shortcode_atts(wbcvpb_extract_attributes('youtube_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	
	$options_output = '?autoplay='.$autoplay.'&amp;modestbranding='.$modestbranding.'&amp;controls='.$controls.'&amp;fs='.$fullscreen_button.'&amp;start='.$start.'&amp;end='.$end.'&amp;showinfo='.$showinfo.'&amp;rel='.$related;
	
	if(strlen($id)==11){ 
		$video_src='http://www.youtube.com/embed/'.$url.$options_output;
	}
	else{
		parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
		$video_src='http://www.youtube.com/embed/'.$my_array_of_vars['v'].$options_output;
	}
	
	return '<div '.esc_attr($id_out).' class="wbcvpb-videoWrapper-youtube '.esc_attr($class).'"><iframe src="'.esc_url($video_src).'" frameborder="0" allowfullscreen></iframe></div>';
}



<?php 

/**
	Native WP video shortcode support
**/
$wbcvpb_shortcodes['video'] = array(
	'name' => esc_html__('Video - HTML5', 'the-creator-vpb' ),
	'description' => esc_html__('Video - HTML5', 'the-creator-vpb'),
	'type' => 'block',
	'icon' => 'pi-video',
	'category' =>  esc_html__('Media', 'the-creator-vpb'),
	'third_party' => 1, 
	'attributes' => array(
		'mp4' => array(
			'description' => esc_html__('MP4 file', 'the-creator-vpb'),
			'type' => 'media',
		),
		'm4v' => array(
			'description' => esc_html__('M4V file', 'the-creator-vpb'),
			'type' => 'media',
		),
		'webm' => array(
			'description' => esc_html__('WEBM file', 'the-creator-vpb'),
			'type' => 'media',
		),
		'ogv' => array(
			'description' => esc_html__('OGV file', 'the-creator-vpb'),
			'type' => 'media',
		),
		'wmv' => array(
			'description' => esc_html__('WMV file', 'the-creator-vpb'),
			'type' => 'media',
		),
		'flv' => array(
			'description' => esc_html__('FLV file', 'the-creator-vpb'),
			'type' => 'media',
		),
		'poster' => array(
			'description' => esc_html__('Poster image', 'the-creator-vpb'),
			'type' => 'image',
			'info' => esc_html__('Defines image to show as placeholder before the media plays', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'loop' => array(
			'description' => esc_html__('Loop', 'the-creator-vpb'),
			'default' => 'off',
			'type' => 'select',
			'values' => array( 
				'0' => 'Off',
				'1' => 'On',
			),
			'info' => esc_html__('Allows for the looping of media', 'the-creator-vpb'),
		),
		'autoplay' => array(
			'description' => esc_html__('Autoplay', 'the-creator-vpb'),
			'default' => 'off',
			'type' => 'select',
			'values' => array( 
				'0' => 'Off',
				'1' => 'On',
			),
			'info' => esc_html__('Causes the media to automatically play as soon as the media file is ready', 'the-creator-vpb'),
		),
		'preload' => array(
			'description' => esc_html__('Preload', 'the-creator-vpb'),
			'default' => 'metadata',
			'type' => 'select',
			'values' => array( 
				'metadata' => 'Metadata only',
				'none' => 'None',
				'auto' => 'Load video entirely',
			),
			'info' => esc_html__('Specifies if and how the video should be loaded when the page loads', 'the-creator-vpb'),
		),
	),
);


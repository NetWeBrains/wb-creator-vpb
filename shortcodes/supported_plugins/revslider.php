<?php 

/**
	revslider plugin support
**/
if( in_array('revslider/revslider.php', get_option('active_plugins')) ){ //first check if plugin is installed

	global $wpdb;

	$sliders = $wpdb->get_results( "SELECT alias, title FROM ".GlobalsRevSlider::$table_sliders );
	
	$sliders_array = array();
	if(is_array($sliders)){
		foreach ($sliders as $slide) {
			$sliders_array[$slide->alias] = $slide->title;
		}
	}

	$wbcvpb_shortcodes['rev_slider'] = array(
		'name' => esc_html__('Revolution Slider', 'the-creator-vpb' ),
		'description' => esc_html__('Revolution Slider', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-slider',
		'category' =>  esc_html__('Media', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'alias' => array(
				'description' => esc_html__('Slider Alias', 'the-creator-vpb'),
				'default' => '',
				'type' => 'select',
				'values' => $sliders_array,
			),
		),
	);
}


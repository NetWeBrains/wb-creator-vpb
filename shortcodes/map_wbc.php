<?php

/*********** Shortcode: Google Map ************************************************************/

$wbcvpb_shortcodes['map_wbc'] = array(
	'name' => esc_html__('Google Map', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-google-map',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'child' 		=> 'map_marker_wbc',
	'child_button' 		=> esc_html__('Add New Marker', 'the-creator-vpb'),
	'child_title' 		=> esc_html__('Marker', 'the-creator-vpb'),
	'attributes' => array(
		'h' => array(
			'default' => '400px',
			'tab' => esc_html__('Customize', 'the-creator-vpb'),
			'description' => esc_html__('Height', 'the-creator-vpb'),
		),
		'map_type' => array(
			'type' => 'select',
			'tab' => esc_html__('Customize', 'the-creator-vpb'),
			'default' => 'ROADMAP',
			'description' => esc_html__('Map Type', 'the-creator-vpb'),
			'values' => array(
				'ROADMAP' => esc_html__('ROADMAP', 'the-creator-vpb'),
				'SATELLITE' => esc_html__('SATELLITE', 'the-creator-vpb'),
				'HYBRID' => esc_html__('HYBRID', 'the-creator-vpb'),
				'TERRAIN' => esc_html__('TERRAIN', 'the-creator-vpb'),
			),
		),
		'lat' => array(
			'default' => '40.7782201',
			'description' => esc_html__('Map Center Latitude', 'the-creator-vpb'),
		),
		'lng' => array(
			'default' => '-73.9733317',
			'description' => esc_html__('Map Center Longitude', 'the-creator-vpb'),
		),
		'auto_center_zoom' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Auto Center and Zoom to Show all Markers', 'the-creator-vpb'),
		),
		'zoom' => array(
			'type' => 'select',
			'tab' => esc_html__('Customize', 'the-creator-vpb'),
			'default' => '16',
			'description' => esc_html__('Zoom Level', 'the-creator-vpb'),
			'values' => array(
				'1' => esc_html__('1', 'the-creator-vpb'),
				'2' => esc_html__('2', 'the-creator-vpb'),
				'3' => esc_html__('3', 'the-creator-vpb'),
				'4' => esc_html__('4', 'the-creator-vpb'),
				'5' => esc_html__('5', 'the-creator-vpb'),
				'6' => esc_html__('6', 'the-creator-vpb'),
				'7' => esc_html__('7', 'the-creator-vpb'),
				'8' => esc_html__('8', 'the-creator-vpb'),
				'9' => esc_html__('9', 'the-creator-vpb'),
				'10' => esc_html__('10', 'the-creator-vpb'),
				'11' => esc_html__('11', 'the-creator-vpb'),
				'12' => esc_html__('12', 'the-creator-vpb'),
				'13' => esc_html__('13', 'the-creator-vpb'),
				'14' => esc_html__('14', 'the-creator-vpb'),
				'15' => esc_html__('15', 'the-creator-vpb'),
				'16' => esc_html__('16', 'the-creator-vpb'),
				'17' => esc_html__('17', 'the-creator-vpb'),
				'18' => esc_html__('18', 'the-creator-vpb'),
				'19' => esc_html__('19', 'the-creator-vpb'),
				'20' => esc_html__('20', 'the-creator-vpb'),
				'21' => esc_html__('21', 'the-creator-vpb'),
			),
		),
		'scrollwheel' => array(
			'tab' => esc_html__('Customize', 'the-creator-vpb'),
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Enable Scrollweel', 'the-creator-vpb'),
		),
		'maptypecontrol' => array(
			'default' => '1',
			'tab' => esc_html__('Customize', 'the-creator-vpb'),
			'type' => 'checkbox',
			'description' => esc_html__('Show Map Type Controls', 'the-creator-vpb'),
		),
		'pancontrol' => array(
			'default' => '1',
			'tab' => esc_html__('Customize', 'the-creator-vpb'),
			'type' => 'checkbox',
			'description' => esc_html__('Show Pan Controls', 'the-creator-vpb'),
		),
		'zoomcontrol' => array(
			'default' => '1',
			'tab' => esc_html__('Customize', 'the-creator-vpb'),
			'type' => 'checkbox',
			'description' => esc_html__('Show Zoom Controls', 'the-creator-vpb'),
		),
		'scalecontrol' => array(
			'default' => '1',
			'tab' => esc_html__('Customize', 'the-creator-vpb'),
			'type' => 'checkbox',
			'description' => esc_html__('Show Scale Controls', 'the-creator-vpb'),
		),
	),
);

function wbcvpb_map_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('map_wbc'), $attributes));
	static $i = 0;
	$i++;

	$map_data = ' '
		.'data-map_type="'.$map_type.'" '
		.'data-auto_center_zoom="'.esc_attr($auto_center_zoom).'" '
		.'data-lat="'.esc_attr($lat).'" '
		.'data-lng="'.esc_attr($lng).'" '
		.'data-zoom="'.$zoom.'" '
		.'data-scrollwheel="'.$scrollwheel.'" '
		.'data-maptypecontrol="'.$maptypecontrol.'" '
		.'data-pancontrol="'.$pancontrol.'" '
		.'data-zoomcontrol="'.$zoomcontrol.'" '
		.'data-scalecontrol="'.$scalecontrol.'" ';

	return '
			<div class="wbcvpb_google_map_wrapper">
				<div id="wbcvpb_google_map_'.$i.'" '.$map_data.' class="wbcvpb_google_map" style="height:'.esc_attr($h).';width:100%;"></div>
				<div id="map-overlay"></div>
				'.do_shortcode($content).'
			</div>';

}

$wbcvpb_shortcodes['map_marker_wbc'] = array(
	'name' => esc_html__('Single marker section', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'add_markertitle' => array(
			'default' => 'Our Company',
			'description' => esc_html__('Marker Title', 'the-creator-vpb'),
		),
		'add_marker_subtitle' => array(
			'description' => esc_html__('Marker Subtitle', 'the-creator-vpb'),
		),
		'add_markericon' => array(
			'type' => 'image',
			'description' => esc_html__('Custom Marker Image', 'the-creator-vpb'),
		),
		'add_markerlat' => array(
			'description' => esc_html__('Marker Latitude', 'the-creator-vpb'),
		),
		'add_markerlng' => array(
			'description' => esc_html__('Marker Longitude', 'the-creator-vpb'),
		),
		'add_adress' => array(
			'description' => esc_html__('Marker Adress', 'the-creator-vpb'),
		),
		'add_telephone1' => array(
			'description' => esc_html__('Marker Telephone 1', 'the-creator-vpb'),
		),
		'add_telephone2' => array(
			'description' => esc_html__('Marker Telephone 2', 'the-creator-vpb'),
		),
		'add_faxnumber' => array(
			'description' => esc_html__('Marker Fax', 'the-creator-vpb'),
		),
		'add_email' => array(
			'description' => esc_html__('Marker E-mail', 'the-creator-vpb'),
		),
	),
	'content' => array(
		'description' => esc_html__('Content', 'the-creator-vpb'),
	)
);

function wbcvpb_map_marker_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('map_marker_wbc'), $attributes));
	$marker_attr = 'data-title="'.esc_attr($add_markertitle).'" data-icon="'.esc_attr($add_markericon).'" data-lat="'.esc_attr($add_markerlat).'" data-lng="'.esc_attr($add_markerlng).'"';
	$return = '<div class="wbcvpb_google_map_marker" '.$marker_attr.'>';
	$return .= do_shortcode($content);

	//$return .= ($add_marker_subtitle!='') ? '<h5>'.html_entity_decode($add_marker_subtitle).'</h5>' : '';
	//$return .= ($add_adress!='') ? '<p class="no_margin_bottom">'.html_entity_decode($add_adress).'</p>' : '';
	//$return .= ($add_telephone1!='') ? '<p class="no_margin_bottom">Tel: '.html_entity_decode($add_telephone1).'</p>' : '';
	//$return .= ($add_telephone2!='') ? '<p class="no_margin_bottom">Tel(2): '.html_entity_decode($add_telephone2).'</p>' : '';
	//$return .= ($add_faxnumber!='') ? '<p class="no_margin_bottom">Fax: '.html_entity_decode($add_faxnumber).'</p>' : '';
	//$return .= ($add_email!='') ? '<p class="no_margin_bottom">E-mail: <a href="mailto:'.esc_url($add_email).'">'.esc_html($add_email).'</a></p>' : '';

	$return .= '</div>';

	return $return;

}
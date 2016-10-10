<?php

/*********** Shortcode: Date ************************************************************/

$wbcvpb_shortcodes['date_wbc'] = array(
	'name' => __('Date', 'the-creator-vpb' ),
	'type' => 'inline',
	'attributes' => array(
		'format' => array(
			'default' => 'd.m.Y',
			'description' => __('PHP Date Format', 'the-creator-vpb'),
		),
		'target' => array(
			'description' => __('Target Date', 'the-creator-vpb'),
			'info' => __('PHP strtotime acceptable string, e.g. yesterday, last Monday, 2 days ago...', 'the-creator-vpb'),
		),
	)
);
function wbcvpb_date_wbc_shortcode($attributes, $content = null){
	extract(shortcode_atts(wbcvpb_extract_attributes('date_wbc'), $attributes));
	
	if($target=='')
		return date($format);
	else 
		return date($format,strtotime($target));
}

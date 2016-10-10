<?php

/*********** Shortcode: Current Year ************************************************************/

$wbcvpb_shortcodes['current_year_wbc'] = array(
	'name' => esc_html__('Current Year', 'the-creator-vpb' ),
	'notice' => esc_html__('This shortcode will generate current year, no matter when post was published', 'the-creator-vpb'),
	'type' => 'inline',
	'icon' => 'pi-customize',
);
function wbcvpb_current_year_wbc_shortcode(){
	return date('Y');
}


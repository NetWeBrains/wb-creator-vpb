<?php

/*********** Shortcode: Follow us links ************************************************************/

$wbcvpb_shortcodes['follow_us_wbc'] = array(
	'name' => esc_html__('Follow us Profile Links', 'the-creator-vpb'),
	'type' =>  'block',
	'icon' => 'pi-social-links',
	'category' =>  esc_html__('Social', 'the-creator-vpb'),
	'child' => 'follows_us_wbc',
	'child_button' => esc_html__('New Profile Link', 'the-creator-vpb'),
	'child_title' => esc_html__('Follow us Link', 'the-creator-vpb'),
	'attributes' => array(
		'dummy' => array(
			'type' => 'hidden'
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
function wbcvpb_follow_us_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('follow_us_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	return '<div '.esc_attr($id_out).' class="wbcvpb_follow_us '.$class.'">'.do_shortcode($content).'</div>';
}

$wbcvpb_shortcodes['follows_us_wbc'] = array(
	'name' => esc_html__('Single Follow us Link', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Tooltip Title', 'the-creator-vpb'),
			'info' => esc_html__('Name of the social network (e.g. Follow us on Facebook,Follow us on Twitter,Follow us on Google+), this will be shown as tooltip', 'the-creator-vpb'),
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'the-creator-vpb'),
			'type' => 'icon',
		),
		'url' => array(
			'description' => esc_html__('Profile URL', 'the-creator-vpb'),
			'type' => 'url',
		),
		'target' => array(
			'description' => esc_html__('Target', 'the-creator-vpb'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__('Self', 'the-creator-vpb'),
				'_blank' => esc_html__('Blank', 'the-creator-vpb'),
			),
		),
		'gravity' => array(
			'default' => 's',
			'description' => esc_html__('Tooltip Gravity Position', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				's' => esc_html__('South', 'the-creator-vpb'),
				'n' => esc_html__('North', 'the-creator-vpb'),
				'e' => esc_html__('East', 'the-creator-vpb'),
				'w' => esc_html__('West', 'the-creator-vpb'),
			),
		),
	),
);
function wbcvpb_follows_us_wbc_shortcode( $attributes, $content = null  ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('follows_us_wbc'), $attributes));
	
	$return = '<a class="wbcvpb_socialicon wbcvpb_tooltip" data-gravity="'.esc_attr($gravity).'" href="'.esc_url($url).'" target="'.esc_attr($target).'" title="'.esc_attr($title).'"><i class="'.esc_attr($icon).'"></i></a>';

    return $return;
}

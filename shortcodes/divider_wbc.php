<?php

/*********** Shortcode: Content Divider ************************************************************/

$wbcvpb_shortcodes['divider_wbc'] = array(
	'name' => esc_html__('Content Divider', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-divider',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'attributes' => array(
		'style' => array(
			'default' => 'style1',
			'description' => esc_html__('Divider Style', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'solid' => 'Solid Line',
				'dashed' => 'Dashed Line',
				'dotted' => 'Dotted Line',
			),
		),
		'text' => array(
			'description' => esc_html__('Text', 'the-creator-vpb'),
			'info' => esc_html__('e.g. Go to top', 'the-creator-vpb'),
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'the-creator-vpb'),
			'type' => 'icon',
		),
		'animation' => array(
			'default' => '',
			'description' => esc_html__('Entrance Animation', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'' => esc_html__('None', 'the-creator-vpb'),
				'flip' => esc_html__('Flip', 'the-creator-vpb'),
				'flipInX' => esc_html__('Flip In X', 'the-creator-vpb'),
				'flipInY' => esc_html__('Flip In Y', 'the-creator-vpb'),
				'fadeIn' => esc_html__('Fade In', 'the-creator-vpb'),
				'fadeInUp' => esc_html__('Fade In Up', 'the-creator-vpb'),
				'fadeInDown' => esc_html__('Fade In Down', 'the-creator-vpb'),
				'fadeInLeft' => esc_html__('Fade In Left', 'the-creator-vpb'),
				'fadeInRight' => esc_html__('Fade In Right', 'the-creator-vpb'),
				'fadeInUpBig' => esc_html__('Fade In Up Big', 'the-creator-vpb'),
				'fadeInDownBig' => esc_html__('Fade In Down Big', 'the-creator-vpb'),
				'fadeInLeftBig' => esc_html__('Fade In Left Big', 'the-creator-vpb'),
				'fadeInRightBig' => esc_html__('Fade In Right Big', 'the-creator-vpb'),
				'slideInLeft' => esc_html__('Slide In Left', 'the-creator-vpb'),
				'slideInRight' => esc_html__('Slide In Right', 'the-creator-vpb'),
				'bounceIn' => esc_html__('Bounce In', 'the-creator-vpb'),
				'bounceInDown' => esc_html__('Bounce In Down', 'the-creator-vpb'),
				'bounceInUp' => esc_html__('Bounce In Up', 'the-creator-vpb'),
				'bounceInLeft' => esc_html__('Bounce In Left', 'the-creator-vpb'),
				'bounceInRight' => esc_html__('Bounce In Right', 'the-creator-vpb'),
				'rotateIn' => esc_html__('Rotate In', 'the-creator-vpb'),
				'rotateInDownLeft' => esc_html__('Rotate In Down Left', 'the-creator-vpb'),
				'rotateInDownRight' => esc_html__('Rotate In Down Right', 'the-creator-vpb'),
				'rotateInUpLeft' => esc_html__('Rotate In Up Left', 'the-creator-vpb'),
				'rotateInUpRight' => esc_html__('Rotate In Up Right', 'the-creator-vpb'),
				'lightSpeedIn' => esc_html__('Light Speed In', 'the-creator-vpb'),
				'rollIn' => esc_html__('Roll In', 'the-creator-vpb'),
				'flash' => esc_html__('Flash', 'the-creator-vpb'),
				'bounce' => esc_html__('Bounce', 'the-creator-vpb'),
				'shake' => esc_html__('Shake', 'the-creator-vpb'),
				'tada' => esc_html__('Tada', 'the-creator-vpb'),
				'swing' => esc_html__('Swing', 'the-creator-vpb'),
				'wobble' => esc_html__('Wobble', 'the-creator-vpb'),
				'pulse' => esc_html__('Pulse', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'duration' => array(
			'description' => esc_html__('Animation Duration (ms)', 'the-creator-vpb'),
			'default' => '1100',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
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
function wbcvpb_divider_wbc_shortcode( $attributes ) {
    extract(shortcode_atts(wbcvpb_extract_attributes('divider_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$icon_output = ($icon != '')?' <i class="'.$icon.'"></i>':'';
	$divider_style = ($style != '') ? 'wbcvpb_divider_'.$style.'' : '';

	$animation_class = $animation_animation = $animation_duration = '';
	if (!empty($animation) && $animation!=''){
		$animation_class = ' wbcvpb-animo';
		$animation_animation = ' data-animation="'.esc_attr($animation).'"';
		$animation_duration = ($duration!='') ? ' data-duration="'.esc_attr($duration).'"' : ' data-duration="1"';
	}

	return '<div '.esc_attr($id_out).' class="wbcvpb_divider '.esc_attr($divider_style).' '.esc_attr($class).'"><a href="#" class="backtotop'.esc_attr($animation_class).'"'.$animation_animation.$animation_duration.'>'.$text.$icon_output.'</a></div>';
}

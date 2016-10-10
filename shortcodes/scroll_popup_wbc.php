<?php

/*********** Shortcode: Scroll Popup ************************************************************/

$wbcvpb_shortcodes['scroll_popup_wbc'] = array(
	'name' => esc_html__('Scroll Popup', 'the-creator-vpb' ),
	'type' =>  'block',
	'icon' => 'pi-scroll-popup',
	'category' =>  esc_html__('Media', 'the-creator-vpb'),
	'attributes' => array(
		'url' => array(
			'type' => 'image',
			'description' => esc_html__('Select Image', 'the-creator-vpb'),
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
		'timing' => array(
			'default' => 'linear',
			'description' => esc_html__('Timing Function', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'linear' => esc_html__('Linear', 'the-creator-vpb'),
				'ease' => esc_html__('Ease', 'the-creator-vpb'),
				'ease-in' => esc_html__('Ease-in', 'the-creator-vpb'),
				'ease-out' => esc_html__('Ease-out', 'the-creator-vpb'),
				'ease-in-out' => esc_html__('Ease-in-out', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),	
		'duration' => array(
			'description' => esc_html__('Animation Duration (in ms)', 'the-creator-vpb'),
			'default' => '1000',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),		
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'the-creator-vpb'),
			'default' => '0',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'position' => array(
			'default' => 'top_center',
			'description' => esc_html__('Popup Position', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'top_center' => esc_html__('Top Center', 'the-creator-vpb'),
				'top_left' => esc_html__('Top Left', 'the-creator-vpb'),
				'top_right' => esc_html__('Top Right', 'the-creator-vpb'),
				'center_center' => esc_html__('Center Center', 'the-creator-vpb'),
				'center_left' => esc_html__('Center Left', 'the-creator-vpb'),
				'center_right' => esc_html__('Center Right', 'the-creator-vpb'),
				'bottom_center' => esc_html__('Bottom Center', 'the-creator-vpb'),
				'bottom_left' => esc_html__('Bottom Left', 'the-creator-vpb'),
				'bottom_right' => esc_html__('Bottom Right', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'width' => array(
			'description' => esc_html__('Popup Width (% or px)', 'the-creator-vpb'),
			'info' => esc_html__('e.g. 30%', 'the-creator-vpb'),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'height' => array(
			'description' => esc_html__('Popup Height (% or px)', 'the-creator-vpb'),
			'info' => esc_html__('e.g. 500px', 'the-creator-vpb'),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'close_icon' => array(
			'description' => esc_html__( 'Close Icon', 'the-creator-vpb' ),
			'info' => esc_html__('Choose Close Icon that will be shown on hover', 'the-creator-vpb'),
			'type' => 'icon',
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
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
	'content' => array(
		'description' => esc_html__('Content', 'the-creator-vpb'),
	),
);
function wbcvpb_scroll_popup_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('scroll_popup_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$classes=array();
	$classes[] = $position;
	$animation_out='';

	if($animation!=''){
		$classes[] = 'wbcvpb-animo';
		$duration = ($duration!='') ? $duration : '1000';
		$animation_out = 'data-animation="'.esc_attr($animation).'" data-trigger_pt="0" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	if($class!=''){
		$classes[] = $class;
	}

	$classes = implode(' ', $classes);

	$size = ($width!='' || $height!='') ? 'style="width:'.esc_attr($width).';height:'.esc_attr($height).';"' : '';

	$return = '<div '.esc_attr($id_out).' class="wbcvpb-popup-wrapper">
					<div class="wbcvpb-popup-shadow">
						<div class="wbcvpb-popup-content '.esc_attr($classes).'" '.$size.' '.$animation_out.'>';

	$return .= ($url != '') ?'<img src="'.esc_url($url).'">' : '';
	$return .= ($content != '') ?''.do_shortcode($content).'' : '';
	$return .= '<i class="'.esc_attr($close_icon).'"></i>';

	$return .= '</div></div></div>';

	return $return;
}

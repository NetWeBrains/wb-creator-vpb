<?php

/*********** Shortcode: Image Hotspots ************************************************************/

$wbcvpb_shortcodes['image_hotspots_wbc'] = array(
	'name' => esc_html__('Image Hotspots', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-image-hotspots',
	'category' => esc_html__('Media', 'the-creator-vpb' ),
	'child' => 'image_hotspot_wbc',
	'child_button' => esc_html__('New Hotspot', 'the-creator-vpb'),
	'child_title' => esc_html__('Hotspot', 'the-creator-vpb'),
	'attributes' => array(
		'url' => array(
			'type' => 'image',
			'description' => esc_html__('Select Image', 'the-creator-vpb'),
		),
		'animation' => array(
			'default' => 'none',
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
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'the-creator-vpb'),
			'info' => esc_html__('Amount of pixels from bottom to start animation', 'the-creator-vpb'),
			'default' => '0',
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
function wbcvpb_image_hotspots_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('image_hotspots_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$classes=array();
	$animation_out='';

	if($animation!=''){
		$classes[] = 'wbcvpb-animo';
		$duration = ($duration!='') ? $duration : '1000';
		$animation_out = 'data-animation="'.esc_attr($animation).'" data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	if($class!=''){
		$classes[] = $class;
	}

	$classes = implode(' ', $classes);

	return '<div '.esc_attr($id_out).' class="'.esc_attr($classes).'" '.$animation_out.' style="position:relative;"><img src="'.esc_url($url).'">'.  do_shortcode($content)  . '</div>';
}

$wbcvpb_shortcodes['image_hotspot_wbc'] = array(
	'name' => esc_html__('Single hotspot section', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'top' => array(
			'description' => esc_html__('Vertical Position (%)', 'the-creator-vpb'),
		),
		'left' => array(
			'description' => esc_html__('Horizontal Position (%)', 'the-creator-vpb'),
		),
		'number' => array(
			'description' => esc_html__('Number in Hotspot', 'the-creator-vpb'),
		),
		'icon' => array(
			'description' => esc_html__('Icon in Hotspot', 'the-creator-vpb'),
			'type' => 'icon',
		),
		'color' => array(
			'description' => esc_html__('Icon or Text Color', 'the-creator-vpb'),
			'type' => 'color',
		),
		'effect' => array(
			'default' => '',
			'description' => esc_html__('Select Hotspot Effect', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'' => esc_html__('None', 'the-creator-vpb'),
				'pulse' => esc_html__('Pulse', 'the-creator-vpb'),
				'grow' => esc_html__('Grow', 'the-creator-vpb'),
			),
		),
		'hotspot_background' => array(
			'description' => esc_html__('Hotspot Background', 'the-creator-vpb'),
			'type' => 'coloralpha',
		),
		'pulse_background' => array(
			'description' => esc_html__('Effect Background', 'the-creator-vpb'),
			'type' => 'coloralpha',
		),
		'gravity' => array(
			'default' => 's',
			'description' => esc_html__('Tooltip Position', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'n' => esc_html__('Top', 'the-creator-vpb'),
				's' => esc_html__('Bottom', 'the-creator-vpb'),
				'e' => esc_html__('Left', 'the-creator-vpb'),
				'w' => esc_html__('Right', 'the-creator-vpb'),
			),
		),
		'tooltip_content' => array(
			'description' => esc_html__('Tooltip Content', 'the-creator-vpb'),
		),
	),
);
function wbcvpb_image_hotspot_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('image_hotspot_wbc'), $attributes));

	$icon_out = ($icon !='') ? '<i class="'.esc_attr($icon).'"></i>' : '';
	$number_out = ($number !='') ? '<span>'.esc_attr($number).'</span>' :'';
	$color = ($color!='') ? 'color: '.esc_attr($color).';' : '';
	$hotspot_background = ($hotspot_background!='') ? 'background:'.esc_attr($hotspot_background).';' : '';
	$pulse_background = ($pulse_background!='') ? 'background:'.esc_attr($pulse_background).';' : '';

	$return = '
		<div class="wbcvpb-hotspot-body" style="position:absolute; top:'.esc_attr($top).'%; left:'.esc_attr($left).'%;">
			<a class="wbcvpb-hotspot-tooltip" style="'.esc_attr($hotspot_background.$color).'" title="'.esc_attr($tooltip_content).'" data-gravity="'.esc_attr($gravity).'">
				'.$icon_out.'
				'.$number_out.'
			</a>
			<div class="wbcvpb-hotspot-'.esc_attr($effect).'" style="'.esc_attr($pulse_background).'"></div>
		</div>';
  
	return $return;
}
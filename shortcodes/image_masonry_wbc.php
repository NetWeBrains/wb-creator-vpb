<?php

/*********** Shortcode: Image Masonry ************************************************************/

$wbcvpb_shortcodes['image_masonrys_wbc'] = array(
	'name' => esc_html__('Image Masonry', 'the-creator-vpb' ),
	'type' =>  'block',
	'icon' => 'pi-image-masonry',
	'category' =>  esc_html__('Media', 'the-creator-vpb'),
	'child' => 'image_masonry_wbc',
	'child_button' => esc_html__('New Image', 'the-creator-vpb'),
	'child_title' => esc_html__('Image Section', 'the-creator-vpb'),
	'attributes' => array(			
		'image_width' => array(
			'default' => 'four_columns',
			'description' => esc_html__('Number of Columns', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'two_columns' =>  esc_html__('Two Columns', 'the-creator-vpb'),
				'three_columns' =>  esc_html__('Three Columns', 'the-creator-vpb'),
				'four_columns' =>  esc_html__('Four Columns', 'the-creator-vpb'),
				'five_columns' =>  esc_html__('Five Columns', 'the-creator-vpb'),
				'six_columns' =>  esc_html__('Six Columns', 'the-creator-vpb'),
				'seven_columns' =>  esc_html__('Seven Columns', 'the-creator-vpb'),
				'eight_columns' =>  esc_html__('Eight Columns', 'the-creator-vpb'),
				'nine_columns' =>  esc_html__('Nine Columns', 'the-creator-vpb'),
			),
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
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'the-creator-vpb'),
			'info' => esc_html__('Amount of pixels from bottom to start animation', 'the-creator-vpb'),
			'default' => '0',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),	
		'duration' => array(
			'description' => esc_html__('Animation Duration (ms)', 'the-creator-vpb'),
			'default' => '1100',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),		
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'the-creator-vpb'),
			'default' => '200',
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
function wbcvpb_image_masonrys_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('image_masonrys_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	static $i = 0;
	$i++;

	global $image_masonrys_wbc_count;
	$image_masonrys_wbc_count = $i;

	$classes=array();
	$classes[] = $image_width;
	$animation_out='';

	if($animation!=''){
		$classes[] = 'wbcvpb-animo-children';
		$duration = ($duration!='') ? $duration : '1000';
		$animation_out = 'data-animation="'.esc_attr($animation).'" data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	if($class!=''){
		$classes[] = $class;
	}

	$classes = implode(' ', $classes);

	return '<div '.esc_attr($id_out).' class="wbcvpb-image-masonry '.esc_attr($classes).'" '.$animation_out.'>'.  do_shortcode($content)  . '</div>';
}

$wbcvpb_shortcodes['image_masonry_wbc'] = array(
	'name' => esc_html__('Single Image Section', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'url' => array(
			'type' => 'image',
			'description' => esc_html__('Select Image', 'the-creator-vpb'),
		),
		'link' => array(
			'description' => esc_html__('Link', 'the-creator-vpb'),
		),
		'link_text' => array(
			'description' => esc_html__('Link Text', 'the-creator-vpb'),
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
		'lightbox' => array(
			'description' => esc_html__( 'Use Lightbox', 'the-creator-vpb' ),
			'default' => '0',
			'type' => 'checkbox',
		),
		'lightbox_icon' => array(
			'description' => esc_html__( 'Lightbox Icon', 'the-creator-vpb' ),
			'info' => esc_html__('Choose Lightbox Icon that will be shown on hover', 'the-creator-vpb'),
			'type' => 'icon',
		),
	),
);

function wbcvpb_image_masonry_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('image_masonry_wbc'), $attributes));

	global $image_masonrys_wbc_count;
	
	$lightbox_icon = ($lightbox_icon!='') ? '<i class="'.esc_attr($lightbox_icon).'"></i>' : '';

	$return = '<div class="image-masonry">';
	if($lightbox == '1') {
		$return .= '<a href="'.esc_url($url).'" data-lightbox="image-masonry-'.$image_masonrys_wbc_count.'"><img src="'.esc_url($url).'">
			<canvas class="grey-effect"></canvas>
			'.$lightbox_icon.'
		</a>';
	}
	else if($link != '') {
		$return .= '<a href="'.esc_url($link).'" target="'.esc_attr($target).'"><img src="'.esc_url($url).'">
			<canvas class="grey-effect"></canvas>';
			$return .= ($link_text !='') ? '<span>'.esc_html($link_text).'</span>' :'';
		$return .= '</a>';
	}
	else{
		$return .= '<img src="'.esc_url($url).'">';
	}

	$return .= '</div>';

	return $return;
}

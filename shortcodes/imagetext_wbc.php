<?php

/*********** Shortcode: Image Text Box ************************************************************/

$wbcvpb_shortcodes['imagetext_wbc'] = array(
	'name' => esc_html__('Image Text Box', 'the-creator-vpb' ),
	'description' => esc_html__('You can place any HTML content in this box and animate it.', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-text',
	'category' => esc_html__('Content', 'the-creator-vpb' ),
	'attributes' => array(
		'image' => array(
			'type' => 'image',
			'description' => esc_html__('Image', 'the-creator-vpb'),
		),
		'image_position' => array(
			'default' => 'left',
			'type' => 'select',
			'values' => array(
				'left' => 'Left',
				'right' => 'Right',
				'center' => 'Center'
			),
			'description' => esc_html__('Image', 'the-creator-vpb'),
		),
		'size' => array(
			'default' => '',
			'description' => esc_html__('Text size', 'the-creator-vpb'),
		),
		'color' => array(
			'type' => 'color',
			'description' => esc_html__('Text color', 'the-creator-vpb'),
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
			'description' => esc_html__('Animation Duration (in ms)', 'the-creator-vpb'),
			'default' => '1000',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),		
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'the-creator-vpb'),
			'default' => '0',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'members' => array(
			'description' => esc_html__( 'Hide Content Only to Members', 'the-creator-vpb' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'the-creator-vpb'),
		),
		'non_members' => array(
			'description' => esc_html__( 'Hide Content Only to Non Members', 'the-creator-vpb' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'the-creator-vpb'),
		),
		'desktop' => array(
			'description' => esc_html__( 'Hide on Desktop', 'the-creator-vpb' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'the-creator-vpb'),
		),
		'tablet' => array(
			'description' => esc_html__( 'Hide on Tablet', 'the-creator-vpb' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'the-creator-vpb'),
		),
		'phablet' => array(
			'description' => esc_html__( 'Hide on Phablet', 'the-creator-vpb' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'the-creator-vpb'),
		),
		'phone' => array(
			'description' => esc_html__( 'Hide on Phone', 'the-creator-vpb' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Hide', 'the-creator-vpb'),
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
	)
);
function wbcvpb_imagetext_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('imagetext_wbc'), $attributes));

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

	if($desktop==1){
		$classes[] = 'hidden-desktop';
	}

	if($tablet==1){
		$classes[] = 'hidden-tablet';
	}

	if($phablet==1){
		$classes[] = 'hidden-phablet';
	}

	if($phone==1){
		$classes[] = 'hidden-phone';
	}

	$classes = implode(' ', $classes);

	$id_out = ($id!='') ? 'id='.$id.'' : '';

	if($color!='' || $size!=''){
		$color_output = ($color!='') ? "color:$color;" : '';
		$size_output = ($size!='') ? "line-height:$size;font-size:$size;" : '';
		$text_style_output=' style="'.esc_attr($color_output).esc_attr($size_output).'"';
	}

	if ( ($members==1 && is_user_logged_in() && !is_null( $content ) && !is_feed()) || ($non_members==1 && !is_user_logged_in() && !is_null( $content ) && !is_feed()) ){
		return '';
	}
	else{
		if($image) {
			if($image_position == 'left') {
				return '<div '.esc_attr($id_out).' class="'.esc_attr($classes).'" '.$animation_out.' '.$text_style_output.'><div class="row"><div class="col-lg-6 col-md-6" style="padding:0;"><div class="image" style="background:url('.$image.') center center no-repeat;background-size:cover;"></div></div><div class="col-lg-6 col-md-6 col-content"><div class="box-content">'.do_shortcode($content).'</div></div></div></div>';
			} elseif($image_position == 'right') {
				return '<div '.esc_attr($id_out).' class="'.esc_attr($classes).'" '.$animation_out.' '.$text_style_output.'><div class="row"><div class="col-lg-6 col-md-6 col-content"><div class="box-content">'.do_shortcode($content).'</div></div><div class="col-lg-6 col-md-6" style="padding:0;"><div class="image" style="background:url('.$image.') center center no-repeat;background-size:cover;"></div></div></div></div>';
			} else {
				return '<div '.esc_attr($id_out).' class="'.esc_attr($classes).'" '.$animation_out.' '.$text_style_output.'><div class="box-content">'.do_shortcode($content).'</div> <div class="image" style="background:url('.$image.') center center no-repeat;background-size:cover;"></div></div>';
			}
		} else {
			return '<div '.esc_attr($id_out).' class="'.esc_attr($classes).'" '.$animation_out.' '.$text_style_output.'>'.do_shortcode($content).'</div>';
		}
	}

}

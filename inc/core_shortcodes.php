<?php

// Shortcode: Content Section
$wbcvpb_shortcodes['section_wbc'] = array(
	'name' => __('Section', 'wb-creator-vpb'),
	'hide_in_wbcvpb' => true,
	'nesting' => '1',
	'type' => 'core',
	'child' => 'column_wbc',
	'child_title' => __('Section Column', 'wb-creator-vpb'),
	'child_button' => __('Add Column', 'wb-creator-vpb'),
	'attributes' => array(
		'section_title' => array(
			'description' => __('Section Title', 'wb-creator-vpb'),
		),
		'title_icon' => array(
			'type' => 'icon',
			'description' => __('Title Icon', 'wb-creator-vpb'),
		),
		'section_intro' => array(
			'description' => __('Intro Text', 'wb-creator-vpb'),
		),
		'section_outro' => array(
			'description' => __('Outro Text', 'wb-creator-vpb'),
		),
		'padding' => array(
			'description' => __('Enter values in px', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'type' => 'padding',
		),
		'border_radius' => array(
			'description' => __('Border Radius', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
		),
		'border_style' => array(
			'description' => __('Border Style', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'type' => 'select',
			'default' => '',
			'values' => array(
				'' => esc_html__('No Border', 'wb-creator-vpb'),
				'solid' => esc_html__('Solid', 'wb-creator-vpb'),
				'dotted' => esc_html__('Dotted', 'wb-creator-vpb'),
				'dashed' => esc_html__('Dashed', 'wb-creator-vpb'),
				'double' => esc_html__('Double', 'wb-creator-vpb'),
				'groove' => esc_html__('Groove', 'wb-creator-vpb'),
				'ridge' => esc_html__('Ridge', 'wb-creator-vpb'),
				'inset' => esc_html__('Inset', 'wb-creator-vpb'),
				'outset' => esc_html__('Outset', 'wb-creator-vpb'),
			),
		),
		'border_color' => array(
			'description' => __('Border Color', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'type' => 'color',
		),
		'centered' => array(
			'description' => __('Centered', 'wb-creator-vpb'),
			'type' => 'checkbox',
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'default' => '0',
		),
		'right_aligned' => array(
			'description' => __('Right Aligned', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'type' => 'checkbox',
			'default' => '0',
		),
		'fullwidth' => array(
			'description' => __('Fullwidth Content', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'type' => 'checkbox',
			'default' => '0',
		),
		'no_column_margin' => array(
			'description' => __('No Margin on Columns', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'type' => 'checkbox',
			'default' => '0',
		),
		'pattern_overlay' => array(
			'description' => esc_html__('Pattern Overlay', 'wb-creator-vpb'),
			'default' => '',
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'' => esc_html__('None', 'wb-creator-vpb'),
				'pattern_overlayed' => esc_html__('Solid', 'wb-creator-vpb'),
				'pattern_overlayed_dotted' => esc_html__('Dotted', 'wb-creator-vpb'),
				'pattern_overlayed_dotted_2' => esc_html__('Dotted White', 'wb-creator-vpb'),
				'pattern_overlayed_lined' => esc_html__('Vertical Lines', 'wb-creator-vpb'),
				'pattern_overlayed_lined_h' => esc_html__('Horizontal Lines', 'wb-creator-vpb'),
			),
		),
		'equalize_five' => array(
			'description' => __('5 Columns Equalize', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'type' => 'checkbox',
			'default' => '0',
			'info' => __('Check this if you want 5 columns to be equal width (out of grid, use only 2/12 and 3/12 columns)', 'wb-creator-vpb'),
		),
		'bg_color' => array(
			'description' => __('Background Color', 'wb-creator-vpb'),
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'type' => 'coloralpha',
		),
		'bg_image' => array(
			'type' => 'image',
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'description' => __('Background Image', 'wb-creator-vpb'),
		),
		'bg_image_repeat' => array(
			'type' => 'select',
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'description' => __('Background Image Repeat', 'wb-creator-vpb'),
			'default' => '',
			'values' => array(
				'' => esc_html__('Not defined', 'wb-creator-vpb'),
		        'no-repeat'  => esc_attr__('No Repeat', 'wb-creator-vpb'),
		        'repeat'     => esc_attr__('Tile', 'wb-creator-vpb'),
		        'repeat-x'   => esc_attr__('Tile Horizontally', 'wb-creator-vpb'),
		        'repeat-y'   => esc_attr__('Tile Vertically', 'wb-creator-vpb'),
			),
		),
		'bg_image_size' => array(
			'type' => 'select',
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'description' => __('Background Image Size', 'wb-creator-vpb'),
			'default' => '',
			'values' => array(
				'' => esc_html__('Not defined', 'wb-creator-vpb'),
		        'cover'  => esc_attr__('Cover', 'wb-creator-vpb'),
		        'contain' => esc_attr__('Contain', 'wb-creator-vpb'),
			),
		),
		'bg_image_position' => array(
			'type' => 'select',
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'description' => __('Background Image Position', 'wb-creator-vpb'),
			'default' => '',
			'values' => array(
				'' => esc_html__('Not defined', 'wb-creator-vpb'),
		        'left top'       => esc_attr__( 'Left Top', 'wb-creator-vpb' ),
		        'left center'     => esc_attr__( 'Left Center', 'wb-creator-vpb' ),
		        'left bottom'      => esc_attr__( 'Left Bottom', 'wb-creator-vpb' ),
		        'center top'       => esc_attr__( 'Center Top', 'wb-creator-vpb' ),
		        'center center'     => esc_attr__( 'Center Center', 'wb-creator-vpb' ),
		        'center bottom'      => esc_attr__( 'Center Bottom', 'wb-creator-vpb' ),
		        'right top'       => esc_attr__( 'Right Top', 'wb-creator-vpb' ),
		        'right center'     => esc_attr__( 'Right Center', 'wb-creator-vpb' ),
		        'right bottom'      => esc_attr__( 'Right Bottom', 'wb-creator-vpb' ),
			),
		),
		'parallax' => array(
			'description' => __('Parallax Amount', 'wb-creator-vpb'),
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'info' => __('Amout of parallax effect on background image, 0.1 means 10% of scroll amount, 2 means twice of scroll amount, leave blank for no parallax', 'wb-creator-vpb'),
		),
		'video_bg' => array(
			'description' => __('Video Background', 'wb-creator-vpb'),
			'type' => 'checkbox',
			'default' => '0',
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'info' => __('If checked video background will be enabled. Video files should have same name as Background Image, and same path, only different extensions (mp4,webm,ogv files required). You can use Miro Converter to convert files in required formats.', 'wb-creator-vpb'),
		),
		'inversed_text' => array(
			'description' => __('Inverted Text Color', 'wb-creator-vpb'),
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'type' => 'checkbox',
			'default' => '0',
		),
		'section_id' => array(
			'description' => __('Section ID', 'wb-creator-vpb'),
			'tab' => esc_html__('Advanced', 'wb-creator-vpb'),
			'info' => __('ID can be used for menu navigation, e.g. #about-us', 'wb-creator-vpb'),
		),
		'class' => array(
			'description' => __('Class', 'wb-creator-vpb'),
			'tab' => esc_html__('Advanced', 'wb-creator-vpb'),
			'info' => __('Additional custom classes for custom styling', 'wb-creator-vpb'),
		),
	),
	'content' => array(
		'default' => 'Columns here',
		'description' => __('Content', 'wb-creator-vpb'),
	),
	'description' => __('Section With Columns', 'wb-creator-vpb'),
	'info' => __("Sum of all column's span attributes must be 12", 'wb-creator-vpb' )
);

function wbcvpb_section_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('section_wbc'), $attributes));
	
	$additional_classes[] = 'wbcvpb_section_wbc';
	$additional_classes[] = $class;
	$additional_classes[] = ($centered==1) ? 'wbcvpb-centered' : '';
	$additional_classes[] = ($right_aligned==1) ? 'right_aligned' : '';
	$additional_classes[] = ($inversed_text==1) ? 'wbcvpb-inversed_text' : '';
	$additional_classes[] = ($parallax!='') ? 'wbcvpb-parallax' : '';
	$additional_classes[] = ($video_bg==1) ? 'wbcvpb-video-bg' : '';
	$additional_classes[] = ($fullwidth==1) ? 'section_body_fullwidth' : '';
	$additional_classes[] = ($no_column_margin==1) ? 'section_no_column_margin' : '';
	$additional_classes[] = ($equalize_five==1) ? 'section_equalize_5' : '';
	$additional_classes[] = ($section_title!='' || $section_intro!='') ? 'section_with_header' : '';
	$additional_classes[] = $pattern_overlay;
	$additional_classes = array_filter($additional_classes);
	$classes_out = implode(' ', $additional_classes);

	$bg_image_output = ($bg_image!='')?' data-background_image="'.$bg_image.'"' : '';
	$parallax_output = ($parallax!='')?' data-parallax="'.$parallax.'"' : '';

	$style_out = $padding;
	$style_out .= ($bg_color!='') ? 'background-color:'.$bg_color.';' : '';
	$style_out .= ($bg_image!='') ? 'background-image:url('.$bg_image.');' : '';
	$style_out .= ($border_radius!='') ? 'border-radius:'.$border_radius.';' : '';
	$style_out .= ($border_style!='') ? 'border-style:'.$border_style.';' : '';
	$style_out .= ($border_color!='') ? 'border-color:'.$border_color.';' : '';
	$style_out .= ($bg_image_repeat!='') ? 'background-repeat:'.$bg_image_repeat.';' : '';
	$style_out .= ($bg_image_size!='') ? 'background-size:'.$bg_image_size.';' : '';
	$style_out .= ($bg_image_position!='') ? 'background-position:'.$bg_image_position.';' : '';

	$title_icon_out = ($title_icon!='') ? '<div class="wbcvpb_section_header_icon"><i class="'.$title_icon.'"></i></div>' : '';
	$section_title = ($section_title!='') ? '<h3 class="section-title">'.$section_title.'</h3>' : '';
	$section_id = ($section_id!='') ? ' id="'.esc_attr($section_id).'"' : '';
	$section_intro = ($section_intro!='') ? '<p>'.$section_intro.'</p>' : '';
	$section_header = ($section_title!='' || $section_intro!='') ? '<header><div class="wbcvpb_container">'.$section_title.$title_icon_out.$section_intro.'</div></header>' : '';
	$section_footer = ($section_outro!='') ? '<footer><div class="wbcvpb_container">'.$section_outro.'</div></footer>' : '';

	$video_pi = pathinfo($bg_image);
	$video_no_ext_path = dirname($bg_image).'/'.$video_pi['filename'];
	$video_out=($video_bg==1) ? '
		<video style="position:absolute;top:0;left:0;min-height:100%;min-width:100%;z-index:0;" poster="'.$bg_image.'" loop="1" autoplay="1" preload="metadata" controls="controls">
			<source type="video/mp4" src="'.esc_url($video_no_ext_path).'.mp4" />
			<source type="video/webm" src="'.esc_url($video_no_ext_path).'.webm" />
			<source type="video/ogg" src="'.esc_url($video_no_ext_path).'.ogv" />
		</video>
	' : '';


	return '<section'.$section_id.' class="'.$classes_out.'"' . $bg_image_output . $parallax_output . (($style_out!='') ? ' style="'.$style_out.'"' : '') . '>
		'.$section_header.'
		<div class="wbcvpb_section_content"><div class="wbcvpb_container "><div class="row">'.do_shortcode($content).'</div></div></div>
		'.$section_footer.'
		'.$video_out.'
	</section>';
}



// Shortcode: Content Column
$wbcvpb_shortcodes['column_wbc'] = array(
	'name' => __('Column', 'wb-creator-vpb'),
	'nesting' => '1',
	'type' => 'core',
	'hidden' => '1',
	'hide_in_wbcvpb' => true,
	'attributes' => array(
		'span' => array(
			'default' => '1',
			'description' => __('Span 1-12 Columns', 'wb-creator-vpb'),
		),
		'centered' => array(
			'description' => __('Centered', 'wb-creator-vpb'),
			'type' => 'checkbox',
			'default' => '0',
		),
		'right_aligned' => array(
			'description' => __('Right Aligned', 'wb-creator-vpb'),
			'type' => 'checkbox',
			'default' => '0',
		),
		'padding' => array(
			'description' => __('Enter values in px', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'type' => 'padding',
		),
		'border_radius' => array(
			'description' => __('Border Radius', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
		),
		'border_style' => array(
			'description' => __('Border Style', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'type' => 'select',
			'default' => '',
			'values' => array(
				'' => esc_html__('No Border', 'wb-creator-vpb'),
				'solid' => esc_html__('Solid', 'wb-creator-vpb'),
				'dotted' => esc_html__('Dotted', 'wb-creator-vpb'),
				'dashed' => esc_html__('Dashed', 'wb-creator-vpb'),
				'double' => esc_html__('Double', 'wb-creator-vpb'),
				'groove' => esc_html__('Groove', 'wb-creator-vpb'),
				'ridge' => esc_html__('Ridge', 'wb-creator-vpb'),
				'inset' => esc_html__('Inset', 'wb-creator-vpb'),
				'outset' => esc_html__('Outset', 'wb-creator-vpb'),
			),
		),
		'border_color' => array(
			'description' => __('Border Color', 'wb-creator-vpb'),
			'tab' => esc_html__('Customize', 'wb-creator-vpb'),
			'type' => 'color',
		),
		'bg_color' => array(
			'description' => __('Background Color', 'wb-creator-vpb'),
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'type' => 'coloralpha',
		),
		'bg_image' => array(
			'type' => 'image',
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'description' => __('Background Image', 'wb-creator-vpb'),
		),
		'bg_image_repeat' => array(
			'type' => 'select',
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'description' => __('Background Image Repeat', 'wb-creator-vpb'),
			'default' => '',
			'values' => array(
				'' => esc_html__('Not defined', 'wb-creator-vpb'),
		        'no-repeat'  => esc_attr__('No Repeat', 'wb-creator-vpb'),
		        'repeat'     => esc_attr__('Tile', 'wb-creator-vpb'),
		        'repeat-x'   => esc_attr__('Tile Horizontally', 'wb-creator-vpb'),
		        'repeat-y'   => esc_attr__('Tile Vertically', 'wb-creator-vpb'),
			),
		),
		'bg_image_size' => array(
			'type' => 'select',
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'description' => __('Background Image Size', 'wb-creator-vpb'),
			'default' => '',
			'values' => array(
				'' => esc_html__('Not defined', 'wb-creator-vpb'),
		        'cover'  => esc_attr__('Cover', 'wb-creator-vpb'),
		        'contain' => esc_attr__('Contain', 'wb-creator-vpb'),
			),
		),
		'bg_image_position' => array(
			'type' => 'select',
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'description' => __('Background Image Position', 'wb-creator-vpb'),
			'default' => '',
			'values' => array(
				'' => esc_html__('Not defined', 'wb-creator-vpb'),
		        'left top'       => esc_attr__( 'Left Top', 'wb-creator-vpb' ),
		        'left center'     => esc_attr__( 'Left Center', 'wb-creator-vpb' ),
		        'left bottom'      => esc_attr__( 'Left Bottom', 'wb-creator-vpb' ),
		        'center top'       => esc_attr__( 'Center Top', 'wb-creator-vpb' ),
		        'center center'     => esc_attr__( 'Center Center', 'wb-creator-vpb' ),
		        'center bottom'      => esc_attr__( 'Center Bottom', 'wb-creator-vpb' ),
		        'right top'       => esc_attr__( 'Right Top', 'wb-creator-vpb' ),
		        'right center'     => esc_attr__( 'Right Center', 'wb-creator-vpb' ),
		        'right bottom'      => esc_attr__( 'Right Bottom', 'wb-creator-vpb' ),
			),
		),
		'inversed_text' => array(
			'description' => __('Inverted Text Color', 'wb-creator-vpb'),
			'tab' => esc_html__('Background', 'wb-creator-vpb'),
			'type' => 'checkbox',
			'default' => '0',
		),
		'animation' => array(
			'default' => '',
			'description' => __('Entrance Animation', 'wb-creator-vpb'),
			'type' => 'select',
			'tab' => __('Animation', 'wb-creator-vpb'),
			'values' => array(
				'' => __('None', 'wb-creator-vpb'),
				'flip' => __('Flip', 'wb-creator-vpb'),
				'flipInX' => __('Flip In X', 'wb-creator-vpb'),
				'flipInY' => __('Flip In Y', 'wb-creator-vpb'),
				'fadeIn' => __('Fade In', 'wb-creator-vpb'),
				'fadeInUp' => __('Fade In Up', 'wb-creator-vpb'),
				'fadeInDown' => __('Fade In Down', 'wb-creator-vpb'),
				'fadeInLeft' => __('Fade In Left', 'wb-creator-vpb'),
				'fadeInRight' => __('Fade In Right', 'wb-creator-vpb'),
				'fadeInUpBig' => __('Fade In Up Big', 'wb-creator-vpb'),
				'fadeInDownBig' => __('Fade In Down Big', 'wb-creator-vpb'),
				'fadeInLeftBig' => __('Fade In Left Big', 'wb-creator-vpb'),
				'fadeInRightBig' => __('Fade In Right Big', 'wb-creator-vpb'),
				'slideInLeft' => __('Slide In Left', 'wb-creator-vpb'),
				'slideInRight' => __('Slide In Right', 'wb-creator-vpb'),
				'bounceIn' => __('Bounce In', 'wb-creator-vpb'),
				'bounceInDown' => __('Bounce In Down', 'wb-creator-vpb'),
				'bounceInUp' => __('Bounce In Up', 'wb-creator-vpb'),
				'bounceInLeft' => __('Bounce In Left', 'wb-creator-vpb'),
				'bounceInRight' => __('Bounce In Right', 'wb-creator-vpb'),
				'rotateIn' => __('Rotate In', 'wb-creator-vpb'),
				'rotateInDownLeft' => __('Rotate In Down Left', 'wb-creator-vpb'),
				'rotateInDownRight' => __('Rotate In Down Right', 'wb-creator-vpb'),
				'rotateInUpLeft' => __('Rotate In Up Left', 'wb-creator-vpb'),
				'rotateInUpRight' => __('Rotate In Up Right', 'wb-creator-vpb'),
				'lightSpeedIn' => __('Light Speed In', 'wb-creator-vpb'),
				'rollIn' => __('Roll In', 'wb-creator-vpb'),
				'flash' => __('Flash', 'wb-creator-vpb'),
				'bounce' => __('Bounce', 'wb-creator-vpb'),
				'shake' => __('Shake', 'wb-creator-vpb'),
				'tada' => __('Tada', 'wb-creator-vpb'),
				'swing' => __('Swing', 'wb-creator-vpb'),
				'wobble' => __('Wobble', 'wb-creator-vpb'),
				'pulse' => __('Pulse', 'wb-creator-vpb'),
			),
		),
		'timing' => array(
			'default' => 'linear',
			'description' => esc_html__('Timing Function', 'wb-creator-vpb'),
			'type' => 'select',
			'tab' => __('Animation', 'wb-creator-vpb'),
			'values' => array(
				'linear' => esc_html__('Linear', 'wb-creator-vpb'),
				'ease' => esc_html__('Ease', 'wb-creator-vpb'),
				'ease-in' => esc_html__('Ease-in', 'wb-creator-vpb'),
				'ease-out' => esc_html__('Ease-out', 'wb-creator-vpb'),
				'ease-in-out' => esc_html__('Ease-in-out', 'wb-creator-vpb'),
			),
		),
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'wb-creator-vpb'),
			'info' => esc_html__('Amount of pixels from bottom to start animation', 'wb-creator-vpb'),
			'default' => '0',
			'tab' => __('Animation', 'wb-creator-vpb'),
		),		
		'duration' => array(
			'description' => esc_html__('Animation Duration (in ms)', 'wb-creator-vpb'),
			'default' => '1000',
			'tab' => __('Animation', 'wb-creator-vpb'),
		),		
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'wb-creator-vpb'),
			'default' => '0',
			'tab' => __('Animation', 'wb-creator-vpb'),
		),
		'class' => array(
			'tab' => __('Advanced', 'wb-creator-vpb'),
			'description' => __('Class', 'wb-creator-vpb'),
			'info' => __('Additional custom classes for custom styling', 'wb-creator-vpb'),
		),
		'id' => array(
			'tab' => __('Advanced', 'wb-creator-vpb'),
			'description' => __('ID', 'wb-creator-vpb'),
			'info' => __('Additional custom ID', 'wb-creator-vpb'),
		),
	),
	'content' => array(
		'description' => __('Column Content', 'wb-creator-vpb'),
	),
	'description' => __('Column', 'wb-creator-vpb' )
);

function wbcvpb_column_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('column_wbc'), $attributes));

	$id_out = ($id!='') ? ' id="'.$id.'"' : '';

	$additional_classes[] = 'cols-'.$span.' col-lg-'.$span.' col-md-'.$span.' col-sm-'.$span;
	$additional_classes[] = $class;
	$additional_classes[] = ($centered==1) ? 'wbcvpb-centered' : '';
	$additional_classes[] = ($right_aligned==1) ? 'right_aligned' : '';
	$additional_classes[] = ($inversed_text==1) ? 'wbcvpb-inversed_text' : '';
	$parametars_out='';
	if($animation!=''){
		$additional_classes[] = 'wbcvpb-animo';
		$parametars_out = ' data-animation="'.esc_attr($animation).'" data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}
	$additional_classes = array_filter($additional_classes);
	$classes_out = implode(' ', $additional_classes);

	$style_out = $padding;
	$style_out .= ($bg_color!='') ? 'background-color:'.$bg_color.';' : '';
	$style_out .= ($bg_image!='') ? 'background-image:url('.$bg_image.');' : '';
	$style_out .= ($border_radius!='') ? 'border-radius:'.$border_radius.';' : '';
	$style_out .= ($border_style!='') ? 'border-style:'.$border_style.';' : '';
	$style_out .= ($border_color!='') ? 'border-color:'.$border_color.';' : '';
	$style_out .= ($bg_image_repeat!='') ? 'background-repeat:'.$bg_image_repeat.';' : '';
	$style_out .= ($bg_image_size!='') ? 'background-size:'.$bg_image_size.';' : '';
	$style_out .= ($bg_image_position!='') ? 'background-position:'.$bg_image_position.';' : '';

    return '<div'.$id_out.' class="'.$classes_out.'"'.(($style_out!='') ? ' style="'.$style_out.'"' : '').$parametars_out.'>'.do_shortcode($content).'</div>';
}

// Shortcode: Line break
$wbcvpb_shortcodes['br_wbc'] = array(
	'name' => __('BR', 'wb-creator-vpb'),
	'type' => 'core',
	'hidden' => '1',
	'hide_in_wbcvpb' => true,
	'description' => __('BR', 'wb-creator-vpb' )
);

function wbcvpb_br_wbc_shortcode() {
    return '<br>';
}

// Shortcode: Non braking space
$wbcvpb_shortcodes['nbsp_wbc'] = array(
	'name' => __('Non braking space', 'wb-creator-vpb'),
	'type' => 'core',
	'hidden' => '1',
	'hide_in_wbcvpb' => true,
	'description' => __('Non braking space', 'wb-creator-vpb' )
);

function wbcvpb_nbsp_wbc_shortcode() {
    return '&nbsp;';
}


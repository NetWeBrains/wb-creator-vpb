<?php

/*********** Shortcode: Nivo Slider ************************************************************/

$wbcvpb_shortcodes['nivo_wbc'] = array(
	'name' => esc_html__('Nivo Slider', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-slider',
	'category' =>  esc_html__('Media', 'the-creator-vpb'),
	'child' => 'nivo_single_wbc',
	'child_button' => esc_html__('New Image', 'the-creator-vpb'),
	'child_title' => esc_html__('Image', 'the-creator-vpb'),
	'attributes' => array(
		'dummy' => array(
			'type' => 'hidden',
		),
		'randomstart' => array(
			'description' 	=> esc_html__('Start on a random slide', 'the-creator-vpb'),
			'default' => 'false',
			'type' => 'select',
			'values' => array(
				'true' => esc_html__( 'Yes', 'the-creator-vpb'),
				'false' => esc_html__( 'No', 'the-creator-vpb'),
			),
			'divider' => 'true',
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'manualadvance' => array(
			'description' 	=> esc_html__('Autoplay', 'the-creator-vpb'),
			'info' 			=> esc_html__('Check if you want the carousel to autoplay', 'the-creator-vpb'),
			'default' => 'false',
			'type' => 'select',
			'values' => array(
				'true' => esc_html__( 'No', 'the-creator-vpb'),
				'false' => esc_html__( 'Yes', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'autoplay_effect' => array(
			'description' 	=> esc_html__('Effect', 'the-creator-vpb'),
			'default' => 'fade',
			'type' => 'select',
			'values' => array(
				'sliceDown' => esc_html__( 'Slice Down', 'the-creator-vpb'),
				'sliceDownLeft' => esc_html__( 'Slice Down Left', 'the-creator-vpb'),
				'sliceUp' => esc_html__( 'Slice Up', 'the-creator-vpb'),
				'sliceUpLeft' => esc_html__( 'Slice Up Left', 'the-creator-vpb'),
				'sliceUpDown' => esc_html__( 'Slice Up Down', 'the-creator-vpb'),
				'sliceUpDownLeft' => esc_html__( 'Slice Up Down Left', 'the-creator-vpb'),
				'fold' => esc_html__( 'Fold', 'the-creator-vpb'),
				'fade' => esc_html__( 'Fade', 'the-creator-vpb'),
				'random' => esc_html__( 'Random', 'the-creator-vpb'),
				'slideInRight' => esc_html__( 'Slide in Right', 'the-creator-vpb'),
				'slideInLeft' => esc_html__( 'Slide in Left', 'the-creator-vpb'),
				'boxRandom' => esc_html__( 'Box Random', 'the-creator-vpb'),
				'boxRain' => esc_html__( 'Box Rain', 'the-creator-vpb'),
				'boxRainReverse' => esc_html__( 'Box Rain Reverse', 'the-creator-vpb'),
				'boxRainGrow' => esc_html__( 'Box Rain Grow', 'the-creator-vpb'),
				'boxRainGrowReverse' => esc_html__( 'Box Rain Grow Reverse', 'the-creator-vpb'),
			),
			'divider' => 'true',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'slices' => array(
			'description'	=> esc_html__('Slices', 'the-creator-vpb'),
			'info' 			=> esc_html__('For slice animations', 'the-creator-vpb'),
			'default' => '15',
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'boxcols' => array(
			'description'	=> esc_html__('Box Cols', 'the-creator-vpb'),
			'info' 			=> esc_html__('For box animations', 'the-creator-vpb'),
			'default' => '8',
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'boxrows' => array(
			'description'	=> esc_html__('Box Rows', 'the-creator-vpb'),
			'info' 			=> esc_html__('For box animations', 'the-creator-vpb'),
			'default' => '4',
			'divider' => 'true',
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'animation' => array(
			'description'	=> esc_html__('Slide transition speed', 'the-creator-vpb'),
			'info' 			=> esc_html__('Duration in ms. Default: 800 ms', 'the-creator-vpb'),
			'default' => '800',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'duration' => array(
			'description'	=> esc_html__('Duration of the slide', 'the-creator-vpb'),
			'info' 			=> esc_html__('Duration in ms. Default: 3000 ms', 'the-creator-vpb'),
			'default' => '3000',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'startslide' => array(
			'description'	=> esc_html__('Set starting Slide (0 is default', 'the-creator-vpb'),
			'default' => '0',
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'directionnav' => array(
			'description' 	=> esc_html__('Next & Prev navigation', 'the-creator-vpb'),
			'default' => 'false',
			'type' => 'select',
			'values' => array(
				'true' => esc_html__( 'Yes', 'the-creator-vpb'),
				'false' => esc_html__( 'No', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Navigation', 'the-creator-vpb'),
		),
		'prevtext' => array(
			'description' 	=> esc_html__('Previous Text', 'the-creator-vpb'),
			'default' => 'Prev',
			'tab' => esc_html__('Navigation', 'the-creator-vpb'),
		),
		'nexttext' => array(
			'description' 	=> esc_html__('Next Text', 'the-creator-vpb'),
			'default' => 'Next',
			'tab' => esc_html__('Navigation', 'the-creator-vpb'),
		),
		'controlnav' => array(
			'description' 	=> esc_html__('1,2,3... navigation', 'the-creator-vpb'),
			'default' => 'false',
			'type' => 'select',
			'values' => array(
				'true' => esc_html__( 'Yes', 'the-creator-vpb'),
				'false' => esc_html__( 'No', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Navigation', 'the-creator-vpb'),
		),
		'controlnavthumbs' => array(
			'description' 	=> esc_html__('Use thumbnails for Control Nav', 'the-creator-vpb'),
			'default' => 'false',
			'type' => 'select',
			'values' => array(
				'true' => esc_html__( 'Yes', 'the-creator-vpb'),
				'false' => esc_html__( 'No', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Navigation', 'the-creator-vpb'),
		),
		'pauseonhover' => array(
			'description' 	=> esc_html__('Stop animation while hovering', 'the-creator-vpb'),
			'default' => 'true',
			'type' => 'select',
			'values' => array(
				'true' => esc_html__( 'Yes', 'the-creator-vpb'),
				'false' => esc_html__( 'No', 'the-creator-vpb'),
			),
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
);


function wbcvpb_nivo_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('nivo_wbc'), $attributes));

	$classes[] = 'wbcvpb-nivo-slider';
	$classes[] = $class;
	$classes_out = implode(' ', $classes);

	$data_out = '';
	$data_out.= ($autoplay_effect!='') ? ' data-autoplay_effect="'.$autoplay_effect.'"' : '';
	$data_out.= ($slices!='') ? ' data-slices="'.$slices.'"' : '';
	$data_out.= ($boxcols!='') ? ' data-boxcols="'.$boxcols.'"' : '';
	$data_out.= ($boxrows!='') ? ' data-boxrows="'.$boxrows.'"' : '';
	$data_out.= ($animation!='') ? ' data-animation="'.$animation.'"' : '';
	$data_out.= ($duration!='') ? ' data-duration="'.$duration.'"' : '';
	$data_out.= ($startslide!='') ? ' data-startslide="'.$startslide.'"' : '';
	$data_out.= ($directionnav!='') ? ' data-directionnav="'.$directionnav.'"' : '';
	$data_out.= ($controlnav!='') ? ' data-controlnav="'.$controlnav.'"' : '';
	$data_out.= ($controlnavthumbs!='') ? ' data-controlnavthumbs="'.$controlnavthumbs.'"' : '';
	$data_out.= ($pauseonhover!='') ? ' data-pauseonhover="'.$pauseonhover.'"' : '';
	$data_out.= ($manualadvance!='') ? ' data-manualadvance="'.$manualadvance.'"' : '';
	$data_out.= ($prevtext!='') ? ' data-prevtext="'.$prevtext.'"' : '';
	$data_out.= ($nexttext!='') ? ' data-nexttext="'.$nexttext.'"' : '';
	$data_out.= ($randomstart!='') ? ' data-randomstart="'.$randomstart.'"' : '';

	return '<div'. (($id!='')?' id="'.$id.'"':'') .' class="'.$classes_out.'"'.$data_out.'>'.  do_shortcode($content)  . '</div>';
}

$wbcvpb_shortcodes['nivo_single_wbc'] = array(
	'name' => esc_html__('Nivo Single Slide', 'the-creator-vpb' ),
	'hidden' => true,
	'attributes' => array(
		'url' => array(
			'type' => 'image',
			'description' => esc_html__('Select Image', 'the-creator-vpb'),
		),
		'link' => array(
			'description' => esc_html__('Link', 'the-creator-vpb'),
			'default' => '',
		),
		'alt' => array(
			'description' => esc_html__('Image Alt Text', 'the-creator-vpb'),
		),
		'caption' => array(
			'description' => esc_html__('Image Caption Text', 'the-creator-vpb'),
		),
	),
	'description' => esc_html__('Single image section', 'the-creator-vpb' )
);
function wbcvpb_nivo_single_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('nivo_single_wbc'), $attributes));
	static $image_no;
	$image_no++;

	$display_image_out = ($image_no != 1) ? 'style="display:none;"' : '';

	$out = ( ($link!='')?'<a href="'.esc_url($link).'">':'').'<img src="'.esc_url($url).'" alt="'.esc_attr($alt).'" '.$display_image_out.'>'.(($link!='')?'</a>':'');

	$return = ' '.$out.'';	
	
	return $return;
}
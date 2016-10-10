<?php

/*********** Shortcode: Image Carousel ************************************************************/

$wbcvpb_shortcodes['carousels_wbc'] = array(
	'name' => esc_html__('Image Carousel', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-image-carousel',
	'category' => esc_html__('Media', 'the-creator-vpb' ),
	'child' => 'carousel_wbc',
	'child_button' => esc_html__('New Image', 'the-creator-vpb'),
	'child_title' => esc_html__('Image', 'the-creator-vpb'),
	'attributes' => array(
		'dummy' => array(
			'type' => 'hidden',
		),
		'number' => array(
			'description'	=> esc_html__('Number of items to scroll', 'the-creator-vpb'),
			'default' => '6',
			'info' 			=> esc_html__('The best result is obtained if you choose the number of images that fit the full width of the container. Default is 6', 'the-creator-vpb'),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'autoplay' => array(
			'description' 	=> esc_html__('Autoplay', 'the-creator-vpb'),
			'info' 			=> esc_html__('Check if you want the carousel to autoplay', 'the-creator-vpb'),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'autoplay_effect' => array(
			'description' 	=> esc_html__('Autoplay Effect', 'the-creator-vpb'),
			'default' => 'scroll',
			'type' => 'select',
			'values' => array(
				'scroll' =>  esc_html__( 'Scroll', 'the-creator-vpb' ),
				'directscroll' =>  esc_html__( 'Directscroll', 'the-creator-vpb' ),
				'fade' =>  esc_html__( 'Fade', 'the-creator-vpb' ),
				'crossfade' =>  esc_html__( 'Crossfade', 'the-creator-vpb' ),
				'cover' =>  esc_html__( 'Cover', 'the-creator-vpb' ),
				'cover-fade' =>  esc_html__( 'Cover-fade', 'the-creator-vpb' ),
				'uncover' =>  esc_html__( 'Uncover', 'the-creator-vpb' ),
				'uncover-fade' =>  esc_html__( 'Uncover-fade', 'the-creator-vpb' ),
				'none' =>  esc_html__( 'None', 'the-creator-vpb' ),
			),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'easing' => array(
			'description' 	=> esc_html__('Easing', 'the-creator-vpb'),
			'default' => 'linear',
			'type' => 'select',
			'values' => array(
				'linear' =>  esc_html__( 'Linear', 'the-creator-vpb' ),
				'swing' =>  esc_html__( 'Swing', 'the-creator-vpb' ),
				'quadratic' =>  esc_html__( 'Quadratic', 'the-creator-vpb' ),
				'cubic' =>  esc_html__( 'Cubic', 'the-creator-vpb' ),
				'elastic' =>  esc_html__( 'Elastic', 'the-creator-vpb' ),
			),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'duration' => array(
			'description'	=> esc_html__('Duration', 'the-creator-vpb'),
			'info' 			=> esc_html__('Duration in ms. Default: 800 ms', 'the-creator-vpb'),
			'default' => '800',
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'navigation' => array(
			'description' 	=> esc_html__('Show Navigation', 'the-creator-vpb'),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Navigation', 'the-creator-vpb'),
		),
		'navigation_icon_left' => array(
			'description' 	=> esc_html__('Navigation Icon Left', 'the-creator-vpb'),
			'type' => 'icon',
			'tab' => esc_html__('Navigation', 'the-creator-vpb'),
		),
		'navigation_icon_right' => array(
			'description' 	=> esc_html__('Navigation Icon Right', 'the-creator-vpb'),
			'type' => 'icon',
			'tab' => esc_html__('Navigation', 'the-creator-vpb'),
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


function wbcvpb_carousels_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('carousels_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$classes[] = 'wbcvpb-carousel';
	$classes[] = $class;
	$classes_out = implode(' ', $classes);

	$nav = '';
	if($navigation == 1){
		$nav = '<div class="carousel_navigation"><a href="#" class="carousel_prev"><i class="'.esc_attr($navigation_icon_left).'"></i></a><a href="#" class="carousel_next"><i class="'.esc_attr($navigation_icon_right).'"></i></a></div>';
	} 

	return '<div '.esc_attr($id_out).' class="'.$classes_out.'" data-autoplay="'.esc_attr($autoplay).'" data-items="'.esc_attr($number).'" data-effect="'.esc_attr($autoplay_effect).'" data-easing="'.esc_attr($easing).'" data-duration="'.esc_attr($duration).'"><ul class="clearfix">'.  do_shortcode($content)  . '</ul>'.$nav.'</div>';
}

$wbcvpb_shortcodes['carousel_wbc'] = array(
	'name' => esc_html__('Single image section', 'the-creator-vpb' ),
	'hidden' => '1',
	'type' => 'child',
	'icon' => 'pi-customize',
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
			'description' => esc_html__('Image alt text', 'the-creator-vpb'),
		),
	),
);
function wbcvpb_carousel_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('carousel_wbc'), $attributes));

	$out = '<li>'.( ($link!='')?'<a href="'.esc_url($link).'">':'').'<img src="'.esc_url($url).'" alt="'.esc_attr($alt).'">'.(($link!='')?'</a>':'').'</li>';

	$return = ''.$out.'';			
  
	return $return;
}



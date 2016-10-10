<?php

/*********** Shortcode: Image Gallery ************************************************************/

$wbcvpb_shortcodes['image_gallery_wbc'] = array(
	'name' => esc_html__('Image Gallery', 'the-creator-vpb' ),
	'description' => esc_html__('Image', 'the-creator-vpb' ),
	'type' =>  'block',
	'icon' => 'pi-image-gallery',
	'category' =>  esc_html__('Media', 'the-creator-vpb'),
	'attributes' => array(
		'url' => array(
			'type' => 'gallery',
			'description' => esc_html__('Select Images', 'the-creator-vpb'),
		),
		'columns' => array(
			'description' => esc_html__('Number of columns', 'the-creator-vpb'),
			'default' => 'four_columns',
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
			'divider' => 'true',
		),
		'lightbox' => array(
			'description' => esc_html__( 'Lightbox', 'the-creator-vpb' ),
			'type' => 'checkbox',
		),
		'lightbox_icon' => array(
			'description' => esc_html__( 'Lightbox Icon', 'the-creator-vpb' ),
			'info' => esc_html__('Lightbox Icon that will be shown on hover', 'the-creator-vpb'),
			'type' => 'icon',
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
function wbcvpb_image_gallery_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('image_gallery_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$lightbox_icon = ($lightbox_icon!='') ? '<i class="'.esc_attr($lightbox_icon).'"></i>' : '';

	$lightbox_out = ( $lightbox != 0 ) ? 'lightbox' : '';
	$lightbox_overlay = '';
	if($lightbox != 0){
    	$lightbox_overlay = '<canvas class="grey-effect"></canvas>'.$lightbox_icon.'';
    }
              
	$return = '<div '.esc_attr($id_out).' class="wbcvpb-image-gallery '.esc_attr($columns).''.esc_attr($class).'">';

		$attachments = explode(",", $url);
        foreach ( $attachments as $attachment ) {
        	$images = wp_get_attachment_url($attachment);
           	$return .= '
           		<div class="wbcvpb-gallery">
       				<a href="'.esc_url($images).'" class="'.esc_attr($lightbox_out).'" data-lightbox="image-gallery">
						<img src="'.esc_url($images).'">
						'.$lightbox_overlay.'
					</a>
				</div>';
		}

	$return .= '</div>';
	return $return;
}
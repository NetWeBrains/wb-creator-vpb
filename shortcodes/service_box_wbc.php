<?php

/*********** Shortcode: Service box ************************************************************/

$wbcvpb_shortcodes['service_box_wbc'] = array(
	'name' => esc_html__('Service box', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-service-box',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Title', 'the-creator-vpb'),
		),
		'type' => array(
			'description' => esc_html__('Type', 'the-creator-vpb'),
			'default' => 'round',
			'type' => 'select',
			'values' => array(
				'round_text_aside' => esc_html__('Round Text Aside', 'the-creator-vpb'),
				'round_text_aside_middle' => esc_html__('Round Text Aside Middle', 'the-creator-vpb'),
				'boxed' =>  esc_html__('Boxed', 'the-creator-vpb'),
				'unboxed_round' => esc_html__('Unboxed Round', 'the-creator-vpb'),
				'unboxed_square' => esc_html__('Unboxed Square', 'the-creator-vpb'),
				'boxed_inside' => esc_html__('Boxed Icon Inside', 'the-creator-vpb'),
			),
		),
		'link' => array(
			'description' => esc_html__('Link', 'the-creator-vpb'),
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
		'box_color' => array(
			'description' => esc_html__('Box Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'tab' => esc_html__('Box Style', 'the-creator-vpb'),
		),
		'box_border' => array(
			'description' => esc_html__( 'Box Border', 'the-creator-vpb' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Box Style', 'the-creator-vpb'),
		),
		'box_border_color' => array(
			'description' => esc_html__('Box Border Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'tab' => esc_html__('Box Style', 'the-creator-vpb'),
		),
		'box_border_width' => array(
			'description' => esc_html__('Box Border Width (px)', 'the-creator-vpb'),
			'type' => 'string',
			'default' => '1',
			'tab' => esc_html__('Box Style', 'the-creator-vpb'),
		),
		'box_border_radius' => array(
			'description' => esc_html__('Box Border Radius (px)', 'the-creator-vpb'),
			'type' => 'string',
			'default' => '5',
			'tab' => esc_html__('Box Style', 'the-creator-vpb'),
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'the-creator-vpb'),
			'type' => 'icon',
			'tab' => esc_html__('Icon', 'the-creator-vpb'),
		),
		'icon_color' => array(
			'description' => esc_html__('Icon Color', 'the-creator-vpb'),
			'type' => 'color',
			'tab' => esc_html__('Icon', 'the-creator-vpb'),
		),
		'icon_background_color_start' => array(
			'description' => esc_html__('Icon Background Color Start', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'info' => esc_html__('Pick a color for icon background. If you pick end color, you\'ll have a gradient background', 'the-creator-vpb'),
			'tab' => esc_html__('Icon', 'the-creator-vpb'),
		),
		'icon_background_color_end' => array(
			'description' => esc_html__('Icon Background Color End', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'tab' => esc_html__('Icon', 'the-creator-vpb'),
		),
		'gradient_direction' => array(
			'description' => esc_html__('Icon Background Gradient Direction', 'the-creator-vpb'),
			'default' => 'to top',
			'type' => 'select',
			'values' => array(
				'to top' => esc_html__('To top', 'the-creator-vpb'),
				'to bottom' => esc_html__('To bottom', 'the-creator-vpb'),
				'to left' =>  esc_html__('To left', 'the-creator-vpb'),
				'to right' => esc_html__('To right', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Icon', 'the-creator-vpb'),
		),
		'icon_border' => array(
			'description' => esc_html__( 'Icon Border', 'the-creator-vpb' ),
			'default' => '0',
			'type' => 'checkbox',
			'tab' => esc_html__('Icon', 'the-creator-vpb'),
		),
		'icon_border_color' => array(
			'description' => esc_html__('Icon Border Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'tab' => esc_html__('Icon', 'the-creator-vpb'),
		),
		'border_width' => array(
			'description' => esc_html__('Icon Border Width (px)', 'the-creator-vpb'),
			'type' => 'string',
			'default' => '1',	
			'tab' => esc_html__('Icon', 'the-creator-vpb'),
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
function wbcvpb_service_box_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('service_box_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$class = ' wbcvpb_service_box_'.$type . ' ' . $class;
	$icon_border = ($icon_border) ? 'border: '.$border_width.'px solid '.$icon_border_color.' ;' : '';
	$icon_color = ($icon_color!='') ? 'color: '.$icon_color.';' : '';
	$box_color = ($box_color!='') ? 'background:'.$box_color.';' : '';
	$border = ($box_border) ? 'border: '.$box_border_width.'px solid '.$box_border_color.'; border-radius:'.$box_border_radius.'px;' : '';

	$icon_bg_out = ($icon_background_color_start!='') ? 'background:' .$icon_background_color_start.'; ' : '';

	if($icon_background_color_start!='' && $icon_background_color_end!=''){
		$icon_bg_out = 'background:linear-gradient('.$gradient_direction.',' .$icon_background_color_start.',' .$icon_background_color_end.');';
	}
	else if($icon_background_color_start!='' || $icon_background_color_end!=''){
		$icon_bg_out = 'background:' .(($icon_background_color_start!='') ? $icon_background_color_start : $icon_background_color_end).'; ';
	}
	
	$return = '
		<div '.esc_attr($id_out).' class="wbcvpb_service_box '.esc_attr($class).'" style="'.esc_attr($box_color).' '.esc_attr($border).'">
			<div class="wbcvpb_service_box_header">';

			$title_out = ($title !='') ? '<h3>'.esc_html($title).'</h3>' :'';

			$return .= ($link!='') ? '<a href="'.esc_url($link).'" target="'.esc_attr($target).'" class="wbcvpb_icon_boxed scroll " style="'.esc_attr($icon_bg_out.$icon_border).'"><i class="'.esc_attr($icon).'" style="'.esc_attr($icon_color).'background:transparent;"></i></a>' : '<div class="wbcvpb_icon_boxed" style="'.esc_attr($icon_bg_out.$icon_border).'"><i class="'.esc_attr($icon).'" style="'.esc_attr($icon_color).'background:transparent;"></i></div>';
			$return .= ($link!='') ? '<a href="'.esc_url($link).'" target="'.esc_attr($target).'" class="scroll">'.$title_out.'</a>' : $title_out;
			$return .= '</div>';
			$return .= ($content != '') ?''.do_shortcode($content).'' : '';
			$return .= '</div>';

	if($type == 'boxed_inside') {
		$return = '<div '.esc_attr($id_out).' class="wbcvpb_service_box '.esc_attr($class).'">
						<div class="wbcvpb_service_box_header" style="'.esc_attr($box_color).' '.esc_attr($border).'">';
			
						$title_out = ($title !='') ? '<h3>'.$title.'</h3>' :'';
			
						$return .= ($link!='') ? '<a href="'.esc_url($link).'" target="'.esc_attr($target).'" class="wbcvpb_icon_boxed scroll" style="'.esc_attr($icon_bg_out.$icon_border).'"><i class="'.esc_attr($icon).'" style="'.$icon_color.'background:transparent;"></i></a>' : '<div class="wbcvpb_icon_boxed" style="'.esc_attr($icon_bg_out.$icon_border).'"><i class="'.esc_attr($icon).'" style="'.esc_attr($icon_color).'background:transparent;"></i></div>';
						$return .= ($link!='') ? '<a href="'.esc_url($link).'" target="'.esc_attr($target).'" class="scroll">'.$title_out.'</a>' : $title_out;
						$return .= '</div>';
						$return .= ($content != '') ?''.do_shortcode($content).'' : '';
					$return .= '</div>';
	}

	return $return;
}


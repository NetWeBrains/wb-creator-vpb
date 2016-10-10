<?php

/*********** Shortcode: Metro Box ************************************************************/

$wbcvpb_shortcodes['metro_box_wbc'] = array(
	'name' => esc_html__('Metro Box', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-metro-box',
	'category' => esc_html__('Content', 'the-creator-vpb' ),
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Title', 'the-creator-vpb'),
		),
		'short_description' => array(
			'description' => esc_html__('Short description', 'the-creator-vpb'),
			'info' => esc_html__('This will go on the front of the metro box', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'the-creator-vpb'),
			'type' => 'icon',
		),
		'icon_color' => array(
			'description' => esc_html__('Icon Color', 'the-creator-vpb'),
			'type' => 'color',
		),
		'box_color' => array(
			'description' => esc_html__('Box Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
		),
		'box_back_color' => array(
			'description' => esc_html__('Box Back Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'divider' => 'true',
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
		'description' => esc_html__('Back Content', 'the-creator-vpb'),
	),
);
function wbcvpb_metro_box_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('metro_box_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$box_color = ($box_color !='') ? 'background:'.esc_attr($box_color).';' : '';

	$return = '
		<div '.esc_attr($id_out).' class="wbcvpb_metro_box '.$class.'">
			<div class="flipper">
				<div class="front" style="'.$box_color.'">
					<div class="wbcvpb_metro_box_header">';

					$return .= ($link!='') ? ( ($icon != '') ? '<a href="'.esc_url($link).'" target="'.esc_attr($target).'" class="wbcvpb_icon_boxed"><i class="'.esc_attr($icon).'" style="color:'.esc_attr($icon_color).'; background:transparent;"></i></a>': '' ) : ( ($icon != '') ? '<div class="wbcvpb_icon_boxed"><i class="'.esc_attr($icon).'" style="color:'.esc_attr($icon_color).'; background:transparent;"></i></div>' : '' );
					$return .= ($link!='') ? '<a href="'.esc_url($link).'" target="'.esc_attr($target).'"><h3>'.wp_kses($title, ABdev_allowed_tags()).'</h3></a>' : '<h3>'.wp_kses($title, ABdev_allowed_tags()).'</h3>';
					$return .= '</div>';
					$return .= ($short_description != '') ?'<div><p>'.wp_kses($short_description, ABdev_allowed_tags()).'</p></div>' : '';
					$return .= '</div>';
					$return .= ($content != '') ?'<div class="back" style="background:'.esc_attr($box_back_color).'">'.do_shortcode($content).'</div>' : '';
		$return .= '</div></div>';

	return $return;
}


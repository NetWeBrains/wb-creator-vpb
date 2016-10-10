<?php

/*********** Shortcode: Search ************************************************************/

$wbcvpb_shortcodes['search_wbc'] = array(
	'name' => esc_html__('Search Field', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-search',
	'category' => esc_html__('Content', 'the-creator-vpb' ),
	'attributes' => array(
		'placeholder' => array(
			'description' => esc_html__('Placeholder', 'the-creator-vpb'),
			'default' => esc_html__('Search', 'the-creator-vpb'),
		),
		'input_background' => array(
			'description' => esc_html__('Background Color on input', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'info' => esc_html__('Pick a color for input background.', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'border_color' => array(
			'description' => esc_html__('Border Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'info' => esc_html__('Pick a color for input border.', 'the-creator-vpb'),
		),
		'border_radius' => array(
			'description' => esc_html__('Border Radius (px)', 'the-creator-vpb'),
			'type' => 'string',
			'default' => '0',
			'info' => esc_html__('Set a number for border radius on input.', 'the-creator-vpb'),
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
function wbcvpb_search_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('search_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$border_color_output = ($border_color!='') ? 'border-color:' .$border_color.'; ' : '';
	$border_radius_output = ($border_radius!='') ? 'border-radius:' .$border_radius.'px; ' : '';
	$input_background_output = ($input_background!='') ? 'background:' .$input_background.'; ' : '';
	$input_background_output = ($input_background!='') ? 'background:' .$input_background.'; ' : '';
	$icon_color = ($icon_color!='') ? 'color: '.$icon_color.';' : '';

	$return = '
		<div '.esc_attr($id_out).' class="wbcvpb_search '.esc_attr($class).'">
			<form name="search" id="search" method="get" action="'.esc_url(home_url()).'">
				<input name="s" type="text" placeholder="'.esc_attr($placeholder).'" value="'.esc_attr(get_search_query()).'" style="'.esc_attr($border_color_output).' '.esc_attr($border_radius_output).' '.esc_attr($input_background_output).'">
				<a class="submit" style="'.esc_attr($icon_color).'"><i class="'.esc_attr($icon).'"></i></a>
			</form>
		</div>';

	return $return;
}


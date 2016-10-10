<?php

/*********** Shortcode: Alert Box ************************************************************/

$wbcvpb_shortcodes['alert_box_wbc'] = array(
	'name' => esc_html__('Alert Box', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-alert-box',
	'category' => esc_html__('Content', 'the-creator-vpb' ),
	'attributes' => array(
		'style' => array(
			'default' => 'info',
			'type' => 'select',
			'values' => array( 
				'info' => 'Info',
				'warning' => 'Warning',
				'error' => 'Error',
				'success' => 'Success',
			),
			'description' => esc_html__('Style', 'the-creator-vpb'),
		),
		'icon_out' => array(
			'description' => esc_html__('Name of the Icon', 'the-creator-vpb'),
			'type' => 'icon',
		),
		'icon_color' => array(
			'description' => esc_html__('Icon Color', 'the-creator-vpb'),
			'type' => 'color',
		),
		'no_close' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('No Close Button', 'the-creator-vpb'),
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
		'description' => esc_html__('Message', 'the-creator-vpb'),
	),
);
function wbcvpb_alert_box_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('alert_box_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$allowed_styles = array('warning','error','info','success');
	$style = (in_array($style, $allowed_styles)) ? $style : 'info';
	$style_out = 'wbcvpb_alert_' . $style;

	$icon_out = ($icon_out != '1') ? '<i class="'.esc_attr($icon_out).'" style="color:'.esc_attr($icon_color).';"></i> ' : '';
	$close_button = ( $no_close != 1 ) ? '<a class="wbcvpb_alert_box_close" title="' . esc_attr__('Close', 'the-creator-vpb' ) . '">&#10005;</a>' : '';
	return  '<div '.esc_attr($id_out).' class="'.esc_attr($style_out).' '.esc_attr($class).'">
		' . $icon_out . $content . $close_button . '
	</div>';
}
<?php

/*********** Shortcode: Icon ************************************************************/

$wbcvpb_shortcodes['icon_wbc'] = array(
	'name' => esc_html__('Icon', 'the-creator-vpb' ),
	'type' => 'inline',
	'attributes' => array(
		'name' => array(
			'type' => 'icon',
			'description' => esc_html__('Icon', 'the-creator-vpb'),
		),
		'size' => array(
			'default' => '16px',
			'description' => esc_html__('Icon Size', 'the-creator-vpb'),
		),
		'color' => array(
			'type' => 'color',
			'description' => esc_html__('Icon Color', 'the-creator-vpb'),
		),
		'rotate' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Rotate Icon', 'the-creator-vpb'),
		),
		'box' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Icon Box', 'the-creator-vpb'),
		),
		'padding' => array(
			'default' => '5px',
			'description' => esc_html__('Icon Box Padding', 'the-creator-vpb'),
		),
		'background' => array(
			'type' => 'coloralpha',
			'description' => esc_html__('Icon Box Background Color', 'the-creator-vpb'),
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
function wbcvpb_icon_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('icon_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	
	$rotate_output = ($rotate==1) ? ' ABdev_icon_spin' : '';
	
	$icon_style_output='';
	if($color!='' || $size!=''){
		$color_output = ($color!='') ? "color:$color;" : '';
		$size_output = ($size!='') ? "line-height:$size;font-size:$size;" : '';
		$icon_style_output=' style="'.esc_attr($color_output).esc_attr($size_output).'"';
	}
	$box_style_output = $box_style_output_before = $box_style_output_after = '';
	if(($padding!='' || $background!='') && $box=='1'){
		$padding_output = ($padding!='') ? "padding:$padding;" : '';
		$background_output = ($background!='') ? "background:$background;" : '';
		$box_style_output_before='<span style="'.esc_attr($padding_output).esc_attr($background_output).' display:inline-block;" class="'.esc_attr($class).'">';
		$box_style_output_after='</span>';
	}
	return $box_style_output_before.'<i '.esc_attr($id_out).' class="'.esc_attr($name).esc_attr($rotate_output).'"'.$icon_style_output.'></i>'.$box_style_output_after;
}


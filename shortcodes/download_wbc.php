<?php

/*********** Shortcode: Download Button ************************************************************/

$wbcvpb_shortcodes['download_wbc'] = array(
	'name' => esc_html__('Download Button', 'the-creator-vpb'),
	'type' => 'block',
	'icon' => 'pi-download',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'attributes' => array(
		'text' => array(
			'description' => esc_html__('Link Text', 'the-creator-vpb'),
		),
		'url' => array(
			'description' => esc_html__('URL to File', 'the-creator-vpb'),
		),
		'filename' => array(
			'info' => esc_html__('Forces this filename, use full name with extension or leave blank for original file name', 'the-creator-vpb'),
			'description' => esc_html__('Filename', 'the-creator-vpb'),
		),
		'icon' => array(
			'type' => 'icon',
			'description' => esc_html__('Icon', 'the-creator-vpb'),
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
	)
);
function wbcvpb_download_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('download_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$download = ($filename!='') ? 'download="'.esc_attr($filename).'"' : 'download';
	$text = ($text=='') ? basename($url) : $text;
	$icon_output = ($icon!='') ? '<i class="'.esc_attr($icon).'"></i> ' :'';

	return $icon_output.'<a href="'.esc_url($url).'" '.esc_attr($id_out).' '.esc_attr($class_out).' '.$download.'>'.esc_html($text).'</a>';
}

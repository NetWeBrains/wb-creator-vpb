<?php

/*********** Shortcode: QR Code ************************************************************/

$wbcvpb_shortcodes['qrcode_wbc'] = array(
	'name' => esc_html__('QR Code', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-qrcode',
	'category' =>  esc_html__('E-Commerce', 'the-creator-vpb'),
	'attributes' => array(
		'alt' => array(
			'description' => esc_html__('Alt Text', 'the-creator-vpb'),
		),
		'size' => array(
			'default' => '150',
			'description' => esc_html__('Size (px)', 'the-creator-vpb'),
		),
		'align' => array(
			'default' => '',
			'description' => esc_html__('Align', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'' => esc_html__('None', 'the-creator-vpb'),
				'left' => esc_html__('Left', 'the-creator-vpb'),
				'right' => esc_html__('Right', 'the-creator-vpb'),
			),
			'divider' => 'true',
		),
		'mecard_name' => array(
			'description' => esc_html__('MeCard Name', 'the-creator-vpb'),
		),
		'mecard_address' => array(
			'description' => esc_html__('MeCard Address', 'the-creator-vpb'),
		),
		'mecard_tel' => array(
			'description' => esc_html__('MeCard Telephone', 'the-creator-vpb'),
		),
		'mecard_email' => array(
			'description' => esc_html__('MeCard Email', 'the-creator-vpb'),
		),
		'mecard_url' => array(
			'description' => esc_html__('MeCard URL', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'quality' => array(
			'default' => 'H',
			'description' => esc_html__('Quality', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'H' => esc_html__('H', 'the-creator-vpb'),
				'L' => esc_html__('L', 'the-creator-vpb'),
				'M' => esc_html__('M', 'the-creator-vpb'),
				'Q' => esc_html__('Q', 'the-creator-vpb'),
			),
		),
		'border' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => esc_html__('Border', 'the-creator-vpb'),
		),
		'content' => array(
			'default' => 'http://'.$_SERVER['HTTP_HOST'],
			'description' => esc_html__('Content', 'the-creator-vpb'),
		),
		'current_url' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Use current page/post URL', 'the-creator-vpb'),
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
function wbcvpb_qrcode_wbc_shortcode($attributes, $content = null) {
	extract(shortcode_atts(wbcvpb_extract_attributes('qrcode_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';
	
	if($current_url=='1')
		$content = wbcvpb_current_page_url();

	if($mecard_name!='' || $mecard_address!='' || $mecard_tel!='' || $mecard_email!='' || $mecard_url!=''){
		$mecard="MECARD:";
		if($mecard_name!='')
			$mecard.="N:$mecard_name;";
		if($mecard_address!='')
			$mecard.="ADR:$mecard_address;";
		if($mecard_tel!='')
			$mecard.="TEL:$mecard_tel;";
		if($mecard_email!='')
			$mecard.="EMAIL:$mecard_email;";
		if($mecard_url!='')
			$mecard.="URL:$mecard_url;";
		if($content!='')
			$mecard.="NOTE:$content;";
		$content=$mecard;
	}

	$content = urlencode($content);

	if (empty($align) && $align !==0)
		$align = "";
	else
		$align = strip_tags(trim($align));

	$image = 'http://chart.apis.google.com/chart?cht=qr&amp;chld='.$quality.'|'.$border.'&amp;chs=' . $size . 'x' . $size . '&amp;chl=' . $content;

	if ($align == "right")
		$align = ' align="right"';
	if ($align == "left")
		$align = ' align="left"';

	return '<img '.esc_attr($id_out).' '.esc_attr($class_out).' src="' . esc_url($image) . '" alt="' . esc_attr($alt) . '" title="' . esc_attr($alt) . '" width="' . esc_attr($size) . '" height="' . esc_attr($size) . '"' . $align .' />';
}


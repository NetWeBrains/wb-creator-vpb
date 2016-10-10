<?php

/*********** Shortcode: Blockquote ************************************************************/

$wbcvpb_shortcodes['blockquote_wbc'] = array(
	'name' => esc_html__('Blockquote Block', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-blockquote',
	'category' => esc_html__('Content', 'the-creator-vpb' ),
	'attributes' => array(
		'style' => array(
			'description' => esc_html__( 'Style', 'the-creator-vpb' ),
			'default' => 'default',
			'type' => 'select',
			'values' => array(
				'style1' =>  esc_html__( 'Style 1', 'the-creator-vpb' ),
				'style2' =>  esc_html__( 'Style 2', 'the-creator-vpb' ),
				'style3' =>  esc_html__( 'Style 3', 'the-creator-vpb' ),
				'style4' =>  esc_html__( 'Style 4', 'the-creator-vpb' ),
				'wide' =>  esc_html__( 'Wide', 'the-creator-vpb' ),
			),
		),
		'author' => array(
			'description' => esc_html__('Author', 'the-creator-vpb'),
		),
		'url_author' => array(
			'description' => esc_html__('Author URL', 'the-creator-vpb'),
		),
		'delimiter' => array(
			'description' => esc_html__('Delimiter between author and source', 'the-creator-vpb'),
			'default' => ' ',
		),
		'source' => array(
			'description' => esc_html__('Source', 'the-creator-vpb'),
		),
		'url_source' => array(
			'description' => esc_html__('Source URL', 'the-creator-vpb'),
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
		'description' => esc_html__('Blockquote', 'the-creator-vpb'),
	),
);
function wbcvpb_blockquote_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('blockquote_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	
	$quote ='';
	if($source!='' && $url_source!='')
		$source='<cite title="'.esc_attr($source).'"><a href="'.esc_url($url_source).'">'.$source.'</a></cite>';
	if($source!='' && $url_source=='')
		$source='<cite title="'.esc_attr($source).'">'.$source.'</cite>';
	if($author!='' && $url_author!='')
		$content.='<small><a href="'.esc_url($url_author).'">'.$author.'</a> '.$delimiter.$source.'</small>';
	if($author!='' && $url_author=='')
		$content.='<small>'.$author.$delimiter.$source.'</small>';
	return '<blockquote '.esc_attr($id_out).' class="wbcvpb_blockquote wbcvpb_blockquote_'.esc_attr($style).' '.esc_attr($class).'">
		'.$quote.'
		'.do_shortcode($content).'
	</blockquote>';
}
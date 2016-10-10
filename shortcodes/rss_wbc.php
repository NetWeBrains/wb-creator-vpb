<?php

/*********** Shortcode: RSS feed ************************************************************/

$wbcvpb_shortcodes['rss_wbc'] = array(
	'name' => esc_html__('RSS', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-rss',
	'category' =>  esc_html__('Social', 'the-creator-vpb'),
	'attributes' => array(
		'feed' => array(
			'description' => esc_html__('Feed URL', 'the-creator-vpb'),
		),
		'num' => array(
			'default' => '5',
			'description' => esc_html__('Number of Posts', 'the-creator-vpb'),
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
	)
);
include_once(ABSPATH.WPINC.'/feed.php');
function wbcvpb_rss_wbc_shortcode($attributes) {
    extract(shortcode_atts(wbcvpb_extract_attributes('rss_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	
	$maxitems = $rss_items = '';
	$rss = fetch_feed($feed);
	if (!is_wp_error( $rss ) ) {
		$maxitems = $rss->get_item_quantity($num); 
		$rss_items = $rss->get_items(0, $maxitems); 
	}

	if($target!='')
		$target_output=' target="'.esc_attr($target).'"';

	$return='<ul '.esc_attr($id_out).' class="wbcvpb_rss '.esc_attr($class).'">';
	if ($maxitems == 0){
		$return .= '<li>'.esc_html__('No RSS items loaded','the-creator-vpb').'</li>';
	}
	else{
		foreach ( $rss_items as $item ) 
			$return.='<li><a href="'. esc_url( $item->get_permalink() ).'" title="'.esc_attr__('Posted','the-creator-vpb').' '.$item->get_date('j F Y | g:i a').'"'.$target_output.'>'.esc_html( $item->get_title() ).'</a></li>';
	}
	$return.='</ul>';

	return $return;
}


<?php

/*********** Shortcode: Tabs ************************************************************/

$wbcvpb_shortcodes['tabs_wbc'] = array(
	'name' => esc_html__('Tabs', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-tab',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'child' => 'tab_wbc',
	'child_button' => esc_html__('New Tab', 'the-creator-vpb'),
	'child_title' => esc_html__('Tab no.', 'the-creator-vpb'),
	'attributes' => array(
		'tabs_position' => array(
			'default' => 'top',
			'description' => esc_html__('Tabs Position', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'top' => esc_html__('Top', 'the-creator-vpb'),
				'bottom' => esc_html__('Bottom', 'the-creator-vpb'),
				'left' => esc_html__('Left', 'the-creator-vpb'),
				'right' => esc_html__('Right', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Style', 'the-creator-vpb'),
		),
		'style' => array(
			'default' => 'boxed',
			'description' => __('Tabs style', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'boxed' => __('Boxed', 'the-creator-vpb'),
				'unboxed' => __('Unboxed', 'the-creator-vpb'),
			),
			'info' => __('Timeline tabs have tabs position top or bottom only.', 'the-creator-vpb'),
			'tab' => esc_html__('Style', 'the-creator-vpb'),
		),
		'effect' => array(
			'default' => '',
			'description' => esc_html__('Transition Effect', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'' => esc_html__('None', 'the-creator-vpb'),
				'slide' => esc_html__('Slide', 'the-creator-vpb'),
				'fade' => esc_html__('Fade', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Style', 'the-creator-vpb'),
		),
		'selected' => array(
			'description' => esc_html__('Selected Tab', 'the-creator-vpb'),
			'info' => esc_html__('Initially selected tab, order number', 'the-creator-vpb'),
			'default' => '1',
		),
		'break_point' => array(
			'description' => esc_html__('Break Point', 'the-creator-vpb'),
			'info' => esc_html__('Width in px. Below this width tabs will be stacked on each other.', 'the-creator-vpb'),
			'tab' => esc_html__('Break Point', 'the-creator-vpb'),
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
function wbcvpb_tabs_wbc_shortcode( $attributes, $content = null ) {
	global $tabs_navigation,$tabs_content,$tabs_counter,$tabs_selected;
	extract(shortcode_atts(wbcvpb_extract_attributes('tabs_wbc'), $attributes));
	static $i = 0;
    $i++;

    $tabs_counter = $i;

    $tabs_selected = $selected;
    
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	
	do_shortcode($content);

	$slide_direction = ( $tabs_position == 'top' || $tabs_position == 'bottom' ) ? 'horizontal' : 'vertical';

	$return = '
		<div '.esc_attr($id_out).' class="wbcvpb-tabs wbcvpb-tabs-'.esc_attr($slide_direction).' wbcvpb-tabs-position-'.esc_attr($tabs_position).' wbcvpb-tabs-'.esc_attr($style).' '.esc_attr($class).'" data-selected="'.esc_attr($selected).'" role="tabpane'.$i.'" data-break_point="'.esc_attr($break_point).'" data-effect="'.esc_attr($effect).'">
			<ul class="nav nav-tabs tab-helper-reset tab-helper-clearfix" role="tablist">
				'.$tabs_navigation.'
			</ul>
			<div class="tab-content">
			'.$tabs_content.'
			</div>
		</div>';

	$tabs_navigation = $tabs_content = '';

	return $return;
}

	
$wbcvpb_shortcodes['tab_wbc'] = array(
	'name' => esc_html__('Tab', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Tab Title', 'the-creator-vpb'),
		),
		'icon' => array(
			'type' => 'icon',
			'description' => esc_html__('Icon', 'the-creator-vpb'),
		),
	),
	'content' => array(
		'description' => esc_html__('Tab Content', 'the-creator-vpb'),
	)
);
function wbcvpb_tab_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('tab_wbc'), $attributes));
	
	static $tab_count = 0;
	static $tabs_counter_static=0;
	global $tabs_navigation,$tabs_content,$tabs_counter,$tabs_selected;

	$active_class = false;
	if($tabs_counter!=$tabs_counter_static){
		$tabs_counter_static = $tabs_counter;
		$tab_count = 0;
	}
    $tab_count++;
	if($tabs_selected==$tab_count){
		$active_class = true;
	}
	
	$icon_output = ( $icon!='' ) ? '<i class="'.esc_attr($icon).' tab-icon"></i> ' : '';
	
	$tabs_navigation.='<li role="presentation"'.(($active_class)?' class="active"':'').'><a class="wbcvpb-tabs-tab" data-href="#tab-'.$tabs_counter.'-'.$tab_count.'" aria-controls="tab-'.$tabs_counter.'-'.$tab_count.'" role="tab" data-toggle="tab">'.$icon_output . $title . '</a></li>';
	$tabs_content.='
		<div id="tab-'.$tabs_counter.'-'.$tab_count.'" class="tab-pane'.(($active_class)?' active_pane':'').'" role="tabpanel">
			' . do_shortcode($content) . '
		</div>';
	
	$return = '';
	return $return;
}

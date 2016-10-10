<?php

/*********** Shortcode: Price Box ************************************************************/

$wbcvpb_shortcodes['pricing_box_wbc'] = array(
	'name' => esc_html__('Pricing box', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-pricing-box',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'child' => 'pricing_feature_wbc',
	'child_title' => esc_html__('Pricing Feature', 'the-creator-vpb'),
	'child_button' => esc_html__('Add Pricing Feature', 'the-creator-vpb'),
	'attributes' => array(
		'icon' => array(
			'description' => esc_html__('Icon', 'the-creator-vpb'),
			'type' => 'icon',
		),
		'name' => array(
			'description' => esc_html__('Name', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'price' => array(
			'description' => esc_html__('Price', 'the-creator-vpb'),
		),
		'currency' => array(
			'description' => esc_html__('Currency Sign', 'the-creator-vpb'),
		),
		'monthly' => array(
			'description' => esc_html__('Monthly Text', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'decsription' => array(
			'description' => esc_html__('Decsription', 'the-creator-vpb'),
		),
		'style' => array(
			'default' => '1',
			'type' => 'select',
			'values' => array(
				'1' => esc_html__('Style 1', 'the-creator-vpb'),
				'2' => esc_html__('Style 2', 'the-creator-vpb'),
				'3' => esc_html__('Style 3', 'the-creator-vpb'),
				'4' => esc_html__('Style 4', 'the-creator-vpb'),
				'5' => esc_html__('Style 5', 'the-creator-vpb'),
			),
			'description' => esc_html__('Style', 'the-creator-vpb'),
			'tab' => esc_html__('Style', 'the-creator-vpb'),
		),
		'header_background' => array(
			'description' => esc_html__( 'Header Background Color', 'the-creator-vpb' ),
			'type' => 'coloralpha',
			'tab' => esc_html__('Style', 'the-creator-vpb'),
		),
		'header_color' => array(
			'description' => esc_html__( 'Header Text Color', 'the-creator-vpb' ),
			'type' => 'color',
			'tab' => esc_html__('Style', 'the-creator-vpb'),
		),
		'info_background' => array(
			'description' => esc_html__( 'Info Box Background Color', 'the-creator-vpb' ),
			'type' => 'coloralpha',
			'tab' => esc_html__('Style', 'the-creator-vpb'),
		),
		'info_color' => array(
			'description' => esc_html__( 'Info Box Text Color', 'the-creator-vpb' ),
			'type' => 'color',
			'tab' => esc_html__('Style', 'the-creator-vpb'),
		),
		'featured' => array(
			'default' => '0',
			'type' => 'checkbox',
			'description' => esc_html__('Is Featured?', 'the-creator-vpb'),
			'tab' => esc_html__('Featured', 'the-creator-vpb'),
		),
		'featured_text' => array(
			'description' => esc_html__('Featured Info', 'the-creator-vpb'),
			'tab' => esc_html__('Featured', 'the-creator-vpb'),
		),
		'button_text' => array(
			'description' => esc_html__( 'Button Text', 'the-creator-vpb' ),
			'tab' => esc_html__('Button', 'the-creator-vpb'),
		),
		'button_size' => array(
			'description' => esc_html__( 'Size', 'the-creator-vpb' ),
			'default' => 'medium',
			'type' => 'select',
			'values' => array(
				'small' =>  esc_html__( 'Small', 'the-creator-vpb' ),
				'medium' => esc_html__( 'Medium', 'the-creator-vpb' ),
				'large' => esc_html__( 'Large', 'the-creator-vpb' ),
				'xlarge' => esc_html__( 'Extra Large', 'the-creator-vpb' ),
			),
			'tab' => esc_html__('Button', 'the-creator-vpb'),
		),
		'button_color' => array(
			'description' => esc_html__( 'Button Text Color', 'the-creator-vpb' ),
			'type' => 'color',
			'tab' => esc_html__('Button', 'the-creator-vpb'),
		),
		'button_background' => array(
			'description' => esc_html__( 'Button Background Color', 'the-creator-vpb' ),
			'type' => 'coloralpha',
			'tab' => esc_html__('Button', 'the-creator-vpb'),
		),
		'button_style' => array(
			'description' => esc_html__( 'Style', 'the-creator-vpb' ),
			'default' => 'normal',
			'type' => 'select',
			'values' => array(
				'normal' =>  esc_html__( 'Normal', 'the-creator-vpb' ),
				'rounded' =>  esc_html__( 'Rounded', 'the-creator-vpb' ),
			),
			'tab' => esc_html__('Button', 'the-creator-vpb'),
		),
		'button_url' => array(
			'description' => esc_html__( 'URL', 'the-creator-vpb' ),
			'tab' => esc_html__('Button', 'the-creator-vpb'),
		),
		'button_target' => array(
			'description' => esc_html__( 'Target', 'the-creator-vpb' ),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__( 'Self', 'the-creator-vpb' ),
				'_blank' => esc_html__( 'Blank', 'the-creator-vpb' ),
			),
			'tab' => esc_html__('Button', 'the-creator-vpb'),
		),
		'button_icon' => array(
			'description' => esc_html__('Button Icon', 'the-creator-vpb'),
			'info' => esc_html__('Optional icon after button text', 'the-creator-vpb'),
			'type' => 'icon',
			'tab' => esc_html__('Button', 'the-creator-vpb'),
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
function wbcvpb_pricing_box_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('pricing_box_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$featured_output=($featured=='1')?' wbcvpb_popular-plan':'';
	$icon_output=($icon!='')?'<div class="wbcvpb_pricebox_icon"><i class="'.esc_attr($icon).'"></i></div>':'';
	$decsription_output=($decsription!='')?'<span class="wbcvpb_pricebox_decsription">'.wp_kses($decsription, ABdev_allowed_tags()).'</span>':'';
	$featured_text_output=($featured_text!='')?'<div class="wbcvpb_pricebox_featured_text">'.wp_kses($featured_text, ABdev_allowed_tags()).'</div>':'';
	$header_background = ($header_background!='') ? 'background:'.$header_background.';' : '';
	$header_color = ($header_color!='') ? 'color: '.$header_color.';' : '';
	$info_background = ($info_background!='') ? 'background:'.$info_background.';' : '';
	$info_color = ($info_color!='') ? 'color: '.$info_color.';' : '';

	$button_out='';
	if($button_text != ''){
		$class_out = 'wbcvpb-button';
		$class_out .= ' wbcvpb-button_'.$button_style;
		$class_out .= ' wbcvpb-button_'.$button_size;
		$button_color = ($button_color!='') ? 'color: '.$button_color.';' : '';
		$button_background = ($button_background!='') ? 'background:'.$button_background.';' : '';
		$icon_out = ($button_icon!='') ? '<i class="'.esc_attr($button_icon).'"></i>' : '';
		$button_out = '<div class="wbcvpb_pricebox_feature wbcvpb_pricebox_feature_button"><a href="'. esc_url($button_url) .'" target="' . esc_attr($button_target) . '" class="'.esc_attr($class_out).'" style="'.esc_attr($button_color.$button_background).'">' . $button_text . $icon_out . '</a></div>';
	}

	static $count_priceboxes;
	$count_priceboxes++;
	return '
	<div '.esc_attr($id_out).' class="wbcvpb_pricing-table-'.esc_attr($style).' '.esc_attr($featured_output).' '.esc_attr($class).'">
		<div class="wbcvpb_plan wbcvpb_plan'.esc_attr($count_priceboxes.$featured_output).'">
			'.$featured_text_output.'
			<div class="wbcvpb_pricebox_header" style="'.esc_attr($header_background).'">
				'.$icon_output.'
				<span class="wbcvpb_pricebox_name" style="'.esc_attr($header_color).'">'.esc_attr($name).'</span>
				<div class="wbcvpb_pricebox_info" style="'.esc_attr($info_color.$info_background).'">
					<span class="wbcvpb_pricebox_currency">'.esc_attr($currency).'</span>
					<span class="wbcvpb_pricebox_price">'.esc_attr($price).'</span>
					<span class="wbcvpb_pricebox_monthly">'.esc_attr($monthly).'</span>
				</div>
				'.$decsription_output.'
			</div>
			'.do_shortcode($content).' 
			'.$button_out.'          
		</div>
	</div>';
}

$wbcvpb_shortcodes['pricing_feature_wbc'] = array(
	'name' => esc_html__('Pricing feature', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'name' => array(
			'description' => esc_html__('Feature Name', 'the-creator-vpb'),
		),
		'value' => array(
			'description' => esc_html__('Value', 'the-creator-vpb'),
		),
		'yes' => array(
			'type' => 'icon',
			'description' => esc_html__('Avaliable Icon', 'the-creator-vpb'),
		),
		'no' => array(
			'type' => 'icon',
			'description' => esc_html__('Not Avaliable Icon', 'the-creator-vpb'),
		),
	),
);
function wbcvpb_pricing_feature_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('pricing_feature_wbc'), $attributes));
	$yes_output = ($yes!='')?'<i class="'.esc_attr($yes).'"></i>':'';
	$no_output = ($no!='')?'<i class="'.esc_attr($no).'"></i>':'';
	return '<span class="wbcvpb_pricebox_feature">'.$yes_output.$no_output.'<strong>'.esc_attr($value).'</strong> '.esc_attr($name).'</span>';
}
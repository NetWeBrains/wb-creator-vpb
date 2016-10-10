<?php

/*********** Shortcode: Sidebar ************************************************************/

$sidebars_array = $GLOBALS['wp_registered_sidebars'];
$sidebars = array();
if(is_array($sidebars_array)){
	foreach ($sidebars_array as $key => $value) {
		$sidebars[$key] = $value['name'];
	}
}

$wbcvpb_shortcodes['sidebar_wbc'] = array(
	'name' => esc_html__('Sidebar', 'the-creator-vpb' ),
	'notice' => esc_html__('Display sidebar and all its widgets anywhere inside content. You can create unlimited number of sidebars in Creator\'s options.', 'the-creator-vpb'),
	'type' => 'block',
	'icon' => 'pi-sidebar',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'attributes' => array(
		'name' => array(
			'default' => '',
			'type' => 'select',
			'values' => $sidebars,
			'description' => esc_html__('Select Sidebar', 'the-creator-vpb'),
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
function wbcvpb_sidebar_wbc_shortcode( $attributes ) {
    extract(shortcode_atts(wbcvpb_extract_attributes('sidebar_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

    $name = trim($name);
    $content='';

        ob_start();  
        dynamic_sidebar($name);
        $content = ob_get_clean();

    return '<div '.esc_attr($id_out).' '.esc_attr($class_out).' >'.$content.'</div>';
}


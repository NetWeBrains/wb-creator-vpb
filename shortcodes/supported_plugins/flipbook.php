<?php 

/**
	Real3D Flipbook support
**/
if( in_array('real3d-flipbook/real3d-flipbook.php', get_option('active_plugins')) ){ //first check if plugin is installed

	$flipbooks = get_option("flipbooks");

	$books = array();
	if(is_array($flipbooks)){
		foreach ($flipbooks as $flipbook) {
			$books[ $flipbook['id'] ] = $flipbook['name'];
		}
	}

	$wbcvpb_shortcodes['real3dflipbook'] = array(
		'name' => esc_html__('Real3D Flipbook', 'the-creator-vpb' ),
		'description' => esc_html__('Real3D Flipbook', 'the-creator-vpb'),
		'type' => 'block',
		'icon' => 'pi-flipbook',
		'category' =>  esc_html__('Media', 'the-creator-vpb'),
		'third_party' => 1, 
		'attributes' => array(
			'id' => array(
				'description' => esc_html__('Select Flipbook', 'the-creator-vpb'),
				'default' => '',
				'type' => 'select',
				'values' => $books,

			),
		),
	);
}


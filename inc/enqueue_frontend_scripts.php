<?php
function wbcvpb_enqueue_frontend_script() {
	$options = get_option( 'wbcvpb_settings' );

	if(isset($options['wbcvpb_enable_typicons']) && $options['wbcvpb_enable_typicons']==1){
		wp_enqueue_style('wbcvpb_icons_typicons', WBCVPB_DIR.'assets/frontend/css/fonts/typicons/typicons.css', array(), WBCVPB_VERSION);
	}
	if(isset($options['wbcvpb_enable_whhg']) && $options['wbcvpb_enable_whhg']==1){
		wp_enqueue_style('wbcvpb_icons_whhg', WBCVPB_DIR.'assets/frontend/css/fonts/whhg/whhg.css', array(), WBCVPB_VERSION);
	}
	if(isset($options['wbcvpb_enable_big_mug']) && $options['wbcvpb_enable_big_mug']==1){
		wp_enqueue_style('wbcvpb_icons_big_mug', WBCVPB_DIR.'assets/frontend/css/fonts/big_mug/big_mug.css', array(), WBCVPB_VERSION);
	}
	if(isset($options['wbcvpb_enable_elegant']) && $options['wbcvpb_enable_elegant']==1){
		wp_enqueue_style('wbcvpb_icons_elegant', WBCVPB_DIR.'assets/frontend/css/fonts/elegant/elegant.css', array(), WBCVPB_VERSION);
	}
	if(isset($options['wbcvpb_enable_entypo']) && $options['wbcvpb_enable_entypo']==1){
		wp_enqueue_style('wbcvpb_icons_entypo', WBCVPB_DIR.'assets/frontend/css/fonts/entypo/entypo.css', array(), WBCVPB_VERSION);
	}
	if(isset($options['wbcvpb_enable_font_awesome']) && $options['wbcvpb_enable_font_awesome']==1){
		wp_enqueue_style('wbcvpb_icons_font_awesome', WBCVPB_DIR.'assets/frontend/css/fonts/font_awesome/font_awesome.css', array(), WBCVPB_VERSION);
	}
	if(isset($options['wbcvpb_enable_google_material']) && $options['wbcvpb_enable_google_material']==1){
		wp_enqueue_style('wbcvpb_icons_google_material', WBCVPB_DIR.'assets/frontend/css/fonts/google_material/google_material.css', array(), WBCVPB_VERSION);
	}
	if(isset($options['wbcvpb_enable_icomoon']) && $options['wbcvpb_enable_icomoon']==1){
		wp_enqueue_style('wbcvpb_icons_icomoon', WBCVPB_DIR.'assets/frontend/css/fonts/icomoon/icomoon.css', array(), WBCVPB_VERSION);
	}
	if(isset($options['wbcvpb_enable_ionicon']) && $options['wbcvpb_enable_ionicon']==1){
		wp_enqueue_style('wbcvpb_icons_ionicon', WBCVPB_DIR.'assets/frontend/css/fonts/ionicon/ionicon.css', array(), WBCVPB_VERSION);
	}

	// if theme has iconset include it
	$theme_icons_support_file = get_stylesheet_directory().'/assets/css/icons/icons.php';
	$theme_icons_css_file = get_stylesheet_directory_uri().'/assets/css/icons/icons.css';
	if(is_file($theme_icons_support_file)){
		wp_enqueue_style('wbcvpb_theme_icons', $theme_icons_css_file, array(), WBCVPB_VERSION);
	}

	if (!current_theme_supports('wb-creator-vpb')){
		wp_enqueue_style('wp-mediaelement');
		wp_enqueue_style('wbcvpb_scripts', WBCVPB_DIR.'assets/frontend/css/scripts.css', array(), WBCVPB_VERSION);
		$selected_style_file = (isset($options['wbcvpb_style']) && $options['wbcvpb_style']!='') ? $options['wbcvpb_style'] : 'default.css';
		wp_enqueue_style('wbcvpb', WBCVPB_DIR.'assets/frontend/css/themes/default.css', array('wbcvpb_scripts'), WBCVPB_VERSION);
		wp_enqueue_style('bootstrap', WBCVPB_DIR.'assets/frontend/bootstrap/css/bootstrap.css', array('wbcvpb_scripts'), WBCVPB_VERSION);
		wp_enqueue_style('slick', WBCVPB_DIR.'assets/frontend/css/slick.css', array('wbcvpb_scripts'), WBCVPB_VERSION);
		wp_enqueue_style('slicktheme', WBCVPB_DIR.'assets/frontend/css/slick-theme.css', array('wbcvpb_scripts'), WBCVPB_VERSION);

		wp_enqueue_script('wp-mediaelement');
		wp_enqueue_script('google_maps_api', 'http://maps.google.com/maps/api/js?sensor=false','','', true);
		wp_register_script('bootstrap', WBCVPB_DIR.'assets/frontend/bootstrap/js/bootstrap.min.js', array('jquery'), WBCVPB_VERSION, true);
		wp_register_script('chart', WBCVPB_DIR.'assets/frontend/js/chart.js', array('jquery'), WBCVPB_VERSION, true);
		wp_enqueue_script('scripts', WBCVPB_DIR.'assets/frontend/js/scripts.js', array('jquery','google_maps_api'), WBCVPB_VERSION, true);
		wp_enqueue_script('infobubble', WBCVPB_DIR.'assets/frontend/js/infobubble-compiled.js', array('jquery', 'jquery-ui-accordion', 'jquery-effects-slide', 'scripts'), WBCVPB_VERSION, true);
		wp_enqueue_script('slick', WBCVPB_DIR.'assets/frontend/js/slick.js', array('jquery', 'jquery-ui-accordion', 'jquery-effects-slide', 'scripts'), WBCVPB_VERSION, true);
		wp_enqueue_script('wb-creator-vpb', WBCVPB_DIR.'assets/frontend/js/init.js', array('jquery', 'jquery-ui-accordion', 'jquery-effects-slide', 'scripts'), WBCVPB_VERSION, true);
		$wbcvpb_tipsy_opacity = (isset($options['wbcvpb_tipsy_opacity'])) ? $options['wbcvpb_tipsy_opacity'] : '0.8';
		$wbcvpb_custom_map_style = (isset($options['wbcvpb_custom_map_style'])) ? $options['wbcvpb_custom_map_style'] : '';
		wp_localize_script( 'wb-creator-vpb', 'wbcvpb_options', array(
			'wbcvpb_tipsy_opacity' => $wbcvpb_tipsy_opacity,
			'wbcvpb_custom_map_style' => preg_replace('!\s+!', ' ', str_replace(array("\n","\r","\t"), '', $wbcvpb_custom_map_style)),
		) );
	}
}
add_action( 'wp_enqueue_scripts', 'wbcvpb_enqueue_frontend_script' );

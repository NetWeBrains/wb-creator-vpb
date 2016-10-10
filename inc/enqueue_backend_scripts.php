<?php

function wbcvpb_enqueue_admin_scripts($hook) {
	global $wbcvpb_shortcodes;
	$options = get_option( 'wbcvpb_settings' );

	$wbcvpb_disable_on = (isset($options['wbcvpb_disable_on'])) ? explode(',', $options['wbcvpb_disable_on'])  : array();
	$wbcvpb_disable_on = array_map('trim',$wbcvpb_disable_on);

	if(($hook == 'settings_page_wbcvpb')){
		wp_enqueue_style('wbcvpb-options_page-css', WBCVPB_DIR.'assets/backend/css/options_page.css', array(), WBCVPB_VERSION);
		wp_enqueue_script('wbcvpb-options_page', WBCVPB_DIR.'assets/backend/js/options_page.js', array('jquery'), WBCVPB_VERSION, true);
	}

	if(in_array(wbcvpb_get_current_post_type(), $wbcvpb_disable_on)){
		return;
	}

	if(($hook != 'post.php' && $hook != 'post-new.php')){
		return;
	}

	$wbcvpb_icons_array = array();
	// if theme has iconset include it
	$theme_icons_support_file = get_stylesheet_directory().'/css/icons/icons.php';
	$theme_icons_css_file = get_stylesheet_directory_uri().'/css/icons/icons.css';
	if(is_file($theme_icons_support_file)){
		wp_enqueue_style('wbcvpb_theme_icons', $theme_icons_css_file, array(), WBCVPB_VERSION);
		include $theme_icons_support_file;
	}

	// include enabled iconsets
	$fonts = array('typicons','whhg','big_mug','elegant','entypo','font_awesome','google_material','icomoon','ionicon');
	foreach ($fonts as $font) {
		if(isset($options['wbcvpb_enable_'.$font]) && $options['wbcvpb_enable_'.$font]==1){
			wp_enqueue_style('wbcvpb_icons_'.$font, WBCVPB_DIR.'assets/frontend/css/fonts/'.$font.'/'.$font.'.css', array(), WBCVPB_VERSION);
			include dirname(dirname(__FILE__)).'/assets/frontend/css/fonts/'.$font.'/'.$font.'.php';
		}
	}

	$element_categories=array(
		__('Content', 'wb-creator-vpb' ) => __('Content', 'wb-creator-vpb' ),
		__('Media', 'wb-creator-vpb' ) => __('Media', 'wb-creator-vpb' ),
	);
	foreach ($wbcvpb_shortcodes as $name => $element) {
		// echo '<br>'.$name.'<br>';
		if(isset($element['type']) && $element['type']=='block' && empty($element['hidden'])){
			$element_category = (isset($element['category'])) ? $element['category'] : esc_html__('Content', 'wb-creator-vpb' );
			$element_categories[$element_category] = $element_category;
		}
	}
	$element_categories=array_values($element_categories);

	wp_enqueue_style('wbcvpb-scripts-css', WBCVPB_DIR.'assets/backend/css/scripts.css', array(), WBCVPB_VERSION);
	wp_enqueue_style('wbcvpb-admin-icons', WBCVPB_DIR.'assets/backend/css/pluginicons/pluginicons.css', array(), WBCVPB_VERSION);
	wp_enqueue_style('wbcvpb-admin-style', WBCVPB_DIR.'assets/backend/css/admin.css', array('wbcvpb-scripts-css','wbcvpb-admin-icons'), WBCVPB_VERSION);
	wp_enqueue_media();
	wp_enqueue_script('wbcvpb-scripts', WBCVPB_DIR.'assets/backend/js/scripts.js', array(), WBCVPB_VERSION,true);
	wp_enqueue_script('wbcvpb-admin-script', WBCVPB_DIR.'assets/backend/js/admin.js', array('wbcvpb-scripts','jquery-ui-sortable','jquery-ui-resizable','jquery-ui-draggable'), WBCVPB_VERSION,true);
	wp_localize_script('wbcvpb-admin-script', 'wbcvpb_from_WP', array(
		'plugins_url' => plugins_url('wb-creator-vpb'),
		'wbcvpb_shortcode_names' => wbcvpb_shortcode_names(),
		'wbcvpb_3rd_party' => wbcvpb_3rd_party(),
		'saved_layouts' => implode("|", array_keys(get_option('wbcvpb_shortcodes_layouts',array()))),
		'save' => __('Save', 'wb-creator-vpb'),
		'error_to_editor' => __('<b>Content cannot be parsed</b><br>Please use Text tab instead or Revisions option to undo recently made changes.<br><br>Check the syntax:<br>- Use double quotes for attributes<br>- Every shortcode must be closed. e.g. [gallery ids="1,20"] should be [gallery ids="1,20"][/gallery]', 'wb-creator-vpb'),
		'delete_section' => __('Delete Section', 'wb-creator-vpb'),
		'duplicate_section' => __('Duplicate Section', 'wb-creator-vpb'),
		'edit_section' => __('Edit Section', 'wb-creator-vpb'),
		'remove_column' => __('Remove Column', 'wb-creator-vpb'),
		'remove' => __('Remove', 'wb-creator-vpb'),
		'delete' => __('Delete', 'wb-creator-vpb'),
		'load_layout' => __('Load Layout', 'wb-creator-vpb'),
		'add_section' => __('Add Section', 'wb-creator-vpb'),
		'add_column' => __('Add Column', 'wb-creator-vpb'),
		'move_column' => __('Move Column', 'wb-creator-vpb'),
		'add_element' => __('+ Element', 'wb-creator-vpb'),
		'edit_column' => __('Column Properties', 'wb-creator-vpb'),
		'text' => __('Text', 'wb-creator-vpb'),
		'delete_element' => __('Delete Element', 'wb-creator-vpb'),
		'duplicate_element' => __('Duplicate Element', 'wb-creator-vpb'),
		'edit_element' => __('Edit Element', 'wb-creator-vpb'),
		'drag_and_drop' => __('Drag & Drop', 'wb-creator-vpb'),
		'classis_editor' => __('Classic', 'wb-creator-vpb'),
		'add_edit_shortcode' => __('Add / Edit Shortcode', 'wb-creator-vpb'),
		'select_icon' => __('Select Icon', 'wb-creator-vpb'),
		'select_icon_info' => __('Icon sets can be enabled/disabled in Creator Settings', 'wb-creator-vpb'),
		'select_element' => __('Select Element', 'wb-creator-vpb'),
		'go_to_settings' => __('Go To Options Page', 'wb-creator-vpb'),
		'switch_button_activate' => __('Use the Creator', 'wb-creator-vpb'),
		'switch_button_deactivate' => __('Switch to Classic Editor', 'wb-creator-vpb'),
		'fullscreen' => __('Fullscreen', 'wb-creator-vpb'),
		'layouts' => __('Manage Layouts', 'wb-creator-vpb'),
		'redo' => __('Redo', 'wb-creator-vpb'),
		'undo' => __('Undo', 'wb-creator-vpb'),
		'plus_section' => __('+ Section', 'wb-creator-vpb'),
		'untitled_section' => __('Untitled section', 'wb-creator-vpb'),
		'collapse_children' => __('Collapse and Sort Child Elements', 'wb-creator-vpb'),
		'delete_image' => __('Delete Image', 'wb-creator-vpb'),
		'upload_image' => __('Upload Image', 'wb-creator-vpb'),
		'upload_gallery' => __('Upload Gallery', 'wb-creator-vpb'),
		'upload_media' => __('Upload Media', 'wb-creator-vpb'),
		'add_child' => __('Add Child', 'wb-creator-vpb'),
		'spectrum_select' => __('Select', 'wb-creator-vpb'),
		'spectrum_cancel' => __('cancel', 'wb-creator-vpb'),
		'layout_saved' => __('Layout successfully saved', 'wb-creator-vpb'),
		'layout_name_required' => __('Layout name is required', 'wb-creator-vpb'),
		'back_to_list' => __('Back to list', 'wb-creator-vpb'),
		'column_properties' => __('Column Properties', 'wb-creator-vpb'),
		'update_column_properties' => __('Update Column Properties', 'wb-creator-vpb'),
		'update_section_properties' => __('Update Section Properties', 'wb-creator-vpb'),
		'section_properties' => __('Section Properties', 'wb-creator-vpb'),
		'cross_margin' => __('margin', 'wb-creator-vpb'),
		'cross_border' => __('border', 'wb-creator-vpb'),
		'cross_padding' => __('padding', 'wb-creator-vpb'),
		'cancel' => __('Cancel', 'wb-creator-vpb'),
		'done' => __('Done', 'wb-creator-vpb'),
		'save_layout' => __('Save Layout', 'wb-creator-vpb'),
		'new_layout' => __('New Layout', 'wb-creator-vpb'),
		'layout_overwrite' => __('Overwrite', 'wb-creator-vpb'),
		'layout_save' => __('Save Layout', 'wb-creator-vpb'),
		'layout_delete' => __('Delete Layout', 'wb-creator-vpb'),
		'select_layout' => __('Add Layout to Content', 'wb-creator-vpb'),
		'layout_name' => __('Enter layout name', 'wb-creator-vpb'),
		'layout_name_delete' => __('Layout name to delete', 'wb-creator-vpb'),
		'layout_saved' => __('Layout successfully saved', 'wb-creator-vpb'),
		'layout_select_saved' => __('You have <span>no content yet.</span><br>Start by adding section or loading saved layout', 'wb-creator-vpb'),
		'rearange_sections' => __('Rearrange Sections', 'wb-creator-vpb'),
		'property_disabled' => __('Not available due to grid preservation', 'wb-creator-vpb'),
		'are_you_sure' => __('Are you sure?', 'wb-creator-vpb'),
		'column_delete_confirm' => __("This will delete column and all elements in it. \nAre you sure?", 'wb-creator-vpb'),
		'custom_column_class' => __('Custom Column Class', 'wb-creator-vpb'),
		'animation' => __('Animation', 'wb-creator-vpb'),
		'search' => __('search', 'wb-creator-vpb'),
		'general_tab' => __('General', 'wb-creator-vpb'),
		'none' => __('None', 'wb-creator-vpb'),
		'animation_duration' => __('Animation Duration ms', 'wb-creator-vpb'),
		'animation_delay' => __('Animation Delay ms', 'wb-creator-vpb'),
		'custom_section_class' => __('Custom Section Class', 'wb-creator-vpb'),
		'fullwidth' => __('Fullwidth Content', 'wb-creator-vpb'),
		'no_column_margin' => __('No Margin on Columns', 'wb-creator-vpb'),
		'equalize_five' => __('5 Columns Equalize', 'wb-creator-vpb'),
		'equalize_five_info' => __('Check this if you want 5 columns to be equal width (out of grid, use only 2/12 and 3/12 columns)', 'wb-creator-vpb'),
		'video_bg' => __('Video Background', 'wb-creator-vpb'),
		'video_bg_info' => __('If checked video background will be enabled. Video files should have same name as Background Image, and same path, only different extensions (mp4,webm,ogv files required). You can use Miro Converter to convert files in required formats.', 'wb-creator-vpb'),
		'background_color' => __('Background Color', 'wb-creator-vpb'),
		'background_image' => __('Background Image URL', 'wb-creator-vpb'),
		'parallax' => __('Background Parallax Factor', 'wb-creator-vpb'),
		'parallax_info' => __('0.1 means 10% of scroll, 2 means twice of scroll', 'wb-creator-vpb'),
		'flip' => __( 'Flip', 'wb-creator-vpb' ),
		'flipInX' => __( 'Flip In X', 'wb-creator-vpb' ),
		'flipInY' => __( 'Flip In Y', 'wb-creator-vpb' ),
		'fadeIn' => __( 'Fade In', 'wb-creator-vpb' ),
		'fadeInUp' => __( 'Fade In Up', 'wb-creator-vpb' ),
		'fadeInDown' => __( 'Fade In Down', 'wb-creator-vpb' ),
		'fadeInLeft' => __( 'Fade In Left', 'wb-creator-vpb' ),
		'fadeInRight' => __( 'Fade In Right', 'wb-creator-vpb' ),
		'fadeInUpBig' => __( 'Fade In Up Big', 'wb-creator-vpb' ),
		'fadeInDownBig' => __( 'Fade In Down Big', 'wb-creator-vpb' ),
		'fadeInLeftBig' => __( 'Fade In Left Big', 'wb-creator-vpb' ),
		'fadeInRightBig' => __( 'Fade In Right Big', 'wb-creator-vpb' ),
		'slideInLeft' => __( 'Slide In Left', 'wb-creator-vpb' ),
		'slideInRight' => __( 'Slide In Right', 'wb-creator-vpb' ),
		'bounceIn' => __( 'Bounce In', 'wb-creator-vpb' ),
		'bounceInDown' => __( 'Bounce In Down', 'wb-creator-vpb' ),
		'bounceInUp' => __( 'Bounce In Up', 'wb-creator-vpb' ),
		'bounceInLeft' => __( 'Bounce In Left', 'wb-creator-vpb' ),
		'bounceInRight' => __( 'Bounce In Right', 'wb-creator-vpb' ),
		'rotateIn' => __( 'Rotate In', 'wb-creator-vpb' ),
		'rotateInDownLeft' => __( 'Rotate In Down Left', 'wb-creator-vpb' ),
		'rotateInDownRight' => __( 'Rotate In Down Right', 'wb-creator-vpb' ),
		'rotateInUpLeft' => __( 'Rotate In Up Left', 'wb-creator-vpb' ),
		'rotateInUpRight' => __( 'Rotate In Up Right', 'wb-creator-vpb' ),
		'lightSpeedIn' => __( 'Light Speed In', 'wb-creator-vpb' ),
		'rollIn' => __( 'Roll In', 'wb-creator-vpb' ),
		'flash' => __( 'Flash', 'wb-creator-vpb' ),
		'bounce' => __( 'Bounce', 'wb-creator-vpb' ),
		'shake' => __( 'Shake', 'wb-creator-vpb' ),
		'tada' => __( 'Tada', 'wb-creator-vpb' ),
		'swing' => __( 'Swing', 'wb-creator-vpb' ),
		'wobble' => __( 'Wobble', 'wb-creator-vpb' ),
		'pulse' => __( 'Pulse', 'wb-creator-vpb' ),
		'upload_image' => __( 'Upload Image', 'wb-creator-vpb' ),
		'choose_image' => __( 'Choose Image', 'wb-creator-vpb' ),
		'use_image' => __( 'Use Image', 'wb-creator-vpb' ),
		'section_title' => __( 'Section Title', 'wb-creator-vpb' ),
		'section_id' => __( 'Section ID', 'wb-creator-vpb' ),
		'section_intro' => __( 'Section Intro', 'wb-creator-vpb' ),
		'section_outro' => __( 'Section Outro', 'wb-creator-vpb' ),
		'elements' => json_encode($wbcvpb_shortcodes),
		'categories' => json_encode($element_categories),
		'icons' => json_encode($wbcvpb_icons_array),
		'wbcvpb_history_amount' => ((isset($options['wbcvpb_history_amount']) && $options['wbcvpb_history_amount']>0) ? $options['wbcvpb_history_amount'] : 10)
	));
}
add_action( 'admin_enqueue_scripts', 'wbcvpb_enqueue_admin_scripts' );

// TinyMCE external plugins
function wbcvpb_mce_external_plugins($plugins) {
	$plugins['link'] = WBCVPB_DIR . 'assets/backend/js/mce.plugin.link.min.js';
	$plugins['hr'] = WBCVPB_DIR . 'assets/backend/js/mce.plugin.hr.min.js';
	$plugins['charmap'] = WBCVPB_DIR . 'assets/backend/js/mce.plugin.charmap.min.js';
	$plugins['searchreplace'] = WBCVPB_DIR . 'assets/backend/js/mce.plugin.searchreplace.min.js';
	$plugins['table'] = WBCVPB_DIR . 'assets/backend/js/mce.plugin.table.min.js';
	$plugins['textcolor'] = WBCVPB_DIR . 'assets/backend/js/mce.plugin.textcolor.min.js';
	return $plugins;
}
add_filter('mce_external_plugins', 'wbcvpb_mce_external_plugins');
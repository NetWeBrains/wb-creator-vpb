<?php

add_action('admin_menu', 'wbcvpb_add_admin_menu');
add_action('admin_init', 'wbcvpb_settings_init');

function wbcvpb_add_admin_menu() {
	add_options_page(
		__('WB Creator', 'wb-creator-vpb'),
		__('WB Creator', 'wb-creator-vpb'),
		'manage_options',
		'wbcvpb',
		'wbcvpb_options_page'
	);
}

function wbcvpb_options_page() {
	?>
	<div id="wbcvpb_options_page_form">
		<h2><?php _e('WB Creator - Visual Page Builder', 'wb-creator-vpb') ?></h2>
		<form action='options.php' method='post'>
			<?php
			settings_fields('wbcvpb_options_page');
			do_settings_sections('wbcvpb_options_page');
			submit_button();
			?>
		</form>
	</div>
	<?php
}

function wbcvpb_settings_init() {
	register_setting('wbcvpb_options_page', 'wbcvpb_settings');

	/*
	 * GENERAL
	 */
	add_settings_section(
		'wbcvpb_shortcodes_settings',
		__('General', 'wb-creator-vpb'),
		'',
		'wbcvpb_options_page'
	);

	/*
	 * Default editor
	 */
	add_settings_field(
		'wbcvpb_is_default',
		__('Default Editor', 'wb-creator-vpb'),
		'wbcvpb_is_default_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_settings'
	);
	function wbcvpb_is_default_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_is_default = (isset($options['wbcvpb_is_default'])) ? $options['wbcvpb_is_default'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_is_default]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_is_default]' id='wbcvpb_settings[wbcvpb_is_default]' <?php checked($wbcvpb_is_default, 1); ?> value='1'>
			<?php _e('Use the Creator as Default Editor', 'wb-creator-vpb') ?>
		</label>
		<p class="description"><?php _e('When creating new page or post activate WB Creator immediately instead default WordPress WYSIWYG editor.', 'wb-creator-vpb') ?></p>
		<?php
	}

	/*
	 * Select Theme
	 */
	if(!is_file(get_stylesheet_directory().'/css/wbcvpb-shortcodes.css')){
		add_settings_field(
			'wbcvpb_style',
			__("Select Theme", 'wb-creator-vpb'),
			'wbcvpb_theme_render',
			'wbcvpb_options_page',
			'wbcvpb_shortcodes_settings'
		);
		function wbcvpb_theme_render() {
			$options = get_option( 'wbcvpb_settings' );
			$wbcvpb_style = (isset($options['wbcvpb_style'])) ? $options['wbcvpb_style'] : '';
			?>
			<select name="wbcvpb_settings[wbcvpb_style]">
				<?php
				echo '<option value="default.css" '.selected('default.css',$wbcvpb_style).'>'.__('Default Style', 'wb-creator-vpb').'</option>';
				$styles_directory = realpath(dirname(__FILE__) . '/..') . '/css/themes';
				$files = scandir($styles_directory);
				foreach($files as $file) {
					if($file!='default.css' && is_file($styles_directory . '/'.$file)){
						$style_metadata = get_file_data( $styles_directory . '/'.$file, array('style' => 'Style Name'));
						$option_name_out = (!empty($style_metadata['style'])) ? $style_metadata['style'] : $file;
						echo '<option value="'.$file.'" '.selected($file,$wbcvpb_style).'>'.$option_name_out.'</option>';
					}
				}
				?>
			</select>
			<p class="description"><?php _e('Select global elements theme', 'wb-creator-vpb') ?></p>
			<?php
		}
	}

	/*
	 * Disable WB Creator
	 */
	add_settings_field(
		'wbcvpb_disable_on',
		__("Disable Creator on", 'wb-creator-vpb'),
		'wbcvpb_disable_on_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_settings'
	);
	function wbcvpb_disable_on_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_disable_on = (isset($options['wbcvpb_disable_on'])) ? $options['wbcvpb_disable_on'] : '';
		?>
		<input type='text' name='wbcvpb_settings[wbcvpb_disable_on]' value='<?php echo esc_attr($wbcvpb_disable_on); ?>'>
		<p class="description"><?php _e('Coma-separated list of post types for which you want to disable the Creator<br><small>(e.g. post, page, slider, section)</small>', 'wb-creator-vpb') ?></p>
		<?php
	}

	/*
	 * Excerpt content
	 */
	add_settings_field(
		'wbcvpb_excerpt',
		__('Excerpt content', 'wb-creator-vpb'),
		'wbcvpb_excerpt_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_settings'
	);
	function wbcvpb_excerpt_render() {
		$options = get_option( 'wbcvpb_settings' );
		$wbcvpb_excerpt = (isset($options['wbcvpb_excerpt'])) ? $options['wbcvpb_excerpt'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_excerpt]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_excerpt]' id='wbcvpb_settings[wbcvpb_excerpt]' <?php checked( $wbcvpb_excerpt, 1); ?> value='1'>
			<?php _e('Show shortcode content in excerpt', 'wb-creator-vpb' ) ?>
		</label>
		<p class="description"><?php _e('Content inside shortcode is not visible in excerpt by default. To enable it use this option. It will use custom function for excerpt output.', 'wb-creator-vpb') ?></p>
		<?php
	}

	/*
	 * Developer Mode
	 */
	add_settings_field(
		'wbcvpb_developer',
		__('Developer Mode', 'wb-creator-vpb'),
		'wbcvpb_developer_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_settings'
	);
	function wbcvpb_developer_render() {
		$options = get_option( 'wbcvpb_settings' );
		$wbcvpb_developer = (isset($options['wbcvpb_developer'])) ? $options['wbcvpb_developer'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_developer]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_developer]' id='wbcvpb_settings[wbcvpb_developer]' <?php checked( $wbcvpb_developer, 1 ); ?> value='1'>
			<?php _e('Enable', 'wb-creator-vpb') ?>
		</label>
		<p class="description"><?php _e('Enable developer mode and show content holder meta box.', 'wb-creator-vpb') ?></p>
		<?php
	}

	/*
	 * Additional Sidebars
	 */
	add_settings_field(
		'wbcvpb_sidebars',
		__('Additional Sidebars', 'wb-creator-vpb'),
		'wbcvpb_sidebars_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_settings'
	);
	function wbcvpb_sidebars_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_sidebars = (isset($options['wbcvpb_sidebars'])) ? $options['wbcvpb_sidebars'] : '';
		?>
		<input type='text' name='wbcvpb_settings[wbcvpb_sidebars]' value='<?php echo esc_attr($wbcvpb_sidebars); ?>'>
		<p class="description"><?php _e('Coma-separated list of sidebars to add. You can add widgets in created sidebars and use sidebars in Sidebar element - this way all widgets are supported by The Creator plugin.<br><small>(e.g. My First Sidebar, My Second Sidebar)</small>', 'wb-creator-vpb') ?></p>
		<?php
	}

	/*
	 * Tooltip Opacity
	 */
	add_settings_field(
		'wbcvpb_tipsy_opacity',
		__('Tooltip Opacity', 'wb-creator-vpb'),
		'wbcvpb_tipsy_opacity_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_settings'
	);
	function wbcvpb_tipsy_opacity_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_tipsy_opacity = (isset($options['wbcvpb_tipsy_opacity'])) ? $options['wbcvpb_tipsy_opacity'] : '0.8';
		?>
		<input type='text' name='wbcvpb_settings[wbcvpb_tipsy_opacity]' value='<?php echo esc_attr($wbcvpb_tipsy_opacity); ?>'>
		<p class="description"><?php _e('Balloon tooltip opacity. Values from 0.0 to 1.0, default is 0.8.', 'wb-creator-vpb') ?></p>
		<?php
	}

	/**
		History Amount
	**/
	add_settings_field(
		'wbcvpb_history_amount',
		__( 'History Amount', 'wb-creator-vpb' ),
		'wbcvpb_history_amount_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_settings'
	);
	function wbcvpb_history_amount_render(  ) {
		$options = get_option( 'wbcvpb_settings' );
		$wbcvpb_history_amount = (isset($options['wbcvpb_history_amount'])) ? $options['wbcvpb_history_amount'] : '10';
		?>
		<input type='text' name='wbcvpb_settings[wbcvpb_history_amount]' value='<?php echo esc_attr($wbcvpb_history_amount); ?>'>
		<p class="description"><?php _e( 'Set the amount of states stored for undo feature.<br><small>(default 10)</small>', 'wb-creator-vpb' ) ?></p>
		<?php
	}

	/**
		Custom Map Styling
	**/
	add_settings_field(
		'wbcvpb_custom_map_style',
		__('Custom Map Styling', 'wb-creator-vpb'),
		'wbcvpb_custom_map_style_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_settings'
	);
	function wbcvpb_custom_map_style_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_custom_map_style = (isset($options['wbcvpb_custom_map_style'])) ? $options['wbcvpb_custom_map_style'] : '';
		?>
		<textarea id="maps_editor" class='large-text code' name='wbcvpb_settings[wbcvpb_custom_map_style]' cols='50' rows='10'><?php echo esc_textarea($wbcvpb_custom_map_style); ?></textarea>
		<p class="description"><?php _e('For more details please check Google Maps API v3 documentation. To create custom map style JSON you can use <a href="http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html">Maps API style Wizard</a> or use some template from <a href="http://snazzymaps.com/">Snazzy Maps</a>', 'wb-creator-vpb') ?></p>
		<?php
	}

	/*
	 * FONT ICONS
	 */
	add_settings_section(
		'wbcvpb_shortcodes_icons',
		__('Font Icons', 'wb-creator-vpb'),
		'wbcvpb_icons_section_render',
		'wbcvpb_options_page'
	);
	function wbcvpb_icons_section_render(  ) {
		echo '<p class="wbcvpb_options_section_intro">'.__('Here you can enable font icon packs that you wish to use and see complete list of icons with their names. You can also use icon name of any similar icon pack that is bundled with theme.', 'wb-creator-vpb').'</p>';
	}

	/*
	 * BigMug
	 */
	add_settings_field(
		'wbcvpb_enable_big_mug',
		__('BigMug', 'wb-creator-vpb'),
		'wbcvpb_enable_big_mug_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_icons'
	);
	function wbcvpb_enable_big_mug_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_enable_big_mug = (isset($options['wbcvpb_enable_big_mug'])) ? $options['wbcvpb_enable_big_mug'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_enable_big_mug]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_enable_big_mug]' id='wbcvpb_settings[wbcvpb_enable_big_mug]' <?php checked($wbcvpb_enable_big_mug, 1); ?> value='1'>
			<?php _e('Enable BigMug Icons', 'wb-creator-vpb') ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e('Check this to enable BigMug icons. Complete list of icons and their names can be found', 'wb-creator-vpb') ?> <a href="<?php echo WBCVPB_DIR.'assets/frontend/css/fonts/big_mug/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Big Mug (font: big_mug)"  class="thickbox" ><?php _e( 'here', 'wb-creator-vpb' ) ?></a>.</p>
		<?php
	}

	/*
	 * Entypo
	 */
	add_settings_field(
		'wbcvpb_enable_entypo',
		__('Entypo', 'wb-creator-vpb'),
		'wbcvpb_enable_entypo_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_icons'
	);
	function wbcvpb_enable_entypo_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_enable_entypo = (isset($options['wbcvpb_enable_entypo'])) ? $options['wbcvpb_enable_entypo'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_enable_entypo]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_enable_entypo]' id='wbcvpb_settings[wbcvpb_enable_entypo]' <?php checked($wbcvpb_enable_entypo, 1); ?> value='1'>
			<?php _e( 'Enable Entypo Icons', 'wb-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e('Check this to enable Entypo icons. Complete list of icons and their names can be found', 'wb-creator-vpb') ?> <a href="<?php echo WBCVPB_DIR.'assets/frontend/css/fonts/entypo/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Entypo (font: entypo)"  class="thickbox" ><?php _e( 'here', 'wb-creator-vpb' ) ?></a>.</p>
		<?php
	}


	/*
	 * Elegant
	 */
	add_settings_field(
		'wbcvpb_enable_elegant',
		__('Elegant', 'wb-creator-vpb'),
		'wbcvpb_enable_elegant_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_icons'
	);
	function wbcvpb_enable_elegant_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_enable_elegant = (isset($options['wbcvpb_enable_elegant'])) ? $options['wbcvpb_enable_elegant'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_enable_elegant]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_enable_elegant]' id='wbcvpb_settings[wbcvpb_enable_elegant]' <?php checked($wbcvpb_enable_elegant, 1); ?> value='1'>
			<?php _e('Enable Elegant Icons', 'wb-creator-vpb') ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e('Check this to enable Elegant icons. Complete list of icons and their names can be found', 'wb-creator-vpb') ?> <a href="<?php echo WBCVPB_DIR.'assets/frontend/css/fonts/elegant/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Elegant (font: elegant)"  class="thickbox" ><?php _e( 'here', 'wb-creator-vpb' ) ?></a>.</p>
		<?php
	}

	/*
	 * FontAwesome
	 */
	add_settings_field(
		'wbcvpb_enable_font_awesome',
		__('FontAwesome', 'wb-creator-vpb'),
		'wbcvpb_enable_font_awesome_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_icons'
	);
	function wbcvpb_enable_font_awesome_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_enable_font_awesome = (isset($options['wbcvpb_enable_font_awesome'])) ? $options['wbcvpb_enable_font_awesome'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_enable_font_awesome]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_enable_font_awesome]' id='wbcvpb_settings[wbcvpb_enable_font_awesome]' <?php checked($wbcvpb_enable_font_awesome, 1); ?> value='1'>
			<?php _e( 'Enable FontAwesome Icons', 'wb-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable FontAwesome icons. Complete list of icons and their names can be found', 'wb-creator-vpb' ) ?> <a href="<?php echo WBCVPB_DIR.'assets/frontend/css/fonts/font_awesome/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Font Awesome (font: font_awesome)"  class="thickbox" ><?php _e( 'here', 'wb-creator-vpb' ) ?></a>.</p>
		<?php
	}

	/*
	 * Google Material
	 */
	add_settings_field(
		'wbcvpb_enable_google_material',
		__('Google Material', 'wb-creator-vpb'),
		'wbcvpb_enable_google_material_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_icons'
	);
	function wbcvpb_enable_google_material_render(  ) {
		$options = get_option( 'wbcvpb_settings' );
		$wbcvpb_enable_google_material = (isset($options['wbcvpb_enable_google_material'])) ? $options['wbcvpb_enable_google_material'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_enable_google_material]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_enable_google_material]' id='wbcvpb_settings[wbcvpb_enable_google_material]' <?php checked($wbcvpb_enable_google_material, 1); ?> value='1'>
			<?php _e( 'Enable Google Material Icons', 'wb-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e('Check this to enable Google Material icons. Complete list of icons and their names can be found', 'wb-creator-vpb') ?> <a href="<?php echo WBCVPB_DIR.'assets/frontend/css/fonts/google_material/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Google Material (font: google_material)"  class="thickbox" ><?php _e( 'here', 'wb-creator-vpb' ) ?></a>.</p>
		<?php
	}

	/*
	 * Icomoon
	 */
	add_settings_field(
		'wbcvpb_enable_icomoon',
		__('Icomoon', 'wb-creator-vpb'),
		'wbcvpb_enable_icomoon_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_icons'
	);
	function wbcvpb_enable_icomoon_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_enable_icomoon = (isset($options['wbcvpb_enable_icomoon'])) ? $options['wbcvpb_enable_icomoon'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_enable_icomoon]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_enable_icomoon]' id='wbcvpb_settings[wbcvpb_enable_icomoon]' <?php checked($wbcvpb_enable_icomoon, 1); ?> value='1'>
			<?php _e('Enable Icomoon Icons', 'wb-creator-vpb') ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e('Check this to enable Icomoon icons. Complete list of icons and their names can be found', 'wb-creator-vpb') ?> <a href="<?php echo WBCVPB_DIR.'assets/frontend/css/fonts/icomoon/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Icomoon (font: icomoon)"  class="thickbox" ><?php _e( 'here', 'wb-creator-vpb' ) ?></a>.</p>
		<?php
	}

	/*
	 * Ionicon
	 */
	add_settings_field(
		'wbcvpb_enable_ionicon',
		__('Ionicon', 'wb-creator-vpb'),
		'wbcvpb_enable_ionicon_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_icons'
	);
	function wbcvpb_enable_ionicon_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_enable_ionicon = (isset($options['wbcvpb_enable_ionicon'])) ? $options['wbcvpb_enable_ionicon'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_enable_ionicon]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_enable_ionicon]' id='wbcvpb_settings[wbcvpb_enable_ionicon]' <?php checked($wbcvpb_enable_ionicon, 1); ?> value='1'>
			<?php _e( 'Enable Ionicon Icons', 'wb-creator-vpb' ) ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e('Check this to enable Ionicon icons. Complete list of icons and their names can be found', 'wb-creator-vpb') ?> <a href="<?php echo WBCVPB_DIR.'assets/frontend/css/fonts/ionicon/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Ionicon (font: ionicon)"  class="thickbox" ><?php _e( 'here', 'wb-creator-vpb' ) ?></a>.</p>
		<?php
	}

	/*
	 * Typicons
	 */
	add_settings_field(
		'wbcvpb_enable_typicons',
		__('Typicons', 'wb-creator-vpb'),
		'wbcvpb_enable_typicons_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_icons'
	);
	function wbcvpb_enable_typicons_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_enable_typicons = (isset($options['wbcvpb_enable_typicons'])) ? $options['wbcvpb_enable_typicons'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_enable_typicons]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_enable_typicons]' id='wbcvpb_settings[wbcvpb_enable_typicons]' <?php checked($wbcvpb_enable_typicons, 1); ?> value='1'>
			<?php _e('Enable Typicons Icons', 'wb-creator-vpb') ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e( 'Check this to enable Typicons icons. Complete list of icons and their names can be found', 'wb-creator-vpb' ) ?> <a href="<?php echo WBCVPB_DIR.'assets/frontend/css/fonts/typicons/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Typicons (font: typicons)"  class="thickbox" ><?php _e( 'here', 'wb-creator-vpb' ) ?></a>.</p>
		<?php
	}

	/*
	 * WebHostingHubGlyphs
	 */
	add_settings_field(
		'wbcvpb_enable_whhg',
		__('WebHostingHubGlyphs', 'wb-creator-vpb'),
		'wbcvpb_enable_whhg_render',
		'wbcvpb_options_page',
		'wbcvpb_shortcodes_icons'
	);
	function wbcvpb_enable_whhg_render() {
		$options = get_option('wbcvpb_settings');
		$wbcvpb_enable_whhg = (isset($options['wbcvpb_enable_whhg'])) ? $options['wbcvpb_enable_whhg'] : 0;
		?>
		<label for="wbcvpb_settings[wbcvpb_enable_whhg]">
			<input type='checkbox' name='wbcvpb_settings[wbcvpb_enable_whhg]' id='wbcvpb_settings[wbcvpb_enable_whhg]' <?php checked( $wbcvpb_enable_whhg, 1 ); ?> value='1'>
			<?php _e('Enable WebHostingHubGlyphs Icons', 'wb-creator-vpb') ?>
		</label>
		<?php add_thickbox(); ?>
		<p class="description"><?php _e('Check this to enable WebHostingHubGlyphs icons. Complete list of icons and their names can be found', 'wb-creator-vpb') ?> <a href="<?php echo WBCVPB_DIR.'assets/frontend/css/fonts/whhg/demo.html?TB_iframe=true&width=650&height=550' ?>" title="Web Hosting Hub Glyphs (font: whhg)"  class="thickbox" ><?php _e( 'here', 'wb-creator-vpb' ) ?></a>.</p>
		<?php
	}
}
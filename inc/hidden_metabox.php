<?php

$post_id_post = isset($_POST['post_ID']) ? $_POST['post_ID'] : '' ;
$post_id = isset($_GET['post']) ? $_GET['post'] : $post_id_post ;

if (!function_exists('wbcvpb_add_meta_box')){
	function wbcvpb_add_meta_box(){
		$options = get_option( 'wbcvpb_settings' );
		$wbcvpb_disable_on = (isset($options['wbcvpb_disable_on'])) ? explode(',', $options['wbcvpb_disable_on'])  : array();
		$wbcvpb_disable_on = array_map('trim',$wbcvpb_disable_on);
		$default_types = array( 'post', 'page');
		$custom_post_types = get_post_types( array('_builtin' => false) ); 
		$activate_on = array_merge($default_types, $custom_post_types);
		$activate_on = array_diff($activate_on, $wbcvpb_disable_on);
		foreach ($activate_on as $page){
			if(post_type_supports($page, 'editor')){
				add_meta_box('wbcvpb_hidden_metabox', esc_attr__('The Creator Content', 'wb-creator-vpb'), 'wbcvpb_construct_hidden_meta_box', $page, 'normal', 'high');
			}
		} 
	}
}
add_action('add_meta_boxes', 'wbcvpb_add_meta_box');

if (!function_exists( 'wbcvpb_construct_hidden_meta_box')){
	function wbcvpb_construct_hidden_meta_box( $post ){
		$options = get_option( 'wbcvpb_settings' );
		$wbcvpb_developer_mode = (isset($options['wbcvpb_developer'])) ? $options['wbcvpb_developer'] : 0;
		$values = get_post_custom( $post->ID );
		$wbcvpb_content = (isset($values['wbcvpb_content'][0])) ? $values['wbcvpb_content'][0] : '';
		$wbcvpb_wbc_activated = (isset($values["wbcvpb_wbc_activated"][0]) && $values["wbcvpb_wbc_activated"][0]==1) ? 1 : 0;
		$wbcvpb_is_default = (isset($options["wbcvpb_is_default"]) && $options["wbcvpb_is_default"]==1) ? ' class="wbcvpb_is_default"' : '';
		wp_nonce_field( 'my_meta_box_sidebar_nonce', 'meta_box_sidebar_nonce' );
		?>  
		<p>  
			<textarea name="wbcvpb_content" id="wbcvpb_content" data-mode="<?php echo ($wbcvpb_developer_mode==1) ? 'developer' : 'standard'; ?>"><?php echo $wbcvpb_content;?></textarea>
			<textarea id="wbcvpb_initial_content"><?php echo $post->post_content;?></textarea>
		</p>
		<p>  
			<label><input type="checkbox" name="wbcvpb_wbc_activated" id="wbcvpb_wbc_activated"<?php echo $wbcvpb_is_default; ?> value="1" <?php checked($wbcvpb_wbc_activated, 1); ?>>
				<?php _e('The Creator Activated', 'wb-creator-vpb');?>
			</label>
			<?php echo ($wbcvpb_wbc_activated==1) ? '<style type="text/css">#postdivrich{display:none;}</style>' : ''; ?>
		</p>
		<?php
	}
}

if (!function_exists( 'wbcvpb_save_hidden_meta_box')){
	function wbcvpb_save_hidden_meta_box( $post_id ){
		if(defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE){
			return; 
		}
		if(!isset($_POST['wbcvpb_content']) || !wp_verify_nonce($_POST['meta_box_sidebar_nonce'], 'my_meta_box_sidebar_nonce')) {
			return; 
		}
		if(!current_user_can( 'edit_pages')) {
			return;  
		}
		if(isset($_POST['wbcvpb_content'])){
			update_post_meta($post_id, 'wbcvpb_content', $_POST['wbcvpb_content']);
		}

		$wbcvpb_wbc_activated = (isset($_POST["wbcvpb_wbc_activated"]) && $_POST["wbcvpb_wbc_activated"]==1) ? 1 : 0;
		update_post_meta($post_id, "wbcvpb_wbc_activated", $wbcvpb_wbc_activated);
	}
}
add_action( 'save_post', 'wbcvpb_save_hidden_meta_box' );



<?php 

// General shortcodes
if(!function_exists('wbcvpb_shortcodes')){
	function wbcvpb_shortcodes( $shortcode = false ) {
		global $wbcvpb_shortcodes;
		if ( $shortcode ){
			return $wbcvpb_shortcodes[$shortcode];
		} else{
			ksort($wbcvpb_shortcodes);
			return $wbcvpb_shortcodes;
		}
	}
}

// 3rd party shortcodes
if(!function_exists('wbcvpb_3rd_party')){
	function wbcvpb_3rd_party() {
		global $wbcvpb_shortcodes;
		$return = array();
		foreach($wbcvpb_shortcodes as $shortcode => $att){
			if(isset($att['third_party']) && $att['third_party'] == 1){
				$return[] = $shortcode;
			}
		}
		$return = implode(',', $return);
		return $return;
	}
}

if(!function_exists('wbcvpb_the_content_filter')){
	function wbcvpb_the_content_filter($content) {
		foreach ( wbcvpb_shortcodes() as $name => $shortcode ) {
			$shortcode_list[] = $name;
			$shortcode_list[] = str_replace('_wbc', '_WBC', $name);
		}
		$block = join("|", $shortcode_list);
		$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);
		$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)?/","[/$2]",$rep);
		return $rep;
	}
}
add_filter("the_content", "wbcvpb_the_content_filter");


if(!function_exists('wbcvpb_shortcode_names')){
	function wbcvpb_shortcode_names() {
		global $wbcvpb_shortcodes;
		$return = array();
		foreach($wbcvpb_shortcodes as $shortcode => $att){
			$return[$shortcode] = (isset($att['name'])) ? $att['name'] : '';
		}
		return $return;
	}
}

if (!function_exists('wbcvpb_extract_attributes')){
	function wbcvpb_extract_attributes ($shortcode) {
		foreach($GLOBALS['wbcvpb_shortcodes'][$shortcode]['attributes'] as $att => $val){
			$defaults[$att] = (isset($val['default'])) ? $val['default'] : '';
		}
		return $defaults;
	}
}


if(!function_exists('wbcvpb_current_page_url')){
	function wbcvpb_current_page_url() {
		$pageURL = 'http';
		if( isset($_SERVER["HTTPS"]) ) {
			if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		}
		return $pageURL;
	}
}

if(!function_exists('wbcvpb_get_current_post_type')){
	function wbcvpb_get_current_post_type() {
		global $post, $typenow, $current_screen;
		//we have a post so we can just get the post type from that
		if ( $post && $post->post_type )
		return $post->post_type;

		//check the global $typenow - set in admin.php
		elseif( $typenow )
		return $typenow;

		//check the global $current_screen object - set in sceen.php
		elseif( $current_screen && $current_screen->post_type )
		return $current_screen->post_type;

		//lastly check the post_type querystring
		elseif( isset( $_REQUEST['post_type'] ) )
		return sanitize_key( $_REQUEST['post_type'] );

		//we do not know the post type!
		return null;
	}
}

if(!function_exists('wbcvpb_trim_excerpt_do_shortcode')){
	function wbcvpb_trim_excerpt_do_shortcode($text) {
		$raw_excerpt = $text;
		if ( '' == $text ) {
			$text = get_the_content('');
			$text = do_shortcode( $text );
			$text = apply_filters('the_content', $text);
			$text = str_replace(']]>', ']]&gt;', $text);
			$text = strip_tags($text);
			$excerpt_length = apply_filters('excerpt_length', 55);
			$excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
			$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
			if ( count($words) > $excerpt_length ) {
				array_pop($words);
				$text = implode(' ', $words);
				$text = $text . $excerpt_more;
			} else {
				$text = implode(' ', $words);
			}
		}
		return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
	}
}
$options = get_option( 'wbcvpb_settings' );
$wbcvpb_excerpt = (isset($options['wbcvpb_excerpt']) && $options['wbcvpb_excerpt']==1) ? 1  : 0;
if($wbcvpb_excerpt){
	remove_filter('get_the_excerpt', 'wp_trim_excerpt');
	add_filter('get_the_excerpt', 'wbcvpb_trim_excerpt_do_shortcode');
}

if (!function_exists('wbcvpb_name_to_id')){
	function wbcvpb_name_to_id($name){
		$class = strtolower(str_replace(array(' ',',','.','"',"'",'/',"\\",'+','=',')','(','*','&','^','%','$','#','@','!','~','`','<','>','?','[',']','{','}','|',':',),'',$name));
		return $class;
	}
}

if (!function_exists('wbcvpb_allowed_tags')) {
	function wbcvpb_allowed_tags(){
		return array(
			'a' => array(
		        'href' => array(),
		        'title' => array()
		    ),
		    'br' => array(),
		    'em' => array(),
		    'strong' => array(),
		    'i' => array(
		    	'class' => array()
		    ),
		);
	}
}
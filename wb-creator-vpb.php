<?php
/*
Plugin Name: WB Creator - Visual Page Builder
Plugin URI: http://webrains.net
Description: Visual page builder (drag and drop) containing great collection of animated shortcodes with paralax effects and video backgrounds
Author: WeBrains
Author URI: http://webrains.net
Version: 1.0.0
*/

define('WBCVPB_DIR', plugin_dir_url( __FILE__ ));
define('WBCVPB_VERSION', '1.0.0');

global $wbcvpb_shortcodes;
$wbcvpb_shortcodes = array();

require_once 'inc/options_page.php';
require_once 'inc/functions.php';
require_once 'inc/core_shortcodes.php';
require_once 'inc/hidden_metabox.php';
require_once 'inc/enqueue_frontend_scripts.php';
require_once 'inc/enqueue_backend_scripts.php';

if (!function_exists('wbcvpb_include_shortcodes')){
    function wbcvpb_include_shortcodes(){
        global $wbcvpb_shortcodes;
        if (!current_theme_supports('wb-creator-vpb')) {
            $files = scandir(dirname( __FILE__ ) . '/shortcodes');
            foreach($files as $file) {
                if(is_file(dirname( __FILE__ ) . '/shortcodes/'.$file)){
                    include_once (dirname( __FILE__ ) . '/shortcodes/'.$file);
                }
            }
        }

        $files = scandir(dirname( __FILE__ ) . '/shortcodes/supported_plugins');
        foreach($files as $file) {
            if(is_file(dirname( __FILE__ ) . '/shortcodes/supported_plugins/'.$file)){
                include_once (dirname( __FILE__ ) . '/shortcodes/supported_plugins/'.$file);
            }
        }
    }
}
add_action('init', 'wbcvpb_include_shortcodes');

if (!function_exists('wbcvpb_register_shortcodes')){
    function wbcvpb_register_shortcodes() {
        global $wbcvpb_shortcodes;
        add_filter('widget_text', 'do_shortcode');
        load_plugin_textdomain('wb-creator-vpb', false, dirname(plugin_basename( __FILE__ )).'/languages/');

        foreach (wbcvpb_shortcodes() as $shortcode=>$params) {
            if (empty($params['third_party']) || $params['third_party']!=1){
                add_shortcode( $shortcode, 'wbcvpb_'.$shortcode.'_shortcode');
            }
            if (isset($params['nesting']) && $params['nesting']!=''){
                add_shortcode( $shortcode.'_child', 'wbcvpb_'.$shortcode.'_shortcode');
            }
        }
    }
}
add_action('init', 'wbcvpb_register_shortcodes', 50);

if (!function_exists('wbcvpb_add_sidebars')){
    function wbcvpb_add_sidebars() {
        $options = get_option( 'wbcvpb_settings' );
        $wbcvpb_sidebars = (isset($options['wbcvpb_sidebars'])) ? explode(',', $options['wbcvpb_sidebars'])  : array();
        $wbcvpb_sidebars = array_map('trim',$wbcvpb_sidebars);
        $wbcvpb_sidebars = array_filter($wbcvpb_sidebars);

        if(is_array($wbcvpb_sidebars)){
            foreach($wbcvpb_sidebars as $sidebar){
                register_sidebar(array(
                    'name'=>$sidebar,
                    'id'            => 'wbc_'.wbcvpb_name_to_id($sidebar),
                    'before_widget' => '<div id="%1$s" class="widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<div class="sidebar-widget-heading"><h3>',
                    'after_title' => '</h3></div>',
                ));
            }
        }
    }
}
add_action('widgets_init', 'wbcvpb_add_sidebars');

if (!function_exists('wbcvpb_save_layout')){
    function wbcvpb_save_layout(){
        global $wpdb;
        add_option( 'wbcvpb_shortcodes_layouts', '', '', 'no' );
        $layouts = get_option( 'wbcvpb_shortcodes_layouts', array() );
        $name = $_POST['name'];
        if($_POST['source']=='new'){
            $i = 1;
            while(isset($layouts[$name])){
                $i++;
                $name = $_POST['name'] . '_' . $i;
            }
        }
        $layouts[$name]=$_POST['layout'];
        update_option('wbcvpb_shortcodes_layouts', $layouts);
        die(__('Layout Saved', 'wb-creator-vpb'));
    }
}
add_action('wp_ajax_wbcvpb_save_layout', 'wbcvpb_save_layout');

if (!function_exists('wbcvpb_delete_layout')){
    function wbcvpb_delete_layout(){
        global $wpdb;
        $name = $_POST['name'];
        $layouts = get_option('wbcvpb_shortcodes_layouts', '');
        if(isset($layouts[$name])){
            unset($layouts[$name]);
            update_option('wbcvpb_shortcodes_layouts', $layouts);
            $out=__('Layout Deleted', 'wb-creator-vpb');
        }
        else{
            $out=__('Layout doesn\'t exist', 'wb-creator-vpb');
        }
        die($out);
    }
}
add_action('wp_ajax_wbcvpb_delete_layout', 'wbcvpb_delete_layout');

if (!function_exists('wbcvpb_load_layout')){
    function wbcvpb_load_layout(){
        global $wpdb;
        $layouts = get_option('wbcvpb_shortcodes_layouts', '');
        $out = stripslashes($layouts[$_POST['selected_layout']]);
        die($out);
    }
}
add_action('wp_ajax_wbcvpb_load_layout', 'wbcvpb_load_layout');

if (!function_exists('wbcvpb_layouts_list')){
    function wbcvpb_layouts_list(){
        global $wpdb;
        $layouts = get_option('wbcvpb_shortcodes_layouts', '');
        $out = array();
        if(is_array($layouts)){
            foreach ($layouts as $name => $value) {
                $out[] = $name;
            }
        }
        natcasesort($out);
        $out = implode('|', $out);
        die($out);
    }
}
add_action('wp_ajax_wbcvpb_layouts_list', 'wbcvpb_layouts_list');

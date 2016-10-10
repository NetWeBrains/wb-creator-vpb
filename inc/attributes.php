<?php

/** This file generates list of all used shortcodes and their attributes so it can be used in documentation **/

require_once('../../../../../wp-load.php');

if (!is_user_logged_in()){
    die("You Must Be Logged In to Access This");
}
if( ! current_user_can('edit_files')) {
    die("Sorry you are not authorized to access this file");
}

global $wbcvpb_shortcodes;

foreach($wbcvpb_shortcodes as $shortcode => $value){
	$parent ='n/a';
	foreach($wbcvpb_shortcodes as $s => $v){
		if (isset($v['child']) && $v['child'] == $shortcode) {
			$parent = '['.$s.']';
		}
	}
	echo'<h4><strong>'.$value['name'].'</strong></h4>';
	echo'<p class="shortcode_meta">Shortcode: ['.$shortcode.'] &nbsp;&nbsp;/&nbsp;&nbsp;Children: '.((isset($value['child']))?'['.$value['child'].']':'n/a').'&nbsp;&nbsp;/&nbsp;&nbsp;Parent: '.$parent.' &nbsp;&nbsp;/&nbsp;&nbsp;</p>';
	if(isset($value['attributes'])){
		echo '<table>';
		echo '<tr><th style="width:30%;">ATTRIBUTE</th><th style="width:20%;">DEFAULT</th><th style="width:50%;">DESCRIPTION</th></tr>';
		foreach($value['attributes'] as $attribute => $att_val){
			echo '<tr><td>'.$attribute.'</td><td>'.(isset($att_val['default'])?$att_val['default']:'').'</td><td>'.((isset($att_val['description']))?$att_val['description']:'').'</td></tr>';
		}
		echo'</table>';
	}
	else{
		echo 'Shortcode doesn\'t have attributes';
	}
}
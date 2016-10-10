<?php

/*********** Shortcode: Email Link ************************************************************/

$wbcvpb_shortcodes['email_wbc'] = array(
	'name' => esc_html__('Email Link', 'the-creator-vpb'),
	'description' => esc_html__('This shortcode will hide email address form spam bots using JavaScript method', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => ' pi-email-link',
	'category' =>  esc_html__('Social', 'the-creator-vpb'),
	'attributes' => array(
		'email' => array(
			'description' => esc_html__('Email Address', 'the-creator-vpb'),
		),
		'cloak' => array(
			'default' => '1',
			'type' => 'checkbox',
			'description' => esc_html__('Cloak Email from Spam Bots', 'the-creator-vpb'),
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'the-creator-vpb'),
			'type' => 'icon',
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
function wbcvpb_email_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('email_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$icon_output = ($icon!='') ? '<i class="'.esc_attr($icon).'"></i> ':'';

	if ($cloak!='1'){
		return '<a href="'.esc_url('mailto:'.$email).'" '.esc_attr($id_out).' '.esc_attr($class_out).' >'.$icon_output.''.$email.'</a>';
	}
	else{
		$email=explode('@',esc_attr($email));
		return $icon_output.'<script>
			document.write (\'<A HREF="mai\')
			document.write (\'lto:'.$email[0].'\')
			document.write (\'&#64;\')
			document.write (\''.$email[1].'">'.$email[0].'\')
			document.write (\'&#64;\')
			document.write (\''.$email[1].'</A>\')
		</script>';
	}
}



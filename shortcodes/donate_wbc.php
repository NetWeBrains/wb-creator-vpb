<?php

/*********** Shortcode: PayPal Donate ************************************************************/

$wbcvpb_shortcodes['donate_wbc'] = array(
	'name' => esc_html__('Donate PayPal Button', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-paypal',
	'category' =>  esc_html__('E-Commerce', 'the-creator-vpb'),
	'attributes' => array(
		'email' => array(
			'description' => esc_html__('Your Email', 'the-creator-vpb'),
		),
		'lc' => array(
			'default' => 'US',
			'description' => esc_html__('Locale', 'the-creator-vpb'),
		),
		'name' => array(
			'description' => esc_html__('Donation Name', 'the-creator-vpb'),
		),
		'amount' => array(
			'description' => esc_html__('Amount', 'the-creator-vpb'),
		),
		'currency' => array(
			'default' => 'USD',
			'description' => esc_html__('Currency', 'the-creator-vpb'),
		),
		'creditcard' => array(
			'default' => '0',
			'description' => esc_html__('Show Credit Cards', 'the-creator-vpb'),
			'type' => 'checkbox',
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
function wbcvpb_donate_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('donate_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$amount_return=($amount!='')?'<input type="hidden" name="amount" value="'.esc_attr($amount).'">':'';
	$creditcard_return=($creditcard=='1')?'CC':'';

	return '
	<form '.esc_attr($id_out).' '.esc_attr($class_out).' action="https://www.paypal.com/cgi-bin/webscr" method="post">
		<input type="hidden" name="cmd" value="_donations">
		<input type="hidden" name="business" value="'.esc_attr($email).'">
		<input type="hidden" name="lc" value="'.esc_attr($lc).'">
		<input type="hidden" name="item_name" value="'.esc_attr($name).'">
		'.$amount_return.'
		<input type="hidden" name="currency_code" value="'.esc_attr($currency).'">
		<input type="hidden" name="no_note" value="0">
		<input type="hidden" name="bn" value="PP-DonationsBF:btn_donateCC_LG.gif:NonHostedGuest">
		<input type="image" src="'.esc_url('https://www.paypalobjects.com/en_US/i/btn/btn_donate'.$creditcard_return.'_LG.gif').'" style="border:0px;" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" style="border:0px;" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
	</form>
	';
}

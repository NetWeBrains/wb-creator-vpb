<?php

/*********** Shortcode: Countdown ************************************************************/

$wbcvpb_shortcodes['countdown_wbc'] = array(
	'name' => esc_html__('Countdown', 'the-creator-vpb'),
	'type' => 'block',
	'icon' => 'pi-countdown',
	'category' =>  __('Content', 'the-creator-vpb'),
	'attributes' => array(
		'style' => array(
			'description' => esc_html__('Style', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'style_1' => esc_html__('Simple', 'the-creator-vpb'),
				'style_2' => esc_html__('Flip Numbers', 'the-creator-vpb'),
			),
		),
		'hide_expired_counters' => array(
			'description' => esc_html__('Hide expired counters', 'the-creator-vpb'),
			'info' => esc_html__("Don't show year, month or day counters if they have expired (e.g. hide year if it is 00)", 'the-creator-vpb'),
			'type' => 'checkbox',
			'divider' => 'true',
		),
		'year_number' => array(
			'description' => esc_html__('Year', 'the-creator-vpb'),
			'info' => esc_html__('Enter the year of date to countdown to (e.g. 2015)', 'the-creator-vpb'),
		),
		'month_number' => array(
			'description' => esc_html__('Month', 'the-creator-vpb'),
			'info' => esc_html__('Select a month of date to countdown to', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'01' => esc_html__('January', 'the-creator-vpb'),
				'02' => esc_html__('February', 'the-creator-vpb'),
				'03' => esc_html__('March', 'the-creator-vpb'),
				'04' => esc_html__('April', 'the-creator-vpb'),
				'05' => esc_html__('May', 'the-creator-vpb'),
				'06' => esc_html__('June', 'the-creator-vpb'),
				'07' => esc_html__('July', 'the-creator-vpb'),
				'08' => esc_html__('August', 'the-creator-vpb'),
				'09' => esc_html__('September', 'the-creator-vpb'),
				'10' => esc_html__('October', 'the-creator-vpb'),
				'11' => esc_html__('November', 'the-creator-vpb'),
				'12' => esc_html__('December', 'the-creator-vpb'),
				),
		),
		'day_number' => array(
			'description' => esc_html__('Day', 'the-creator-vpb'),
			'info' => esc_html__('Enter the day of date to countdown to (1-31)', 'the-creator-vpb'),
		),
		'hour_number' => array(
			'description' => esc_html__('Hours', 'the-creator-vpb'),
			'info' => esc_html__('Enter the hour of time to countdown to in 24h format (0-24)', 'the-creator-vpb'),
		),
		'minute_number' => array(
			'description' => esc_html__('Minutes', 'the-creator-vpb'),
			'info' => esc_html__('Enter the minute of time to countdown to (0-59)', 'the-creator-vpb'),
		),
		'seconds_number' => array(
			'description' => esc_html__('Seconds', 'the-creator-vpb'),
			'info' => esc_html__('Enter the second of time to countdown to (0-59)', 'the-creator-vpb'),
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
function wbcvpb_countdown_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('countdown_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$count_down_string = esc_attr($year_number) . "/" . esc_attr($month_number) . "/" . esc_attr($day_number) . " " . esc_attr($hour_number) . ":" . esc_attr($minute_number) . ":" . esc_attr($seconds_number); 

	$year_hide = $month_hide = $day_hide = '';
	if($hide_expired_counters==1){
		$year_hide = ($year_number == date('Y')) ? ' hide_expired' : '';
		$month_hide = ($year_number == date('Y') && $month_number == date('m')) ? ' hide_expired' : '';
		$day_hide = ($year_number == date('Y') && $month_number == date('m') && $day_number == date('d')) ? ' hide_expired' : '';
	}

	if($style=='style_1'){
		$return ='<div '.esc_attr($id_out).' class="wbcvpb_countdown simple_style '.esc_attr($class).'" data-value="'.esc_attr($count_down_string).'">
			<div class="wbcvpb_countdown_inner'.esc_attr($year_hide).'"><div class="simple countdown year"></div><span data-singular="'.esc_html__('Year', 'the-creator-vpb').'" data-plural="'.esc_html__('Years', 'the-creator-vpb').'">'.esc_html__('Years', 'the-creator-vpb').'</span></div>
			<div class="wbcvpb_countdown_inner'.esc_attr($month_hide).'"><div class="simple countdown month"></div><span data-singular="'.esc_html__('Month', 'the-creator-vpb').'" data-plural="'.esc_html__('Months', 'the-creator-vpb').'">'.esc_html__('Months', 'the-creator-vpb').'</span></div>
			<div class="wbcvpb_countdown_inner'.esc_attr($day_hide).'"><div class="simple countdown day"></div><span data-singular="'.esc_html__('Day', 'the-creator-vpb').'" data-plural="'.esc_html__('Days', 'the-creator-vpb').'">'.esc_html__('Days', 'the-creator-vpb').'</span></div>
			<div class="wbcvpb_countdown_inner"><div class="simple countdown hour"></div><span data-singular="'.esc_html__('Hour', 'the-creator-vpb').'" data-plural="'.esc_html__('Hours', 'the-creator-vpb').'">'.esc_html__('Hours', 'the-creator-vpb').'</span></div>
			<div class="wbcvpb_countdown_inner"><div class="simple countdown minute"></div><span data-singular="'.esc_html__('Minute', 'the-creator-vpb').'" data-plural="'.esc_html__('Minutes', 'the-creator-vpb').'">'.esc_html__('Minutes', 'the-creator-vpb').'</span></div>
			<div class="wbcvpb_countdown_inner"><div class="simple countdown second"></div><span data-singular="'.esc_html__('Second', 'the-creator-vpb').'" data-plural="'.esc_html__('Seconds', 'the-creator-vpb').'">'.esc_html__('Seconds', 'the-creator-vpb').'</span></div>
		</div>';
	
		return $return;
	} else{
		$return ='<div '.esc_attr($id_out).' class="wbcvpb_countdown flip_style '.esc_attr($class).'" data-value="'.esc_attr($count_down_string).'">
					<div class="time flip_element year flip'.esc_attr($year_hide).'">
						<div class="count curr top">00</div>
						<div class="count next top">00</div>
						<div class="count next bottom">00</div>
						<div class="count curr bottom">00</div>
						<span data-singular="'.esc_html__('Year', 'the-creator-vpb').'" data-plural="'.esc_html__('Years', 'the-creator-vpb').'">'.esc_html__('Years', 'the-creator-vpb').'</span>
					</div>
					<div class="time flip_element month flip'.esc_attr($month_hide).'">
						<div class="count curr top">00</div>
						<div class="count next top">00</div>
						<div class="count next bottom">00</div>
						<div class="count curr bottom">00</div>
						<span data-singular="'.esc_html__('Month', 'the-creator-vpb').'" data-plural="'.esc_html__('Months', 'the-creator-vpb').'">'.esc_html__('Months', 'the-creator-vpb').'</span>
					</div>
					<div class="time flip_element day flip'.esc_attr($day_hide).'">
						<div class="count curr top">00</div>
						<div class="count next top">00</div>
						<div class="count next bottom">00</div>
						<div class="count curr bottom">00</div>
						<span data-singular="'.esc_html__('Day', 'the-creator-vpb').'" data-plural="'.esc_html__('Days', 'the-creator-vpb').'">'.esc_html__('Days', 'the-creator-vpb').'</span>
					</div>
					<div class="time flip_element hour flip">
						<div class="count curr top">00</div>
						<div class="count next top">00</div>
						<div class="count next bottom">00</div>
						<div class="count curr bottom">00</div>
						<span data-singular="'.esc_html__('Hour', 'the-creator-vpb').'" data-plural="'.esc_html__('Hours', 'the-creator-vpb').'">'.esc_html__('Hours', 'the-creator-vpb').'</span>
					</div>
					<div class="time flip_element minute flip">
						<div class="count curr top">00</div>
						<div class="count next top">00</div>
						<div class="count next bottom">00</div>
						<div class="count curr bottom">00</div>
						<span data-singular="'.esc_html__('Minute', 'the-creator-vpb').'" data-plural="'.esc_html__('Minutes', 'the-creator-vpb').'">'.esc_html__('Minutes', 'the-creator-vpb').'</span>
					</div>
					<div class="time flip_element second flip">
						<div class="count curr top">00</div>
						<div class="count next top">00</div>
						<div class="count next bottom">00</div>
						<div class="count curr bottom">00</div>
						<span data-singular="'.esc_html__('Second', 'the-creator-vpb').'" data-plural="'.esc_html__('Seconds', 'the-creator-vpb').'">'.esc_html__('Seconds', 'the-creator-vpb').'</span>
					</div>
				</div>';

		return $return;
	}

}
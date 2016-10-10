<?php

/*********** Shortcode: Chart Bar ************************************************************/

$wbcvpb_shortcodes['chart_bar_wbc'] = array(
	'name' => esc_html__('Chart Bar', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-chart-bar',
	'category' =>  esc_html__('Charts', 'the-creator-vpb'),
	'child' => 'chart_bars_wbc',
	'child_button' => esc_html__('New Label', 'the-creator-vpb'),
	'child_title' => esc_html__('Label Section', 'the-creator-vpb'),
	'attributes' => array(
		'width' => array(
			'description' => esc_html__('Width', 'the-creator-vpb'),
			'info' => esc_html__('Width of the Chart, type % or px at the end of the number.', 'the-creator-vpb'),
			'default' => '100%',
		),
		'months' => array(
			'description' => esc_html__('Months', 'the-creator-vpb'),
			'info' => esc_html__('Type months (e.g. January,February,March,April,May,June,July)', 'the-creator-vpb'),
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

function wbcvpb_chart_bar_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('chart_bar_wbc'), $attributes));
	static $i = 0;
	$i++;

	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$months = str_replace(',','","',$months);
	$months_out = '"' . implode("", explode(' ', $months)) . '"';

	return '<div '.esc_attr($id_out).' '.esc_attr($class_out).' style=" width:'.esc_attr($width).'; ">
				<canvas id="bar_canvas'.$i.'"></canvas>
			</div>

		<script>
			var barChartData'.$i.' = {
				labels : ['.$months_out.'],
				datasets : [
					'.do_shortcode($content).'
				]
			}

		window.addEventListener("load",function(event) {
			var ctx'.$i.' = document.getElementById("bar_canvas'.$i.'").getContext("2d");
			window.myBar = new Chart(ctx'.$i.').Bar(barChartData'.$i.', {
				responsive: true
			});
		},false);

		</script>';
	
}

$wbcvpb_shortcodes['chart_bars_wbc'] = array(
	'name' => esc_html__('Bar Section', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'fillcolor' => array(
			'description' => esc_html__('Fill Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'default' => 'rgba(220,220,220,0.5)',
		),
		'strokecolor' => array(
			'description' => esc_html__('Stroke Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'default' => 'rgba(220,220,220,0.8)',
		),
		'highlightfill' => array(
			'description' => esc_html__('Highlight Fill Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'default' => 'rgba(220,220,220,0.75)',
		),
		'highlightstroke' => array(
			'description' => esc_html__('Highlight Stroke Color', 'the-creator-vpb'),
			'type' => 'color',
			'default' => 'rgba(220,220,220,1)',
		),
		'data' => array(
			'description' => esc_html__('Bar Points', 'the-creator-vpb'),
			'info' => esc_html__('Seperate numbers with comma (e.g. 28, 48, 40, 19, 86, 27, 90)', 'the-creator-vpb'),
		),
	),
);

function wbcvpb_chart_bars_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('chart_bars_wbc'), $attributes));
	$bar_attr = '
		fillColor : "'.esc_attr($fillcolor).'",
		strokeColor : "'.esc_attr($strokecolor).'",
		highlightFill : "'.esc_attr($highlightfill).'",
		highlightStroke : "'.esc_attr($highlightstroke).'",
		data : ['.esc_attr($data).']';

	$return = '{'.$bar_attr.'},';
  
	return $return;
}

function wbcvpb_enqueue_chart_bar_script() {
	global $post;
	if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'chart_bar_wbc') ) {
		wp_enqueue_script('chart', wbcvpb_DIR.'js/chart.js', array('jquery'), wbcvpb_VERSION, true);
	}
}
add_action( 'wp_enqueue_scripts', 'wbcvpb_enqueue_chart_bar_script' );
<?php

/*********** Shortcode: Chart Line ************************************************************/

$wbcvpb_shortcodes['chart_line_wbc'] = array(
	'name' => esc_html__('Chart Line', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-chart-line',
	'category' =>  esc_html__('Charts', 'the-creator-vpb'),
	'child' => 'chart_lines_wbc',
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

function wbcvpb_chart_line_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('chart_line_wbc'), $attributes));
	static $i = 0;
	$i++;

	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$months = str_replace(',','","',$months);
	$months_out = '"' . implode("", explode(' ', $months)) . '"';

	return '<div '.esc_attr($id_out).' '.esc_attr($class_out).' style=" width:'.esc_attr($width).'; ">
				<canvas id="line_canvas'.$i.'"></canvas>
			</div>

		<script>
			var lineChartData'.$i.' = {
				labels : ['.$months_out.'],
				datasets : [
					'.do_shortcode($content).'
				]
			}
		
		window.addEventListener("load",function(event) {
			var ctx'.$i.' = document.getElementById("line_canvas'.$i.'").getContext("2d");
			window.myLine = new Chart(ctx'.$i.').Line(lineChartData'.$i.', {
				responsive: true
			});
		},false);

		</script>';
	
}

$wbcvpb_shortcodes['chart_lines_wbc'] = array(
	'name' => esc_html__('Line Section', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'label' => array(
			'default' => 'My First dataset',
			'description' => esc_html__('Label', 'the-creator-vpb'),
		),
		'fillcolor' => array(
			'description' => esc_html__('Fill Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'default' => 'rgba(220,220,220,0.2)',
		),
		'strokecolor' => array(
			'description' => esc_html__('Stroke Color', 'the-creator-vpb'),
			'type' => 'color',
			'default' => 'rgba(220,220,220,1)',
		),
		'pointcolor' => array(
			'description' => esc_html__('Point Color', 'the-creator-vpb'),
			'type' => 'color',
			'default' => 'rgba(220,220,220,1)',
		),
		'pointstrokecolor' => array(
			'description' => esc_html__('Point Stroke Color', 'the-creator-vpb'),
			'type' => 'color',
			'default' => '#fff',
		),
		'pointhighlightfill' => array(
			'description' => esc_html__('Point Highlight Fill Color', 'the-creator-vpb'),
			'type' => 'color',
			'default' => '#fff',
		),
		'pointhighlightstroke' => array(
			'description' => esc_html__('Point Highlight Stroke Color', 'the-creator-vpb'),
			'type' => 'color',
			'default' => 'rgba(220,220,220,1)',
		),
		'data' => array(
			'description' => esc_html__('Line Points', 'the-creator-vpb'),
			'info' => esc_html__('Seperate numbers with comma (e.g. 28, 48, 40, 19, 86, 27, 90)', 'the-creator-vpb'),
		),
	),
);

function wbcvpb_chart_lines_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('chart_lines_wbc'), $attributes));
	$line_attr = '
		label: "'.esc_attr($label).'",
		fillColor : "'.esc_attr($fillcolor).'",
		strokeColor : "'.esc_attr($strokecolor).'",
		pointColor : "'.esc_attr($pointcolor).'",
		pointStrokeColor : "'.esc_attr($pointstrokecolor).'",
		pointHighlightFill : "'.esc_attr($pointhighlightfill).'",
		pointHighlightStroke : "'.esc_attr($pointhighlightstroke).'",
		data : ['.esc_attr($data).']';

	$return = '{'.$line_attr.'},';
  
	return $return;
}

function wbcvpb_enqueue_chart_line_script() {
	global $post;
	if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'chart_line_wbc') ) {
		wp_enqueue_script('chart', wbcvpb_DIR.'js/chart.js', array('jquery'), wbcvpb_VERSION, true);
	}
}
add_action( 'wp_enqueue_scripts', 'wbcvpb_enqueue_chart_line_script' );
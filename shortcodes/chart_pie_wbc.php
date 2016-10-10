<?php

/*********** Shortcode: Chart Pie ************************************************************/

$wbcvpb_shortcodes['chart_pie_wbc'] = array(
	'name' => esc_html__('Chart Pie', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-chart',
	'category' =>  esc_html__('Charts', 'the-creator-vpb'),
	'child' => 'chart_pies_wbc',
	'child_button' => esc_html__('New Label', 'the-creator-vpb'),
	'child_title' => esc_html__('Label Section', 'the-creator-vpb'),
	'attributes' => array(
		'width' => array(
			'description' => esc_html__('Width', 'the-creator-vpb'),
			'info' => esc_html__('Width of the Chart, type % or px at the end of the number.', 'the-creator-vpb'),
			'default' => '100%',
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

function wbcvpb_chart_pie_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('chart_pie_wbc'), $attributes));
	static $i = 0;
	$i++;

	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	return '<div '.esc_attr($id_out).' '.esc_attr($class_out).' style=" width:'.esc_attr($width).'; ">
				<canvas id="pie_canvas'.$i.'" style="width: 100%; height: 100%;"></canvas>
			</div>

		<script>
			var pieData'.$i.' = [
				'.do_shortcode($content).'
			];

			window.addEventListener("load",function(event) {
				var ctx'.$i.' = document.getElementById("pie_canvas'.$i.'").getContext("2d");
				window.myPie = new Chart(ctx'.$i.').Pie(pieData'.$i.');
			},false);

		</script>';
	
}

$wbcvpb_shortcodes['chart_pies_wbc'] = array(
	'name' => esc_html__('Line Section', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'value' => array(
			'default' => '300',
			'description' => esc_html__('Value', 'the-creator-vpb'),
		),
		'color' => array(
			'description' => esc_html__('Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'default' => '#F7464A',
		),
		'highlight' => array(
			'description' => esc_html__('Highlight', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'default' => '#FF5A5E',
		),
		'label' => array(
			'description' => esc_html__('Label', 'the-creator-vpb'),
			'type' => 'color',
			'default' => 'Red',
		),
	),
);

function wbcvpb_chart_pies_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('chart_pies_wbc'), $attributes));
	$pie_attr = '
		value: '.esc_attr($value).',
		color : "'.esc_attr($color).'",
		highlight : "'.esc_attr($highlight).'",
		label : "'.esc_attr($label).'",
	';

	$return = '{'.$pie_attr.'},';
  
	return $return;
}

function wbcvpb_enqueue_chart_pie_script() {
	global $post;
	if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'chart_pie_wbc') ) {
		wp_enqueue_script('chart', wbcvpb_DIR.'js/chart.js', array('jquery'), wbcvpb_VERSION, true);
	}
}
add_action( 'wp_enqueue_scripts', 'wbcvpb_enqueue_chart_pie_script' );
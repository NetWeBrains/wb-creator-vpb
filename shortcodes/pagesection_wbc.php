<?php

/*********** Shortcode: PageSection ************************************************************/

$sections = array();

$args = array( 'posts_per_page' => -1, 'post_type' => 'section' );
$sectionsList = get_posts( $args );
foreach ( $sectionsList as $post ) :
	setup_postdata( $post );
	$sections[$post->ID] = $post->post_title;
endforeach;
wp_reset_postdata();

$wbcvpb_shortcodes['pagesectiom_wbc'] = array(
	'name' => esc_html__('Page section', 'the-creator-vpb' ),
	'notice' => esc_html__('Display section', 'the-creator-vpb'),
	'type' => 'block',
	'icon' => 'pi-sidebar',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'attributes' => array(
		'name' => array(
			'default' => '',
			'type' => 'select',
			'values' => $sections,
			'description' => esc_html__('Select Section', 'the-creator-vpb'),
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
function wbcvpb_pagesectiom_wbc_shortcode( $attributes ) {
    extract(shortcode_atts(wbcvpb_extract_attributes('pagesectiom_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

    $name = trim($name);
    $postdata = get_post($name);
	$content = $postdata->post_content;

    return '<div '.esc_attr($id_out).' '.esc_attr($class_out).' >'.do_shortcode($content).'</div>';
}


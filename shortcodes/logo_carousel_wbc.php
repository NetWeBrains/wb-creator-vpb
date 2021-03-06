<?php

/*********** Shortcode: UL Wrapper ************************************************************/
$wbcvpb_shortcodes['logo_carousel_wbc'] = array(
	'name' => esc_html__('Logo carousel', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-list',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'child' => 'logo_carousel_item_wbc',
	'child_title' => esc_html__('List Item', 'the-creator-vpb'),
	'child_button' => esc_html__('Add List Item', 'the-creator-vpb'),
	'attributes' => array(
		'dummy' => array(
			'type' => 'hidden',
		),
		'animation' => array(
			'default' => '',
			'description' => esc_html__('Entrance Animation', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'' => esc_html__('None', 'the-creator-vpb'),
				'flip' => esc_html__('Flip', 'the-creator-vpb'),
				'flipInX' => esc_html__('Flip In X', 'the-creator-vpb'),
				'flipInY' => esc_html__('Flip In Y', 'the-creator-vpb'),
				'fadeIn' => esc_html__('Fade In', 'the-creator-vpb'),
				'fadeInUp' => esc_html__('Fade In Up', 'the-creator-vpb'),
				'fadeInDown' => esc_html__('Fade In Down', 'the-creator-vpb'),
				'fadeInLeft' => esc_html__('Fade In Left', 'the-creator-vpb'),
				'fadeInRight' => esc_html__('Fade In Right', 'the-creator-vpb'),
				'fadeInUpBig' => esc_html__('Fade In Up Big', 'the-creator-vpb'),
				'fadeInDownBig' => esc_html__('Fade In Down Big', 'the-creator-vpb'),
				'fadeInLeftBig' => esc_html__('Fade In Left Big', 'the-creator-vpb'),
				'fadeInRightBig' => esc_html__('Fade In Right Big', 'the-creator-vpb'),
				'slideInLeft' => esc_html__('Slide In Left', 'the-creator-vpb'),
				'slideInRight' => esc_html__('Slide In Right', 'the-creator-vpb'),
				'bounceIn' => esc_html__('Bounce In', 'the-creator-vpb'),
				'bounceInDown' => esc_html__('Bounce In Down', 'the-creator-vpb'),
				'bounceInUp' => esc_html__('Bounce In Up', 'the-creator-vpb'),
				'bounceInLeft' => esc_html__('Bounce In Left', 'the-creator-vpb'),
				'bounceInRight' => esc_html__('Bounce In Right', 'the-creator-vpb'),
				'rotateIn' => esc_html__('Rotate In', 'the-creator-vpb'),
				'rotateInDownLeft' => esc_html__('Rotate In Down Left', 'the-creator-vpb'),
				'rotateInDownRight' => esc_html__('Rotate In Down Right', 'the-creator-vpb'),
				'rotateInUpLeft' => esc_html__('Rotate In Up Left', 'the-creator-vpb'),
				'rotateInUpRight' => esc_html__('Rotate In Up Right', 'the-creator-vpb'),
				'lightSpeedIn' => esc_html__('Light Speed In', 'the-creator-vpb'),
				'rollIn' => esc_html__('Roll In', 'the-creator-vpb'),
				'flash' => esc_html__('Flash', 'the-creator-vpb'),
				'bounce' => esc_html__('Bounce', 'the-creator-vpb'),
				'shake' => esc_html__('Shake', 'the-creator-vpb'),
				'tada' => esc_html__('Tada', 'the-creator-vpb'),
				'swing' => esc_html__('Swing', 'the-creator-vpb'),
				'wobble' => esc_html__('Wobble', 'the-creator-vpb'),
				'pulse' => esc_html__('Pulse', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'timing' => array(
			'default' => 'linear',
			'description' => esc_html__('Timing Function', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				'linear' => esc_html__('Linear', 'the-creator-vpb'),
				'ease' => esc_html__('Ease', 'the-creator-vpb'),
				'ease-in' => esc_html__('Ease-in', 'the-creator-vpb'),
				'ease-out' => esc_html__('Ease-out', 'the-creator-vpb'),
				'ease-in-out' => esc_html__('Ease-in-out', 'the-creator-vpb'),
			),
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'duration' => array(
			'description' => esc_html__('Animation Duration (ms)', 'the-creator-vpb'),
			'default' => '1100',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'delay' => array(
			'description' => esc_html__('Inner Delay (ms)', 'the-creator-vpb'),
			'default' => '0',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
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
function wbcvpb_logo_carousel_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('ul_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$classes=array();
	$animation_out='';

	if($animation!=''){
		$classes[] = 'wbcvpb-animo-children';
		$duration = ($duration!='') ? $duration : '1000';
		$animation_out = 'data-animation="'.esc_attr($animation).'" data-trigger_pt="0" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
	}

	if($class!=''){
		$classes[] = $class;
	}

	$classes = implode(' ', $classes);

	$html = '<div '.esc_attr($id_out).' class="logo_carousel '.esc_attr($classes).'" '.$animation_out.'>'.do_shortcode($content).'</div>';

	$html .= "<script>
        jQuery(document).ready(function(){
            jQuery('.logo_carousel').slick({
                slidesToShow: 5,
                slidesToScroll: 1,
                responsive: [
                    {
                        breakpoint: 1000,
                        settings: {
                            arrows: true,
                            centerMode: false,
                            slidesToShow: 5
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            arrows: true,
                            centerMode: true,
                            centerPadding: '40px',
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            arrows: true,
                            centerMode: false,
                            centerPadding: '40px',
                            slidesToShow: 2
                        }
                    }
                ]
            });
        });
    </script>";

	return $html;
}


$wbcvpb_shortcodes['logo_carousel_item_wbc'] = array(
	'name' => esc_html__('Logo carousel Item', 'the-creator-vpb' ),
	'type' => 'child',
	'icon' => 'pi-customize',
	'attributes' => array(
		'image' => array(
			'description' => esc_html__('Image', 'the-creator-vpb'),
			'type' => 'image',
		),
		'url' => array(
			'description' => esc_html__('Url', 'the-creator-vpb'),
		),
	),
);
function wbcvpb_logo_carousel_item_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('logo_carousel_item_wbc'), $attributes));

	$html = '<div class="item"><a target="_blank"  href="'.$url.'"><div class="tab"><div class="tab-cell"><img class="img-responsive" src="'.$image.'"/></div></div></a></div>';
	return $html;
}

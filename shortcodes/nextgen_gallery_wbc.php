<?php

/*********** Shortcode: Image Gallery ************************************************************/

$wbcvpb_shortcodes['nextgen_gallery_wbc'] = array(
	'name' => esc_html__('Nextgen Gallery', 'the-creator-vpb' ),
	'description' => esc_html__('Image', 'the-creator-vpb' ),
	'type' =>  'block',
	'icon' => 'pi-image-gallery',
	'category' =>  esc_html__('Media', 'the-creator-vpb'),
	'attributes' => array(
		'gallery' => array(
			'description' => esc_html__('Gallery id', 'the-creator-vpb'),
		),
		'gallery_type' => array(
			'description' => esc_html__('Gallery type', 'the-creator-vpb'),
			'type' => 'select',
			'default' => 'grid',
			'values' => array(
				'grid' => 'Grid',
				//'slider' => 'Slider',
				'carousel' => 'Carousel'
			)
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
function wbcvpb_nextgen_gallery_wbc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(wbcvpb_extract_attributes('nextgen_gallery_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	if($gallery_type == 'grid') {
		$return = '<div '.esc_attr($id_out).' class="gallery wbcvpb-image-gallery '.esc_attr($columns).''.esc_attr($class).'">';
		$return .= nggGetSliderPics($gallery)['grid'];
		$return .= '</div>';
	} elseif($gallery_type == 'slider') {
		$return = "<div id='galleryCarousel' class='carousel slide' data-ride='carousel'>
			<div class='carousel-outer'>
				<!-- Wrapper for slides -->
				<div class='carousel-inner'>
					".nggGetSliderPics($gallery)['carousel']['items']."
				</div>
			</div>
		</div>";

		$return .= '<div class="hidden-sm hidden-xs" id="slider-thumbs">
			<ul>
				'.nggGetSliderPics($gallery)['carousel']['indicator'].'
			</ul>
		</div>';

		$return .= "<script>jQuery(document).ready(function() {
				jQuery('#galleryCarousel').carousel({
					interval: 4000
				});

				// handles the carousel thumbnails
				jQuery('[id^=carousel-selector-]').click( function(){
					var id_selector = jQuery(this).attr(\"id\");
					var id = id_selector.substr(id_selector.length -1);
					id = parseInt(id);
					jQuery('#galleryCarousel').carousel(id);
					jQuery('[id^=carousel-selector-]').removeClass('selected');
					jQuery(this).addClass('selected');
				});

				// when the carousel slides, auto update
				jQuery('#galleryCarousel').on('slid', function (e) {
					var id = jQuery('.item.active').data('slide-number');
					id = parseInt(id);
					jQuery('[id^=carousel-selector-]').removeClass('selected');
					jQuery('[id=carousel-selector-'+id+']').addClass('selected');
				});
			})</script>";
	} elseif($gallery_type == 'carousel') {
		$return .= '<div class="slick-gallery">
			'.nggGetSliderPics($gallery)['carousel']['items'].'
		</div>';

		$return .= "<script>
			jQuery(document).ready(function(){
				jQuery('.slick-gallery').slick({
					slidesToShow: 4,
					slidesToScroll: 1,
					responsive: [
						{
							breakpoint: 1000,
							settings: {
								arrows: true,
								centerMode: false,
								slidesToShow: 4
							}
						},
						{
							breakpoint: 768,
							settings: {
								arrows: true,
								centerMode: true,
								centerPadding: '40px',
								slidesToShow: 3
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
	}

	return $return;
}

function nggGetSliderPics($chosen_gallery) {
	global $wpdb;

	$results = $wpdb->get_results("SELECT * FROM $wpdb->nggpictures WHERE galleryid = $chosen_gallery ORDER BY sortorder");
	$dirresult = $wpdb->get_results("SELECT path FROM $wpdb->nggallery WHERE gid = $chosen_gallery");

	$sliderPicsHTMLGrid = '<div class="row">';
	foreach ($results as $result) {
		$sliderPicsHTMLGrid .= '<div class="box col-lg-3 col-md-3 col-sm-4 col-xs-6">
			<a class="fancybox" rel="gallery_'.$chosen_gallery.'" href="'.home_url().'/'.$dirresult[0]->path.'/'.$result->filename.'">
				<div class="img" style="background:url('.home_url().'/'.$dirresult[0]->path.'/'.$result->filename.') center center no-repeat;background-size:cover;">
					<div class="shadow"></div>
				</div>
			</a>
		</div>';
	}
	$sliderPicsHTMLGrid .= '</div>';

	$sliderPicsHTMLCarousel = '';
	$sliderPicsHTMLCarouselIndicator = '';
	$k = 0;
	foreach ($results as $result) {
		if($k == 0) {
			$cl = 'active';
			$sl = 'selected';
		} else {
			$cl = '';
			$sl = '';
		}
		$sliderPicsHTMLCarousel .= '<div class="item '.$cl.'">
			<a class="fancybox" rel="gallery_'.$chosen_gallery.'" href="'.home_url().'/'.$dirresult[0]->path.'/'.$result->filename.'">
				<div class="showBig"></div>
				<div class="image" style="background:url('.home_url().'/'.$dirresult[0]->path.'/'.$result->filename.') center center no-repeat;background-size:cover;">
					<div class="shadow"></div>
				</div>
			</a>
		</div>';

		$sliderPicsHTMLCarouselIndicator .= '<li>
			<a id="carousel-selector-'.$k.'" class="'.$sl.'">
				<div class="thumbs" style="background:url('.home_url().'/'.$dirresult[0]->path.'/thumbs/thumbs_'.$result->filename.') center center no-repeat;background-size:cover;">
					<div class="shadow"></div>
				</div>
			</a></li>';

		$k++;
	}
	$sliderPicsHTMLCarousel .= '';


	return array('grid' => $sliderPicsHTMLGrid, 'carousel' => array('items' => $sliderPicsHTMLCarousel, 'indicator' => $sliderPicsHTMLCarouselIndicator));
}


<?php

/*********** Shortcode: Latest Post ************************************************************/

$wbcvpb_shortcodes['posts_wbc'] = array(
	'name' => esc_html__('Posts', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-posts',
	'category' =>  esc_html__('Content', 'the-creator-vpb'),
	'attributes' => array(
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
		'trigger_pt' => array(
			'description' => esc_html__('Trigger Point (in px)', 'the-creator-vpb'),
			'info' => esc_html__('Amount of pixels from bottom to start animation', 'the-creator-vpb'),
			'default' => '0',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'duration' => array(
			'description' => esc_html__('Animation Duration (in ms)', 'the-creator-vpb'),
			'default' => '1000',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'delay' => array(
			'description' => esc_html__('Animation Delay (in ms)', 'the-creator-vpb'),
			'default' => '0',
			'tab' => esc_html__('Animation', 'the-creator-vpb'),
		),
		'category' => array(
			'description' => esc_html__( 'Category', 'the-creator-vpb' ),
		),
		'ids' => array(
			'description' => esc_html__( 'Posts IDs', 'the-creator-vpb' ),
			'divider' => 'true',
		),
		'style' => array(
			'default' => '1',
			'type' => 'select',
			'values' => array(
				'1' => __('Style 1', 'the-creator-vpb'),
				'2' => __('Style 2', 'the-creator-vpb'),
			),
			'description' => __('Style', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'order' => array(
			'default' => 'DESC',
			'type' => 'select',
			'description' => esc_html__( 'Order', 'the-creator-vpb' ),
			'values' => array(
				'ASC' =>  esc_html__( 'ASC', 'the-creator-vpb' ),
				'DESC' =>  esc_html__( 'DESC', 'the-creator-vpb' ),
			),  
			'tab' => esc_html__('Order By', 'the-creator-vpb'),    
		),
		'orderby' => array(
			'default' => 'date',
			'type' => 'select',
			'description' => esc_html__( 'Order by', 'the-creator-vpb' ),
			'values' => array(
				'ID' =>  esc_html__( 'ID', 'the-creator-vpb' ),
				'none' =>  esc_html__( 'none', 'the-creator-vpb' ),
				'author' =>  esc_html__( 'author', 'the-creator-vpb' ),
				'title' =>  esc_html__( 'title', 'the-creator-vpb' ),
				'name' =>  esc_html__( 'name', 'the-creator-vpb' ),
				'date' =>  esc_html__( 'date', 'the-creator-vpb' ),
				'modified' =>  esc_html__( 'modified', 'the-creator-vpb' ),
				'parent' =>  esc_html__( 'parent', 'the-creator-vpb' ),
				'rand' =>  esc_html__( 'rand', 'the-creator-vpb' ),
				'menu_order' =>  esc_html__( 'menu_order', 'the-creator-vpb' ),
				'post__in' =>  esc_html__( 'post__in', 'the-creator-vpb' ),
			),
			'tab' => esc_html__('Order By', 'the-creator-vpb'),  
		),
		'url_text' => array(
			'description' => esc_html__( 'Url text', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'post_parent' => array(
			'description' => esc_html__( 'Post Parent', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'post_type' => array(
			'default' => 'post',
			'description' => esc_html__( 'Post Type', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'posts_no' => array(
			'default' => 'default',
			'description' => esc_html__( 'Number of Posts', 'the-creator-vpb' ),
		),
		'offset' => array(
			'default' => '0',
			'description' => esc_html__( 'Offset', 'the-creator-vpb' ),
		),
		'tag' => array(
			'description' => esc_html__( 'Tag', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'tax_operator' => array(
			'default' => 'IN',
			'description' => esc_html__( 'Tax Operator', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'tax_term' => array(
			'description' => esc_html__( 'Tax Term', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'taxonomy' => array(
			'description' => esc_html__( 'Taxonomy', 'the-creator-vpb' ),
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'lightbox' => array(
			'description' => __( 'Lightbox on Images', 'the-creator-vpb' ),
			'type' => 'checkbox',
			'default' => 0,
			'tab' => esc_html__('Custom', 'the-creator-vpb'),
		),
		'excerpt' => array(
			'description' => esc_html__( 'Custom Excerpt Limit Words', 'the-creator-vpb' ),
			'info' => esc_html__( 'How many words you want to display? If left empty default WordPress excerpt will be used.', 'the-creator-vpb' ),
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
	'description' => esc_html__( 'Posts Excerpts', 'the-creator-vpb' )
);

if ( ! function_exists( 'wbcvpb_posts_wbc_shortcode' ) ){
	function wbcvpb_posts_wbc_shortcode( $attributes ) {
		extract(shortcode_atts(wbcvpb_extract_attributes('posts_wbc'), $attributes));
		$id_out = ($id!='') ? 'id='.$id.'' : '';
		wp_reset_postdata();
		global $paged;

		if($posts_no == 'default') {
			$posts_no = null;
		}

		$args = array(
			'paged' => $paged,
			'cat'  => $category,
			'order'          => $order,
			'orderby'        => $orderby,
			'post_type'      => explode( ',', $post_type ),
			'posts_per_page' => $posts_no,
			'offset'         => $offset,
			'tag'            => $tag,
		);

		if( $ids ) {
			$posts_in = array_map( 'intval', explode( ',', $ids ) );
			$args['post__in'] = $posts_in;
		}
		if ( !empty( $taxonomy ) && !empty( $tax_term ) ) {
			$tax_term = explode( ', ', $tax_term );
			if( !in_array( $tax_operator, array( 'IN', 'NOT IN', 'AND' ) ) ){
				$tax_operator = 'IN';
			}
			$tax_args = array(
				'tax_query' => array(
					array(
						'taxonomy' => $taxonomy,
						'field'    => 'slug',
						'terms'    => $tax_term,
						'operator' => $tax_operator
					)
				)
			);
			$args = array_merge( $args, $tax_args );
		}
		if( $post_parent ) {
			if( 'current' == $post_parent ) {
				global $post;
				$post_parent = $post->ID;
			}
			$args['post_parent'] = $post_parent;
		}
		$listing = new WP_Query( apply_filters( 'display_posts_shortcode_args', $args, $attributes ) );
		if ( ! $listing->have_posts() ){
			return apply_filters( 'display_posts_shortcode_no_results', false );
		}

		$classes=array();
		$animation_out='';

		if($animation!=''){
			$classes[] = 'wbcvpb-animo';
			$duration = ($duration!='') ? $duration : '1000';
			$animation_out = 'data-animation="'.esc_attr($animation).'" data-trigger_pt="'.esc_attr($trigger_pt).'" data-duration="'.esc_attr($duration).'" data-delay="'.esc_attr($delay).'"';
		}

		if($class!=''){
			$classes[] = $class;
		}
		$classes = implode(' ', $classes);

		$output = '<div class="row">';
		while ( $listing->have_posts() ): $listing->the_post();
			global $post;

			$thumbnail = get_the_post_thumbnail($post->ID,'thumbnail');
			$hasthumb_class = ($thumbnail!='') ? ' has_thumbnail' : ' without_thumbnail';

			$output .= '<div '.esc_attr($id_out).' class="col-lg-12 wbcvpb_posts_shortcode wbcvpb_posts_shortcode-'.esc_attr($style).' clearfix'.esc_attr($hasthumb_class).' '.esc_attr($classes).'" '.$animation_out.'>';
			$output .= ($thumbnail!='') ? ( ($lightbox == 1) ? '<a data-lightbox="post-images" href="'.esc_url($url).'">' . get_the_post_thumbnail($post->ID,'full', array('class' => 'img-responsive')) . '</a>' : '<a class="wbcvpb_latest_news_shortcode_thumb" href="' . esc_url(get_permalink()) . '">' . get_the_post_thumbnail($post->ID,'full', array('class' => 'img-responsive')) . '</a>' ) : '';

			$output .= '<div class="wbcvpb_latest_news_shortcode_content">';
			$output .= '<div class="ico"></div>';
			$output .= '<h5>' . get_the_title() . '</h5>';
			$date = get_the_date();
			$output .= '<p class="wbcvpb_latest_news_time"><span class="month">'.get_the_date('M').'</span> <span class="day">'.get_the_date('d').'</span><span class="year">, '.get_the_date('Y').'</span></p>';

			if($excerpt > 0){
				$text = do_shortcode(get_the_content());
				$text = apply_filters('the_content', $text);
				$text = str_replace(']]>', ']]&gt;', $text);
				$text = strip_tags($text);
				$words = preg_split("/[\n\r\t ]+/", $text, $excerpt+1, PREG_SPLIT_NO_EMPTY);
				$ending = (count($words) > $excerpt) ? '...':'';
				$words = array_slice($words, 0, $excerpt);
				$text = implode(' ', $words).$ending;
			}
			else{
				$text = get_the_excerpt();
			}
			$output .= '<div class="content">' . $text . '</div>';
			$output .= '<a class="news-more" href="' . esc_url(get_permalink()) . '">' . $url_text . '<span class="icon"></span></a>';
			$output .= '</div>';
			$output .= '</div>';
		endwhile;
		$output .= wp_pagenavi(array('query' => $listing, 'echo' => false));
		wp_reset_postdata();
		$output .= '</div>';

		return $output;
	}
}


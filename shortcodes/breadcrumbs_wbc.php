<?php

/*********** Shortcode: Sitemap ************************************************************/

$wbcvpb_shortcodes['breadcrumbs_wbc'] = array(
	'name' => esc_html__('Breadcrumbs', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-sitemap',
	'category' =>  esc_html__('Navigation', 'the-creator-vpb'),
	'attributes' => array(
		'class' => array(
			'description' => esc_html__('Class', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom classes for custom styling', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),
	)
);
function wbcvpb_breadcrumbs_wbc_shortcode($attributes){
	extract(shortcode_atts(wbcvpb_extract_attributes('breadcrumbs_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$return = '';
	$return .= '<div id="breadcrumbs" class="'.$class.'">'.wbc_custom_breadcrumbs().'</div>';
	return $return;
}

function wbc_custom_breadcrumbs() {
	$showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
	$delimiter = '/'; // delimiter between crumbs
	$home = 'Strona główna'; // text for the 'Home' link
	$showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
	$before = '<span class="current">'; // tag before the current crumb
	$after = '</span>'; // tag after the current crumb

	global $post;
	$homeLink = get_bloginfo('url');
	$crumbs = '';

	if (is_home() || is_front_page()) {

		if ($showOnHome == 1) $crumbs .= '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a></div>';

	} else {

		$crumbs .= '<div id="crumbs"><a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

		if ( is_category() ) {
			$thisCat = get_category(get_query_var('cat'), false);
			if ($thisCat->parent != 0) $crumbs .= get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
			$crumbs .= $before . '' . single_cat_title('', false) . '' . $after;

		} elseif ( is_search() ) {
			$crumbs .= $before . '' . get_search_query() . '' . $after;

		} elseif ( is_day() ) {
			$crumbs .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			$crumbs .= '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
			$crumbs .= $before . get_the_time('d') . $after;

		} elseif ( is_month() ) {
			$crumbs .= '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
			$crumbs .= $before . get_the_time('F') . $after;

		} elseif ( is_year() ) {
			$crumbs .= $before . get_the_time('Y') . $after;

		} elseif ( is_single() && !is_attachment() ) {
			if ( get_post_type() != 'post' ) {
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				$crumbs .= '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
				if ($showCurrent == 1) $crumbs .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
			} else {
				$cat = get_the_category(); $cat = $cat[0];
				$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
				if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
				$crumbs .= $cats;
				if ($showCurrent == 1) $crumbs .= $before . get_the_title() . $after;
			}

		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			$post_type = get_post_type_object(get_post_type());
			$crumbs .= $before . $post_type->labels->singular_name . $after;

		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
			$cat = get_the_category($parent->ID); $cat = $cat[0];
			$crumbs .= get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
			$crumbs .= '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			if ($showCurrent == 1) $crumbs .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

		} elseif ( is_page() && !$post->post_parent ) {
			if ($showCurrent == 1) $crumbs .= $before . get_the_title() . $after;

		} elseif ( is_page() && $post->post_parent ) {
			$parent_id  = $post->post_parent;
			$breadcrumbs = array();
			while ($parent_id) {
				$page = get_page($parent_id);
				$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
				$parent_id  = $page->post_parent;
			}
			$breadcrumbs = array_reverse($breadcrumbs);
			for ($i = 0; $i < count($breadcrumbs); $i++) {
				$crumbs .= $breadcrumbs[$i];
				if ($i != count($breadcrumbs)-1) $crumbs .= ' ' . $delimiter . ' ';
			}
			if ($showCurrent == 1) $crumbs .= ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

		} elseif ( is_tag() ) {
			$crumbs .= $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			$crumbs .= $before . 'Articles posted by ' . $userdata->display_name . $after;

		} elseif ( is_404() ) {
			$crumbs .= $before . 'Error 404' . $after;
		}

		if ( get_query_var('paged') ) {
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $crumbs .= ' (';
			$crumbs .= __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) $crumbs .= ')';
		}

		$crumbs .= '</div>';

		return $crumbs;

	}
}
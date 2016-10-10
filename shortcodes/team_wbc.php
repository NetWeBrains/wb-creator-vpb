<?php

/*********** Shortcode: Team ************************************************************/

$wbcvpb_shortcodes['team_wbc'] = array(
	'name' => esc_html__('Team', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-team',
	'category' =>  esc_html__('Social', 'the-creator-vpb'),
	'child' => 'team_socials_wbc',
	'child_button' => esc_html__('New Social Link', 'the-creator-vpb'),
	'child_title' => esc_html__('Social Links', 'the-creator-vpb'),
	'attributes' => array(
		'name' => array(
			'description' => esc_html__('Name', 'the-creator-vpb'),
		),
		'position' => array(
			'description' => esc_html__('Position', 'the-creator-vpb'),
		),
		'image' => array(
			'type' => 'image',
			'description' => esc_html__('Image URL', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'link' => array(
			'description' => esc_html__('Profile URL', 'the-creator-vpb'),
			'info' => esc_html__('Link to about page', 'the-creator-vpb'),
			'tab' => esc_html__('Profile URL', 'the-creator-vpb'),
		),
		'link_icon' => array(
			'description' => esc_html__( 'Profile URL Icon', 'the-creator-vpb' ),
			'info' => esc_html__('Choose Link Icon that will be shown on hover', 'the-creator-vpb'),
			'type' => 'icon',
			'tab' => esc_html__('Profile URL', 'the-creator-vpb'),
		),
		'short_bio' => array(
			'description' => __('Short Description', 'the-creator-vpb'),
			'info' => __('A short description that will appear on overlay', 'the-creator-vpb'),
			'divider' => 'true',
		),
		'modal' => array(
			'type' => 'checkbox',
			'description' => esc_html__('Use Modal Link', 'the-creator-vpb'),
			'info' => esc_html__('Modal window will appear on click instead of following a link. Use content to add modal window content', 'the-creator-vpb'),
			'tab' => esc_html__('Modal', 'the-creator-vpb'),
		),
		'modal_icon' => array(
			'description' => esc_html__( 'Modal Icon', 'the-creator-vpb' ),
			'info' => esc_html__('Choose Modal Icon that will be shown on hover', 'the-creator-vpb'),
			'type' => 'icon',
			'tab' => esc_html__('Modal', 'the-creator-vpb'),
		),
		'social_under' => array(
			'type' => 'checkbox',
			'description' => esc_html__('Social icons under position', 'the-creator-vpb'),
			'info' => esc_html__('If enabled social icons will appear under position instead on image overlay.', 'the-creator-vpb'),
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
	'content' => '',
);
function wbcvpb_team_wbc_shortcode( $attributes, $content = null ) {
	global $social_links;
	extract(shortcode_atts(wbcvpb_extract_attributes('team_wbc'), $attributes));
	$id_out = ($id!='') ? 'id='.$id.'' : '';

	$link_icon = ($link_icon!='') ? '<i class="'.esc_attr($link_icon).'"></i>' : '';
	$modal_icon_out = ($modal_icon!='') ? '<i class="'.esc_attr($modal_icon).'"></i>' : '';

	$return = '
		<div '.esc_attr($id_out).' class="wbcvpb_team_member '.esc_attr($class).'">';

	do_shortcode($content);

		if(($social_links!='' && $social_under!=1) || $link!=''){
			$return .= '<div class="wbcvpb_overlayed">
				<img src="'.esc_url($image).'" alt="'.esc_attr($name).'">
				<div class="wbcvpb_overlay">
					<p class="team_content">'.$short_bio.'</p>
					<p>';
						if($social_under==1 || $social_links==''){
							if ($modal==1){
								$return .='<a class="wbcvpb_team_member_link wbcvpb_team_member_modal_link" href="'.esc_url($link).'">'.$modal_icon_out.'</a>';
							}else{
								$return .='<a href="'.esc_url($link).'">'.$link_icon.'</a>';
							}
						}
						else{
							$return .= $social_links;
						}
					$return .= '</p>
				</div>
			</div>';
		}
		else{
			$return.= '<img src="'.esc_url($image).'" alt="'.esc_attr($name).'">';
		}
		$return .= '<a class="wbcvpb_team_member_link'.(($modal==1)?' wbcvpb_team_member_modal_link':'').'" href="'.esc_url($link).'">
			<span class="wbcvpb_team_member_name">'.$name.'</span>
			<span class="wbcvpb_team_member_position">'.$position.'</span>
		</a>';

		if($modal == 1){
			$return .= '
				<div class="wbcvpb_team_member_modal">
					<h4 class="wbcvpb_team_member_name">'.esc_attr($name).'</h4>
					<p class="wbcvpb_team_member_position">'.$position.'</p>
					<div class="wbcvpb_container">
						<div class="wbcvpb_column_wbc_span6">
							<img src="'.esc_url($image).'" alt="'.esc_attr($name).'">
						</div>
						<div class="wbcvpb_column_wbc_span6">
							'.do_shortcode($content).'
						</div>
					</div>
					<div class="wbcvpb_team_member_modal_close">X</div>
				</div>';
		}
		else{
			$return .= '';
		}

		if($social_under==1){
			$return .= '<div class="wbcvpb_team_member_social_under">'.$social_links.'</div>';
		}

		$return .= '</div>';

	$social_links = '';

	return $return;
}

$wbcvpb_shortcodes['team_socials_wbc'] = array(
	'name' => esc_html__('Single Social Link', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'title' => array(
			'description' => esc_html__('Tooltip Title', 'the-creator-vpb'),
			'info' => esc_html__('Name of the social network (e.g. Follow us on Facebook,Follow us on Twitter,Follow us on Google+)', 'the-creator-vpb'),
		),
		'gravity' => array(
			'default' => 's',
			'description' => esc_html__('Tooltip Gravity Position', 'the-creator-vpb'),
			'type' => 'select',
			'values' => array(
				's' => esc_html__('South', 'the-creator-vpb'),
				'n' => esc_html__('North', 'the-creator-vpb'),
				'e' => esc_html__('East', 'the-creator-vpb'),
				'w' => esc_html__('West', 'the-creator-vpb'),
			),
		),
		'icon' => array(
			'description' => esc_html__('Icon', 'the-creator-vpb'),
			'type' => 'icon',
		),
		'url' => array(
			'description' => esc_html__('Social URL', 'the-creator-vpb'),
			'type' => 'url',
		),
		'target' => array(
			'description' => esc_html__('Target', 'the-creator-vpb'),
			'default' => '_self',
			'type' => 'select',
			'values' => array(
				'_self' =>  esc_html__('Self', 'the-creator-vpb'),
				'_blank' => esc_html__('Blank', 'the-creator-vpb'),
			),
		),
	),
);
function wbcvpb_team_socials_wbc_shortcode( $attributes, $content = null ) {
	global $social_links;
	extract(shortcode_atts(wbcvpb_extract_attributes('team_socials_wbc'), $attributes));

	$social_links .= '<a class="wbcvpb_socialicon wbcvpb_tooltip" data-gravity="'.esc_attr($gravity).'" href="'.esc_url($url).'" target="'.esc_attr($target).'" title="'.esc_attr($title).'"><i class="'.esc_attr($icon).'"></i></a>';

	$return = '';
	return $return;
}
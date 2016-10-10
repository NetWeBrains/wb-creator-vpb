jQuery(document).ready(function($) {
    "use strict";

    var $i=0;
    $('#wbcvpb_options_page_form h3').each(function(){
    	$i++;
    	var active_class = ($i==1) ? 'active' : '';
		$(this).addClass('wbcvpb_options_page_tab').data('tab', $i).addClass(active_class);
    	$(this).nextAll('table').first().wrap('<div class="wbcvpb_settings_tab" id="tab_content_'+$i+'"></div>');
    	$('#tab_content_'+$i).addClass(active_class);
    	$('#tab_content_'+$i).prev('.wbcvpb_options_section_intro').detach().prependTo($('#tab_content_'+$i));
    })
    .wrapAll( "<div id='wbcvpb_settings_tabs'></div>");

    $(document).on('click', '.wbcvpb_options_page_tab', function(e){
    	e.preventDefault();
    	$('#wbcvpb_options_page_form').find('.active').removeClass('active');
    	$(this).addClass('active');
    	var current_tab = $(this).data('tab');
    	$('#tab_content_'+current_tab).addClass('active');

    });

});
jQuery(document).ready(function($) {
    "use strict";

    var elements = $.parseJSON( wbcvpb_from_WP.elements );
    var element_categories = $.parseJSON( wbcvpb_from_WP.categories );
    var icons = $.parseJSON( wbcvpb_from_WP.icons );

    var tinymce_options = {
        height: 200,
        menubar : true,
        element_format : "html",
        browser_spellcheck : true,
        statusbar : true,
        relative_urls : false,
        remove_script_host : false,
        convert_urls : false,
        forced_root_block : 'p',
        forced_root_block_attrs: {
            "class": "p_wbc"
        },
        toolbar: "bold italic underline fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | bullist numlist | indent outdent | subscript superscript | strikethrough | forecolor backcolor hr blockquote | link unlink | image | table charmap | searchreplace | removeformat undo redo",
        plugins: "paste link hr image charmap searchreplace table textcolor code",
        paste_as_text: true,
        setup: function(editor) {
            editor.on('change', wbcvpb_save_button_attribute_changed);
        }
    };

    var $wbc_classic_editor = $("#postdivrich").after(wbcvpb_generate_main_html());

    var $wbcvpb_wrapper = $("#wbcvpb_wrapper");
    var $wbcvpb_builder = $("#wbcvpb_builder");

    $("#wp-content-media-buttons").append('<a id="wbcvpb_switch_button" class="button button-primary dashicons-before dashicons-schedule wbcvpb_tooltip" title="'+wbcvpb_from_WP.switch_button_activate+'">'+wbcvpb_from_WP.switch_button_activate+'</a>');

    var $wbcvpb_content = $("#wbcvpb_content");
    var $wbcvpb_redo_button = $("#wbcvpb_redo_button");
    var $wbcvpb_undo_button = $("#wbcvpb_undo_button");
    var $wbcvpb_hidden_metabox = $('#wbcvpb_hidden_metabox');
    var $wbcvpb_popup_saved = '';
    var wbcvpb_history = [];
    var wbcvpb_history_current = 0;
    var max_history = wbcvpb_from_WP.wbcvpb_history_amount;

    $wbcvpb_wrapper.hide();
    $wbcvpb_builder.sortable({
        items: "> .wbcvpb_section_wrapper",
        handle: ".wbcvpb_section_heading",
        placeholder: "wbcvpb_section_placeholder",
        forcePlaceholderSize: true,
        revert: true,
        cursor: "move",
        tolerance: "pointer",
        stop: function(){
            wbcvpb_rebuild_widths();
            wbcvpb_write_from_wbcvpb_to_editor();
        },
        over: wbcvpb_rebuild_widths
    }).disableSelection();

    if($('#wbcvpb_wbc_activated').is(':checked') || ($('body').hasClass('post-new-php') && $('#wbcvpb_wbc_activated').hasClass('wbcvpb_is_default'))){
        wbcvpb_activate_wbc('initial');
    }

    // ******************* switch *******************
    $(document).on('click', '#wbcvpb_switch_button, #wbcvpb_switch_back_button', wbcvpb_switch_button)
        // ******************* popup *******************
        .on('click', '#wbcvpb_shortcodes_list h3, .wbcvpb_iconset_title', wbcvpb_shortcodes_header_toggle)
        .on('keyup', '#wbcvpb_element_selector_filter', wbcvpb_element_selector_filter)
        .on('keyup', '#wbcvpb_icon_selector_filter', wbcvpb_icon_selector_filter)
        .on('click', '#wbcvpb_layouts_button, #wbcvpb_load_layout_empty', wbcvpb_open_layout_modal)
        // ******************* sections *******************
        .on('click', '#wbcvpb_add_section_top, #wbcvpb_add_section_empty, .wbcvpb_add_section_button', wbcvpb_add_section)
        .on('click', '.wbcvpb_section_edit, .wbcvpb_section_heading h4', wbcvpb_section_edit)
        .on('click', '#wbcvpb_save_section_settings', wbcvpb_save_section_settings)
        .on('click', '.wbcvpb_section_duplicate', wbcvpb_section_duplicate)
        .on('click', '.wbcvpb_section_delete' , wbcvpb_section_or_element_delete)
        // ******************* columns *******************
        .on('click', '.wbcvpb_add_column', wbcvpb_add_column)
        .on('click', '.wbcvpb_column_edit', wbcvpb_column_edit)
        .on('click', '#wbcvpb_save_column_settings', wbcvpb_save_column_settings)
        .on('click', '.wbcvpb_remove_column', wbcvpb_remove_column)
        // ******************* elements *******************
        .on('click', '.wbcvpb_add_element', wbcvpb_add_element)
        .on('click', '#wbcvpb_shortcodes_list li', wbcvpb_popup_element_select)
        .on('click', '#wbcvpb_popup_back_to_list', wbcvpb_popup_back_to_list)
        .on('click', '.wbcvpb_popup_tab', wbcvpb_popup_tab)
        .on('click', '.wbcvpb_element_edit, .wbcvpb_element .element_name', wbcvpb_element_edit)
        .on('click', '#wbcvpb_insert_element, #wbcvpb_save_changes', wbcvpb_insert_element)
        .on('click', '.wbcvpb_element_duplicate', wbcvpb_element_duplicate)
        .on('click', '.wbcvpb_element_delete' , wbcvpb_section_or_element_delete)
        .on('click', '.wbcvpb_add_child', wbcvpb_add_child)
        .on('click', '.wbcvpb_remove_child', wbcvpb_remove_child)
        .on('click', '#wbcvpb_collapse_children', wbcvpb_collapse_children)
        .on('click', '.wbcvpb_child_header', wbcvpb_collapse_child)
        .on('change keyup', '.wbcvpb_shortcode_attribute, #wbcvpb_layout_save_input', wbcvpb_save_button_attribute_changed)
        // ******************* layouts *******************
        .on('click', '#wbcvpb_popup_layout_save, .wbcvpb_layout_content_overwrite', wbcvpb_layout_save)
        .on('click', '.wbcvpb_layout_content_delete', wbcvpb_layout_delete)
        .on('click', '.wbcvpb_popup_layout_content', wbcvpb_load_layout)
        // ******************* others *******************
        .on('click', '.wbcvpb_upload_image_button', wbcvpb_upload_image_button)
        .on('click', '.wbcvpb_image_delete', wbcvpb_image_delete)
        .on('click', '.wbcvpb_upload_gallery_button', wbcvpb_upload_gallery_button)
        .on('click', '.wbcvpb-icon', wbcvpb_icon)
        .on('click', '#wbcvpb_icon_selector_backdrop', wbcvpb_icon_close)
        .on('click', '.wbcvpb_icon_selector_select', wbcvpb_icon_selector_select)
        .on('click', '.wbcvpb-icon-remove', wbcvpb_icon_remove)
        .on('keyup', '.wbcvpb_cross_field', wbcvpb_cross)
        .on('click', '#wbcvpb_popup_close, #wbcvpb_popup_layout_abort, #wbcvpb_popup_backdrop', wbcvpb_close_modal)
        .on('DOMMouseScroll mousewheel', '#wbcvpb_popup_content, #wbcvpb_popup_element_content, #wbcvpb_icon_selector', prevent_body_scroll)
        .keydown(close_modal_on_esc);
    $("#wbcvpb_fullscreen_button").click(wbcvpb_fullscreen_button);
    $("#wbcvpb_redo_button, #wbcvpb_undo_button").click(wbcvpb_undo_redo);

    wbcvpb_init_tipsy();

    $(window).resize(function() {
        wbcvpb_rebuild_widths();
    });

    $(window).load(function() {
        wbcvpb_rebuild_widths();
    });


    /*********************************************************************************************
     functions
     *********************************************************************************************/

    function wbcvpb_init_tipsy(){
        $('.wbcvpb_tooltip').tipsy({
            opacity: 0.8,
            gravity: function(){
                var gravity = $(this).data("gravity");
                gravity = (gravity !== undefined) ? gravity : 's';
                return gravity;
            }
        });
    }


    function wbcvpb_generate_main_html(){
        var wbc_editor_html = '<div id="wbcvpb_wrapper">'+
            '<div id="wbcvpb_tools">'+
            '<a href="options-general.php?page=wbcvpb" id="wbcvpb_go_to_settings" class="wbcvpb_tooltip" title="'+wbcvpb_from_WP.go_to_settings+'"><i class="pi-settings"></i></a>'+
            '<a href="#" id="wbcvpb_switch_back_button"><i class="pi-switch"></i> '+wbcvpb_from_WP.switch_button_deactivate+'</a>'+
            '<a href="#" id="wbcvpb_fullscreen_button" class="wbcvpb_right_buttons wbcvpb_tooltip" title="'+wbcvpb_from_WP.fullscreen+'"><i class="pi-fullscreen"></i></a>'+
            '<a href="#" id="wbcvpb_layouts_button" class="wbcvpb_right_buttons wbcvpb_tooltip" title="'+wbcvpb_from_WP.layouts+'"><i class="pi-layouts"></i></a>'+
            '<a href="#" id="wbcvpb_redo_button" class="wbcvpb_redo_button wbcvpb_right_buttons disabled wbcvpb_tooltip" title="'+wbcvpb_from_WP.redo+'"><i class="pi-redo"></i></a>'+
            '<a href="#" id="wbcvpb_undo_button" class="wbcvpb_undo_button wbcvpb_right_buttons disabled wbcvpb_tooltip" title="'+wbcvpb_from_WP.undo+'"><i class="pi-undo"></i></a>'+
            '</div>'+
            '<div id="wbcvpb_builder">'+
            '<div id="wbcvpb_add_section_top"><span>'+wbcvpb_from_WP.plus_section+'</span></div>'+
            '<div id="wbcvpb_builder_empty">'+
            '<p>'+wbcvpb_from_WP.layout_select_saved+'</p>'+
            '<p>'+
            '<a href="#" id="wbcvpb_add_section_empty"><i class="pi-add-box"></i>'+wbcvpb_from_WP.add_section+'</a>'+
            '<a href="#" id="wbcvpb_load_layout_empty"><i class="pi-layouts"></i>'+wbcvpb_from_WP.load_layout+'</a>'+
            '</p>'+
            '</div>'+
            '</div>'+
            '</div>';
        return wbc_editor_html;
    }

    function wbcvpb_section_html(shortcode,title,columns){
        if(title==''){
            title = wbcvpb_from_WP.untitled_section;
        }
        var wbc_section_html = ''+
            '<div class="wbcvpb_section_wrapper">'+
            '<div class="wbcvpb_content_section" data-shortcode="'+shortcode+'">'+
            '<div class="wbcvpb_section_heading">'+
            '<h4>'+title+'</h4>'+
            '<span class="wbcvpb_section_delete wbcvpb_tooltip" title="'+wbcvpb_from_WP.delete_section+'"><i class="pi-delete"></i></span>'+
            '<span class="wbcvpb_section_duplicate wbcvpb_tooltip" title="'+wbcvpb_from_WP.duplicate_section+'"><i class="pi-duplicate"></i></span>'+
            '<span class="wbcvpb_section_edit wbcvpb_tooltip" title="'+wbcvpb_from_WP.edit_section+'"><i class="pi-customize"></i></span>'+
            '</div>'+
            '<div class="wbcvpb_section_row">'+
            columns+
            '</div>'+
            '</div>'+
            '<div class="wbcvpb_add_section_button"><span>'+wbcvpb_from_WP.plus_section+'</span></div>'+
            '</div>';
        return wbc_section_html;
    }

    function wbcvpb_column_html(shortcode,span,elements){
        var columns_add_disable = (span==1) ? '' : '';
        var column_empty = (elements=='') ? ' wbcvpb_column_empty' : '';
        var wbcvpb_column_html = ''+
            '<div class="wbcvpb_column'+column_empty+' colspan-'+span+'" data-span="'+span+'" data-shortcode="'+shortcode+'">'+
            '<div class="column_top_fake_element">'+
            '<span class="wbcvpb_add_element"><span>'+wbcvpb_from_WP.add_element+'</span></span>'+
            '</div>'+
            elements+
            '<div class="column_properties_baloon">'+
            '<span class="wbcvpb_move_column wbcvpb_tooltip" title="'+wbcvpb_from_WP.move_column+'"><i class="pi-move"></i></span>'+
            '<span class="wbcvpb_column_edit wbcvpb_tooltip" title="'+wbcvpb_from_WP.edit_column+'"><i class="pi-customize-alt"></i></span> '+
            '<span class="wbcvpb_remove_column wbcvpb_tooltip" title="'+wbcvpb_from_WP.remove_column+'"><i class="pi-delete"></i></span>'+
            '<span class="wbcvpb_add_column'+columns_add_disable+' wbcvpb_tooltip" title="'+wbcvpb_from_WP.add_column+'"><i class="pi-split"></i></span>'+
            '<span class="wbcvpb_add_column column_size wbcvpb_tooltip" title="'+wbcvpb_from_WP.add_column+'">'+span+'/12</span>'+
            '</div>'+
            '</div>';
        return wbcvpb_column_html;
    }

    function wbcvpb_element_html(shortcode,title,excerpt){
        excerpt = excerpt.replace(/<(?:.|\n)*?>/gm, '').replace(/\[.*?\]/g, "");

        var wbc_element_html = ''+
            '<div class="wbcvpb_element" data-shortcode="'+shortcode+'">'+
            '<div class="element_name">'+
            '<span class="element_name_inner">'+title+'</span>'+
            '<span class="element_excerpt">'+excerpt+'</span>'+
            '</div>'+
            '<span class="wbcvpb_element_delete wbcvpb_tooltip" title="'+wbcvpb_from_WP.delete_element+'"><i class="pi-delete"></i></span>'+
            '<span class="wbcvpb_element_duplicate wbcvpb_tooltip" title="'+wbcvpb_from_WP.duplicate_element+'"><i class="pi-duplicate"></i></span>'+
            '<span class="wbcvpb_element_edit wbcvpb_tooltip" title="'+wbcvpb_from_WP.edit_element+'"><i class="pi-edit"></i></span>'+
            '<span class="wbcvpb_add_element"><span>'+wbcvpb_from_WP.add_element+'</span></span>'+
            '</div>';
        return wbc_element_html;
    }

    function wbcvpb_switch_button(e){
        if(typeof e != 'undefined'){
            $(this).disableSelection();
            e.preventDefault();
        }
        if($('#wbcvpb_wbc_activated').is(':checked')){
            $wbcvpb_wrapper.hide();
            $wbcvpb_hidden_metabox.hide();
            $('#wbc_classic_and_wbcvpb_tabs').hide();
            $wbc_classic_editor.show();
            //scroll events fixes classic editor when initialized while display:none on it
            $(window).trigger('scroll');
            setTimeout(function(){
                $(window).trigger('scroll');
            },100);
            setTimeout(function(){
                $(window).trigger('scroll');
            },200);
            setTimeout(function(){
                $(window).trigger('scroll');
            },400);
            $('#wbcvpb_wbc_activated').prop('checked', false);
        }
        else{
            if(typeof tinymce !== 'undefined'){
                tinymce.triggerSave();
            }
            wbcvpb_activate_wbc('switch');
        }
    }

    function wbcvpb_activate_wbc(source){
        $wbc_classic_editor.hide();
        $wbcvpb_wrapper.show();
        $('#wbcvpb_wbc_activated').prop('checked', true);
        wbcvpb_generate_wbcvpb_from_content('',source);
        if($('#wbcvpb_content').data('mode')==='developer'){
            $wbcvpb_hidden_metabox.show();
        }
    }

    function wbcvpb_make_columns_sortable(){
        $( ".wbcvpb_section_row" ).sortable({
            items: "> .wbcvpb_column",
            handle: ".wbcvpb_move_column",
            axis: "x",
            revert: true,
            tolerance: "pointer",
            placeholder: "wbcvpb_column_placeholder",
            forcePlaceholderSize: true,
            start: function(e,ui){
                var item_width = ui.item.width();
                var item_height = ui.item.height();
                $('.wbcvpb_column_placeholder').width(item_width).height(item_height);
                ui.item.parents('.wbcvpb_section_row').addClass('sorting_row');
            },
            stop: function(e,ui){
                wbcvpb_make_columns_resizable();
                wbcvpb_rebuild_widths();
                wbcvpb_write_from_wbcvpb_to_editor();
                ui.item.parents('.wbcvpb_section_row').removeClass('sorting_row');
            },
            over: function(){
                wbcvpb_rebuild_widths();
            }
        });
    }

    function wbcvpb_make_columns_resizable(){
        $('.wbcvpb_column').not( ':last-child' ).resizable({
            handles: "e",
            containment: "parent",
            start: function( event, ui ) {
                var maxWidth = ui.element.width() + ui.element.next().width()-10;
                ui.element.resizable({maxWidth: maxWidth});
                $('.wbcvpb_column').each(function(){
                    var item_width = $(this).width();
                    $(this).data("initial_width", item_width);
                });
            },
            resize: function( event, ui ) {
                wbcvpb_resize_others(ui.element, ui.originalSize.width - ui.size.width);
                wbcvpb_columns_spans(ui.element.parent());
            },
            stop: function( event, ui ) {
                wbcvpb_write_from_wbcvpb_to_editor();
            }
        }).on('resize', function (e) {
            e.stopPropagation();
        });
    }

    function wbcvpb_make_elements_sortable(){
        $( ".wbcvpb_column" ).sortable({
            connectWith: ".wbcvpb_column",
            items: "> .wbcvpb_element",
            revert: true,
            tolerance: "pointer",
            cancel: ".wbcvpb_add_element",
            placeholder: "wbcvpb_element_placeholder",
            forcePlaceholderSize: true,
            stop: function(){
                wbcvpb_rebuild_widths();
                wbcvpb_write_from_wbcvpb_to_editor();
            },
            over: wbcvpb_rebuild_widths
        });
    }

    function wbcvpb_collapse_children(){
        var $children_wrapper = $( "#wbcvpb_popup_element_content" ).find( ".wbcvpb_children_wrapper" );
        if($children_wrapper.hasClass('sorting')){
            $children_wrapper.sortable("destroy").removeClass('sorting').find( ".wbcvpb_child" ).removeClass('collapsed').find('.wbcvpb_child_collapsable').slideDown(400);
            $('#wbcvpb_collapse_children').find('i').removeClass().addClass('pi-collapse');
        }
        else{
            $children_wrapper.find( ".wbcvpb_child" ).addClass('collapsed').find('.wbcvpb_child_collapsable').slideUp(400,'linear');
            $('#wbcvpb_collapse_children').find('i').removeClass().addClass('pi-expand');
            $children_wrapper.addClass('sorting').sortable({
                connectWith: ".wbcvpb_children_wrapper",
                items: "> .wbcvpb_child",
                handle: ".wbcvpb_child_header",
                cancel: ".wbcvpb_remove_child",
                axis: "y",
                tolerance: "pointer",
                placeholder: "wbcvpb_child_placeholder",
                forceHelperSize: true,
                forcePlaceholderSize: true,
                stop: function(event, ui){
                    wbcvpb_write_from_wbcvpb_to_editor();
                    wbcvpb_child_numbers();
                }
            });
        }
    }

    function wbcvpb_collapse_child(e){
        var $this = $(this);
        if(!$this.is(e.target) && e.target.localName!='span'){
            return;
        }
        var $children_wrapper = $( "#wbcvpb_popup_element_content" ).find( ".wbcvpb_children_wrapper" );
        $(this).next().slideToggle(400 ,function(){
            $(this).parent().toggleClass('collapsed');
            $('#wbcvpb_collapse_children').find('i').removeClass().removeClass('pi-expand').addClass('pi-collapse');

            if(!$children_wrapper.find('.wbcvpb_child').not('.collapsed').length > 0){
                wbcvpb_collapse_children();
            }
        });
        if($children_wrapper.hasClass('sorting')){
            $children_wrapper.sortable("destroy").removeClass('sorting');
        }
    }

    function wbcvpb_save_button_attribute_changed(){
        $('#wbcvpb_insert_element, #wbcvpb_save_section_settings, #wbcvpb_save_column_settings, #wbcvpb_popup_layout_save').addClass('attributes_changed');
    }

    function wbcvpb_write_from_wbcvpb_to_editor(no_history_update){
        if($wbcvpb_wrapper.hasClass('syntax_error')){
            return;
        }
        var output="";
        //sections output
        $wbcvpb_builder.find('.wbcvpb_content_section').each(function(){
            var sectionshortcode = $(this).data("shortcode").replace(/\*quot\*/g, '"');
            output += sectionshortcode+"";
            //output columns in section
            $(this).find(".wbcvpb_column").each(function(){
                var columnshortcode = $(this).data("shortcode");
                var span = $(this).data("span");
                output += columnshortcode.replace(/\*quot\*/g, '"').replace(/span='(\d+)'/,"span='"+span+"'")+"";
                //output elements in column
                $(this).find(".wbcvpb_element").each(function(){
                    output += $(this).data("shortcode").replace(/\n/g, '').replace(/\*quot\*/g, '"');
                });
                //end of output elements in column
                output += "[/column_wbc]";
            });
            //end of output columns in section
            output += "[/section_wbc]";
        });
        //end of sections output

        // if first change add initial to history
        if(wbcvpb_history.length==0){
            wbcvpb_history.unshift($('#wbcvpb_content').val());
        }

        // output = output.replace(/<p class="p_wbc">&nbsp;<\/p>/g, "[ep_wbc]");

        $('#wbcvpb_content').val(output);
        $('#content').val(output);
        // output = output.replace(/\r\n|\r|\n/g, "[br_wbc]");
        var editor = tinymce.get('content');
        if(editor!==undefined && editor!==null){
            editor.setContent(output);
        }

        console.log(output);

        // add to undo/redo history array
        if(!no_history_update){
            // if changed after undo, restart pointer
            if(wbcvpb_history_current!=0){
                wbcvpb_history_current = 0;
                $wbcvpb_redo_button.addClass('disabled');
            }
            if(wbcvpb_history.length >= max_history){
                wbcvpb_history.pop();
            }
            wbcvpb_history.unshift(output);
            $wbcvpb_undo_button.removeClass('disabled');
        }
    }

    function wbcvpb_generate_wbcvpb_from_content(content,source){
        if(source=='initial'){
            var $initial_content = $('#wbcvpb_initial_content');
            if($initial_content.length){
                content = $initial_content.val();
                $initial_content.remove();
            }
        }

        if(source=='switch'){
            content = $('#content').val();
        }

        var force_write_to_editor = false;

        $('.wbcvpb_section_wrapper').remove();
        $("#wbcvpb_builder_empty").hide();
        var output = '';
        var current_section,section_content,section_data,current_column,column_content,column_data,element_name,current_element;
        var index,column_index,no_of_sections = 0;
        var all_elements = wbcvpb_from_WP.wbcvpb_shortcode_names;

        //replace single quotes with double and vice versa (shortcode attributes must have double quotes for parser to work, html content single quotes, and wordpress saves html as double always)
        content = content.replace(/"/g, '*quot*').replace(/'/g, '"');

        //if there is any content not wrapped properly in section/column structure, show it in first section
        var initial_content = wp.shortcode.replace( 'section_wbc', content, function(){return ' ';} ).replace(/&nbsp;/g, ' ').replace(/<p> +<\/p>/g, ' ').trim();
        if(initial_content!==''){
            var column_handler_icons= '<div class="column_properties_baloon"><span class="wbcvpb_column_edit wbcvpb_tooltip" title="'+wbcvpb_from_WP.edit_column+'">'+wbcvpb_from_WP.edit_column+'</span><span class="column_size">12/12</span></div>';
            no_of_sections++;

            var element_out = wbcvpb_element_html('[text_wbc]'+initial_content+'[/text_wbc]','Text / HTML',initial_content);
            var column_out = wbcvpb_column_html('[column_wbc span=\'12\']','12',element_out);
            output += wbcvpb_section_html('[section_wbc]','',column_out,1);
        }
        // ******* parse sections in content ******* 
        do{
            current_section = wp.shortcode.next( 'section_wbc', content, index );
            if(current_section!==undefined){
                no_of_sections++;
                var section_title = '';
                var section_shortcode='[section_wbc';
                $.each(current_section.shortcode.attrs.named, function(attribute, value) {
                    section_shortcode += ' ' + attribute + "='"+ value +"'";
                    if( attribute==='section_title'){
                        section_title = value.replace(/\*quot\*/g, '"');
                    }
                });
                section_shortcode=section_shortcode+']';
                section_content = current_section.shortcode.content;
                var columns_output = '';
                column_index = 0;
                //  ******* parse columns in current section ******* 
                do{
                    current_column = wp.shortcode.next( 'column_wbc', section_content, column_index );
                    if(current_column!==undefined){
                        //get column atributes
                        var column_shortcode='[column_wbc';
                        $.each(current_column.shortcode.attrs.named, function(attribute, value) {
                            column_shortcode += ' ' + attribute + "='"+ value +"'";
                        });
                        column_shortcode=column_shortcode+']';
                        // ******* parse elements in current column ******* 
                        column_content = current_column.shortcode.content+'[last_wbcvpb_limit v=1]'; //last_wbcvpb_limit is to add dummy last shortcode, to fix WordPress wp.shortcode.next method which has problem when there is only one shortcode in string
                        var loop_exit=0;
                        var elements_output='';
                        do{
                            loop_exit++;
                            var element_shortcode=column_content.substring(column_content.indexOf("[")+1,Math.min(column_content.indexOf(" ",column_content.indexOf("[")), column_content.indexOf("]",column_content.indexOf("["))));
                            if(element_shortcode!==''){
                                current_element = wp.shortcode.next( element_shortcode, column_content );
                                if(typeof current_element !== 'undefined'){
                                    var element_name = wbcvpb_from_WP.wbcvpb_shortcode_names[current_element.shortcode.tag];
                                    if(element_name === undefined){
                                        element_name = '['+current_element.shortcode.tag+']';
                                    }
                                    if(element_name!=='[last_wbcvpb_limit]'){
                                        var shortcode = current_element.content;
                                        shortcode = shortcode.replace(/"/g, "'").replace(/\n/g, "");

                                        var element_content = current_element.shortcode.content;

                                        elements_output += wbcvpb_element_html(shortcode,element_name,element_content);
                                    }
                                    column_content = column_content.replace(current_element.content, '').trim();
                                }
                            }
                        }while(column_content.indexOf("[")>=0 && loop_exit<100);
                        // ******* end parsing elements in current column ******* 
                        columns_output += wbcvpb_column_html(column_shortcode, current_column.shortcode.attrs.named.span, elements_output);
                        column_index = current_column.index + 1;
                    }
                }while(current_column!==undefined);
                // ******* end parsing columns in current section ******* 
                output += wbcvpb_section_html(section_shortcode,section_title,columns_output);
                index = current_section.index + 1;
            }
        }while(current_section!==undefined);
        // ******* end parsing sections ******* 
        $wbcvpb_builder.append(output);
        $('.wbcvpb_content_section').each(function(){
            var count_columns = $(this).find('.wbcvpb_column').length;
            if(count_columns==12){
                $(this).find('.wbcvpb_add_column').addClass('wbcvpb_disabled');
            }
        });
        if(no_of_sections===0){
            $("#wbcvpb_builder_empty").show();
        }
        else{
            $("#wbcvpb_builder_empty").hide();
        }

        wbcvpb_make_columns_sortable();
        wbcvpb_make_columns_resizable();
        wbcvpb_make_elements_sortable();
        wbcvpb_rebuild_widths();

        if(force_write_to_editor){
            wbcvpb_write_from_wbcvpb_to_editor();
        }

    }

    function wbcvpb_element_selector_filter() {
        var value = $(this).val().toLowerCase();
        $("#wbcvpb_shortcodes_list").find("li").each(function() {
            var text = $(this).text().toLowerCase();
            if (text.search(value) > -1) {
                $(this).show();
            }
            else {
                $(this).hide();
            }
        });
    }

    function wbcvpb_icon_selector_filter() {
        var value = $(this).val().toLowerCase();
        $("#wbcvpb_icon_selector").find("li").each(function() {
            var text = $(this).find('i').attr('class').toLowerCase();
            if (text.search(value) > -1) {
                $(this).show();
            }
            else {
                $(this).hide();
            }
        });
    }

    function wbcvpb_add_section(e){
        e.preventDefault();
        $("#wbcvpb_builder_empty").hide();
        var $clicked = $(this);
        var $target = ($clicked.hasClass('wbcvpb_add_section_button')) ? $clicked.parent() : $('#wbcvpb_add_section_top');
        $target.after(wbcvpb_section_html('[section_wbc]', '', wbcvpb_column_html('[column_wbc span=\'12\']', '12', ''),1));
        wbcvpb_make_elements_sortable();
        wbcvpb_rebuild_widths();
        wbcvpb_write_from_wbcvpb_to_editor();
    }

    function wbcvpb_section_duplicate(e) {
        e.preventDefault();
        var $parent = $(this).parents('.wbcvpb_section_wrapper');
        $parent.clone().insertAfter($parent);
        var $new_section = $parent.next().find('.wbcvpb_content_section');
        $new_section.find('.ui-resizable-handle').remove();
        wbcvpb_out_of_grid($new_section);
        wbcvpb_columns_spans($new_section);
        var grid = Math.floor(wbcvpb_total_width($new_section)/12);
        wbcvpb_make_columns_sortable();
        wbcvpb_make_columns_resizable();
        $new_section.children('.wbcvpb_column.ui-resizable').resizable("option", {
            grid: [ grid, 10 ],
            minWidth: grid
        });
        wbcvpb_make_elements_sortable();
        wbcvpb_rebuild_widths();
        wbcvpb_write_from_wbcvpb_to_editor();
    }

    function wbcvpb_section_edit(e) {
        e.preventDefault();
        var offset = $(this).offset();
        var $section = $(this).parents('.wbcvpb_content_section');
        $('.editing_section').removeClass('editing_section');
        $section.addClass('editing_section');
        var selected_content = $section.data('shortcode');
        selected_content = selected_content.replace('\r\n','');
        var exploded = selected_content.split(' ');
        exploded = exploded[0].split(']');
        var shortcode = exploded[0].substring(1);

        var edit_data = wp.shortcode.next( shortcode, selected_content );
        var modal_content = wbcvpb_modal_content(shortcode, edit_data);
        var button_out = '<a href="#" class="button-primary" id="wbcvpb_save_section_settings">'+wbcvpb_from_WP.update_section_properties+'</a>';

        wbcvpb_open_element_modal(wbcvpb_from_WP.section_properties,'edit_section',modal_content,e.clientX,e.clientY,'');
    }

    function wbcvpb_save_section_settings(e) {
        e.preventDefault();
        var $editing_section = $('.editing_section');
        var section_title = '';
        var section_shortcode_output = "[section_wbc";
        $('#wbcvpb_popup_element_content .wbcvpb_shortcode_attribute').each( function() {
            if(($(this).attr('type')=='checkbox' && $(this).is(':checked')) || ($(this).attr('type')!=='checkbox' &&  $(this).val() !== '' )){
                section_shortcode_output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;') + "'" ;
                if( $(this).attr('name')==='section_title'){
                    section_title = $(this).val().replace(/'/g, '&rsquo;');
                }
            }
        });
        section_shortcode_output += ']';
        section_title = (section_title!='') ? section_title : wbcvpb_from_WP.untitled_section;
        $editing_section.find('.wbcvpb_section_heading h4').html(section_title);
        $editing_section.data('shortcode',section_shortcode_output).removeClass('editing_section');
        wbcvpb_close_modal();
        wbcvpb_write_from_wbcvpb_to_editor();
    }

    function wbcvpb_section_or_element_delete(e) {
        e.preventDefault();
        var r = confirm(wbcvpb_from_WP.are_you_sure);
        if (r === true){
            var $parent = $(this).parent();
            if($(this).hasClass('wbcvpb_section_delete')){
                $parent = $(this).parents('.wbcvpb_section_wrapper');
            }
            $parent.animate({
                height:"0px",
                minHeight:"0px",
                padding:"0px",
                marginTop:"0px",
                marginBottom:"0px",
                border:"0px",
                opacity:"0"
            }, 400, function(){
                $parent.remove();
                wbcvpb_rebuild_widths();
                wbcvpb_write_from_wbcvpb_to_editor();
                var no_of_sections = $(".wbcvpb_section_wrapper").length;
                if(no_of_sections === 0){
                    $("#wbcvpb_builder_empty").show();
                }
            });
        }
    }

    function wbcvpb_add_column(e) {
        e.preventDefault();
        var $this = $(this);
        if($this.hasClass('wbcvpb_disabled')){
            return;
        }
        $this.parents('.wbcvpb_column').after(wbcvpb_column_html('[column_wbc span=\'1\']',1,''));
        var $row = $this.parents('.wbcvpb_section_row');
        var count = $row.children('.wbcvpb_column').length;
        if(count==12){
            $this.addClass('wbcvpb_disabled');
        }
        var column_width = Math.floor($row.width()/count);
        $row.children('.wbcvpb_column').each(function(){
            $(this).css("width", column_width+"px");
        });
        wbcvpb_out_of_grid($row);
        wbcvpb_columns_spans($row);
        var grid = Math.floor(wbcvpb_total_width($row)/12);
        $row.children('.wbcvpb_column.ui-resizable').resizable("option", {
            grid: [ grid, 10 ],
            minWidth: grid
        });
        wbcvpb_make_columns_sortable();
        wbcvpb_make_columns_resizable();
        wbcvpb_make_elements_sortable();
        wbcvpb_rebuild_widths();
        wbcvpb_write_from_wbcvpb_to_editor();
    }

    function wbcvpb_remove_column(e) {
        e.preventDefault();
        var r = confirm(wbcvpb_from_WP.column_delete_confirm);
        if (r !== true){
            return;
        }
        var $row = $(this).parents('.wbcvpb_section_row');
        var $delete_column = $(this).parents('.wbcvpb_column');
        $delete_column.remove();
        $row.find('.wbcvpb_add_column').removeClass('wbcvpb_disabled');
        var count = $row.children('.wbcvpb_column').length;
        if(count==0){
            $row.append(wbcvpb_column_html('[column_wbc span=\'1\']',12,''));
            count=1;
        }
        var column_width = Math.floor($row.width()/count);
        $row.children('.wbcvpb_column').each(function(){
            $(this).css("width", column_width+"px");
        });
        var $last_column_child = $row.children('.wbcvpb_column:last-child');
        if($last_column_child.hasClass('ui-resizable')){
            $last_column_child.resizable("destroy");
        }
        wbcvpb_out_of_grid($row);
        wbcvpb_columns_spans($row);
        wbcvpb_rebuild_widths();
        wbcvpb_write_from_wbcvpb_to_editor();
    }

    function wbcvpb_column_edit(e) {
        e.preventDefault();
        var offset = $(this).offset();
        var $column = $(this).parent().parent();
        $('.editing_column').removeClass('editing_column');
        $column.addClass('editing_column');
        var selected_content = $column.data('shortcode');
        selected_content = selected_content.replace('\r\n','');
        var exploded = selected_content.split(' ');
        exploded = exploded[0].split(']');
        var shortcode = exploded[0].substring(1);

        var edit_data = wp.shortcode.next( shortcode, selected_content );
        var modal_content = wbcvpb_modal_content(shortcode, edit_data);
        var button_out = '<a href="#" class="button-primary" id="wbcvpb_save_column_settings">'+wbcvpb_from_WP.update_column_properties+'</a>';

        wbcvpb_open_element_modal(wbcvpb_from_WP.column_properties,'edit_column',modal_content,e.clientX,e.clientY,'');
    }

    function wbcvpb_save_column_settings(e) {
        e.preventDefault();
        var $editing_column = $('.editing_column');
        var current_span = $editing_column.data('span');
        var column_shortcode_output = "[column_wbc span='"+current_span+"'";
        $('#wbcvpb_popup_element_content .wbcvpb_shortcode_attribute').each( function() {
            if(($(this).attr('type')=='checkbox' && $(this).is(':checked')) || ($(this).attr('type')!=='checkbox' &&  $(this).val() !== '' )){
                column_shortcode_output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;') + "'" ;
            }
        });
        column_shortcode_output += ']';
        $editing_column.data('shortcode',column_shortcode_output).removeClass('editing_column');
        wbcvpb_close_modal();
        wbcvpb_write_from_wbcvpb_to_editor();
    }

    function wbcvpb_open_element_modal(name,action,content,x,y,child){
        var button_id = 'wbcvpb_insert_element';
        if(action=='edit_section'){
            button_id = 'wbcvpb_save_section_settings';
            action = 'edit';
        }
        if(action=='edit_column'){
            button_id = 'wbcvpb_save_column_settings';
            action = 'edit';
        }

        var position = ' style="top:'+y+'px;left:'+x+'px;"';
        var popup_html = ((action=='edit') ? '<div id="wbcvpb_popup" class="wbcvpb_modal_'+action+'">' : '')+
            '<div id="wbcvpb_popup_window_element"'+position+'>'+
            '<div id="wbcvpb_popup_element_content">'+
            '<div class="wbcvpb_popup_header">'+
            '<h2>'+name+'</h2>'+
            '</div>'+
            content+
            '</div>'+
            '<div id="wbcvpb_popup_element_footer">'+
            ((action=='new') ? '<a href="#" id="wbcvpb_popup_back_to_list"><i class="pi-undo"></i>'+wbcvpb_from_WP.back_to_list+'</a>' : '')+
            ((child!='')?'<a href="#" id="wbcvpb_collapse_children" class="wbcvpb_tooltip" title="'+wbcvpb_from_WP.collapse_children+'"><i class="pi-collapse"></i></a>':'')+
            '<a href="#" id="'+button_id+'" class="wbcvpb_tooltip" title="'+wbcvpb_from_WP.done+'"><i class="pi-done"></i></a>'+
            '<a href="#" id="wbcvpb_popup_close" class="wbcvpb_tooltip" title="'+wbcvpb_from_WP.cancel+'"><i class="pi-abort"></i></a>'+
            '</div>'+
            '</div>'+
            ((action=='edit') ? '<div id="wbcvpb_popup_backdrop"></div>' : '')+
            ((action=='edit') ? '</div>' : '');

        if(action=='edit'){
            $('body').append(popup_html);
        }
        else{
            $('#wbcvpb_popup').append(popup_html);
        }
        var $wbcvpb_popup_window_element = $('#wbcvpb_popup_window_element').draggable({handle:".wbcvpb_popup_header, #wbcvpb_popup_element_footer"});
        wbcvpb_fields_init_js();
        wbcvpb_popup_position($wbcvpb_popup_window_element);
    }

    function wbcvpb_open_select_modal(type,content,footer,x,y){
        var position = ' style="top:'+y+'px;left:'+x+'px;"';
        var popup_html ='<div id="wbcvpb_popup" class="wbcvpb_modal_'+type+'">'+
            '<div id="wbcvpb_popup_window_select"'+position+'>'+
            '<div id="wbcvpb_popup_content">'+
            '<div class="wbcvpb_popup_header">'+
            '<h2>'+wbcvpb_from_WP.select_element+'</h2>'+
            '<input type="text" id="wbcvpb_element_selector_filter" class="popup_search" placeholder="'+wbcvpb_from_WP.search+'" autofocus>'+
            '</div>'+
            content+
            '</div>'+
            '</div>'+
            '<div id="wbcvpb_popup_backdrop"></div>'+
            '</div>';
        $('body').append(popup_html);
        var $wbcvpb_popup_window_select = $('#wbcvpb_popup_window_select').draggable({handle:".wbcvpb_popup_header"});
        wbcvpb_popup_position($wbcvpb_popup_window_select);
    }

    function wbcvpb_open_layout_modal(){
        console.log(ajaxurl);
        var popup_html ='<div id="wbcvpb_popup" class="">'+
            '<div id="wbcvpb_popup_window_select">'+
            '<div id="wbcvpb_popup_content" class="layouts_manager_content">'+
            '<div class="wbcvpb_popup_header">'+
            '<h2>'+wbcvpb_from_WP.select_layout+'</h2>'+
            '</div>'+
            '<div class="wbcvpb_loader"></div>'+
            '</div>'+
            '<div id="wbcvpb_popup_element_footer">'+
            '<input type="text" id="wbcvpb_layout_save_input" placeholder="'+wbcvpb_from_WP.new_layout+'">'+
            '<a href="#" id="wbcvpb_popup_layout_save" class="wbcvpb_tooltip" title="'+wbcvpb_from_WP.save_layout+'"><i class="pi-save"></i></a>'+
            '<a href="#" id="wbcvpb_popup_layout_abort" class="wbcvpb_tooltip" title="'+wbcvpb_from_WP.cancel+'"><i class="pi-abort"></i></a>'+
            '</div>'+
            '</div>'+
            '<div id="wbcvpb_popup_backdrop"></div>'+
            '</div>';
        $('body').append(popup_html);
        var $wbcvpb_popup_window_select = $('#wbcvpb_popup_window_select').draggable({handle:".wbcvpb_popup_header, #wbcvpb_popup_element_footer"});

        var data = {
            action: 'wbcvpb_layouts_list'
        };
        wbcvpb_init_tipsy();
        $.post(ajaxurl, data, function(response) {
            var layouts = response.split('|');
            var layouts_out = '';
            $.each(layouts,function(index,val){
                if(val!=''){
                    layouts_out += '<div class="wbcvpb_popup_layout_content">'+
                        '<span>'+val+'</span>'+
                        '<a class="wbcvpb_layout_content_delete">'+wbcvpb_from_WP.delete+'</a>'+
                        '<a class="wbcvpb_layout_content_overwrite">'+wbcvpb_from_WP.layout_overwrite+'</a>'+
                        '</div>';
                }
            });
            var $loader = $wbcvpb_popup_window_select.find('.wbcvpb_loader');
            $loader.after(layouts_out);
            $loader.remove();
        });
    }

    function wbcvpb_icon(e) {
        e.preventDefault();
        var $this = $(this);
        var selected = $this.find('i').attr('class');
        if(!$this.hasClass('active')){
            var icons_out='<div id="wbcvpb_icon_selector_wrapper">'+
                '<div id="wbcvpb_icon_selector" style="display:none;top:'+e.clientY+'px;left:'+e.clientX+'px;">'+
                '<div class="wbcvpb_popup_header">'+
                '<h2>'+wbcvpb_from_WP.select_icon+'</h2>'+
                '<input type="text" id="wbcvpb_icon_selector_filter" class="popup_search" placeholder="'+wbcvpb_from_WP.search+'" autofocus>'+
                '</div>';
            $.each(icons, function(index, icon_pack) {
                icons_out += '<div class="wbcvpb_iconset_title">'+icon_pack.name+'<span class="dashicons dashicons-arrow-up"></span></div>'+
                    '<ul>';
                $.each(icon_pack.icons, function(index, icon_name) {
                    icons_out += '<li class="wbcvpb_icon_selector_select'+((selected==icon_name)?' selected':'')+'"><i class="'+icon_name+'"></i></li>';
                });
                icons_out += '</ul>';
            });
            icons_out += '<div class="select_icon_info">'+wbcvpb_from_WP.select_icon_info+'</div>';
            icons_out += '</div>';
            icons_out += '<div id="wbcvpb_icon_selector_backdrop"></div>';
            icons_out += '</div>';
            $('body').append(icons_out);
            $('#wbcvpb_icon_selector').show().draggable({handle:'.wbcvpb_popup_header'});
            $('#wbcvpb_icon_selector_filter').focus();
        }
        else{
            wbcvpb_icon_close();
        }
        $this.toggleClass('active');
        wbcvpb_popup_position($('#wbcvpb_icon_selector'));
    }

    function wbcvpb_icon_selector_select(){
        var $this = $(this);
        var selected_icon = $this.find('i').attr('class');
        var $icon_field = $('.wbcvpb-icon.active');
        var $input_field = $icon_field.find('input');
        $icon_field.find('i').removeClass().addClass(selected_icon);
        $input_field.val(selected_icon).trigger('change');
        $input_field.parent().next().removeClass('hidden');
        wbcvpb_icon_close();
    }

    function wbcvpb_icon_remove(){
        var $this = $(this).addClass('hidden');
        $this.prev().find('i').removeClass();
        $this.prev().find('input').val('').trigger('change');
    }

    function wbcvpb_icon_close(){
        $('#wbcvpb_icon_selector_wrapper').remove();
        $('.wbcvpb-icon.active').removeClass('active');
    }

    function wbcvpb_popup_position($popup){
        if($popup.position() !== undefined){
            var position_top = $popup.position().top;
            if(position_top<0){
                $popup.css('top', '10px');
                position_top = 10;
            }
            var position_right = $popup.position().left + $popup.width();
            var position_bottom = $popup.position().top + $popup.height();
            var diff_width = $(window).width()-position_right;
            var diff_height = $(window).height()-position_bottom;
            if(diff_width<0){
                var new_left = $popup.position().left+diff_width-10;
                new_left = (new_left>0) ? new_left : 0;
                $popup.css('left',new_left+'px');
            }
            if(diff_height<0){
                var new_top = $popup.position().top+diff_height-10;
                new_top = (new_top>0) ? new_top : 0;
                $popup.css('top',new_top+'px');
            }
        }
    }

    function wbcvpb_close_modal(e){
        if(e!==undefined) e.preventDefault();

        $('body > .tipsy').remove();
        $('#wbcvpb_popup').remove();
        wbcvpb_icon_close();
        $('.active_add_element').removeClass('active_add_element');
        $('.editing_element').removeClass('editing_element');
        wbcvpb_rebuild_widths();
    }

    function close_modal_on_esc(e) {
        if (e.keyCode == 27) {
            wbcvpb_close_modal();
        }
    }

    function wbcvpb_add_element(e) {
        e.preventDefault();
        $('.after_element').removeClass('after_element');
        $(this).addClass('active_add_element').parent().addClass('after_element');
        var out_elements='<div id="wbcvpb_shortcodes_list">';
        $.each(element_categories, function(cat_index,category){
            var cat_out_elements = '';
            $.each(elements, function(index,element){
                if(element.type=='block' && element.category==category){
                    cat_out_elements += '<li data-element="'+index+'" data-category="'+element.category+'"><i class="'+element.icon+'"></i><span>'+element.name+'</span></li>';
                }
            });
            if(cat_out_elements!=''){
                out_elements += '<h3>'+category+'<span class="dashicons dashicons-arrow-up"></span></h3><ul>'+cat_out_elements+'</ul>';
            }
        });
        out_elements+='</div>';
        wbcvpb_open_select_modal('select',out_elements,'',e.clientX,e.clientY-100);
        $('#wbcvpb_element_selector_filter').focus();
    }

    function wbcvpb_attribute_fields(attribute_name, attribute, value){
        var class_out = (attribute.divider=='true') ? ' before_divider' : '';
        class_out += (attribute.tab!==undefined && attribute.tab!=wbcvpb_from_WP.general_tab) ? ' hidden_tab_content' : '';
        var tab_out = ' data-tab="'+((attribute.tab!==undefined) ? attribute.tab : wbcvpb_from_WP.general_tab)+'"';
        var attribute_fields = '<div class="wbcvpb_shortcode_attribute_row'+((attribute.type=='hidden')?' hidden':'')+class_out+'"'+tab_out+'><label for="wbcvpb_shortcode_attribute_'+attribute_name+'">'+attribute.description+'</label><div class="attribute">';
        var set_value = '';
        if(attribute.default!==undefined){
            set_value = attribute.default;
        }
        if(value!==undefined){
            set_value = value;
        }
        switch (attribute.type) {
            case "checkbox":
                var checked = (set_value=='1') ? ' checked' : '';
                attribute_fields += '<input type="checkbox" name="'+attribute_name+'" value="1" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute"'+checked+'>';
                break;
            case "textarea":
                attribute_fields += '<textarea name="'+attribute_name+'" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute">'+set_value+'</textarea>';
                break;
            case "select":
                attribute_fields += '<select name="'+attribute_name+'" value="" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute">';
                $.each(attribute.values, function(value, label){
                    attribute_fields += '<option value="'+value+'"'+((set_value==value) ? ' selected' :'')+'>'+label+'</option>';
                });
                attribute_fields += '</select>';
                break;
            case "color":
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute wbcvpb-colorpicker">';
                break;
            case "coloralpha":
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute wbcvpb-colorpicker" data-show-alpha="true" data-local-storage-key="spectrum.wbcvpb-alpha" data-preferred-format="rgb" data-max-selection-size="10">';
                break;
            case "icon":
                attribute_fields += '<div class="wbcvpb-icon"><i class="'+set_value+'"></i><div class="is-dd">▼</div><input type="hidden" name="'+attribute_name+'" value="'+set_value+'" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute"></div><span class="wbcvpb-icon-remove'+((set_value=='')?' hidden' : '')+'">'+wbcvpb_from_WP.remove+'</span>';
                break;
            case "gallery":
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute">';
                attribute_fields += '<input type="button" value="'+wbcvpb_from_WP.upload_gallery+'" class="button wbcvpb_upload_gallery_button">';
                break;
            case "image":
                attribute_fields += '<div class="wbcvpb_image_upload_image">'+((set_value!='')?'<img src="'+set_value+'">':'')+'</div>';
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute">';
                attribute_fields += '<input type="button" value="'+wbcvpb_from_WP.upload_image+'" class="button wbcvpb_upload_image_button">';
                attribute_fields += '<span class="wbcvpb_image_delete'+((set_value=='')?' display_none':'')+' wbcvpb_tooltip" title="'+wbcvpb_from_WP.delete_image+'"><i class="pi-delete"></i></span>';
                break;
            case "media":
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute">';
                attribute_fields += '<input type="button" value="'+wbcvpb_from_WP.upload_media+'" class="button wbcvpb_upload_image_button">';
                break;
            case "padding":
                attribute_fields += '<div class="wbcvpb-cross-wrapper">';
                attribute_fields += '<input type="hidden" name="'+attribute_name+'" value="'+set_value+'" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute wbcvpb-cross">';
                attribute_fields += '<div class="wbcvpb-cross-margin">';
                attribute_fields += '<span>'+wbcvpb_from_WP.cross_margin+'</span>';
                attribute_fields += '<input type="text" value="" placeholder="-" data-prop="margin-top" class="wbcvpb_cross_field wbcvpb-margin-top">';
                attribute_fields += '<input type="text" value="" placeholder="x" data-prop="margin-right" class="wbcvpb_cross_field wbcvpb-margin-right" title="'+wbcvpb_from_WP.property_disabled+'" disabled>';
                attribute_fields += '<input type="text" value="" placeholder="-" data-prop="margin-bottom" class="wbcvpb_cross_field wbcvpb-margin-bottom">';
                attribute_fields += '<input type="text" value="" placeholder="x" data-prop="margin-left" class="wbcvpb_cross_field wbcvpb-margin-left" title="'+wbcvpb_from_WP.property_disabled+'" disabled>';
                attribute_fields += '</div>';
                attribute_fields += '<div class="wbcvpb-cross-border">';
                attribute_fields += '<span>'+wbcvpb_from_WP.cross_border+'</span>';
                attribute_fields += '<input type="text" value="" placeholder="-" data-prop="border-top" class="wbcvpb_cross_field wbcvpb-border-top">';
                attribute_fields += '<input type="text" value="" placeholder="-" data-prop="border-right" class="wbcvpb_cross_field wbcvpb-border-right">';
                attribute_fields += '<input type="text" value="" placeholder="-" data-prop="border-bottom" class="wbcvpb_cross_field wbcvpb-border-bottom">';
                attribute_fields += '<input type="text" value="" placeholder="-" data-prop="border-left" class="wbcvpb_cross_field wbcvpb-border-left">';
                attribute_fields += '</div>';
                attribute_fields += '<div class="wbcvpb-cross-padding">';
                attribute_fields += '<span>'+wbcvpb_from_WP.cross_padding+'</span>';
                attribute_fields += '<input type="text" value="" placeholder="-" data-prop="padding-top" class="wbcvpb_cross_field wbcvpb-padding-top">';
                attribute_fields += '<input type="text" value="" placeholder="-" data-prop="padding-right" class="wbcvpb_cross_field wbcvpb-padding-right">';
                attribute_fields += '<input type="text" value="" placeholder="-" data-prop="padding-bottom" class="wbcvpb_cross_field wbcvpb-padding-bottom">';
                attribute_fields += '<input type="text" value="" placeholder="-" data-prop="padding-left" class="wbcvpb_cross_field wbcvpb-padding-left">';
                attribute_fields += '</div>';
                attribute_fields += '</div>';
                break;
            case "url":
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute wbcvpb-url-attr">';
                break;
            case "hidden":
                attribute_fields += '<input type="hidden" name="'+attribute_name+'" value="'+set_value+'" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute">';
                break;
            default:
                attribute_fields += '<input type="text" name="'+attribute_name+'" value="'+set_value+'" id="wbcvpb_shortcode_attribute_'+attribute_name+'" class="wbcvpb_shortcode_attribute">';
        }
        if(attribute.info!==undefined){
            attribute_fields += '<span class="wbcvpb_attribute_info">'+attribute.info+'</span>';
        }
        attribute_fields += '</div>';
        attribute_fields += '</div>';

        if(attribute.divider=='true'){
            attribute_fields += '<div class="divider'+class_out+'"'+tab_out+'></div>';
        }

        return attribute_fields;
    }

    function wbcvpb_fields_init_js(){
        $('.wbcvpb-url-attr').each(function(){
            var $this = $(this);
            var $url_row = $this.parents('.wbcvpb_shortcode_attribute_row');
            var $target_row = $url_row.next();
            if($target_row.hasClass('before_divider')){
                $url_row.addClass('before_divider');
            }
            $target_row.addClass('hidden').find('select').detach().insertAfter($this).addClass('wbcvpb-target');
        });
        $('.wbcvpb-colorpicker').each(function(){
            $(this).spectrum({
                showAlpha: false,
                showInput: true,
                showPalette: true,
                appendTo: $(this).parent(),
                showSelectionPalette: true,
                palette: [ ],
                localStorageKey: "spectrum.wbcvpb",
                maxSelectionSize: 9,
                showInitial: true,
                allowEmpty: true,
                preferredFormat: "hex",
                chooseText: "Select",
                cancelText: "cancel"
            });
        });
        if(typeof tinymce !== 'undefined'){
            $('.textarea_tinymce').each(function(){
                $(this).uniqueId();
                tinymce_options.selector = '#'+$(this).attr('id');
                tinymce.init(tinymce_options);
            });
        }
        $('.wbcvpb-cross').each(function(){
            var $this = $(this);
            var $parent = $this.parent('.wbcvpb-cross-wrapper');
            var value = $this.val();
            var values = value.split(';');
            if($.isArray(values) && values.length>0){
                $.each(values,function(i,val){
                    val = val.split(':');
                    var property = val[0].trim();
                    var prop_val = parseInt(val[1]);
                    $parent.find('.wbcvpb-'+property).val(prop_val);
                });
            }
        });
        $('#wbcvpb_popup_element_content').scrollTop(0);
        wbcvpb_init_tipsy();
    }

    function wbcvpb_modal_content(selected_element, edit_data){
        var tabs_out = {};
        tabs_out[wbcvpb_from_WP.general_tab] = '';
        var action_value = 'new';
        if(edit_data!==undefined){
            action_value = 'edit';
        }

        var main_content_out = '<input type="hidden" id="wbcvpb_action" value="'+action_value+'"><input type="hidden" id="wbcvpb_selected_element" value="'+selected_element+'">';

        var attributes_table_content = '';
        //if element has attributes
        if(elements[selected_element].attributes!==undefined){
            attributes_table_content += '<div class="wbcvpb_main_attributes">';
            $.each(elements[selected_element].attributes, function(attribute_name, attribute){
                var tab_name = (attribute.tab!==undefined) ? attribute.tab : wbcvpb_from_WP.general_tab;
                tabs_out[tab_name] = '<a href="#" class="wbcvpb_popup_tab'+((tab_name==wbcvpb_from_WP.general_tab)?' active':'')+'" data-name="'+tab_name+'">'+tab_name+'</a>';
                if(action_value=='edit'){
                    var field_value = edit_data.shortcode.attrs.named[attribute_name];
                    if( !(selected_element=='column_wbc' && attribute_name=='span') ){
                        attributes_table_content += wbcvpb_attribute_fields(attribute_name, attribute, field_value);
                    }
                }
                else{
                    attributes_table_content += wbcvpb_attribute_fields(attribute_name, attribute);
                }
            });
            attributes_table_content += '</div>';
        }

        //if element has child elements and action is new
        if(action_value=='new' && elements[selected_element].child!==undefined){
            attributes_table_content += '<div class="wbcvpb_children_wrapper">';
            attributes_table_content += '<div class="wbcvpb_child"><div class="wbcvpb_child_header"><span class="number">1</span>. <span class="title">'+elements[selected_element].child_title+'</span><a class="wbcvpb_remove_child">'+wbcvpb_from_WP.delete+'</a></div>';
            attributes_table_content += '<div class="wbcvpb_child_collapsable">';
            var child_name = elements[selected_element].child;
            //if child has attributes
            if(elements[child_name].attributes!==undefined){
                $.each(elements[child_name].attributes, function(attribute_name, attribute){
                    attributes_table_content += wbcvpb_attribute_fields(attribute_name, attribute);
                });
            }
            //if child has content
            if(elements[child_name].content!==undefined){
                attributes_table_content += '<label for="wbcvpb_child_content">'+elements[child_name].content.description+'</label>';
                attributes_table_content += '<textarea name="wbcvpb_child_content" class="wbcvpb_child_content textarea_tinymce"></textarea>';
            }

            attributes_table_content += '<div class="wbcvpb_child_button">';
            var button_text = (elements[selected_element].child_button != undefined) ? elements[selected_element].child_button : wbcvpb_from_WP.add_child;
            attributes_table_content += '<a href="#" class="wbcvpb_add_child"><span>+ '+button_text+'</span></a>';
            attributes_table_content += '</div>';

            attributes_table_content += '</div>';
            attributes_table_content += '</div>';
            attributes_table_content += '</div>';
        }

        //if element has child elements and action is edit
        else if(action_value=='edit' && elements[selected_element].child!==undefined && edit_data.shortcode.content!==undefined){
            attributes_table_content += '<div class="wbcvpb_children_wrapper">';
            var child_content = edit_data.shortcode.content;
            child_content = child_content+'[last_wbcvpb_limit v=1]'; //last_wbcvpb_limit is to add dummy last shortcode, to fix WordPress wp.shortcode.next method which has problem when there is only one shortcode in string
            var loop_exit=0;
            do{
                loop_exit++;
                var child_shortcode=elements[selected_element].child;

                if(child_shortcode!==''){
                    var current_element = wp.shortcode.next( child_shortcode, child_content );
                    if(typeof current_element !== 'undefined'){
                        var element_name = current_element.name;
                        if(element_name!=='[last_wbcvpb_limit]'){
                            attributes_table_content += '<div class="wbcvpb_child"><div class="wbcvpb_child_header"><span class="number">'+loop_exit+'</span>. <span class="title">'+elements[selected_element].child_title+'</span><a class="wbcvpb_remove_child">'+wbcvpb_from_WP.delete+'</a></div>';
                            attributes_table_content += '<div class="wbcvpb_child_collapsable">';

                            var child_name = elements[selected_element].child;
                            //if child has attributes
                            if(elements[child_name].attributes!==undefined){
                                $.each(elements[child_name].attributes, function(attribute_name, attribute){
                                    var child_att_value_out = (current_element.shortcode.attrs.named[attribute_name]!==undefined) ? current_element.shortcode.attrs.named[attribute_name] : '';
                                    attributes_table_content += wbcvpb_attribute_fields(attribute_name, attribute, child_att_value_out);
                                });
                            }
                            //if child has content
                            if(elements[child_name].content!==undefined){
                                var child_content_out = (current_element.shortcode.content!==undefined) ? current_element.shortcode.content : '';
                                attributes_table_content += '<label for="wbcvpb_child_content">'+elements[child_name].content.description+'</label>';
                                attributes_table_content += '<textarea name="wbcvpb_child_content" class="wbcvpb_child_content textarea_tinymce">'+child_content_out.replace(/\[br_wbc\]/g, '<br>').replace(/\[nbsp_wbc\]/g, '&nbsp;')+'</textarea>';
                            }


                            attributes_table_content += '<div class="wbcvpb_child_button">';
                            var button_text = (elements[selected_element].child_button != undefined) ? elements[selected_element].child_button : wbcvpb_from_WP.add_child;
                            attributes_table_content += '<a href="#" class="wbcvpb_add_child"><span>+ '+button_text+'</span></a>';
                            attributes_table_content += '</div>';


                            attributes_table_content += '</div>';
                            attributes_table_content += '</div>';
                        }
                        child_content = child_content.replace(current_element.content, '').trim();
                    }
                }
            }while(child_content.indexOf("[")>=0 && loop_exit<100);
            attributes_table_content += '</div>';

        }

        //if element has content
        else if(elements[selected_element].content!==undefined && selected_element!='section_wbc' && selected_element!='column_wbc'){
            var content_value = (action_value=='edit' && edit_data.shortcode.content!==undefined) ? edit_data.shortcode.content : '';
            attributes_table_content += '<div class="wbcvpb_main_content">';
            attributes_table_content += '<label for="wbcvpb_element_content">'+elements[selected_element].content.description+'</label>';
            attributes_table_content += '<textarea name="wbcvpb_element_content" class="wbcvpb_element_content textarea_tinymce">'+content_value.replace(/\[br_wbc\]/g, '<br>').replace(/\[nbsp_wbc\]/g, '&nbsp;')+'</textarea>';
            attributes_table_content += '</div>';
        }


        var tabs_content_out = '<div id="wbcvpb_popup_tabs">';
        var tabs_no = 0;
        $.each(tabs_out, function(i,value){
            tabs_no++;
            tabs_content_out += value;
        });
        tabs_content_out += '</div>';

        if(tabs_no>1){
            main_content_out += tabs_content_out;
        }

        main_content_out += '<div class="wbcvpb_attributes_table'+((tabs_no>1) ? '' : ' wbcvpb_attributes_table_no_tabs')+'">';
        if(elements[selected_element].notice!==undefined){
            main_content_out += '<div class="wbcvpb_popup_element_description">'+elements[selected_element].notice+'</div>';
        }
        main_content_out += attributes_table_content;
        main_content_out += '</div>';


        return main_content_out;
    }

    function wbcvpb_popup_element_select(e){
        e.preventDefault();
        var $wbcvpb_popup_window_select = $('#wbcvpb_popup_window_select');
        var position = $wbcvpb_popup_window_select.position();
        $wbcvpb_popup_window_select.hide();
        var selected_element = $(this).data('element');
        var main_content_out = wbcvpb_modal_content(selected_element);
        var child = (elements[selected_element].child!=undefined) ? elements[selected_element].child : '';
        wbcvpb_open_element_modal(elements[selected_element].name,'new',main_content_out,position.left,position.top,child);
    }

    function wbcvpb_popup_back_to_list(e){
        e.preventDefault();
        $('#wbcvpb_popup_window_element').remove();
        $('#wbcvpb_popup_window_select').show();
        $('#wbcvpb_element_selector_filter').focus();
    }

    function wbcvpb_popup_tab(e){
        e.preventDefault();
        $('.wbcvpb_popup_tab').removeClass('active');
        var $selected_tab = $(this);
        var selected_tab_name = $selected_tab.data('name');
        $selected_tab.addClass('active');

        var $children = $('#wbcvpb_popup_element_content').find('.wbcvpb_child');
        if(selected_tab_name!=wbcvpb_from_WP.general_tab){
            $children.addClass('hidden_tab_content');
            $('.wbcvpb_main_content').addClass('hidden_tab_content');
            $('#wbcvpb_collapse_children').addClass('hidden_tab_content');
        }
        else{
            $children.removeClass('hidden_tab_content');
            $('.wbcvpb_main_content').removeClass('hidden_tab_content');
            $('#wbcvpb_collapse_children').removeClass('hidden_tab_content');
        }

        $('#wbcvpb_popup_element_content').find('.wbcvpb_shortcode_attribute_row, .divider').addClass('hidden_tab_content').each(function(){
            if($(this).data('tab')==selected_tab_name){
                $(this).removeClass('hidden_tab_content');
            }
        });
    }

    function wbcvpb_element_edit(e) {
        var $this = $(this);
        var $parent = $this.parent();
        var offset = $this.offset();
        var selected_content = $parent.data('shortcode').replace(/\*quot\*/g, '"');
        var exploded = selected_content.split(' ');
        exploded = exploded[0].split(']');
        var shortcode = exploded[0].substring(1);
        $('.editing_element').removeClass('editing_element');
        $parent.addClass('editing_element');

        var selected_content = selected_content+'[last_wbcvpb_limit v=1]';
        var edit_data = wp.shortcode.next( shortcode, selected_content );

        var main_content_out = wbcvpb_modal_content(shortcode, edit_data);
        var child = (elements[shortcode].child!=undefined) ? elements[shortcode].child : '';

        wbcvpb_open_element_modal(elements[shortcode].name,'edit',main_content_out,e.clientX,e.clientY,child);
    }

    function wbcvpb_insert_element(e) {
        e.preventDefault();
        if(typeof tinymce !== 'undefined'){
            tinymce.triggerSave();
        }
        var action = $('#wbcvpb_action').val();
        var selected_shortcode = $('#wbcvpb_selected_element').val();
        var shortcode_title = elements[selected_shortcode].name;
        var wbcvpb_shortcode_child_name = elements[selected_shortcode].child;
        var output = '[' + selected_shortcode;
        $('.wbcvpb_main_attributes .wbcvpb_shortcode_attribute').each( function() {
            if( ( $(this).attr('type') == 'checkbox' && $(this).is(':checked') ) || ($(this).attr('type') !== 'checkbox' &&  $(this).val() !== '' )){
                output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;') + "'" ;
            }
        });
        output += ']';
        // children
        var count_children=0;
        var element_content_print = '';
        var children_element_content = '';

        $('.wbcvpb_child').each(function() {
            output += '[' + wbcvpb_shortcode_child_name;
            $(this).find('.wbcvpb_shortcode_attribute').each(function() {
                if( ( $(this).attr('type') == 'checkbox' && $(this).is(':checked') ) || ($(this).attr('type') !== 'checkbox' &&  $(this).val() !== '' )){
                    output += ' ' + $(this).attr('name') + "='" + $(this).val().replace(/'/g, '&rsquo;')  + "'" ;
                }
            });
            children_element_content += ($(this).find('.wbcvpb_child_content').val()!==undefined) ? $(this).find('.wbcvpb_child_content').val()+' ' : '';
            output += ']';
            output += (($(this).find('.wbcvpb_child_content').val()!==undefined) ? $(this).find('.wbcvpb_child_content').val().replace(/<br\s*\/?>/ig, '[br_wbc]').replace(/&nbsp;/g, "[nbsp_wbc]") : '') + '[/' + wbcvpb_shortcode_child_name + ']';
            count_children++;
        });
        // content and wrap shortcode
        if (count_children === 0){
            var wbcvpb_element_content = (($('.wbcvpb_element_content').val()!==undefined) ? $('.wbcvpb_element_content').val().replace(/<br\s*\/?>/ig, '[br_wbc]').replace(/&nbsp;/g, "[nbsp_wbc]") : '') + '[/' + selected_shortcode + ']';
            output += wbcvpb_element_content;
            element_content_print += wbcvpb_element_content;
        }
        else{
            output += '[/' + selected_shortcode + ']';
        }
        output=output.replace(/"/g, '*quot*');

        if($wbcvpb_wrapper.is(':visible')){
            if(action==='new'){
                $('.after_element').after(wbcvpb_element_html(output,shortcode_title,children_element_content+element_content_print));
                $('.after_element').removeClass('after_element');
                wbcvpb_rebuild_widths();
            }
            else if(action==='edit'){
                element_content_print = $('<div>' +children_element_content+element_content_print.replace(/</g,' <').replace(/>/g,'> ').replace(/\[/g,' <').replace(/\]/g,'> ')+'</div>').text().replace(/[^\w\s]/g, '');
                $('.editing_element').find('.element_excerpt').html(element_content_print);
                $('.editing_element').data('shortcode',output).removeClass('editing_element');
            }
            wbcvpb_write_from_wbcvpb_to_editor();
        }
        else{
            window.send_to_editor(output);
        }
        wbcvpb_close_modal();
    }

    function wbcvpb_element_duplicate(e) {
        e.preventDefault();
        var $parent = $(this).parent();
        $parent.clone().insertAfter($parent);
        wbcvpb_rebuild_widths();
        wbcvpb_write_from_wbcvpb_to_editor();
    }

    function wbcvpb_add_child(e) {
        e.preventDefault();
        var $after_child = $(this).parents('.wbcvpb_child');
        var $new_child = $after_child.clone().hide().detach().insertAfter($after_child).slideDown(800);

        $new_child.find('.wbcvpb-colorpicker').each(function(){
            $(this).show().siblings().remove();
        }).spectrum({
            showAlpha: true,
            showInput: true,
            showPalette: true,
            showSelectionPalette: true,
            palette: [ ],
            localStorageKey: "spectrum.wbcvpb",
            maxSelectionSize: 10,
            showInitial: true,
            allowEmpty: true,
            preferredFormat: "hex",
            chooseText: wbcvpb_from_WP.spectrum_select,
            cancelText: wbcvpb_from_WP.spectrum_cancel
        });

        if(typeof tinymce !== 'undefined'){
            var $cloned_editor = $new_child.find(".mce-tinymce");
            var $textarea = $cloned_editor.next("textarea");
            $textarea.insertBefore($cloned_editor).show().attr('id', '').uniqueId();
            var textarea_id = $textarea.attr('id');
            $cloned_editor.remove();

            tinymce_options.selector = '#'+textarea_id;
            tinymce.init(tinymce_options);
        }
        wbcvpb_child_numbers();
    }

    function wbcvpb_remove_child(e) {
        e.preventDefault();
        var $parent = $(this).parents('.wbcvpb_child').addClass('disabled');
        var $children_wrapper = $parent.parent();
        if($children_wrapper.children('.wbcvpb_child').length > 1){
            if($children_wrapper.hasClass('sorting')){
                $parent.remove();
            }
            else{
                $parent.slideUp(800,function(){
                    $(this).remove();
                    wbcvpb_child_numbers();
                });
            }
        }
        else{
            $parent.removeClass('disabled').find('input,textarea').val('');
        }
        if(!$children_wrapper.hasClass('sorting') && !$children_wrapper.find('.wbcvpb_child').not('.disabled').not('.collapsed').length > 0){
            wbcvpb_collapse_children();
        }
        wbcvpb_child_numbers();
    }

    function wbcvpb_child_numbers() {
        var order_no = 0;
        $('#wbcvpb_popup_element_content').find('.wbcvpb_child_header').each(function(){
            order_no++;
            $(this).find('.number').text(order_no);
        });
    }

    function wbcvpb_resize_others($item,diff){
        var $sibling = $item.next();
        var new_width = $sibling.data("initial_width") + diff;
        $sibling.css("width", new_width);
    }

    function wbcvpb_out_of_grid($item){
        var count = $item.children('.wbcvpb_column').length;
        var i = 0;
        var grid = Math.floor(wbcvpb_total_width($item)/12);
        if(count==5){
            $item.children('.wbcvpb_column').each(function(){
                var col_width = (i<2) ? grid*3 : grid*2;
                i++;
                $(this).css("width", col_width+"px");
            });
        }
        else if(count>6){
            $item.children('.wbcvpb_column').each(function(){
                var col_width = (i<1) ? grid*(12-count+1) : grid*1;
                i++;
                $(this).css("width", col_width+"px");
            });
        }
    }

    function wbcvpb_columns_spans($item){
        var total_width=0;
        $item.children('.wbcvpb_column').each(function(){
            total_width += $(this).width();
        }).each(function(){
            var span = Math.round($(this).width() / (total_width / 12));
            $(this).find('.column_properties_baloon .column_size').html(span + '/12');
            $(this).data("span",span).attr('class', $(this).get(0).className.replace(/(^|\s)colspan-\S+/g, '')).addClass('colspan-'+span);
        });
    }

    function wbcvpb_total_width($item){
        var total_width=0;
        $item.children('.wbcvpb_column').each(function(){
            total_width += $(this).width();
        });
        return total_width;
    }

    function wbcvpb_rebuild_widths(){
        wbcvpb_init_tipsy();
        $wbcvpb_builder.find('.wbcvpb_content_section').each(function(){
            var $current_section = $(this);
            var resize_sectionWidth = $current_section.width();
            var resize_grid = Math.floor(resize_sectionWidth/12);
            var $columns = $current_section.find('.wbcvpb_column');
            if($columns.length>=12){
                $columns.find('.wbcvpb_add_column').addClass('wbcvpb_disabled');
            }
            $columns.each(function(){
                var $current_column = $(this);
                var elements_no = $current_column.find('.wbcvpb_element').length;
                if(elements_no==0){
                    $current_column.addClass('wbcvpb_column_empty');
                }
                else{
                    $current_column.removeClass('wbcvpb_column_empty');
                }
                var resize_col_width = $current_column.data("span")*resize_grid;
                $current_column.css("width", resize_col_width+"px");
                var max_width = $current_column.width() + $current_column.next().width();
                if($current_column.hasClass('ui-resizable')){
                    if($current_column.is(":last-child")){
                        $current_column.resizable("destroy");
                    }
                    else{
                        $current_column.resizable( "option", {
                            grid: [ resize_grid, 10 ],
                            minWidth: resize_grid,
                            maxWidth: max_width
                        });
                    }
                }
            });
        });
    }

    function wbcvpb_layout_save(e){
        e.preventDefault();
        $('#wbcvpb_popup_content').append('<div id="wbcvpb_popup_content_loader"></div>');
        if($(this).hasClass('wbcvpb_layout_content_overwrite')){
            var name = $(this).parent().find('span').text();
            var source = 'overwrite';
        }
        else{
            var name = $('#wbcvpb_layout_save_input').val();
            var source = 'new';
        }
        if (name!=null && name!=''){
            var data = {
                action: 'wbcvpb_save_layout',
                source: source,
                name: name,
                layout: $('#wbcvpb_content').val()
            };
            console.log(data);
            $.post(ajaxurl, data, function(response) {
                alert(wbcvpb_from_WP.layout_saved);
                wbcvpb_close_modal();
            });
        }
        else{
            alert(wbcvpb_from_WP.layout_name_required);
            $('#wbcvpb_popup_content_loader').remove();
        }
    }

    function wbcvpb_layout_delete(e){
        e.preventDefault();
        $('#wbcvpb_popup_content').append('<div id="wbcvpb_popup_content_loader"></div>');

        var r = confirm(wbcvpb_from_WP.are_you_sure);
        $('#wbcvpb_popup_content_loader').remove();
        if (r !== true){
            return;
        }
        $('#wbcvpb_popup_content').append('<div id="wbcvpb_popup_content_loader"></div>');

        var $parent = $(this).parent();
        var name = $parent.find('span').text();
        if (name!=null && name!=''){
            var data = {
                action: 'wbcvpb_delete_layout',
                name: name,
            };
            $.post(ajaxurl, data, function(response) {
                $parent.slideUp();
                $('#wbcvpb_popup_content_loader').remove();
            });
        }
    }

    function wbcvpb_load_layout(e){
        var $select = $(this);
        if(!$select.is(e.target) && e.target.localName!='span'){
            return;
        }
        $('#wbcvpb_popup_content').append('<div id="wbcvpb_popup_content_loader"></div>');
        var selected_layout = $select.find('span').text();
        if(selected_layout!=''){
            var data = {
                action: 'wbcvpb_load_layout',
                selected_layout: selected_layout,
            };
            $.post(ajaxurl, data, function(response) {
                wbcvpb_generate_wbcvpb_from_content($('#wbcvpb_content').val()+response);
                wbcvpb_write_from_wbcvpb_to_editor();
                wbcvpb_close_modal();
            });
        }
    }

    function wbcvpb_cross(e) {
        var $parent = $(this).parents('.wbcvpb-cross-wrapper');
        var $hidden_field = $parent.find('.wbcvpb-cross');
        var $input_fields = $parent.find('.wbcvpb_cross_field');

        var output = '';
        $input_fields.each(function(){
            var $field = $(this);
            if($field.val()!=''){
                output += $field.data('prop')+':'+parseInt($field.val(),10)+'px;';
            }
        });
        $hidden_field.val(output).trigger('change');
    }

    function wbcvpb_upload_image_button(e) {
        e.preventDefault();
        var $input_field = $(this).prev();
        var custom_uploader = wp.media.frames.file_frame = wp.media({
            title: wbcvpb_from_WP.choose_image,
            button: {
                text: wbcvpb_from_WP.use_image
            },
            multiple: false
        }).on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $input_field.val(attachment.url).trigger('change');
            $input_field.next().next().removeClass('display_none');
            $input_field.prev().html('<img class="" src="'+attachment.url+'">');
        }).open();
    }

    function wbcvpb_image_delete(e) {
        e.preventDefault();
        var $this = $(this);
        $this.addClass('display_none');
        $this.prev().prev().val('').trigger('change').prev().html('');
    }

    function wbcvpb_upload_gallery_button(e) {
        e.preventDefault();
        var $input_field = $(this).prev();
        var ids = $input_field.val();
        ids = ids.replace(/,\s*$/, "");
        var gallerysc = '[gallery ids="' + $input_field.val() + '"]';
        wp.media.gallery.edit(gallerysc).on('update', function(g) {
            var id_array = [];
            $.each(g.models, function(id, img) { id_array.push(img.id); });
            var ids = id_array.join(",");
            ids = ids.replace(/,\s*$/, "");
            $input_field.val(ids).trigger('change');
        });
    }

    function wbcvpb_shortcodes_header_toggle(e){
        e.preventDefault();
        var $this = $(this);
        $this.next().slideToggle();
        $this.find('span').toggleClass('dashicons-arrow-up dashicons-arrow-down');
    }

    function wbcvpb_fullscreen_button(e){
        e.preventDefault();
        var gravity = ($('#wbcvpb_wrapper').hasClass('fullscreen')) ? 's' : 'n';
        $('#wbcvpb_tools').find('.wbcvpb_tooltip').data('gravity', gravity);
        $wbcvpb_wrapper.toggleClass('fullscreen');
        wbcvpb_rebuild_widths();
    }

    function wbcvpb_undo_redo(e){
        e.preventDefault();
        var $this=$(this);
        if($this.hasClass('disabled')){
            return;
        }
        if($this.hasClass('wbcvpb_undo_button')){
            wbcvpb_history_current++;
            $wbcvpb_redo_button.removeClass('disabled');
        }
        else{
            wbcvpb_history_current--;
            $wbcvpb_undo_button.removeClass('disabled');
        }
        if(wbcvpb_history_current<=0){
            $wbcvpb_redo_button.addClass('disabled');
        }
        if(wbcvpb_history_current>=wbcvpb_history.length-1){
            $wbcvpb_undo_button.addClass('disabled');
        }
        wbcvpb_generate_wbcvpb_from_content(wbcvpb_history[wbcvpb_history_current]);
        wbcvpb_write_from_wbcvpb_to_editor(true);
    }

    function prevent_body_scroll(ev) {
        var $this = $(this),
            scrollTop = this.scrollTop,
            scrollHeight = this.scrollHeight,
            height = $this.height(),
            delta = (ev.type == 'DOMMouseScroll' ?
            ev.originalEvent.detail * -40 :
                ev.originalEvent.wheelDelta),
            up = delta > 0;
        var prevent = function() {
            ev.stopPropagation();
            ev.preventDefault();
            ev.returnValue = false;
            return false;
        }
        if (!up && -delta > scrollHeight - height - scrollTop) {
            // Scrolling down, but this will take us past the bottom.
            $this.scrollTop(scrollHeight);
            return prevent();
        } else if (up && delta > scrollTop) {
            // Scrolling up, but this will take us past the top.
            $this.scrollTop(0);
            return prevent();
        }
    }
});
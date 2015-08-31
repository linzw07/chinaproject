jQuery(document).ready(function() {



/*-------------------------------------------------------------
		Toggle Button Option
-------------------------------------------------------------*/
jQuery('.ws-toggle-button').each(function(){

		default_value = jQuery(this).find('input').val();

		if(default_value == 'true'){
			jQuery(this).addClass('on');
		} else {
			jQuery(this).addClass('off');
		}

		jQuery(this).click(function() {

			if(jQuery(this).hasClass('on')) {											   
																		   
					jQuery(this).removeClass('on').addClass('off');
					jQuery(this).find('input').val('false');

			} else {

					jQuery(this).removeClass('off').addClass('on');
					jQuery(this).find('input').val('true');
								
			}
		});
});




/*-------------------------------------------------------------
		Range Input Plugin
-------------------------------------------------------------*/

jQuery(".ws-range-input .range-input-selector").rangeinput();				


/*-------------------------------------------------------------
		Chosen Plugin
-------------------------------------------------------------*/

jQuery(".ws-chosen").chosen();


/*-------------------------------------------------------------
		Non-safe fonts type change
-------------------------------------------------------------*/
jQuery("#custom_fonts_list_1").change(function () {
												   
          jQuery("#custom_fonts_list_1 option:selected").each(function () {
			var type = jQuery(this).attr('data-type');										 
              jQuery('#custom_fonts_type_1').val(type); 
              });
		
 }).change();  
	
	
jQuery("#custom_fonts_list_2").change(function () {
												   
          jQuery("#custom_fonts_list_2 option:selected").each(function () {
			var type = jQuery(this).attr('data-type');										 
              jQuery('#custom_font_type_2').val(type); 
              });
		
 }).change(); 






/*-------------------------------------------------------------
		Custom Sidebar
-------------------------------------------------------------*/

jQuery("#add_sidebar_item").click(function(e) {
	 e.preventDefault();
			
				
				var clone_item = jQuery(this).parents('.custom-sidebar-wrapper').siblings('#selected-sidebar').find('.default-sidebar-item').clone(true);
				var clone_val = jQuery(this).siblings('#add_sidebar').val();
				if(clone_val == '') return;
				
				if(jQuery('#sidebars').val()){
				jQuery('#sidebars').val(jQuery('#sidebars').val()+','+jQuery("#add_sidebar").val());
				}else{
						jQuery('#sidebars').val(jQuery("#add_sidebar").val());
					}
				clone_item.removeClass('default-sidebar-item').addClass('sidebar-item');
				clone_item.find('.sidebar-item-value').attr('value', clone_val);
				clone_item.find('.slider-item-text').html(clone_val);
				jQuery("#selected-sidebar").append(clone_item);
				jQuery(".sidebar-item").fadeIn(300);
				jQuery("#add_sidebar").val("");
	
	});
	jQuery(".sidebar-item").css('display','block');
	
	jQuery(".delete-sidebar").click(function(e){
		e.preventDefault();
		jQuery(this).parent("#sidebar-item").fadeOut(300,function(){
  			jQuery(this).remove();
  			jQuery('#sidebars').val('');
			jQuery(".sidebar-item-value").each(function(){
				if(jQuery('#sidebars').val()){
					jQuery('#sidebars').val(jQuery('#sidebars').val()+','+jQuery(this).val());
		
				}else{
					jQuery('#sidebars').val(jQuery(this).val());
					
				}
				
				
			});
 		});
		
	});	




/*-------------------------------------------------------------
		Super links
-------------------------------------------------------------*/
 function super_link() {
		var wrap = jQuery(".superlink-wrap");
		wrap.each(function(){
			var field = jQuery(this).siblings('input:hidden');
			var selector = jQuery(this).siblings('select');
			var name = field.attr('name');
			var items = jQuery(this).children();
			selector.change(function(){
				items.hide();
				jQuery("#"+name+"_"+jQuery(this).val()).show();
				field.val('');
			});
			items.change(function(){
				field.val(selector.val()+'||'+jQuery(this).val());
			})
		})
	}
super_link();


/*-------------------------------------------------------------
		Visual Selector Option
-------------------------------------------------------------*/

jQuery('.ws-visual-selector').find('a').each(function() {

	default_value = jQuery(this).siblings('input').val();
	jQuery(this).find('img').css('border-color', '#FCFCFC');
	jQuery(this).find('img').css('border-style', 'solid');
	jQuery(this).find('img').css('border-width', '4px');

	if(jQuery(this).attr('rel')==default_value){
			jQuery(this).addClass('current');
			jQuery(this).find('img').css('border-color', '#278ab7');
		}

		jQuery(this).click(function(){

			jQuery(this).siblings('input').val(jQuery(this).attr('rel'));
			jQuery(this).parent('.ws-visual-selector').find('.current').removeClass('current');
			jQuery(this).parent('.ws-visual-selector').find('img').css('border-color', '#FCFCFC');
			jQuery(this).addClass('current');
			jQuery(this).find('img').css('border-color', '#278ab7');
			return false;
		})


});

/*-------------------------------------------------------------
		Fancy Select Option
-------------------------------------------------------------*/

jQuery('.ws-advanced-selectbox').each(function(){
	
	var $this = jQuery(this);
	var select_heading = jQuery('.ws-selector-heading', this);
	var selector_width = jQuery('.ws-selector-heading', this).outerWidth();
	var select_options = jQuery('.ws-select-options', this);
	var selected_item_text = select_options.find('.selected').text();
	var selected_item_color = select_options.find('.selected').attr('data-color');


	select_options.css('width', selector_width-2);
	

		if($this.hasClass('color-based')) {
			if(selected_item_text != '') {
				select_heading.find('.selected_item').text(selected_item_text);
				select_heading.find('.selected_color').css('background', selected_item_color);
			} else {
				select_heading.find('.selected_item').text('Select Color ...')
			}
		} else {
			if(selected_item_text != '') {
				select_heading.find('.selected_item').text(selected_item_text)
			} else {
				select_heading.find('.selected_item').text('Select Option ...')
			}
		}

		select_options.addClass('hidden');

	select_heading.click(function(){
		if(select_options.hasClass('hidden')){
			$this.addClass('selectbox-focused');
			select_options.show().removeClass('hidden').addClass('visible');
		} else {
			select_options.hide().removeClass('visible').addClass('hidden');
			$this.removeClass('selectbox-focused');
		}
		
	})

	$this.bind('clickoutside', function (event) {
   			select_options.hide();
			select_options.removeClass('visible').addClass('hidden');
			$this.removeClass('selectbox-focused');
		});

	select_options_height = select_options.outerHeight();

	if(select_options_height > 300) {
		select_options.css({'height' : '300px', 'overflow' : 'scroll', 'overflow-x' : 'hidden'});
	}


		select_options.find('.ws-select-option').on('click', function(event) {
			event.stopPropagation();
			$select_option = jQuery(this);
			$select_option.siblings().removeClass('selected');
			$select_option.addClass('selected');
			$select_option.siblings('input').attr('value', $select_option.attr('value'));
			selected_item = $select_option.text();
			$select_option.parent('.ws-select-options').siblings('.ws-selector-heading').find('.selected_item').text(selected_item);
			$select_option.parent('.ws-select-options').hide().removeClass('visible').addClass('hidden');
			$select_option.parents('.ws-advanced-selectbox').removeClass('selectbox-focused');

			if($select_option.parents('.ws-advanced-selectbox').hasClass('color-based')){
				select_heading.find('.selected_color').css('background', $select_option.attr('data-color'));
			}

		})

})





// tabs

jQuery("ul.ws-sub-navigator",this).tabs("div.ws-sub-options > div", {tabs:'li',effect: 'default'});
	
jQuery("ul.ws-main-navigator",this).tabs("div.ws-main-options > div", {tabs:'li',effect: 'default'}); 

jQuery("ul.bg-image-preset-tabs",this).tabs("div.bg-image-preset-panes > div", {tabs:'li',effect: 'default'}); 


// Main Navigator Icons Transition

	jQuery(".ws-main-navigator li a")
	.hover(function() {
		
		jQuery(this).find('.active').stop(true, true).fadeIn(100);

	}, function() {
		if(jQuery(this).parent().hasClass('current')) {

		} else {
		jQuery(this).find('.active').stop(true, true).fadeOut(100);
			}
	});

	jQuery('.ws-main-navigator li').each(function(){

		if(jQuery(this).hasClass('current')) {
			jQuery(this).find('.active').show();
		}

		jQuery(this).click(function(){
			jQuery(".ws-main-navigator li ").find('.active').hide();
			jQuery(this).find('.active').show();
			
		})

	})


/*-------------------------------------------------------------
		General Background Selector
-------------------------------------------------------------*/

ms_background_orientation = jQuery('#background_selector_orientation').val();



/*
if(ms_background_orientation == 'full_width_layout') {
	jQuery('#boxed_layout_shadow_size_wrapper, #boxed_layout_shadow_intensity_wrapper').hide();
} else {
	jQuery('#boxed_layout_shadow_size_wrapper, #boxed_layout_shadow_intensity_wrapper').show();
}

*/

/* update background viewer accordingly */
jQuery('.ws-general-bg-selector').addClass(jQuery('#background_selector_orientation').val());

jQuery('.background_selector_orientation a').click(function(){
	if(jQuery(this).attr('rel') == 'full_width_layout'){
		jQuery('.ws-general-bg-selector').removeClass('boxed_layout').addClass('full_width_layout');
		jQuery('#boxed_layout_shadow_size_wrapper, #boxed_layout_shadow_intensity_wrapper').hide();
	} else {
		jQuery('.ws-general-bg-selector').removeClass('full_width_layout').addClass('boxed_layout');
		body_section_width = jQuery('.ws-general-bg-selector .outer-wrapper').width();
		jQuery('.ws-general-bg-selector.boxed_layout .body-section').css('width', body_section_width);
		jQuery('#boxed_layout_shadow_size_wrapper, #boxed_layout_shadow_intensity_wrapper').show();
	}
	
})






/* Background selector Edit panel */
function select_current_element() {
	var options_parent_div = jQuery('.bg-repeat-option, .bg-attachment-option, .bg-position-option');

	options_parent_div.each(function() {
			jQuery(this).find('a').on('click', function(event){
					event.preventDefault();
					jQuery(this).siblings().removeClass('selected').end().addClass('selected');
			})
	})

			jQuery('.bg-image-preset-panes').find('a').on('click', function(event) {
				event.preventDefault();
				jQuery(this).parents('.bg-image-preset-panes').find('li').removeClass('selected').end().end().parent().addClass('selected');

			})
}
select_current_element();




/* Call background Edit panel */
function call_background_edit() {
	var sections = jQuery('.header-section, .page-section, .footer-section, .body-section');

	sections.each(function() {
			jQuery(this).on('click', function(event){
					event.preventDefault();
					this_panel = jQuery(this);		
					this_panel_rel = jQuery(this).attr('rel');
							
					jQuery('#ws-bg-edit-panel').fadeIn(200);

				// gets current section input IDs
				color_id = '#' + this_panel_rel + '_color';
				image_id = '#' + this_panel_rel + '_image';
				position_id = '#' + this_panel_rel + '_position';
				repeat_id = '#' + this_panel_rel + '_repeat';
				attachment_id = '#' + this_panel_rel + '_attachment';
				source_id = '#' + this_panel_rel + '_source';

				color_value = jQuery(color_id).val();
				image_value = jQuery(image_id).val();
				position_value = jQuery(position_id).val();
				repeat_value = jQuery(repeat_id).val();
				attachment_value = jQuery(attachment_id).val();
				source_value = jQuery(source_id).val();



				

				jQuery('#bg_panel_color').attr('value', color_value);
				jQuery('#ws-bg-edit-panel a[rel="' + position_value + '"]').siblings().removeClass('selected').end().addClass('selected');
				jQuery('#ws-bg-edit-panel a[rel="' + repeat_value + '"]').siblings().removeClass('selected').end().addClass('selected');
				jQuery('#ws-bg-edit-panel a[rel="' + attachment_value + '"]').siblings().removeClass('selected').end().addClass('selected');
				//jQuery('.bg-background-type-tabs a[rel="' + source_value + '"]').parent('li').siblings().removeClass('current').end().addClass('current');

				if(source_value == 'preset' && image_value != ''){
					jQuery('#ws-bg-edit-panel a[rel="' + image_value + '"]').parent('li').siblings().removeClass('selected').end().addClass('selected');
				} else if(source_value == 'custom' && image_value != ''){
					
					jQuery('#bg_panel_upload').attr('value', image_value);
					jQuery('.custom-image-preview-block img').attr('src', jQuery('#bg_panel_upload').val());
				}

					jQuery('#ws-bg-edit-panel').attr('rel', jQuery(this).attr('rel'));
					jQuery('#ws-bg-edit-panel').find('.ws-edit-panel-heading').text(jQuery(this).attr('rel'));
					
					jQuery('.bg-background-type-tabs').find('a[rel="'+source_value+'"]').parent().siblings().removeClass('current').end().addClass('current');		


					jQuery('#ws-bg-edit-panel').find('.bg-background-type-panes').children('.bg-background-type-pane').hide();
					if(source_value == 'preset') {

						jQuery('#ws-bg-edit-panel').find('.bg-background-type-pane.bg-image-preset').show();

					} else if(source_value == 'no-image') {

						jQuery('#ws-bg-edit-panel').find('.bg-background-type-pane.bg-no-image').show();

					} else if(source_value == 'custom') {

						jQuery('#ws-bg-edit-panel').find('.bg-background-type-pane.bg-edit-panel-upload').show();
					}





			jQuery('#ws-bg-edit-panel').find('.bg-background-type-tabs a').on('click', function(event){

					event.preventDefault();

					jQuery('#ws-bg-edit-panel').find('.bg-background-type-panes').children('.bg-background-type-pane').hide();

					jQuery(this).parent().siblings().removeClass('current').end().addClass('current');

					if(jQuery(this).attr('rel') == 'preset') {

						jQuery('#ws-bg-edit-panel').find('.bg-background-type-pane.bg-image-preset').show();

					} else if(jQuery(this).attr('rel') == 'no-image') {

						jQuery('#ws-bg-edit-panel').find('.bg-background-type-pane.bg-no-image').show();

					} else if(jQuery(this).attr('rel') == 'custom') {

						jQuery('#ws-bg-edit-panel').find('.bg-background-type-pane.bg-edit-panel-upload').show();
					}
				})			
								
			})
	})

}
call_background_edit();


/* Background edit panel cancel and back buttons */
jQuery('#ws_cancel_bg_selector').on('click', function(event) {
	event.preventDefault();
	jQuery('#ws-bg-edit-panel').fadeOut(200);
})

/* Triggers cancel button for background panel when escape key is pressed */
jQuery(document).keyup(function(e) {
  if (e.keyCode == 27) { jQuery('#ws_cancel_bg_selector').click(); }
});

/* Triggers Apply button for background panel when enter key is pressed */
jQuery(document).keyup(function(e) {
  if (e.keyCode == 13) { jQuery('#ws_apply_bg_selector').click(); }
});

/* Sends Panel Modifications into inputs and updates preview panel background */
function update_panel_to_preview(){
	jQuery('#ws_apply_bg_selector').on('click', function(event){
		event.preventDefault();
		panel = jQuery('#ws-bg-edit-panel');
		panel_source = panel.attr('rel');
		section_preview_class = '.' + panel_source + '-section';
		color = panel.find('#bg_panel_color').val();
		position = jQuery('.bg-position-option').find('.selected').attr('rel');
		repeat = jQuery('.bg-repeat-option').find('.selected').attr('rel');
		attachment = jQuery('.bg-attachment-option').find('.selected').attr('rel');


		image_source = jQuery('.bg-background-type-tabs').find('.current').children('a').attr('rel');
		if(image_source == 'preset') {
			image = jQuery('.bg-image-preset-panes').find('.selected').children('a').attr('rel');
		} else if(image_source == 'custom') {
			image = jQuery('#bg_panel_upload').val();
		} else {
			image = '';
		}


		// gets current section input IDs
		color_id = '#' + panel_source + '_color';
		image_id = '#' + panel_source + '_image';
		position_id = '#' + panel_source + '_position';
		repeat_id = '#' + panel_source + '_repeat';
		attachment_id = '#' + panel_source + '_attachment';
		source_id = '#' + panel_source + '_source';

		// Updates Input values
		jQuery(color_id).attr('value', color);
		jQuery(image_id).attr('value', image);
		jQuery(position_id).attr('value', position);
		jQuery(repeat_id).attr('value', repeat);
		jQuery(attachment_id).attr('value', attachment);
		jQuery(source_id).attr('value', image_source);

		
		//update preview panel background
		jQuery(section_preview_class).css({
			'background-image' : 'url('+image+')',
			'background-color' : color,
			'background-position' : position,
			'background-repeat' : repeat,
			'background-attachment' : attachment,
		})





	panel.fadeOut(200);

		panel.find('#bg_panel_color').val('');
		jQuery('.bg-position-option').find('.selected').removeClass('selected');
		jQuery('.bg-repeat-option').find('.selected').removeClass('selected');
		jQuery('.bg-attachment-option').find('.selected').removeClass('selected');
		jQuery('#bg_panel_upload').val('');
		jQuery('.bg-image-preset-panes').find('.selected').removeClass('selected');
		jQuery('.custom-image-preview-block img').attr('src', '');
	})

}
update_panel_to_preview();




/* Update the preview panel backgrounds on load */
function update_preview_on_load(){
		
	jQuery('.page-section, .body-section, .header-section, .footer-section').each(function(){

		this_panel = jQuery(this);
		this_panel_rel = this_panel.attr('rel');

		// gets current section input IDs
		color_id = '#' + this_panel_rel + '_color';
		image_id = '#' + this_panel_rel + '_image';
		position_id = '#' + this_panel_rel + '_position';
		repeat_id = '#' + this_panel_rel + '_repeat';
		attachment_id = '#' + this_panel_rel + '_attachment';

		color = jQuery(color_id).val();
		image = jQuery(image_id).val();
		position = jQuery(position_id).val();
		repeat = jQuery(repeat_id).val();
		attachment = jQuery(attachment_id).val();

		//update preview panel background
		jQuery(this_panel).css({
			'background-image' : 'url('+image+')',
			'background-color' : color,
			'background-position' : position,
			'background-repeat' : repeat,
			'background-attachment' : attachment,
		})
	})
}

update_preview_on_load();


/*-------------------------------------------------------------
		Specific Background Selector
-------------------------------------------------------------*/

function specific_background_selector() {

jQuery('.ws-specific-bg-selector').each(function() {
var this_section_id = '#' + jQuery(this).attr('id');
background_source_type = jQuery(this_section_id).find('.specific-image-source').val();
jQuery(this_section_id).find('.bg-background-type-tabs li a').each(function() {
	if(jQuery(this).attr('rel') == background_source_type) {
		jQuery(this).parent().addClass('current');
	}
});


	if(background_source_type == 'preset') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-image-preset').show();

	} else if(background_source_type == 'no-image') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-no-image').show();

	} else if(background_source_type == 'custom') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-edit-panel-upload').show();
	}


jQuery(this_section_id).find('.bg-background-type-tabs li a').on('click', function(event) {
	event.preventDefault();

	jQuery(this_section_id).find('.specific-image-source').val(jQuery(this).attr('rel'));

	jQuery(this_section_id).find('.bg-background-type-panes').children('.bg-background-type-pane').hide()

	jQuery(this).parent().siblings().removeClass('current').end().addClass('current');

	if(jQuery(this).attr('rel') == 'preset') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-image-preset').show();

	} else if(jQuery(this).attr('rel') == 'no-image') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-no-image').show();

	} else if(jQuery(this).attr('rel') == 'custom') {

		jQuery(this_section_id).find('.bg-background-type-pane.specific-edit-panel-upload').show();
	}

})


	jQuery(this_section_id).find('.ws-specific-edit-option-repeat').each(function(){
		saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a[rel="' + saved_value + '"]').siblings().removeClass('selected').end().addClass('selected');
		repeat_saved_value = jQuery(this).find('input').val(); 

		jQuery(this).find('a').click(function() {

			this_rel = jQuery(this).attr('rel');
			jQuery(this).siblings('input').val(this_rel);
		})

	});



	jQuery(this_section_id).find('.ws-specific-edit-option-attachment').each(function(){
		saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a[rel="' + saved_value + '"]').siblings().removeClass('selected').end().addClass('selected');
		attachment_saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a').click(function() {

			this_rel = jQuery(this).attr('rel');
			jQuery(this).siblings('input').val(this_rel);
		})

	})




	jQuery(this_section_id).find('.ws-specific-edit-option-position').each(function(){
		saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a[rel="' + saved_value + '"]').siblings().removeClass('selected').end().addClass('selected');

		jQuery(this).find('a').click(function() {

			this_rel = jQuery(this).attr('rel');
			jQuery(this).siblings('input').val(this_rel);
		})

	})


	jQuery(this_section_id).find('.ws-specific-edit-option-position').each(function(){
		saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a[rel="' + saved_value + '"]').siblings().removeClass('selected').end().addClass('selected');

		jQuery(this).find('a').click(function() {

			this_rel = jQuery(this).attr('rel');
			jQuery(this).siblings('input').val(this_rel);
		})

	})



	jQuery(this_section_id).find('.specific-image-preset').each(function(){
		saved_value = jQuery(this).find('input').val(); 
		jQuery(this).find('a[rel="' + saved_value + '"]').parent().siblings().removeClass('selected').end().addClass('selected');

		jQuery(this).find('a').click(function() {

			this_rel = jQuery(this).attr('rel');
			jQuery(this).parents('.specific-image-preset').find('input').val(this_rel);
		})

	})

})


}

specific_background_selector();




});





/*-------------------------------------------------------------
		Save Wavesnow Options Data
-------------------------------------------------------------*/

jQuery(document).ready(function() {

    jQuery(".wavesnow-options-page form").each(function (){
        var that = jQuery(this);
        jQuery("button", that).bind("click keypress", function (){
            that.data("callerid", this.id);
        });
    });

		jQuery('form#wavesnow_settings').submit(function() {
			
 			var callerId = jQuery(this).data("callerid");

				  function newValues() {
					var serializedValues = jQuery('#wavesnow_settings input, #wavesnow_settings select, #wavesnow_settings textarea[name!=theme_export_options]').serialize();
						return serializedValues;
					}	
							jQuery(":hidden").change(newValues);
							jQuery("select").change(newValues);
							var serializedReturn = newValues();
				  		
							jQuery('#ws-saving-settings').bPopup({
					                    zIndex: 100,
					                    modalColor : '#fff',
							});
				  
				  data = serializedReturn + '&button_clicked=' + callerId;

				  jQuery.post(ajaxurl, data, function(response) {
				  	jQuery('#ws-saving-settings').bPopup().close();
					show_message(response);
				  })
				  
				  return false;
			  })


				/* Confirm Reset to default box */
				jQuery("#ws_reset_confirm").click(function() {
							jQuery('#ws-are-u-sure').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
							});						
							return false;
							});

				jQuery("#ws_reset_cancel").click(function() {
							jQuery('#ws-are-u-sure').bPopup().close();						
							return false;
							});

 				jQuery("#ws_reset_ok").click(function() {
							 jQuery('#ws-are-u-sure').bPopup().close();
							jQuery('#reset_theme_options').trigger('click');
							return false;
				});
 				/**************/	


		 		/* Disables enter key on options to prevent any unwilling submittions */		
				jQuery("#wavesnow_settings input").keypress(function(event) {
				    if (event.which == 13) {
				        event.preventDefault();
				  
				    }
				});

});


/* Show Box Messages */
function show_message(n) {
		if(n == 1) {
					jQuery('#ws-success-save').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});
					setTimeout(function(){
	    		jQuery('#ws-success-save').bPopup().close();
  					},1500);
		} 
		if(n == 0){
					jQuery('#ws-not-saved').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});
					setTimeout(function(){
	    				jQuery('#ws-not-saved').bPopup().close();
  					},1500);
					
		} 
		if(n == 2) {
					jQuery('#ws-already-saved').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});
					setTimeout(function(){
	    				jQuery('#ws-already-saved').bPopup().close();
  					},1500);
					
		}
		if(n == 3) {
			jQuery('#ws-success-reset').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});
			setTimeout(function(){
	    				location.reload();
  					},2000);					
		}
		if(n == 4) {
			jQuery('#ws-success-import').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});
			setTimeout(function(){
	    				location.reload();
  					},2000);					
		}
		if(n == 5) {
			jQuery('#ws-fail-import').bPopup({
			                    zIndex: 100,
			                    modalColor : '#fff',
					});	
			setTimeout(function(){
	    				jQuery('#ws-fail-import').bPopup().close();
  					},1500);					
		}
	}

/*-------------------------------------------------------------
		updates Body section width on window resize
-------------------------------------------------------------*/

var timer;
resize_body_section();
jQuery(window).resize(function(){
clearTimeout(timer);
setTimeout( resize_body_section, 100);
})  

function resize_body_section(){
		body_section_width = jQuery('.ws-general-bg-selector .outer-wrapper').width();
		jQuery('.ws-general-bg-selector.boxed_layout .body-section').css('width', body_section_width);
}
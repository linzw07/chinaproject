var WShortcode = {
	init : function(){
		jQuery('.shortcode_selector select').val('');
		jQuery('.shortcode_selector select').change(function(){
			jQuery(".shortcode_wrap").addClass('visuallyhidden');
			if(this.value !=''){
				var wrap = jQuery("#shortcode_"+this.value).removeClass('visuallyhidden');
				
			}
		});
		
		jQuery('#shortcode_insert').click(function(){
			WShortcode.sendToEditor();
			
		});
		
		var preview_url = jQuery('#shotcode_preview_iframeContainer').attr("src");	
		jQuery('#shortcode_preview').click(function(){
			WShortcode.sendToPreview(preview_url);
			
		});
		
		jQuery('.shortcode_sub_selector select').val('');
		/*jQuery('.shortcode_sub_selector select').change(function(){
			jQuery(this).closest('.shortcode_wrap').children('.sub_shortcode_wrap').addClass('visuallyhidden');
			if(this.value !=''){
				sub = jQuery("#sub_shortcode_"+this.value).removeClass('visuallyhidden');
			}
		});
		
		*/
		
		
		
		jQuery('.shortcode_sub_selector input').val('');
		
		/* This is work for only IE9+ and other morden browser.
		jQuery('#sc_Layouts_type span.selected_item').bind('DOMNodeInserted', function(e) {
   			jQuery(this).closest('.shortcode_wrap').children('.sub_shortcode_wrap').addClass('visuallyhidden');
			var tem=jQuery('.shortcode_sub_selector input[name="sc_layouts_selector"]').val();
			if(tem !=''){
				sub = jQuery("#sub_shortcode_"+tem).removeClass('visuallyhidden');
			}
		});

		*/
		
		
		jQuery('#shortcode_layouts span.ws-select-option').bind('click', function(e) {
   			jQuery(this).closest('.shortcode_wrap').children('.sub_shortcode_wrap').addClass('visuallyhidden');
			var tem=jQuery('.shortcode_sub_selector input[name="sc_layouts_selector"]').val();
			if(tem !=''){
				sub = jQuery("#sub_shortcode_"+tem).removeClass('visuallyhidden');
			}
		});
		

		jQuery('#shortcode_sitemap span.ws-select-option').bind('click', function(e) {
   			jQuery(this).closest('.shortcode_wrap').children('.sub_shortcode_wrap').addClass('visuallyhidden');
			var tem=jQuery('.shortcode_sub_selector input[name="sc_sitemap_selector"]').val();
			if(tem !=''){
				sub = jQuery("#sub_shortcode_"+tem).removeClass('visuallyhidden');
			}
		});
		
		
		
	
		
		
		
		
		
		
		
		var slides_number = jQuery('[name="sc_testimonial_slider_number"]').val();
		
		jQuery('#shortcode_testimonial_slider div.ws-single-option-wrapper').each(function(i){
			if(i>(3+slides_number*4)){
				jQuery(this).addClass('visuallyhidden');
			}else{
				jQuery(this).removeClass('visuallyhidden');
			}
		});
		
		
		jQuery('[name="sc_testimonial_slider_number"]').change(function(){
			var slides_number = jQuery(this).val();
			jQuery('#shortcode_testimonial_slider div.ws-single-option-wrapper').each(function(i){
				if(i>(3+slides_number*4)){
					jQuery(this).addClass('visuallyhidden');
				}else{
					jQuery(this).removeClass('visuallyhidden');
				}
			});
		});
		
		
		
		var slides_number = jQuery('[name="sc_slideshow_number"]').val();
		
		jQuery('#shortcode_slideshow div.ws-single-option-wrapper').each(function(i){
			if(i>(5+slides_number*3)){
				jQuery(this).addClass('visuallyhidden');
			}else{
				jQuery(this).removeClass('visuallyhidden');
			}
		});
		
		
		jQuery('[name="sc_slideshow_number"]').change(function(){
			var slides_number = jQuery(this).val();
			jQuery('#shortcode_slideshow div.ws-single-option-wrapper').each(function(i){
				if(i>(5+slides_number*3)){
					jQuery(this).addClass('visuallyhidden');
				}else{
					jQuery(this).removeClass('visuallyhidden');
				}
			});
		});
		
		
		
		
		var slides_number = jQuery('[name="sc_pricing_column"]').val();
		
		jQuery('#shortcode_pricing div.ws-single-option-wrapper').each(function(i){
			if(i>(slides_number*8)){
				jQuery(this).addClass('visuallyhidden');
			}else{
				jQuery(this).removeClass('visuallyhidden');
			}
		});
		
		
		jQuery('[name="sc_pricing_column"]').change(function(){
			var slides_number = jQuery(this).val();
			jQuery('#shortcode_pricing div.ws-single-option-wrapper').each(function(i){
				if(i>(slides_number*8)){
					jQuery(this).addClass('visuallyhidden');
				}else{
					jQuery(this).removeClass('visuallyhidden');
				}
			});
		});
				
		
		
		
		
		
		var tabs_number = jQuery('[name="sc_tabs_number"]').val();
		
		jQuery('#shortcode_tabs div.ws-single-option-wrapper').each(function(i){
			if(i>(1+tabs_number*2)){
				jQuery(this).addClass('visuallyhidden');
			}else{
				jQuery(this).removeClass('visuallyhidden');
			}
		});
		
		
		jQuery('[name="sc_tabs_number"]').change(function(){
			var tabs_number = jQuery(this).val();
			jQuery('#shortcode_tabs div.ws-single-option-wrapper').each(function(i){
				if(i>(1+tabs_number*2)){
					jQuery(this).addClass('visuallyhidden');
				}else{
					jQuery(this).removeClass('visuallyhidden');
				}
			});
		});
		




		var tabs_number = jQuery('[name="sc_vertical_tabs_number"]').val();
		
		jQuery('#shortcode_vertical_tabs div.ws-single-option-wrapper').each(function(i){
			if(i>(tabs_number*4)){
				jQuery(this).addClass('visuallyhidden');
			}else{
				jQuery(this).removeClass('visuallyhidden');
			}
		});
		
		
		jQuery('[name="sc_vertical_tabs_number"]').change(function(){
			var tabs_number = jQuery(this).val();
			jQuery('#shortcode_vertical_tabs div.ws-single-option-wrapper').each(function(i){
				if(i>(tabs_number*4)){
					jQuery(this).addClass('visuallyhidden');
				}else{
					jQuery(this).removeClass('visuallyhidden');
				}
			});
		});


		
		
		
		var gallery_number = jQuery('[name="sc_gallery_ws_number"]').val();
		
		jQuery('#shortcode_gallery_ws div.ws-single-option-wrapper').each(function(i){
			if(i>(2+gallery_number*2)){
				jQuery(this).addClass('visuallyhidden');
			}else{
				jQuery(this).removeClass('visuallyhidden');
			}
		});
		
		
		jQuery('[name="sc_gallery_ws_number"]').change(function(){
			var gallery_number = jQuery(this).val();
			jQuery('#shortcode_gallery_ws div.ws-single-option-wrapper').each(function(i){
				if(i>(2+gallery_number*2)){
					jQuery(this).addClass('visuallyhidden');
				}else{
					jQuery(this).removeClass('visuallyhidden');
				}
			});
		});
		
		
		
		
		jQuery('#shortcode_accordion div.ws-single-option-wrapper').each(function(i){
			if(i>(tabs_number*2)){
				jQuery(this).addClass('visuallyhidden');
			}else{
				jQuery(this).removeClass('visuallyhidden');
			}
		});
		jQuery('[name="sc_accordion_number"]').change(function(){
			var tabs_number = jQuery(this).val();
			jQuery('#shortcode_accordion div.ws-single-option-wrapper').each(function(i){
				if(i>(tabs_number*2)){
					jQuery(this).addClass('visuallyhidden');
				}else{
					jQuery(this).removeClass('visuallyhidden');
				}
			});
		});
	},
	
	
	
	generate:function(){
		var type = jQuery('.shortcode_selector select').val();
		switch( type ){
		case 'columns':
			var type = WShortcode.getVal('columns', 'type');
			if(type != ''){
				return '\n['+type+']\n'+WShortcode.getVal('columns', 'content')+'\n[/'+type+']\n';
			}else{
				return '';
			}
			break;
		case 'layouts':
			var sub_type = WShortcode.getVal('layouts','selector');
			switch(sub_type){
			case 'one_half_layout':
				return '\n[one_half]\n'+WShortcode.getVal('layouts', 'one_half_layout', '1')+'\n[/one_half]\n\n[one_half_last]\n'+WShortcode.getVal('layouts', 'one_half_layout', '2')+'\n[/one_half_last]\n';
				break;
			case 'one_third_layout':
				return '\n[one_third]\n'+WShortcode.getVal('layouts', 'one_third_layout', '1')+'\n[/one_third]\n\n[one_third]\n'+WShortcode.getVal('layouts', 'one_third_layout', '2')+'\n[/one_third]\n\n[one_third_last]\n'+WShortcode.getVal('layouts', 'one_third_layout', '3')+'\n[/one_third_last]\n';
				break;
			case 'one_fourth_layout':
				return '\n[one_fourth]\n'+WShortcode.getVal('layouts', 'one_fourth_layout', '1')+'\n[/one_fourth]\n\n[one_fourth]\n'+WShortcode.getVal('layouts', 'one_fourth_layout', '2')+'\n[/one_fourth]\n\n[one_fourth]\n'+WShortcode.getVal('layouts', 'one_fourth_layout', '3')+'\n[/one_fourth]\n\n[one_fourth_last]\n'+WShortcode.getVal('layouts', 'one_fourth_layout', '4')+'\n[/one_fourth_last]\n';
				break;
			case 'one_fifth_layout':
				return '\n[one_fifth]\n'+WShortcode.getVal('layouts', 'one_fifth_layout', '1')+'\n[/one_fifth]\n\n[one_fifth]\n'+WShortcode.getVal('layouts', 'one_fifth_layout', '2')+'\n[/one_fifth]\n\n[one_fifth]\n'+WShortcode.getVal('layouts', 'one_fifth_layout', '3')+'\n[/one_fifth]\n\n[one_fifth]\n'+WShortcode.getVal('layouts', 'one_fifth_layout', '4')+'\n[/one_fifth]\n\n[one_fifth_last]\n'+WShortcode.getVal('layouts', 'one_fifth_layout', '5')+'\n[/one_fifth_last]\n';
				break;
			case 'one_sixth_layout':
				return '\n[one_sixth]\n'+WShortcode.getVal('layouts', 'one_sixth_layout', '1')+'\n[/one_sixth]\n\n[one_sixth]\n'+WShortcode.getVal('layouts', 'one_sixth_layout', '2')+'\n[/one_sixth]\n\n[one_sixth]\n'+WShortcode.getVal('layouts', 'one_sixth_layout', '3')+'\n[/one_sixth]\n\n[one_sixth]\n'+WShortcode.getVal('layouts', 'one_sixth_layout', '4')+'\n[/one_sixth]\n\n[one_sixth]\n'+WShortcode.getVal('layouts', 'one_sixth_layout', '5')+'\n[/one_sixth]\n\n[one_sixth_last]\n'+WShortcode.getVal('layouts', 'one_sixth_layout', '6')+'\n[/one_sixth_last]\n';
				break;
			case 'one_third_two_third':
				return '\n[one_third]\n'+WShortcode.getVal('layouts', 'one_third_two_third', '1')+'\n[/one_third]\n\n[two_third_last]\n'+WShortcode.getVal('layouts', 'one_third_two_third', '2')+'\n[/two_third_last]\n';
				break;
			case 'two_third_one_third':
				return '\n[two_third]\n'+WShortcode.getVal('layouts', 'two_third_one_third', '1')+'\n[/two_third]\n\n[one_third_last]\n'+WShortcode.getVal('layouts', 'two_third_one_third', '2')+'\n[/one_third_last]\n';
				break;
			case 'one_fourth_three_fourth':
				return '\n[one_fourth]\n'+WShortcode.getVal('layouts', 'one_fourth_three_fourth', '1')+'\n[/one_fourth]\n\n[three_fourth_last]\n'+WShortcode.getVal('layouts', 'one_fourth_three_fourth', '2')+'\n[/three_fourth_last]\n';
				break;
			case 'three_fourth_one_fourth':
				return '\n[three_fourth]\n'+WShortcode.getVal('layouts', 'three_fourth_one_fourth', '1')+'\n[/three_fourth]\n\n[one_fourth_last]\n'+WShortcode.getVal('layouts', 'three_fourth_one_fourth', '2')+'\n[/one_fourth_last]\n';
				break;
			case 'one_fourth_one_fourth_one_half':
				return '\n[one_fourth]\n'+WShortcode.getVal('layouts', 'one_fourth_one_fourth_one_half', '1')+'\n[/one_fourth]\n\n[one_fourth]\n'+WShortcode.getVal('layouts', 'one_fourth_one_fourth_one_half', '2')+'\n[/one_fourth]\n\n[one_half_last]\n'+WShortcode.getVal('layouts', 'one_fourth_one_fourth_one_half', '3')+'\n[/one_half_last]\n';
				break;
			case 'one_fourth_one_half_one_fourth':
				return '\n[one_fourth]\n'+WShortcode.getVal('layouts', 'one_fourth_one_half_one_fourth', '1')+'\n[/one_fourth]\n\n[one_half]\n'+WShortcode.getVal('layouts', 'one_fourth_one_half_one_fourth', '2')+'\n[/one_half]\n\n[one_fourth_last]\n'+WShortcode.getVal('layouts', 'one_fourth_one_half_one_fourth', '3')+'\n[/one_fourth_last]\n';
				break;
			case 'one_half_one_fourth_one_fourth':
				return '\n[one_half]\n'+WShortcode.getVal('layouts', 'one_half_one_fourth_one_fourth', '1')+'\n[/one_half]\n\n[one_fourth]\n'+WShortcode.getVal('layouts', 'one_half_one_fourth_one_fourth', '2')+'\n[/one_fourth]\n\n[one_fourth_last]\n'+WShortcode.getVal('layouts', 'one_half_one_fourth_one_fourth', '3')+'\n[/one_fourth_last]\n';
				break;
			case 'four_fifth_one_fifth':
				return '\n[four_fifth]\n'+WShortcode.getVal('layouts', 'four_fifth_one_fifth', '1')+'\n[/four_fifth]\n\n[one_fifth_last]\n'+WShortcode.getVal('layouts', 'four_fifth_one_fifth', '2')+'\n[/one_fifth_last]\n';
				break;
			case 'one_fifth_four_fifth':
				return '\n[one_fifth]\n'+WShortcode.getVal('layouts', 'one_fifth_four_fifth', '1')+'\n[/one_fifth]\n\n[four_fifth_last]\n'+WShortcode.getVal('layouts', 'one_fifth_four_fifth', '2')+'\n[/four_fifth_last]\n';
				break;
			case 'two_fifth_three_fifth':
				return '\n[two_fifth]\n'+WShortcode.getVal('layouts', 'two_fifth_three_fifth', '1')+'\n[/two_fifth]\n\n[three_fifth_last]\n'+WShortcode.getVal('layouts', 'two_fifth_three_fifth', '2')+'\n[/three_fifth_last]\n';
				break;
			case 'three_fifth_two_fifth':
				return '\n[three_fifth]\n'+WShortcode.getVal('layouts', 'three_fifth_two_fifth', '1')+'\n[/three_fifth]\n\n[two_fifth_last]\n'+WShortcode.getVal('layouts', 'three_fifth_two_fifth', '2')+'\n[/two_fifth_last]\n';
				break;
			case 'one_sixth_five_sixth':
				return '\n[one_sixth]\n'+WShortcode.getVal('layouts', 'one_sixth_five_sixth', '1')+'\n[/one_sixth]\n\n[five_sixth_last]\n'+WShortcode.getVal('layouts', 'one_sixth_five_sixth', '2')+'\n[/five_sixth_last]\n';
				break;
			case 'five_sixth_one_sixth':
				return '\n[five_sixth]\n'+WShortcode.getVal('layouts', 'five_sixth_one_sixth', '1')+'\n[/five_sixth]\n\n[one_sixth_last]\n'+WShortcode.getVal('layouts', 'five_sixth_one_sixth', '2')+'\n[/one_sixth_last]\n';
				break;
			case 'one_sixth_one_sixth_one_sixth_one_half':
				return '\n[one_sixth]\n'+WShortcode.getVal('layouts', 'one_sixth_one_sixth_one_sixth_one_half', '1')+'\n[/one_sixth]\n\n[one_sixth]\n'+WShortcode.getVal('layouts', 'one_sixth_one_sixth_one_sixth_one_half', '2')+'\n[/one_sixth]\n\n[one_sixth]\n'+WShortcode.getVal('layouts', 'one_sixth_one_sixth_one_sixth_one_half', '3')+'\n[/one_sixth]\n\n[one_half_last]\n'+WShortcode.getVal('layouts', 'one_sixth_one_sixth_one_sixth_one_half', '4')+'\n[/one_half_last]\n';
				break;
			}
			break;
			
			// Icon List Styles
			case 'icon_list':
				var style = WShortcode.getVal('icon_list','style');
				var color = WShortcode.getVal('icon_list','color');
				if(style !== ''){
					style= ' style="'+style+'"';
				}
				if(color !== ''){
					color = ' color="'+color+'"';
				}
				return '[icon_list'+style+color+']'+WShortcode.getVal('icon_list','text')+'[/icon_list]\n';
			
			
			// Icon Box Styles
			case 'icon_box':
				var style = WShortcode.getVal('icon_box','style');
				var color = WShortcode.getVal('icon_box','color');
				var title = WShortcode.getVal('icon_box','title');
				var href = WShortcode.getVal('icon_box','href');
				var button_label = WShortcode.getVal('icon_box','button_label');
				var link_target = WShortcode.getVal('icon_box','link_target');

				if(style !== ''){
					style= ' style="'+style+'"';
				}
				if(color !== ''){
					color = ' color="'+color+'"';
				}
				if(title !== ''){
					title = ' title="'+title+'"';
				}
				if(href !== ''){
					href = ' href="'+href+'"';
				}
				if(button_label !== ''){
					button_label = ' button_label="'+button_label+'"';
				}
				if(link_target !== ''){
					link_target = ' link_target="'+link_target+'"';
				}
				return '[icon_box'+style+color+title+href+button_label+link_target+']'+WShortcode.getVal('icon_box','text')+'[/icon_box]\n';
			
			// Icon Link
			case 'icon_link':
				var style = WShortcode.getVal('icon_link','style');
				var href = WShortcode.getVal('icon_link','href');
				var link_target = WShortcode.getVal('icon_link','linkTarget');
				var color = WShortcode.getVal('icon_link','color');
				if(style !== ''){
					style= ' style="'+style+'"';
				}
				if(href !== ''){
					href= ' href="'+href+'"';
				}
  				if(link_target !== ''){
					link_target= ' link_target="'+link_target+'"';
				}				
				if(color !== ''){
					color = ' color="'+color+'"';
				}
				return '\n[icon_link'+style+color+href+link_target+']'+WShortcode.getVal('icon_link','text')+'[/icon_link]\n';
			
			
				// Fancy Heading
			case 'fancy_heading':
				var style = WShortcode.getVal('fancy_heading','style');
				var size = WShortcode.getVal('fancy_heading','size');
				if(style !== ''){
					style = ' style="'+style+'"';
				}				
				if(size !== ''){
					size = ' size="'+size+'"';
				}
				return '[fancy_heading'+style+size+']'+WShortcode.getVal('fancy_heading','content')+'[/fancy_heading]';
				break;
			
			// Dropcaps
			case 'dropcaps':
				var color = WShortcode.getVal('dropcaps','capscolor');
				var style = WShortcode.getVal('dropcaps','capsstyle');
				if(style !== ''){
					style = ' style="'+style+'"';
				}				
				return '[dropcaps'+style+']'+WShortcode.getVal('dropcaps','text')+'[/dropcaps]';
				break;
				
				
				
			// Blockquote	
			case 'blockquote':
				var align = WShortcode.getVal('blockquote','align');
				var cite = WShortcode.getVal('blockquote','cite');
				var style = WShortcode.getVal('blockquote','style');
				if(align !== ''){
					align = ' align="'+align+'"';
				}
				if(cite !== ''){
					cite = ' cite="'+cite+'"';
				}
				
				if(style !== ''){
					style = ' style="'+style+'"';
				}
				
				return '[blockquote'+align+style+cite+']'+ WShortcode.getVal('blockquote','content') +'[/blockquote]\n';
				break;
				
				
				
			// Pre, Code	
			case 'pre_code':
				var type = WShortcode.getVal('pre_code','type');
				if(type == ''){
					type ='code';
				}
				return '\n['+type+']\n'+WShortcode.getVal('pre_code','content')+'\n[/'+type+']\n';
				
				
				
			// Custom Icon Lists	
			case 'customlist':
				var style = WShortcode.getVal('customlist','style');
				var color = WShortcode.getVal('customlist','color');
				if(style !== ''){
					style= ' style="'+style+'"';
				}
				if(color !== ''){
					color = ' color="'+color+'"';
				}
				return '[list'+style+color+']\n'+WShortcode.getVal('customlist','content')+'\n[/list]\n';
			
			
			
	
			
			
			// Highlights
			case 'highlight':
				return '[highlight]'+WShortcode.getVal('highlight','content')+'[/highlight]';



			// Message Boxes
           case 'messageboxes':
				var t = WShortcode.getVal('messageboxes','type');
				if(t == ''){ t='info';}
				return '\n['+t+']\n'+WShortcode.getVal('messageboxes','content')+'\n[/'+t+']\n';
			
			
           
		   // Custom Box
		   case 'custom_box':
				var width = WShortcode.getVal('custom_box','width');
				var height = WShortcode.getVal('custom_box','height');
				var bgColor = WShortcode.getVal('custom_box','bgColor');
				var txtColor = WShortcode.getVal('custom_box','txtColor');
				var border_color = WShortcode.getVal('custom_box','border_color');
				var align = WShortcode.getVal('custom_box','align');
				var rounded = WShortcode.getVal('custom_box','rounded');
				

				if(width!=0){
					width = ' width="'+width+'"';
				}else{
					width ='';
				}

				if(height!=0){
					height = ' height="'+height+'"';
				}else{
					height ='';
				}
				if(align !== '') {
					align = ' align="'+align+'"';
					
					}									

				if(bgColor != ''){
					bgColor = ' bgColor="'+ bgColor +'"';
				}
				
				if(border_color != ''){
					border_color = ' border_color="'+ border_color +'"';
				}				
				if(txtColor != ''){
					txtColor = ' txtColor="'+ txtColor +'"';
				}

				if(rounded=='true'){
					rounded = ' rounded="true"';
				}else{
					rounded = '';
				}
				return '\n[custom_box'+width+height+bgColor+align+border_color+txtColor+rounded+']\n'+WShortcode.getVal('custom_box','content')+'\n[/custom_box]\n';


				// Titled Box	
			case 'titled_box':
				var skin = WShortcode.getVal('titled_box','skin');
				var title = WShortcode.getVal('titled_box','title');
				if(skin !== ''){
					skin= ' skin="'+skin+'"';
				}
				if(title !== ''){
					title = ' title="'+title+'"';
				}
				return '\n[titled_box'+skin+title+']'+WShortcode.getVal('titled_box','content')+'[/titled_box]\n';






		
		// Tables
		case 'tables':
		var id = WShortcode.getVal('tables','id');
			if(id !== ''){
					id = ' id="'+id+'"';
				}
			return '\n[table'+id+']\n'+WShortcode.getVal('tables','content')+'\n[/table]\n';
			break;
			
			
			
			
			
		case 'buttons':
			var id = WShortcode.getVal('buttons','id');
			var cssClass = WShortcode.getVal('buttons','cssClass');
			var Size = WShortcode.getVal('buttons','Size');
			var align = WShortcode.getVal('buttons','align');
			var link = WShortcode.getVal('buttons','link');
			var linkTarget = WShortcode.getVal('buttons','linkTarget');
			var text = WShortcode.getVal('buttons','text');
			var skin = WShortcode.getVal('buttons','skin');
		

			if(id != ''){
				id = ' id="'+ id +'"';
			}
			if(cssClass != ''){
				cssClass = ' class="'+ cssClass +'"';
			}		
			if(skin !=''){
				skin =' skin="'+skin+'"';
			}
			if(align !=''){
				align =' align="'+align+'"';
			}
			if(link != ''){
				link = ' link="'+link+'"';
			}
			if(linkTarget != ''){
				linkTarget = ' linktarget="'+linkTarget+'"';
			}			
			if(Size != ''){
				Size = ' size="'+ Size +'"';
			}
			
			
			return '[button'+id+cssClass+Size+align+link+linkTarget+skin+']'+text+'[/button]\n';
			break;
			
			
			
			
			
		// Tabs	
		case 'tabs':
			var number = WShortcode.getVal('tabs','number');
			var style = WShortcode.getVal('tabs', 'style');

			if(style !== '') {
				style =' style="'+style+'"';	
				
			}			

			var ret = '\n[tabs'+style+']\n';
			for(var i=1;i<=number;i++){
				ret +='[tab title="'+WShortcode.getVal('tabs','title_'+i)+'"]'+WShortcode.getVal('tabs','content_'+i)+'[/tab]\n';
			}
			ret +='[/tabs]\n';
			return ret;
			break;
	


		// Vertical Tabs	
		case 'vertical_tabs':
			var number = WShortcode.getVal('vertical_tabs','number');
		

			var ret = '\n[vertical_tabs]\n\n';
			for(var i=1;i<=number;i++){
				ret +='[vertical_tab icon="'+WShortcode.getVal('vertical_tabs','title_icon_'+i)+'" title="'+WShortcode.getVal('vertical_tabs','title_'+i)+'"]'+WShortcode.getVal('vertical_tabs','content_'+i)+'[/vertical_tab]\n\n\n';
			}
			ret +='[/vertical_tabs]\n\n';
			return ret;
			break;


	
	
		// Gallery	
		case 'gallery_ws':
			var number = WShortcode.getVal('gallery_ws','number');
			var height = WShortcode.getVal('gallery_ws','height');
			var column = WShortcode.getVal('gallery_ws', 'column');
			var layout = WShortcode.getVal('gallery_ws', 'layout');
			

			if(column !== '') {
				column =' column="'+column+'"';	
				
			}	
			if(height !== '') {
				height =' height="'+height+'"';	
				
			}
			
			if(layout !==''){
				layout =' layout="'+layout+'"';	
			}

			var ret = '\n[gallery_ws'+column+height+layout+']\n';
			for(var i=1;i<=number;i++){
				ret +='[item title="'+WShortcode.getVal('gallery_ws','title_'+i)+'"]'+WShortcode.getVal('gallery_ws','src_'+i)+'[/item]\n';
			}
			ret +='[/gallery_ws]\n';
			return ret;
			break;
		
	
	
	
			// Anything Slider	
		case 'testimonial_slider':
			var auto = WShortcode.getVal('testimonial_slider', 'auto');
			var speed = WShortcode.getVal('testimonial_slider', 'speed');
			var number = WShortcode.getVal('testimonial_slider', 'number');
			var effect = WShortcode.getVal('testimonial_slider', 'effect');
			
			if(auto !== '') {
				auto =' auto="'+auto+'"';	
				
			}
			if(speed !== '') {
				speed =' speed="'+speed+'"';	
				
			}
			if(effect !== '') {
				effect =' effect="'+effect+'"';	
				
			}			
			
			

			var ret = '\n[testimonial_slider'+speed+auto+effect+']\n';
			for(var i=1;i<=number;i++){
				ret +='[item image="'+WShortcode.getVal('testimonial_slider','image_'+i)+'" company="'+WShortcode.getVal('testimonial_slider','company_'+i)+'" url="'+WShortcode.getVal('testimonial_slider','url_'+i)+'"]\n'+WShortcode.getVal('testimonial_slider','text_'+i)+'\n[/item]\n';
			}
			ret +='[/testimonial_slider]\n';
			return ret;
			break;	
	
	
	
	
		// Slideshow	
		case 'slideshow':
			var number = WShortcode.getVal('slideshow','number');
			var width = WShortcode.getVal('slideshow', 'width');
			var height = WShortcode.getVal('slideshow', 'height');
			var effect = WShortcode.getVal('slideshow', 'effect');
			var pause = WShortcode.getVal('slideshow', 'pause');
			var speed = WShortcode.getVal('slideshow', 'speed');
			
			if(width !== '') {
				width =' width="'+width+'"';	
				
			}
			if(height !== '') {
				height =' height="'+height+'"';	
				
			}
			if(effect !== '') {
				effect =' effect="'+effect+'"';	
				
			}
			if(pause !== '') {
				pause =' pause="'+pause+'"';	
				
			}
			if(speed !== '') {
				speed =' speed="'+speed+'"';	
				
			}			


			var ret = '\n[slideshow'+width+height+effect+pause+speed+']\n';
			for(var i=1;i<=number;i++){
				ret +='[item';
				if(WShortcode.getVal('slideshow','caption_'+i) != ''){		
				ret +=' caption="'+WShortcode.getVal('slideshow','caption_'+i)+'"';
				}
				if(WShortcode.getVal('slideshow','link_'+i) != ''){		
				ret +=' link="'+WShortcode.getVal('slideshow','link_'+i)+'"';
				}
				ret +=']\n'+WShortcode.getVal('slideshow','image_'+i)+'\n[/item]\n';
			}
			ret +='[/slideshow]\n';
			return ret;
			break;	
			
			
			
			
			
		// Accordion
		case 'accordion':
			var number = WShortcode.getVal('accordion','number');

			var ret = '\n[accordions]\n';
			for(var i=1;i<=number;i++){
				ret +='[accordion title="'+WShortcode.getVal('accordion','title_'+i)+'"]\n'+WShortcode.getVal('accordion','content_'+i)+'\n[/accordion]\n';
			}
			ret +='[/accordions]\n';
			return ret;
			break;
			
			
			
		case 'toggle':
			
			return '\n[toggle title="'+WShortcode.getVal('toggle','title')+'"]\n'+WShortcode.getVal('toggle','content')+'\n[/toggle]\n';
			break;
			
			
			
		case 'divider':
		var style = WShortcode.getVal('divider', 'style');
		var width = WShortcode.getVal('divider', 'width');
		var align = WShortcode.getVal('divider', 'align');
				if(width!==''){
						width =' width="'+width+'"';
					}
				if(align!==''){
						align =' align="'+align+'"';
					}					
				if(style!==''){
						style =' style="'+style+'"';
					}					
		
		return '\n[divider'+style+width+align+']\n';
			break;
			
			
		case 'padding':
		var height = WShortcode.getVal('padding', 'height');
				if(height!=''){
						height =' height="'+height+'"';
					}
		
		return '\n[padding'+height+']\n';
			break;
			
		
		
		
		case 'skill_meter':
					var name = WShortcode.getVal('skill_meter','name');
					var percent = WShortcode.getVal('skill_meter','percent');


					if(name!=''){
						name =' name="'+name+'"';
					}
					if(percent!=''){
						percent =' percent="'+percent+'"';
					}					

					return '[skill_meter'+name+percent+']\n';
					break;
						
			
			
			
			
				case 'image':
					var src = WShortcode.getVal('image','src');
					var title = WShortcode.getVal('image','title');
					var desc = WShortcode.getVal('image','desc');
					var align = WShortcode.getVal('image','align');
					var lightbox = WShortcode.getVal('image','lightbox');
					var group = WShortcode.getVal('image','group');
					var width = WShortcode.getVal('image','width');
					var height = WShortcode.getVal('image','height');
					var link = WShortcode.getVal('image','link');

					if(align!=''){
						align =' align="'+align+'"';
					}
					if(lightbox=='true'){
						lightbox = ' lightbox="true"';
					}else{
						lightbox = ' lightbox="false"';
					}
					if(link!= ''){
						link = ' link="'+link+'"';
					}
					if(group!=''){
						group = ' group="'+group+'"';
					}
					if(width!=''){
						width = ' width="'+width+'"';
					}else{
						width ='';
					}
					if(height!=0){
						height = ' height="'+height+'"';
					}else{
						height ='';
					}
					if(title!=''){
						title = ' title="'+title+'"';
					}
					if(desc!=''){
						desc = ' desc="'+desc+'"';
					}
					return '[image'+title+align+desc+lightbox+group+link+width+height+']'+src+'[/image]\n';
					break;
					
					
					
			
				// Tabs	
		case 'pricing':
			var column = WShortcode.getVal('pricing','column');

			var ret = '\n[pricing column="'+column+'"]\n';
			for(var i=1;i<=column;i++){
				ret +='[plan name="'+WShortcode.getVal('pricing','name_'+i)+'" price="'+WShortcode.getVal('pricing','price_'+i)+'" per="'+WShortcode.getVal('pricing','per_'+i)+'" url="'+WShortcode.getVal('pricing','url_'+i)+'" skin="'+WShortcode.getVal('pricing','skin_'+i)+'" button_text="'+WShortcode.getVal('pricing','button_text_'+i)+'" popular="'+WShortcode.getVal('pricing','popular_'+i)+'"]'+WShortcode.getVal('pricing','list_'+i)+'[/plan]\n';
			}
			ret +='[/pricing]\n';
			return ret;
			break;
		
		
		
	
			case 'contactform':
				var email = WShortcode.getVal('contactform','email');
				var button_skin = WShortcode.getVal('contactform', 'button_skin');
				if(button_skin != "")
				{
					button_skin = ' button="'+button_skin+'"'
					
					}
				
				if(email !="" ){
					email = ' email="'+email+'"'
				}
				var content = WShortcode.getVal('contactform','content');
				if(content != ""){
					return '\n[contactform'+email+button_skin+']\n'+content+'\n[/contactform]\n';
				}else{
					return '\n[contactform'+email+button_skin+']\n';
				}
				break;
			case 'twitter':
				var username = WShortcode.getVal('twitter','username');
				var count = WShortcode.getVal('twitter','count');
				if(username !="" ){
					username = ' username="'+username+'"';
				}
				if(count !="" ){
					count = ' count="'+count+'"';
				}
				return '\n[twitter'+username+count+']\n';
				break;
			case 'flickr':
				var id = WShortcode.getVal('flickr','id');
				var count = WShortcode.getVal('flickr','count');
				var display = WShortcode.getVal('flickr','display');
				if(id !="" ){
					id = ' id="'+id+'"';
				}
				if(count !="" ){
					count = ' count="'+count+'"';
				}
				if(display !="" ){
					display = ' display="'+display+'"';
				}
				return '\n[flickr'+id+count+display+']\n';
				break;
				
				
				
				
				
			case 'contact_info':
				var color = WShortcode.getVal('contact_info','color');
				var phone = WShortcode.getVal('contact_info','phone');
				var cellphone = WShortcode.getVal('contact_info','cellphone');
				var email = WShortcode.getVal('contact_info','email');
				var address = WShortcode.getVal('contact_info','address');
				var city = WShortcode.getVal('contact_info','city');
				var state = WShortcode.getVal('contact_info','state');
				var zip = WShortcode.getVal('contact_info','zip');
				var name = WShortcode.getVal('contact_info','name');

				if(color !="" ){
					color = ' color="'+color+'"';
				}
				if(phone !="" ){
					phone = ' phone="'+phone+'"';
				}
				if(cellphone !="" ){
					cellphone = ' cellphone="'+cellphone+'"';
				}
				if(email !="" ){
					email = ' email="'+email+'"';
				}
				if(address !="" ){
					address = ' address="'+address+'"';
				}
				if(city !="" ){
					city = ' city="'+city+'"';
				}
				if(state !="" ){
					state = ' state="'+state+'"';
				}
				if(zip !="" ){
					zip = ' zip="'+zip+'"';
				}
				if(name !="" ){
					name = ' name="'+name+'"';
				}
				return '\n[contact_info'+color+phone+cellphone+email+address+city+state+zip+name+']\n';
				break;
			
			
			case 'gmap':
				var address = WShortcode.getVal('gmap','address');
				var latitude = WShortcode.getVal('gmap','latitude');
				var longitude = WShortcode.getVal('gmap','longitude');
				var zoom = WShortcode.getVal('gmap','zoom');
				var html = WShortcode.getVal('gmap','html');
				var popup = WShortcode.getVal('gmap','popup');
				var height = WShortcode.getVal('gmap','height');

				if(address !="" ){
					address = ' address="'+address+'"';
				}
				if(latitude !="" ){
					latitude = ' latitude="'+latitude+'"';
				}
				if(longitude !="" ){
					longitude = ' longitude="'+longitude+'"';
				}
				if(zoom !="" ){
					zoom = ' zoom="'+zoom+'"';
				}
				if(html !="" ){
					html = ' html="'+html+'"';
				}
				if(popup =='true'){
					popup = ' popup="true"';
				} else {
					popup = ' popup="false"';
				}
				if(height !="" ){
					height = ' height="'+height+'"';
				}
				return '\n[gmap'+address+latitude+longitude+zoom+html+popup+height+']\n';
				break;
				
				
				
				
			case 'popular_posts':
				var count = WShortcode.getVal('popular_posts','count');
				var thumbnail = WShortcode.getVal('popular_posts','thumbnail');
				var time = WShortcode.getVal('popular_posts','time');
				var desc = WShortcode.getVal('popular_posts','desc');
				var cat = WShortcode.getVal('popular_posts','cat');
				var desc_length = WShortcode.getVal('popular_posts','desc_length');

				if(count !="" ){
					count = ' count="'+count+'"';
				}
				if(thumbnail=='true'){
					thumbnail = ' thumbnail="true"';
				}else{
					thumbnail = ' thumbnail="false"';
				}
				if(time =='true'){
					time = ' time="true"';
				} else {				
				time = ' time="false"';
				}
				if(desc =='true'){
					desc = ' desc="true"';
				} else {				
				desc = ' desc="false"';
				}				
				

				if(desc_length !="" ){
					desc_length = ' desc_length="'+desc_length+'"';
				}
				
				if(cat!=undefined){
					cat = ' cat="'+cat+'"';
				}else{
					cat = '';
				}

				return '\n[popular_posts'+count+thumbnail+time+desc+desc_length+cat+']\n';
				break;
				
				
				
				
				
			case 'recent_posts':
				var count = WShortcode.getVal('recent_posts','count');
				var thumbnail = WShortcode.getVal('recent_posts','thumbnail');
				var time = WShortcode.getVal('recent_posts','time');
				var desc = WShortcode.getVal('recent_posts','desc');
				var cat = WShortcode.getVal('recent_posts','cat');
				var desc_length = WShortcode.getVal('recent_posts','desc_length');

				if(count !="" ){
					count = ' count="'+count+'"';
				}
				if(thumbnail=='true'){
					thumbnail = ' thumbnail="true"';
				}else{
					thumbnail = ' thumbnail="false"';
				}
				if(time =='true' ){
					time = ' time="true"';
				} else {				
				time = ' time="false"';
				}
				if(desc =='true' ){
					desc = ' desc="true"';
				} else {				
				desc = ' desc="false"';
				}
				if(desc_length !="" ){
					desc_length = ' desc_length="'+desc_length+'"';
				}
				if(cat!=undefined){
					cat = ' cat="'+cat+'"';
				}else{
					cat = '';
				}
				return '\n[recent_posts'+count+thumbnail+time+desc+desc_length+cat+']\n';
				break;

			
			
			
			
			case 'recent_comments':
				var count = WShortcode.getVal('recent_comments','count');
				if(count !="" ){
					count = ' count="'+count+'"';
				}
				
				return '\n[recent_comments'+count+']\n';
				break;
				
				
				
				
			case 'tag_cloud':
				var count = WShortcode.getVal('tag_cloud','count');
				if(count !="" ){
					count = ' count="'+count+'"';
				}
				
				return '\n[tag_cloud'+count+']\n';
				break;
				

			
		
	
	
		case 'sitemap':
			var sub_type = WShortcode.getVal('sitemap','selector');
			switch(sub_type){
				
				
				
				
			case 'sitemap_pages':
				var number = WShortcode.getVal('sitemap','sitemap_pages','number');
				var depth = WShortcode.getVal('sitemap','sitemap_pages','depth');

				if(number != "")
				{
					number = ' number="'+number+'"'
					
				}
				if(depth != "")
				{
					depth = ' depth="'+depth+'"'
					
				}

					return '\n[sitemap_pages'+number+depth+']\n';
				break;
				
				
				
			
			case 'sitemap_categories':
				var number = WShortcode.getVal('sitemap','sitemap_categories','number');
				var depth = WShortcode.getVal('sitemap','sitemap_categories','depth');
				var show_count = WShortcode.getVal('sitemap','sitemap_categories','show_count');
				var show_feed = WShortcode.getVal('sitemap','sitemap_categories','show_feed');				
				if(number != "")
				{
					number = ' number="'+number+'"'
					
				}
				if(depth != "")
				{
					depth = ' depth="'+depth+'"'
					
				}
				
			if(show_count=='true'){
				show_count = ' show_count="true"';
			} else {
				show_count = ' show_count="false"';
			}
			
			if(show_feed=='true'){
				show_feed = ' show_feed="true"';
			} else {
				show_feed = ' show_feed="false"';
			}			
				

					return '\n[sitemap_categories'+number+depth+show_count+show_feed+']\n';
				break;
				
				
				
				
				
				
				
				
			case 'sitemap_posts':
				var number = WShortcode.getVal('sitemap','sitemap_posts','number');
				var author = WShortcode.getVal('sitemap','sitemap_posts','author');
				var posts = WShortcode.getVal('sitemap','sitemap_posts','posts');
				var cat = WShortcode.getVal('sitemap','sitemap_posts','cat');
				var show_comment = WShortcode.getVal('sitemap','sitemap_posts','show_comment');	
				
				
				if(number != "")
				{
					number = ' number="'+number+'"'
					
				}
				if(author != 'null')
				{
					author = ' author="'+author+'"'
					
				}
				
				if(posts != 'null')
				{
					posts = ' posts="'+posts+'"'
					
				}
				
				if(cat != 'null')
				{
					cat = ' cat="'+cat+'"'
					
				}				
				
			if(show_comment=='true'){
				show_comment = ' show_comment="true"';
			} else {
				show_comment = ' show_comment="false"';
			}

				

					return '\n[sitemap_posts'+cat+posts+author+show_comment+number+']\n';
				break;
				



			case 'sitemap_portfolios':
				var show_comment = WShortcode.getVal('sitemap','sitemap_portfolios','show_comment');
				var number = WShortcode.getVal('sitemap','sitemap_portfolios','number');
				var cat = WShortcode.getVal('sitemap','sitemap_portfolios','cat');
				
				
				if(number != "")
				{
					number = ' number="'+number+'"'
					
				}
				
				if(cat != 'null')
				{
					cat = ' cat="'+cat+'"'
					
				}				
				
			if(show_comment=='true'){
				show_comment = ' show_comment="true"';
			} else {
				show_comment = ' show_comment="false"';
			}

				

					return '\n[sitemap_portfolios'+cat+show_comment+number+']\n';
				break;
				








			
				
			}
			break;	

			
			
			
			
			
		case 'portfolio':
			var column = WShortcode.getVal('portfolio','column');
			var sortable = WShortcode.getVal('portfolio','sortable');
			var pagination = WShortcode.getVal('portfolio','pagination');
			var disable_permalink = WShortcode.getVal('portfolio','disable_permalink');
			var random_height = WShortcode.getVal('portfolio','random_height');
			var fixed_height = WShortcode.getVal('portfolio','fixed_height');
			var gray_scale = WShortcode.getVal('portfolio','gray_scale');
			var max = WShortcode.getVal('portfolio','max');
			var cat = WShortcode.getVal('portfolio','cat');
			var ids = WShortcode.getVal('portfolio','ids');
			var order = WShortcode.getVal('portfolio','order');
			var orderby = WShortcode.getVal('portfolio','orderby');
			
			
			
			if(column!=''){
				column = ' column="'+column+'"';
			}

			if(disable_permalink=='true'){
				disable_permalink = ' disable_permalink="true"';
			}else{
				disable_permalink = ' disable_permalink="false"';
			}
			if(pagination=='true'){
				pagination = ' pagination="true"';
			}else{
				pagination = ' pagination="false"';
			}
			if(sortable=='true'){
				sortable = ' sortable="true"';
			}else{
				sortable = ' sortable="false"';
			}	
			if(gray_scale=='true'){
				gray_scale = ' gray_scale="true"';
			}else{
				gray_scale = ' gray_scale="false"';
			}		
		if(random_height=='true'){
				random_height = ' random_height="true"';
			}else{
				random_height = ' random_height="false"';
			}				
			if(fixed_height!=''){
				fixed_height = ' fixed_height="'+fixed_height+'"';
			}
			if(max!='-1' && max!='0'){
				max = ' max="'+max+'"';
			}else{
				max = '';
			}

			if(cat!=undefined){
				cat = ' cat="'+cat+'"';
			}else{
				cat = '';
			}
			
			if(ids!=undefined){
				ids = ' ids="'+ids+'"';
			}else{
				ids = '';
			}
			
			if(order !="ASC"){
				order = ' order="'+order+'"';
			}else{
				order = '';
			}
			if(orderby !="menu_order"){
				orderby = ' orderby="'+orderby+'"';
			}else{
				orderby = '';
			}
			
			return '[portfolio'+column+sortable+gray_scale+disable_permalink+random_height+fixed_height+pagination+max+cat+ids+order+orderby+']\n\n';
			break;
			
			
	
	
	
	
	
	
	
	case 'portfolio_newspaper':
			var column = WShortcode.getVal('portfolio_newspaper','column');
			var sortable = WShortcode.getVal('portfolio_newspaper','sortable');
			var pagination = WShortcode.getVal('portfolio_newspaper','pagination');
			var random_height = WShortcode.getVal('portfolio_newspaper','random_height');
			var fixed_height = WShortcode.getVal('portfolio_newspaper','fixed_height');
			var max = WShortcode.getVal('portfolio_newspaper','max');
			var cat = WShortcode.getVal('portfolio_newspaper','cat');
			var ids = WShortcode.getVal('portfolio_newspaper','ids');
			var order = WShortcode.getVal('portfolio_newspaper','order');
			var orderby = WShortcode.getVal('portfolio_newspaper','orderby');
			
			
			
			if(column!=''){
				column = ' column="'+column+'"';
			}
			if(pagination=='true'){
				pagination = ' pagination="true"';
			}else{
				pagination = ' pagination="false"';
			}
			if(sortable=='true'){
				sortable = ' sortable="true"';
			}else{
				sortable = ' sortable="false"';
			}		
			if(random_height=='true'){
				random_height = ' random_height="true"';
			}else{
				random_height = ' random_height="false"';
			}				
			if(fixed_height!=''){
				fixed_height = ' fixed_height="'+fixed_height+'"';
			}
			if(max!='-1' && max!='0'){
				max = ' max="'+max+'"';
			}else{
				max = '';
			}

			if(cat!=undefined){
				cat = ' cat="'+cat+'"';
			}else{
				cat = '';
			}
			
			if(ids!=undefined){
				ids = ' ids="'+ids+'"';
			}else{
				ids = '';
			}
			
			if(order !="ASC"){
				order = ' order="'+order+'"';
			}else{
				order = '';
			}
			if(orderby !="menu_order"){
				orderby = ' orderby="'+orderby+'"';
			}else{
				orderby = '';
			}
			
			return '[portfolio_newspaper'+column+sortable+random_height+fixed_height+pagination+max+cat+ids+order+orderby+']\n\n';
			break;
	

	
	
	
	
	
	
	
	
				case 'callout':
				var title = WShortcode.getVal('callout','title');
				var desc = WShortcode.getVal('callout','desc');
				var button_text = WShortcode.getVal('callout','button_text');
				var button_skin = WShortcode.getVal('callout','button_skin');
				var url = WShortcode.getVal('callout','url');

				if(title !="" ){
					title = ' title="'+title+'"';
				}

				if(desc !="" ){
					desc = ' desc="'+desc+'"';
				}

				if(button_text !="" ){
					button_text = ' button_text="'+button_text+'"';
				}

				if(button_skin !="" ){
					button_skin = ' button_skin="'+button_skin+'"';
				}
				if(url !="" ){
					url = ' url="'+url+'"';
				}
				
				return '\n[callout'+title+desc+button_text+button_skin+url+']\n';
				break;
	
	
	
	
	
	
	
			 
			
		case 'video':
			var sub_type = WShortcode.getVal('video','selector');
			switch(sub_type){
				case 'youtube':
					var clip_id = WShortcode.getVal('video','youtube','clip_id');
					var width = WShortcode.getVal('video','youtube','width');
					var height = WShortcode.getVal('video','youtube','height');

					if(clip_id !=""){
						clip_id = ' clip_id="'+clip_id+'"';
					}
					if(width!=0){
						width = ' width="'+width+'"';
					}else{
						width ='';
					}
					if(height!=0){
						height = ' height="'+height+'"';
					}else{
						height ='';
					}
					
					return '[video type="youtube"'+clip_id+width+height+']\n';
					break;
					
					
					
					
				case 'flash':
					var src = WShortcode.getVal('video','flash','src');
					var width = WShortcode.getVal('video','flash','width');
					var height = WShortcode.getVal('video','flash','height');
					var play = WShortcode.getVal('video','flash','play');
					var flashvars = WShortcode.getVal('video','flash','flashvars');

					if(src !=""){
						src = ' src="'+src+'"';
					}
					if(width!=0){
						width = ' width="'+width+'"';
					}else{
						width ='';
					}
					if(height!=0){
						height = ' height="'+height+'"';
					}else{
						height ='';
					}
					if(play=='true'){
						play = ' play="true"';
					}else{
						play = '';
					}
					
					return '[video type="flash"'+src+width+height+play+flashvars+']\n';
					break;
				
				
				
				
				
				case 'vimeo':
					var clip_id = WShortcode.getVal('video','vimeo','clip_id');
					var width = WShortcode.getVal('video','vimeo','width');
					var height = WShortcode.getVal('video','vimeo','height');

					if(clip_id !=""){
						clip_id = ' clip_id="'+clip_id+'"';
					}
					if(width!=0){
						width = ' width="'+width+'"';
					}else{
						width ='';
					}
					if(height!=0){
						height = ' height="'+height+'"';
					}else{
						height ='';
					}
					
					return '[video type="vimeo"'+clip_id+width+height+']';
					break;
				
			};
			break;
			
			
		case 'raw':
			return '\n[raw]\n'+WShortcode.getVal('raw','content')+'\n[/raw]\n';
			break;
			
		case 'news':
			var column = WShortcode.getVal('news','column');
			var layout = WShortcode.getVal('news','layout');
			var posts = WShortcode.getVal('news','posts');
			var parent = WShortcode.getVal('news','parent_container');
			var count = WShortcode.getVal('news','count');
			var cat = WShortcode.getVal('news','cat');
			var featured_image = WShortcode.getVal('news','featured_image');
			var title = WShortcode.getVal('news','title');
			var meta = WShortcode.getVal('news','meta');
			var excerpt = WShortcode.getVal('news','excerpt');
			var more_button = WShortcode.getVal('news','more_button');
  			var button_size = WShortcode.getVal('news','button_size');	
			var button_align = WShortcode.getVal('news','button_align');		
			var image_height = WShortcode.getVal('news','image_height');
			var pagination = WShortcode.getVal('news','pagination');
			var offset = WShortcode.getVal('news','offset');
			var order = WShortcode.getVal('news','order');
			var orderby = WShortcode.getVal('news','orderby');

			if(column!==''){
				column = ' column="'+column+'"';
			}else{
				column = '';
			}	
			if(layout!==''){
				layout = ' layout="'+layout+'"';
			}else{
				layout = '';
			}				
			if(featured_image=='true'){
				featured_image = ' featured_image="true"';
			} else {
				featured_image = ' featured_image="false"';
			}
			if(title=='true'){
				title = ' title="true"';
			} else {
				title = ' title="false"';
			}	
			if(meta=='true'){
				meta = ' meta="true"';
			} else {
				meta = ' meta="false"';
			}
			if(excerpt=='true'){
				excerpt = ' excerpt="true"';
			} else {
				excerpt = ' excerpt="false"';
			}	
			if(more_button=='false'){
				more_button = ' more_button="false"';
			} else {
				more_button = '';
			}			
			
			if(image_height!==''){
				image_height = ' image_height="'+image_height+'"';
			}else{
				image_height = '';
			}	
		
			
			if(button_size!==''){
				button_size = ' button_size="'+button_size+'"';
			}
			
			if(button_align!==''){
				button_align = ' button_align="'+button_align+'"';
			}
			
			if(count!==''){
				count = ' count="'+count+'"';
			}else{
				count = '';
			}
			if(offset!==''){
				offset = ' offset="'+offset+'"';
			}else{
				offset = '';
			}			
			if(posts!=undefined){
				posts = ' posts="'+posts+'"';
			}else{
				posts = '';
			}
			if(cat !==null){
				cat = ' cat="'+cat+'"';
			}else{
				cat = '';
			}
				if(order !="ASC"){
				order = ' order="'+order+'"';
			}else{
				order = '';
			}
			if(orderby !="menu_order"){
				orderby = ' orderby="'+orderby+'"';
			}else{
				orderby = '';
			}

			
			if(pagination=='true'){
				pagination = ' pagination="true"';
			}else{
				pagination = ' pagination="false"';
			}
			
			var parent_container = ' parent_container="'+parent+'"';

			return '[news'+column+featured_image+button_size+button_align+layout+parent_container+title+meta+excerpt+more_button+posts+cat+image_height+pagination+count+offset+order+orderby+']\n\n';
			break;		
			
		case 'blog':
			var column = WShortcode.getVal('blog','column');
			var layout = WShortcode.getVal('blog','layout');
			var posts = WShortcode.getVal('blog','posts');
			var parent = WShortcode.getVal('blog','parent_container');
			var count = WShortcode.getVal('blog','count');
			var cat = WShortcode.getVal('blog','cat');
			var featured_image = WShortcode.getVal('blog','featured_image');
			var title = WShortcode.getVal('blog','title');
			var meta = WShortcode.getVal('blog','meta');
			var excerpt = WShortcode.getVal('blog','excerpt');
			var more_button = WShortcode.getVal('blog','more_button');
  			var button_size = WShortcode.getVal('blog','button_size');	
			var button_align = WShortcode.getVal('blog','button_align');		
			var image_height = WShortcode.getVal('blog','image_height');
			var pagination = WShortcode.getVal('blog','pagination');
			var offset = WShortcode.getVal('blog','offset');
			var order = WShortcode.getVal('blog','order');
			var orderby = WShortcode.getVal('blog','orderby');

			if(column!==''){
				column = ' column="'+column+'"';
			}else{
				column = '';
			}	
			if(layout!==''){
				layout = ' layout="'+layout+'"';
			}else{
				layout = '';
			}				
			if(featured_image=='true'){
				featured_image = ' featured_image="true"';
			} else {
				featured_image = ' featured_image="false"';
			}
			if(title=='true'){
				title = ' title="true"';
			} else {
				title = ' title="false"';
			}	
			if(meta=='true'){
				meta = ' meta="true"';
			} else {
				meta = ' meta="false"';
			}
			if(excerpt=='true'){
				excerpt = ' excerpt="true"';
			} else {
				excerpt = ' excerpt="false"';
			}	
			if(more_button=='false'){
				more_button = ' more_button="false"';
			} else {
				more_button = '';
			}			
			
			if(image_height!==''){
				image_height = ' image_height="'+image_height+'"';
			}else{
				image_height = '';
			}	
		
			
			if(button_size!==''){
				button_size = ' button_size="'+button_size+'"';
			}
			
			if(button_align!==''){
				button_align = ' button_align="'+button_align+'"';
			}
			
			if(count!==''){
				count = ' count="'+count+'"';
			}else{
				count = '';
			}
			if(offset!==''){
				offset = ' offset="'+offset+'"';
			}else{
				offset = '';
			}			
			if(posts!=undefined){
				posts = ' posts="'+posts+'"';
			}else{
				posts = '';
			}
			if(cat !==null){
				cat = ' cat="'+cat+'"';
			}else{
				cat = '';
			}
				if(order !="ASC"){
				order = ' order="'+order+'"';
			}else{
				order = '';
			}
			if(orderby !="menu_order"){
				orderby = ' orderby="'+orderby+'"';
			}else{
				orderby = '';
			}

			
			if(pagination=='true'){
				pagination = ' pagination="true"';
			}else{
				pagination = ' pagination="false"';
			}
			
			var parent_container = ' parent_container="'+parent+'"';

			return '[blog'+column+featured_image+button_size+button_align+layout+parent_container+title+meta+excerpt+more_button+posts+cat+image_height+pagination+count+offset+order+orderby+']\n\n';
			break;
		}
		return '';
		
	
	},	
			
	getVal:function(a,b,c){
		if(b == undefined){
			var target = jQuery('[name="sc_'+a+'"]');
			

			if(target.size() == 0){
				return jQuery('[name="sc_'+a+'[]"]').val();
			}else{
				return target.val();
			}
			
			
		}else if(c == undefined){
			var target = jQuery('[name="sc_'+a+'_'+b+'"]');
			if(target.is('.iphone_toggle')){
				if(target.val() == 'true'){
					return true;
				}else{
					return false;
				}
			}
			
			if(target.size() == 0){
				return jQuery('[name="sc_'+a+'_'+b+'[]"]').val();
			}else{
				return target.val();
			}
		}else {
			var target = jQuery('[name="sc_'+a+'_'+b+'_'+c+'"]');
			if(target.size() == 0){
				return jQuery('[name="sc_'+a+'_'+b+'_'+c+'[]"]').val();
			}else{
				return target.val();
			}
		}
		
	},
	sendToEditor :function(){
		var win = window.dialogArguments || parent || opener || top;
		
		win.send_to_editor(WShortcode.generate());
	},
	
	sendToPreview :function(url){
		var scode=url+'?shortcode='+WShortcode.generate();
		jQuery('#shotcode_preview_iframeContainer').attr("src",scode);
		jQuery('#shortcode_previewcode').text(WShortcode.generate());
	}
}
 
jQuery(document).ready( function($) {
	WShortcode.init();
});


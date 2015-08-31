
function initialize_slideshow() {
	jQuery('#anything_slider').anythingSliderVideo();
	jQuery('#anything_slider').preloader({
		imgSelector:'.slide_image img',
		gradualDelay:true,
		afterShowAll:function(){
			var slider = jQuery(this);
			jQuery('.anythingslider_wrapper').css('overflow','visible');
			
			slider.anythingSlider({
				expand:false,
				resizeContents:false,
				showMultiple:false,
				easing:slideShow['easing'],
				buildArrows:slideShow['arrows'],
				buildNavigation:slideShow['pagination'],
				buildStartStop:false,
				enableArrows:true,
				enableNavigation:true,
				enableStartStop: false,
				enableKeyboard:true,
				startPanel:1,
				mode:'horizontal',
				changeBy:1,
				hashTags:false,
				infiniteSlides: true,
				navigationFormatter : null,
				navigationSize : false,
				autoPlay:slideShow['autoPlay'],
				pauseOnHover:slideShow['pauseOnHover'],
				playRtl:false,
				delay:slideShow['delay'],
				animationTime:slideShow['animationTime'],
				

				onSlideInit:function(){
					base = slider.data('AnythingSlider');
					if(base.$currentPage.hasClass('stoped')){
						base.startStop(false);
					}else{
						base.startStop(base.options.autoPlay);
					}
				},
				// Video
				resumeOnVideoEnd:true,
				addWmodeToObject: 'transparent'
			});
			
			
			if(slideShow['anim_enable'] == true && jQuery(window).width() > 1024) {
			jQuery('#anything_slider').anythingSliderFx({									
				"div.anythingSlider .full_image" : [slideShow['anim_full_image'], "", slideShow['anim_speed'], slideShow['anim_easing'] ],						
				"div.anythingSlider .desc_box  h2"           : [slideShow['anim_title'], "",  slideShow['anim_speed'], slideShow['anim_easing'] ],
				"div.anythingSlider .desc_box  p"            : [slideShow['anim_desc'], "",  slideShow['anim_speed'], slideShow['anim_easing'] ],
				"div.anythingSlider .desc_box  .ws-button"      : [slideShow['anim_button'], "",  slideShow['anim_speed'], slideShow['anim_easing'] ],
				"div.anythingSlider .slide_image.with_desc, div.anythingSlider .video-wrapper" : [ slideShow['anim_icon_image'], "",  slideShow['anim_speed'], slideShow['anim_easing'] ]
			});	
			}
			
			if(slider.find('li.panel:eq(1)').hasClass('stoped')){
				slider.data('AnythingSlider').startStop(false);
			}

				base = slider.data('AnythingSlider');
				base.startStop(false);
				jQuery('#anything_slider_loading').delay(2000).animate({opacity:0}, 1000,function(){jQuery(this).remove();base.startStop(base.options.autoPlay, true);});
	
		
					


		
		},
		beforeShowAll:function(){
			jQuery('<div id="anything_slider_loading"></div>').insertBefore(this);
			jQuery(this).show();

		}
	
	
	
});	
	
			if(slideShow['boxed_layout'] == "boxed_layout") {
	    	 default_width = jQuery(".boxed_layout").width();
			} else {
	    	 default_width = jQuery(document).width();
			}	 
			        as = jQuery('#anything_slider').data('AnythingSlider'),
			        leftEdge = 0;
				
			      jQuery('.anythingWindow, .anythingBase, #anything_slider li.panel, .anythingSlider, #anything_slider_loading').width(default_width);
			
			      for (var i=0; i < as.pages + 2; i++) {
			        as.panelSize[i] = [default_width, as.panelSize[i][1], leftEdge];
			        leftEdge += default_width;
			 
					 }
			      jQuery('.anythingBase').width(leftEdge);
			      as.gotoPage(as.currentPage, false);	
	
	
	
}

	

jQuery(document).ready(function() {
		initialize_slideshow()						
	    var timer;
			jQuery(window).resize(function(){
			  clearTimeout(timer);
			  setTimeout( initialize_slideshow, 100);
			  
			})
});


			





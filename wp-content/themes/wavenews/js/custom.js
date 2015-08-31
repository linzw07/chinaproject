

jQuery.noConflict();


jQuery(document).ready(function($) {

function ws_fixed_header() {
	var header_fixed_height =  jQuery('#header.fixed_header').outerHeight();	
	var ws_header_height = jQuery('#header.fixed_header').height();

	var wp_admin_height = 0;
	if (jQuery("#wpadminbar")
	    .length > 0) {
	    wp_admin_height = jQuery("#wpadminbar").height();
	}

	jQuery('#page').css('margin-top', header_fixed_height);
	jQuery('#header.fixed_header').css({'position':'fixed', 'top' : wp_admin_height});
}

jQuery(window).load(function () {
        ws_fixed_header()
    });

    jQuery(window)
        .on("debouncedresize", function (event) {
        ws_fixed_header()
    });

var side_social_margin =  jQuery('#side_social').outerHeight();	
jQuery('#side_social').css('margin-top', - (side_social_margin / 2));
	
	
		var timer;
			generalSetSize();
			jQuery(window).resize(function(){
			  clearTimeout(timer);
			  setTimeout( generalSetSize, 100);
			})  
			
	jQuery('#responsive_navigation select').customSelect();		
	jQuery(".tabs_container, .vertical_tabs_container").each(function(){
		jQuery("ul.tabs, ul.vertical_tabs",this).tabs("div.panes > div, div.vertical_panes > div", {tabs:'li',effect: 'fade', fadeOutSpeed: -400});
	});

	//jQuery('#header').waypoint('sticky');
	/*jQuery("img").hover(
	function(){
		jQuery(this).animate(
		{height:"200px"}
		)
		},
	function(){
		
		}
	)*/
	
	jQuery('img').addClass("animate-fadeIn");
	
	jQuery('.animate-fadeIn').addClass('animated fadeOutLeft');
	jQuery('.animate-fadeIn').waypoint(
	
	function() {
		jQuery(this).removeClass('fadeOutLeft');
		jQuery(this).addClass('fadeInLeft');

	}, {

		triggerOnce: true,
		offset: 'bottom-in-view'
	});


	
	jQuery.tools.tabs.addEffect("slide", function(i, done) {
		this.getPanes().slideUp();
		this.getPanes().eq(i).slideDown(function()  {
			done.call();
		});
	});
	
	
	jQuery(".accordion").each(function(){
		var $initialIndex = jQuery(this).attr('data-initialIndex');
		if($initialIndex==undefined){
			$initialIndex = 0;
		}
		jQuery(this).tabs("div.pane", {tabs: '.tab', effect: 'slide',initialIndex: $initialIndex});
	});

	
	
	
	jQuery(".toggle_title, .bookmark_title").toggle(
		function(){
			jQuery(this).addClass('toggle_active');
			jQuery(this).siblings('.toggle_content, #bookmark ul').slideDown("fast");
		},
		function(){
			jQuery(this).removeClass('toggle_active');
			jQuery(this).siblings('.toggle_content, #bookmark ul').slideUp("fast");
		}
	);
	
	
	
	
	
	
	if($('.newspaper').length > 0) {
		var $container = $('.newspaper');
	
		$container.isotope({
		 	 masonryHorizontal: {rowHeight: 360}	
				});
	}

	if($('#portfolios').length > 0) {
		var $container = $('.portfolio_container');
	
		$container.isotope({

    masonryHorizontal: {
    rowHeight: 360
 
		}	  
		});
		

		
		// filter items when filter link is clicked
		$('.filter_portfolio a').click(function(){
			var $this = $(this);
			if($this.hasClass('.current')) {
				return false;
				}
			var $optionSet = $this.parents('.filter_portfolio');
	        $optionSet.find('.current').removeClass('current');
	        $this.addClass('current');
			
		  var selector = $(this).attr('data-filter');
		  $container.isotope({ filter: selector });

		      $container.data('isotope').$filteredAtoms.each(function(){
		        
		      });

		  return false;
		});
			
	
	
	}
	
	
	

	
	jQuery("#portfolios").preloader({
		delay:200,
		imgSelector:'.portfolio_item_wrapper img',
		beforeShow:function(){
			jQuery(this).closest('.portfolio_item_wrapper img').css('visibility','hidden');
		},
		afterShow:function(){
			var container = jQuery(this).closest('.portfolio_item_wrapper img').css('visibility','visible');
		}
	});
	

	
	
	
	jQuery(".image_container").preloader({
		delay:300,
		imgSelector:'.image_frame img',
		beforeShow:function(){
			jQuery(this).closest('.image_frame img').css('visibility','hidden');
		},
		afterShow:function(){
			jQuery(this).closest('.image_frame').css('background-image','none');
			var image = jQuery(this).closest('.image_frame img').css('visibility','visible').closest('a');
		 	
		if($('.newspaper').length > 0) {	
			jQuery('.newspaper.blog_loop').isotope({});
		
		}
		}
		
	});
	
	




jQuery(".contact_info .icon_email").each(function(){
		jQuery(this).attr('href',jQuery(this).attr('href').replace("*", "@"));
		jQuery(this).html(jQuery(this).html().replace("*", "@"));
	});


    if(jQuery.tools.validator != undefined){
		
        jQuery.tools.validator.addEffect("contact_form", function(errors, event) {
            jQuery.each(errors, function(index, error) {
                var input = error.input;
				
                input.addClass('invalid');
            });
        }, function(inputs)  {
            inputs.removeClass('invalid');
        });
		
	
        jQuery('.contact_form').validator({effect:'contact_form'}).submit(function(e) {
			var form = jQuery(this);
            if (!e.isDefaultPrevented()) {
				jQuery('.contact_loading').fadeIn('slow');
                jQuery.post(this.action,{
                    'to':jQuery('input[name="contact_to"]').val().replace("*", "@"),
                    'name':jQuery('input[name="contact_name"]').val(),
                    'email':jQuery('input[name="contact_email"]').val(),
                    'content':jQuery('textarea[name="contact_content"]').val()
                },function(data){
                    form.fadeIn('fast', function() {
                       jQuery('.contact_loading').fadeOut('slow');
                        jQuery(this).siblings('.success_message').fadeIn('slow').delay(4000).fadeOut();
						jQuery(this).find('input, textarea').val("");
                    });
                });
				e.preventDefault();
            }
        });

		
		
        
 
    }
});




(function($) {

	$.fn.preloader = function(options) {
		var settings = $.extend({}, $.fn.preloader.defaults, options);


		return this.each(function() {
			settings.beforeShowAll.call(this);
			var imageHolder = $(this);
			
			var images = imageHolder.find(settings.imgSelector).css({opacity:0, visibility:'hidden'});	
			var count = images.length;
			var showImage = function(image,imageHolder){
				if(image.data.source != undefined){
					imageHolder = image.data.holder;
					image = image.data.source;	
				};
				
				count --;
				if(settings.delay <= 0){
					image.css('visibility','visible').animate({opacity:1}, settings.animSpeed, function(){settings.afterShow.call(this)});
				}
				if(count == 0){
					imageHolder.removeData('count');
					if(settings.delay <= 0){
						settings.afterShowAll.call(this);
					}else{
						if(settings.gradualDelay){
							images.each(function(i,e){
								var image = $(this);
								setTimeout(function(){
									image.css('visibility','visible').animate({opacity:1}, settings.animSpeed, function(){settings.afterShow.call(this)});
								},settings.delay*(i+1));
							});
							setTimeout(function(){settings.afterShowAll.call(imageHolder[0])}, settings.delay*images.length+settings.animSpeed);
						}else{
							setTimeout(function(){
								images.each(function(i,e){
									$(this).css('visibility','visible').animate({opacity:1}, settings.animSpeed, function(){settings.afterShow.call(this)});
								});
								setTimeout(function(){settings.afterShowAll.call(imageHolder[0])}, settings.animSpeed);
							}, settings.delay);
						}
					}
				}
			};
			
			if(count==0){
				settings.afterShowAll.call(this);
			}else{
				images.each(function(i){
					settings.beforeShow.call(this);
				
					image = $(this);
				
					if(this.complete==true){
						showImage(image,imageHolder);
					}else{
						image.bind('error load',{source:image,holder:imageHolder}, showImage);
						if($.browser.opera || ($.browser.msie && parseInt(jQuery.browser.version, 10) == 9 && document.documentMode == 9) ){
							image.trigger("load");//for hidden image
						}
					}
				});
			}
			

		});
	};





	//Default settings
	jQuery.fn.preloader.defaults = {
		delay:1000,
		gradualDelay:true,
		imgSelector:'img',
		animSpeed:500,
		beforeShowAll: function(){},
		beforeShow: function(){},
		afterShow: function(){},
		afterShowAll: function(){}
	};



jQuery(document).ready(function() {
	
	
	
	jQuery('#hc_carousel').find('.thumbnail').each(function() {
	var desc_height = jQuery(this).find('.carousel-extra-info').outerHeight();
	jQuery(this).find('.carousel-extra-info').css({'display' : 'block', 'top' : -(desc_height + 10)});
	
	jQuery(this).hover(function() {
		jQuery(this).find('.carousel-inner-mask').fadeIn(600,'easeInOutExpo');
		jQuery(this).find('.carousel-extra-info').stop().animate({top: '10px'}, {queue:false, duration:600, easing:'easeInOutExpo'});
		
	
	}, function() {
		

		jQuery(this).find('.carousel-extra-info').stop().animate({top: -(desc_height + 10)}, {queue:false, duration:600, easing:'easeInOutExpo'});
		jQuery(this).find('.carousel-inner-mask').fadeOut(600,'easeInExpo');		
				
				});
		
																			  
	});
							
	
	jQuery(window).scroll(function(){
        if (jQuery(this).scrollTop() > 300) {
            jQuery('#top-link').fadeIn();
        } else {
            jQuery('#top-link').fadeOut();
        }
    });

    jQuery('#top-link').click(function(){
    jQuery("html, body").animate({ scrollTop: 0 }, 1000);
    return false;
    });
	

	
});

jQuery('#responsive_navigation select').prepend('<option value="" selected="selected">Select Menu</option>');										   

jQuery("#responsive_navigation select").change(function() {
  window.location = jQuery(this).find("option:selected").val();
});




/* Parallax Backgrounds */
/* -------------------------------------------------------------------- */

if(jQuery('.ws-body-parallax').length > 0) {
    jQuery('body').parallax("50%",body_parallax_speed);
}

if(jQuery('.ws-page-parallax').length > 0) {
jQuery('#page').parallax("50%",page_parallax_speed);
}

if(jQuery('.ws-nicescroll').length > 0 && jQuery('.ws-flexsldier-slideshow').length == 0) {
        jQuery('html').niceScroll({  "cursorwidth" : 8,
                                     "cursorcolor" : "#464646",
                                     "bouncescroll" : true
                                    });

}


jQuery('.ws-scroll-top').on('click', function() {
        jQuery('body').ScrollTo({
            duration: 3000,
            easing: 'easeOutQuart',
            durationMode: 'all'
        });
})




})(jQuery);



	function hover_effect() {
		
					jQuery('.image_container a.hover_effect').hover(function(){
						jQuery(".hover_icon", this).stop().animate({ 'left':jQuery(this).parent().width()/2-25,
										'bottom' : jQuery(this).parent().height()/2-25}, 'slow', 'easeInOutExpo');				 
						jQuery(".image_overlay",this).stop().animate({
							opacity: '0.5'
						},"slow");
					},function(){
						jQuery(".hover_icon", this).stop().animate({
							'left':jQuery(this).parent().width()/2-25,'bottom' : -45}, 'slow', 'easeInOutExpo');
						jQuery(".image_overlay",this).stop().animate({
							opacity: '0'
						},"slow");
					})
		}
		hover_effect();	


function portfolio_hover() {
	jQuery('.portfolio_item').hover(function(){
						jQuery(".hover_icon", this).stop().animate({
										'bottom' : 0}, 'slow', 'easeInOutExpo');				 
						jQuery(".portfolio_item_details",this).stop().animate({
							opacity: '1'
						},"slow");
						jQuery(".portfolio_overlay",this).stop().animate({
							opacity: '0.7'
						},"slow");
					},function(){
						jQuery(".hover_icon", this).stop().animate({
										'bottom' : -45}, 'slow', 'easeInOutExpo');
						jQuery(".portfolio_item_details",this).stop().animate({
							opacity: '0'
						},"slow");
						jQuery(".portfolio_overlay",this).stop().animate({
							opacity: '0'
						},"slow");
					})
	
	
	}
portfolio_hover();

var enable_lightbox = function(parent){
	
	
	
jQuery(".lightbox").each(function(){
		
		jQuery(this).colorbox({
			opacity:0.7,
			maxWidth:"95%",
			maxHeight:"90%",
			current:"",
			onComplete: function(){	
				if (typeof Cufon !== "undefined"){
					Cufon.replace('#cboxTitle');
				}
			},
				onCleanup: function(){
					jQuery("#cboxLoadedContent").html('');
					jQuery('.portfolio_arrow_icon_newspaper').css({'right' : 0});	
					
				}
		});
	});
	
jQuery(".video_lightbox").each(function(){
		var $height, $width;							  
		var $iframe = jQuery(this).attr('data-video');
		if($iframe == undefined || $iframe == 'false'){
			$iframe = false;
		}else{
			$iframe = true;
			$width = 600;
			$height = 480;
		}

		jQuery(this).colorbox({
			opacity:0.7,
			innerWidth:$width,
			innerHeight:$height,
			iframe:$iframe,
			current:"",
			onComplete: function(){	
				if (typeof Cufon !== "undefined"){
					Cufon.replace('#cboxTitle');
				}

			
			},
				onCleanup: function(){
					jQuery("#cboxLoadedContent").html('');
				jQuery('.portfolio_arrow_icon_newspaper').css({'right' : 0});	
				}
			
		});



	});	

		
	};
	enable_lightbox(document);


function generalSetSize(){
/*	
			if(jQuery(window).width() < 480) {
			jQuery('.portfolios_simple_ver .portfolio_item img').each(function() {
			var portfolio_height = jQuery(this).height();
			jQuery(this).parents('.portfolios_simple_ver .portfolio_item, .portfolio_item_wrapper').css('height', portfolio_height);	

			})

			}*/
	
			if (jQuery(window).width() < 768) {
			jQuery('body').attr('id', 'iphoneHome');
/*
			jQuery('.portfolios_simple_ver .portfolio_item img').each(function() {

			var portfolio_height = jQuery(this).height();
			jQuery(this).parents('.portfolios_simple_ver .portfolio_item, .portfolio_item_wrapper').css('height', portfolio_height);	

			})
*/			
			   }

			  else if (jQuery(window).width() < 1024) {
				jQuery('body').attr('id', 'iPadHome');
			  }
			   else {   
				jQuery('body').attr('id','home'); 
				
				}
				
	
}	


	
	// On window load. This waits until images have loaded which is essential
	jQuery(window).load(function(){
		
		// Fade in images so there isn't a color "pop" document load and then on window load
		jQuery(".grascale_enabled img").animate({opacity:1},500);
		
		// clone image
		jQuery('.grascale_enabled img').each(function(){
			var el = jQuery(this);
			el.css({"position":"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass('img_grayscale').css({"position":"absolute","z-index":"180","opacity":"0"}).insertBefore(el).queue(function(){
				var el = jQuery(this);
				el.parent().css({"width":this.width,"height":this.height});
				el.dequeue();
			});
			this.src = grayscale(this.src);
		});
		
		/*
		jQuery('.grascale_enabled img').mouseover(function(){
			jQuery(this).parent().find('img:first').stop().animate({opacity:1}, 1000);
		})
		jQuery('.img_grayscale').mouseout(function(){
			jQuery(this).stop().animate({opacity:0}, 1000);
		});
		*/		
	});
	
	// Grayscale w canvas method
	function grayscale(src){
        var canvas = document.createElement('canvas');
		var ctx = canvas.getContext('2d');
        var imgObj = new Image();
		imgObj.src = src;
		canvas.width = imgObj.width;
		canvas.height = imgObj.height; 
		ctx.drawImage(imgObj, 0, 0); 
		var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
		for(var y = 0; y < imgPixels.height; y++){
			for(var x = 0; x < imgPixels.width; x++){
				var i = (y * 4) * imgPixels.width + x * 4;
				var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
				imgPixels.data[i] = avg; 
				imgPixels.data[i + 1] = avg; 
				imgPixels.data[i + 2] = avg;
			}
		}
		ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
		return canvas.toDataURL();
    }





(function($){
		  
	  
 $.fn.extend({
 
 	customSelect : function(options) {
	  if(!$.browser.msie || ($.browser.msie&&$.browser.version>6)){
	  return this.each(function() {
	  
			var currentSelected = $(this).find(':selected');
			$(this).after('<span class="customStyleSelectBox"><span class="customStyleSelectBoxInner">'+currentSelected.text()+'</span></span>').css({position:'absolute', opacity:0,fontSize:$(this).next().css('font-size')});
			var selectBoxSpan = $(this).next();
			var selectBoxWidth = parseInt($(this).width()) - parseInt(selectBoxSpan.css('padding-left')) -parseInt(selectBoxSpan.css('padding-right'));			
			var selectBoxSpanInner = selectBoxSpan.find(':first-child');
			selectBoxSpan.css({display:'inline-block'});
			selectBoxSpanInner.css({width:selectBoxWidth, display:'inline-block'});
			var selectBoxHeight = parseInt(selectBoxSpan.height()) + parseInt(selectBoxSpan.css('padding-top')) + parseInt(selectBoxSpan.css('padding-bottom'));
			$(this).height(selectBoxHeight).change(function(){
				// selectBoxSpanInner.text($(this).val()).parent().addClass('changed');   This was not ideal
			selectBoxSpanInner.text($(this).find(':selected').text()).parent().addClass('changed');
				// Thanks to Juarez Filho & PaddyMurphy
			});
			
	  });
	  }
	}
 });
})(jQuery);




/*
 * debouncedresize: special jQuery event that happens once after a window resize
 *
 * latest version and complete README available on Github:
 * https://github.com/louisremi/jquery-smartresize
 *
 * Copyright 2012 @louis_remi
 * Licensed under the MIT license.
 *
 * This saved you an hour of work? 
 * Send me music http://www.amazon.co.uk/wishlist/HNTU0468LQON
 */
(function ($) {

    var $event = $.event,
        $special,
        resizeTimeout;

    $special = $event.special.debouncedresize = {
        setup: function () {
            $(this)
                .on("resize", $special.handler);
        },
        teardown: function () {
            $(this)
                .off("resize", $special.handler);
        },
        handler: function (event, execAsap) {
            // Save the context
            var context = this,
                args = arguments,
                dispatch = function () {
                    // set correct event type
                    event.type = "debouncedresize";
                    $event.dispatch.apply(context, args);
                };

            if (resizeTimeout) {
                clearTimeout(resizeTimeout);
            }

            execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
        },
        threshold: 150
    };

})(jQuery);
 
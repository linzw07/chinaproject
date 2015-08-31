<?php 

$blog_layout =  theme_option(THEME_OPTIONS,'archive_layout');
$loop_style = theme_option(THEME_OPTIONS, 'archive_loop_style');




get_header();


	
wp_print_scripts( 'jquery-isotope', THEME_JS .'/jquery.isotope.min.js', array('jquery'),'1.2.2');
wp_print_scripts( 'jquery-infinitescroll', THEME_JS .'/jquery.infinitescroll.min.js', array('jquery'),'1.2.2');

?>

<script type="text/javascript">
              jQuery(document).ready(function(){
										  
		jQuery('.wp-pagenavi, #load_more_posts').hide();
	
	if(jQuery('.wp-pagenavi').length > 0) {
	jQuery('#load_more_posts').show();	
		
		}
      var $container = jQuery('.blog_loop');
 
      
      $container.infinitescroll({
        navSelector  : '.wp-pagenavi',    // selector for the paged navigation 
        nextSelector : '.wp-pagenavi a',  // selector for the NEXT link (to page 2)
        itemSelector : '.blog_loop_item',
		loadingText : '',
       	finishedMsg: '<?php _e('No more Posts to load.', 'theme_frontend'); ?>'
         
        },
        // call Isotope as a callback
        function( newElements ) {
          $container.isotope( 'appended', jQuery( newElements ) ); 
		hover_effect();	
		  
        }
      );

    jQuery(window).unbind('.infscr');
    jQuery('#load_more_posts').click(function(){

      jQuery(document).trigger('retrieve.infscr');

      return false;

    });
	
	jQuery(document).ajaxError(function(e,xhr,opt){

      if (xhr.status == 404) jQuery('#load_more_posts').find('.text').html('<?php _e('No more pages to load.', 'theme_frontend'); ?>').end().delay(2000).fadeOut();

    });

    });
</script>


<div id="page" class="<?php if(theme_option(THEME_OPTIONS, 'enable_page_parallax') == 'true') : ?>ws-page-parallax<?php endif; ?>">
<?php
theme_function('introduce', get_queried_object_id());?> 

	<div class="inner <?php if($blog_layout =='right' && $loop_style != 'newspaper'):?>right_sidebar<?php endif;?><?php if($blog_layout =='left' && $loop_style != 'newspaper'):?>left_sidebar<?php endif;?><?php if($blog_layout =='full' || $loop_style == 'newspaper'):?>full_layout<?php endif; if($loop_style == 'newspaper'): ?> newspaper_inner <?php endif; ?>">
       
		<div id="main">
			<div class="content">
            
                      <section class="blog_loop <?php echo $loop_style; ?>">	
				<?php 
				
					
					
				$exclude_cats = theme_option(THEME_OPTIONS,'excluded_cats');
				foreach ($exclude_cats as $key => $value) {
					$exclude_cats[$key] = -$value;
				}
				if(stripos($query_string,'cat=') === false){
					query_posts($query_string."&cat=".implode(",",$exclude_cats));
				}else{
					query_posts($query_string.implode(",",$exclude_cats));
				}
				if($loop_style == 'classic' || $loop_style == 'classic_thumb') {
					get_template_part( 'blog_loop_classic','archive');
				}
					
				?>
                
                
              <div class="clearboth"></div>  
              </section>    
             <div id="load_more_posts" style="text-align:center;"><i class="icon-plus"></i><span class="text"><?php _e('Load More', 'theme_frontend'); ?></span><div id="infscr-loading"></div></div>
				<div class="clearboth"></div>
			</div>

          
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
		</div>
		<?php if($blog_layout != 'full') : if($loop_style != 'newspaper') :  get_sidebar(); endif; endif; ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>
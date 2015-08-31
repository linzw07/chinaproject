<?php 
/*------------------------------------------------------------- 
		Theme Footer
-------------------------------------------------------------*/

if(theme_option(THEME_OPTIONS, 'disable_footer') == 'true') : ?>
<div id="footer" class="footer_regular">
 <div class="inner">
    <div class="footer_widget">
    <div class="footer_widget_inner">
<?php
$footer_column = theme_option(THEME_OPTIONS,'footer_columns');
if(is_numeric($footer_column)):
	switch ( $footer_column ):
		case 1:
		$class = '';
			break;
		case 2:
			$class = 'one_half';
			break;
		case 3:
			$class = 'one_third';
			break;
		case 4:
			$class = 'one_fourth';
			break;
		case 5:
			$class = 'one_fifth';
			break;
		case 6:
			$class = 'one_sixth';
			break;		
	endswitch;
	for( $i=1; $i<=$footer_column; $i++ ):
?>
<?php if($i == $footer_column): ?>
<div class="<?php echo $class; ?> last"><?php theme_function('footer_sidebar'); ?></div>
<?php else:?>
	<div class="<?php echo $class; ?>"><?php theme_function('footer_sidebar'); ?></div>
<?php endif;		
endfor; 
else : 
switch($footer_column):
		case 'third_sub_third':
?>
		<div class="one_third"><?php theme_function('footer_sidebar'); ?></div>
		<div class="two_third last">
			<div class="one_third"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_third"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_third last"><?php theme_function('footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'sub_third_third':
?>
		<div class="two_third">
			<div class="one_third"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_third"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_third last"><?php theme_function('footer_sidebar'); ?></div>
		</div>
		<div class="one_third last"><?php theme_function('footer_sidebar'); ?></div>
<?php
			break;
		case 'third_sub_fourth':
?>
		<div class="one_third"><?php theme_function('footer_sidebar'); ?></div>
		<div class="two_third last">
			<div class="one_fourth"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_fourth"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_fourth"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_fourth last"><?php theme_function('footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'sub_fourth_third':
?>
		<div class="two_third">
			<div class="one_fourth"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_fourth"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_fourth"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_fourth last"><?php theme_function('footer_sidebar'); ?></div>
		</div>
		<div class="one_third last"><?php theme_function('footer_sidebar'); ?></div>
<?php
			break;
		case 'half_sub_half':
?>
		<div class="one_half"><?php theme_function('footer_sidebar'); ?></div>
		<div class="one_half last">
			<div class="one_half"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_half last"><?php theme_function('footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'half_sub_third':
?>
		<div class="one_half"><?php theme_function('footer_sidebar'); ?></div>
		<div class="one_half last">
			<div class="one_third"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_third"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_third last"><?php theme_function('footer_sidebar'); ?></div>
		</div>
<?php
			break;
		case 'sub_half_half':
?>
		<div class="one_half">
			<div class="one_half"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_half last"><?php theme_function('footer_sidebar'); ?></div>
		</div>
		<div class="one_half last"><?php theme_function('footer_sidebar'); ?></div>
<?php
			break;
		case 'sub_third_half':
?>
		<div class="one_half">
			<div class="one_third"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_third"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_third last"><?php theme_function('footer_sidebar'); ?></div>
		</div>
		<div class="one_half last"><?php theme_function('footer_sidebar'); ?></div>
<?php
			break;

		case 'two_row':
?>
			<div class="one_half"><?php theme_function('footer_sidebar'); ?></div>
			<div class="one_half last"><?php theme_function('footer_sidebar'); ?></div>
			<div class="widgets_hr_divider"></div>
			<div class="one_half"><?php theme_function('footer_sidebar'); ?></div>
		    <div class="one_half last"><?php theme_function('footer_sidebar'); ?></div>
<?php
			break;			
	endswitch;
endif;	
	?>

		<div class="clearboth"></div>
	</div>
<div class="clearboth"></div>
</div>    
<?php endif;?>
<div class="clearboth"></div>      
</div>
  
<?php if(theme_option(THEME_OPTIONS, 'disable_sub_footer')  == 'true' ) : ?>
    <div id="footer_toolbar">
    <div class="inner">
    <?php theme_function('footer_menu'); ?>
    <span class="copyright"><?php echo stripslashes(theme_option(THEME_OPTIONS, 'copyright')); if(theme_option(THEME_OPTIONS, 'enable_copyright_auto')=='true') {comicpress_copyright();};?></span>
    
    </div>
   	<div class="clearboth"></div>     
   </div>
 </div>   
<?php endif; ?> 
<?php if(theme_option(THEME_OPTIONS, "disable_scroll_top") == 'true') : ?>
<a href="#top" class="scrolltop_button" id="top-link"></a>
<?php endif; ?>
<?php 
	wp_footer();
	if(theme_option(THEME_OPTIONS,'analytics')){ ?>
		<script type="text/javascript">
		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', '<?php echo stripslashes(theme_option(THEME_OPTIONS,'analytics')); ?>']);
		  _gaq.push(['_trackPageview']);

		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();

		</script>
		<?php 

	}
	if(theme_option(THEME_OPTIONS,'custom_fonts_type_1') == 'cufon' || theme_option(THEME_OPTIONS,'custom_font_type_2') == 'cufon') {
		theme_add_cufon_code();
	}
	
?>
<?php if(theme_option(THEME_OPTIONS,'background_selector_orientation') == 'boxed_layout') {  ?>
</div>
<?php } ?>
</div>
</body>
</html>
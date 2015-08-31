<?php

/*------------------------------------------------------------- 
		Index Page
-------------------------------------------------------------*/

get_header(); 
$layout= theme_option(THEME_OPTIONS,'home_layout');
$content_id_bottom = theme_option(THEME_OPTIONS,'homepage_content_bottom');
$content_id_top = theme_option(THEME_OPTIONS,'homepage_content_top');
?>
<div id="page">
<?php  theme_function('slideshow'); ?>
<?php  theme_function('slogan_heading');  ?>
	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?><?php if($layout=='full'):?>full_layout<?php endif;?>">
    <div id="main">
    <div class="content">

<?php
if($content_id_top) {
	$page_data_top = get_page( $content_id_top);
	$content_top = apply_filters('the_content', $page_data_top->post_content);
	echo apply_filters('the_content', stripslashes( $content_top ));
}
?>
<div class="clearboth"></div>
</div>
</div>
<?php  if($layout != 'full') get_sidebar(); ?>
<div class="clearboth"></div>
</div>
<?php
	if(theme_option(THEME_OPTIONS, 'disable_carousel') == 'true') :
?>
<div class="carousel_wrapper">
<h2><?php echo stripslashes(theme_option(THEME_OPTIONS, 'carousel_title_text')); ?></h2>
<?php
theme_function('carousel'); 
?>
<div class="clearboth"></div>
</div>
<?php endif; ?>
<div class="homepage_bottom_content">
<div class="inner">
<?php
	if($content_id_bottom) {
		$page_data_bottom = get_page( $content_id_bottom);
		$content_bottom = apply_filters('the_content', $page_data_bottom->post_content);
		echo apply_filters('the_content', stripslashes( $content_bottom ));
	}
?>
<div class="clearboth"></div>
</div>
</div>
<div class="clearboth"></div>
</div>
<?php get_footer(); ?>
<?php
/*------------------------------------------------------------- 
		Page
-------------------------------------------------------------*/
if(get_post_meta( $post->ID, '_layout', true ) == 'default' || get_post_meta( $post->ID, '_layout', true ) == '') {
	$layout = "right";
	} else {
	$layout = get_post_meta( $post->ID, '_layout', true );
	}
if(is_blog()){
	return require(THEME_DIR . "/blog.php");
}
?>
<?php get_header(); ?>
<div id="page" class="<?php if(theme_option(THEME_OPTIONS, 'enable_page_parallax') == 'true') : ?>ws-page-parallax<?php endif; ?>">
<?php theme_function('slideshow', $post->ID);
	  theme_function('introduce',$post->ID);
	 theme_function('page_gmap', $post->ID); 
	 theme_function('slogan_heading',$post->ID);  ?>

	<div class="inner <?php if($layout=='right'):?>right_sidebar<?php endif;?><?php if($layout=='left'):?>left_sidebar<?php endif;?><?php if($layout=='full'):?>full_layout<?php endif;?>">
    
		<div id="main">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
			<div class="content">
				<?php the_content();?>
				<div class="clearboth"></div>
			</div>
<?php endwhile; ?>
			<div class="clearboth"></div>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>
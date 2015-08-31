<?php
if(isset($_POST['blog_layout'])) {
	$blog_layout = $_POST['blog_layout'];
} 
else {
	global $blog_layout;	
}
if(isset($_POST['loop_style'])) {
	$loop_style = $_POST['loop_style'];
	} 
else {
	global $loop_style;	
}		

if(have_posts()) while(have_posts()) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" class="blog_loop_item">

<?php
$post_type = get_post_meta( $post->ID, '_single_post_type', true );
if($post_type =='') {
	$post_type =='image';
}

$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
$featured_image_align = '';
$height = theme_option(THEME_OPTIONS,'classic_loop_featured_image_height');
$enable_image_croppiong = theme_option(THEME_OPTIONS,'disable_image_cropping');
$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images');
if($loop_style == 'classic') {
	if($blog_layout == 'full') {
		$width = 960;	
	} else {
		$width = 640;
	}
}
if($loop_style == 'classic_thumb') {
	if($blog_layout == 'full') {
		$width = 380;	
		$height = 260;
	} else {
		$width = 280;
		$height = 200;
	}
$featured_image_align = 'alignleft';
}					

if($post_type == 'image' || $post_type == '') {			
if ( has_post_thumbnail() ):
$enable_image_cropping = theme_option(THEME_OPTIONS,'disable_image_cropping') === 'true'? true: false;
$image_src  = theme_img_resize( $image_src_array[ 0 ], $width, $height, $enable_image_cropping, false );
?>
<div  class="image_container <?php echo $featured_image_align; ?>" >
	<span class="image_frame" >
		<a class="hover_effect" href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>">
			<img style="width:<?php echo $width;?>" src="<?php echo get_image_src($image_src['url']); ?>" alt="<?php the_title(); ?>" />
			<span class="hyperlink_icon hover_icon" style="left:<?php echo ($width/2-25); ?>px;"></span>
            <span class="image_overlay"></span>
		</a>
		</span>
	</div>
<?php endif;
} elseif($post_type == 'video') {
	$scheme_main_color = theme_option(THEME_OPTIONS, 'scheme_main_color' );
	$video_id = get_post_meta( $post->ID, '_single_video_id', true );	
	$video_site  = get_post_meta( $post->ID, '_single_video_site', true );
if($video_site =='') {
	$video_site =='vimeo';
}
if($video_site =='vimeo') {
	echo '<div style="width:'.$width.'px;" class="video-wrapper blog_video_type '.$featured_image_align.'"><div class="video-container"><iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color='.str_replace("#", "", $scheme_main_color).'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
}
if($video_site =='youtube') {
	echo '<div style="width:'.$width.'px;" class="video-wrapper blog_video_type '.$featured_image_align.'"><div class="video-container"><iframe src="http://www.youtube.com/embed/'.$video_id.'" frameborder="0" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
}
} 
?>
<div class="blog_info_container">
<h1 class="blog_title_heading">
	<a class="blog_title" href="<?php echo get_permalink() ?>" rel="bookmark" title="<?php printf( __("Permanent Link to %s", 'theme_frontend'), get_the_title() ); ?>"><?php the_title(); ?></a>
</h1>
<div class="blog_excerpt"><?php the_excerpt(); ?></div>
<div class="blog_meta">
<!--	<time class="meta_time" datetime="<?php the_time('Y/m/d'); ?>">
		<a href="<?php echo get_month_link(get_the_time("Y"), get_the_time("m")); ?>">
			<span class="month"><?php  the_time('M'); ?></span>
			<span class="day"><?php  the_time('d'); ?></span> 
            <span class="month"><?php  the_time('Y'); ?></span>    
		</a>
	</time>-->
    <span class="blog_date"><i class="icon-calendar icon-fixed-width ws-icon-theme-scheme"></i><a href="<?php echo get_month_link(get_the_time("Y"), get_the_time("m")); ?>"><?php echo the_time('Y/m/d'); ?></a></span>
	<span class="blog_permalink"><i class="icon-link icon-fixed-width ws-icon-theme-scheme"></i><a href="<?php echo get_permalink() ?>"><?php _e('Permalink','theme_frontend'); ?></a></span>
	<span class="blog_comment"><i class="icon-comment icon-fixed-width ws-icon-theme-scheme"></i><?php comments_popup_link(__('No Response','theme_frontend'), __('1 Response','theme_frontend'), __('% Responses','theme_frontend')) ?></span>
   <!-- <span class="blog_posttype"><a href="<?php echo get_permalink() ?>"><?php if($post_type == '') {?> image <?php } else { echo $post_type; }?><a></span> -->

</div>
</div>
<div class="clearboth"></div>
</article>
<?php endwhile; wp_reset_query(); ?>
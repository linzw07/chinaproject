<?php
/*-------------------------------------------------------------
		Single Post
-------------------------------------------------------------*/

$blog_page = theme_option(THEME_OPTIONS,'blog_page');
if($blog_page == $post->ID){
	return require(THEME_DIR . "/blog.php");
}
$single_layout = get_post_meta($post->ID, '_layout', true);
if(empty($single_layout) || $single_layout == 'default'){
	$single_layout = theme_option(THEME_OPTIONS,'single_layout');
}
$date_format = theme_option(THEME_OPTIONS, 'date_format');
$post_type = get_post_meta( $post->ID, '_single_post_type', true );

add_action('wp_head', 'social_networks_meta');


function social_networks_meta() {
	$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
	$out = '<meta property="og:image" content="'.get_image_src( $image_src_array[ 0 ] ).'"/>';
	$out .= '<meta property="og:url" content="'.get_permalink().'"/>';
	$out .= '<meta property="og:title" content="'.get_the_title().'"/>';
	echo $out;
}
get_header();
?>

<div id="page">
<?php theme_function('slideshow', $post->ID); ?>
<?php  theme_function('slogan_heading',$post->ID);  ?>
<?php theme_function('introduce',$post->ID);?>
	<div class="inner <?php if($single_layout=='right'):?>right_sidebar<?php endif;?><?php if($single_layout=='left'):?>left_sidebar<?php endif;?> <?php if($single_layout=='full'):?>full_layout<?php endif;?>">
    <div id="main">
<?php if(have_posts()) while(have_posts()) : the_post(); ?>

<article id="post-<?php the_ID(); ?>" class="content single <?php if(theme_option(THEME_OPTIONS, 'disable_meta') == 'true') :
					if( get_post_meta( $post->ID, '_disable_meta', true ) !='' && get_post_meta( $post->ID, '_disable_meta', true ) == 'true') :
					echo 'enabled_meta';
					endif; endif;
					?>">

<?php
if(theme_option(THEME_OPTIONS, 'disable_featured_image') == 'true') :
	if( get_post_meta( $post->ID, '_disable_featured_image', true ) =='true' && get_post_meta( $post->ID, '_disable_featured_image', true ) != '') :
		if($single_layout == 'full') {
			$width = 960;
		} else {
			$width = 670;
	}
	$height = theme_option(THEME_OPTIONS,'single_featured_image_height');
$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );
if($post_type == 'image' || $image_src_array[0] != '') {			

$enable_image_cropping = theme_option(THEME_OPTIONS,'disable_image_cropping') === 'true'? true: false;
$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images') === 'true'? true: false;	
$image_src  = theme_img_resize( $image_src_array[ 0 ], $width, $height, $enable_image_cropping, $enable_retina_images );						
if ( has_post_thumbnail() ):
?>
	<div  class="image_container">
		<span class="image_frame">
			<img src="<?php echo get_image_src($image_src['url']); ?>" alt="<?php the_title(); ?>" />
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
echo '<div style="width:'.$width.'px;" class="video-wrapper blog_video_type "><div class="video-container"><iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color='.str_replace("#", "", $scheme_main_color).'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
		}
if($video_site =='youtube') {
echo '<div style="width:'.$width.'px;" class="video-wrapper blog_video_type"><div class="video-container"><iframe src="http://www.youtube.com/embed/'.$video_id.'" frameborder="0" width="'.$width.'" height="'.$height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
		}		
}			
	endif;
endif;

?>



<div class="single_right_section">
<h1 class="blog_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

<?php

if(theme_option(THEME_OPTIONS, 'disable_meta') == 'true') :
		if( get_post_meta( $post->ID, '_disable_meta', true ) !='' && get_post_meta( $post->ID, '_disable_meta', true ) == 'true') :

?>
<div class="blog_meta">
<!--<time class="meta_time" datetime="<?php the_time('Y/m/d'); ?>">
<a href="<?php echo get_month_link(get_the_time("Y"), get_the_time("m")); ?>">
	<span class="month"><?php  the_time('M'); ?></span>
	<span class="day"><?php  the_time('d'); ?></span> 
    <span class="month"><?php  the_time('Y'); ?></span>   
</a>
</time>
<div class="clearboth"></div>-->
<span class="blog_date"><i class="icon-calendar icon-fixed-width ws-icon-theme-scheme"></i><a href="<?php echo get_month_link(get_the_time("Y"), get_the_time("m")); ?>"><?php echo the_time('Y/m/d'); ?></a></span>
<span class="blog_author"><i class="icon-user icon-fixed-width ws-icon-theme-scheme"></i><?php the_author_posts_link(); ?></span>
<span class="blog_comment comment_scroll"><i class="icon-comment icon-fixed-width ws-icon-theme-scheme"></i><?php comments_popup_link(__('No Response','theme_frontend'), __('1 Response','theme_frontend'), __('% Responses','theme_frontend')) ?></span>
<span class="blog_permalink"><i class="icon-link icon-fixed-width ws-icon-theme-scheme"></i><a href="<?php echo get_permalink() ?>"><?php _e('Permalink','theme_frontend'); ?></a></span>
<!--<span class="blog_posttype"><a href="<?php echo get_permalink() ?>"><?php if($post_type == '') {?> image <?php } else { echo $post_type; }?><a></span>-->

<?php
if( get_post_meta( $post->ID, '_disable_tags', true ) =='true') :
	$tags = get_the_tags();
	if(!empty($tags)) : ?>
<span class="blog_tags">
<i class="icon-tags ws-icon-theme-scheme"></i>
<?php  the_tags(''); ?>
</span>
<?php endif; endif; ?>

<div class="clearboth"></div>
</div>
<?php endif; endif; ?>

<div class="blog_content">
<?php the_content(); ?>
</div>

<div class="clearboth"></div>
<?php if(theme_option(THEME_OPTIONS, 'enable_author') == 'true') :
		if( get_post_meta( $post->ID, '_disable_about_author', true ) =='true' && get_post_meta( $post->ID, '_disable_about_author', true ) !='') :	
		global $user;
?>



<section class="post_author_box">
 <h3><?php _e('About the author','theme_frontend'); ?></h3>
		<?php echo get_avatar( get_the_author_meta('email'), '80',false ,get_the_author_meta('nickname', $user['ID'])); ?>
		<span class="author_info">         
		<span class="author_desc"><span class="post_author_name"><?php the_author_link(); ?> </span> <?php the_author_meta('description'); ?></span>
            <a class="view_author_posts" href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"><?php _e('More posts by this author', 'theme_frontend'); ?></a>
             <div class="clearboth"></div>
            <ul class="author_links">
            <?php $post = get_post($post->ID);
        		   $author_id = $post->post_author;
        		   $author_posts_rss_link = get_author_feed_link($author_id); ?>
				<li><a href="<?php echo $author_posts_rss_link; ?>" class="rss" title="Subscribe to <?php the_author_meta( 'display_name' ); ?>'s posts feed via RSS"><i class="icon-rss"></i></a></li>
               	<li><a title="Contact <?php the_author_meta( 'display_name' ); ?> via Email" href="mailto:<?php the_author_meta('user_email', $user['ID']); ?>" class="email"><i class="icon-envelope"></i></a></li>
            <?php if(get_the_author_meta('twitter')) : ?>
				<li><a href="http://twitter.com/<?php the_author_meta( 'twitter' ); ?>" class="twitter" title="Follow <?php the_author_meta( 'display_name' ); ?> on Twitter"><i class="icon-twitter"></i></a>
                </li>
			<?php endif; ?>
            <li><a href="<?php the_author_meta( 'user_url', $user['ID']); ?>" class="website" title="You can find <?php the_author_meta( 'display_name' ); ?> on <?php the_author_meta( 'user_url', $user['ID']); ?>"><i class="icon-link"></i></a></li>
            </ul>
            </span>
 <div class="clearboth"></div>
</section>
 <div class="clearboth"></div>
<?php endif; endif; ?>
</div>
<div class="clearboth"></div>

<div class="single_bottom_meta">
<?php 
if(theme_option(THEME_OPTIONS, 'enable_single_social_bookmarks') == 'true') :	
  if( get_post_meta( $post->ID, '_disable_social_share', true ) != 'false') :
	wp_enqueue_script( 'jquery-facebook', 'http://connect.facebook.net/en_US/all.js#xfbml=1', array('jquery'), false);
	wp_enqueue_script( 'jquery-twitter', 'http://platform.twitter.com/widgets.js', array('jquery'), false);
	wp_enqueue_script( 'jquery-googleplus', 'https://apis.google.com/js/plusone.js', array('jquery'), false);
	wp_enqueue_script( 'jquery-pinterest', '//assets.pinterest.com/js/pinit.js', array('jquery'), false);
	$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
  ?>
<span class="share_buttons"><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink(); ?>"  data-text="<?php echo  get_the_title(); ?>" data-via="<?php echo theme_option(THEME_OPTIONS, 'twitter_username'); ?>" data-count="horizental">Tweet</a></span>
<span class="share_buttons" style="margin-right:30px;"><div id="fb-root"></div><fb:like href="<?php echo get_permalink(); ?>" layout="button_count"></fb:like></span>
<span class="share_buttons"><g:plusone size="medium" href="<?php echo get_permalink(); ?>"></g:plusone></span>
<span class="share_buttons"><a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&amp;media=<?php echo get_image_src( $image_src_array[ 0 ] ); ?>&amp;description=<?php the_excerpt(); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></span>
<?php endif; endif; ?>
<span class="blog_permalink"><i class="icon-link icon-fixed-width ws-icon-theme-scheme"></i><a href="<?php echo get_permalink() ?>"><?php _e('Permalink','theme_frontend'); ?></a></span>
<span class="blog_author"><i class="icon-user icon-fixed-width ws-icon-theme-scheme"></i><?php the_author_posts_link(); ?></span>
<div class="clearboth"></div>
</div>
 <div class="clearboth"></div>
<?php
if(theme_option(THEME_OPTIONS, 'enable_single_related_posts') == 'true') :
	if( get_post_meta( $post->ID, '_disable_related_posts', true ) != 'false') :
		theme_function('blog_related_posts'); 
	endif;
endif;
?>
<div class="clearboth"></div>
<?php if(theme_option(THEME_OPTIONS,'entry_navigation')  == 'true'):?>
<nav class="blog_pagination">
   <div class="previous"><?php previous_post_link( '%link', '<span class="meta-nav"></span> ' ); ?></div>
   <div class="next"><?php next_post_link( '%link', '<span class="meta-nav"></span>' ); ?></div>
</nav>
<?php endif;?>
 <div class="clearboth"></div>
</article>
<?php 
if(theme_option(THEME_OPTIONS,'enable_blog_single_comments')  == 'true'):
	comments_template( '', true );
endif
?>
<?php endwhile;  ?>
		</div>
       	<?php if($single_layout !== 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>
<?php
/*-------------------------------------------------------------
		Single Portfolio Page
-------------------------------------------------------------*/
$blog_page = theme_option(THEME_OPTIONS,'blog_layout');
$blog_layout =  theme_option(THEME_OPTIONS,'search_layout');
$loop_style = theme_option(THEME_OPTIONS, 'search_loop_style');
if($blog_page == $post->ID){
	return require(THEME_DIR . "/blog.php");
}
$layout = get_post_meta($post->ID, '_layout', true);
if(empty($layout) || $layout == 'default'){
	$layout=theme_option(THEME_OPTIONS,'portfolio_layout');
}

$terms = get_the_terms(get_the_id(), 'portfolio_category');
$terms_slug = array();
$terms_name = array();
if (is_array($terms)) {
	foreach($terms as $term) {
		$terms_name[] = $term->name;
	}
}
?>

<?php  get_header(); ?>
<div id="page"  class="<?php if(theme_option(THEME_OPTIONS, 'enable_page_parallax') == 'true') : ?>ws-page-parallax<?php endif; ?>">
<?php theme_function('slideshow', $post->ID); theme_function('slogan_heading',$post->ID);  ?>
<div class="inner <?php if($layout=='left'):?>left_sidebar<?php endif;?><?php if($layout=='right'):?>right_sidebar<?php endif;?>">
<div class="portfolio_single_introduce">
<?php if(theme_option(THEME_OPTIONS,'disable_portfolio_title') != 'false') : ?>
<h1><?php the_title(); echo edit_post_link( '', '<span class="ws_edit_link">', '</span>' ); ?></h1>
<?php endif; ?>
<nav class="portfolio_single_pagination">
   <div class="previous"><?php previous_post_link( '%link', '<span class="meta-nav"></span> ' ); ?></div>
   <div class="next"><?php next_post_link( '%link', '<span class="meta-nav"></span>' ); ?></div>
</nav>
<div class="clearboth"></div>
<?php if(theme_option(THEME_OPTIONS,'disable_portfolio_meta') != 'false') : ?>
<div class="portfolio_single_meta">
<?php if(theme_option(THEME_OPTIONS,'disable_post_date') != 'false') : ?>
<i class="icon-calendar scheme_color"></i>
<time class="portfolio_single_date" datetime="<?php the_time('Y/m/d'); ?>"><a href="<?php echo get_month_link(get_the_time("Y"), get_the_time("m")); ?>"><?php  the_time('Y M d'); ?></a></time>
<?php endif; ?>
<?php if(theme_option(THEME_OPTIONS,'disable_portfolio_category') != 'false') : ?>
<i class="icon-tags scheme_color"></i>
<span class="portfolio_single_category"><?php echo implode(', ', $terms_name); ?></span>
<?php endif; ?>
</div>


<div class="portfolio_single_social">
<?php $image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true ); ?>
<?php 
if(theme_option(THEME_OPTIONS,'disable_portfolio_pinterest') != 'false') :
wp_enqueue_script( 'jquery-pinterest', '//assets.pinterest.com/js/pinit.js', array('jquery'), false);
?>
<span class="share_buttons"><a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&amp;media=<?php echo get_image_src( $image_src_array[ 0 ] ); ?>&amp;description=<?php the_excerpt(); ?>" class="pin-it-button" count-layout="horizontal"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></span>
<?php endif; ?>
<?php 
if(theme_option(THEME_OPTIONS,'disable_portfolio_twitter') != 'false') :
wp_enqueue_script( 'jquery-twitter', 'http://platform.twitter.com/widgets.js', array('jquery'), false);
?>
<span class="share_buttons"><a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo get_permalink(); ?>"  data-text="<?php echo  get_the_title(); ?>" data-via="<?php echo theme_option(THEME_OPTIONS, 'twitter_username'); ?>" data-count="horizental">Tweet</a></span>
<?php endif; ?>
<?php 
if(theme_option(THEME_OPTIONS,'disable_portfolio_facebook') != 'false') :
wp_enqueue_script( 'jquery-facebook', 'http://connect.facebook.net/en_US/all.js#xfbml=1', array('jquery'), false);
?>
<span class="share_buttons" style="margin-right:30px;"><div id="fb-root"></div><fb:like href="<?php echo get_permalink(); ?>" layout="button_count"></fb:like></span>
<?php endif; ?>
<?php 
if(theme_option(THEME_OPTIONS,'disable_portfolio_plus') != 'false') :
wp_enqueue_script( 'jquery-googleplus', 'https://apis.google.com/js/plusone.js', array('jquery'), false);
?>
<span class="share_buttons"><g:plusone size="medium" href="<?php echo get_permalink(); ?>"></g:plusone></span>
<?php endif; ?>
</div>
<div class="clearboth"></div>
</div>
<?php endif; ?>
<div class="clearboth"></div>
<div id="main">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" class="portfolio_single">       
	<?php if(theme_option(THEME_OPTIONS,'portfolio_featured_image') == 'true'):
		if( get_post_meta( $post->ID, '_disable_featured_image', true ) =='true') :
 theme_function('portfolio_featured_image');
endif; endif; ?>
	<?php the_content(); ?>
	<div class="clearboth"></div>
</article>
<?php if(theme_option(THEME_OPTIONS,'enable_comment')  == 'true') comments_template( '', true ); ?>
<?php endwhile; ?>
		</div>
		<?php if($layout != 'full') get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>
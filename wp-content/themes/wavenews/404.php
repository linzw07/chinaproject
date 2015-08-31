<?php 
/*------------------------------------------------------------- 
		404 Page
-------------------------------------------------------------*/

$exclude_cats = theme_option(THEME_OPTIONS,'excluded_cats');
$theme_main_color = theme_option(THEME_OPTIONS, 'scheme_main_color');
get_header(); ?>

<div id="page" class="<?php if(theme_option(THEME_OPTIONS, 'enable_page_parallax') == 'true') : ?>ws-page-parallax<?php endif; ?>">
<?php theme_function('introduce');?>
	<div class="inner right_sidebar">
    
		<div id="main">
			<div class="content">
   <h3><?php _e('Pages','theme_frontend');?></h3>
    <ul>
    <?php wp_list_pages('depth=0&sort_column=menu_order&title_li=' ); ?>		
    </ul>
    <div class="divider top"><a href="#"><?php _e("Top","theme_frontend");?></a><span></span></div>
    
    <h3><?php _e('Monthly Archives','theme_frontend');?></h3>
    <ul>
    <?php wp_get_archives('type=monthly&limit=24'); ?>		
    </ul>
    <div class="divider top"><a href="#"><?php _e("Top","theme_frontend");?></a><span></span></div>

    <!-- Category Archives List -->
    <h3><?php _e('Category Archives','theme_frontend');?></h3>
    <ul class="">
    <?php wp_list_categories( array( 'exclude'=> implode(",",$exclude_cats), 'show_count' => true, 'use_desc_for_title' => false, 'title_li' => false ) ); ?>
    </ul>
    <div class="divider top"><a href="#"><?php _e("Top","theme_frontend");?></a><span></span></div>

    
    <!-- Feeds List -->
    <h3><?php _e('Feeds','theme_frontend');?></h3>
    <ul>
        <li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>"><?php _e('Main RSS','theme_frontend');?></a></li>
        <li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>"><?php _e('Comment Feed','theme_frontend');?></a></li>
    </ul>
				<div class="clearboth"></div>
			</div>
            <div class="clearboth"></div>
			<?php if(function_exists('wp_pagenavi')) { wp_pagenavi(); } ?>
		</div>
		<?php get_sidebar(); ?>
		<div class="clearboth"></div>
	</div>
</div>
<?php get_footer(); ?>
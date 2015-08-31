<?php


/*------------------------------------------------------------- 
		NEWS SHORTCODE
-------------------------------------------------------------*/

function theme_shortcode_news( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'count' => 5,
				'column' => 2,
				'layout' => 'sidebar',
				'parent_container' => 1,
				'offset' => 0,
				'cat' => '',
				'posts' => '',
				'image_height' => '300',
				'featured_image' => 'true',
				'title' => 'true',
				'excerpt' => 'true',
				'meta'=>'true',
				'more_button' => 'true',
				'button_size' => 'medium',
				'button_align'=> 'aligncenter',
				'pagination' => 'false',
				'orderby'=> 'date',
				'order'=> 'DESC'

			), $atts ) );

	switch ( $column ) {
	case 1:
		$column_class = 'one_column';
		if ( $layout=='sidebar' ) {
			$image_width = '640';
		}else {
			$image_width = '960';
		}
		break;
	case 2:
		$column_class = 'two_column';
		if ( $layout=='sidebar' ) {
			$image_width = '305';
		}else {
			$image_width = '460';
		}
		break;
	case 3:
		$column_class = 'three_column';
		if ( $layout=='sidebar' ) {
			$image_width = '195';
		}else {
			$image_width = '294';
		}
		break;
	case 4:
		$column_class = 'four_column';
	default:
		if ( $layout=='sidebar' ) {
			$image_width = '140';
		}else {
			$image_width = '210';
		}
	}


// get the real width of the image

switch ( $parent_container ) {
	case 'full':
		$parent_width = 1;
		break;
	case 'one_half':
		$parent_width = 1/2;
		break;
	case 'one_third':
		$parent_width = 1/3;
		break;
	case 'two_third':
		$parent_width = 2/3;
		break;
	case 'one_fourth':
		$parent_width = 1/4;
		break;
	case 'three_fourth':
		$parent_width = 3/4;
		break;
	case 'one_fifth':
		$parent_width = 1/5;
		break;
	case 'two_fifth':
		$parent_width = 2/5;
		break;
	case 'three_fifth':
		$parent_width = 3/5;
		break;
	case 'four_fifth':
		$parent_width = 4/5;
		break;
	default:
		$parent_width = 1;
		break;
	}



	$image_width=$image_width*$parent_width;



	$query = array(
		'posts_per_page' => (int)$count,
		'post_type'=>'news',
	);
	if ( $offset ) {
		$query['offset'] = $offset;
	}
	if ( $cat ) {
		$query['tax_query'] = array(
				array(
					'taxonomy' => 'news_category',
					'field' => 'id',
					'terms' => implode( ",", $cat)
					)
		);
	}
	if ( $posts ) {
		$query['post__in'] = explode( ',', $posts );
	}
	if ( $orderby ) {
		$query['orderby'] = $orderby;
	}
	if ( $order ) {
		$query['order'] = $order;
	}

	global $wp_version;
	
	if(is_front_page() && version_compare($wp_version, "3.1", '>=')){
			$paged = (get_query_var('paged')) ?get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
	}else{
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
	}
		
	$query['paged'] = $paged;
		

	$r = new WP_Query( $query );

	$column = (int)$column;
	if ( $column > 4 ) {
		$column = 4;
	}elseif ( $column < 1 ) {
		$column = 1;
	}

	$atts = array(
		'column_class' => $column_class,
		'column' => $column,
		'title' => $title,
		'meta' => $meta,
		'excerpt' => $excerpt,
		'more_button' => $more_button,
		'featured_image' => $featured_image,
		'button_size' => $button_size,
		'button_align' => $button_align,
		'image_width' => $image_width,
		'image_height' => $image_height,
		'posts_per_page' => (int)$count,
		'pagination' => $pagination
	);

	$output = '';
	$output .= theme_column_news( $r, $atts, 1 );


	if ( $pagination == 'true' ) {
		ob_start();
		theme_news_pagenavi( '', '', $r, $paged );
		$output .= ob_get_clean();
	}

	wp_reset_postdata();

	return $output;
}
add_shortcode( 'news', 'theme_shortcode_news' );


//========================================================================


function theme_column_news( &$r, $atts, $current ) {
	global $post;
	extract( $atts );
	$class = array( 'half', 'third', 'fourth' );
	if ( $column_class !== 'one_column' ) {
		$css = $class[$column-2];
	}

 
	$output = '';
	$output .= '<section class="shortcode_blog '.$column_class.' blog">';
	$i = 0;

	if ( $r->have_posts() ):
		while ( $r->have_posts() ) :
			$i++;

		$r->the_post();

	$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
	$post_type = get_post_meta( $post->ID, '_single_post_type', true );

	$enable_image_cropping = theme_option(THEME_OPTIONS,'disable_image_cropping') === 'true'? true: false;
	$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images') === 'true'? true: false;	
	$image_src  = theme_img_resize( $image_src_array[ 0 ], $image_width, $image_height , $enable_image_cropping, $enable_retina_images );
	

	if ( $column != 1 ) {
		if ( $i%$column !== 0 ) {
			$output .= "<div class=\"one_{$css}\">";
		} else {
			$output .= "<div class=\"one_{$css} last\">";
		}
	}


	$output .= '<article id="post-'. get_the_ID() .'">';
	if ( $post_type == 'image' || $post_type == '' ) {
		if ( $featured_image == "true" ) {
			if ( has_post_thumbnail() ):
				$output .= '<div class="image_container">';
			$output .= '<span class="image_frame">';
			$output .= '<a class="hover_effect" href="'. get_permalink().'" title="'. get_the_title().'">';
			$output .= '<img src="'. get_image_src($image_src['url']) .'" alt="'. get_the_title().'" />';
			$output .= '<span class="hyperlink_icon hover_icon" style="left:' .(($image_width/2)-25) . 'px;"></span><span class="image_overlay"></span>';
			$output .= '</a>';
			$output .= '</span>';
			$output .= '</div>';
			endif;
		}
	} elseif ( $post_type == 'video' ) {
		$scheme_main_color = theme_option( THEME_OPTIONS, 'scheme_main_color' );
		$video_id = get_post_meta( $post->ID, '_single_video_id', true );
		$video_site  = get_post_meta( $post->ID, '_single_video_site', true );

		if ( $video_site =='' ) {
			$video_site =='vimeo';

		}


		if ( $video_site =='vimeo' ) {
			$output .='<div style="width:'.$image_width.'px;" class="video-wrapper blog_video_type "><div class="video-container"><iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color='.str_replace( "#", "", $scheme_main_color ).'" width="'.$image_width.'" height="'.$image_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
		}


		if ( $video_site =='youtube' ) {
			$output .='<div style="width:'.$image_width.'px;" class="video-wrapper blog_video_type"><div class="video-container"><iframe src="http://www.youtube.com/embed/'.$video_id.'" frameborder="0" width="'.$image_width.'" height="'.$image_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';


		}
	}

	$output .= '<div >';
	
	if ( $title == "true" ) {
		$output .= '<h1 class="shortcode_blog_title"><a href="'. get_permalink().'" rel="bookmark" title="'. __( "Permanent Link to" , 'theme_frontend' ) . get_the_title()  .'">'. get_the_title().' </a></h1>';
	}


	$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = __("No Response","theme_frontend");
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(" Responses","theme_frontend");
		} else {
			$comments =  __("1 Response","theme_frontend");
		}
		$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	} else {
		$write_comments =  __("Comments are off for this post.","theme_frontend");
	}


	if ( $meta == "true" ) {	
		 $n= 4-$column;
		$output .= '<div class="blog_meta">';
		if($n>=0) $output .= '<span class="blog_date"><i class="icon-calendar icon-fixed-width ws-icon-theme-scheme"></i><a href="' . get_month_link(get_the_time("Y"), get_the_time("m")).'" >'. get_the_time("Y/m/d") . '</a></span>';
		if($n>=1) $output .= '<span class="blog_comment comment_scroll"><i class="icon-comment icon-fixed-width ws-icon-theme-scheme"></i>'.$write_comments.'</span>';
		if($n>=3) $output .= '<span class="blog_author"><i class="icon-user icon-fixed-width ws-icon-theme-scheme"></i>'. get_the_author(). '</span>';
		if($n>=3) $output .= '<span class="blog_permalink"><i class="icon-link icon-fixed-width ws-icon-theme-scheme"></i><a href="'. get_permalink(). '">' . __("Permalink","theme_frontend") . '</a></span>';
		
		$tags = get_the_tags();
		if(!empty($tags)){
			if($n>=3) $output .= '<span class="blog_tags"><i class="icon-tags ws-icon-theme-scheme"></i>'. get_the_tag_list('',', ','') . '</span>';
		}

		$output .='<div class="clearboth"></div></div>';
	}


	if ( $excerpt == "true" ) {
		$output .= '<div class="blog_excerpt"><p>'. get_the_excerpt() .'</p></div>';
	}
	
	if ( $more_button == "true" ) {
		$output .= '<div class="more-button '.$button_align.'"><a href="'. get_permalink() .'" class="ws-button '.$button_size.' scheme_background_color"><span>';
		$output .= __( 'Read More', 'theme_frontend' );
		$output .= '</span></a></div>';
	}
	$output .= '</div>';
	$output .= '</article>';



	if ( $column != 1 ) {
		$output .= '</div>';
		if ( $i%$column === 0 ) {
			$output .= "<div class=\"clearboth\"></div>";
		}
	}
	endwhile;
	endif;
	$output .= '</section>';

	return $output;
}


//========================================================================



function theme_news_pagenavi($before = '', $after = '', $blog_query, $paged) {
	global $wpdb, $wp_query;
	
	if (is_single())
		return;
	
	$pagenavi_options = array(
		'pages_text' => '',
		'current_text' => '%PAGE_NUMBER%',
		'page_text' => '%PAGE_NUMBER%',
		'first_text' => __('&laquo; First','theme_frontend'),
		'last_text' => __('Last &raquo;','theme_frontend'),
		'next_text' => __('&raquo;','theme_frontend'),
		'prev_text' => __('&laquo;','theme_frontend'),
		'dotright_text' => __('...','theme_frontend'),
		'dotleft_text' => __('...','theme_frontend'),
		'style' => 1,
		'num_pages' => 4,
		'always_show' => 0,
		'num_larger_page_numbers' => 3,
		'larger_page_numbers_multiple' => 10,
		'use_pagenavi_css' => 0,
	);
	
	$request = $blog_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	global $wp_version;
	if((is_front_page() || is_home() ) && version_compare($wp_version, "3.1", '>=')){//fix wordpress 3.1 paged query 
		$paged = (get_query_var('paged')) ?intval(get_query_var('paged')) : intval(get_query_var('page'));
	}else{
		$paged = intval(get_query_var('paged'));
	}
	
	$numposts = $blog_query->found_posts;
	$max_page = intval($blog_query->max_num_pages);
	
	if (empty($paged) || $paged == 0)
		$paged = 1;
	$pages_to_show = intval($pagenavi_options['num_pages']);
	$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor($pages_to_show_minus_1 / 2);
	$half_page_end = ceil($pages_to_show_minus_1 / 2);
	$start_page = $paged - $half_page_start;
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$end_page = $paged + $half_page_end;
	if (($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	
	if ($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$larger_pages_array = array();
	if ($larger_page_multiple)
		for($i = $larger_page_multiple; $i <= $max_page; $i += $larger_page_multiple)
			$larger_pages_array[] = $i;
	
	if ($max_page > 1 || intval($pagenavi_options['always_show'])) {
		$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
		$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
		echo $before . '<div class="wp-pagenavi">' . "\n";
		switch(intval($pagenavi_options['style'])){
			// Normal
			case 1:
				if (! empty($pages_text)) {
					echo '<span class="pages">' . $pages_text . '</span>';
				}
				/*if ($start_page >= 2 && $pages_to_show < $max_page) {
					$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
					echo '<a href="' . esc_url(get_pagenum_link()) . '" class="first" title="' . $first_page_text . '">' . $first_page_text . '</a>';
					if (! empty($pagenavi_options['dotleft_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotleft_text'] . '</span>';
					}
				}*/
				$larger_page_start = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page < $start_page && $larger_page_start < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_start++;
					}
				}
				previous_posts_link($pagenavi_options['prev_text']);
				for($i = $start_page; $i <= $end_page; $i++) {
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<span class="current">' . $current_page_text . '</span>';
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($i)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
					}
				}
				next_posts_link($pagenavi_options['next_text'], $max_page);
				$larger_page_end = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page > $end_page && $larger_page_end < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_end++;
					}
				}
			
				break;
			// Dropdown
			case 2:
				echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="get">' . "\n";
				echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">' . "\n";
				for($i = 1; $i <= $max_page; $i++) {
					$page_num = $i;
					if ($page_num == 1) {
						$page_num = 0;
					}
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<option value="' . esc_url(get_pagenum_link($page_num)) . '" selected="selected" class="current">' . $current_page_text . "</option>\n";
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<option value="' . esc_url(get_pagenum_link($page_num)) . '">' . $page_text . "</option>\n";
					}
				}
				echo "</select>\n";
				echo "</form>\n";
				break;
		}
		echo '</div>' . $after . "\n";
	}
}


//========================================================================











/*------------------------------------------------------------- 
		BUTTON SHORTCODE
-------------------------------------------------------------*/

function theme_shortcode_button( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'id' => false,
				'class' => false,
				'link' => false,
				'linktarget' => false,
				'skin' => false,
				'size' => false,
				'desc' => false,
				'align' => false,

			), $atts ) );




	$id         = $id ? ' id="' . $id . '"' : '';
	$skin = $skin ? ' '. $skin : ' '. theme_option( THEME_OPTIONS, 'scheme_main_color' );
	$class      = $class ? ' ' . $class : '';
	$link       = $link ? ' href="' . $link . '"' : '';
	$linktarget = $linktarget ? ' target="' . $linktarget . '"' : '';
	$size       = $size ? ' '.$size .'' : '';




	$content = '<a' . $id . $link . $linktarget .' class="ws-button ' . $skin . $class . $size .'"><span>'. trim( $content ) .'</span></a>';

	return '<p class="' . $align . '">' . $content . '</p>';

}
add_shortcode( 'button', 'theme_shortcode_button' );






/*------------------------------------------------------------- 
		CULUMNS SHORTCODE
-------------------------------------------------------------*/

function theme_shortcode_column( $atts, $content = null, $code ) {
	return '<div class="' . $code . '">' . wpautop( do_shortcode( trim( $content ) ) ) . '</div>';
}
function theme_shortcode_column_last( $atts, $content = null, $code ) {
	return '<div class="' . str_replace( '_last', '', $code ) . ' last">' . wpautop( do_shortcode( trim( $content ) ) ) . '</div><div class="clearboth"></div>';
}

add_shortcode( 'one_half', 'theme_shortcode_column' );
add_shortcode( 'one_third', 'theme_shortcode_column' );
add_shortcode( 'one_fourth', 'theme_shortcode_column' );
add_shortcode( 'one_fifth', 'theme_shortcode_column' );
add_shortcode( 'one_sixth', 'theme_shortcode_column' );

add_shortcode( 'two_third', 'theme_shortcode_column' );
add_shortcode( 'three_fourth', 'theme_shortcode_column' );
add_shortcode( 'two_fifth', 'theme_shortcode_column' );
add_shortcode( 'three_fifth', 'theme_shortcode_column' );
add_shortcode( 'four_fifth', 'theme_shortcode_column' );
add_shortcode( 'five_sixth', 'theme_shortcode_column' );

add_shortcode( 'one_half_last', 'theme_shortcode_column_last' );
add_shortcode( 'one_third_last', 'theme_shortcode_column_last' );
add_shortcode( 'one_fourth_last', 'theme_shortcode_column_last' );
add_shortcode( 'one_fifth_last', 'theme_shortcode_column_last' );
add_shortcode( 'one_sixth_last', 'theme_shortcode_column_last' );

add_shortcode( 'two_third_last', 'theme_shortcode_column_last' );
add_shortcode( 'three_fourth_last', 'theme_shortcode_column_last' );
add_shortcode( 'two_fifth_last', 'theme_shortcode_column_last' );
add_shortcode( 'three_fifth_last', 'theme_shortcode_column_last' );
add_shortcode( 'four_fifth_last', 'theme_shortcode_column_last' );
add_shortcode( 'five_sixth_last', 'theme_shortcode_column_last' );

/*------------------------------------------------------------- 
		SITEMAP PAGES SHORTCODE
-------------------------------------------------------------*/

function theme_sitemap_pages( $atts ) {
	extract( shortcode_atts( array(
				'number' => '0',
				'depth' => '0',
			), $atts ) );

	return '<ul>'.wp_list_pages( 'depth=0&sort_column=menu_order&echo=0&title_li=&depth='.$depth.'&number='.$number ).'</ul>';
}
add_shortcode( 'sitemap_pages', 'theme_sitemap_pages' );


/*------------------------------------------------------------- 
		SITEMAP CATEGOIES SHORTCODE
-------------------------------------------------------------*/

function theme_sitemap_categories( $atts ) {
	extract( shortcode_atts( array(
				'number' => '0',
				'depth' => '0',
				'show_count' => true,
				'show_feed' => true,
			), $atts ) );

	if ( $show_count === 'false' ) {
		$show_count = false;
	}
	if ( $show_feed === true || $show_feed == 'true' ) {
		$feed = __( 'RSS', 'theme_frontend' );
	}else {
		$feed = '';
	}

	$exclude_cats = theme_option( THEME_OPTIONS, 'excluded_cats' );
	return '[raw]<ul>'.wp_list_categories( array( 'exclude'=> implode( ",", $exclude_cats ), 'feed' => $feed, 'show_count' => $show_count, 'use_desc_for_title' => false, 'title_li' => false, 'echo' => 0 ) ).'</ul>[/raw]';
}
add_shortcode( 'sitemap_categories', 'theme_sitemap_categories' );

/*------------------------------------------------------------- 
		SITEMAP POSTS SHORTCODE
-------------------------------------------------------------*/

function theme_sitemap_posts( $atts ) {
	extract( shortcode_atts( array(
				'show_comment' => true,
				'number' => '0',
				'cat' => '',
				'posts' => '',
				'author' => '',
			), $atts ) );

	if ( $number == 0 ) {
		$number = 1000;
	}
	if ( $show_comment === 'false' ) {
		$show_comment = false;
	}

	$query = array(
		'showposts' => (int)$number,
		'post_type'=>'post',
	);
	if ( $cat ) {
		$query['cat'] = $cat;
	}
	if ( $posts ) {
		$query['post__not_in'] = explode( ',', $posts );
	}
	if ( $author ) {
		$query['author'] = $author;
	}
	$archive_query = new WP_Query( $query );

	$output = '';
	while ( $archive_query->have_posts() ) : $archive_query->the_post();
	$output .= '<li><a href="'.get_permalink().'" rel="bookmark" title="'.sprintf( __( "Permanent Link to %s", 'theme_frontend' ), get_the_title() ).'">'. get_the_title().'</a>'.( $show_comment?' ('.get_comments_number().')':'' ).'</li>';
	endwhile;
	return '<ul>'.$output.'</ul>';
}
add_shortcode( 'sitemap_posts', 'theme_sitemap_posts' );



/*------------------------------------------------------------- 
		SITEMAP PORTFOLIO SHORTCODE
-------------------------------------------------------------*/
function theme_sitemap_portfolios( $atts ) {
	extract( shortcode_atts( array(
				'show_comment' => false,
				'number' => '0',
				'cat' => '',
			), $atts ) );

	if ( $number == 0 ) {
		$number = 1000;
	}

	if ( $show_comment === 'true' ) {
		$show_comment = true;
	}

	$query = array(
		'showposts' => (int)$number,
		'post_type'=>'portfolio',

	);
	if ( $cat != '' ) {
		global $wp_version;
		if ( version_compare( $wp_version, "3.1", '>=' ) ) {
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'slug',
					'terms' => explode( ',', $cat )
				)
			);
		}else {
			$query['taxonomy'] = 'portfolio_category';
			$query['term'] = $cat;
		}
	}

	query_posts( $query );

	$output = '';
	while ( have_posts() ) : the_post();
	$output .= '<li><a href="'.get_permalink().'" rel="bookmark" title="'.sprintf( __( "Permanent Link to %s", 'theme_frontend' ), get_the_title() ).'">'. get_the_title().'</a>'.( $show_comment?' ('.get_comments_number().')':'' ).'</li>';
	endwhile;
	wp_reset_query();
	return '<ul>'.$output.'</ul>';

}
add_shortcode( 'sitemap_portfolios', 'theme_sitemap_portfolios' );

/*------------------------------------------------------------- 
		MESSAGE BOX SHORTCODE
-------------------------------------------------------------*/

function shortcode_message_box( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(), $atts ) );
	return '<div class="message_' . $code . '"><div class="box_content ie_png">' . do_shortcode( $content ) . '</div><div class="clearboth"></div></div>';
}

add_shortcode( 'info', 'shortcode_message_box' );
add_shortcode( 'success', 'shortcode_message_box' );
add_shortcode( 'error', 'shortcode_message_box' );
add_shortcode( 'warning', 'shortcode_message_box' );


/*------------------------------------------------------------- 
		FANCY HEADING SHORTCODE
-------------------------------------------------------------*/

function theme_fancy_heading( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'style' => 'style1',
				'size' => 'small'
			), $atts ) );

	return '<h2 class="fancy_heading '.$style.' '.$size.'">'.do_shortcode( $content ).'</h2>';
}
add_shortcode( 'fancy_heading', 'theme_fancy_heading' );


/*------------------------------------------------------------- 
		SKILL METER
-------------------------------------------------------------*/

function theme_skill_meter( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'name' => '',
				'percent' => '50'
			), $atts ) );
	$output = '<div class="skill_meter"><span class="skill_meter_title">'.$name.'</span>';
	$output .='<div class="skill_meter_wrapper"><div style="width:'.$percent.'%" class="progress_bar" data-progress="'.$percent.'%"></div></div></div><div class="clearboth"></div>';
	return $output;
}
add_shortcode( 'skill_meter', 'theme_skill_meter' );

/*------------------------------------------------------------- 
		CALLOUT BOX SHORTCODE
-------------------------------------------------------------*/

function theme_callout( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'title' => '',
				'desc' => '',
				'button_text' => 'Read More',
				'url' => '',
				'button_skin' => 'dark_gray',
			), $atts ) );
	$output = '<div class="callout_box">';
	$output .='<a href="'.$url.'" class="ws-button medium '.$button_skin.'"><span>'.$button_text.'</span></a>';
	$output .='<h2>'.$title.'</h2>';
	$output .='<span class="desc">'.$desc.'</span>';
	$output .='<div class="clearboth"></div></div>';
	return '[raw]' . $output . '[/raw]';
}
add_shortcode( 'callout', 'theme_callout' );


/*------------------------------------------------------------- 
		PRICING TABLE SHORTCODE
-------------------------------------------------------------*/

function shortcode_pricing( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				"column" => '4',

			), $atts ) );
	$output = '<div class="pricing_table col_'.$column.'">';

	if ( !preg_match_all( "/(.?)\[(plan)\b(.*?)(?:(\/))?\](?:(.+?)\[\/plan\])?(.?)/s", $content, $matches ) ) {
		return do_shortcode( $content );
	}
	else {
		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$matches[ 3 ][ $i ] = shortcode_parse_atts( $matches[ 3 ][ $i ] );
		}

		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$popular ='';
			if ( $matches[ 3 ][ $i ][ 'popular' ] == 'true' ) {
				$popular .= 'popular';
			}
			$output .= '<div class="plan '.$popular.'">';
			$output .= '<div style="background-color:'.$matches[ 3 ][ $i ][ 'skin' ].'" class="heading">';
			$output .= '<div class="name">'.$matches[ 3 ][ $i ][ 'name' ].'</div>';
			$output .= '<div class="price">'.$matches[ 3 ][ $i ][ 'price' ].'</div>';
			$output .= '<div class="per">'.$matches[ 3 ][ $i ][ 'per' ].'</div>';
			$output .= '</div>';
			$output .= '<div class="list">'.do_shortcode( trim( $matches[ 5 ][ $i ] ) );
			$output .= '<div class="pricing_button"><a';
			if ( $matches[ 3 ][ $i ][ 'popular' ] == 'true' ) {
				$output .= ' style="background-color:'.$matches[ 3 ][ $i ][ 'skin' ].' !important"';
			}
			$output .= ' href="' . $matches[ 3 ][ $i ][ 'url' ] . '">' . $matches[ 3 ][ $i ][ 'button_text' ] . '</a></div>';

			$output .= '</div></div>';
		}

	}
	$output .= '<div class="clearboth"></div></div><div class="clearboth"></div>';

	return $output;


}


add_shortcode( 'pricing', 'shortcode_pricing' );

/*------------------------------------------------------------- 
		TABLES SHORTCODE
-------------------------------------------------------------*/


function shortcode_table( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'id' => false,
			), $atts ) );
	return '<div' . ( $id ? 'id="' . $id . '"' : '' ) . ' class="table animated fadeInUp">' . do_shortcode( trim( $content ) ) . '</div>';
}
add_shortcode( 'table', 'shortcode_table' );



/*------------------------------------------------------------- 
		TABS SHORTCODE
-------------------------------------------------------------*/

function shortcode_tabs( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				"style" => false

			), $atts ) );
	if ( !preg_match_all( "/(.?)\[(tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/tab\])?(.?)/s", $content, $matches ) ) {
		return do_shortcode( $content );
	}
	else {
		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$matches[ 3 ][ $i ] = shortcode_parse_atts( $matches[ 3 ][ $i ] );
		}
		$output = '<ul class="tabs">';

		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$output .= '<li><a href="#">' . $matches[ 3 ][ $i ][ 'title' ] . '</a></li>';
		}
		$output .= '</ul><div class="clearboth"></div>';
		$output .= '<div class="panes">';
		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$output .= '<div class="pane animated fadeInUp">' . do_shortcode( trim( $matches[ 5 ][ $i ] ) ) . '</div>';
		}
		$output .= '</div>';

		return '<div class="tabs_container  ' . $style . '">' . $output . '</div>';
	}
}
add_shortcode( 'tabs', 'shortcode_tabs' );



/*------------------------------------------------------------- 
		Vertical TABS SHORTCODE
-------------------------------------------------------------*/

function shortcode_vertical_tabs( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(


			), $atts ) );

	if ( !preg_match_all( "/(.?)\[(vertical_tab)\b(.*?)(?:(\/))?\](?:(.+?)\[\/vertical_tab\])?(.?)/s", $content, $matches ) ) {
		return do_shortcode( $content );
	}
	else {
		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$matches[ 3 ][ $i ] = shortcode_parse_atts( $matches[ 3 ][ $i ] );
		}
		$output = '<ul class="vertical_tabs">';

		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$output .= '<li><a href="#"><img src="' . $matches[ 3 ][ $i ][ 'icon' ] . '" alt="' . $matches[ 3 ][ $i ][ 'title' ] . '" title="' . $matches[ 3 ][ $i ][ 'title' ] . '" /><span class="vertical_tab_title">' . $matches[ 3 ][ $i ][ 'title' ] . '</span></a></li>';
		}
		$output .= '</ul>';
		$output .= '<div class="vertical_panes">';
		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$output .= '<div class="vertical_pane animated fadeInUp">' . do_shortcode( trim( $matches[ 5 ][ $i ] ) ) . '</div>';
		}
		$output .= '</div>';

		return '<div class="vertical_tabs_container ">' . $output . '</div><div class="clearboth"></div>';
	}
}
add_shortcode( 'vertical_tabs', 'shortcode_vertical_tabs' );


/*------------------------------------------------------------- 
		ACCORDION SHORTCODE
-------------------------------------------------------------*/
function shortcode_accordions( $atts, $content = null, $code ) {


	if ( !preg_match_all( "/(.?)\[(accordion)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion\])?(.?)/s", $content, $matches ) ) {
		return do_shortcode( $content );
	}
	else {
		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$matches[ 3 ][ $i ] = shortcode_parse_atts( $matches[ 3 ][ $i ] );
		}
		$output = '';
		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$output .= '<div class="tab">' . $matches[ 3 ][ $i ][ 'title' ] . '</div>';
			$output .= '<div class="pane animated fadeInUp">';

			$output .= do_shortcode( trim( $matches[ 5 ][ $i ] ) ) . '</div>';
		}

		return '<div class="accordion">' . $output . '</div><div class="clearboth"></div>';
	}
}
add_shortcode( 'accordions', 'shortcode_accordions' );


/*------------------------------------------------------------- 
		TOGGLE SHORTCODE
-------------------------------------------------------------*/
function shortcode_toggle( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'title' => false,
			), $atts ) );


	$output = '<div class="toggle"><p class="toggle_title">' . $title . '</p><div class="toggle_content animated fadeInUp">';

	$output .= do_shortcode( trim( $content ) ) . '</div></div><div class="clearboth"></div>';

	return $output;
}
add_shortcode( 'toggle', 'shortcode_toggle' );


/*------------------------------------------------------------- 
		DROPCAPS SHORTCODE
-------------------------------------------------------------*/
function theme_shortcode_dropcaps( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'style' => 'fancy',
			), $atts ) );


	return '<span class="dropcaps '.$style.'" >' . do_shortcode( $content ) . '</span>';
}
add_shortcode( 'dropcaps', 'theme_shortcode_dropcaps' );





/*------------------------------------------------------------- 
		BLOCKQUOTE SHORTCODE
-------------------------------------------------------------*/
function theme_shortcode_blockquote( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'cite' => false,
				'style' => false,
				'frame' => false,
				'align' => 'false'
			), $atts ) );
	if ( $frame == 'true' ) {
		$frame = 'frame';
	} //$frame == 'true'
	return '<blockquote class="' . $style . ' ' . $frame . ' align' . $align . '">' . do_shortcode( $content ) . ( $cite ? '<p><cite>- ' . $cite . '</cite></p>' : '' ) . '</blockquote>';
}
add_shortcode( 'blockquote', 'theme_shortcode_blockquote' );



/*------------------------------------------------------------- 
		HIGHLIGHT SHORTCODE
-------------------------------------------------------------*/
function theme_shortcode_highlight( $atts, $content = null, $code ) {

	return '<span class="highlight">' . do_shortcode( $content ) . '</span>';
}
add_shortcode( 'highlight', 'theme_shortcode_highlight' );


/*------------------------------------------------------------- 
		LIST SHORTCODE
-------------------------------------------------------------*/
function theme_shortcode_list( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'style' => false,
				'color' => ''
			), $atts ) );

	$color = $color ? $color : theme_option( THEME_OPTIONS, 'scheme_main_color' );
	$content = str_replace( '<ul>', '<ul style="list-style:none">', do_shortcode( $content ) );
	return str_replace( '<li>', '<li><i class="icon-fixed-width font-list-icon icon-'.$style.'" style="color:'.$color.'"></i>', do_shortcode( $content ) );
}
add_shortcode( 'list', 'theme_shortcode_list' );


/*------------------------------------------------------------- 
		ICON LIST SHORTCODE
-------------------------------------------------------------*/
function theme_shortcode_icon_list( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'style' => false,
				'color' => ''
			), $atts ) );

	$color = $color ? $color : theme_option( THEME_OPTIONS, 'scheme_main_color' );
	return '<span> <i class=" icon_list icon-fixed-width icon-'.$style.'" style="color:'.$color.'"></i>' . do_shortcode( $content ) . '</span>';
}
add_shortcode( 'icon_list', 'theme_shortcode_icon_list' );





/*------------------------------------------------------------- 
		ICON LINK SHORTCODE
-------------------------------------------------------------*/

function theme_shortcode_icon_link( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'style' => false,
				'href' => '#',
				'link_target' => '_self',
				'color' => ''
			), $atts ) );


	$color = $color ? $color : theme_option( THEME_OPTIONS, 'scheme_main_color' );

	return '<a target="'.$link_target.'" href="' . $href . '"><i class=" icon_list icon-fixed-width icon-'.$style.'" style="color:'.$color.'"></i>' . do_shortcode( $content ) . '</a>';
}
add_shortcode( 'icon_link', 'theme_shortcode_icon_link' );

/*------------------------------------------------------------- 
		ICON BOX SHORTCODES
-------------------------------------------------------------*/

function theme_shortcode_icon_box( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'style' => "ancher",
				'title' => "",
				'href' => '#',
				'button_label' =>'Read More',
				'link_target' => '_self',
				'color' => ""
			), $atts ) );

	$color = $color ? $color : theme_option( THEME_OPTIONS, 'scheme_main_color' );
	
	return'<div class="animate-fadeIn"> <div class="one_fifth"><i class="icon-3x icon-'.$style.'" style="color:'.$color.'"></i></div><div class="four_fifth last"><h5 style="color:'.$color.'; padding:10px 10px 10px 0;">'.$title.'</h5></div><div class="clearboth"></div>'. do_shortcode( $content ) .'</p><p class="alignright"><a href="'.$href.'" target="'.$link_target.'" style="background-color:'.$color.'" class="ws-button icon-box-button small" '.$style.'><span>'.$button_label.'</span></a></p></div>';
	
}

add_shortcode( 'icon_box', 'theme_shortcode_icon_box' );







/*------------------------------------------------------------- 
		VIDEO SHORTCODES
-------------------------------------------------------------*/

function theme_shortcode_video( $atts ) {
	if ( isset( $atts[ 'type' ] ) ) {
		switch ( $atts[ 'type' ] ) {

		case 'youtube':
			return theme_video_youtube( $atts );
			break;
		case 'vimeo':
			return theme_video_vimeo( $atts );
			break;

		} //$atts[ 'type' ]
	} //isset( $atts[ 'type' ] )
	return '';
}



function theme_video_youtube( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'clip_id' => '',
				'width' => false,
				'height' => false
			), $atts ) );

	if ( $height && !$width )
		$width = intval( $height * 16 / 9 );
	if ( !$height && $width )
		$height = intval( $width * 9 / 16 );

	if ( !empty( $clip_id ) ) {
		return "<div class='video_frame video-container'><iframe src='http://www.youtube.com/embed/$clip_id?rel=0&showinfo=0' width='$width' height='$height' frameborder='0'></iframe></div>";
	}
}


function theme_video_vimeo( $atts ) {
	extract( shortcode_atts( array(
				'clip_id' => '',
				'width' => false,
				'height' => false
			), $atts ) );

	if ( $height && !$width )
		$width = intval( $height * 16 / 9 );
	if ( !$height && $width )
		$height = intval( $width * 9 / 16 );

	$scheme_main_color =  str_replace( "#", "", theme_option( THEME_OPTIONS, 'scheme_main_color' ) );

	if ( !empty( $clip_id ) && is_numeric( $clip_id ) ) {
		return "<div class='video_frame video-container'><iframe src='http://player.vimeo.com/video/$clip_id?title=0&amp;byline=0&amp;portrait=0&amp;color=$scheme_main_color' width='$width' height='$height' frameborder='0'></iframe></div>";
	}
}
add_shortcode( 'video', 'theme_shortcode_video' );



/*------------------------------------------------------------- 
		BLOG SHORTCODE
-------------------------------------------------------------*/

function theme_shortcode_blog( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'count' => 5,
				'column' => 2,
				'layout' => 'sidebar',
				'parent_container' => 1,
				'offset' => 0,
				'cat' => '',
				'posts' => '',
				'image_height' => '300',
				'featured_image' => 'true',
				'title' => 'true',
				'excerpt' => 'true',
				'meta'=>'true',
				'more_button' => 'true',
				'button_size' => 'medium',
				'button_align'=> 'aligncenter',
				'pagination' => 'false',
				'orderby'=> 'date',
				'order'=> 'DESC'

			), $atts ) );

	switch ( $column ) {
	case 1:
		$column_class = 'one_column';
		if ( $layout=='sidebar' ) {
			$image_width = '640';
		}else {
			$image_width = '960';
		}
		break;
	case 2:
		$column_class = 'two_column';
		if ( $layout=='sidebar' ) {
			$image_width = '305';
		}else {
			$image_width = '460';
		}
		break;
	case 3:
		$column_class = 'three_column';
		if ( $layout=='sidebar' ) {
			$image_width = '195';
		}else {
			$image_width = '294';
		}
		break;
	case 4:
		$column_class = 'four_column';
	default:
		if ( $layout=='sidebar' ) {
			$image_width = '140';
		}else {
			$image_width = '210';
		}
	}


// get the real width of the image

	switch ( $parent_container ) {
	case 'full':
		$parent_width = 1;
		break;
	case 'one_half':
		$parent_width = 1/2;
		break;
	case 'one_third':
		$parent_width = 1/3;
		break;
	case 'two_third':
		$parent_width = 2/3;
		break;
	case 'one_fourth':
		$parent_width = 1/4;
		break;
	case 'three_fourth':
		$parent_width = 3/4;
		break;
	case 'one_fifth':
		$parent_width = 1/5;
		break;
	case 'two_fifth':
		$parent_width = 2/5;
		break;
	case 'three_fifth':
		$parent_width = 3/5;
		break;
	case 'four_fifth':
		$parent_width = 4/5;
		break;
	default:
		$parent_width = 1;
		break;
	}



	$image_width=$image_width*$parent_width;



	$query = array(
		'posts_per_page' => (int)$count,
		'post_type'=>'post',
	);
	if ( $offset ) {
		$query['offset'] = $offset;
	}
	if ( $cat ) {
		$query['cat'] = $cat;
	}
	if ( $posts ) {
		$query['post__in'] = explode( ',', $posts );
	}
	if ( $orderby ) {
		$query['orderby'] = $orderby;
	}
	if ( $order ) {
		$query['order'] = $order;
	}

	global $wp_version;
		if((is_front_page() || is_home() ) && version_compare($wp_version, "3.1", '>=')){//fix wordpress 3.1 paged query 
			$paged = (get_query_var('paged')) ?get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
		}else{
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		$query['paged'] = $paged;

	$r = new WP_Query( $query );

	$column = (int)$column;
	if ( $column > 4 ) {
		$column = 4;
	}elseif ( $column < 1 ) {
		$column = 1;
	}

	$atts = array(
		'column_class' => $column_class,
		'column' => $column,
		'title' => $title,
		'meta' => $meta,
		'excerpt' => $excerpt,
		'more_button' => $more_button,
		'featured_image' => $featured_image,
		'button_size' => $button_size,
		'button_align' => $button_align,
		'image_width' => $image_width,
		'image_height' => $image_height,
		'posts_per_page' => (int)$count,
		'pagination' => $pagination
	);

	$output = '';
	$output .= theme_column_posts( $r, $atts, 1 );


	if ( $pagination == 'true' ) {
		ob_start();
		theme_blog_pagenavi( '', '', $r, $paged );
		$output .= ob_get_clean();
	}

	wp_reset_postdata();

	return $output;
}
add_shortcode( 'blog', 'theme_shortcode_blog' );


//========================================================================


function theme_column_posts( &$r, $atts, $current ) {
	global $post;
	extract( $atts );
	$class = array( 'half', 'third', 'fourth' );
	if ( $column_class !== 'one_column' ) {
		$css = $class[$column-2];
	}

 
	$output = '';
	$output .= '<section class="shortcode_blog '.$column_class.' blog">';
	$i = 0;

	if ( $r->have_posts() ):
		while ( $r->have_posts() ) :
			$i++;

		$r->the_post();

	$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
	$post_type = get_post_meta( $post->ID, '_single_post_type', true );




	//$image_src = TIMTHUMB . '?src=' . get_image_src( $image_src_array[ 0 ] ) . '&amp;h=' . $image_height . '&amp;w=' . $image_width . '&amp;zc=1&amp;q=100';
	$enable_image_cropping = theme_option(THEME_OPTIONS,'disable_image_cropping') === 'true'? true: false;
	$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images') === 'true'? true: false;	
	$image_src  = theme_img_resize( $image_src_array[ 0 ], $image_width, $image_height , $enable_image_cropping, $enable_retina_images );

	if ( $column != 1 ) {
		if ( $i%$column !== 0 ) {
			$output .= "<div class=\"one_{$css}\">";
		} else {
			$output .= "<div class=\"one_{$css} last\">";
		}
	}


	$output .= '<article id="post-'. get_the_ID() .'">';
	if ( $post_type == 'image' || $post_type == '' ) {
		if ( $featured_image == "true" ) {
			if ( has_post_thumbnail() ):
				$output .= '<div class="image_container">';
			$output .= '<span class="image_frame">';
			$output .= '<a class="hover_effect" href="'. get_permalink().'" title="'. get_the_title().'">';
			$output .= '<img src="'. get_image_src($image_src['url']) .'" alt="'. get_the_title().'" />';
			$output .= '<span class="hyperlink_icon hover_icon" style="left:' .(($image_width/2)-25) . 'px;"></span><span class="image_overlay"></span>';
			$output .= '</a>';
			$output .= '</span>';
			$output .= '</div>';
			endif;
		}
	} elseif ( $post_type == 'video' ) {
		$scheme_main_color = theme_option( THEME_OPTIONS, 'scheme_main_color' );
		$video_id = get_post_meta( $post->ID, '_single_video_id', true );
		$video_site  = get_post_meta( $post->ID, '_single_video_site', true );

		if ( $video_site =='' ) {
			$video_site =='vimeo';

		}


		if ( $video_site =='vimeo' ) {
			$output .='<div style="width:'.$image_width.'px;" class="video-wrapper blog_video_type "><div class="video-container"><iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color='.str_replace( "#", "", $scheme_main_color ).'" width="'.$image_width.'" height="'.$image_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';
		}


		if ( $video_site =='youtube' ) {
			$output .='<div style="width:'.$image_width.'px;" class="video-wrapper blog_video_type"><div class="video-container"><iframe src="http://www.youtube.com/embed/'.$video_id.'" frameborder="0" width="'.$image_width.'" height="'.$image_height.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div></div>';


		}
	}

	$output .= '<div >';
	
	if ( $title == "true" ) {
		$output .= '<h1 class="shortcode_blog_title"><a href="'. get_permalink().'" rel="bookmark" title="'. __( "Permanent Link to" , 'theme_frontend' ) . get_the_title()  .'">'. get_the_title().' </a></h1>';
	}


	$num_comments = get_comments_number(); // get_comments_number returns only a numeric value

	if ( comments_open() ) {
		if ( $num_comments == 0 ) {
			$comments = __("No Response","theme_frontend");
		} elseif ( $num_comments > 1 ) {
			$comments = $num_comments . __(" Responses","theme_frontend");
		} else {
			$comments =  __("1 Response","theme_frontend");
		}
		$write_comments = '<a href="' . get_comments_link() .'">'. $comments.'</a>';
	} else {
		$write_comments =   __("Comments are off for this post.","theme_frontend");
	}


	if ( $meta == "true" ) {	
		 $n= 4-$column;
		$output .= '<div class="blog_meta">';
		if($n>=0) $output .= '<span class="blog_date"><i class="icon-calendar icon-fixed-width ws-icon-theme-scheme"></i><a href="' . get_month_link(get_the_time("Y"), get_the_time("m")).'" >'. get_the_time("Y/m/d") . '</a></span>';
		if($n>=1) $output .= '<span class="blog_comment comment_scroll"><i class="icon-comment icon-fixed-width ws-icon-theme-scheme"></i>'.$write_comments.'</span>';
		if($n>=3) $output .= '<span class="blog_author"><i class="icon-user icon-fixed-width ws-icon-theme-scheme"></i>'. get_the_author(). '</span>';
		if($n>=3) $output .= '<span class="blog_permalink"><i class="icon-link icon-fixed-width ws-icon-theme-scheme"></i><a href="'. get_permalink(). '">' . __("Permalink","theme_frontend") . '</a></span>';
		
		$tags = get_the_tags();
		if(!empty($tags)){
			if($n>=3) $output .= '<span class="blog_tags"><i class="icon-tags ws-icon-theme-scheme"></i>'. get_the_tag_list('',', ','') . '</span>';
		}

		$output .='<div class="clearboth"></div></div>';
	}


	if ( $excerpt == "true" ) {
		$output .= '<div class="blog_excerpt"><p>'. get_the_excerpt() .'</p></div>';
	}
	
	if ( $more_button == "true" ) {
		$output .= '<div class="more-button '.$button_align.'"><a href="'. get_permalink() .'" class="ws-button '.$button_size.' scheme_background_color"><span>';
		$output .= __( 'Read More', 'theme_frontend' );
		$output .= '</span></a></div>';
	}
	$output .= '</div>';
	$output .= '</article>';



	if ( $column != 1 ) {
		$output .= '</div>';
		if ( $i%$column === 0 ) {
			$output .= "<div class=\"clearboth\"></div>";
		}
	}
	endwhile;
	endif;
	$output .= '</section>';

	return $output;
}


//========================================================================



function theme_blog_pagenavi($before = '', $after = '', $blog_query, $paged) {
	global $wpdb, $wp_query;
	
	if (is_single())
		return;
	
	$pagenavi_options = array(
		'pages_text' => '',
		'current_text' => '%PAGE_NUMBER%',
		'page_text' => '%PAGE_NUMBER%',
		'first_text' => __('&laquo; First','theme_frontend'),
		'last_text' => __('Last &raquo;','theme_frontend'),
		'next_text' => __('&raquo;','theme_frontend'),
		'prev_text' => __('&laquo;','theme_frontend'),
		'dotright_text' => __('...','theme_frontend'),
		'dotleft_text' => __('...','theme_frontend'),
		'style' => 1,
		'num_pages' => 4,
		'always_show' => 0,
		'num_larger_page_numbers' => 3,
		'larger_page_numbers_multiple' => 10,
		'use_pagenavi_css' => 0,
	);
	
	$request = $blog_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	global $wp_version;
	if((is_front_page() || is_home() ) && version_compare($wp_version, "3.1", '>=')){//fix wordpress 3.1 paged query 
		$paged = (get_query_var('paged')) ?intval(get_query_var('paged')) : intval(get_query_var('page'));
	}else{
		$paged = intval(get_query_var('paged'));
	}
	
	$numposts = $blog_query->found_posts;
	$max_page = intval($blog_query->max_num_pages);
	
	if (empty($paged) || $paged == 0)
		$paged = 1;
	$pages_to_show = intval($pagenavi_options['num_pages']);
	$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor($pages_to_show_minus_1 / 2);
	$half_page_end = ceil($pages_to_show_minus_1 / 2);
	$start_page = $paged - $half_page_start;
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$end_page = $paged + $half_page_end;
	if (($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	
	if ($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$larger_pages_array = array();
	if ($larger_page_multiple)
		for($i = $larger_page_multiple; $i <= $max_page; $i += $larger_page_multiple)
			$larger_pages_array[] = $i;
	
	if ($max_page > 1 || intval($pagenavi_options['always_show'])) {
		$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
		$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
		echo $before . '<div class="wp-pagenavi">' . "\n";
		switch(intval($pagenavi_options['style'])){
			// Normal
			case 1:
				if (! empty($pages_text)) {
					echo '<span class="pages">' . $pages_text . '</span>';
				}
				/*if ($start_page >= 2 && $pages_to_show < $max_page) {
					$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
					echo '<a href="' . esc_url(get_pagenum_link()) . '" class="first" title="' . $first_page_text . '">' . $first_page_text . '</a>';
					if (! empty($pagenavi_options['dotleft_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotleft_text'] . '</span>';
					}
				}*/
				$larger_page_start = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page < $start_page && $larger_page_start < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_start++;
					}
				}
				previous_posts_link($pagenavi_options['prev_text']);
				for($i = $start_page; $i <= $end_page; $i++) {
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<span class="current">' . $current_page_text . '</span>';
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($i)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
					}
				}
				next_posts_link($pagenavi_options['next_text'], $max_page);
				$larger_page_end = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page > $end_page && $larger_page_end < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_end++;
					}
				}
				/*if ($end_page < $max_page) {
					if (! empty($pagenavi_options['dotright_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotright_text'] . '</span>';
					}
					$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
					echo '<a href="' . esc_url(get_pagenum_link($max_page)) . '" class="last" title="' . $last_page_text . '">' . $last_page_text . '</a>';
				}*/
				break;
			// Dropdown
			case 2:
				echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="get">' . "\n";
				echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">' . "\n";
				for($i = 1; $i <= $max_page; $i++) {
					$page_num = $i;
					if ($page_num == 1) {
						$page_num = 0;
					}
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<option value="' . esc_url(get_pagenum_link($page_num)) . '" selected="selected" class="current">' . $current_page_text . "</option>\n";
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<option value="' . esc_url(get_pagenum_link($page_num)) . '">' . $page_text . "</option>\n";
					}
				}
				echo "</select>\n";
				echo "</form>\n";
				break;
		}
		echo '</div>' . $after . "\n";
	}
}


//========================================================================






function theme_shortcode_portfolio( $atts, $content = null, $code ) {

	extract( shortcode_atts( array(
				'column' => 3,
				"sortable" => 'true',
				'pagination' => 'true',
				'random_height' => 'false',
				'disable_permalink' => 'false',
				'fixed_height' => 350,
				'gray_scale' => false,
				'cat' => '',
				'max' => 10,
				'ids' => '',
				'order'=> 'DESC',
				'orderby'=> 'date',
			), $atts ) );


	switch ( $column ) {
	case 1:
		$width = 940;
		$column_css = 'one_col';
		break;
	case 2:
		$width = 460;
		$column_css = 'two_col';
		break;
	case 3:
		$width = 300;
		$column_css = 'three_col';
		break;
	case 4:
		$width = 220;
		$column_css = 'four_col';
	}





	$rel_group = 'portfolio_'.rand( 1, 1000 );




	wp_enqueue_script( 'jquery-isotope' );
	wp_enqueue_script( 'jquery-infinitescroll' );


?>
<script type="text/javascript">

  jQuery(document).ready(function(){

	jQuery('.wp-pagenavi, #load_more_posts').hide();
	if(jQuery('.wp-pagenavi').length > 0) {
	jQuery('#load_more_posts').show();
}

      var $container = jQuery('.portfolio_container');

      $container.isotope({
        itemSelector : '.portfolio_item',
        masonryHorizontal: {rowHeight: 360}
      });

    setTimeout(function(){
        isotop_load_fix();  
 },3000);





/* reload elements on window resize */
/* -------------------------------------------------------------------- */
jQuery(window).load(function(){
    jQuery(window).unbind('keydown');
    isotop_load_fix();
    });
			var timer;
			jQuery(window).resize(function(){
			  clearTimeout(timer);
			  setTimeout( fix_portfolio_height, 100);
			})  

function isotop_load_fix(){
    jQuery('#portfolios .portfolio_item').each(function(i){
    	jQuery(this).delay(i*200).fadeIn('fast',function(){});})
    .promise()
    .done(function(){
    	setTimeout(function(){
    		$container.isotope('reLayout');
    		fix_portfolio_height()
    	},4000);

});


}


function fix_portfolio_height() {

    jQuery('#portfolios .portfolio_item img').each(function(){

    	jQuery(this).parents('.portfolio_item, .portfolio_item_wrapper').height(jQuery(this).height());
    	$container.isotope('reLayout');
    })
}



      $container.infinitescroll({
        navSelector  : '.wp-pagenavi',
        nextSelector : '.wp-pagenavi a',
        itemSelector : '.portfolio_item',
		loadingText : '',
       	finishedMsg: '<?php _e( 'No more pages to load.', 'theme_frontend' ); ?>'

        },
        function( newElements ) {
          $container.isotope( 'appended', jQuery( newElements ) );

          isotop_load_fix();
		 portfolio_hover();
		enable_lightbox(document);

        }
      );

    jQuery(window).unbind('.infscr');
    jQuery('#load_more_posts').click(function(){

      jQuery(document).trigger('retrieve.infscr');

      return false;

    });

	jQuery(document).ajaxError(function(e,xhr,opt){

      if (xhr.status == 404) jQuery('#load_more_posts').find('.text').html('<?php _e( 'No more pages to load.', 'theme_frontend' ); ?>').end().css({opacity : 0.5, cursor: 'default'}).delay(2000).fadeOut();

    });
    });

</script>
<?php




	global $wp_version;
	if ( is_front_page() && version_compare( $wp_version, "3.1", '>=' ) ) {
		$paged = ( get_query_var( 'paged' ) ) ?get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
	}else {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	}
	$output = '<section id="portfolios" class="'.$column_css.' portfolios_simple_ver">';
	if ( $sortable == 'true' ) {
		$output .= '<header class="filter_portfolio">';
		$output .= '<a class="current" data-filter="*" href="#">'.__( 'All', 'theme_frontend' ).'</a>';
		$terms = array();
		if ( $cat != '' ) {
			foreach ( explode( ',', $cat ) as $term_slug ) {
				$terms[] = get_term_by( 'slug', $term_slug, 'portfolio_category' );
			}
		} else {
			$terms = get_terms( 'portfolio_category', 'hide_empty=1' );
		}
		foreach ( $terms as $term ) {
			$output .= '<a data-filter="' . '.'.$term->slug . '" href="#">' . $term->name . '</a>';
		}





		$output .= '</header>';
		$output .= '<div class="clearboth"></div>';
	}
	$output .= '<div class="portfolio_container">';


	$query = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $max,
		'orderby'=> $orderby,
		'order'=> $order,
		'paged' => $paged
	);

	if ( $cat != '' ) {
		global $wp_version;
		if ( version_compare( $wp_version, "3.1", '>=' ) ) {
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'slug',
					'terms' => explode( ',', $cat )
				)
			);
		}else {
			$query['taxonomy'] = 'portfolio_category';
			$query['term'] = $cat;
		}
	}


	if ( $ids ) {
		$query['post__in'] = explode( ',', $ids );
	}
	$r = new WP_Query( $query );
	$i = 1;

	while ( $r->have_posts() ) {
		$r->the_post();
		$terms = get_the_terms( get_the_id(), 'portfolio_category' );
		$terms_slug = array();
		$terms_name = array();
		if ( is_array( $terms ) ) {
			foreach ( $terms as $term ) {
				$terms_slug[] = $term->slug;
				$terms_name[] = $term->name;
			}
		}

		if ( $random_height=='false' ) {
			$height = $fixed_height;
		} else {

			if ( get_post_meta( get_the_ID(), '_portfolio_image_manual_height', true ) == 0 ) {
				$height = get_post_meta( get_the_ID(), '_random_image_height', true );
			} else {
				$height = get_post_meta( get_the_ID(), '_portfolio_image_manual_height', true );

			}

		}

		$output .= '<div class="portfolio_item ' . implode( ' ', $terms_slug ) . '" style="width:' . $width . 'px; height: '. $height .'px" data-id="'.get_the_id().'">';
		$i++;

		$image_id = get_post_thumbnail_id( get_the_id() );
		$image = wp_get_attachment_image_src( $image_id, 'full', true );
		if ( get_post_meta( get_the_ID(), '_portfolio_video', true ) =='' ) {
			$lightbox_href = get_image_src( $image[0] );
			$enable_video = 'false';
			$video_class ='';
		} else {

			$lightbox_href = get_post_meta( get_the_ID(), '_portfolio_video', true );
			$enable_video = 'true';
			$video_class = 'video_';

		}

		if ( $disable_permalink == 'true' ) {
			$lightbox_output = ' rel="'.$rel_group.'" data-video="'.$enable_video.'" class="lightbox_link '.$video_class.'lightbox portfolio_item_details" ';
			$lightbox_permalink = ' href="'. $lightbox_href .'" ';
			$icon_lightbox = '';
			$disbaled_class = '';
		} else {
			$lightbox_permalink = ' href="' . get_permalink() . '" ';
			$lightbox_output ='';
			$disbaled_class = 'class="portfolio_item_details"';
			$icon_lightbox = '<a title="'.get_the_title().'" rel="'.$rel_group.'" style="position:absolute;overflow:hidden;" data-video="'.$enable_video.'" class="lightbox_link '.$video_class.'lightbox" href="'. $lightbox_href .'"><span class="hover_icon zoom_icon"></span></a>';
		}

		$gray_scale_calss = '';
		if ( $gray_scale == 'true' ) {

			$gray_scale_calss = 'grascale_enabled';
		}

		$enable_image_cropping = theme_option(THEME_OPTIONS,'disable_image_cropping') === 'true'? true: false;
		$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images') === 'true'? true: false;	
		
		$image_src  = theme_img_resize( get_image_src( $image[0] ), $width, $height, $enable_image_cropping, false);

		$output .= '<div class="portfolio_item_wrapper '.$gray_scale_calss.'" style="width:' . $width . 'px; height: '. $height .'px">';
		$output .= '<span class="portfolio_overlay"></span>';
		$output .= '<img src="' . get_image_src($image_src['url']) . '" title="' . get_the_title() . '" alt="' . get_the_title() . '" />';
		$output .= '<a '.$disbaled_class.' title="'. get_the_title() .'" '.$lightbox_permalink. $lightbox_output .'>';
		$output .= '<h2 class="portfolio_title">' . get_the_title() . '</h2>';
		$output .= '[raw]' .'<span class="portfolio_item_category">' . implode( ',', $terms_name ) . '</span>' . '[/raw]';
		$output .= '<span class="hover_icon hyperlink_icon"></span></a>'.$icon_lightbox;
		$output .= '</div>';

		$output .= '</div>';
	}
	$output .= '</div><div class="clearboth"></div>';
	$output .= '</section>';


	if ( $pagination == 'true' ) {
		$output .= '[raw]<div id="load_more_posts" style="text-align:center;"><i class="icon-plus"></i><span class="text">'.__( 'Load More', 'theme_frontend' ).'</span><div id="infscr-loading"></div></div>[/raw]';
		ob_start();
		theme_portfolio_pagenavi( '', '', $r, $paged );
		$output .= ob_get_clean();
	}
	wp_reset_postdata();
	return $output;

}
add_shortcode( 'portfolio', 'theme_shortcode_portfolio' );





//========================================================================


function theme_shortcode_portfolio_newspaper( $atts, $content = null, $code ) {

	extract( shortcode_atts( array(
				'column' => 3,
				"sortable" => 'true',
				'pagination' => 'true',
				'random_height' => 'false',
				'fixed_height' => 350,
				'cat' => '',
				'max' => 10,
				'ids' => '',
				'order'=> 'DESC',
				'orderby'=> 'date',
			), $atts ) );


	switch ( $column ) {
	case 1:
		$width = 948;
		$column_css = 'one_col';
		break;
	case 2:
		$width = 450;
		$column_css = 'two_col';
		break;
	case 3:
		$width = 295;
		$column_css = 'three_col';
	}



	wp_enqueue_script( 'jquery-isotope' );
	wp_enqueue_script( 'jquery-infinitescroll' );


?>
<script type="text/javascript">
jQuery("#portfolios").hide();
  jQuery(document).ready(function(){
  	jQuery("#portfolios").show();
	

is_portfolio_one_column = jQuery('#portfolios').hasClass('one_col') ? true : false;

	jQuery('.wp-pagenavi, #load_more_posts').hide();

	if(jQuery('.wp-pagenavi').length > 0) {
	jQuery('#load_more_posts').show();

		}
      var $container = jQuery('.portfolio_container');
    portfolio_newspaper_hover();

      $container.isotope({
        itemSelector : '.portfolio_item'
      });
      $container.infinitescroll({
        navSelector  : '.wp-pagenavi',
        nextSelector : '.wp-pagenavi a',
        itemSelector : '.portfolio_item',
		loadingText : '',
       	finishedMsg: '<?php _e( 'No more pages to load.', 'theme_frontend' ); ?>'

        },
        function( newElements ) {
        $container.isotope( 'appended', jQuery( newElements ) );
		portfolio_newspaper_hover();
		smaller_width_adjuster();
		get_portfolio_item_height();

        }
      );

    jQuery(window).unbind('.infscr');
    jQuery('#load_more_posts').click(function(){

      jQuery(document).trigger('retrieve.infscr');

      return false;

    });

	jQuery(document).ajaxError(function(e,xhr,opt){

      if (xhr.status == 404) jQuery('#load_more_posts').find('.text').html('<?php _e( 'No more pages to load.', 'theme_frontend' ); ?>').end().css({opacity : 0.5, cursor: 'default'}).delay(2000).fadeOut();

    });

		smaller_width_adjuster();
		var newspaper_timer;
			jQuery(window).resize(function(){
			  clearTimeout(newspaper_timer);
			  setTimeout( smaller_width_adjuster, 100);
			  $container.isotope('reLayout');
		})  



    });




function smaller_width_adjuster(){
	if(jQuery(window).width() < 600 && is_portfolio_one_column == false) {
	container_width = jQuery('#portfolios .portfolio_container').width();
  	jQuery('.portfolio_newspaper_image').each(function() {
  		jQuery(this).width(container_width - 10).parents('.portfolio_item_wrapper_newspaper, .portfolio_item.newspaper_style').width(container_width - 10);
  		jQuery(this).height(jQuery(this).find('img').height());

  	})
  } else if(is_portfolio_one_column){
  
		container_width = jQuery('#portfolios .portfolio_container').width();
	  	jQuery('.portfolio_newspaper_image').each(function() {
	  		jQuery(this).width(container_width - 10).parents('.portfolio_item_wrapper_newspaper, .portfolio_item.newspaper_style').width(container_width - 10);
	  		jQuery(this).height(jQuery(this).find('img').height());
})
  }
}

 function get_portfolio_item_height() {

jQuery('.portfolio_item_wrapper_newspaper').each(function() {
var portfolio_item_height = jQuery(this).height();
jQuery(this).css('height', portfolio_item_height);

})
}


function portfolio_newspaper_hover() {
	jQuery('.portfolio_newspaper_image').hover(function(){
					jQuery(".portfolio_overlay_newspaper",this).stop(true, false).animate({
							opacity: 1
						},"slow");
						jQuery(".portfolio_zoom_icon_newspaper", this).stop(true, false).animate({
										'bottom' : 0, 'opacity' : 1}, '400');

						jQuery(".portfolio_arrow_icon_newspaper", this).stop(true, false).animate({
										'bottom' : 0,  'opacity' : 1}, '400');

					},function(){
						jQuery(".portfolio_zoom_icon_newspaper", this).stop(true, true).animate({
										'bottom' : -55,  'opacity' : 0}, '100');

						jQuery(".portfolio_arrow_icon_newspaper", this).stop(true, true).animate({
										'bottom' : -55,  'opacity' : 0}, '100');
						jQuery(".portfolio_overlay_newspaper",this).stop(true, true).animate({
							opacity: '0'
						},"slow");
					})


	}









</script>
<?php
	$rel_group = 'portfolio_'.rand( 1, 1000 );
	global $wp_version;
	if ( is_front_page() && version_compare( $wp_version, "3.1", '>=' ) ) {
		$paged = ( get_query_var( 'paged' ) ) ?get_query_var( 'paged' ) : ( ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1 );
	}else {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	}
	$output = '<section id="portfolios" class="'.$column_css.'">';
	if ( $sortable == 'true' ) {
		$output .= '<header class="filter_portfolio">';
		$output .= '<a class="current" data-filter="*" href="#">'.__( 'All', 'theme_frontend' ).'</a>';
		$terms = array();
		if ( $cat != '' ) {
			foreach ( explode( ',', $cat ) as $term_slug ) {
				$terms[] = get_term_by( 'slug', $term_slug, 'portfolio_category' );
			}
		} else {
			$terms = get_terms( 'portfolio_category', 'hide_empty=1' );
		}
		foreach ( $terms as $term ) {
			$output .= '<a data-filter="' . '.'.$term->slug . '" href="#">' . $term->name . '</a>';
		}

		$output .= '</header>';
		$output .= '<div class="clearboth"></div>';
	}
	$output .= '<div class="portfolio_container">';


	$query = array(
		'post_type' => 'portfolio',
		'posts_per_page' => $max,
		'orderby'=> $orderby,
		'order'=> $order,
		'paged' => $paged
	);

	if ( $cat != '' ) {
		global $wp_version;
		if ( version_compare( $wp_version, "3.1", '>=' ) ) {
			$query['tax_query'] = array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'slug',
					'terms' => explode( ',', $cat )
				)
			);
		}else {
			$query['taxonomy'] = 'portfolio_category';
			$query['term'] = $cat;
		}
	}


	if ( $ids ) {
		$query['post__in'] = explode( ',', $ids );
	}
	$r = new WP_Query( $query );
	$i = 1;

	while ( $r->have_posts() ) {
		$r->the_post();
		$terms = get_the_terms( get_the_id(), 'portfolio_category' );
		$terms_slug = array();
		$terms_name = array();
		if ( is_array( $terms ) ) {
			foreach ( $terms as $term ) {
				$terms_slug[] = $term->slug;
				$terms_name[] = $term->name;
			}
		}

		if ( $random_height=='false' ) {
			$height = $fixed_height;
		} else {

			if ( get_post_meta( get_the_ID(), '_portfolio_image_manual_height', true ) == 0 ) {
				$height = get_post_meta( get_the_ID(), '_random_image_height', true );
			} else {
				$height = get_post_meta( get_the_ID(), '_portfolio_image_manual_height', true );

			}

		}

		$output .= '<div class="portfolio_item newspaper_style ' . implode( ' ', $terms_slug ) . '" style="width:' . $width . 'px; " data-id="'.get_the_id().'">';
		$i++;

		$image_id = get_post_thumbnail_id( get_the_id() );
		$image = wp_get_attachment_image_src( $image_id, 'full', true );

		if ( get_post_meta( get_the_ID(), '_portfolio_video', true ) =='' ) {
			$lightbox_href = get_image_src( $image[0] );
			$enable_video = 'false';
			$video_class ='';
		} else {

			$lightbox_href = get_post_meta( get_the_ID(), '_portfolio_video', true );
			$enable_video = 'true';
			$video_class = 'video_';

		}

		$enable_image_cropping = theme_option(THEME_OPTIONS,'disable_image_cropping') === 'true'? true: false;
		//$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images') === 'true'? true: false;	
		$image_src  = theme_img_resize( get_image_src( $image[0] ), $width, $height, $enable_image_cropping, false );

		$output .= '<div class="portfolio_item_wrapper_newspaper" style="width:' . $width . 'px;">';
		$output .= '<div class="portfolio_newspaper_image" style="width:' . $width . 'px; height:' . $height . 'px" title="'. get_the_title() .'">';
		$output .= '<span class="portfolio_overlay_newspaper">';
		$output .= '<a href="' . get_permalink() . '" class="portfolio_arrow_icon_newspaper" ></a>';
		$output .= '<a rel="'.$rel_group.'" href="'.$lightbox_href.'" data-video="'.$enable_video.'" title="'. get_the_title() .'" class="portfolio_zoom_icon_newspaper '.$video_class.'lightbox" ></a></span>';
		$output .= '<img height="' . $height . '" width="' . $width . '" src="' . get_image_src($image_src['url']) . '" title="' . get_the_title() . '" alt="' . get_the_title() . '" />';
		$output .= '</div>';

		$output .= '<h2 class="portfolio_title_newspaper"><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
		$output .= ( get_the_excerpt() ? '<div class="portfolio_desc_newspaper">' . get_the_excerpt() . '</div>' : '' );
		$output .= '<div class="portfolio_meta_newspaper">';
		$output .= '<span class="portfolio_category_newspaper">' . implode( ',', $terms_name ) . '</span>';
		$output .= '<time class="portfolio_date_newspaper" datetime="' . get_the_time( 'Y-m-d' ) . '">';
		ob_start();
		wp_days_ago();
		$output .= ob_get_clean();

		$output .=  '</time>';
		$output .= '<div class="clearboth"></div></div>';

		$output .= '</div></div>';
	}
	$output .= '</div><div class="clearboth"></div>';
	$output .= '</section>';


	if ( $pagination == 'true' ) {
		$output .= '<div id="load_more_posts" style="text-align:center;"><i class="icon-plus"></i><span class="text">'.__( 'Load More', 'theme_frontend' ).'</span><div id="infscr-loading"></div></div>';
		ob_start();
		theme_portfolio_pagenavi( '', '', $r, $paged );
		$output .= ob_get_clean();
	}
	wp_reset_postdata();
	return $output;

}
add_shortcode( 'portfolio_newspaper', 'theme_shortcode_portfolio_newspaper' );




//========================================================================

function theme_shortcode_gallery( $atts, $content = null, $code ) {

	extract( shortcode_atts( array(
				'column' => 3,
				'height' => 350,
				'layout' => 'sidebar',
			), $atts ) );

	switch ( $column ) {
	case 1:
		if ( $layout=='sidebar' ) {
			$width = '640';
		}else {
			$width = '960';
		}
		$column_css = 'one_col';
		break;
	case 2:
		if ( $layout=='sidebar' ) {
			$width = '305';
		}else {
			$width = '460';
		}
		$column_css = 'two_col';
		break;
	case 3:
		if ( $layout=='sidebar' ) {
			$width = '200';
		}else {
			$width = '300';
		}
		$column_css = 'three_col';
		break;
	case 4:
		if ( $layout=='sidebar' ) {
			$width = '150';
		}else {
			$width = '220';
		}
		$column_css = 'four_col';
	}


	$rel_group = 'portfolio_'.rand( 1, 1000 );

	wp_enqueue_script( 'jquery-isotope' );


?>
<script type="text/javascript">
  jQuery(document).ready(function(){

      var $container = jQuery('.portfolio_container');

      $container.isotope({
        itemSelector : '.portfolio_item'
      });


    });

</script>
<?php


	$output = '<section id="portfolios" class="'.$column_css.'">';

	if ( !preg_match_all( "/(.?)\[(item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/item\])?(.?)/s", $content, $matches ) ) {
		return do_shortcode( $content );
	}
	else {

		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$matches[ 3 ][ $i ] = shortcode_parse_atts( $matches[ 3 ][ $i ] );
		}
		$output .= '<div class="portfolio_container">';


		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {

		$enable_image_cropping = theme_option(THEME_OPTIONS,'disable_image_cropping') === 'true'? true: false;
		$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images') === 'true'? true: false;	
		$image_src  = theme_img_resize( do_shortcode( trim( $matches[ 5 ][ $i ] ) ), $width, $height, $enable_image_cropping, $enable_retina_images );

			$output .= '<div class="portfolio_item" style="width:' . $width . 'px; height: '. $height .'px" data-id="'.get_the_id().'">';
			$output .= '<div class="portfolio_item_wrapper" style="width:' . $width . 'px; height: '. $height .'px">';
			$output .= '<span class="portfolio_overlay"></span>';
			$output .= '<img src="' . get_image_src($image_src['url']) . '" title="' . $matches[ 3 ][ $i ][ 'title' ] . '" alt="' . $matches[ 3 ][ $i ][ 'title' ]. '" />';
			$output .= '<a class="portfolio_item_details" >';
			$output .= '<h2 class="portfolio_title">' . $matches[ 3 ][ $i ][ 'title' ] . '</h2>';
			$output .= '</a>';
			$output .= '<a style="position:absolute; overflow:hidden;" title="'. $matches[ 3 ][ $i ][ 'title' ] .'"  class="lightbox_link lightbox" rel="'.$rel_group.'" href="'. do_shortcode( trim( $matches[ 5 ][ $i ] ) ) .'"><span class="hover_icon zoom_icon"></span></a>';
			$output .= '</div></div>';
		}
	}

	$output .= '</div><div class="clearboth"></div>';
	$output .= '</section>';

	return $output;

}
add_shortcode( 'gallery_ws', 'theme_shortcode_gallery' );

//========================================================================



function theme_portfolio_pagenavi($before = '', $after = '', $blog_query, $paged) {
	global $wpdb, $wp_query;
	
	if (is_single())
		return;
	
	$pagenavi_options = array(
		'pages_text' => '',
		'current_text' => '%PAGE_NUMBER%',
		'page_text' => '%PAGE_NUMBER%',
		'first_text' => __('&laquo; First','theme_frontend'),
		'last_text' => __('Last &raquo;','theme_frontend'),
		'next_text' => __('&raquo;','theme_frontend'),
		'prev_text' => __('&laquo;','theme_frontend'),
		'dotright_text' => __('...','theme_frontend'),
		'dotleft_text' => __('...','theme_frontend'),
		'style' => 1,
		'num_pages' => 4,
		'always_show' => 0,
		'num_larger_page_numbers' => 3,
		'larger_page_numbers_multiple' => 10,
		'use_pagenavi_css' => 0,
	);
	
	$request = $blog_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	global $wp_version;
	if((is_front_page() || is_home() ) && version_compare($wp_version, "3.1", '>=')){//fix wordpress 3.1 paged query 
		$paged = (get_query_var('paged')) ?intval(get_query_var('paged')) : intval(get_query_var('page'));
	}else{
		$paged = intval(get_query_var('paged'));
	}
	
	$numposts = $blog_query->found_posts;
	$max_page = intval($blog_query->max_num_pages);
	
	if (empty($paged) || $paged == 0)
		$paged = 1;
	$pages_to_show = intval($pagenavi_options['num_pages']);
	$larger_page_to_show = intval($pagenavi_options['num_larger_page_numbers']);
	$larger_page_multiple = intval($pagenavi_options['larger_page_numbers_multiple']);
	$pages_to_show_minus_1 = $pages_to_show - 1;
	$half_page_start = floor($pages_to_show_minus_1 / 2);
	$half_page_end = ceil($pages_to_show_minus_1 / 2);
	$start_page = $paged - $half_page_start;
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$end_page = $paged + $half_page_end;
	if (($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	
	if ($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	
	if ($start_page <= 0)
		$start_page = 1;
	
	$larger_pages_array = array();
	if ($larger_page_multiple)
		for($i = $larger_page_multiple; $i <= $max_page; $i += $larger_page_multiple)
			$larger_pages_array[] = $i;
	
	if ($max_page > 1 || intval($pagenavi_options['always_show'])) {
		$pages_text = str_replace("%CURRENT_PAGE%", number_format_i18n($paged), $pagenavi_options['pages_text']);
		$pages_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pages_text);
		echo $before . '<div class="wp-pagenavi">' . "\n";
		switch(intval($pagenavi_options['style'])){
			// Normal
			case 1:
				if (! empty($pages_text)) {
					echo '<span class="pages">' . $pages_text . '</span>';
				}
				/*if ($start_page >= 2 && $pages_to_show < $max_page) {
					$first_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['first_text']);
					echo '<a href="' . esc_url(get_pagenum_link()) . '" class="first" title="' . $first_page_text . '">' . $first_page_text . '</a>';
					if (! empty($pagenavi_options['dotleft_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotleft_text'] . '</span>';
					}
				}*/
				$larger_page_start = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page < $start_page && $larger_page_start < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_start++;
					}
				}
				previous_posts_link($pagenavi_options['prev_text']);
				for($i = $start_page; $i <= $end_page; $i++) {
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<span class="current">' . $current_page_text . '</span>';
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($i)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
					}
				}
				next_posts_link($pagenavi_options['next_text'], $max_page);
				$larger_page_end = 0;
				foreach($larger_pages_array as $larger_page) {
					if ($larger_page > $end_page && $larger_page_end < $larger_page_to_show) {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($larger_page), $pagenavi_options['page_text']);
						echo '<a href="' . esc_url(get_pagenum_link($larger_page)) . '" class="page" title="' . $page_text . '">' . $page_text . '</a>';
						$larger_page_end++;
					}
				}
				/*if ($end_page < $max_page) {
					if (! empty($pagenavi_options['dotright_text'])) {
						echo '<span class="extend">' . $pagenavi_options['dotright_text'] . '</span>';
					}
					$last_page_text = str_replace("%TOTAL_PAGES%", number_format_i18n($max_page), $pagenavi_options['last_text']);
					echo '<a href="' . esc_url(get_pagenum_link($max_page)) . '" class="last" title="' . $last_page_text . '">' . $last_page_text . '</a>';
				}*/
				break;
			// Dropdown
			case 2:
				echo '<form action="' . htmlspecialchars($_SERVER['PHP_SELF']) . '" method="get">' . "\n";
				echo '<select size="1" onchange="document.location.href = this.options[this.selectedIndex].value;">' . "\n";
				for($i = 1; $i <= $max_page; $i++) {
					$page_num = $i;
					if ($page_num == 1) {
						$page_num = 0;
					}
					if ($i == $paged) {
						$current_page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['current_text']);
						echo '<option value="' . esc_url(get_pagenum_link($page_num)) . '" selected="selected" class="current">' . $current_page_text . "</option>\n";
					} else {
						$page_text = str_replace("%PAGE_NUMBER%", number_format_i18n($i), $pagenavi_options['page_text']);
						echo '<option value="' . esc_url(get_pagenum_link($page_num)) . '">' . $page_text . "</option>\n";
					}
				}
				echo "</select>\n";
				echo "</form>\n";
				break;
		}
		echo '</div>' . $after . "\n";
	}
}



/*------------------------------------------------------------- 
		DIVIDERS SHORTCODE
-------------------------------------------------------------*/


function shortcode_dividers( $atts, $code ) {
	extract( shortcode_atts( array(
				"style" => false,
				"width" => "full",
				"align" => 'left'
			), $atts ) );

	if ( $style == "style1" || $style == "style2" || $style == "style3" || $style == "style4" || $style == "style5" ) {
		return '<div class="divider_'.$align . '"><div class="divider divider_'.$width.' ' . $style . ' ie_png"></div></div><div class="clearboth"></div>';
	}

	if ( $style == "top" ) {
		return '<div class="divider top"><a href="#">'. __( "Top", "theme_frontend" ). '</a><span></span></div><div class="clearboth"></div>';
	}

	if ( $style == "clearboth" ) {
		return '<div class="clearboth"></div>';
	}
}

add_shortcode( 'divider', 'shortcode_dividers' );

/*------------------------------------------------------------- 
		PADDING SHORTCODE
-------------------------------------------------------------*/

function shortcode_padding( $atts, $code ) {
	extract( shortcode_atts( array(
				"height" => '30'
			), $atts ) );


	return '<div style="height:'.$height.'px" class="padding_spance"></div>';
}

add_shortcode( 'padding', 'shortcode_padding' );

/*------------------------------------------------------------- 
		IMAGE SHORTCODE
-------------------------------------------------------------*/


function theme_shortcode_image( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				'title' => '',
				'desc' => '',
				'link' => '#',
				'lightbox' => 'false',
				'align' => false,
				'group' => '',
				'width' => 'full',
				'height' => false
			), $atts ) );

	switch ( $width ) {
	case 'full':
		$width = 930;
		break;

	case 'full_sidebar':
		$width = 620;
		break;

	case 'one_half':
		$width = 435;
		break;


	case 'one_half_sidebar':
		$width = 278;
		break;


	case 'one_third':
		$width = 271;
		break;


	case 'one_third_sidebar':
		$width = 173;
		break;


	case 'one_fourth':
		$width = 188;
		break;

	case 'one_fourth_sidebar':
		$width = 118;
		break;


	}


	$src     = trim( $content );
	$no_link = '';
	if ( $lightbox == 'true' ) {
		if ( $link == '#' ) {
			$link = $src;
		}
	}
	else {
		if ( $link == '#' ) {
			$no_link = ' image_no_link';
		}
	}

		$enable_image_cropping = theme_option(THEME_OPTIONS,'disable_image_cropping') === 'true'? true: false;
		$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images') === 'true'? true: false;	
		$image_src  = theme_img_resize( get_image_src( $src ) , $width, $height, $enable_image_cropping, $enable_retina_images );

	$image = '<img width="' . $width . '" height="' . $height . '" alt="' . $title . '" src="' . get_image_src($image_src['url']) .'" />';



	$content =  '<div class="image_container image_shortcode' . ( $align ? ' align' . $align : '' ) . '" style="width:'. $width .'px">';
	$content .=  '<span class="image_frame" >';
	$content .= '<a' . ( $group ? ' rel="' . $group . '"' : '' ) . ' class="'. $no_link  . ( $lightbox == 'true' ? ' lightbox hover_effect' : '' )  . ' " title="' . $title . '" href="' . $link . '">' . $image;
	$content .= '<span class="zoom_icon hover_icon" style="left:'. ($width/2-25) .'px;"></span>';
	$content .= '<span class="image_overlay"></span></a></span>';
	$content .= ( $title ? '<h4 class="image_shortcode_title">'.$title.'</h4>' : '' );
	$content .= ( $desc ? '<span class="image_shortcode_desc">'.$desc.'</span>' : '' );
	$content .= '</div>';
	return $content;
}
add_shortcode( 'image', 'theme_shortcode_image' );






/*------------------------------------------------------------- 
		CONTACT FORM SHORTCODE
-------------------------------------------------------------*/

function theme_shortcode_contactform( $atts, $content = null ) {
	extract( shortcode_atts( array(
				'email' => get_bloginfo( 'admin_email' ),
			), $atts ) );
	wp_print_scripts( 'jquery-tools-validator' );


	$content = trim( $content );
	if ( !empty( $content ) ) {
		$success = do_shortcode( $content );
	}

	if ( empty( $success ) ) {
		$success = __( 'Your message was successfully sent. <strong>Thank You!</strong>', 'theme_frontend' );
	}

	$file_path = THEME_DIR_URL;
	$images_path = THEME_IMAGES;
	$name_str = __( 'Name *', 'theme_frontend' );
	$email_str = __( 'Email *', 'theme_frontend' );
	$message_str=__('Message', 'theme_frontend');
	$submit_str = __( 'Submit', 'theme_frontend' );
	

	return <<<HTML
[raw]
<div class="contact_form_container" style="margin-bottom:30px">
	<form class="contact_form shortcode" action="{$file_path}/sendmail.php" method="post" novalidate="novalidate">
		<div class="section_row"><label for="contact_name">{$name_str}</label><input type="text" required="required" id="contact_name" name="contact_name" class="text_input" value="" tabindex="5" /></div>
		<div class="section_row"><label for="contact_email">{$email_str}</label><input type="email" required="required" id="contact_email" name="contact_email" class="text_input" value="" tabindex="6"  /></div>
		<div class="comment_row section_row"><label for="contact_message">{$message_str}</label><textarea required="required" id="contact_message" name="contact_content" class="textarea contact_content" tabindex="8"></textarea></div>
		<div class="section_row"><button style="margin-left:0;" type="submit" class="ws-button contact_button large"><span><span>{$submit_str}</span></span></button>
		<div class="contact_loading" style="display:none"></div></div>
		<input type="hidden" value="{$email}" name="contact_to"/>
	</form>
	<div class="clearboth"></div>
	<div class="success_message" style="display:none"><img src="{$images_path}/success_bubble_top.png" class="success_bubble_top" alt="" />{$success}</div>
</div>
[/raw]
HTML;

}
add_shortcode( 'contactform', 'theme_shortcode_contactform' );
//========================================================================






/*
POPULAR POSTS SHORTCODE

function theme_shortcode_popular_posts( $atts )
{
		extract( shortcode_atts( array(
				 'count' => '4',
				'thumbnail' => 'true',
				'time' => 'true',
				'desc' => 'false',
				'cat' => '',
				'desc_length' => '80'
		), $atts ) );

		$query = array(
				 'showposts' => $count,
				'nopaging' => 0,
				'orderby' => 'comment_count',
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1
		);
		if ( $cat )
		{
				$query[ 'cat' ] = $cat;
		} //$cat
		$r = new WP_Query( $query );

		if ( $r->have_posts() )
		{
				$output = '<div class="single_post_list">';
				$output .= '<ul>';
				while ( $r->have_posts() )
				{
						$r->the_post();
						$output .= '<li>';
						if ( $thumbnail != 'false' )
						{
								$output .= '<a class="thumbnail" href="' . get_permalink() . '" title="' . get_the_title() . '">';
								if ( has_post_thumbnail() )
								{
										$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
										$image_src       = TIMTHUMB . '?src=' . get_image_src( $image_src_array[ 0 ] ) . '&amp;h=90&amp;w=120&amp;zc=1&amp;q=100';

										$output .= '<img src="' . $image_src . '" alt="' . get_the_title() . '" />';
								} //has_post_thumbnail()
								else
								{
										$output .= '<img src="' . THEME_IMAGES . '/empty_120.png" width="120" height="90" title="' . get_the_title() . '" alt="' . get_the_title() . '"/>';
								}
								$output .= '</a>';
						} //$thumbnail != 'false'
						$output .= '<a class="title" href="' . get_permalink() . '" title="' . get_the_title() . '" rel="bookmark">' . get_the_title() . '</a>';
						if ( $time == 'true' )
						{
								$output .= '<time datetime="' . get_the_time( 'Y-m-d' ) . '">' . get_the_date() . '</time>';
						} //$time == 'true'
						if ( $desc == 'true' )
						{
								global $post;
								$excerpt = $post->post_excerpt;
								if ( $excerpt == '' )
								{
										$excerpt = get_the_content( '' );
								} //$excerpt == ''
								$output .= '<span>' . wp_html_excerpt( $excerpt, $desc_length ) . '...</span>';
						} //$desc == 'true'
						$output .= '<div class="clearboth"></div>';
						$output .= '</li>';
				} //$r->have_posts()
				$output .= '</ul>';
				$output .= '</div>';
		} //$r->have_posts()
		wp_reset_query();
		return '[raw]' . $output . '[/raw]';
}
add_shortcode( 'popular_posts', 'theme_shortcode_popular_posts' );

//========================================================================







/*
RECENT POSTS SHORTCODE

function theme_shortcode_recent_posts( $atts )
{
		extract( shortcode_atts( array(
				 'count' => '4',
				'thumbnail' => 'true',
				'time' => 'true',
				'desc' => 'false',
				'cat' => '',
				'desc_length' => '80'
		), $atts ) );

		$query = array(
				 'showposts' => $count,
				'nopaging' => 0,
				'post_status' => 'publish',
				'ignore_sticky_posts' => 1
		);
		if ( $cat )
		{
				$query[ 'cat' ] = $cat;
		} //$cat
		$r = new WP_Query( $query );

		if ( $r->have_posts() )
		{
				$output = '<div class="single_post_list">';
				$output .= '<ul>';
				while ( $r->have_posts() )
				{
						$r->the_post();
						$output .= '<li>';
						if ( $thumbnail != 'false' )
						{
								$output .= '<a class="thumbnail" href="' . get_permalink() . '" title="' . get_the_title() . '">';
								if ( has_post_thumbnail() )
								{
										$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
										$image_src       = TIMTHUMB . '?src=' . get_image_src( $image_src_array[ 0 ] ) . '&amp;h=90&amp;w=120&amp;zc=1&amp;q=100';

										$output .= '<img src="' . $image_src . '" alt="' . get_the_title() . '" />';
								} //has_post_thumbnail()
								else
								{
										$output .= '<img src="' . THEME_IMAGES . '/empty-thumb.png" width="120" height="90" title="' . get_the_title() . '" alt="' . get_the_title() . '"/>';
								}
								$output .= '</a>';
						} //$thumbnail != 'false'
						$output .= '<a class="title" href="' . get_permalink() . '" title="' . get_the_title() . '" rel="bookmark">' . get_the_title() . '</a>';
						if ( $time == 'true' )
						{
								$output .= '<time datetime="' . get_the_time( 'Y-m-d' ) . '">' . get_the_date() . '</time>';
						} //$time == 'true'
						if ( $desc == 'true' )
						{
								global $post;
								$excerpt = $post->post_excerpt;
								if ( $excerpt == '' )
								{
										$excerpt = get_the_content( '' );
								} //$excerpt == ''
								$output .= '<span>' . wp_html_excerpt( $excerpt, $desc_length ) . '...</span>';
						} //$desc == 'true'
						$output .= '<div class="clearboth"></div>';
						$output .= '</li>';
				} //$r->have_posts()
				$output .= '</ul>';
				$output .= '</div>';
		} //$r->have_posts()
		wp_reset_query();
		return '[raw]' . $output . '[/raw]';
}
add_shortcode( 'recent_posts', 'theme_shortcode_recent_posts' );


//========================================================================





/*------------------------------------------------------------- 
		RECENT COMMENTS SHORTCODE
-------------------------------------------------------------*/

function theme_recent_comments( $atts ) {
	extract( shortcode_atts( array(
				'count' => '5'
			), $atts ) );

	$comments = get_comments( array(
			'number' => $count,
			'status' => 'approve'
		) );
	$out = '<div class="widget_recent_comments">';
	$out .= '<ul id="recentcomments">';
	if ( $comments ) {
		foreach ( (array) $comments as $comment ) {
			$out .= '<li>' . sprintf( _x( '%1$s on %2$s', 'widgets',"theme_backend"), get_comment_author_link( $comment->comment_ID ), '<a href="' . esc_url( get_comment_link( $comment->comment_ID ) ) . '">' . get_the_title( $comment->comment_post_ID ) . '</a>' ) . '</li>';
		} //(array) $comments as $comment
	} //$comments
	$out .= '</div>';

	return $out;

}
add_shortcode( 'recent_comments', 'theme_recent_comments' );

/*------------------------------------------------------------- 
		POST TAGS SHORTCODE
-------------------------------------------------------------*/

function theme_post_tag( $atts ) {
	extract( shortcode_atts( array(
				'count' => '100'
			), $atts ) );



	$out = '<div class="widget_tag_cloud">';

	$listparams = "number=$count&echo=0&orderby=count&order=DESC&smallest=12&largest=36&unit=px";
	$out .= '[raw]' . wp_tag_cloud( $listparams ) . '[/raw]';
	$out .= '</div>';

	return $out;

}
add_shortcode( 'tag_cloud', 'theme_post_tag' );


/*------------------------------------------------------------- 
		SLIDESHOW SHORTCODE
-------------------------------------------------------------*/


function theme_slideshow( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				"width" => '620',
				"height" => '300',
				"effect" => 'fade',
				"pause" => "7000",
				"speed" => 600,

			), $atts ) );
	wp_print_scripts( 'jquery-flexslider' );
	$random_id       = rand( 100, 9999 );
?>
<script type="text/javascript" charset="utf-8">
  jQuery(document).ready(function() {
    jQuery('#flexslider_<?php echo $random_id; ?>').flexslider({
	animation: "<?php echo $effect; ?>",
	slideshowSpeed: <?php echo $pause; ?>,
	animationDuration: <?php echo $speed; ?>
	});
  });
</script>
<?php
	if ( !preg_match_all( "/(.?)\[(item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/item\])?(.?)/s", $content, $matches ) ) {
		return do_shortcode( $content );
	}
	else {
		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$matches[ 3 ][ $i ] = shortcode_parse_atts( $matches[ 3 ][ $i ] );
		}

		$output = '';
		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
		$enable_image_cropping = theme_option(THEME_OPTIONS,'disable_image_cropping') === 'true'? true: false;
		$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images') === 'true'? true: false;	
		$image_src  = theme_img_resize( do_shortcode( trim( $matches[ 5 ][ $i ] ) ), $width, $height, $enable_image_cropping, $enable_retina_images );


			$output .= '<li>'.( isset( $matches[ 3 ][ $i ][ 'link' ] ) ? '<a href="'.$matches[ 3 ][ $i ][ 'link' ].'">' : '' ).'<img alt="" src="' . $image_src['url'] .'" />'.( isset( $matches[ 3 ][ $i ][ 'link' ] ) ? '</a>' : '' ).''.( isset( $matches[ 3 ][ $i ][ 'caption' ] ) ?  '<p class="flex-caption">' . $matches[ 3 ][ $i ][ 'caption' ] . '</p>' : '' ) . '</li>';
		}

		return '<div style="width:' . $width . 'px;" class="slideshow_shortcode flex-container"><div class="flexslider" id="flexslider_'.$random_id.'" ><ul class="slides">' . $output . '</ul></div></div>';
	}
}


add_shortcode( 'slideshow', 'theme_slideshow' );


/*------------------------------------------------------------- 
		GOOGLE MAPS SHORTCODE
-------------------------------------------------------------*/

function theme_gmap( $atts, $content = null, $code ) {
	
	extract( shortcode_atts( array(
				"address" => false,
				"latitude" => '0',
				"longitude" => '0',
				"zoom" => '14',
				"html" => false,
				"popup" => false,
				"height" => '250'
			), $atts ) );
	wp_print_scripts( 'jquery-gmap' );


	if ( $zoom < 1 ) {
		$zoom = 1;
	}

	$id = rand( 100, 3000 );

?>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
jQuery(document).ready(function($) {
			jQuery("#gmap_widget_<?php echo $id;?>").gMap({
			    zoom: <?php echo $zoom;?>,
			    markers:[{
					address: "<?php echo $address;?>",
					latitude: <?php echo $latitude;?>,
			    	longitude: <?php echo $longitude;?>,
			    	html: "<?php echo $html;?>",
			    	popup: <?php echo $popup;?>
				}],
				controls: false,
				maptype: 'ROADMAP'
			});
		});
</script>
<?php
return '<div id="gmap_widget_'.$id.'" class="google_map" style="height:'.$height.'px" ></div><div class="clearboth"></div>';
}


add_shortcode( 'gmap', 'theme_gmap' );


/*------------------------------------------------------------- 
		ANYTHING SLIDER SHORTCODE
-------------------------------------------------------------*/

function theme_testimonial_slider( $atts, $content = null, $code ) {
	extract( shortcode_atts( array(
				"url" => '#',
				"company" => '',
				"speed" => 700,
				"auto" => 3000,
				"hoverpause" => 5000,
				"effect" => "slide",
				"speed" => 400

			), $atts ) );
	wp_enqueue_script( 'jquery-slides' );
	$random = rand( 0, 100 );


	if ( !preg_match_all( "/(.?)\[(item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/item\])?(.?)/s", $content, $matches ) ) {
		return do_shortcode( $content );
	} else {

		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {
			$matches[ 3 ][ $i ] = shortcode_parse_atts( $matches[ 3 ][ $i ] );
		}

?>
<script type="text/javascript">
		jQuery(document).ready(function() {
		shortcode_container_width = jQuery("#testimonial_slider_<?php echo $random; ?>").parent().outerWidth();
		jQuery("#testimonial_slider_<?php echo $random; ?>, #testimonial_slider_<?php echo $random; ?> .testimonial_item").css('width', (shortcode_container_width));
		jQuery('.testimonial_content').css('width', (shortcode_container_width - 160));

	   jQuery("#testimonial_slider_<?php echo $random; ?>").slides({preload: true, effect: "<?php echo $effect; ?>", generatePagination:false, fadeSpeed: <?php echo $speed; ?>,  slideSpeed: <?php echo $speed; ?>,  autoHeight: true, play:<?php echo $auto; ?>, hoverPause: true, pause: <?php echo $auto; ?>})});
</script>
<?php
		$output ='';
		for ( $i = 0; $i < count( $matches[ 0 ] ); $i++ ) {

		$enable_image_cropping = theme_option(THEME_OPTIONS,'disable_image_cropping') === 'true'? true: false;
		$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images') === 'true'? true: false;	
		$image_src  = theme_img_resize( $matches[ 3 ][ $i ][ 'image' ], 127, 127, $enable_image_cropping, $enable_retina_images );

			if(!isset($matches[ 3 ][ $i ][ 'company' ])) $matches[ 3 ][ $i ][ 'company' ] = '';
			if(!isset($matches[ 3 ][ $i ][ 'url' ])) $matches[ 3 ][ $i ][ 'url' ] = '';
			
			$output .='<div class="testimonial_item"><div class="testimonial_image_bg"><div class="testimonial_image">';
			if(isset($image_src['url'])) {
			$output .= '<img src="' . get_image_src($image_src['url']) .'" title="'. $matches[ 3 ][ $i ][ 'company' ] . '" alt="' .$matches[ 3 ][ $i ][ 'company' ] .'" />';
			}
			$output .= '</div></div>';
			$output .= '<div class="testimonial_content shortcode_version"><div class="testimonail_icon"></div>' . do_shortcode( trim( $matches[ 5 ][ $i ] ) ) . '</div><a class="testimonial_company" href="' . $matches[ 3 ][ $i ][ 'url' ] . '">' . $matches[ 3 ][ $i ][ 'company' ] . '</a></div>';

		}


		return '<div class="testimonial_slider" id="testimonial_slider_' . $random . '"><div class="testimonial_arrow"><a class="prev"></a><a class="next"></a></div><div id="slides"><div  class="slides_container">' . $output . '</div></div></div>';
	}
}


add_shortcode( 'testimonial_slider', 'theme_testimonial_slider' );


/*------------------------------------------------------------- 
		TEWITTER FEEDS SHORTCODE
-------------------------------------------------------------*/

function theme_shortcode_twitter( $atts ) {
	extract( shortcode_atts( array(
				'username' => '',
				'count' => 3
			), $atts ) );

	wp_enqueue_script( 'jquery-tweet' );
	$id = rand( 1, 1000 );
	$blog_info = get_bloginfo( 'name' );

	return <<<HTML
[raw]
<div class="twitter_shortcode">
<script type="text/javascript">
jQuery(document).ready(function($) {
	jQuery("#twitter_wrap_{$id}").tweet({
		username: "{$username}",
		count: {$count},
		template: '{join}{text}<span class="company_on_twitter">{$blog_info} on Twitter</span>{time}'
	});
});
</script>
[/raw]
	<div id="twitter_wrap_{$id}"></div>
	<div class="clearboth"></div>
</div>
HTML;
}
add_shortcode( 'twitter', 'theme_shortcode_twitter' );
/*****************************************************/



/*------------------------------------------------------------- 
		FLICKR SHORTCODE
-------------------------------------------------------------*/

function theme_shortcode_flickr( $atts ) {
	extract( shortcode_atts( array(
				'id' => '',
				'count' => 4,
				'display' => 'latest' //lastest or random
			), $atts ) );

	return <<<HTML
<div class="flickr_shortcode">
	<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count={$count}&amp;display={$display}&amp;size=s&amp;layout=x&amp;source=user&amp;user={$id}"></script>
</div>
<div class="clearboth"></div>

HTML;

}
add_shortcode( 'flickr', 'theme_shortcode_flickr' );

function theme_shortcode_contact_info( $atts ) {
	extract( shortcode_atts( array(
				'color' => '',
				'phone' => '',
				'cellphone' => '',
				'email' => '',
				'address' => '',
				'name' => ''
			), $atts ) );


	$color = $color ? $color : theme_option( THEME_OPTIONS, 'scheme_main_color' );

	if ( !empty( $city ) && !empty( $state ) ) {
		$city = $city . ',&nbsp;' . $state;
	} //!empty( $city ) && !empty( $state )
	elseif ( !empty( $state ) ) {
		$city = $state;
	} //!empty( $state )
	if ( !empty( $color ) ) {
		$color = ' ' . $color;
	} //!empty( $color )

	$output = '<div class="contact_info">';
	if ( !empty( $phone ) ) {
		$output .= '<span class="icon_list list_phone"><i class="icon_list icon-fixed-width icon-phone' . $color . '"></i>' . $phone . '</span>';
	} //!empty( $phone )
	if ( !empty( $cellphone ) ) {
		$output .= '<span class="icon_list list_mobile"><i class="icon_list icon-fixed-width icon-mobile-phone' . $color. '"></i>' . $cellphone . '</span>';
	} //!empty( $cellphone )
	if ( !empty( $email ) ) {
		$output .= '<a href="mailto:' . $email . '" class="icon_list list_email"><i class="icon_list icon-fixed-width icon-envelope'. $color . '"></i>' . $email . '</a>';
	} //!empty( $email )
	if ( !empty( $address ) ) {
		$output .= '<span class="icon_list list_home"><i class="icon_list icon-fixed-width icon-home' . $color . '"></i>' . $address . '</span>';
	}
	if ( !empty( $name ) ) {
		$output .= '<span class="icon_list list_id"><i class="icon_list icon-fixed-width icon-user' . $color . '"></i>' . $name . '</span>';
	}
	$output .= '</div>';
	return $output;
}
add_shortcode( 'contact_info', 'theme_shortcode_contact_info' );


/*------------------------------------------------------------- 
		CONTENT FORMATTER
-------------------------------------------------------------*/

function theme_formatter( $content ) {
	$new_content      = '';
	$pattern_full     = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces           = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );

	foreach ( $pieces as $piece ) {
		if ( preg_match( $pattern_contents, $piece, $matches ) ) {
			$new_content .= $matches[ 1 ];
		} //preg_match( $pattern_contents, $piece, $matches )
		else {
			$new_content .= wptexturize( wpautop( $piece ) );
		}
	} //$pieces as $piece

	return $new_content;
}
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_content', 'wptexturize' );

add_filter( 'the_content', 'theme_formatter', 99 );
/*****************************************************/







global $theme_code_token;
$theme_code_token   = md5( uniqid( rand() ) );
$theme_code_matches = array();
function theme_code_before_filter( $content ) {
	return preg_replace_callback( "/(.?)\[(pre|code)\b(.*?)(?:(\/))?\](?:(.+?)\[\/\\2\])?(.?)/s", "theme_code_before_filter_callback", $content );
}

function theme_code_before_filter_callback( &$match ) {
	global $theme_code_token, $theme_code_matches;
	$i = count( $theme_code_matches );

	$theme_code_matches[ $i ] = $match;

	return "\n\n<p>" . $theme_code_token . sprintf( "%03d", $i ) . "</p>\n\n";
}

function theme_code_after_filter( $content ) {
	global $theme_code_token;

	$content = preg_replace_callback( "/<p>\s*" . $theme_code_token . "(\d{3})\s*<\/p>/si", "theme_code_after_filter_callback", $content );

	return $content;
}
function theme_code_after_filter_callback( $match ) {
	global $theme_code_matches;
	$i            = intval( $match[ 1 ] );
	$content      = $theme_code_matches[ $i ];
	$content[ 5 ] = trim( $content[ 5 ] );

	if ( version_compare( PHP_VERSION, '5.2.3' ) >= 0 ) {
		$output = htmlspecialchars( $content[ 5 ], ENT_NOQUOTES, get_bloginfo( 'charset' ), false );
	} //version_compare( PHP_VERSION, '5.2.3' ) >= 0
	else {
		$specialChars = array(
			'&' => '&amp;',
			'<' => '&lt;',
			'>' => '&gt;'
		);

		$output = strtr( htmlspecialchars_decode( $content[ 5 ] ), $specialChars );
	}
	return '<' . $content[ 2 ] . ' class="' . $content[ 2 ] . '">' . $output . '</' . $content[ 2 ] . '>';
}

add_filter( 'the_content', 'theme_code_before_filter', 0 );
add_filter( 'the_content', 'theme_code_after_filter', 99 );


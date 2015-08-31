<?php
class theme_function {

	// Main Navigation
	function primary_menu() {
		
		wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'container' => 'nav',
				'container_id' => 'navigation',
				'container_class' => 'slidemenu',
				'fallback_cb' => '',

			) );


		wp_nav_menu( array(
				'theme_location' => 'primary-menu',
				'container' => 'div',
				'fallback_cb' => '',
				'container_id' => 'responsive_navigation',
				'walker'         => new Walker_Nav_Menu_Dropdown(),
				'items_wrap'     => '<select>%3$s</select>',
			) );



	}
	

	// Sub Footer Navigation
	function footer_menu() {
		if ( theme_option( THEME_OPTIONS, 'enable_footer_nav' ) =='true' ) {
			wp_nav_menu( array(
					'theme_location' => 'footer-menu',
					'container' => 'nav',
					'container_id' => 'footer_nav',
					'fallback_cb' => ''
				) );
		}
	}





	function title() {
		global $page, $paged;
		wp_title( '|', true, 'right' );
		bloginfo( 'name' );
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && is_home() )
			echo " | $site_description";
		if ( $paged >= 2 || $page >= 2 )
			echo ' | ' . sprintf( 'Page %s', max( $paged, $page ) );
	}

	function sidebar( $post_id = NULL ) {
		sidebar_generator( 'get_sidebar', $post_id );
	}

	function footer_sidebar() {
		sidebar_generator( 'get_footer_sidebar' );
	}


	function introduce( $post_id = NULL ) {
		global $post;
		$type = get_post_meta( $post_id, '_introduce_text_type', true );
		if ( empty( $type ) )
			$type = 'default';
		if ( $type == 'disable' ) {
			return;
		}
		if ( in_array( $type, array(
					'default',
					'title',
					'title_center',
					'title_custom'
				) ) )

			if ( is_single() || is_page() ) {

				{
					$title = get_the_title( $post_id );
				}
				$blog_page_id = theme_option( THEME_OPTIONS, 'blog_page' );
				if ( $type == 'default' && is_singular( 'post' ) && $post_id != $blog_page_id ) {
					return $this->introduce( $blog_page_id );
				}
				if ( in_array( $type, array(
							'custom',
							'title_custom'
						) ) ) {
					$text = get_post_meta( $post_id, '_custom_introduce_text', true );
				}
			}
		if ( is_archive() ) {
			$title = __( 'Archives', 'theme_frontend' );
			if ( is_category() ) {
				$text = sprintf( __( 'Category Archive for: "%s"', 'theme_frontend' ), single_cat_title( '', false ) );
			}
			elseif ( is_tag() ) {
				$text = sprintf( __( 'Tag Archives for: "%s"', 'theme_frontend' ), single_tag_title( '', false ) );
			}
			elseif ( is_day() ) {
				$text = sprintf( __( 'Daily Archive for: "%s"', 'theme_frontend' ), get_the_time( 'F jS, Y' ) );
			}
			elseif ( is_month() ) {
				$text = sprintf( __( 'Monthly Archive for: "%s"', 'theme_frontend' ), get_the_time( 'F, Y' ) );
			}
			elseif ( is_year() ) {
				$text = sprintf( __( 'Yearly Archive for: "%s"', 'theme_frontend' ), get_the_time( 'Y' ) );
			}
			elseif ( is_author() ) {
				if ( get_query_var( 'author_name' ) ) {
					$curauth = get_user_by( 'slug', get_query_var( 'author_name' ) );
				}
				else {
					$curauth = get_userdata( get_query_var( 'author' ) );
				}
				$text = sprintf( __( 'Author Archive for: "%s"' ), $curauth->nickname );
			}
			elseif ( isset( $_GET[ 'paged' ] ) && !empty( $_GET[ 'paged' ] ) ) {
				$text = __( 'Blog Archives', 'theme_frontend' );
			}
			elseif ( is_tax() ) {
				$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
				$text = sprintf( __( 'Archives for: "%s"', 'theme_frontend' ), $term->name );
			}
		}
		if ( is_404() ) {
			$title = __( '404 - Not Found', 'theme_frontend' );
			$text  = __( "Apologies, but the page you requested could not be found. Try using sitemap below.", "theme_frontend" );
		}
		if ( is_search() ) {
			$title = __( 'Search', 'theme_frontend' );
			$text  = sprintf( __( 'Search Results for: "%s"', 'theme_frontend' ), stripslashes( strip_tags( get_search_query() ) ) );
		}
		echo '<div id="introduce">';
		echo '<div class="introduce_wrapper inner">';
		if ( isset( $title ) ) {
			echo '<h1 class="'.$type.'">' . $title;
			if ( is_single() || is_page() ) {
				echo edit_post_link( '', '<span class="ws_edit_link">', '</span>' );
			}
			echo '</h1>';
		}
		if ( isset( $text ) ) {
			echo '<h4>';
			echo $text;
			echo '</h4>';
		}
		echo '</div></div>';

	}


	function slogan_heading( $post_id = NULL ) {
		global $post;
		if ( is_home() ) {
			if ( isset( $_GET["with_cr"] ) ) {
				$enable_slogan_heading = $_GET["with_cr"];
			} else {
				$enable_slogan_heading = theme_option( THEME_OPTIONS, 'enable_slogan_heading' );
			}

			if ( $enable_slogan_heading =='true' ) :
				$output = '<div class="slogan_heading"><div class="inner">';

			if ( theme_option( THEME_OPTIONS, 'home_slogan_heading_dominant' ) !='' ) {
				$output .= '<h1 class="slogan_dominant">'.theme_option( THEME_OPTIONS, 'home_slogan_heading_dominant' ) .'</h1>';
			}
			if ( theme_option( THEME_OPTIONS, 'home_slogan_heading_highlight' ) !='' ) {
				$output .= '<h2 class="slogan_highlight">'.theme_option( THEME_OPTIONS, 'home_slogan_heading_highlight' ) .'</h2>';
			}
			if ( theme_option( THEME_OPTIONS, 'home_slogan_heading_sub' ) !='' ) {
				$output .= '<h3 class="slogan_subtitle">'.theme_option( THEME_OPTIONS, 'home_slogan_heading_sub' ) .'</h3>';
			}
			if ( theme_option( THEME_OPTIONS, 'home_slogan_heading_desc' ) !='' ) {
				$output .= '<p class="introduce_desc">' . theme_option( THEME_OPTIONS, 'home_slogan_heading_desc' ) . '</p>';
			}
			$output .= '</div><div class="clearboth"></div></div>';
			echo $output;

			endif;
		}

		if ( is_archive() ) {
			$enable_slogan_heading = theme_option( THEME_OPTIONS, 'archive_enable_slogan_heading' );


			if ( $enable_slogan_heading =='true' ) :
				$output = '<div class="slogan_heading"><div class="inner">';

			if ( theme_option( THEME_OPTIONS, 'archive_slogan_heading_dominant' ) !='' ) {
				$output .= '<h1 class="slogan_dominant">'.theme_option( THEME_OPTIONS, 'archive_slogan_heading_dominant' ) .'</h1>';
			}
			if ( theme_option( THEME_OPTIONS, 'archive_slogan_heading_highlight' ) !='' ) {
				$output .= '<h2 class="slogan_highlight">'.theme_option( THEME_OPTIONS, 'archive_slogan_heading_highlight' ) .'</h2>';
			}
			if ( theme_option( THEME_OPTIONS, 'archive_slogan_heading_sub' ) !='' ) {
				$output .= '<h3 class="slogan_subtitle">'.theme_option( THEME_OPTIONS, 'archive_slogan_heading_sub' ) .'</h3>';
			}
			if ( theme_option( THEME_OPTIONS, 'archive_slogan_heading_desc' ) !='' ) {
				$output .= '<p class="introduce_desc">' . theme_option( THEME_OPTIONS, 'archive_slogan_heading_desc' ) . '</p>';
			}
			$output .= '</div><div class="clearboth"></div></div>';
			echo $output;

			endif;
		}



		if ( is_single() || is_page() ) {
			if ( get_post_meta( $post_id, '_slogan_heading_dominant', true ) =='' && get_post_meta( $post_id, '_slogan_heading_highlight', true ) =='' &&  get_post_meta( $post_id, '_slogan_heading_sub', true ) =='' &&  get_post_meta( $post_id, '_slogan_heading_desc', true ) =='' ) :
				return false;
			else :

				$output = '<div class="slogan_heading"><div class="inner">';

			if ( get_post_meta( $post_id, '_slogan_heading_dominant', true ) !='' ) {
				$output .= '<h1 class="slogan_dominant">'.get_post_meta( $post_id, '_slogan_heading_dominant', true ) .'</h1>';
			}
			if ( get_post_meta( $post_id, '_slogan_heading_highlight', true ) !='' ) {
				$output .= '<h2 class="slogan_highlight">'.get_post_meta( $post_id, '_slogan_heading_highlight', true ) .'</h2>';
			}
			if ( get_post_meta( $post_id, '_slogan_heading_sub', true ) !='' ) {
				$output .= '<h3 class="slogan_subtitle">'.get_post_meta( $post_id, '_slogan_heading_sub', true ) .'</h3>';
			}
			if ( get_post_meta( $post_id, '_slogan_heading_desc', true ) !='' ) {
				$output .= '<p class="introduce_desc">' .get_post_meta( $post_id, '_slogan_heading_desc', true ) . '</p>';
			}
			$output .= '</div><div class="clearboth"></div></div>';
			echo $output;

			endif;
		}


	}




	function page_gmap( $post_id = NULL ) {
		global $post;
		if ( is_page() && get_post_meta( $post_id, '_enable_page_gmap', true ) == 'true' ) {


			$id = rand( 100, 3000 );

			$latitude = get_post_meta( $post_id, '_page_gmap_latitude', true );
			$longitude = get_post_meta( $post_id, '_page_gmap_longitude', true );
			$zoom = get_post_meta( $post_id, '_page_gmap_zoom', true );
			$panControl = get_post_meta( $post_id, '_enable_panControl', true );
			$zoomControl = get_post_meta( $post_id, '_enable_zoomControl', true );
			$mapTypeControl = get_post_meta( $post_id, '_enable_mapTypeControl', true );
			$scaleControl = get_post_meta( $post_id, '_enable_scaleControl', true );
			$gmap_height = get_post_meta( $post_id, '_gmap_height', true );

			$gmap_disable_coloring = get_post_meta( $post_id, '_disable_coloring', true );
			$gmap_hue = get_post_meta( $post_id, '_gmap_hue', true );
			$gmap_gamma = get_post_meta( $post_id, '_gmap_gamma', true );
			$gmap_saturation = get_post_meta( $post_id, '_gmap_saturation', true );
			$gmap_lightness = get_post_meta( $post_id, '_gmap_lightness', true );


			if ( $zoom < 1 ) {
				$zoom = 1;
			}


?>

	<div id="gmap_page_<?php echo $id;?>" class="google_map" style="height:<?php echo $gmap_height; ?>px; width:100%;"></div>
			<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
			<script type="text/javascript">
			jQuery(document).ready(function($) {
  var map;
var gmap_marker = <?php echo get_post_meta( $post_id, '_gmap_marker', true ); ?>;


  var myLatlng = new google.maps.LatLng(<?php echo $latitude;?>, <?php echo $longitude;?>)
      function initialize() {
        var mapOptions = {
          zoom: <?php echo $zoom;?>,
          center: myLatlng,
	      panControl: <?php echo empty( $panControl ) ? 'false' : $panControl;?>,
		  zoomControl: <?php echo empty( $zoomControl ) ? 'false' : $zoomControl?>,
		  mapTypeControl: <?php echo empty( $mapTypeControl ) ? 'false' :  $mapTypeControl;?>,
		  scaleControl: <?php echo empty( $scaleControl ) ? 'false' : $scaleControl;?>,
	      mapTypeId: google.maps.MapTypeId.ROADMAP,
	      <?php if ( $gmap_disable_coloring == "true" ) { ?>
	      styles: [ { stylers: [
	      			 {hue: "<?php echo $gmap_hue; ?>"},
	      			 {saturation : <?php echo $gmap_saturation; ?> },
				     {lightness: <?php echo $gmap_lightness; ?> },
				     {gamma: <?php echo $gmap_gamma; ?> },
	      			 { featureType: "landscape.man_made", stylers: [ { visibility: "on" } ] }
	      		]
				} ]
		<?php } ?>
        };
        map = new google.maps.Map(document.getElementById('gmap_page_<?php echo $id;?>'), mapOptions);


if(gmap_marker == true) {
        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map
        });
}

      }
 		google.maps.event.addDomListener(window, 'load', initialize);
			});
			</script>

			<div class="clearboth"></div>
	<?php


		}
	}




	function portfolio_featured_image() {


		$portfolio_layout = theme_option( THEME_OPTIONS, 'portfolio_layout' );
		if ( $portfolio_layout == 'full' ) {
			$width = 960;
		} else {
			$width = 640;
		}
		$height = theme_option( THEME_OPTIONS, 'Portfolio_single_image_height' );



		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		//$image_src       = TIMTHUMB . '?src=' . get_image_src( $image_src_array[ 0 ] ) . '&amp;h=' . $height . '&amp;w=' . $width . '&amp;zc=1&q=100';
		$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
		//$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images') === 'true'? true: false;
		$image_src  = theme_img_resize( $image_src_array[ 0 ], $width, $height, $enable_image_cropping, false );

		if ( has_post_thumbnail() ):


?>
	<div class="image_container">
		<span class="image_frame">
<?php if ( is_single() ): ?>
			<img src="<?php echo get_image_src( $image_src['url'] ); ?>" alt="<?php the_title(); ?>" />
<?php endif; ?>
		</span>
	</div>
<?php
		endif;
	}





	function header_social() {
		$path='/social/';
		$out = '<div id="toolbar_social"><ul>';
		$rss_sociable = theme_option( THEME_OPTIONS, 'rss_sociable' );

		if ( $rss_sociable ) {
			$out .= '<li><a class="rss" href=" ' . $rss_sociable . '"><img alt="" src="' . THEME_IMAGES . $path . '/rss.png" /></a></li>';
		}

		$twitter_sociable = theme_option( THEME_OPTIONS, 'twitter_sociable' );
		if ( $twitter_sociable ) {
			$out .= '<li><a class="twitter" target="_blank" href="' . $twitter_sociable . '"><img alt="" src="' . THEME_IMAGES . $path . '/twitter.png"  /></a></li>';
		}

		$facebook_sociable = theme_option( THEME_OPTIONS, 'facebook_sociable' );
		if ( $facebook_sociable ) {
			$out .= '<li><a class="facebook" target="_blank" href="' . $facebook_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/facebook.png" /></a></li>';
		}

		$linkedin_sociable = theme_option( THEME_OPTIONS, 'linkedin_sociable' );
		if ( $linkedin_sociable ) {
			$out .= '<li><a class="rss" target="_blank" href="' . $linkedin_sociable . '"><img alt="" src="' . THEME_IMAGES . $path . '/linkedin.png" /></a></li>';
		}

		$dribbble_sociable = theme_option( THEME_OPTIONS, 'dribbble_sociable' );
		if ( $dribbble_sociable ) {
			$out .= '<li><a class="dribbble" target="_blank" href="' . $dribbble_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/dribbble.png" /></a></li>';
		}
		$google_sociable = theme_option( THEME_OPTIONS, 'google_sociable' );
		if ( $google_sociable  ) {
			$out .= '<li><a class="google" target="_blank" href="' . $google_sociable  . '"><img alt=""  src="' . THEME_IMAGES . $path . '/google.png" /></a></li>';
		}
		$pinterest_sociable = theme_option( THEME_OPTIONS, 'pinterest_sociable' );
		if ( $pinterest_sociable ) {
			$out .= '<li><a class="pinterest" target="_blank" href="' . $pinterest_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/pinterest.png"  /></a></li>';
		}

		$delicious_sociable = theme_option( THEME_OPTIONS, 'delicious_sociable' );
		if ( $delicious_sociable ) {
			$out .= '<li><a class="rss" target="_blank" href="' . $delicious_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/delicious.png" /></a></li>';
		}

		$digg_sociable = theme_option( THEME_OPTIONS, 'digg_sociable' );
		if ( $digg_sociable ) {
			$out .= '<li><a class="digg" target="_blank" href="' . $digg_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/digg.png" /></a></li>';
		}

		$flickr_sociable = theme_option( THEME_OPTIONS, 'flickr_sociable' );
		if ( $flickr_sociable ) {
			$out .= '<li><a class="flickr" target="_blank" href="' . $flickr_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/flickr.png" /></a></li>';
		}

		$deviantart_sociable = theme_option( THEME_OPTIONS, 'deviantart_sociable' );
		if ( $deviantart_sociable ) {
			$out .= '<li><a class="rss" target="_blank" href="' . $deviantart_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/deviantart.png" /></a></li>';
		}

		$tumblr_sociable = theme_option( THEME_OPTIONS, 'tumblr_sociable' );
		if ( $tumblr_sociable ) {
			$out .= '<li><a class="tumblr" target="_blank" href="' . $tumblr_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/tumblr.png" /></a></li>';
		}

		$stumbleupon_sociable = theme_option( THEME_OPTIONS, 'stumbleupon_sociable' );
		if ( $stumbleupon_sociable ) {
			$out .= '<li><a class="stumbleupon" target="_blank" href="' . $stumbleupon_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/stumble.png"  /></a></li>';
		}

		$blogger_sociable = theme_option( THEME_OPTIONS, 'blogger_sociable' );
		if ( $blogger_sociable ) {
			$out .= '<li><a class="blogger" target="_blank" href="' . $blogger_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/blogger.png"  /></a></li>';
		}
		$behance_sociable = theme_option( THEME_OPTIONS, 'behance_sociable' );
		if ( $behance_sociable ) {
			$out .= '<li><a class="behance" target="_blank" href="' . $behance_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/behance.png"  /></a></li>';
		}


		$lastfm_sociable = theme_option( THEME_OPTIONS, 'lastfm_sociable' );
		if ( $lastfm_sociable ) {
			$out .= '<li><a class="lastfm" target="_blank" href="' . $lastfm_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/lastfm.png"  /></a></li>';
		}


		$skype_sociable = theme_option( THEME_OPTIONS, 'skype_sociable' );
		if ( $skype_sociable ) {
			$out .= '<li><a class="skype" target="_blank" href="' . $skype_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/skype.png"  /></a></li>';
		}
		$vimeo_sociable = theme_option( THEME_OPTIONS, 'vimeo_sociable' );
		if ( $vimeo_sociable ) {
			$out .= '<li><a class="vimeo" target="_blank" href="' . $vimeo_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/vimeo.png"  /></a></li>';
		}
		$wordpress_sociable = theme_option( THEME_OPTIONS, 'wordpress_sociable' );
		if ( $wordpress_sociable ) {
			$out .= '<li><a class="wordpress" target="_blank" href="' . $wordpress_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/wordpress.png"  /></a></li>';
		}
		$yahoo_sociable = theme_option( THEME_OPTIONS, 'yahoo_sociable' );
		if ( $yahoo_sociable ) {
			$out .= '<li><a class="yahoo" target="_blank" href="' . $yahoo_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/yahoo.png"  /></a></li>';
		}

		$youtube_sociable = theme_option( THEME_OPTIONS, 'youtube_sociable' );
		if ( $youtube_sociable ) {
			$out .= '<li><a class="youtube" target="_blank" href="' . $youtube_sociable . '"><img alt=""  src="' . THEME_IMAGES . $path . '/youtube.png"  /></a></li>';
		}
		$out .= '</ul></div>';
		echo $out;
	}











	function side_social() {

		$alingment = theme_option( THEME_OPTIONS, 'side_social_align' );
		$out = '<div id="side_social" class="'.$alingment.'"><ul>';
		$full_url = THEME_IMAGES . '/social';

		$rss_sociable = theme_option( THEME_OPTIONS, 'rss_sociable' );
		if ( $rss_sociable ) {
			$out .= '<li><a class="rss" href=" ' . $rss_sociable . '"><img alt="" src="' . $full_url . '/rss.png" /></a></li>';
		}

		$twitter_sociable = theme_option( THEME_OPTIONS, 'twitter_sociable' );
		if ( $twitter_sociable ) {
			$out .= '<li><a class="twitter" target="_blank" href="' . $twitter_sociable . '"><img alt="" src="' . $full_url . '/twitter.png"  /></a></li>';
		}

		$facebook_sociable = theme_option( THEME_OPTIONS, 'facebook_sociable' );
		if ( $facebook_sociable ) {
			$out .= '<li><a class="facebook" target="_blank" href="' . $facebook_sociable . '"><img alt=""  src="' . $full_url . '/facebook.png" /></a></li>';
		}

		$linkedin_sociable = theme_option( THEME_OPTIONS, 'linkedin_sociable' );
		if ( $linkedin_sociable ) {
			$out .= '<li><a class="linkedin" target="_blank" href="' . $linkedin_sociable . '"><img alt="" src="' . $full_url . '/linkedin.png" /></a></li>';
		}

		$dribbble_sociable = theme_option( THEME_OPTIONS, 'dribbble_sociable' );
		if ( $dribbble_sociable ) {
			$out .= '<li><a class="dribbble" target="_blank" href="' . $dribbble_sociable . '"><img alt=""  src="' . $full_url . '/dribbble.png" /></a></li>';
		}
		$google_sociable = theme_option( THEME_OPTIONS, 'google_sociable' );
		if ( $google_sociable  ) {
			$out .= '<li><a class="google" target="_blank" href="' . $google_sociable  . '"><img alt=""  src="' . $full_url . '/google.png" /></a></li>';
		}
		$pinterest_sociable = theme_option( THEME_OPTIONS, 'pinterest_sociable' );
		if ( $pinterest_sociable ) {
			$out .= '<li><a class="pinterest" target="_blank" href="' . $pinterest_sociable . '"><img alt=""  src="' . $full_url . '/pinterest.png"  /></a></li>';
		}

		$delicious_sociable = theme_option( THEME_OPTIONS, 'delicious_sociable' );
		if ( $delicious_sociable ) {
			$out .= '<li><a class="delicious" target="_blank" href="' . $delicious_sociable . '"><img alt=""  src="' . $full_url . '/delicious.png" /></a></li>';
		}

		$digg_sociable = theme_option( THEME_OPTIONS, 'digg_sociable' );
		if ( $digg_sociable ) {
			$out .= '<li><a class="digg" target="_blank" href="' . $digg_sociable . '"><img alt=""  src="' . $full_url . '/digg.png" /></a></li>';
		}

		$flickr_sociable = theme_option( THEME_OPTIONS, 'flickr_sociable' );
		if ( $flickr_sociable ) {
			$out .= '<li><a class="flickr" target="_blank" href="' . $flickr_sociable . '"><img alt=""  src="' . $full_url . '/flickr.png" /></a></li>';
		}

		$deviantart_sociable = theme_option( THEME_OPTIONS, 'deviantart_sociable' );
		if ( $deviantart_sociable ) {
			$out .= '<li><a class="deviantart" target="_blank" href="' . $deviantart_sociable . '"><img alt=""  src="' . $full_url . '/deviantart.png" /></a></li>';
		}

		$tumblr_sociable = theme_option( THEME_OPTIONS, 'tumblr_sociable' );
		if ( $tumblr_sociable ) {
			$out .= '<li><a class="tumblr" target="_blank" href="' . $tumblr_sociable . '"><img alt=""  src="' . $full_url . '/tumblr.png" /></a></li>';
		}

		$stumbleupon_sociable = theme_option( THEME_OPTIONS, 'stumbleupon_sociable' );
		if ( $stumbleupon_sociable ) {
			$out .= '<li><a class="stumble" target="_blank" href="' . $stumbleupon_sociable . '"><img alt=""  src="' . $full_url . '/stumble.png"  /></a></li>';
		}

		$blogger_sociable = theme_option( THEME_OPTIONS, 'blogger_sociable' );
		if ( $blogger_sociable ) {
			$out .= '<li><a class="blogger" target="_blank" href="' . $blogger_sociable . '"><img alt=""  src="' . $full_url . '/blogger.png"  /></a></li>';
		}
		$behance_sociable = theme_option( THEME_OPTIONS, 'behance_sociable' );
		if ( $behance_sociable ) {
			$out .= '<li><a class="behance" target="_blank" href="' . $behance_sociable . '"><img alt=""  src="' . $full_url . '/behance.png"  /></a></li>';
		}


		$lastfm_sociable = theme_option( THEME_OPTIONS, 'lastfm_sociable' );
		if ( $lastfm_sociable ) {
			$out .= '<li><a class="lastfm" target="_blank" href="' . $lastfm_sociable . '"><img alt=""  src="' . $full_url . '/lastfm.png"  /></a></li>';
		}


		$skype_sociable = theme_option( THEME_OPTIONS, 'skype_sociable' );
		if ( $skype_sociable ) {
			$out .= '<li><a class="skype" target="_blank" href="' . $skype_sociable . '"><img alt=""  src="' . $full_url . '/skype.png"  /></a></li>';
		}
		$vimeo_sociable = theme_option( THEME_OPTIONS, 'vimeo_sociable' );
		if ( $stumbleupon_sociable ) {
			$out .= '<li><a class="vimeo" target="_blank" href="' . $vimeo_sociable . '"><img alt=""  src="' . $full_url . '/vimeo.png"  /></a></li>';
		}
		$wordpress_sociable = theme_option( THEME_OPTIONS, 'wordpress_sociable' );
		if ( $wordpress_sociable ) {
			$out .= '<li><a class="wordpress" target="_blank" href="' . $wordpress_sociable . '"><img alt=""  src="' . $full_url . '/wordpress.png"  /></a></li>';
		}
		$yahoo_sociable = theme_option( THEME_OPTIONS, 'yahoo_sociable' );
		if ( $yahoo_sociable ) {
			$out .= '<li><a class="yahoo" target="_blank" href="' . $yahoo_sociable . '"><img alt=""  src="' . $full_url . '/yahoo.png"  /></a></li>';
		}

		$youtube_sociable = theme_option( THEME_OPTIONS, 'youtube_sociable' );
		if ( $youtube_sociable ) {
			$out .= '<li><a class="youtube" target="_blank" href="' . $youtube_sociable . '"><img alt=""  src="' . $full_url . '/youtube.png"  /></a></li>';
		}
		$out .= '</ul><div class="clearboth"></div></div>';
		echo $out;
	}






	function blog_related_posts() {
		global $single_layout;
		global $post;
		$backup             = $post;
		$tags               = wp_get_post_tags( $post->ID );
		$tagIDs             = array();
		$related_post_found = false;

		$showposts = 3;
		$width = 200;
		$height = 140;
		if ( $single_layout == 'full' ) {
			$showposts = 4;
			$width = 220;
			$height = 160;
		}

		if ( $tags ) {
			$tagcount = count( $tags );
			for ( $i = 0; $i < $tagcount; $i++ ) {
				$tagIDs[ $i ] = $tags[ $i ]->term_id;
			} //$i = 0; $i < $tagcount; $i++
			$related = new WP_Query( array(
					'tag__in' => $tagIDs,
					'post__not_in' => array(
						$post->ID
					),
					'showposts' => $showposts,
					'ignore_sticky_posts' => 1
				) );

			$output = '';
			if ( $related->have_posts() ) {
				$related_post_found = true;
				$output .= '<section class="single_post_list">';
				$output .= __( '<h4>Related Posts</h4>', 'theme_frontend' );
				$output .= '<ul>';
				while ( $related->have_posts() ) {
					$related->the_post();
					$output .= '<li>';
					$output .='<div class="image_container">';
					$output .='<span class="image_frame" style="width:'.$width.'px; height:'.$height.'px;">';
					$output .= '<a class="thumbnail hover_effect" href="' . get_permalink() . '" title="' . get_the_title() . '">';
					if ( has_post_thumbnail() ) {
						$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );
						//$image_src       = TIMTHUMB . '?src=' . get_image_src( $image_src_array[ 0 ] ) . '&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1&amp;q=100';

						$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
						$enable_retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
						
						$image_src  = theme_img_resize( $image_src_array[ 0 ], $width, $height, $enable_image_cropping, $enable_retina_images );

						$output .= '<img src="' . get_image_src( $image_src['url'], THEME_ADMIN_ASSETS_URI."/images/default/carousel.png") . '" alt="' . get_the_title() . '" style="width:'.$width.'px; height:'.$height.'px;" />';
					}
					$output .= '<span class="image_overlay"></span><span class="hover_icon zoom_icon" style="left:'.($width/2-25) .'px"></span></a></span></div>';
					$output .= '<h5><a class="title" href="' . get_permalink() . '" title="' . get_the_title() . '" rel="bookmark">' . get_the_title() . '</a></h5>';
					$output .= '<div class="clearboth"></div>';
					$output .= '</li>';
				} //$related->have_posts()
				$output .= '</ul>';
				$output .= '</section>';
			} //$related->have_posts()
			$post = $backup;
		} //$tags
		if ( !$related_post_found ) {
			$recent = new WP_Query( array(
					'showposts' => $showposts,
					'nopaging' => 0,
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1
				) );

			$output = '';
			if ( $recent->have_posts() ) {
				$output .= '<section class="single_post_list">';
				$output .= __( '<h4>Recent Posts</h4>', 'theme_frontend' );
				$output .= '<ul>';
				while ( $recent->have_posts() ) {
					$recent->the_post();
					$output .= '<li>';
					$output .='<div class="image_container">';
					$output .='<span class="image_frame" style="width:'.$width.'px; height:'.$height.'px;">';
					$output .= '<a class="thumbnail hover_effect" href="' . get_permalink() . '" title="' . get_the_title() . '">';
					if ( has_post_thumbnail() ) {
						$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
						//$image_src       = TIMTHUMB . '?src=' . get_image_src( $image_src_array[ 0 ] ) . '&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1&amp;q=100';

						$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
						$enable_retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
						$image_src  = theme_img_resize( $image_src_array[ 0 ], $width, $height, $enable_image_cropping, $enable_retina_images );

						$output .= '<img src="' . get_image_src( $image_src['url'] ) . '" alt="' . get_the_title() . '" />';
					}
					$output .= '<span class="image_overlay"></span><span class="hover_icon hyperlink_icon" style="left:'.($width/2-25) .'px" ></span></a></span></div>';
					$output .= '<h5><a class="title" href="' . get_permalink() . '" title="' . get_the_title() . '" rel="bookmark">' . get_the_title() . '</a></h5>';
					$output .= '<div class="clearboth"></div>';
					$output .= '</li>';
				}
				$output .= '</ul>';
				$output .= '</section>';
			}
		}
		wp_reset_postdata();
		echo $output;
	}



function blog_related_news() {
		global $single_layout;
		global $post;
		$backup             = $post;
		
		
		$categories = wp_get_object_terms( $post->ID, 'news_category' );
		$catSlugs             = array();
		$related_post_found = false;

		$showposts = 3;
		$width = 200;
		$height = 140;
		
		if ( $single_layout == 'full' ) {
			$showposts = 4;
			$width = 220;
			$height = 160;
		}


		if ( $categories ) {
			$catacount = count( $categories );
			for ( $i = 0; $i < $catacount; $i++ ) {
				$catSlugs[ $i ] = $categories[ $i ]->slug;
			}
			
			$related = new WP_Query( array(
					'post_type' => 'news',
					'post__not_in' => array($post->ID),
					'showposts' => $showposts,
					'tax_query'=>array(
						array(
						'taxonomy' => 'news_category',
						'field' => 'slug',
						'terms' => $catSlugs
						)
					)
					
		));

			$output = '';
			if ( $related->have_posts() ) {
				$related_post_found = true;
				$output .= '<section class="single_post_list">';
				$output .= __( '<h4>Related News</h4>', 'theme_frontend' );
				$output .= '<ul>';
				while ( $related->have_posts() ) {
					$related->the_post();
					$output .= '<li>';
					$output .='<div class="image_container">';
					$output .='<span class="image_frame" style="width:'.$width.'px; height:'.$height.'px;">';
					$output .= '<a class="thumbnail hover_effect" href="' . get_permalink() . '" title="' . get_the_title() . '">';
					if ( has_post_thumbnail() ) {
						$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );
						//$image_src       = TIMTHUMB . '?src=' . get_image_src( $image_src_array[ 0 ] ) . '&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1&amp;q=100';

						$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
						$enable_retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
						
						$image_src  = theme_img_resize( $image_src_array[ 0 ], $width, $height, $enable_image_cropping, $enable_retina_images );

						$output .= '<img src="' . get_image_src( $image_src['url'], THEME_ADMIN_ASSETS_URI."/images/default/carousel.png") . '" alt="' . get_the_title() . '" style="width:'.$width.'px; height:'.$height.'px;" />';
					}
					$output .= '<span class="image_overlay"></span><span class="hover_icon zoom_icon" style="left:'.($width/2-25) .'px"></span></a></span></div>';
					$output .= '<h5><a class="title" href="' . get_permalink() . '" title="' . get_the_title() . '" rel="bookmark">' . get_the_title() . '</a></h5>';
					$output .= '<div class="clearboth"></div>';
					$output .= '</li>';
				} //$related->have_posts()
				$output .= '</ul>';
				$output .= '</section>';
			} //$related->have_posts()
			$post = $backup;
		} //$tags
		if ( !$related_post_found ) {
			$recent = new WP_Query( array(
			        'post_type' => 'news',
					'post__not_in' => array($post->ID),
					'showposts' => $showposts,
					'nopaging' => 0,
					'post_status' => 'publish',
					'ignore_sticky_posts' => 1
				) );

			$output = '';
			if ( $recent->have_posts() ) {
				$output .= '<section class="single_post_list">';
				$output .= __( '<h4>Recent News</h4>', 'theme_frontend' );
				$output .= '<ul>';
				while ( $recent->have_posts() ) {
					$recent->the_post();
					$output .= '<li>';
					$output .='<div class="image_container">';
					$output .='<span class="image_frame" style="width:'.$width.'px; height:'.$height.'px;">';
					$output .= '<a class="thumbnail hover_effect" href="' . get_permalink() . '" title="' . get_the_title() . '">';
					if ( has_post_thumbnail() ) {
						$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
						//$image_src       = TIMTHUMB . '?src=' . get_image_src( $image_src_array[ 0 ] ) . '&amp;h='.$height.'&amp;w='.$width.'&amp;zc=1&amp;q=100';

						$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
						$enable_retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
						$image_src  = theme_img_resize( $image_src_array[ 0 ], $width, $height, $enable_image_cropping, $enable_retina_images );

						$output .= '<img src="' . get_image_src( $image_src['url'] ) . '" alt="' . get_the_title() . '" />';
					}
					$output .= '<span class="image_overlay"></span><span class="hover_icon hyperlink_icon" style="left:'.($width/2-25) .'px" ></span></a></span></div>';
					$output .= '<h5><a class="title" href="' . get_permalink() . '" title="' . get_the_title() . '" rel="bookmark">' . get_the_title() . '</a></h5>';
					$output .= '<div class="clearboth"></div>';
					$output .= '</li>';
				}
				$output .= '</ul>';
				$output .= '</section>';
			}
		}
		wp_reset_postdata();
		echo $output;
	}


	function carousel() { global $post;

		wp_enqueue_script( 'jquery-caroufredsel' );
		$showposts       = theme_option( THEME_OPTIONS, 'carousel_showposts_num' );
		$post_type       = theme_option( THEME_OPTIONS, 'carousel_post_type' );
		$order       = theme_option( THEME_OPTIONS, 'carousel_order' );
		$offset = theme_option( THEME_OPTIONS, 'carousel_offset' );
		$orderby       = theme_option( THEME_OPTIONS, 'carousel_orderby' );
		$title           = theme_option( THEME_OPTIONS, 'disable_title' );
		$disable_cats  = theme_option( THEME_OPTIONS, 'carousel_disable_cats' );
		$animation_speed = theme_option( THEME_OPTIONS, 'animation_speed' );
		$post_category  = theme_option( THEME_OPTIONS, 'post_category_filter' );
		$portfolio_category  = theme_option( THEME_OPTIONS, 'portfolio_category_filter' );
		$auto     = theme_option( THEME_OPTIONS, 'carousel_auto' );
		$carousel_easing  = theme_option( THEME_OPTIONS, 'carousel_easing' );
		if ( is_array( $post_category ) ) {
			$posts_cats = implode( ",", $post_category );
		}

		if ( is_array( $portfolio_category ) ) {
			$portfolio_categories = implode( ",", $portfolio_category );
		}

?>
<div class="inner carousel_responsive">
<div class="home_list_carousel responsive">
<ul id="hc_carousel" class="homepage_carousel">

<?php


		if ( $post_type == "posts" ):
			$query =  array(
				'post_type' => 'post',
				'showposts' => $showposts,
				'nopaging' => 0,
				'cat' => $posts_cats,
				'orderby' => $orderby,
				'order' => $order,
				'offset' => $offset
			);

		elseif ( $post_type == "portfolio" ):
			$query = array(
				'post_type' => 'portfolio',
				'showposts' => $showposts,
				'nopaging' => 0,
				'orderby' => $orderby,
				'order' => $order,
				'offset' => $offset,
			);

		if ( $portfolio_categories != '' ) {
			global $wp_version;
			if ( version_compare( $wp_version, "3.1", '>=' ) ) {
				$query['tax_query'] = array(
					array(
						'taxonomy' => 'portfolio_category',
						'field' => 'slug',
						'terms' => explode( ',', $portfolio_categories )
					)
				);
			}else {
				$query['taxonomy'] = 'portfolio_category';
				$query['term'] = $portfolio_categories;
			}
		}

		endif;

		$r = new WP_Query( $query );

		$output  = '';
		if ( $r->have_posts() ) {
			while ( $r->have_posts() ) {

				$r->the_post();
				$output .= '<li>';
				$output .= '<a class="thumbnail" href="' . get_permalink() . '" title="' . get_the_title() . '">';
				if ( has_post_thumbnail() ) {
					$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', false );
					//$image_src       = TIMTHUMB . '?src=' . get_image_src( $image_src_array[ 0 ] ) . '&amp;h=280&amp;w=220&amp;zc=1&amp;q=100';

					$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
					//$enable_retina_images = theme_option(THEME_OPTIONS,'enable_retina_images') === 'true'? true: false;
					$image_src  = theme_img_resize( $image_src_array[ 0 ], 220, 160, $enable_image_cropping, false );

					$output .= '<img src="' . get_image_src( $image_src['url'], THEME_ADMIN_ASSETS_URI."/images/default/carousel.png") . '" alt="' . get_the_title() . '" /><div class="carousel-inner-mask"></div>';
				}


				$output .= '<div class="carousel-extra-info">';
				if ( $title =='true' ) {
					$output .= '<span class="title">' . get_the_title() . '</span>';
				} //$title
				if ( $disable_cats =='true' ) {
					$output .= '<span class="carousel-category">';
					if ( $post_type == "portfolio" ) {
						$terms = get_the_terms( get_the_id(), 'portfolio_category' );
						$terms_name = array();
						if ( is_array( $terms ) ) {
							foreach ( $terms as $term ) {
								$terms_name[] = $term->name;
							}
						}
						$output .= '<span class="category-item">' . implode( ',', $terms_name ) . ' </span>';

					} else {

						foreach ( ( get_the_category() ) as $category ) {
							$output .= '<span class="category-item">' . $category->cat_name . ' </span>';
						}
					}

					$output .= '</span>';



				} //$date
				$output .= '</div>';
				$output .= '</a>';
				$output .= '</li>';
			}
		}
		wp_reset_postdata();
		echo $output;
?>
</ul>
<div class="clearboth"></div>
<a id="home_carousel_prev" class="home_carousel_prev" href="#"></a>
<a id="home_carousel_next" class="home_carousel_next" href="#"></a>
  </div>
</div>
    <script type="text/javascript">
	jQuery(document).ready(function($) {
	jQuery('#hc_carousel').carouFredSel({
				responsive: true,
				prev: '#home_carousel_prev',
				next: '#home_carousel_next',
				width: '100%',
				scroll: 1,
				align:'center',
				items: {
					width: 280,
					visible: {
						min: 1,
						max: 4
							}
						},

				auto :{
					play : <?php echo $auto; ?>,
					easing : "<?php echo $carousel_easing; ?>",
					duration : <?php echo $animation_speed; ?>
					},

				});
});

    </script>
   <?php
	}

	function slideShow( $post_id = NULL ) {
		global $post;
		if ( isset( $_GET["slideshow_type"] ) ) {
			$slideshow_type = $_GET["slideshow_type"];
		} else {
			if ( is_singular() ) {
				$slideshow_type = get_post_meta( $post_id, '_slideshow_source', true );
			} else {
				$slideshow_type = theme_option( THEME_OPTIONS, 'slideshow_source' );
			}
		}

		if ( isset( $_GET["enable_slideshow"] ) ) {
			$enable_slideshow = $_GET["enable_slideshow"];
		} else {
			$enable_slideshow = theme_option( THEME_OPTIONS, 'enable_slideshow' );
		}



		$page_post_enable = get_post_meta( $post_id, '_enable_slidehsow_for_singular', true );



		if ( $enable_slideshow != 'true' ) {
			return;
		}

		if ( !is_home() && $page_post_enable != 'true' ) {
			return;
		}


		switch ( $slideshow_type ) {
		case 'anything_slider' :
			$this->slideShow_anything_slider( $post_id );
			break;
		case 'flexslider' :
			$this->slideShow_flexslider( $post_id );
			break;
		}

	}
	function slideShow_getImages( $size = array( 1920, 410 ), $post_id ) {
		global $post;
		if ( isset( $_GET["slideshow_type"] ) ) {
			$slideshow_type = $_GET["slideshow_type"];
		} else {
			$slideshow_type = theme_option( THEME_OPTIONS, 'slideshow_source' );
		}

		$number = theme_option( THEME_OPTIONS, 'slideshow_count' );
		$order = theme_option( THEME_OPTIONS, 'slideshow_order' );
		$orderby = theme_option( THEME_OPTIONS, 'slideshow_orderby' );
		if ( is_home() ) {
			if ( $slideshow_type == 'anything_slider' ) {
				$posts_in = theme_option( THEME_OPTIONS, 'anythingslider_items' );
			}
			elseif ( $slideshow_type == 'flexslider' ) {
				$posts_in = theme_option( THEME_OPTIONS, 'flexslider_items' );

			} else {
				$posts_in = '';
			}

		}
		if ( is_singular() ) {
			$posts_in =  get_post_meta( $post_id, '_slideshow_items_to_show', true );
		}

		$query = array(
			'post_type' => 'slideshow',
		);


		if ( $number && is_home() ) {
			$query['showposts'] = $number;

		}

		if ( $order ) {
			$query['order'] = $order;
		}
		if ( $orderby ) {
			$query['orderby'] = $orderby;
		}
		if ( $posts_in ) {
			$query['post__in'] = $posts_in;
		}

		$loop   = new WP_Query( $query );
		$images = array();
		while ( $loop->have_posts() ):
			$loop->the_post();
		$link_to = get_post_meta( get_the_ID(), '_link_to', true );
		$link    = '';
		if ( !empty( $link_to ) ) {
			$link_array = explode( '||', $link_to );
			switch ( $link_array[ 0 ] ) {
			case 'page':
				$link = get_page_link( $link_array[ 1 ] );
				break;
			case 'cat':
				$link = get_category_link( $link_array[ 1 ] );
				break;
			case 'portfolio':
				$link = get_permalink( $link_array[ 1 ] );
				break;
			case 'post':
				$link = get_permalink( $link_array[ 1 ] );
				break;
			case 'manually':
				$link = $link_array[ 1 ];
				break;
			}
		}

		$image_src_array = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full', true );
		$images[ ] = array(
			'title' => get_the_title(),
			'id'=> get_the_id(),
			'desc' => get_post_meta( get_the_ID(), '_description', true ),
			'item_style' => get_post_meta( get_the_ID(), '_item_style', true ),
			'video_id' => get_post_meta( get_the_ID(), '_video_id', true ),
			'video_site' => get_post_meta( get_the_ID(), '_video_site', true ),
			'button_text' => get_post_meta( get_the_ID(), '_button_text', true ),
			'slider_bg_color' => get_post_meta( get_the_ID(), '_slider_bg_color', true ),
			'slider_bg_texture' => get_post_meta( get_the_ID(), '_slideshow_item_background_textures', true ),
			'slider_text_color' => get_post_meta( get_the_ID(), '_slider_desc_color', true ),
			'slider_title_color'=> get_post_meta( get_the_ID(), '_slider_title_color', true ),
			'disable_button' => get_post_meta( get_the_ID(), '_disable_slideshow_button', true ),
			'image_margin' => get_post_meta( get_the_ID(), '_slider_image_margin', true ),
			'desc_margin' => get_post_meta( get_the_ID(), '_slider_description_margin_top', true ),
			'button_skin' => get_post_meta( get_the_ID(), '_button_background_color', true ),
			'src' => get_image_src( $image_src_array[0] ),
			'link' => $link
		);
		endwhile;
		wp_reset_postdata();
		return $images;
	}


	function slideShow_anything_slider( $post_id = NULL ) {
		$number = theme_option( THEME_OPTIONS, 'slideshow_count' );
		$scheme_main_color = theme_option( THEME_OPTIONS, 'scheme_main_color' );
		$anything_control_style = theme_option( THEME_OPTIONS, 'anything_control_style' );
		wp_print_scripts( 'anythingslider_fx' );
		wp_print_scripts( 'anythingslider' );
		wp_print_scripts( 'anythingslider_video' );
		wp_print_scripts( 'jquery-easing' );
		wp_enqueue_script( 'anything-init' );

		$output = '<div class="anythingslider slideshow_section">';
		$output .= '<div class="anythingslider_wrapper control_'.$anything_control_style.'_style">';
		$output .= '<ul id="anything_slider" >';
		$image_width= 1920;
		$image_height = 410;
		$images   = $this->slideShow_getImages( 'full', $post_id );
		foreach ( $images as $image ) {
			$item_style = $image[ 'item_style' ];
			$button_text = $image['button_text'];
			$video_id = $image['video_id'];
			$video_site = $image['video_site'];
			$title = $image[ 'title' ];
			$desc  = $image[ 'desc' ];
			$slider_bg_color = $image['slider_bg_color'];
			$desc_color  = $image[ 'slider_text_color' ];
			$title_color = $image['slider_title_color'];
			$disable_button  = $image[ 'disable_button' ];
			$slider_bg_texture = $image['slider_bg_texture'];
			$desc_margin_top = $image['desc_margin'];
			$image_margin = $image['image_margin'];
			$button_skin = $image['button_skin'];
			$id = $image['id'];
			$output .= '<li id="slider_'.$id.'">' . "\n\n";

			if ( $slider_bg_texture == 'gradient.png' ) {
				$repeat = 'center bottom repeat-x ';
			} else {
				$repeat ='';
			}
			
			if ( $slider_bg_texture != '' && $slider_bg_texture != 'none' && $slider_bg_texture != 'gradient' ) {
				$slide_item_bg = 'url('.$slider_bg_texture .')';
			} elseif ( $slider_bg_texture == 'none' ) {
				$slide_item_bg = '';
			} elseif ( $slider_bg_texture == 'gradient' ) {
				$slide_item_bg = 'url('. THEME_IMAGES .'/textures/gradient.png)';
			}

			$output .= '<div class="'. $item_style .' anything_item" '. 'style="background:'.$slider_bg_color.' '.$slide_item_bg.' ' . $repeat . '">';


			// Full Width
			if ( $item_style == 'full_width' ) :
				
				if ( $image[ 'link' ] ) {
					$output .= '<a class="full_image" href="' . $image[ 'link' ] . '"><img src="' . get_image_src( $image[ 'src' ] ) . '" /></a></div>';
				} else {
				$output .= '<img class="full_image" src="' . get_image_src( $image[ 'src' ] ) . '" />';
			}

			// With Caption
			elseif ( $item_style == 'with_caption' ) :
				$output .= '<div class="with_caption">';
			$output .= '<img class="full_image" src="' . get_image_src( $image[ 'src' ] ) . '" />';
			$output .= '<div class="inner with_caption_wrapper">';
			$output .= '<div class="desc_box"  style="margin-top:'.( empty( $desc_margin_top ) ? 30 : $desc_margin_top ).'px">';
			$output .= !empty( $title ) ? '<h2 style="color:'. ( $desc_color ? $desc_color : '#fff' ).'">'.$title.'</h2>' : '';
			$output .= !empty( $desc ) ? '<p style="color:'. ( $desc_color ? $desc_color : '#fff' ).'">'.$desc.'</p>' : '';
			if ( $disable_button != 'false' ) {
				$output .= '<a class="ws-button medium '.( empty( $button_skin ) ? 'dark_gray' : $button_skin ).'" href="' . $image[ 'link' ] . '"><span><span>'.$button_text.'</span></span></a>';
			}
			$output .= '</div></div>';


			// with description
			elseif ( $item_style == 'with_description' ) :
				$output .= '<div class="inner with_desc_wrapper">';
			$output .= '<div class="desc_box" style="margin-top:'.( empty( $desc_margin_top ) ? 30 : $desc_margin_top ).'px">';
			$output .= !empty( $title ) ? '<h2 style="color:'. ( $title_color ? $title_color : '#fff' ).'">'.$title.'</h2>' : '';
			$output .= !empty( $desc ) ? '<p style="color:'. ( $desc_color ? $desc_color : '#fff' ).'">'.$desc.'</p>' : '';
			if ( $disable_button != 'false' ) {
				$output .= '<a class="ws-button medium '.( empty( $button_skin ) ? 'dark_gray' : $button_skin ).'" href="' . $image[ 'link' ] . '"><span><span>'.$button_text.'</span></span></a>';
			}
			$output .= '</div>';


			if ( $video_id ) {
				if ( $video_site == 'vimeo' ) {
					$output .= '<div style=" padding:30px 0;" class="video-wrapper"><div class="video-container"><iframe src="http://player.vimeo.com/video/'.$video_id.'?title=0&amp;byline=0&amp;portrait=0&amp;color='.str_replace( "#", "", $scheme_main_color ).'" width="500" height="310" style="border:none" ></iframe></div></div>';
				}
				if ( $video_site == 'youtube' ) {
					$output .= '<div style="padding:30px 0;" class="video-wrapper"><div class="video-container"><iframe width="500" height="340" src="http://www.youtube.com/embed/'.$video_id.'?rel=0&amp;showinfo=0" style="border:none"></iframe></div></div>';
				}

			} else {

				if ( $image[ 'link' ] ) {
					$output .= '<a href="' . $image[ 'link' ] . '"><img style="margin:'.( empty( $image_margin ) ? 10 : $image_margin ).'px auto;" class="slide_image with_desc"  src="' . get_image_src( $image[ 'src' ] ) . '" /></a>';
				} else {
					$output .= '<img style="margin:'.( empty( $image_margin ) ? 10 : $image_margin ).'px auto;" class="slide_image with_desc"  src="' . get_image_src( $image[ 'src' ] ) . '" />';
				}
			}
			$output .= '<div class="clearboth"></div></div>';
			endif;
			// with description
			$output .= '</div>';
			$output .='</li>'. "\n\n";
		}

		$output .= '</ul>';
		$output .= '</div></div>';
		echo $output;

		$options = array(
			'easing' => theme_option( THEME_OPTIONS, 'anything_easing' ),
			'autoPlay' => theme_option( THEME_OPTIONS, 'anything_autoplay' ),
			'pauseOnHover' => theme_option( THEME_OPTIONS, 'anything_pauseOnHover' ),
			'delay' => theme_option( THEME_OPTIONS, 'anything_delay' ),
			'animationTime' => theme_option( THEME_OPTIONS, 'anything_animation_time' ),
			'mode' => theme_option( THEME_OPTIONS, 'anything_effect' ),
			'arrows' => theme_option( THEME_OPTIONS, 'anything_arrows' ),
			'pagination' => theme_option( THEME_OPTIONS, 'anything_pagination' ),
			'boxed_layout'=>theme_option( THEME_OPTIONS, 'background_selector_orientation' ),
			'anim_enable' => theme_option( THEME_OPTIONS, 'anything_anim_enable' ),
			'anim_title' => theme_option( THEME_OPTIONS, 'anything_anim_title' ),
			'anim_desc' => theme_option( THEME_OPTIONS, 'anything_anim_desc' ),
			'anim_button' => theme_option( THEME_OPTIONS, 'anything_anim_button' ),
			'anim_icon_image' => theme_option( THEME_OPTIONS, 'anything_anim_icon_image' ),
			'anim_full_image' => theme_option( THEME_OPTIONS, 'anything_anim_full_image' ),
			'anim_easing' => theme_option( THEME_OPTIONS, 'anything_anim_easing' ),
			'anim_speed' => theme_option( THEME_OPTIONS, 'anything_anim_speed' )
		);

		echo "\n<script type=\"text/javascript\">\n";
		echo "var slideShow = []; \n";
		foreach ( $options as $key => $value ) {
			if ( is_bool( $value ) ) {
				$value = $value == 'true' ? "true" : "false";
			} elseif ( $value!="true"&&$value!="false" ) {
				$value = "'" . $value . "'";
			}
			echo "slideShow['" . $key . "'] = " . $value . "; \n";
		}
		echo "</script>\n";
	}



	function slideShow_flexslider( $post_id ) {
		$number = theme_option( THEME_OPTIONS, 'slideshow_count' );
		$slideshow_height = theme_option( THEME_OPTIONS, 'flexslider_height' );
		$layout = theme_option( THEME_OPTIONS, 'flexslider_layout' );
		$animation = theme_option( THEME_OPTIONS, 'flexslider_animation' );
		$slideDirection = theme_option( THEME_OPTIONS, 'flexslider_slideDirection' );
		$slideshow = theme_option( THEME_OPTIONS, 'flexslider_slideshow' );
		$slideshowSpeed = theme_option( THEME_OPTIONS, 'flexslider_slideshowSpeed' );
		$animationDuration = theme_option( THEME_OPTIONS, 'flexslider_animationDuration' );
		$pauseOnHover = theme_option( THEME_OPTIONS, 'flexslider_pauseOnHover' );
		$disableCaption = theme_option( THEME_OPTIONS, 'flexslider_disableCaption' );

		wp_print_scripts( 'jquery-flexslider' );
		$random_id       = rand( 100, 9999 );


		if ( $layout == 'full_width' ) {
			$width = 1920;
		}
		elseif ( $layout == 'boxed' ) {
			$width = 960;
		}

		
		
		$output = '<div style="width:'.$width.'px;" class="flexslider_slideshow '.$layout.' flex-container '.$animation.' slideshow_section">';
		$output .= '<div class="flexslider" id="flexslider_'.$random_id.'" >';
		$output .= '<ul class="slides" >';
		$images   = $this->slideShow_getImages( 'full', $post_id );
		foreach ( $images as $image ) {
			$button_text = $image['button_text'];
			$title = $image[ 'title' ];
			$desc  = $image[ 'desc' ];
			$disable_button  = $image[ 'disable_button' ];
			$button_skin = $image['button_skin'];

			if ( $layout == 'full_width' ) {
				//$image_src = TIMTHUMB . '?src=' . get_image_src( $image[ 'src' ] ) . '&amp;h='.$slideshow_height.'&amp;zc=1&amp;q=100';
				$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
				$enable_retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
				$image_src  = theme_img_resize( $image[ 'src' ], 9999, $slideshow_height, $enable_image_cropping, $enable_retina_images );
			}
			elseif ( $layout == 'boxed' ) {
				//$image_src = TIMTHUMB . '?src=' . get_image_src( $image[ 'src' ] ) . '&amp;h='.$slideshow_height.'&amp;w=960&amp;zc=1&amp;q=100';
				$enable_image_cropping = theme_option( THEME_OPTIONS, 'disable_image_cropping' ) === 'true'? true: false;
				$enable_retina_images = theme_option( THEME_OPTIONS, 'enable_retina_images' ) === 'true'? true: false;
				$image_src  = theme_img_resize( $image[ 'src' ], 960, $slideshow_height, $enable_image_cropping, $enable_retina_images );
			}


			$output .= '<li>';
			$output .= '<img alt="" src="' . get_image_src( $image_src['url'] ) . '"  />';
			$output .= '<div class="inner">';
			if ( ( !empty( $title ) || !empty( $desc ) ) && $disableCaption != 'false' ) {
				$output .= '<div class="flex-caption">';
				$output .= !empty( $title ) ? '<h2>'.$title.'</h2>' : '';
				$output .= !empty( $desc ) ? '<p>'.$desc.'</p>' : '';
				if ( $disable_button != 'false' ) {
					$output .= '<a class="ws-button medium '.( empty( $button_skin ) ? 'dark_gray' : $button_skin ).'" href="' . $image[ 'link' ] . '"><span><span>'.$button_text.'</span></span></a>';
				}
				$output .= '</div>';
			}

			$output .='</div></li>';
		}

		$output .= '</ul>';
		$output .= '';
		$output .='<div id="flexSlider-shandows"></div>';
		$output .= '</div></div>';
		
		$output .= <<<HTML
<script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery('#flexslider_{$random_id}').flexslider({
			animation: "{$animation}",
			slideDirection: "{$slideDirection}",
			slideshow: {$slideshow},
			slideshowSpeed: {$slideshowSpeed},
			animationDuration: {$animationDuration},
			pauseOnHover: {$pauseOnHover},
			prevText: "",
			nextText: "",
			pauseText: '',
			playText: ''
});

});

</script>
HTML;

		echo $output;

	}

}
function theme_function( $function ) {
	global $_theme_function;
	$_theme_function = new theme_function;
	$args             = array_slice( func_get_args(), 1 );
	return call_user_func_array( array(
			&$_theme_function,
			$function
		), $args );
}

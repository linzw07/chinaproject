<?php

global $theme_options;

function theme_option( $page, $name = NULL ) {
	global $theme_options;
	if ( $name == NULL ) {
		if ( isset( $theme_options[$page] ) ) {
			return $theme_options[$page];
		} else {
			return false;
		}
	} else {
		if ( isset( $theme_options[$page][$name] ) ) {
			return $theme_options[$page][$name];
		} else {
			return false;
		}
	}
}

function filter_ptags_on_images( $content ) {
	return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}

add_filter( 'the_content', 'filter_ptags_on_images' );


remove_filter ( 'the_content',  'wpautop' );
remove_filter ( 'comment_text', 'wpautop' );

function theme_get_excluded_pages() {
	$excluded_pages = theme_option( THEME_OPTIONS, 'excluded_pages' );
	$home = theme_option( THEME_OPTIONS, 'home_page' );
	if ( ! empty( $excluded_pages ) ) {
		$excluded_pages_with_childs = '';
		foreach ( $excluded_pages as $parent_page_to_exclude ) {
			if ( $excluded_pages_with_childs ) {
				$excluded_pages_with_childs .= ',' . $parent_page_to_exclude;
			} else {
				$excluded_pages_with_childs = $parent_page_to_exclude;
			}
			$descendants = get_pages( 'child_of=' . $parent_page_to_exclude );
			if ( $descendants ) {
				foreach ( $descendants as $descendant ) {
					$excluded_pages_with_childs .= ',' . $descendant->ID;
				}
			}
		}
		if ( $home ) {
			$excluded_pages_with_childs .= ',' .$home;
		}
	} else {
		$excluded_pages_with_childs = $home;
	}
	return $excluded_pages_with_childs;
}


function is_blog() {
	global $post;
	global $is_blog;
	if ( $is_blog == true ) {return true;}
	$blog_page_id = theme_option( THEME_OPTIONS, 'blog_page' );
	if ( isset( $post->ID ) ) {
		if ( $blog_page_id == $post->ID ) {
			$is_blog = true;
			return true;
		}
	}
	return false;
}




if ( !function_exists( "get_queried_object_id" ) ) {
	function get_queried_object_id() {
		global $wp_query;
		return $wp_query->get_queried_object_id();
	}
}





function seo_meta() {
	global $post;
	$url = '';
	$seo_meta = '';
	$keywords= '';
	$description ='';
	if ( theme_option( THEME_OPTIONS, 'disable_seo' )  == 'true' ) {
		if ( is_home() ) {
			$description = stripcslashes( theme_option( THEME_OPTIONS, 'home_desc' ) );
			$keywords .= stripcslashes( theme_option( THEME_OPTIONS, 'home_tags' ) );
			$url .= home_url();
		}

		if ( is_singular() ) {
			$single_desc = get_post_meta( $post->ID, "_seo_desc", true );

				if ( $single_desc ) {
					$description = $single_desc;
				} else {
					$description = stripcslashes( theme_option( THEME_OPTIONS, 'home_desc' ) );
				}


			if ( theme_option( THEME_OPTIONS, 'disable_seo_tags' )  == 'true' ) {
				if ( get_post_meta( $post->ID, "_seo_keywords", true ) ) {
					$keywords .= get_post_meta( $post->ID, "_seo_keywords", true );
					$keywords .= ', ';
				} else {
					$tags = get_the_tags( $post->ID );
					if ( $tags ) {
						foreach ( $tags as $tag ) {
							$keywords .= $tag->name . ', ';
						}
						$keywords .= ', ';
					}
				}
			}

			if ( theme_option( THEME_OPTIONS, 'disable_seo_category' )  == 'true' ) {
				$categories = get_the_category( $post->ID );
				if ( $categories ) {
					foreach ( $categories as $category ) {
						$keywords .= $category->name . ', ';
					}
				}
			}


			$url .= get_permalink();

		}



		if($description) {
			$seo_meta .= "\n<meta name='description' content='".$description."' />";
		}
		if($keywords) {
			$seo_meta .= "\n<meta name='keywords' content='".$keywords."' />";
		}
		if ( theme_option( THEME_OPTIONS, 'disable_seo_canonical' ) && isset( $url ) ) {
			$seo_meta .= "\n<link rel='canonical' href='".$url."' />\n";
		}
		if ( ( is_tag() || is_category() || is_archive() ) && theme_option( THEME_OPTIONS, 'disable_seo_noindex' )  == 'true' ) {
			$seo_meta .= '<meta name="robots" content="noindex,follow" />';

		}
		echo '<!-- SEO -->' . $seo_meta . '<!---->';

	}
}


add_action( "wp_head", "seo_meta" );
remove_action( 'wp_head', 'rel_canonical' );



class Walker_Nav_Menu_Dropdown extends Walker_Nav_Menu{
	var $to_depth = -1;
	function start_lvl( &$output, $depth ) {
		$output .= '</option>';
	}

	function end_lvl( &$output, $depth ) {
		$indent = str_repeat( "\t", $depth ); // don't output children closing tag
	}

	function start_el( &$output, $item, $depth, $args ) {

		$indent = ( $depth ) ? str_repeat( "&nbsp;", $depth * 4 ) : '';
		$class_names = $value = '';
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$classes[] = 'menu-item-' . $item->ID;
		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';
		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';
		$value = ' value="'. $item->url .'"';
		$output .= '<option'.$id.$value.$class_names.'>';
		$item_output = $args->before;
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$output .= $indent.$item_output;
	}


	function end_el( &$output, $item, $depth ) {
		if ( substr( $output, -9 ) != '</option>' )
			$output .= "</option>"; // replace closing </li> with the option tag
	}



}

/**
 * Fix the image src for MultiSite
 *
 * @param string  $src the full path of image
 */

function get_image_src($src, $defaultURL="") {
	if($src=="")
	{
		return $defaultURL;
	}
	if(is_multisite()){
		global $blog_id;
		if(is_subdomain_install()){
			if ( defined( 'DOMAIN_MAPPING' ) ){
				if(function_exists('get_original_url')){ 
					if(false !== strpos($src, str_replace(get_original_url('siteurl'),site_url(),get_blog_option($blog_id,'fileupload_url')))){
						return site_url().'/'.str_replace(str_replace(get_original_url('siteurl'),site_url(),get_blog_option($blog_id,'fileupload_url')),get_blog_option($blog_id,'upload_path'),$src);
					}
				}else { 
					global $dm_map;
					if(isset($dm_map)){
						static $orig_urls = array();
						if ( ! isset( $orig_urls[ $blog_id ] ) ) {
							remove_filter( 'pre_option_siteurl', array(&$dm_map, 'domain_mapping_siteurl') );
							$orig_url = get_option( 'siteurl' );
							$orig_urls[ $blog_id ] = $orig_url;
							add_filter( 'pre_option_siteurl', array(&$dm_map, 'domain_mapping_siteurl') );
						}
						if(false !== strpos($src, str_replace($orig_urls[$blog_id],site_url(),get_blog_option($blog_id,'fileupload_url')))){
							return site_url().'/'.str_replace(str_replace($orig_urls[$blog_id],site_url(),get_blog_option($blog_id,'fileupload_url')),get_blog_option($blog_id,'upload_path'),$src);
						}
					}
				}
			}
			if(false !== strpos($src, get_blog_option($blog_id,'fileupload_url'))){
				return site_url().'/'.str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$src);
			}
		}else{
			if ( defined( 'DOMAIN_MAPPING' ) ){
				if(function_exists('get_original_url')){ 
					if(false !== strpos($src, get_blog_option($blog_id,'fileupload_url'))){
						return site_url().'/'.str_replace(str_replace(get_original_url('siteurl'),site_url(),get_blog_option($blog_id,'fileupload_url')),get_blog_option($blog_id,'upload_path'),$src);
					}
				}
			}
			$curSite =  get_current_site(1);

			if(false !== strpos($src, get_blog_option($blog_id,'fileupload_url'))){
				return $curSite->path.str_replace(get_blog_option($blog_id,'fileupload_url'),get_blog_option($blog_id,'upload_path'),$src);
			}
		}
		if(defined('DOMAIN_CURRENT_SITE')){
			if(false !== strpos($src, DOMAIN_CURRENT_SITE)){
				$src = preg_replace('/^https?:\/\//i', '', $src);
				return str_replace(DOMAIN_CURRENT_SITE, '', $src);
			}
		}	
	}else{
		return $src;
	}
	return $src;
	
}




function theme_excerpt_more( $excerpt ) {
	return str_replace( '[...]', '...', $excerpt );
}
add_filter( 'wp_trim_excerpt', 'theme_excerpt_more' );
add_filter( 'get_the_excerpt', 'shortcode_unautop');  
add_filter( 'get_the_excerpt', 'do_shortcode');  
add_filter( 'the_excerpt', 'shortcode_unautop');  
add_filter( 'the_excerpt', 'do_shortcode'); 




function theme_exclude_category_feed() {

	$exclude_cats = theme_option( THEME_OPTIONS, 'excluded_cats' );
	if ( is_array( $exclude_cats ) ) {
		foreach ( $exclude_cats as $key => $cat ) {
			$exclude_cats[$key] = -$cat;
		}
	}
	if ( is_feed() ) {
		set_query_var( "cat", implode( ",", $exclude_cats ) );
	}
}
add_filter( 'pre_get_posts', 'theme_exclude_category_feed' );




/*
 * Remove Blog categories from category widget
 */
function theme_exclude_category_widget( $cat_args ) {
	$exclude_cats = theme_option( THEME_OPTIONS, 'excluded_cats' );

	if ( is_array( $exclude_cats ) ) {
		$cat_args['exclude'] = implode( ",", $exclude_cats );
	}
	return $cat_args;
}
add_filter( 'widget_categories_args', 'theme_exclude_category_widget' );




/*
 * add a span element for style in the page
 */
function theme_comment_style( $return ) {
	return str_replace( $return, "<span></span>$return", $return );
}
add_filter( 'get_comment_author_link', 'theme_comment_style' );

function theme_widget_title_remove_space( $return ) {
	$return = trim( $return );
	if ( '&nbsp;' == $return ) {
		return '';
	}else {
		return $return;
	}
}
add_filter( 'widget_title', 'theme_widget_title_remove_space' );




function theme_widget_text_shortcode( $content ) {
	$content = do_shortcode( $content );
	$new_content = '';
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	$pieces = preg_split( $pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE );

	foreach ( $pieces as $piece ) {
		if ( preg_match( $pattern_contents, $piece, $matches ) ) {
			$new_content .= $matches[1];
		} else {
			$new_content .= do_shortcode( $piece );
		}
	}

	return $new_content;
}

// Allow Shortcodes in Sidebar Widgets
add_filter( 'widget_text', 'theme_widget_text_shortcode' );
add_filter( 'widget_text', 'do_shortcode' );



/* Thanks to Vegard Skjefstad for Huaman difference time function (http://www.vegard.net/) */
function wp_days_ago( $mode = 0, $prepend = "", $append = "",
	$texts = array( "Today", "Yesterday", "One week ago", "days ago", "year", "years", "ago", "day ago", "days ago", "Just now", "One minute ago", "minutes ago", "1 hour ago", "hours ago", "Some time in the future" ) ) {
	$days = round( ( strtotime( date( "Y-m-d", gmmktime() + ( get_option( 'gmt_offset' ) * 3600 ) ) ) - strtotime( date( "Y-m-d", get_the_time( "U" ) ) ) ) / 86400 );
	$minutes = round( ( strtotime( date( "Y-m-d H:i", gmmktime() + ( get_option( 'gmt_offset' ) * 3600 ) ) ) - strtotime( date( "Y-m-d H:i", get_the_time( "U" ) ) ) ) / 60 );
	$output = $prepend;
	if ( $minutes < 0 ) {
		$output .= $texts[14];
	} else if ( $mode == 0 && $minutes < 1440 ) {
			if ( $minutes == 0 ) {
				$output .= $texts[9];
			} else if ( $minutes == 1 ) {
					$output .= $texts[10];
				} else if ( $minutes < 60 ) {
					$output .= $minutes . " " . $texts[11];
				} else if ( $minutes < 120 ) {
					$output .= $texts[12];
				} else {
				$output .= floor( $minutes / 60 ) . " " . $texts[13];
			}
		} else {
		if ( $days == 0 )
			$output = $output . $texts[0];
		elseif ( $days == 1 )
			$output = $output . $texts[1];
		elseif ( $days == 7 )
			$output = $output . $texts[2];
		else {
			$years = floor( $days / 365 );
			if ( $years > 0 ) {
				if ( $years == 1 )
					$yearappend = $texts[4];
				else
					$yearappend = $texts[5];

				$days = $days - ( 365 * $years );
				if ( $days == 0 )
					$output = $output . $years . " " . $yearappend . " " . $texts[6];
				else if ( $days == 1 )
						$output = $output . $years . " " . $yearappend . ", " . $days . " " . $texts[7];
					else
						$output = $output . $years . " " . $yearappend . ", " . $days . " " . $texts[8];
			} else {
				$output = $output . $days . " " . $texts[3];
			}
		}
	}

	$output = $output . $append;
	echo $output;
}


add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );

function my_show_extra_profile_fields( $user ) { ?>
	<h3>Extra profile information</h3>
	<table class="form-table">
		<tr>
			<th><label for="twitter">Twitter</label></th>
			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description">Please enter your Twitter username.</span>
			</td>
		</tr>
	</table>
<?php }


add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );

function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
}



/**
 * Augmentation to the $_SERVER['DOCUMENT_ROOT'] functionality, because it cannot be relied on to provide the right path
 * in cases where there is URL rewriting at play.
 *
 * @param  $path
 * @return mixed|string
 */
function find_document_root($path) {
    // If the file exists under DOCUMENT_ROOT, return DOCUMENT_ROOT
    if (@file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $path)) {
        return $_SERVER['DOCUMENT_ROOT'];
    }

    // Get the path of the current script, then compare it with DOCUMENT_ROOT. Then check for the file in each folder.
    $parts = array_diff(explode('/', $_SERVER['SCRIPT_FILENAME']), explode('/', $_SERVER['DOCUMENT_ROOT']));
    $new_path = $_SERVER['DOCUMENT_ROOT'];
    foreach ($parts as $part) {
        $new_path .= '/' . $part;
        if (@file_exists($new_path . '/' . $path)) {
            return $new_path;
        }
    }
	
	// sub folder install for wordpress
    $len=strrpos($_SERVER['SCRIPT_FILENAME'],"/");
    $new_root=substr($_SERVER['SCRIPT_FILENAME'], 0, $len);
    if (@file_exists($new_root . '/' . $path)) {
         return $new_root;
    }

    // Microsoft Servers
    if (!isset($_SERVER['DOCUMENT_ROOT'])) {
        $new_path = str_replace("/", "\\", $_SERVER['ORIG_PATH_INFO']);
        $new_path = str_replace($new_path, "", $_SERVER['SCRIPT_FILENAME']);

        if (@file_exists($new_path . '/' . $path)) {
            return $new_path;
        }
    }
    return false;
}



if ( function_exists( 'add_theme_support' ) ) { // Added in 2.9
  add_theme_support( 'post-thumbnails' );
  add_image_size('blog-small','200','140',true);
}


/**
 * This function resizes images It takes image source,
 * width height and quality as a parameter
 * @param  $img_url
 * @param  $width
 * @param  $height
 * @param bool $crop
 * @param  $quality
 * @return array with image URL, width and height
 */
  
 
function theme_img_resize($img_url, $width, $height, $crop = true, $retina = false, $quality = 100) {
    $upload_dir = wp_upload_dir();
    $width = ( $retina ) ? ( $width * 2 ) : $width;
    $height = ( $retina ) ? ( $height * 2 ) : $height;
    $upload_path = $upload_dir['basedir'] . '/thumb-cache';
    if (!file_exists($upload_path)) { // Create the directory if it is missing
        wp_mkdir_p($upload_path);
    }

    $file_path = parse_url($img_url);
	
    if(array_key_exists('host',$file_path) && $_SERVER['HTTP_HOST'] != $file_path['host'] && $file_path['host'] != '') {  // The image is not locally hosted
        $remote_file_info = pathinfo($file_path['path']); // Can't use $img_url as the parameter because pathinfo includes the 'query' for the URL
        if (isset($remote_file_info['extension'])) {
            $remote_file_extension = $remote_file_info['extension'];
        } else {
            $remote_file_extension = 'jpg';
        }
        $remote_file_extension = strtolower($remote_file_extension); // Not doing this creates multiple copies of a remote image.

        $file_base = md5($img_url) . '.' . $remote_file_extension;

        // We will try to copy the file over locally.
        $copy_to_file = $upload_dir['path'] . '/' . $file_base;
        if (!file_exists($copy_to_file)) {
            $unique_filename = wp_unique_filename($upload_dir['path'], $file_base);
            // Using the HTTP API instead of our own CURL calls...
            $remote_content = wp_remote_request($img_url, array('sslverify' => false)); // Setting the sslverify argument, to prevent errors on HTTPS calls. A user embedding images in a post knows where he is pulling them from
            if (is_wp_error($remote_content)) {
                $copy_to_file = '';
            } else {
                // Not using file open functions, so you have to find your way around by using wp_upload_bits...
                wp_upload_bits($unique_filename, null, $remote_content['body']);
                $copy_to_file = $upload_dir['path'] . '/' . $unique_filename;
            }
        }
        $file_path = $copy_to_file;
    } 
	
	else {  // Locally hosted image
		$parts = array_intersect(explode('/', $_SERVER['SCRIPT_FILENAME']), explode('/', $file_path['path']));
		if(count($parts)>0){
			 $file_path['path']=strstr($file_path['path'],'/wp-content');
		 }
        $file_path = find_document_root($file_path['path']) . $file_path['path'];
    }

    if (!file_exists($file_path)) {
        $resized_image = array(
            'url' => $img_url,
            'width' => $width,
            'height' => $height
        );
		
        return $resized_image;
    }

    $orig_size = @getimagesize($file_path);
    $source[0] = $img_url;
    $source[1] = $orig_size[0];
    $source[2] = $orig_size[1];

	$extension="";
    $file_info = pathinfo($file_path);
    if (isset($file_info['extension'])) {
        $extension = '.' . $file_info['extension'];

        //Image quality is scaled down in case of PNGs, because PNG image creation uses a different scale for quality.
        if ($extension == '.png' && $quality != null) {
            $quality = floor(0.09 * $quality);
        }
    }

    $crop_str = $crop ? '-crop' : '-nocrop';
    $quality_str = $quality != null ? '-' . $quality : '';
    $cropped_img_path = $upload_path . '/' . $file_info['filename'] . '-' . md5($file_path) . '-' . $width . 'x' . $height . $quality_str . $crop_str . $extension;
    $suffix = md5($file_path) . '-' . $width . 'x' . $height . $quality_str . $crop_str;


    // Checking if the file size is larger than the target size.If it is smaller or the same size, stop right here and return.
    if ($source[1] > $width || $source[2] > $height) {
        // Source file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match)
        if (file_exists($cropped_img_path)) {
            $cropped_img_url = str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $cropped_img_path);
            $resized_image = array(
                'url' => $cropped_img_url,
                'width' => $width,
                'height' => $height
            );
            return $resized_image;
        }

        if ($crop == false) {
            // Calculate the size proportionally
            $proportional_size = wp_constrain_dimensions($source[1], $source[2], $width, $height);
            $resized_img_path = $upload_path . '/' . $file_info['filename'] . '-' . md5($file_path) . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $quality_str . $crop_str . $extension;
            $suffix = md5($file_path) . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $quality_str . $crop_str;

            // Checking if the file already exists
            if (file_exists($resized_img_path)) {
                $resized_img_url = str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $resized_img_path);

                $resized_image = array(
                    'url' => $resized_img_url,
                    'width' => $proportional_size[0],
                    'height' => $proportional_size[1]
                );
                return $resized_image;
            }
        }

        // No cache files - let's finally resize it using WP's inbuilt resizer
       
        error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
		
		 if(version_compare(get_bloginfo('version'), '3.5.0', '<')) {
        	$new_img_path = image_resize($file_path, $width, $height, $crop, $suffix, $upload_path, $quality);
    	  } else {
			  
			  $image = wp_get_image_editor($file_path);
				if ( ! is_wp_error( $image ) ) {
    					$image->set_quality($quality);
    					$image->resize( $width, $height, $crop);
						$filename = $image->generate_filename( $suffix, $upload_path);
    					$image->save($filename);
					}
			  
			$new_img_path= $filename;
         }
		

        if (is_wp_error($new_img_path)) {
            // We hit some errors. Let's just return the original image
            $resized_image = array(
                'url' => $source[0],
                'width' => $source[1],
                'height' => $source[2]
            );
        } else {
            $new_img_size = getimagesize($new_img_path);
            $new_img = str_replace($upload_dir['basedir'], $upload_dir['baseurl'], $new_img_path);

            // resized output
            $resized_image = array(
                'url' => $new_img,
                'width' => $new_img_size[0],
                'height' => $new_img_size[1]
            );
        }
        return $resized_image;
    }
    // default output - without resizing
    $resized_image = array(
        'url' => $source[0],
        'width' => $source[1],
        'height' => $source[2]
    );
    return $resized_image;
}

?>
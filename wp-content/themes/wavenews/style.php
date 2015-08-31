<?php 
/*------------------------------------------------------------- 
		Custum Skin 
-------------------------------------------------------------*/

require_once( '../../../wp-load.php' );
header("Content-type: text/css; charset: UTF-8");
$option = theme_option( THEME_OPTIONS );
$custom_css = theme_option( THEME_OPTIONS, 'custom_css' );


function my_strstr( $haystack, $needle, $before_needle = false ) {
	if ( !$before_needle ) return strstr( $haystack, $needle );
	else return substr( $haystack, 0, strpos( $haystack, $needle ) );
}

/* fontface */
if ( theme_option( THEME_OPTIONS, 'custom_fonts_type_1' ) == 'fontface' ) {
	$fontface_1 = theme_option( THEME_OPTIONS, 'custom_fonts_list_1' );

	$stylesheet = FONTFACE_DIR.'/fontface_stylesheet.css';
	if ( file_exists( $stylesheet ) ) {
		$file_content = file_get_contents( $stylesheet );
		if ( preg_match( "/@font-face\s*{[^}]*?font-family\s*:\s*('|\")$fontface_1\\1.*?}/is", $file_content, $match ) ) {
			$fontface_style_1 = preg_replace( "/url\s*\(\s*['|\"]\s*/is", "\\0fontface/", $match[0] )."\n";
		}
		if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_1' ) ) ) {
			$special_elements_1 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_1' ) );
		} else {
			$special_elements_1 = theme_option( THEME_OPTIONS, 'special_elements_1' );
		}
		if ( $special_elements_1 && $fontface_1 ) {
			$fontface_css_1 = $special_elements_1 . '{ font-family: "' . $fontface_1.'"}';
		}
	}
}

if ( theme_option( THEME_OPTIONS, 'custom_font_type_2' ) == 'fontface' ) {
	$fontface_2 = theme_option( THEME_OPTIONS, 'custom_fonts_list_2' );
	$stylesheet = FONTFACE_DIR.'/fontface_stylesheet.css';
	if ( file_exists( $stylesheet ) ) {
		$file_content = file_get_contents( $stylesheet );
		if ( preg_match( "/@font-face\s*{[^}]*?font-family\s*:\s*('|\")$fontface_2\\1.*?}/is", $file_content, $match ) ) {
			$fontface_style_2 = preg_replace( "/url\s*\(\s*['|\"]\s*/is", "\\0fontface/", $match[0] )."\n";
		}

		if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_2' ) ) ) {
			$special_elements_2 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_2' ) );
		} else {
			$special_elements_2 = theme_option( THEME_OPTIONS, 'special_elements_2' );
		}

		if ( $special_elements_2 && $fontface_2 ) {
			$fontface_css_2 = $special_elements_2 . '{ font-family: "' . $fontface_2.'"}';
		}
	}
}


/* Safe Fonts */
if ( theme_option( THEME_OPTIONS, 'custom_fonts_type_1' ) == 'safe_font' ) {
	$safefont_1 = theme_option( THEME_OPTIONS, 'custom_fonts_list_1' );

	if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_1' ) ) ) {
		$special_elements_1 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_1' ) );
	} else {
		$special_elements_1 = theme_option( THEME_OPTIONS, 'special_elements_1' );
	}

	if ( $special_elements_1 && $safefont_1 ) {
		$safefont_css_1 = $special_elements_1 . '{ font-family: ' . $safefont_1.'}';
	}

}


if ( theme_option( THEME_OPTIONS, 'custom_font_type_2' ) == 'safe_font' ) {
	$safefont_2 = theme_option( THEME_OPTIONS, 'custom_fonts_list_2' );


	if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_2' ) ) ) {
		$special_elements_2 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_2' ) );
	} else {
		$special_elements_2 = theme_option( THEME_OPTIONS, 'special_elements_2' );
	}

	if ( $special_elements_2 && $safefont_2 ) {
		$safefont_css_2 = $special_elements_2 . '{ font-family: ' . $safefont_2.'}';
	}

}



/* Google Fonts */
if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_1' ) ) ) {
	$special_elements_1 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_1' ) );
} else {
	$special_elements_1 = theme_option( THEME_OPTIONS, 'special_elements_1' );
}

if ( is_array( theme_option( THEME_OPTIONS, 'special_elements_2' ) ) ) {
	$special_elements_2 = implode( ', ', theme_option( THEME_OPTIONS, 'special_elements_2' ) );
} else {
	$special_elements_2 = theme_option( THEME_OPTIONS, 'special_elements_2' );
}

if ( $special_elements_1 && theme_option( THEME_OPTIONS, 'custom_fonts_type_1' ) == 'google' ) {

	$google_font_1 = $special_elements_1  . ' {font-family: ';
	$format_name1 = strpos( theme_option( THEME_OPTIONS, 'custom_fonts_list_1' ), ':' );
	if ( $format_name1 !== false ) {
		$google_font_1 .=  my_strstr( str_replace( '+', ' ', theme_option( THEME_OPTIONS, 'custom_fonts_list_1' ) ), ':', true );
	} else { $google_font_1 .= str_replace( '+', ' ', theme_option( THEME_OPTIONS, 'custom_fonts_list_1' ) );
	}

	$google_font_1 .=' }';

}

if ( $special_elements_2 && theme_option( THEME_OPTIONS, 'custom_font_type_2' ) == 'google' ) {
	$google_font_2 = $special_elements_2  . ' {font-family: ';

	$format_name2 = strpos( theme_option( THEME_OPTIONS, 'custom_fonts_list_2' ), ':' );
	if ( $format_name2 !== false ) {
		$google_font_2 .=  my_strstr( str_replace( '+', ' ', theme_option( THEME_OPTIONS, 'custom_fonts_list_2' ) ), ':', true );
	} else { $google_font_2 .= str_replace( '+', ' ', theme_option( THEME_OPTIONS, 'custom_fonts_list_2' ) );

	}
	$google_font_2 .=' }';
}
$safe_font = theme_option( THEME_OPTIONS, 'font_family' ) ? 'font-family: ' . stripslashes( theme_option( THEME_OPTIONS, 'font_family' ) ) . ';' : '';

/* Body background */

$body_bg  ='background: ' .  theme_option( THEME_OPTIONS, 'body_color' );
$body_bg .=  theme_option( THEME_OPTIONS, 'body_image' ) ? ' url(' . theme_option( THEME_OPTIONS, 'body_image' ) . ') ' : ' ';
$body_bg .= theme_option( THEME_OPTIONS, 'body_repeat' ) . ' ';
$body_bg .= theme_option( THEME_OPTIONS, 'body_position' ) . ' ';
$body_bg  .= theme_option( THEME_OPTIONS, 'body_attachment' ) .' ;';


/* Header background */

$header_bg  ='background: ' .  theme_option( THEME_OPTIONS, 'header_color' );
$header_bg .=  theme_option( THEME_OPTIONS, 'header_image' ) ? ' url(' . theme_option( THEME_OPTIONS, 'header_image' ) . ') ' : ' ';
$header_bg .= theme_option( THEME_OPTIONS, 'header_repeat' ) . ' ';
$header_bg .= theme_option( THEME_OPTIONS, 'header_position' ) . ' ';
$header_bg  .= theme_option( THEME_OPTIONS, 'header_attachment' ) .' ;';


$header_nav_padding= theme_option( THEME_OPTIONS, 'logo_top_bottom_margin' )+15; 

/*Main Navigation*/
$nav_background_image='images/selector/'.theme_option( THEME_OPTIONS, 'nav_background_image' ).'.png';


/* Page background*/

$page_bg  ='background: ' .  theme_option( THEME_OPTIONS, 'page_color' );
$page_bg .=  theme_option( THEME_OPTIONS, 'page_image' ) ? ' url(' . theme_option( THEME_OPTIONS, 'page_image' ) . ') ' : ' ';
$page_bg .= theme_option( THEME_OPTIONS, 'page_repeat' ) . ' ';
$page_bg .= theme_option( THEME_OPTIONS, 'page_position' ) . ' ';
$page_bg  .= theme_option( THEME_OPTIONS, 'page_attachment' ) .' ;';



/* Foot background */

$footer_bg  ='background: ' .  theme_option( THEME_OPTIONS, 'footer_color' );
$footer_bg .=  theme_option( THEME_OPTIONS, 'footer_image' ) ? ' url(' . theme_option( THEME_OPTIONS, 'footer_image' ) . ') ' : ' ';
$footer_bg .= theme_option( THEME_OPTIONS, 'footer_repeat' ) . ' ';
$footer_bg .= theme_option( THEME_OPTIONS, 'footer_position' ) . ' ';
$footer_bg  .= theme_option( THEME_OPTIONS, 'footer_attachment' ) .' ;';
$introduce_bg  ='background: ' .  theme_option( THEME_OPTIONS, 'introduce_bg_color' ) . ' ';
if(theme_option( THEME_OPTIONS, 'introduce_bg_image_source' ) == 'preset') {
	$introduce_bg .=  theme_option( THEME_OPTIONS, 'introduce_bg_preset_image' ) ? ' url(' . theme_option( THEME_OPTIONS, 'introduce_bg_preset_image' ) . ') ' : ' ';
} else if(theme_option( THEME_OPTIONS, 'introduce_bg_image_source' ) == 'custom') {
	$introduce_bg .=  theme_option( THEME_OPTIONS, 'introduce_bg_custom_image' ) ? ' url(' . theme_option( THEME_OPTIONS, 'introduce_bg_custom_image' ) . ') ' : ' ';	
}
$introduce_bg .= theme_option( THEME_OPTIONS, 'introduce_bg_repeat' ) . ' ';
$introduce_bg .= theme_option( THEME_OPTIONS, 'introduce_bg_position' ) . ' ';
$introduce_bg  .= theme_option( THEME_OPTIONS, 'introduce_bg_attachment' ) .' ;';


/* Other options */
$header_social_border = (theme_option( THEME_OPTIONS, 'enable_header_social_round_border' ) =="true") ? '50%':'0%';



if ( theme_option( THEME_OPTIONS, 'footer_top_border_enable' ) == 'true' ) {
	$footer_border = 'border-top:' . theme_option( THEME_OPTIONS, 'footer_top_border_size' ) . 'px solid ' . theme_option( THEME_OPTIONS, 'footer_top_border_color' ) . ';';
}



echo <<<CSS
{$fontface_style_1}
{$fontface_style_2}
{$fontface_css_1}
{$fontface_css_2}
{$google_font_1}
{$google_font_2}
{$safefont_css_1}
{$safefont_css_2}

body {
	font-size: {$option['body_size']}px !important;
	color: {$option['body_text_color']};
	font-weight: {$option['body_weight']};
	{$safe_font}
	{$body_bg}
}


.boxed_layout {
  -webkit-box-shadow: 0 0 {$option['boxed_layout_shadow_size']}px rgba(0, 0, 0, {$option['boxed_layout_shadow_intensity']});
  -moz-box-shadow: 0 0 {$option['boxed_layout_shadow_size']}px rgba(0, 0, 0, {$option['boxed_layout_shadow_intensity']});
  box-shadow: 0 0 {$option['boxed_layout_shadow_size']}px rgba(0, 0, 0, {$option['boxed_layout_shadow_intensity']});
}


.fancy.dropcaps,
.post_author_box h3:after,
#footer .widgettitle:after,
.fancy_heading.style1:after,
.single .blog_title:after, 
.widget_calendar caption,
.single_post_list h4:after,
.wp-pagenavi .current,
.previouspostslink:hover, 
.nextpostslink:hover, 
.wp-pagenavi .page:hover
{
	background-color: {$option['scheme_main_color']};
}


.blog_meta .meta_time,
.newspaper_top_meta .meta_time,
.blog_pagination a:hover,
#page #portfolios header a:hover,
#portfolios .portfolio_overlay,
.progress_bar,
#page #portfolios header a.current, 
.highlight,
.table.table th,
.flex-direction-nav li a:hover,
.portfolio_single_pagination a:hover,
div.anythingSlider .arrow a:hover,
.widget_search .search_button:hover,
.carousel-inner-mask,
.client_slider .jcarousel-next-horizontal:hover, 
.client_slider .jcarousel-prev-horizontal:hover,
.scrolltop_button:hover,
.comment_button,
.portfolio_title_newspaper:after,
.blog_loop article h1:after, 
.widget_most_popular_tags a,
.dark_gray.ws-button:hover,
#cboxPrevious:hover, #cboxNext:hover,
.portfolio_zoom_icon_newspaper:hover,
.portfolio_arrow_icon_newspaper:hover,
.home_carousel_prev:hover,
.home_carousel_next:hover,
.wpcf7-submit:hover,
.image_shortcode_title:after,
.image_overlay
{
	background-color: {$option['scheme_main_color']};

}	

#toolbar_social ul li
{
	background-color: {$option['header_social_background_color']};
}

::selection, ::-moz-selection {
	background-color: {$option['scheme_main_color']};
}

::selection, ::-moz-selection {
	color:#fff;
}

#header .logo {margin: {$option['logo_top_bottom_margin']}px 0;  }



#navigation ul li ul { 
	background: url($nav_background_image);
}

#navigation ul li:hover > a, 
#navigation ul li ul li a:hover, 
#navigation ul ul li:hover > a, 
#navigation .current_page_parent > a, 
#navigation .current-menu-item > a,
#navigation .current-menu-parent > a {
  	border-bottom:3px solid {$option['scheme_main_color']};
	color: {$option['scheme_main_color']};
	/*background-color:rgba(246,246,246,0.5);*/
}


.customStyleSelectBox {border-bottom:3px solid {$option['scheme_main_color']};}

.slogan_heading .slogan_dominant, .slogan_heading .slogan_dominant a{
	color:{$option['dominant_title_color']} !important;
}
.slogan_heading .slogan_highlight, .slogan_heading .slogan_highlight a {
	color:{$option['highlight_title_color']} !important;
}


#page .content a:hover, #footer_nav a:hover, .widget_twitter a{
	color:{$option['scheme_main_color']};
}


.blog_meta .blog_post_type:hover, 
.newspaper_top_meta .blog_post_type:hover,
.meta_time:hover, 
.ws-button:hover, 
.pricing_button a, 
.widget_search .search_button, 
#introduce h1.title_center:before, 
#introduce h1.title_center:after, 
.widget_social img,
.wpcf7-submit
{
	background-color: {$option['scheme_supporting_color']};
}


.icon-box-button:hover{
	background-color: {$option['scheme_supporting_color']} !important;
}

.contact_button {background-color: {$option['scheme_main_color']} !important;}
.contact_button:hover {background-color: {$option['scheme_supporting_color']} !important;}

.shortcode_blog_title a, .fancy_heading.style3{ color: {$option['h1_color']} !important;}

 .ws-icon-theme-scheme
{
	color:{$option['scheme_main_color']} ;
}

.toggle_title.toggle_active{
	background-color:{$option['scheme_main_color']} ;
}

.accordion .tab.current, .accordion .tab:hover , .toggle_title:hover{
	background-color:{$option['scheme_main_color']} ;
	border:1px solid {$option['scheme_main_color']} ;
}



.classic ul.tabs li.current a{
	color:{$option['scheme_main_color']} !important;
}

.divider.style4 {border-bottom-color: {$option['scheme_main_color']};}
.divider.style5{border-bottom-color: {$option['scheme_supporting_color']};}

.widget_sub_navigation .current_page_item a, ul.vertical_tabs li.current a {border-left:3px solid {$option['scheme_main_color']};}

.modern ul.tabs li.current a {
		color:{$option['scheme_main_color']} !important; 
	}
.theme_default ul.tabs li.current a{
	background-color:{$option['scheme_supporting_color']} !important;
	 color:#fff !important; 
}


.accordion .tab, .toggle_title,
.slogan_heading .slogan_subtitle,
#load_more_posts .text{
	color: {$option['h1_color']};
}




.accordion .tab:before, .toggle_title:before {
	background-color: {$option['h1_color']};
}



.testimonial_company {color: {$option['body_text_color']} !important; opacity:0.8;}


/* Header Section */
#header {
	{$header_bg}
		}
#header .site_description { 
	color: {$option['site_name_color']}; 
}
#header .site_name {
	font-size: {$option['site_name_size']}px;
	color: {$option['site_name_color']};
	font-weight: {$option['site_name_weight']}; }


#header .header_tagline {
	font-size: {$option['header_tagline_size']}px;
	color: {$option['header_tagline_color']};
	font-weight: {$option['header_tagline_weight']}; 
}

.top-navigation-left span {
	font-size: {$option['header_contact_size']}px;
	color: {$option['header_contact_color']};
	font-weight: {$option['header_contact_weight']}; 
}


/* Main Navigation */
#navigation ul li a {
	font-size: {$option['main_nav_top_size']}px;
	color: {$option['main_nav_top_color']};
	font-weight: {$option['main_nav_top_weight']}
}

#navigation ul li ul li a {
	font-size: {$option['main_nav_sub_size']}px;
	color: {$option['main_nav_sub_color']};
	font-weight: {$option['main_nav_sub_weight']}
}


.main_nav_style_2 #navigation ul li:hover,
.main_nav_style_2 #navigation ul ul li:hover,
.main_nav_style_2 #navigation .current_page_parent,
.main_nav_style_2 #navigation .current-menu-item,
.main_nav_style_2 #navigation .current-menu-ancestor,
.main_nav_style_2 #navigation .current-menu-parent {
	border: none !important; 
	background-color:{$option['scheme_main_color']} !important; 
}


.main_nav_style_2 #navigation ul li a{
	padding-top : {$header_nav_padding}px;
	padding-bottom : {$header_nav_padding}px;
}

.main_nav_style_2 #navigation ul li:hover > a,
.main_nav_style_2 #navigation ul ul li:hover > a,
.main_nav_style_2 #navigation .current_page_parent a,
.main_nav_style_2 #navigation .current-menu-item a,
.main_nav_style_2 #navigation .current-menu-ancestor a,
.main_nav_style_2 #navigation .current-menu-parent a
 {color: {$option['main_nav_hover_color']} !important; }

.callout_box {
	border-top: 4px solid {$option['scheme_main_color']};
}
/* Carousel */


.carousel_wrapper .thumbnai{
	background-color: {$option['scheme_main_color']};
}

.carousel_wrapper h2,.carousel_wrapper{
	color : {$option['carousel_heading_color']}!important;
	background-color: {$option['carousel_background_color']};
}

/* Page section */
#page {
	{$page_bg}
}

#page .content, .homepage_bottom_content {
	font-size: {$option['body_size']}px;
	color: {$option['body_text_color']};
	font-weight: {$option['body_weight']};
}
#page .content a, .homepage_bottom_content a, .portfolio_single a{
	color: {$option['a_color']};
}



#page h1, .homepage_bottom_content h1{
	font-size: {$option['h1_size']}px;
	color: {$option['h1_color']};
	font-weight: {$option['h1_weight']};
}

#page h2, .homepage_bottom_content h2{
	font-size: {$option['h2_size']}px;
	color: {$option['h2_color']};
	font-weight: {$option['h2_weight']};
}

#page h3, .homepage_bottom_content h3{
	font-size: {$option['h3_size']}px;
	color: {$option['h3_color']};
	font-weight: {$option['h3_weight']};
}

#page h4, .homepage_bottom_content h4{
	font-size: {$option['h4_size']}px;
	color: {$option['h4_color']};
	font-weight: {$option['h4_weight']};
}

#page h5, #comments_title, #respond h5{
	font-size: {$option['h5_size']}px;
	color: {$option['h5_color']};
	font-weight: {$option['h5_weight']};
}

#page h6, .homepage_bottom_content h6, .portfolio_title_newspaper a{
	font-size: {$option['h6_size']}px;
	color: {$option['h6_color']};
	font-weight: {$option['h6_weight']};
}


#sidebar .widgettitle {
	font-size: {$option['sidebar_title_size']}px;
	color: {$option['sidebar_title_color']};
	font-weight: {$option['sidebar_title_weight']};
	}

#sidebar  {
	font-size: {$option['sidebar_text_size']}px;
	color: {$option['sidebar_text_color']};
	font-weight: {$option['sidebar_text_weight']};
	}

#sidebar .widget a{
	color: {$option['sidebar_links_color']};
	}

#sidebar .widget a:hover{
	color: {$option['scheme_main_color']};
	}

/****************************/
#page .slogan_dominant {
	font-size:{$option['dominant_title_size']}px; 
	font-weight:{$option['dominant_title_weight']}; 
	line-height:{$option['dominant_title_size']}px;
}

#page .slogan_highlight {
	font-size:{$option['highlight_title_size']}px; 
	font-weight:{$option['highlight_title_weight']}; 
	line-height:{$option['highlight_title_size']}px;
}

#footer {
	font-size: {$option['footer_text_size']}px;
	color: {$option['footer_text_color']};
	font-weight: {$option['footer_text_weight']};
	{$footer_border}
	{$footer_bg}
}

#footer .widgettitle {
	font-size: {$option['footer_title_size']}px;
	color: {$option['footer_title_color']};
	font-weight: {$option['footer_title_weight']};
}

#footer .widget a {
	color: {$option['footer_links_color']};
}

#footer .widget a:hover {
	color: {$option['footer_links_color_hover']};
}

#footer_nav a {
	color: {$option['subfooter_nav_color']} !important;
}

#footer_toolbar {
	background-color: {$option['subfooter_bg_color']};
}

.footer_slogan {
	font-size: {$option['footer_slogan_size']}px;
	line-height: {$option['footer_slogan_size']}px;
	color: {$option['footer_slogan_color']};
}
.footer_tagline {
	font-size: {$option['footer_tagline_size']}px;
	color: {$option['footer_tagline_color']};
}

.copyright, .copyright a {
	color: {$option['subfooter_copyright_color']} !important;
}


/*****************/

#introduce {
	{$introduce_bg}
}


#introduce h1 {
		font-size: {$option['page_introduce_size']}px;
		color: {$option['page_introduce_color']};
		font-weight:  {$option['page_introduce_weight']};
	}

#introduce h4 {
		font-size: {$option['page_desc_size']}px;
		color: {$option['page_desc_color']} !important;

	}

/* Other Setting */


.scheme_color{
	color: {$option['scheme_main_color']} !important;
}

.scheme_background_color{
	background-color: {$option['scheme_main_color']} !important;
} 

.scheme_background_color:hover{
	background-color: {$option['scheme_supporting_color']} !important;
} 


#toolbar_social ul li, #toolbar_social ul li a {
	-webkit-border-radius:$header_social_border;
	-moz-border-radius:$header_social_border;
	border-radius:$header_social_border;

}


#header_top_container{
	background-color:{$option['header_top_content_background_color']};

}



/* User Added Custom CSS */

{$custom_css}

/****************************/

CSS;
?>

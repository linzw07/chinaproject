<?php
include THEME_ADMIN . '/options/includes.php';

$options = array(

  array(
    "type" => "start",
    "options" => array(
      "general" => __( "General", 'backend' ),
      "homepage" => __( "Homepage", 'backend' ),
      "style" => __( "Style", 'backend' ),
	  "blog" => __( "Blog/News", 'backend' ),
      "slideshow" => __( "Slideshow", 'backend' ),
      "portfolio" => __( "Portfolio", 'backend' ),
    ),
  ),


/*-------------------------------------------------------------
		 Main Option : Genral
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_option"
  ),


  array(
    "type" => "start_sub",
    "options" => array(
	  "global_header" => __( "Header", 'backend' ),
      "navigations" => __( "Navigations", 'backend' ),
      "social_network" => __( "Social Networks", 'backend' ),
      "sidebar" => __( "Custom Sidebars", 'backend' ),
      "footer" => __( "Footer", 'backend' ),
	  "seo" => __( "SEO", 'backend' ),
      "import_options" => __( "Import Options", 'backend' ),
	  "export_options" => __( "Export Options", 'backend' ),
	  "global_others" => __( "Other Settings", 'backend' ),
   
    ),
  ),



  /* Sub Option one : Header */
  array(
    "type" => "start_sub_option"
  ),



  array(
    "name" => "General / Header",
    "type" => "heading"
  ),

  array(
    "name" => __( "Custom Logo", "theme_backend" ),
    "desc" => __( "Upload your own custom logo by enabling this option first.", "theme_backend" ),
    "id" => "display_logo",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Upload Custom Logo", "theme_backend" ),
	 "desc" => __( "Upload  your own custom logo here if you use your own logo and enable the custom logo option." , "theme_backend" ),
    "id" => "logo",
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "upload"
  ),

  array(
    "name" => 'Logo Padding',
	"desc" => __( 'Change this value to change the padding for the logo from top and bottom.', "theme_backend" ),
    "id" => "logo_top_bottom_margin",
    "min" => "0",
    "max" => "100",
    "step" => "1",
    "unit" => 'px',
    "default" => "30",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  
   array(
    "name" => __( "Header Phone Number", "theme_backend" ),
	"desc" => __( 'The header phone number used in header.', "theme_backend" ),
    "id" => "header_phone_number",
    "default" => '1234-5675-8900',
    "size" => 30,
    "type" => "text"
  ),
    array(
    "name" => __( "Header Email Address", "theme_backend" ),
	"desc" => __( 'The header email address used in header.', "theme_backend" ),
    "id" => "header_email_address",
    "default" => 'admin@yourdomain.com',
    "size" => 30,
    "type" => "text"
  ),

  array(
    "name" => __( "Show Header Toolbar Tagline", "theme_backend" ),
    "desc" => __( 'Show header toolbar tagline in header.', "theme_backend" ),
    "id" => "disable_header_tagline",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Header Fixed", "theme_backend" ),
    "desc" => __( 'Enable header section always be fixed on top.', "theme_backend" ),
    "id" => "enable_header_fixed",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


  /* Sub Option one : Navigations */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "General / Navigations",
    "type" => "heading"
  ),

  array(
    "name" => __( "Main Navigation", "theme_backend" ),
    "desc" => __( "Enable main navigation also need set Navigation Items under Appearance > Menu.", "theme_backend" ),
    "id" => "enable_main_nav",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "name" => "Footer Navigation",
    "desc" => __( "This option allows you to enable a custom navigation on the left section of custom footer.", "theme_backend" ),
    "id" => "enable_footer_nav",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/

  /* Sub Option one : Social Networks */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "General / Social Networks",
    "type" => "heading"
  ),

  array(
    "name" => __( "Header Social Networks", "theme_backend" ),
    "id" => "enable_header_social_networks",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Side Social Networks", "theme_backend" ),
    "id" => "enable_side_social_networks",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Side Social Netowrks alignment", "theme_backend" ),
    "id" => "side_social_align",
    "default" => 'left',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "right" => 'Stay On the Right',
      "left" => 'Stay on the Left'
    ),
    "type" => "radio"
  ),
  array(
    "name" => __( "Twitter", "theme_backend" ),
    "id" => "twitter_sociable",
    "default" => '#',
    "size" => 30,
    "type" => "text"
  ),
  array(
    "name" => __( "Facebook", "theme_backend" ),
    "id" => "facebook_sociable",
    "default" => '#',
    "size" => 30,
    "type" => "text"
  ),
  array(
    "name" => __( "Linkedin", "theme_backend" ),
    "id" => "linkedin_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),

  array(
    "name" => __( "Google", "theme_backend" ),
    "id" => "google_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  array(
    "name" => __( "Delicious", "theme_backend" ),
    "id" => "delicious_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  
    array(
    "name" => __( "Dribbble", "theme_backend" ),
    "id" => "dribbble_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  
  array(
    "name" => __( "Behance", "theme_backend" ),
    "id" => "behance_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  
  array(
    "name" => __( "Stumble Upon", "theme_backend" ),
    "id" => "stumbleupon_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  
  array(
    "name" => __( "Deviantart", "theme_backend" ),
    "id" => "deviantart_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  array(
    "name" => __( "Flickr", "theme_backend" ),
    "id" => "flickr_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  array(
    "name" => __( "Digg", "theme_backend" ),
    "id" => "digg_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),

  array(
    "name" => "Rss",
    "id" => "rss_sociable",
    "default" => get_bloginfo( 'rss2_url' ),
    "size" => 30,
    "type" => "text"
  ),
  array(
    "name" => __( "Skype", "theme_backend" ),
    "id" => "skype_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),

  array(
    "name" => __( "Youtube", "theme_backend" ),
    "id" => "youtube_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),

  array(
    "name" => __( "Vimeo", "theme_backend" ),
    "id" => "vimeo_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  
  array(
    "name" => __( "Yahoo", "theme_backend" ),
    "id" => "yahoo_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  array(
    "name" => __( "Wordpress", "theme_backend" ),
    "id" => "wordpress_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  array(
    "name" => __( "Last.fm", "theme_backend" ),
    "id" => "lastfm_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  array(
    "name" => __( "Pinterest", "theme_backend" ),
    "id" => "pinterest_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
    array(
    "name" => __( "Tumblr", "theme_backend" ),
    "id" => "tumblr_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),
  array(
    "name" => __( "Blogger", "theme_backend" ),
    "id" => "blogger_sociable",
    "default" => '',
    "size" => 30,
    "type" => "text"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/

  /* Sub Option one : Custom Sidebars */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "General / Custom Sidebar",
    "type" => "heading"
  ),
  array(
    "name" => __( "Create a new sidebar", "theme_backend" ),
    "desc" => __( "Enter a name for new sidebar. It must be a valid name which starts with a letter, followed by letters, numbers, spaces, or underscores", "theme_backend" ),
    "id" => "sidebars",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,

    "type" => 'custom_sidebar'
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/

  /* Sub Option one : Footer */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "General / Footer",
    "type" => "heading"
  ),

  array(
    "name" => __( "Footer", "theme_backend" ),
    "desc" => __( "Show footer section.", "theme_backend" ),
    "id" => "disable_footer",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Sub Footer", "theme_backend" ),
    "desc" => __( "Use this option to enable or disable the sub-footer.", "theme_backend" ),
    "id" => "disable_sub_footer",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Footer Column layout", "theme_backend" ),
    "id" => "footer_columns",
    "function" => "footer_culumns",
    "default" => "4",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "30px 30px 0 0",
    "options" => array(
      "1" => 'column_1',
      "2" => 'column_2',
      "3" => 'column_3',
      "4" => 'column_4',
      "5" => 'column_5',
      "6" => 'column_6',
      "half_sub_half" => 'column_half_sub_half',
      "half_sub_third" => 'column_half_sub_third',
      "third_sub_third" => 'column_third_sub_third',
      "third_sub_fourth" => 'column_third_sub_fourth',
      "sub_half_half" => 'column_sub_half_half',
      "sub_third_half" => 'column_sub_third_half',
      "sub_third_third" => 'column_sub_third_third',
      "sub_fourth_third" => 'column_sub_fourth_third',
      "two_row" => 'column_half_half',
    ),
    "type" => "visual_selector"
  ),

  
   array(
    "name" => "Automatic Copyright",
    "desc" => __( "Copyright time range can automatic generate if enabled, it followed by the copyright text.", "theme_backend" ),
    "id" => "enable_copyright_auto",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  
  array(
    "name" => __( "Copyright Text", "theme_backend" ),
    "desc" => "",
    "id" => "copyright",
    "default" => 'Copyright All Rights Reserved',
    "rows" => 3,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),
  array(
    "type" => "end_pane"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  
  /*****************************/

  
  
  /* Sub Option one : SEO */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "General / SEO",
    "type" => "heading"
  ),


  array(
    "name" => "Google Analytics ID",
    "desc" => __( "Enter your Google Analytics ID here to track your site with Google Analytics.", "theme_backend" ),
    "id" => "analytics",
    "default" => "",
    "size" => 70,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  array(
    "name" => __( "SEO Solution", "theme_backend" ),
    "desc" => __( "If you are using an SEO plugin its recomended to disable this option for any unpredictable conflicts.", "theme_backend" ),
    "id" => "disable_seo",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Use Post Tags for Meta Keywords", "theme_backend" ),
    "id" => "disable_seo_tags",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Use Post Categories for Meta Keywords", "theme_backend" ),
    "id" => "disable_seo_category",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Canonical Links", "theme_backend" ),
    "desc" => __( "If you enable this option, it will automatically generate Canonical URLS for all your pages. This will help to prevent duplicate content penalties by Google.", "theme_backend" ),
    "id" => "disable_seo_canonical",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "No-Index For Category and Tags Pages", "theme_backend" ),
    "desc" => __( "Check this option to exclude category and tags pages from being crawled. Its usefull to avoid dublicate content to be indexed.", "theme_backend" ),
    "id" => "disable_seo_noindex",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


/* Sub Option one : Import Options */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "General / Import Options",
    "type" => "heading"
  ),

  array(
    "name" => "Import Options",
    "id" => "theme_import_options",
    "default" => '',
    "rows"=> 10,
    "option_structure" => 'main',
    "divider" => false,
    "type" => "import"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/




  /* Sub Option one : Export Options */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "General / Export Options",
    "type" => "heading"
  ),

  array(
    "name" => "Export Options",
    "id" => "theme_export_options",
    "default" => '',
    "rows"=> 10,
    "option_structure" => 'main',
    "divider" => false,
    "type" => "export"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/

  
    /* Sub Option one : Others Settings */
  array(
    "type" => "start_sub_option"
  ),



  array(
    "name" => "General / Other Settings",
    "type" => "heading"
  ),
  
  array(
    "name" => __( "Custom Favicon", "theme_backend" ),
    "desc" => __( "Upload  your own custom favicon here." , "theme_backend" ),
    "id" => "custom_favicon",
    "default" => '',
    "button" => 'Upload Icon',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => 'upload'
  ),
  
    array(
    "name" => __( "Image cropping", "theme_backend" ),
    "desc" => __( "This option will crop images to fit the dimension, so some parts of images will be cropped out. if you dont want to crop images disable this option", "theme_backend" ),
    "id" => "disable_image_cropping",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "name" => __( "Retina compatible images", "theme_backend" ),
    "desc" => __( "This option will double the dimension of images, though since all images are blocked with its original sizes, they will not look large, the difference will be visible only in retina displays. ", "theme_backend" ),
    "id" => "enable_retina_images",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Scroll Top", "theme_backend" ),
    "desc" => __( 'Enabling this option will display a floating scroll to the top of the page at the bottom right corner of the page', "theme_backend" ),
    "id" => "disable_scroll_top",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "name" => __( "Responsive Layout", "theme_backend" ),
    "desc" => __( "Disabling this option will keep the layout as it is on smaller devices (phones nad tablets for eg.)", "theme_backend" ),
    "id" => "disable_responsive",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Smooth Page Scroll", "theme_backend" ),
    "desc" => __( "You can enable/disable page vertical scroll smoothness which gives an smooth easing. ", "theme_backend" ),
    "id" => "enable_nicescroll",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/



  array(
    "type"=>"end_sub"
  ),

  array(
    "type"=>"end_main_option"
  ),

/* End Main Option */

/*-------------------------------------------------------------
 					Main Pane : Homepage
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_option"
  ),


  array(
    "type" => "start_sub",
    "options" => array(
      "homepage_general" => __( "Genral Settings", 'backend' ),
	  "slogan_heading" => __( "Slogan Heading", 'backend' ),
      "homepage_carousel" => __( "Carousel", 'backend' ),
	  "homepage_seo" => __( "SEO", 'backend' )
    ),
  ),



  /* Sub Option one : Genral Layout */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Homepage / General Settings",
    "type" => "heading"
  ),
  array(
    "name" => __( "Homepage Layout", "theme_backend" ),
    "id" => "home_layout",
    "default" => 'full',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "20px 30px 0 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),
  array(
    "name" => __( "Homepage Content Top Section", "theme_backend" ),
    "desc" => __( "Which Page to be the content of your homepage.", "theme_backend" ),
    "id" => "homepage_content_top",
    "target" => 'page',
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "prompt" => __( "Choose page..", "theme_backend" ),
    "type" => "select"
  ),
  array(
    "name" => __( "Homepage Content Bottom Section", "theme_backend" ),
    "desc" => __( "Which Page to be your homepage bottom section.", "theme_backend" ),
    "id" => "homepage_content_bottom",
    "target" => 'page',
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "prompt" => __( "Choose page..", "theme_backend" ),
    "type" => "select"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/

  
 /* Sub Option one : Slogan Heading */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Homepage / Slogan Heading",
    "type" => "heading"
  ),
  array(
    "name" => "Slogan Heading",
	 "desc" => __( "Enable slogan in home page.", "theme_backend" ),
    "id" => "enable_slogan_heading",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  
    array(
    "name" => "Enable Slogan Before Slideshow",
	"desc" => __( "Enable slogan before slideshow if slideshow enable on homepage.", "theme_backend" ),
    "id" => "enable_slogan_before_slideshow",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  
  
  array(
    "name" => __( "Heading", "theme_backend" ),
    "default" => "",
    "size" => 50,
    "id" => "home_slogan_heading_dominant",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  array(
    "name" => __( "Highlight Heading", "theme_backend" ),
    "default" => "",
    "size" => 50,
    "id" => "home_slogan_heading_highlight",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  array(
    "name" => __( "Sub Heading", "theme_backend" ),
    "default" => "",
    "size" => 50,
    "id" => "home_slogan_heading_sub",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  array(
    "name" => __( "Description", "theme_backend" ),
    "id" => "home_slogan_heading_desc",
    "rows" => "3",
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/

  /* Sub Option one : Homepage Carousel */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Homepage / Carousel",
    "type" => "heading"
  ),


  array(
    "name" => "Carousel",
    "desc" => __( "Add a carousel slider on homepage right before the footer.", "theme_backend" ),
    "id" => "disable_carousel",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => "Carousel Title Text",
    "desc" => __( "You can add text to label your slider ", "theme_backend" ),
    "id" => "carousel_title_text",
    "default" => 'Latest Projects',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  
  array(
    "name" => "Carousel Description Text",
    "desc" => __( "You can add text to describe your slider ", "theme_backend" ),
    "id" => "carousel_describe_text",
    "default" => '',
	"rows" => "2",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),
  
  
  array(
    "name" => __( "items source", "theme_backend" ),
    "desc" => __( "You can choose which sort of posts you would like to show on you Carousel slider. You can choose between, recent posts, posts form your portfolio or popular posts which is based on the count of the comments on each post.", "theme_backend" ),
    "id" => "carousel_post_type",
    "default" => 'posts',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "posts" => 'Blog Posts',
      "portfolio" => 'Portfolio Posts'
    ),
    "type" => "radio"
  ),
  array(
    "name" => __( "Post Types Categories to Show", "theme_backend" ),
    "desc" => __( "You can edit which categories to show. This option only works when you select blog posts as source", "theme_backend" ),
    "id" => "post_category_filter",
    "default" => array(),
    "options" => $wp_cats,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "multiselect"
  ),

  array(
    "name" => __( "Portfolio Categories to Show", "theme_backend" ),
    "desc" => __( "Which categories to show, This option only works when you select portfolio posts as source", "theme_backend" ),
    "id" => "portfolio_category_filter",
    "default" => array(),
    "target" => 'portfolio_category',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "multiselect"
  ),
  array(
    "name" => __( "Offset", "theme_backend" ),
    "desc" => __( "How many posts you would like to skip", "theme_backend" ),
    "id" => "carousel_offset",
    "min" => "0",
    "max" => "50",
    "step" => "1",
    "unit" => 'Posts',
    "default" => "0",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "Orderby", 'theme_backend' ),
    "desc" => __( "Sort retrieved Portfolio items by parameter.", 'theme_backend' ),
    "id" => "carousel_orderby",
    "default" => 'menu_order',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "none" => __( "No order", 'theme_backend' ),
      "id" => __( "Order by post id", 'theme_backend' ),
      "title" => __( "Order by title", 'theme_backend' ),
      "date" => __( "Order by date", 'theme_backend' ),
      "comment_count" => __( "Order by comment Count", 'theme_backend' ),
      "rand" => __( "Random order", 'theme_backend' ),
    ),
    "type" => "select"
  ),
  array(
    "name" => __( "Order", 'theme_backend' ),
    "desc" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_backend' ),
    "id" => "carousel_order",
    "default" => 'ASC',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "ASC" => __( "Ascending Order", 'theme_backend' ),
      "DESC" => __( "Descending Order", 'theme_backend' )
    ),
    "type" => "radio"
  ),
  array(
    "name" => __( "Post Title", "theme_backend" ),
    "desc" => __( "Enable to include a post title", "theme_backend" ),
    "id" => "disable_title",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Post Category", "theme_backend" ),
    "desc" => __( "Enable to add Post Category.", "theme_backend" ),
    "id" => "carousel_disable_cats",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Post Numbers", "theme_backend" ),
    "desc" => __( "The number of items you would like to be shown on your carousel slider. ", "theme_backend" ),
    "id" => "carousel_showposts_num",
    "min" => "1",
    "max" => "50",
    "step" => "1",
    "unit" => 'Posts',
    "default" => "10",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "Delay", "theme_backend" ),
    "id" => "animation_speed",
    "min" => "50",
    "max" => "2000",
    "step" => "50",
    "unit" => 'Milliecond',
    "default" => "500",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "Auto Sliding", "theme_backend" ),
    "id" => "carousel_auto",
    "default" => "true",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Slider Easing", "theme_backend" ),
    "desc" => __( "Set the easing of the sliding animation.", "theme_backend" ),
    "id" => "carousel_easing",
    "default" => 'easeOutCubic',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "" => 'none',
      "linear" => 'linear',
      "swing" => 'swing',
      "easeInQuad" => 'easeInQuad',
      "easeOutQuad" => 'easeOutQuad',
      "easeInOutQuad" => 'easeInOutQuad',
      "easeInCubic" => 'easeInCubic',
      "easeOutCubic" => 'easeOutCubic',
      "easeInOutCubic" => 'easeInOutCubic',
      "easeInQuart" => 'easeInQuart',
      "easeOutQuart" => 'easeOutQuart',
      "easeInOutQuart" => 'easeInOutQuart',
      "easeInQuint" => 'easeInQuint',
      "easeOutQuint" => 'easeOutQuint',
      "easeInOutQuint" => 'easeInOutQuint',
      "easeInSine" => 'easeInSine',
      "easeOutSine" => 'easeOutSine',
      "easeInOutSine" => 'easeInOutSine',
      "easeInExpo" => 'easeInExpo',
      "easeOutExpo" => 'easeOutExpo',
      "easeInOutExpo" => 'easeInOutExpo',
      "easeInCirc" => 'easeInCirc',
      "easeOutCirc" => 'easeOutCirc',
      "easeInOutCirc" => 'easeInOutCirc',
      "easeInElastic" => 'easeInElastic',
      "easeOutElastic" => 'easeOutElastic',
      "easeInOutElastic" => 'easeInOutElastic',
      "easeInBack" => 'easeInBack',
      "easeOutBack" => 'easeOutBack',
      "easeInOutBack" => 'easeInOutBack',
      "easeInBounce" => 'easeInBounce',
      "easeOutBounce" => 'easeOutBounce',
      "easeInOutBounce" => 'easeInOutBounce'
    ),
    "type" => "select"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/
  
 /* Sub Option one : SEO */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Homepage / SEO",
    "type" => "heading"
  ),
  array(
    "name" => "Homepage Description",
    "desc" => __( "Description which will be displayed in search engines.", "theme_backend" ),
    "id" => "home_desc",
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),
  array(
    "name" => "Homepage Keywords",
    "desc" => __( "Tags which will be used in homepage meta keywords. Use Comma(,) to separate.", "theme_backend" ),
    "id" => "home_tags",
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),
  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


  array(
    "type"=>"end_sub"
  ),

  array(
    "type"=>"end_main_option"
  ),
  /* End Main Pane */



/*-----------------------------------------------------------
  Main Option : Style
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_option"
  ),


  array(
    "type" => "start_sub",
    "options" => array(
	  "general_skin" => __( "Genral Settings", 'backend' ),
      "backgrounds_skin" => __( "Backgrounds", 'backend' ),
	  "fonts" => __( "Fonts", 'backend' ),
      "backgrounds_parallax_skin" => __( "Parallax Backgrounds", 'backend' ),
      "header_skin" => __( "Header Section", 'backend' ),
//	  "slideshow_skin" => __( "Slideshow", 'backend' ),
      "skin_main_navigation_skin" => __( "Main Navigation", 'backend' ),
      "slogan_heading_skin" => __( "Slogan Heading", 'backend' ),
      "page_introduce_skin" => __( "Page Introduce", 'backend' ),
      "sidebar_skin" => __( "Sidebar", 'backend' ),
	  "carousel_skin" => __( "Carousel", 'backend' ),
 //     "client_skin" => __( "Client", 'backend' ),
      "footer_skin" => __( "Footer Section", 'backend' ),
	  "custom_css" => __( "Custom CSS", 'backend' ),

    ),
  ),



  /* Sub Option one : Genral Settings */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Style / General Settings",
    "desc" => __( "These options defines general colors and fonts weight and size. ", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => 'Theme Main Color',
	"desc" => __("Main Color should be dominant and vivid color (for eg. orange, green or light blue). ","theme_backend"),
    "id" => "scheme_main_color",
    "default" => "#E00000",
    "option_structure" => 'sub',
    "divider" => false,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Theme Supporting Color',
	"desc" => __("Supporting color is site's neutral color and dark color (for eg. dark brown or dark gray.)","theme_backend"),
    "id" => "scheme_supporting_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),


  array(
    "name" => 'Body Links Color',
    "id" => "a_color",
    "default" => "#333333",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Body Text Color',
    "id" => "body_text_color",
    "default" => "#666666",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
  array(
    "name" => 'Body Text Size',
    "id" => "body_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "12",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  
   array(
    "name" => 'Body Text Weight',
    "id" => "body_weight",
    "default" => 'normal',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),


  array(
    "name" => 'Heading 1 (h1) Size',
    "id" => "h1_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "36",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  
  array(
    "name" => 'Heading 1 (h1) Weight',
    "id" => "h1_weight",
    "default" => '800',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),

  array(
    "name" => 'Heading 1 (h1) Color',
    "id" => "h1_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
  array(
    "name" => 'Heading 2 (h2) Size',
    "id" => "h2_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "30",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Heading 2 (h2) Weight',
    "id" => "h2_weight",
    "default" => '800',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),

  array(
    "name" => 'Heading 2 (h2) Color',
    "id" => "h2_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Heading 3 (h3) Size',
    "id" => "h3_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "24",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Heading 3 (h3) Weight',
    "id" => "h3_weight",
    "default" => '800',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),


  array(
    "name" => 'Heading 3 (h3) Color',
    "id" => "h3_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Heading 4 (h4) Size',
    "id" => "h4_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "18",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Heading 4 (h4) Weight',
    "id" => "h4_weight",
    "default" => '800',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),


  array(
    "name" => 'Heading 4 (h4) Color',
    "id" => "h4_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),


  array(
    "name" => 'Heading 5 (h5) Size',
    "id" => "h5_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "16",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Heading 5 (h5) Weight',
    "id" => "h5_weight",
    "default" => '800',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),


  array(
    "name" => 'Heading 5 (h5) Color',
    "id" => "h5_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Heading 6 (h6) Size',
    "id" => "h6_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "14",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Heading 6 (h6) Weight',
    "id" => "h6_weight",
    "default" => '800',
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "width"=>180,
    "type" => "select"
  ),

  array(
    "name" => 'Heading 6 (h6) Color',
    "id" => "h6_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


  /* Sub Option one : Backgrounds */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Style / Backgrounds",
    "desc" => __( "In this section you can modify all the backgrounds of your site including header, page, body, footer. Here, you can set the layout you would like your site to look like, then click on different layout sections to add/create differnt backgrounds.", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => __( "Choose between boxed and full width layout", 'theme_backend' ),
    "desc" => __( "Choose between a full or a boxed layout to set how your website's layout will look like.", 'theme_backend' ),
    "id" => "background_selector_orientation",
    "default" => "full_width_layout",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "0px 30px 20px 0",
    "options" => array(
      "boxed_layout" => 'boxed-layout',
      "full_width_layout" => 'full-width-layout',
    ),
    "type" => "visual_selector"
  ),


 /* array(
    "name" => __( "Boxed Layout Outer Shadow Size", "theme_backend" ),
    "desc" => __( "You can have a outer shadow around the box. using this option you in can modify its range size", "theme_backend" ),
    "id" => "boxed_layout_shadow_size",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "0",
    "max" => "60",
    "step" => "1",
    "unit" => 'px',
    "default" => "0",
    "type" => "range"
  ),

    array(
    "name" => __( "Boxed Layout Outer Shadow Intensity", "theme_backend" ),
    "desc" => __( "determines how darker the shadow to be.", "theme_backend" ),
    "id" => "boxed_layout_shadow_intensity",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "0",
    "max" => "1",
    "step" => "0.1",
    "unit" => 'alpha',
    "default" => "0",
    "type" => "range"
  ),
*/

  array(
    "name" => __( "Background Settings", 'theme_backend' ),
    "desc" => __( "Please click on the different sections to modify their backgrounds and don't forget to click <strong><em>apply</em></strong> before you back to modify other part.", 'theme_backend' ),
    "id"=> 'general_backgounds',
    "option_structure" => 'main',
    "divider" => true,
    "type" => "general_background_selector"
  ),


  array(
    "id"=>"body_color",
    "default"=> "#ffffff",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"body_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"body_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"body_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"body_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"body_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"page_color",
    "default"=> "#f6f6f6",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"page_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"page_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"page_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"page_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"page_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"header_color",
    "default"=> "#efefef",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"header_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"header_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"header_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"header_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"header_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"footer_color",
    "default"=> "#e9e8e8",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"footer_image",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"footer_position",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"footer_attachment",
    "default"=> "",
    "type"=> 'hidden_input',
  ),


  array(
    "id"=>"footer_repeat",
    "default"=> "",
    "type"=> 'hidden_input',
  ),

  array(
    "id"=>"footer_source",
    "default"=> "no-image",
    "type"=> 'hidden_input',
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/

  /* Sub Option one : Fonts */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Style / Fonts",
    "type" => "heading"
  ),
  
  array(
    "name" => "Custom font",
    "type" => "heading"
  ),

  array(
    "name" => 'Body Font-Family',
    "id" => "font_family",
    "default" => 'Microsoft YaHei,Arial,Tahoma, Verdana,Helvetica, sans-serif',
    "option_structure" => 'sub',
    "width"=> 430,
    "divider" => true,
    "options" => array(
      'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
      'Arial Black, Gadget, sans-serif' => 'Arial Black, Gadget, sans-serif',
      'Bookman Old Style, serif' => 'Bookman Old Style, serif',
      'Comic Sans MS, cursive' => 'Comic Sans MS, cursive',
      'Courier, monospace' => 'Courier, monospace',
      'Courier New, Courier, monospace' => 'Courier New, Courier, monospace',
      'Garamond, serif' => 'Garamond, serif',
      'Georgia, serif' => 'Georgia, serif',
	  'Microsoft YaHei,Arial,Tahoma, Verdana,Helvetica, sans-serif'=>'Microsoft YaHei,Arial,Tahoma, Verdana,Helvetica, sans-serif',
      'Impact, Charcoal, sans-serif' => 'Impact, Charcoal, sans-serif',
      'MS Sans Serif, Geneva, sans-serif' => 'MS Sans Serif, Geneva, sans-serif',
      'MS Serif, New York, sans-serif' => 'MS Serif, New York, sans-serif',
      'Palatino Linotype, Book Antiqua, Palatino, serif' => 'Palatino Linotype, Book Antiqua, Palatino, serif',
      'Tahoma, Geneva, sans-serif' => 'Tahoma, Geneva, sans-serif',
	  'Lucida Console, Monaco, monospace' => 'Lucida Console, Monaco, monospace',
      'Lucida Sans, Lucida Grande, Lucida Sans Unicode, sans-serif' => ' Lucida Sans, Lucida Grande, Lucida Sans Unicode, sans-serif',
      'Times New Roman, Times, serif' => 'Times New Roman, Times, serif',
      'Trebuchet MS, Helvetica, sans-serif' => 'Trebuchet MS, Helvetica, sans-serif',
      'Verdana, Geneva, sans-serif' => 'Verdana, Geneva, sans-serif'
    ),
    "type" => "select"
  ),

  array(
    "name" => "Custom font",
    "type" => "heading"
  ),

  array(
    "name" => "Choose a font",
    "id" => "custom_fonts_list_1",
    "default" => 'Open+Sans:400,600,700,800',
    "function" => 'fonts_list',
    "type" => "custom"
  ),
  array(
    "id" => "custom_fonts_type_1",
    "default" => 'google',
    "type" => "custom_font"
  ),

  array(
    "name" => "Specify which sections use the above font ",
    "id" => "special_elements_1",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => array(
      'h1, div.anythingSlider .with_description .desc_box, #load_more_posts .text',
      'h2',
      'h3',
      'h4',
      'h5',
      'h6',
      ".carousel_wrapper .title",
      ".pricing_table .plan .price",
      '.site_name',
      '.ws-button',
      '#navigation ul li a',
      '.dropcaps',
      '.tabs a',
      '.toggle_title',
      '.accordion .tab',
      '.portfolio_title',
      '.portfolio_single_category, #portfolios .portfolio_item_category',
      '.client_slider .client_title',
      '#footer_nav a, .copyright',
      '.widget_sub_navigation a'
    ),
    "options" => $font_replacement_objects,
    "type" => "multiselect"
  ),
  
  array(
    "name" => "Custom font",
    "type" => "heading"
  ),
  
  array(
    "id" => "custom_font_type_2",
    "default" => 'cufon',
    "type" => "custom_font"
  ),
  array(
    "name" => "Choose a font",
    "id" => "custom_fonts_list_2",
    "default" => 'Bebas.js',
    "function" => 'fonts_list',
    "type" => "custom"
  ),
  array(
    "name" => "Specify which sections use the above font ",
    "id" => "special_elements_2",
    "divider" => true,
    "default" => array(
      '.footer_slogan'
    ),
    "options" => $font_replacement_objects,
    "type" => "multiselect"
  ),



  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/
  
  /* Sub Option : Parallax Backgrounds Section */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Style / Parallax Backgrounds",
    "desc" => __( "This section gives your the ability to implement Parallax effect on your Body and Page section backgrounds. Parallax will give your backgroudns a sense of 3D effect, it means they will move slower or faster than your page scroll.", "theme_backend" ),
    "type" => "heading"
  ),


  array(
    "name" => __( "Body Parallax", "theme_backend" ),
    "desc" => __( "Add parallax effect on your body background image", "theme_backend" ),
    "id" => "enable_body_parallax",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Body Parallax Speed Factor", "theme_backend" ),
    "desc" => __( "This speed will determine how fast your background moves along the scroll page", "theme_backend" ),
    "id" => "body_parallax_speed",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "0.1",
    "max" => "10",
    "step" => "0.1",
    "unit" => 'factor',
    "default" => "0.5",
    "type" => "range"
  ),



  array(
    "name" => __( "Page Parallax", "theme_backend" ),
    "desc" => __( "Enable this option if you would like to have parallax effect on your body background image", "theme_backend" ),
    "id" => "enable_page_parallax",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Page Parallax Speed Factor", "theme_backend" ),
    "desc" => __( "This speed will determine how fast your background moves along the scroll page", "theme_backend" ),
    "id" => "page_parallax_speed",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "0.1",
    "max" => "10",
    "step" => "0.1",
    "unit" => 'factor',
    "default" => "0.5",
    "type" => "range"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


/* Sub Option one : Skin Header Section */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Style / Header",
    "desc" => __( "In this section you can modify the coloring of the Header Section elements.", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => 'Site Name Color',
    "id" => "site_name_color",
    "default" => "#fff",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
  array(
    "name" => 'Site Name Size',
    "id" => "site_name_size",
    "min" => "10",
    "max" => "60",
    "step" => "1",
    "unit" => 'px',
    "default" => "36",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Site Name Weight',
    "id" => "site_name_weight",
    "default" => '800',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),
  
   array(
    "name" => 'Header Contact Font Color',
    "id" => "header_contact_color",
    "default" => "#A8A8A8",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Header Contact Font Size',
    "id" => "header_contact_size",
    "min" => "10",
    "max" => "30",
    "step" => "1",
    "unit" => 'px',
    "default" => "12",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Header Contact Font Weight',
    "id" => "header_contact_weight",
    "default" => 'bold',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),

  array(
    "name" => 'Header Tagline',
    "id" => "header_tagline_color",
    "default" => "#a8a8a8",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Header Tagline Size',
    "id" => "header_tagline_size",
    "min" => "10",
    "max" => "60",
    "step" => "1",
    "unit" => 'px',
    "default" => "13",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Header Tagline Weight',
    "id" => "header_tagline_weight",
    "default" => 'noraml',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),

  array(
    "name" => 'Header Social Link Background Color',
    "id" => "header_social_background_color",
    "default" => "#999999",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
    array(
    "name" => 'Header Top Content Background Color',
    "id" => "header_top_content_background_color",
    "default" => "#f5f5f5",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
  array(
    "name" => __( "Header Social Link Round Border", "theme_backend" ),
    "desc" => __( "Show round border for social link button.", "theme_backend" ),
    "id" => "enable_header_social_round_border",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/

  /* Sub Option one : Main Navigation */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Style / Main Navigation",
    "desc" => __( "In this section you can modify the coloring of Main Navigation Section.", "theme_backend" ),
    "type" => "heading"
  ),
  
  

  
/*array(
    "name" => 'Main Navigation Style',
    "id" => "main_nav_style",
    "default" => '1',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "1" => 'Style 1',
      "2" => 'Style 2'
    ),
    "width"=>180,
    "type" => "select"
  ),
  
 */ 
  array(
    "name" => __( "Main Navigation Background Image", "theme_backend" ),
    "id" => "nav_background_image",
    "default" => 'nav_back_6',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "20px 30px 0 0",
    "options" => array(
      "nav_back_1" => 'nav_back_thumb_1',
	  "nav_back_2" => 'nav_back_thumb_2',
	  "nav_back_3" => 'nav_back_thumb_3',
	  "nav_back_4" => 'nav_back_thumb_4',
	  "nav_back_5" => 'nav_back_thumb_5',
	  "nav_back_6" => 'nav_back_thumb_6',
	  "nav_back_7" => 'nav_back_thumb_7',
    ),
    "type" => "visual_selector"
  ),

  array(
    "name" => 'Menu Text Hover Color',
    "desc" => __( "This option works when you have chosen style 2 for main navigation.", "theme_backend" ),
    "id" => "main_nav_hover_color",
    "default" => "#fff",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Menu Top Level Text',
    "id" => "main_nav_top_color",
    "default" => "#a5aaaa",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
  
    array(
    "name" => 'Menu Top Level Text Size',
    "id" => "main_nav_top_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "12",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Menu Top Level Text Weight',
    "id" => "main_nav_top_weight",
    "default" => 'normal',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),
  

  array(
    "name" => 'Menu Sub Level Text',
    "id" => "main_nav_sub_color",
    "default" => "#a5aaaa",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
  
  array(
    "name" => 'Menu Sub Level Text Size',
    "id" => "main_nav_sub_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "11",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Menu Sub Level Text Weight',
    "id" => "main_nav_sub_weight",
    "default" => 'normal',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),
  


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/

  /* Sub Option one : Slogan Heading */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Style / Slogan Heading",
    "desc" => __( "This section gives you the opportunity to modify the coloring of Slogan Heading Section which can be added to any page, post, portfolio. Also, this section allows you to load your site slogan or important words.", "theme_backend" ),
    "type" => "heading"
  ),
  array(
    "name" => 'Dominant Title Color',
    "id" => "dominant_title_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Dominant Title Size',
    "id" => "dominant_title_size",
    "min" => "10",
    "max" => "100",
    "step" => "1",
    "unit" => 'px',
    "default" => "50",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => 'Dominant Title Weight',
    "id" => "dominant_title_weight",
    "default" => '800',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),

  array(
    "name" => 'Highlight Title Color',
    "id" => "highlight_title_color",
    "default" => "#E00000",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
   array(
    "name" => 'Highlight Title Size',
    "id" => "highlight_title_size",
    "min" => "10",
    "max" => "100",
    "step" => "1",
    "unit" => 'px',
    "default" => "50",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => 'Highlight Title Weight',
    "id" => "highlight_title_weight",
    "default" => '800',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),




  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/



  /* Sub Option one : Page Introduce */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Style / Page Introduce",
    "desc" => __( "In this section you can modify coloring & Background of Page Introduce Section. Its located in all pages and posts which contains page title and description.", "theme_backend" ),
    "type" => "heading"
  ),


  array(
    "name" => __( 'Page Introduce Title', 'theme_backend' ),
    "id" => "page_introduce_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => __( 'Page Introduce Description', 'theme_backend' ),
    "id" => "page_desc_color",
    "default" => "#888888",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
 array(
    "name" => __( 'Page Introduce Title Size', 'theme_backend' ),
    "id" => "page_introduce_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "30",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( 'Page Introduce Title Weight', 'theme_backend' ),
    "id" => "page_introduce_weight",
    "default" => '800',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),
  array(
    "name" => __( 'Page Introduce Description Size', 'theme_backend' ),
    "id" => "page_desc_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "20",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),


  array(
    "name" => __( "Background", 'theme_backend' ),
    "option_structure" => 'sub',
    "id"=> 'introduce_background',
    "option_structure" => 'main',
    "divider" => true,
    "type" => "custom_background_selector_start"
  ),

  array(
    "id"=>"introduce_bg_color",
    "default"=> "#f6f6f6",
    "type"=> 'custom_background_selector_color',
  ),

  array(
    "id"=>"introduce_bg_repeat",
    "default"=> "",
    "type"=> 'custom_background_selector_repeat',
  ),

  array(
    "id"=>"introduce_bg_attachment",
    "default"=> "",
    "type"=> 'custom_background_selector_attachment',
  ),


  array(
    "id"=>"introduce_bg_position",
    "default"=> "",
    "type"=> 'custom_background_selector_position',
  ),


  array(
    "id"=>"introduce_bg_preset_image",
    "default"=> "",
    "type"=> 'custom_background_selector_image',
  ),

  array(
    "id"=>"introduce_bg_custom_image",
    "default"=> "",
    "type"=> 'custom_background_selector_custom_image',
  ),

  array(
    "id"=>"introduce_bg_image_source",
    "default"=> "no-image",
    "type"=> 'custom_background_selector_source',
  ),

  array(
    "divider" => true,
    "type" => "custom_background_selector_end"
  ),


  array(
    "type"=>"end_sub_option"
  ),
 
  /*****************************/

  /* Sub Option one : Siebar */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Style / Sidebar",
    "desc" => __( "This section allows you to modify the coloring of sidebar elements.", "theme_backend" ),
    "type" => "heading"
  ),
  array(
    "name" => 'Sidebar Title Color',
    "id" => "sidebar_title_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
    array(
    "name" => 'Sidebar Title Size',
    "id" => "sidebar_title_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "16",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Sidebar Title Weight',
    "id" => "sidebar_title_weight",
    "default" => '800',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),

  array(
    "name" => 'Sidebar Text Color',
    "id" => "sidebar_text_color",
    "default" => "#888888",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Sidebar Links',
    "id" => "sidebar_links_color",
    "default" => "#666666",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
  array(
    "name" => 'Sidebar Text Size',
    "id" => "sidebar_text_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "12",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Sidebar Text Weight',
    "id" => "sidebar_text_weight",
    "default" => 'normal',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),





  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/

  /*****************************/

  /* Sub Option one : Carousel */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Style / Carousel",
    "desc" => __( "This section allows you to modify the carousel in home page.", "theme_backend" ),
    "type" => "heading"
  ),


  array(
    "name" => 'Carousel Heading Text Color',
    "id" => "carousel_heading_color",
    "default" => "#696969",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
    array(
    "name" => 'Carousel Background Color',
    "id" => "carousel_background_color",
    "default" => "#f2f2f2",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


  /* Sub Option one : Footer Section */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Style / Footer",
    "desc" => __( "Here, you can modify coloring of Footer section.", "theme_backend" ),
    "type" => "heading"
  ),

  array(
    "name" => 'Footer Top Border',
    "id" => "footer_top_border_enable",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => 'Footer Top Border Border Width',
    "id" => "footer_top_border_size",
    "min" => "1",
    "max" => "20",
    "step" => "1",
    "unit" => 'px',
    "default" => "4",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Footer Top Border Color',
    "id" => "footer_top_border_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),


  array(
    "name" => 'Footer Title Color',
    "id" => "footer_title_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
  
   array(
    "name" => 'Footer Title Size',
    "id" => "footer_title_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "14",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => 'Footer Title Weight',
    "id" => "footer_title_weight",
    "default" => '800',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),


  array(
    "name" => 'Footer Text Color',
    "id" => "footer_text_color",
    "default" => "#666666",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),


  array(
    "name" => 'Footer Text Size',
    "id" => "footer_text_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "11",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  
  array(
    "name" => 'Footer Text Weight',
    "id" => "footer_text_weight",
    "default" => 'normal',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "normal" => 'Normal',
      "bold" => 'bold',
      "bolder" => 'bolder',
      "800" => 'Extra bold'
    ),
    "width"=>180,
    "type" => "select"
  ),

  array(
    "name" => 'Footer Links Color',
    "id" => "footer_links_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  array(
    "name" => 'Footer Links Hover Color',
    "id" => "footer_links_color_hover",
    "default" => "#666666",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Footer Slogan Color',
    "id" => "footer_slogan_color",
    "default" => "#fff",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
    array(
    "name" => 'Footer Slogan Size',
    "id" => "footer_slogan_size",
    "min" => "10",
    "max" => "70",
    "step" => "1",
    "unit" => 'px',
    "default" => "40",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => 'Footer Tagline Color',
    "id" => "footer_tagline_color",
    "default" => "#fff",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
  array(
    "name" => 'Footer Tagline Size',
    "id" => "footer_tagline_size",
    "min" => "10",
    "max" => "50",
    "step" => "1",
    "unit" => 'px',
    "default" => "11",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => 'Sub Footer Background Color',
    "id" => "subfooter_bg_color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Sub Footer Navigation Color',
    "id" => "subfooter_nav_color",
    "default" => "#bbbbbb",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),

  array(
    "name" => 'Sub Footer Copyright Color',
    "id" => "subfooter_copyright_color",
    "default" => "#666666",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


 
  /* Sub Option one : Custom CSS */
  array(
    "type" => "start_sub_option"
  ),


  array(
    "name" => "Style / Custom CSS",
    "type" => "heading"
  ),

  array(
    "name" => __( "Custom CSS", "theme_backend" ),
    "desc" => __( "You can write your own custom css, this way you wont need to modify Theme CSS files.", "theme_backend" ),
    "id" => "custom_css",
    "default" => '',
    "rows" => 20,
    "type" => "textarea"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/




  array(
    "type"=>"end_sub"
  ),

  array(
    "type"=>"end_main_option"
  ),
  /* End Main Pane */


/*-------------------------------------------------------------
					 Main Pane : Blog
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_option"
  ),




  array(
    "type" => "start_sub",
    "options" => array(
      "blog_general" => __( "General Settings", 'backend' ),
      "blog_single_post" => __( "Single Post", 'backend' ),
      "archive_posts" => __( "Archive", 'backend' ),
      "search_posts" => __( "Search", 'backend' ),

    ),
  ),



  /* Sub Option one : General Settings */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Blog / General Settings",
    "type" => "heading"
  ),
  array(
    "name" => __( "Blog Page", "theme_backend" ),
    "desc" => __( "Choose which page you would like to assign as Blog page. The targeted Page will get the Blog Loop and you will be able to change its options.", "theme_backend" ),
    "id" => "blog_page",
    "target" => 'page',
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "prompt" => __( "Choose page..", "theme_backend" ),
    "type" => "select"
  ),
  array(
    "name" => __( "Blog Layout", "theme_backend" ),
    "id" => "blog_layout",
    "default" => "right",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "20px 30px 0 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),

  array(
    "name" => __( "Loop Layout Style", "theme_backend" ),
    "desc" => __( "Select an outline for your blog page using this option", "theme_backend" ),
    "id" => "blog_loop_style",
    "default" => 'classic',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "30px 40px 20px 0",
    "options" => array(
      "classic" => 'blog-loop-classic',
      "classic_thumb" => 'blog-loop-classic-thumbnail',
    ),
    "type" => "visual_selector"
  ),
  array(
    "name" => __( "Blog Classic Style Featured Image Height", "theme_backend" ),
    "id" => "classic_loop_featured_image_height",
    "min" => "100",
    "max" => "1000",
    "step" => "1",
    "default" => "300",
    "unit" => 'px',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "Exclude Categories", "theme_backend" ),
    "desc" => __( "The option allows you to exclude as many categories as you like from your blog loop.", "theme_backend" ),
    "id" => "excluded_cats",
    "default" => array(),
    "target" => "cat",
    "option_structure" => 'sub',
    "divider" => true,
    "prompt" => "Choose category..",
    "type" => "multiselect"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


  /* Sub Option one : Single Post */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Blog,News / Single Post",
    "type" => "heading"
  ),
  array(
    "name" => __( "Single Layout", "theme_backend" ),
    "desc" => __( "This option allows you to define the page layout of Blog Single page as full width without sidebar, left sidebar or right sidebar.", "theme_backend" ),
    "id" => "single_layout",
    "default" => "right",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "20px 30px 0 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),
  array(
    "name" => __( "Featured Image", "theme_backend" ),
    "desc" => __( "This option allows you to add featured image to your blog single page.", "theme_backend" ),
    "id" => "disable_featured_image",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Featured Image Height", "theme_backend" ),
    "id" => "single_featured_image_height",
    "min" => "100",
    "max" => "1000",
    "step" => "1",
    "default" => "300",
    "unit" => 'px',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "Blog Meta", "theme_backend" ),
    "desc" => __( "Enable the blog meta option from here.", "theme_backend" ),
    "id" => "disable_meta",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "About Author Box", "theme_backend" ),
    "desc" => __( "You can enable or disable the about author box from here.", "theme_backend" ),
    "id" => "enable_author",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Disable Social Bookmarks", "theme_backend" ),
    "id" => "enable_single_social_bookmarks",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Related Posts", "theme_backend" ),
    "desc" => __( "If you do not want to display related posts on the bottom of the blog single page then you can disable the option.", "theme_backend" ),
    "id" => "enable_single_related_posts",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Previous & Next Navigation", "theme_backend" ),
    "desc" => __( "You can disable or enable previous or next navigation which you can find it on the bottom of the single blog page before comment section.", "theme_backend" ),
    "id" => "entry_navigation",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Enable / Disbale Blog Posts Comments", "theme_backend" ),
    "id" => "enable_blog_single_comments",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Comments Date Format", "theme_backend" ),
    "desc" => __( "This option allows you to set the date format of your comments section.", "theme_backend" ),
    "id" => "comment_time_format",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => "F j, Y",
    "options" => array(
      "l, F jS, Y" => 'Saturday, November 6th, 2011',
      "D, F jS, Y" => 'Sat, November 6th, 2011',
      "F j, Y g:i A" => 'November 6, 2011 12:50 AM',
      "F j, Y" => 'November 6, 2011',
      "M j, Y" => 'Nov 6, 2011',
      "M j, Y" => 'Nov 6, 2011',
      "Y/m/d" => '2011/11/06',
      "Y-m-d" => '2011-11-06'
    ),
    "type" => "select"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


  /* Sub Option one : Archive */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Blog / Archive",
    "type" => "heading"
  ),
  array(
    "name" => __( "Archive Layout", "theme_backend" ),
    "id" => "archive_layout",
    "default" => "right",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "20px 30px 0 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),

  array(
    "name" => __( "Archive Layout Style", "theme_backend" ),
    "id" => "archive_loop_style",
    "default" => 'classic',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "30px 40px 20px 0",
    "options" => array(
      "classic" => 'blog-loop-classic',
      "classic_thumb" => 'blog-loop-classic-thumbnail',

    ),
    "type" => "visual_selector"
  ),


  array(
    "name" => "Slogan Heading For Archive",
    "id" => "archive_enable_slogan_heading",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Heading", "theme_backend" ),
    "default" => "",
    "size" => 50,
    "id" => "archive_slogan_heading_dominant",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  array(
    "name" => __( "Highlight Heading", "theme_backend" ),
    "default" => "",
    "size" => 50,
    "id" => "archive_slogan_heading_highlight",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  array(
    "name" => __( "Sub Heading", "theme_backend" ),
    "default" => "",
    "size" => 50,
    "id" => "archive_slogan_heading_sub",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  array(
    "name" => __( "Description", "theme_backend" ),
    "id" => "archive_slogan_heading_desc",
    "rows" => "3",
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


  /* Sub Option one : Search */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Blog / Search",
    "type" => "heading"
  ),

  array(
    "name" => __( "Search Layout", "theme_backend" ),
    "id" => "search_layout",
    "default" => "right",
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "20px 30px 0 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),


  array(
    "name" => __( "Search Layout Style", "theme_backend" ),
    "id" => "search_loop_style",
    "default" => 'classic',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "30px 40px 20px 0",
    "options" => array(
      "classic" => 'blog-loop-classic',
      "classic_thumb" => 'blog-loop-classic-thumbnail',

    ),
    "type" => "visual_selector"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


  array(
    "type"=>"end_sub"
  ),

  array(
    "type"=>"end_main_option"
  ),
  /* End Main Option */






  /*----------------------------------------------------------
					 Main Pane : Slideshow
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_option"
  ),




  array(
    "type" => "start_sub",
    "options" => array(
      "general_slideshow" => __( "General Settings", 'backend' ),
      "anything_slider" => __( "Anything Slider", 'backend' ),
	  "anything_slider_animation" => __( "Anything Slider Animation", 'backend' ),
      "flexslider" => __( "Flexslider", 'backend' ),

    ),
  ),



  /* Sub Option one : Slideshow General Settings */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Slideshow / General Settings",
    "type" => "heading"
  ),

  array(
    "name" => "Slideshow",
    "id" => "enable_slideshow",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Select Your Slideshow", "theme_backend" ),
    "desc" => __( "Select which sort of slideshow you would like to include in your website", "theme_backend" ),
    "id" => "slideshow_source",
    "default" => 'flexslider',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "anything_slider" => 'Anything Slider',
      "flexslider" => 'Flexslider',
    ),
    "type" => "select"
  ),

  array(
    "name" => __( "Slides Count", "theme_backend" ),
    "desc" => __( "Set how many Slides to be shown on your slider.", "theme_backend" ),
    "id" => "slideshow_count",
    "min" => "1",
    "max" => "30",
    "step" => "1",
    "default" => "10",
    "unit" => 'Slides',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),


  array(
    "name" => __( "Orderby", 'theme_backend' ),
    "desc" => __( "Sort retrieved Slideshow items by parameter.", 'theme_backend' ),
    "id" => "slideshow_orderby",
    "default" => 'menu_order',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "none" => __( "No order", 'theme_backend' ),
      "id" => __( "Order by post id", 'theme_backend' ),
      "title" => __( "Order by title", 'theme_backend' ),
      "date" => __( "Order by date", 'theme_backend' ),
      "rand" => __( "Random order", 'theme_backend' ),
    ),
    "type" => "select"
  ),
  array(
    "name" => __( "Order", 'theme_backend' ),
    "desc" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_backend' ),
    "id" => "slideshow_order",
    "default" => 'ASC',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "ASC" => __( "Ascending Order", 'theme_backend' ),
      "DESC" => __( "Descending Order", 'theme_backend' )
    ),
    "type" => "radio"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


  /* Sub Option one : Anything Slider */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Slideshow / Anything Slider",
    "type" => "heading"
  ),
  array(
    "name" => __( "Slideshow Items to show", "theme_backend" ),
    "desc" => __( "You may choose which items to be shown on this slideshow. This is fully optional if you leave this field empty, all of the items will be shown", "theme_backend" ),
    "id" => "anythingslider_items",
    "default" => array(),
    "target" => 'slideshow',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "multiselect"
  ),

  array(
    "name" => __( "Slider Controls Style", "theme_backend" ),
    "desc" => __( "This option used to change the style of slidshow arrows and pagination.", "theme_backend" ),
    "id" => "anything_control_style",
    "default" => 'player',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "player" => 'Style1 ',
      "minimal" => 'Style2',
    ),
    "type" => "radio"
  ),

  array(
    "name" => __( "Animation Time", "theme_backend" ),
    "desc" => __( "Set the transition speed (in milliseconds) here", "theme_backend" ),
    "id" => "anything_animation_time",
    "min" => "200",
    "max" => "5000",
    "step" => "100",
    "unit" => 'ms',
    "default" => "800",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "resume Delay", "theme_backend" ),
    "desc" => __( "Resume slideshow after user interaction, only if autoplayLocked is true (in milliseconds).", "theme_backend" ),
    "id" => "anything_resume_delay",
    "min" => "200",
    "max" => "5000",
    "step" => "100",
    "unit" => 'ms',
    "default" => "5000",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "Delay", "theme_backend" ),
    "desc" => __( "Set how long a pause between slideshow transitions should take in AutoPlay mode (in milliseconds).", "theme_backend" ),
    "id" => "anything_delay",
    "min" => "200",
    "max" => "10000",
    "step" => "100",
    "unit" => 'ms',
    "default" => "3000",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "Autoplay", "theme_backend" ),
    "desc" => __( "Enable this option, if you would like slider to autoplay.", "theme_backend" ),
    "id" => "anything_autoplay",
    "default" => "true",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Pause on Hover", "theme_backend" ),
    "desc" => __( "Enable the slideshow pause on hover.", "theme_backend" ),
    "id" => "anything_pauseOnHover",
    "default" => "true",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Pagination", "theme_backend" ),
    "id" => "anything_pagination",
    "default" => "true",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Arrows", "theme_backend" ),
    "id" => "anything_arrows",
    "default" => "true",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Slider Easing", "theme_backend" ),
    "desc" => __( "Set the easing of the sliding animation.", "theme_backend" ),
    "id" => "anything_easing",
    "default" => 'easeInOutExpo',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "" => 'none',
      "linear" => 'linear',
      "swing" => 'swing',
      "easeInQuad" => 'easeInQuad',
      "easeOutQuad" => 'easeOutQuad',
      "easeInOutQuad" => 'easeInOutQuad',
      "easeInCubic" => 'easeInCubic',
      "easeOutCubic" => 'easeOutCubic',
      "easeInOutCubic" => 'easeInOutCubic',
      "easeInQuart" => 'easeInQuart',
      "easeOutQuart" => 'easeOutQuart',
      "easeInOutQuart" => 'easeInOutQuart',
      "easeInQuint" => 'easeInQuint',
      "easeOutQuint" => 'easeOutQuint',
      "easeInOutQuint" => 'easeInOutQuint',
      "easeInSine" => 'easeInSine',
      "easeOutSine" => 'easeOutSine',
      "easeInOutSine" => 'easeInOutSine',
      "easeInExpo" => 'easeInExpo',
      "easeOutExpo" => 'easeOutExpo',
      "easeInOutExpo" => 'easeInOutExpo',
      "easeInCirc" => 'easeInCirc',
      "easeOutCirc" => 'easeOutCirc',
      "easeInOutCirc" => 'easeInOutCirc',
      "easeInElastic" => 'easeInElastic',
      "easeOutElastic" => 'easeOutElastic',
      "easeInOutElastic" => 'easeInOutElastic',
      "easeInBack" => 'easeInBack',
      "easeOutBack" => 'easeOutBack',
      "easeInOutBack" => 'easeInOutBack',
      "easeInBounce" => 'easeInBounce',
      "easeOutBounce" => 'easeOutBounce',
      "easeInOutBounce" => 'easeInOutBounce'
    ),
    "type" => "select"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  
  
  /*****************************/

  /* Sub Option one : Anything Slider Animations */
  
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Slideshow / Anything Slider Animations",
    "type" => "heading"
  ),


  array(
    "name" => __( "Animations", "theme_backend" ),
    "id" => "anything_anim_enable",
    "default" => "false",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Full Width Image Effect", "theme_backend" ),
    "id" => "anything_anim_full_image",
    "default" => 'expand',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "top" => 'Top',
      "bottom" => 'Bottom',
      "left" => 'Left',
      "right" => 'Right',
      "fade" => 'Fade',
      "expand" => 'Expand',
      "listLR" => 'listLR',
      "listRL" => 'listRL',
      "caption-Top" => 'caption-Top',
      "caption-Right" => 'caption-Right',
      "caption-Bottom" => 'caption-Bottom',
      "caption-Left" => 'caption-Left',
    ),
    "type" => "select"
  ),


  array(
    "name" => __( "Heading Text Effect", "theme_backend" ),
    "id" => "anything_anim_title",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => 'top',
    "options" => array(
      "top" => 'Top',
      "bottom" => 'Bottom',
      "left" => 'Left',
      "right" => 'Right',
      "fade" => 'Fade',
      "expand" => 'Expand',
      "listLR" => 'listLR',
      "listRL" => 'listRL',
      "caption-Top" => 'caption-Top',
      "caption-Right" => 'caption-Right',
      "caption-Bottom" => 'caption-Bottom',
      "caption-Left" => 'caption-Left',
    ),
    "type" => "select"
  ),



  array(
    "name" => __( "Description Text Effect", "theme_backend" ),
    "id" => "anything_anim_desc",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => 'left',
    "options" => array(
      "top" => 'Top',
      "bottom" => 'Bottom',
      "left" => 'Left',
      "right" => 'Right',
      "fade" => 'Fade',
      "expand" => 'Expand',
      "listLR" => 'listLR',
      "listRL" => 'listRL',
      "caption-Top" => 'caption-Top',
      "caption-Right" => 'caption-Right',
      "caption-Bottom" => 'caption-Bottom',
      "caption-Left" => 'caption-Left',
    ),
    "type" => "select"
  ),


  array(
    "name" => __( "Button Effect", "theme_backend" ),
    "id" => "anything_anim_button",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => 'bottom',
    "options" => array(
      "top" => 'Top',
      "bottom" => 'Bottom',
      "left" => 'Left',
      "right" => 'Right',
      "fade" => 'Fade',
      "expand" => 'Expand',
      "listLR" => 'listLR',
      "listRL" => 'listRL',
      "caption-Top" => 'caption-Top',
      "caption-Right" => 'caption-Right',
      "caption-Bottom" => 'caption-Bottom',
      "caption-Left" => 'caption-Left',
    ),
    "type" => "select"
  ),


  array(
    "name" => __( "Icon image Effect", "theme_backend" ),
    "desc" => __( "This is image used on with description mode, which lays beside description", "theme_backend" ),
    "id" => "anything_anim_icon_image",
    "default" => 'right',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "top" => 'Top',
      "bottom" => 'Bottom',
      "left" => 'Left',
      "right" => 'Right',
      "fade" => 'Fade',
      "expand" => 'Expand',
      "listLR" => 'listLR',
      "listRL" => 'listRL',
      "caption-Top" => 'caption-Top',
      "caption-Right" => 'caption-Right',
      "caption-Bottom" => 'caption-Bottom',
      "caption-Left" => 'caption-Left',
    ),
    "type" => "select"
  ),
  array(
    "name" => __( "Animations Speed", "theme_backend" ),
    "id" => "anything_anim_speed",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "100",
    "max" => "2000",
    "step" => "10",
    "unit" => 'ms',
    "default" => "600",
    "type" => "range"
  ),
  array(
    "name" => __( "Easing Animations", "theme_backend" ),
    "desc" => __( "Set the easing of the sliding animation.", "theme_backend" ),
    "id" => "anything_anim_easing",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => 'swing',
    "options" => array(
      "" => 'none',
      "linear" => 'linear',
      "swing" => 'swing',
      "easeInQuad" => 'easeInQuad',
      "easeOutQuad" => 'easeOutQuad',
      "easeInOutQuad" => 'easeInOutQuad',
      "easeInCubic" => 'easeInCubic',
      "easeOutCubic" => 'easeOutCubic',
      "easeInOutCubic" => 'easeInOutCubic',
      "easeInQuart" => 'easeInQuart',
      "easeOutQuart" => 'easeOutQuart',
      "easeInOutQuart" => 'easeInOutQuart',
      "easeInQuint" => 'easeInQuint',
      "easeOutQuint" => 'easeOutQuint',
      "easeInOutQuint" => 'easeInOutQuint',
      "easeInSine" => 'easeInSine',
      "easeOutSine" => 'easeOutSine',
      "easeInOutSine" => 'easeInOutSine',
      "easeInExpo" => 'easeInExpo',
      "easeOutExpo" => 'easeOutExpo',
      "easeInOutExpo" => 'easeInOutExpo',
      "easeInCirc" => 'easeInCirc',
      "easeOutCirc" => 'easeOutCirc',
      "easeInOutCirc" => 'easeInOutCirc',
      "easeInElastic" => 'easeInElastic',
      "easeOutElastic" => 'easeOutElastic',
      "easeInOutElastic" => 'easeInOutElastic',
      "easeInBack" => 'easeInBack',
      "easeOutBack" => 'easeOutBack',
      "easeInOutBack" => 'easeInOutBack',
      "easeInBounce" => 'easeInBounce',
      "easeOutBounce" => 'easeOutBounce',
      "easeInOutBounce" => 'easeInOutBounce'
    ),
    "type" => "select"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/



  /* Sub Option one : Flexslider */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Slideshow / Flexslider",
    "type" => "heading"
  ),
  array(
    "name" => __( "Layout", "theme_backend" ),
    "desc" => __( "If you choose full width layout, then you should upload 1920px width images to fit the large screens.", "theme_backend" ),
    "id" => "flexslider_layout",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => 'boxed',
    "options" => array(
      "boxed" => 'Boxed',
      "full_width" => 'Full Width',
    ),
    "type" => "radio"
  ),

  array(
    "name" => __( "Slideshow Items to show", "theme_backend" ),
    "desc" => __( "You may choose which items to be shown on this slideshow. This is fully optional. In case you leave this field empty, all items will be shown", "theme_backend" ),
    "id" => "flexslider_items",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => array(),
    "target" => 'slideshow',
    "type" => "multiselect"
  ),

  array(
    "name" => __( "Slideshow Height", "theme_backend" ),
    "desc" => __( "Adjust your slideshow's height here", "theme_backend" ),
    "id" => "flexslider_height",
    "option_structure" => 'sub',
    "divider" => true,
    "min" => "100",
    "max" => "1000",
    "step" => "10",
    "unit" => 'px',
    "default" => "400",
    "type" => "range"
  ),
  array(
    "name" => __( "Effect", "theme_backend" ),
    "id" => "flexslider_animation",
    "option_structure" => 'sub',
    "divider" => true,
    "default" => 'slide',
    "options" => array(
      "fade" => 'Fade',
      "slide" => 'Slide',
    ),
    "type" => "radio"
  ),

  array(
    "name" => __( "Slide Direction", "theme_backend" ),
    "id" => "flexslider_slideDirection",
    "default" => 'horizontal',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "horizontal" => 'Horizontal',
      "vertical" => 'Vertical',
    ),
    "type" => "radio"
  ),

  array(
    "name" => __( "Autoplay", "theme_backend" ),
    "desc" => __( "Enable autoplay for slider.", "theme_backend" ),
    "id" => "flexslider_slideshow",
    "default" => "true",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Slideshow Speed", "theme_backend" ),
    "desc" => __( "Time elapsed between each autoplay sliding case.", "theme_backend" ),
    "id" => "flexslider_slideshowSpeed",
    "min" => "2000",
    "max" => "20000",
    "step" => "100",
    "unit" => 'ms',
    "default" => "5000",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "Animation Duration", "theme_backend" ),
    "desc" => __( "Speed of animation", "theme_backend" ),
    "id" => "flexslider_animationDuration",
    "min" => "200",
    "max" => "10000",
    "step" => "100",
    "unit" => 'ms',
    "default" => "600",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  array(
    "name" => __( "Disable Caption", "theme_backend" ),
    "desc" => __( "If this option is disabled, the title, description,  read-more button will be disabled.", "theme_backend" ),
    "id" => "flexslider_disableCaption",
    "default" => "true",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Pause on Hover", "theme_backend" ),
    "desc" => __( "If true & the slideshow is active, the slideshow will pause on hover.", "theme_backend" ),
    "id" => "flexslider_pauseOnHover",
    "default" => "true",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


  array(
    "type"=>"end_sub"
  ),

  array(
    "type"=>"end_main_option"
  ),
  /* End Main Pane */




  /*----------------------------------------------------------
					Main Pane : Portfolio
-------------------------------------------------------------*/
  array(
    "type"=>"start_main_option"
  ),




  array(
    "type" => "start_sub",
    "options" => array(
      "portfolio_general" => __( "General Settings", 'backend' ),
      "portfolio_single" => __( "Single Page", 'backend' ),
	  "portfolio_social" => __( "Social Networks", 'backend' ),
    ),
  ),



  /* Sub Option one : Portfolio General Settings */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Portfolio / General Settings",
    "type" => "heading"
  ),
  
    array(
    "name" => __( "Layout", "theme_backend" ),
    "desc" => __( "This option allows you to remove sidebar, place it on the right or left of the single portfolio page. There are three options available, full width, right sidebar and left sidebar.", "theme_backend" ),
    "id" => "portfolio_layout",
    "function" => "layout",
    "default" => 'right',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "20px 30px 0 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),

  array(
    "name" => __( "Post Featured Image", "theme_backend" ),
    "desc" => __( "Using this options you can enable or disable featured image on your single portfolio page.", "theme_backend" ),
    "id" => "portfolio_featured_image",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Post Featured Image Height", "theme_backend" ),
    "id" => "Portfolio_single_image_height",
    "min" => "100",
    "max" => "1000",
    "step" => "1",
    "default" => "300",
    "unit" => 'px',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => "Portfolio Slug",
    "desc" => __( "It is set to 'portfolio' by default but you can change it to anything to suite your preference.", "theme_backend" ),
    "id" => "portfolio_slug",
    "default" => 'portfolio',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/


  /* Sub Option one : Portfolio Single Page */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Portfolio / Single Page",
    "type" => "heading"
  ),


  array(
    "name" => "Post Title",
    "desc" => __( "Disable/Enable your post title here.", "theme_backend" ),
    "id" => "disable_portfolio_title",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => "Post Category",
    "desc" => __( "Disable/Enable your post category.", "theme_backend" ),
    "id" => "disable_portfolio_category",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => "Post Meta",
    "desc" => __( "Disable/Enable your post meta. Post meta includes social share networks and post date.", "theme_backend" ),
    "id" => "disable_portfolio_meta",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => "Post Date",
    "desc" => __( "Disable/Enable your post date.", "theme_backend" ),
    "id" => "disable_post_date",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
 
   array(
    "name" => __( "Post Comment", "theme_backend" ),
    "desc" => __( "Disable/Enable the comment section on your single portfolio page.", "theme_backend" ),
    "id" => "enable_comment",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/

  /* Sub Option one : Portfolio General Settings */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Portfolio / Social Networks",
    "type" => "heading"
  ),

  array(
    "name" => "Disable Social share : Facebook ",
    "id" => "disable_portfolio_facebook",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => "Disable Social share : Twitter ",
    "id" => "disable_portfolio_twitter",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => "Disable Social share : Google Plus ",
    "id" => "disable_portfolio_plus",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => "Disable Social share : Pinterest ",
    "id" => "disable_portfolio_pinterest",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/



  array(
    "type"=>"end_sub"
  ),

  array(
    "type"=>"end_main_option"
  ),
  /* End Main Option */

  /***************************/
  array(
    "type"=>"end"
  )



);
return array(
  'auto' => true,
  'name' => THEME_OPTIONS,
  'options' => $options
);

<?php


$config  = array(
  'title' => __( "Post Options", 'backend' ),
  'id' => 'ws-metaboxes-tabs',
  'pages' => array(
    'post'
  ),
  'callback' => '',
  'context' => 'normal',
  'priority' => 'core'
);

$options = array(
 
  array(
    "type" => "start_sub",
    "options" => array(
      "general" => __( "General Settings", 'backend' ),
      "post-options" => __( "Post Options", 'backend' ),
	  "image_video" => __( "Image and Video", 'backend' ),
      "slogan_heading" => __( "Slogan Heading", 'backend' ),
      "seo" => __( "Post SEO", 'backend' ),
    ),
  ),



  /* Sub Option one : General Option */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "General Settings",
    "type" => "heading"
  ),


  array(
    "name" => __( "Layout", "theme_backend" ),
    "desc" => __( "This option will override the global single blog post layout here for this post.", "theme_backend" ),
    "id" => "_layout",
    "default" => 'right',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "0 30px 30px 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
  ),

  array(
    "name" => "Post Type",
    "id" => "_single_post_type",
    "default" => 'image',
    "options" => array(
      "image" => 'Image',
      "video" => 'Video',
      "document" => "Document"
    ),
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "select"
  ),

  array(
    "name" => "Custom Sidebar",
    "desc" => __( "Assign the custom sidebar to this post.", "theme_backend" ),
    "id" => "_sidebar",
    "default" => '',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => get_sidebar_options(),
    "type" => "select"
  ),


  array(
    "name" => __( "Page Introduce", "theme_backend" ),
    "id" => "_introduce_text_type",
    "options" => array(
      "default" => "Default",
      "title" => "Title only",
      "title_center" => "Title only (Center Align)",
      "title_custom" => "Title & Custom Description",
      "custom" => "Custom Description",
      "disable" => "Disable"
    ),
    "default" => "default",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "select"
  ),
  array(
    "name" => __( "Custom Description", "theme_backend" ),
    "id" => "_custom_introduce_text",
    "rows" => "5",
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/





  /* Sub Option one : Post Option */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Post Option",
    "type" => "heading"
  ),


  

  array(
    "name" => __( "Meta Section", "theme_backend" ),
    "id" => "_disable_meta",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Breadcrumb", "theme_backend" ),
    "id" => "_disable_breadcrumb",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Social Bookmarks", "theme_backend" ),
    "desc" => __( "Show social bookmarks", "theme_backend" ),
    "id" => "_disable_social_share",
    "default" =>'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Tags", "theme_backend" ),
    "desc" => __( "Show tags for post.", "theme_backend" ),
    "id" => "_disable_tags",
    "default" =>'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Related Posts", "theme_backend" ),
    "desc" => __( "Show related posts.", "theme_backend" ),
    "id" => "_disable_related_posts",
    "default" =>'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "About Author Box", "theme_backend" ),
    "desc" => __( "Show about author box.", "theme_backend" ),
    "id" => "_disable_about_author",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/



 /* Sub Option one : Image and Video Settings */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Image and Video Settings",
    "desc" => __( "You can configure feature images and video here.", "theme_backend" ),
    "type" => "heading"
  ),
  
  
  array(
    "name" => __( "Featured Image", "theme_backend" ),
    "desc" => __( "If you do not want to set a featured image kindly disable it here.", "theme_backend" ),
    "id" => "_disable_featured_image",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  
  array(
    "name" => __( "Video Site", "theme_backend" ),
    "id" => "_single_video_site",
    "default" => 'youtube',
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "vimeo" => 'Vimeo',
      "youtube" => 'Youtube',
    ),
    "type" => "select"
  ),

  array(
    "name" => __( "Video Id", "theme_backend" ),
    "desc" => __( "When you fill this text box with the video id it (eg: http://www.youtube.com/watch?v=<strong>12345678901</strong>, https://vimeo.com/<strong>12345678</strong>), instead of featured image, video will be loaded. make sure you have chosen your video site in option above.", "theme_backend" ),
    "id" => "_single_video_id",
    "size" => 20,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "id" => "_random_image_height",
    "fixed_data" => mt_rand( 150, 400 ),
    "type" => "random_height"
  ),
  
  
  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/



  /* Sub Option one : Slogan Option */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Slogan Heading",
    "type" => "heading"
  ),
  array(
    "name" => __( "Heading", "theme_backend" ),
    "default" => "",
    "size" => 50,
    "id" => "_slogan_heading_dominant",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  array(
    "name" => __( "Highlight Heading", "theme_backend" ),
    "default" => "",
    "size" => 50,
    "id" => "_slogan_heading_highlight",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  array(
    "name" => __( "Sub Heading", "theme_backend" ),
    "default" => "",
    "size" => 50,
    "id" => "_slogan_heading_sub",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  array(
    "name" => __( "Description", "theme_backend" ),
    "id" => "_slogan_heading_desc",
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






  /* Sub Option one : Logo Option */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "SEO Options",
    "type" => "heading"
  ),
  
  array(
    "name" => __( "Keywords", "theme_backend" ),
	"desc" => __( "The keywords should separate with Comma. Such as a,b,c ", "theme_backend" ),
    "id" => "_seo_keywords",
    "default" => "",
	"rows" => "2",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),

  array(
    "name" => __( "Description", "theme_backend" ),
    "id" => "_seo_desc",
    "default" => "",
    "rows" => "2",
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


);
new metaboxesGenerator( $config, $options );

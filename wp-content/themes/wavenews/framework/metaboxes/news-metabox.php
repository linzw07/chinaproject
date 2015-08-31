<?php
$config  = array(
  'title' => __( "News Options", 'backend' ),
  'id' => 'ws-metaboxes-tabs',
  'pages' => array(
    'news'
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
	  "image_video" => __( "Image and Video", 'backend' ),
      "slideshow" => __( "Slideshow Options", 'backend' ),
      "slogan_heading" => __( "Slogan Heading", 'backend' ),
      "seo" => __( "SEO", 'backend' ),
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
    "desc" => __( "Override the global single portfolio page layout for this post.", "theme_backend" ),
    "id" => "_layout",
    "default" => 'right',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "0 30px 10px 0",
    "options" => array(
      "left" => 'page-layout-left',
      "right" => 'page-layout-right',
      "full" => 'page-layout-full',
    ),
    "type" => "visual_selector"
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
    "desc" => __( "Disable this option in order to remove featured image from current post.", "theme_backend" ),
    "id" => "_disable_featured_image",
    "default" =>'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Image Height", "theme_backend" ),
    "desc" => __( "Give this option a value, the height of featured image will not be generated while you choose to show random heights.  While uploading featured image you will see the height of image. To disbale manual height change the value of this option to zero ", "theme_backend" ),
    "id" => "_portfolio_image_manual_height",
    "min" => "0",
    "max" => "800",
    "step" => "1",
    "unit" => 'pixels',
    "default" => "300",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),
  
  array(
    "name" => __( "Video URL", "theme_backend" ),
    "desc" => __( "Add videos in place of featured image while viewing lightbox. Please use embed version of video's URL. since Youtube provides different URL for different purposes. For example this is an embed version of youtube URL : http://www.youtube.com/v/xxxxxxxxxxx.", "theme_backend" ),
    "id" => "_portfolio_video",
    "default" => "",
    "size" => 80,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/



  /* Sub Option one : Slideshow Settings */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Slideshow Settings",
    "desc" => __( "You can customize slideshow here.", "theme_backend" ),
    "type" => "heading"
  ),
  array(
    "name" => __( "Slidehsow For this page", "theme_backend" ),
    "desc" => __( "You can enable slideshow for this post and you can choose which items to slide. You can also use one item which will give one static image.", "theme_backend" ),
    "id" => "_enable_slidehsow_for_singular",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Select Your Slideshow", "theme_backend" ),
    "desc" => __( "Select your favorit slider here. ", "theme_backend" ),
    "id" => "_slideshow_source",
    "default" => 'anything_slider',
    "option_structure" => 'sub',
    "width" => 180,
    "divider" => true,
    "options" => array(
      "anything_slider" => 'Anything Slider',
      "flexslider" => 'Flexslider',

    ),
    "type" => "select"
  ),
  array(
    "name" => __( "Slideshow Items to show", "theme_backend" ),
    "desc" => __( " Change which slides you like to show (in the page or post).  This is used for Anything slider and Flexslider.", "theme_backend" ),
    "id" => "_slideshow_items_to_show",
    "default" => array(),
    "target" => 'slideshow',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "multiselect"

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






  /* Sub Option one : SEO Options */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "SEO Options",
    "desc" => __( "SEO tools for optimum traffic ;)", "theme_backend" ),
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

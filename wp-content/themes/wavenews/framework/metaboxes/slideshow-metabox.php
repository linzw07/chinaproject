<?php
$config  = array(
  'title' => __( "Slideshow Options", "theme_backend" ),
  'id' => 'ws-metaboxes-tabs',
  'pages' => array(
    'slideshow'
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
      "style" => __( "Style", 'backend' ),
	  "image_video" => __( "Video", 'backend' ),
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
    "name" => __( "Item Style", "theme_backend" ),
    "desc" => __( "You can define a layout for this slider item. This is only usefull for anythingslide.", "theme_backend" ),
    "id" => "_item_style",
    "default" => 'with_description',
    "option_structure" => 'sub',
    "divider" => true,
    "item_padding" => "0 30px 30px 0",
    "options" => array(
      "with_description" => 'slideshow-with-description',
      "with_caption" => 'slideshow-with-caption',
	  "full_width" => 'slideshow-full-width',
    ),
    "type" => "visual_selector"
  ),
  
  
  
  

array(
    "name" => __( "Link To", "theme_backend" ),
    "desc" => __( "The url that the slider item links to.", "theme_backend" ),
    "id" => "_link_to",
    "default" => "",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "superlink"
  ),
  
  
   array(
    "name" => __( "Slidehsow Link Button", "theme_backend" ),
    "desc" => __( "If you do not want to include a slideshow button please disable it here", "theme_backend" ),
    "id" => "_disable_slideshow_button",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Slider Button Text", "theme_backend" ),
    "id" => "_button_text",
    "default" => 'Get Started',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),
  
  
  array(
    "name" => __( "Slider Description", "theme_backend" ),
    "desc" => __( "The description of the slider item.", "theme_backend" ),
    "id" => "_description",
    "default" => "",
    "rows" => "3",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "textarea"
  ),


  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/





  /* Sub Option one : Style Option */
  array(
    "type" => "start_sub_option"
  ),

  array(
    "name" => "Style Option",
    "type" => "heading"
  ),

  array(
    "name" => __( "Slider Item Background color", "theme_backend" ),
    "id" => "_slider_bg_color",
    "default" => '#5c5c5c',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
   array(
    "name" => __( "Slider Title Color", "theme_backend" ),
    "id" => "_slider_title_color",
    "default" => '#fff',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  
  array(
    "name" => __( "Slider Description Color", "theme_backend" ),
    "id" => "_slider_desc_color",
    "default" => '#fff',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),
  

   array(
    "name" => __( "Slider Button Skin Color", "theme_backend" ),
    "id" => "_button_background_color",
    "default" => 'dark_gray',
    "options" => array(
	  "#9e0c0f" => __( "Carenian", 'theme_backend' ),
	  "#e00000" => __( "Red", 'theme_backend' ),
	  "#f76824" => __( "Red Orange", 'theme_backend' ),
	  "#ffc71a" => __( "Sunglow", 'theme_backend' ),
	  "#15720a" => __( "Green", 'theme_backend' ),
	  "#18b797" => __( "Caribbean Green", 'theme_backend' ),
	  "#35bae7" => __( "Cerulean", 'theme_backend' ),
	  "#0054a5" => __( "Cobult", 'theme_backend' ),
	  "#7e4ca3" => __( "Blue Purpule", 'theme_backend' ),
	  "#ed008c" => __( "Deep Pink", 'theme_backend' ),
	  "#603814" => __( "Dark Brown", 'theme_backend' ),
	  "#9b5b01" => __( "Brown", 'theme_backend' ),
	  "#96c515" => __( "Apple Green", 'theme_backend' ),
	  "#c9b8ae" => __( "Almond", 'theme_backend' ),
	  "#5a8192" => __( "Air Force Blue", 'theme_backend' ),
	  "#252525" => __( "Dark Gray", 'theme_backend' ),
	  "#e0e0e0" => __( "Light Gray", 'theme_backend' ),
                  
    ),
    "width"=> 220,
    "option_structure" => 'sub',
    "divider" => true,
    "base" => 'color',
    "type" => "select"
  ),
  

  
   array(
    "name" => __( "Slider Description Padding Top", "theme_backend" ),
    "id" => "_slider_description_margin_top",
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
    "name" => __( "Image Padding Top & Bottom", "theme_backend" ),
    "desc" => __( "Ajust your image's padding Top & Bottom here", "theme_backend" ),
    "id" => "_slider_image_margin",
    "min" => "0",
    "max" => "100",
    "step" => "1",
    "unit" => 'px',
    "default" => "10",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  

  array(
    "name" => __( "Background Textures", "theme_backend" ),
    "desc" => __( "You can define a preset background textures for this slider item on only 'with description' style.", "theme_backend" ),
    "id" => "_slideshow_item_background_textures",
    "default" => 'none',
    "option_structure" => 'sub',
    "item_padding" => "0 20px 20px 0",
    "divider" => true,
    "type" => "slider_texture"
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
    "name" => "Video Settings",
    "desc" => __( "You can configure video here. Also this is only for anything slider.", "theme_backend" ),
    "type" => "heading"
  ),
  
    array(
    "name" => __( "Video Site", "theme_backend" ),
    "id" => "_video_site",
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
    "desc" => __( "If you fill this text box with the video id it (eg: http://www.youtube.com/watch?v=<strong>12345678901</strong>, https://vimeo.com/<strong>12345678</strong>), instead of featured image, video will be loaded. make sure you have chosen your video site from  option above.", "theme_backend" ),
    "id" => "_video_id",
    "size" => 20,
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
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

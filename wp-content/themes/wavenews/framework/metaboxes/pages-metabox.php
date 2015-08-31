<?php
function get_sidebar_options()
    {
    $sidebars = theme_option(THEME_OPTIONS, 'sidebars');
    if (!empty($sidebars))
        {
        $sidebars_array = explode(',', $sidebars);
        $options        = array();
        foreach ($sidebars_array as $sidebar)
            {
            $options[$sidebar] = $sidebar;
            }
        return $options;
        }
    else
        {
        return array();
        }
    }
$config  = array(
  'title' => __( "Page Options", 'backend' ),
  'id' => 'ws-metaboxes-tabs',
  'pages' => array(
    'page'
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
      "slideshow" => __( "Slideshow", 'backend' ),
      "google_maps" => __( "Google Maps", 'backend' ),
      "slogan_heading" => __( "Slogan Heading", 'backend' ),
      "seo" => __( "Page SEO", 'backend' ),
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
    "desc" => __( "Please choose this page's layout.", "theme_backend" ),
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
    "name" => "Custom Sidebar",
    "desc" => __( "Assign the custom sidebar to this post.", "theme_backend" ),
    "id" => "_sidebar",
    "default" => '',
    "options" => get_sidebar_options(),
    "option_structure" => 'sub',
    "divider" => true,

    "type" => "select"
  ),

  
  array(
    "name" => __( "Page Introduce", "theme_backend" ),
    "id" => "_introduce_text_type",
    "option_structure" => 'sub',
    "divider" => true,
    "options" => array(
      "default" => "Default",
      "title" => "Title only",
      "title_center" => "Title only (Center Align)",
      "title_custom" => "Title & Custom Description",
      "custom" => "Custom Description",
      "disable" => "Disable"
    ),
    "default" => "default",
    "width" => 220,
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





  /* Sub Option one : Slideshow Settings */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Slideshow Settings",
    "type" => "heading"
  ),
  array(
    "name" => __( "Slidehsow For this page", "theme_backend" ),
    "desc" => __( "Enable slideshow for this Post.", "theme_backend" ),
    "id" => "_enable_slidehsow_for_singular",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Select Your Slideshow", "theme_backend" ),
    "desc" => __( "Select your preferable slide show here", "theme_backend" ),
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
    "name" => __( "Slideshow Items to show.", "theme_backend" ),
    "desc" => __( "Choose which slides you would like to show in this page/post.", "theme_backend" ),
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






  /* Sub Option one : Google Maps Options */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "Google Maps Options",
    "type" => "heading"
  ),
  array(
    "name" => __( "Google Map for This Page", "theme_backend" ),
    "desc" => __( "Display google map in this page's header. The Latitude and Longitude are required and the rest are optional.", "theme_backend" ),
    "id" => "_enable_page_gmap",
    "default" => 'false',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),

  array(
    "name" => __( "Map Height", "theme_backend" ),
    "desc" => __( "Set your Maps' height here", "theme_backend" ),
    "id" => "_gmap_height",
    "min" => "100",
    "max" => "800",
    "step" => "1",
    "unit" => '',
    "default" => "400",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( "Latitude", "theme_backend" ),
    "default" => "",
    "size" => 40,
    "id" => "_page_gmap_latitude",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "name" => __( "Longitude", "theme_backend" ),
    "default" => "",
    "size" => 40,
    "id" => "_page_gmap_longitude",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "text"
  ),

  array(
    "name" => __( "Zoom", "theme_backend" ),
    "id" => "_page_gmap_zoom",
    "min" => "1",
    "max" => "19",
    "step" => "1",
    "unit" => '',
    "default" => "14",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( "Pan Control", "theme_backend" ),
    "id" => "_enable_panControl",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Zoom Control", "theme_backend" ),
    "id" => "_enable_zoomControl",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Map Type Control", "theme_backend" ),
    "id" => "_enable_mapTypeControl",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Scale Control", "theme_backend" ),
    "id" => "_enable_scaleControl",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Marker", "theme_backend" ),
    "id" => "_gmap_marker",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
    array(
    "name" => __( "Google Maps Hue, Saturation, Lightness, Gamma", "theme_backend" ),
    "desc" => __( "If you dont want to change maps coloring, brightness and so on, disable this option.", "theme_backend" ),
    "id" => "_disable_coloring",
    "default" => 'true',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "toggle"
  ),
  array(
    "name" => __( "Hue", "theme_backend" ),
    "desc" => __( "Sets the hue of the feature to match the hue of the color supplied. Note that the saturation and lightness of the feature is conserved, which means, the feature will not perfectly match the color supplied .", "theme_backend" ),
    "id" => "_gmap_hue",
    "default" => '#00A4EF',
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  ),


  array(
    "name" => __( "Saturation", "theme_backend" ),
    "desc" => __( "Shifts the saturation of colors by a percentage of the original value if decreasing and a percentage of the remaining value if increasing. Valid values: [-100, 100].", "theme_backend" ),
    "id" => "_gmap_saturation",
    "min" => "-100",
    "max" => "100",
    "step" => "1",
    "unit" => '',
    "default" => "1",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( "Lightness", "theme_backend" ),
    "desc" => __( "Shifts lightness of colors by a percentage of the original value if decreasing and a percentage of the remaining value if increasing. Valid values: [-100, 100].", "theme_backend" ),
    "id" => "_gmap_lightness",
    "min" => "-100",
    "max" => "100",
    "step" => "1",
    "unit" => '',
    "default" => "1",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "name" => __( "Gamma", "theme_backend" ),
    "desc" => __( "Modifies the gamma by raising the lightness to the given power. ", "theme_backend" ),
    "id" => "_gmap_gamma",
    "min" => "0.01",
    "max" => "9.99",
    "step" => "0.01",
    "unit" => '',
    "default" => "1",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "range"
  ),

  array(
    "type"=>"end_sub_option"
  ),
  /*****************************/






  /* Sub Option one : Slogan Heading Option */
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






  /* Sub Option one : SEO Option */
  array(
    "type" => "start_sub_option"
  ),
  array(
    "name" => "SEO Options",
    "type" => "heading"
  ),


  array(
    "name" => __( "Keywords", "theme_backend" ),
    "id" => "_seo_keywords",
	"desc" => __( "The keywords should separate with Comma. Such as a,b,c ", "theme_backend" ),
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

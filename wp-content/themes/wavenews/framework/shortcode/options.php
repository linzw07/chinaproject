<?php

$skin_colors = array(
 "#9e0c0f" => __( "Carenian", 'theme_backend' ),
 "#e00000" => __( "Red", 'theme_backend' ),
  "#f87a0a" => __( "Red Orange", 'theme_backend' ),
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
);

return array(

  array(
    "name" => __( "Accordion", "theme_backend" ),
    "value" => "accordion",
    "options" => array(
      array(
        "name" => __( "Number of pans", "theme_backend" ),
        "id" => "number",
        "min" => "1",
        "max" => "8",
        "step" => "1",
        "default" => "2",
        "type" => "range"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Title", "theme_backend" ), 1 ),
        "id" => "title_1",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Content", "theme_backend" ), 1 ),
        "id" => "content_1",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Title", "theme_backend" ), 2 ),
        "id" => "title_2",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Content", "theme_backend" ), 2 ),
        "id" => "content_2",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Title", "theme_backend" ), 3 ),
        "id" => "title_3",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Content", "theme_backend" ), 3 ),
        "id" => "content_3",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Title", "theme_backend" ), 4 ),
        "id" => "title_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Content", "theme_backend" ), 4 ),
        "id" => "content_4",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Title", "theme_backend" ), 5 ),
        "id" => "title_5",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Content", "theme_backend" ), 5 ),
        "id" => "content_5",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Title", "theme_backend" ), 6 ),
        "id" => "title_6",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Content", "theme_backend" ), 6 ),
        "id" => "content_6",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Title", "theme_backend" ), 7 ),
        "id" => "title_7",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Content", "theme_backend" ), 7 ),
        "id" => "content_7",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Title", "theme_backend" ), 8 ),
        "id" => "title_8",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Accordion %d Content", "theme_backend" ), 8 ),
        "id" => "content_8",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),

  array(
    "name" => __( "Blockquotes", "theme_backend" ),
    "value" => "blockquote",
    "options" => array(
      array(
        "name" => __( "Align", "theme_backend" ),
        "id" => "align",
        "default" => '',
        "prompt" => "Choose one..",
        "options" => array(
          "left" => 'Left',
          "right" => 'Right',
          "center" => 'Center'
        ),
        "type" => "select"
      ),
      array(
        "name" => "Style",
        "id" => "style",
        "default" => 'style1',
        "options" => array(
          "style1" => 'Style 1',
          "style2" => 'Style 2',
          "style3" => 'Style 3',
          "style4" => 'Style 4'
        ),
        "type" => "select"
      ),
      array(
        "name" => "Cite",
        "id" => "cite",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Content", "theme_backend" ),
        "id" => "content",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),
 
  array(
    "name" => __( "Blog", "theme_backend" ),
    "value" => "blog",
    "options" => array(
      array(
        "name" => "Column",
        "id" => "column",
        "default" => '1',
        "options" => array(
          "1" => "One Column",
          "2" => "Two Column",
          "3" => "Three Column",
          "4" => "Four Column"
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Layout", "theme_backend" ),
        "id" => "layout",
        "default" => 'sidebar',
        "options" => array(
          "sidebar" => "With Sidebar",
          "full" => "Full Layout"
        ),
        "type" => "select"
      ),
	  
	  array(
        "name" => __( "Parent Container", "theme_backend" ),
        "id" => "parent_container",
		"default" => 'full',
        "options" => array(
			'full' => __( 'Full Width', 'theme_frontend' ),
			'one_half' => __( 'One Half', 'theme_frontend' ),
			'one_third' => __( 'One Third', 'theme_frontend' ),
			"two_third" => __( 'Two Third', 'theme_frontend' ),
			"one_fourth" => __( 'One Fourth', 'theme_frontend' ),
			"three_fourth" => __( 'Three Fourth', 'theme_frontend' ),
			"one_fifth" => __( 'One Fifth', 'theme_frontend' ),
			"two_fifth" => __( 'Two Fifth', 'theme_frontend' ),
			"three_fifth" => __( 'Three Fifth', 'theme_frontend' ),
			"four_fifth" => __( 'Four Fifth', 'theme_frontend' )
        ),
        "type" => "select"
      ),
	  
      array(
        "name" => __( "Featured Image Height", "theme_backend" ),
        "desc" => "With this option you can set Featured Image height as you wish. Image width will be set based on columns count.",
        "id" => "image_height",
        "min" => "0",
        "max" => "800",
        "step" => "1",
        "unit" => 'px',
        "default" => "250",
        "type" => "range"
      ),
      array(
        "name" => __( "Count", "theme_backend" ),
        "desc" => __( "Number of posts to show per page", "theme_backend" ),
        "id" => "count",
        "default" => '4',
        "min" => 1,
        "max" => 40,
        "step" => "1",
        "type" => "range"
      ),
      array(
        "name" => __( "Offset", "theme_backend" ),
        "desc" => __( "offset (int) - number of post to displace or pass over", "theme_backend" ),
        "id" => "offset",
        "default" => 0,
        "min" => 0,
        "max" => 20,
        "step" => "1",
        "type" => "range"
      ),
      array(
        "name" => __( "Category (optional)", "theme_backend" ),
        "id" => "cat",
        "default" => array(),
        "target" => 'cat',
        "type" => "multiselect"
      ),
      array(
        "name" => __( "Posts (optional)", "theme_backend" ),
        "desc" => __( "The specific posts you want to display", "theme_backend" ),
        "id" => "posts",
        "default" => array(),
        "target" => 'post',
        "type" => "multiselect"
      ),
      array(
        "name" => __( "Featured Image", "theme_backend" ),
        "id" => "featured_image",
        "desc" => __( "If you don't want to show featured image disable this option.", "theme_backend" ),
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => __( "Title", "theme_backend" ),
        "id" => "title",
        "desc" => __( "Enable Title.", "theme_backend" ),
        "default" => 'true',
        "type" => "toggle"
      ),
	  array(
        "name" => __( "Meta Box", "theme_backend" ),
        "id" => "meta",
        "desc" => __( "Enable Meta Box.", "theme_backend" ),
        "default" => 'true',
        "type" => "toggle"
      ),
	  
      array(
        "name" => __( "Excerpt", "theme_backend" ),
        "id" => "excerpt",
        "desc" => __( "Enable Excerpt.", "theme_backend" ),
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => __( "More Button", "theme_backend" ),
        "id" => "more_button",
        "desc" => __( "Show Read More Button.", "theme_backend" ),
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => "More Button Size",
        "id" => "button_size",
        "default" => 'medium',
        "options" => array(
          "small" => "Small",
          "medium" => "Medium",
          "large" => "Large",
        ),
        "type" => "select"
      ),
	   array(
        "name" => "More Button Align",
        "id" => "button_align",
        "default" => 'aligncenter',
        "options" => array(
          "alignleft" => "Left",
          "aligncenter" => "Center",
          "alignright" => "Right",
        ),
        "type" => "select"
      ),
	  
      array(
        "name" => __( "Pagination", "theme_backend" ),
        "id" => "pagination",
        "desc" => __( "Enable pagination", "theme_backend" ),
        "default" => false,
        "type" => "toggle"
      ),

      array(
        "name" => __( "Order", 'theme_frontend' ),
        "desc" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_frontend' ),
        "id" => "order",
        "default" => 'ASC',
        "options" => array(
          "ASC" => __( "Ascending Order", 'theme_frontend' ),
          "DESC" => __( "Descending Order", 'theme_frontend' )
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Orderby", 'theme_frontend' ),
        "desc" => __( "Sort retrieved portfolio items by parameter.", 'theme_frontend' ),
        "id" => "orderby",
        "default" => 'menu_order',
        "options" => array(
          "none" => __( "No order", 'theme_frontend' ),
          "id" => __( "Order by post id", 'theme_frontend' ),
          "author" => __( "Order by author", 'theme_frontend' ),
          "title" => __( "Order by title", 'theme_frontend' ),
          "date" => __( "Order by date", 'theme_frontend' ),
          "rand" => __( "Random order", 'theme_frontend' ),
          "modified" => __( "Order by last modified date", 'theme_frontend' ),
          "comment_count" => __( "Order by number of comments", 'theme_frontend' ),
          "parent" => __( "Order by post/page parent id", 'theme_frontend' )
        ),
        "type" => "select"
      ),
    )
  ),
  
  array(
    "name" => __( "Button", "theme_backend" ),
    "value" => "buttons",
    "options" => array(
      array(
        "name" => __( "Id", "theme_backend" ),
        "id" => "id",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Class", "theme_backend" ),
        "id" => "cssClass",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Size", "theme_backend" ),
        "id" => "Size",
        "default" => 'medium',
        "options" => array(
          "small" => "Small",
          "medium" => "Medium",
          "large" => "Large"
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Align", "theme_backend" ),
        "id" => "align",
        "default" => '',
        "prompt" => "Choose one..",
        "options" => array(
          "alignleft" => __( 'Left', 'theme_frontend' ),
          "alignright" => __( 'Right', 'theme_frontend' ),
          "aligncenter" => __( 'Center', 'theme_frontend' )
        ),
        "type" => "select"
      ),
      array(
        "name" => "Skin",
        "id" => "skin",
        "default" => "",
        "options" => $skin_colors,
        "width"=> 220,
        "option_structure" => 'sub',
        "divider" => true,
        "base" => 'color',
        "type" => "select"
      ),
	
	  
	  
      array(
        "name" => __( "Text", "theme_backend" ),
        "id" => "text",
        "default" => "",
        "type" => "text"
      ),

      array(
        "name" => __( "Link", "theme_backend" ),
        "id" => "link",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Link Target", "theme_backend" ),
        "id" => "linkTarget",
        "default" => '',
        "prompt" => __( "Choose one..", "theme_backend" ),
        "options" => array(
          "_blank" => '_blank',
          "_self" => '_self',
          "_parent" => '_parent',
          "_top" => '_top'
        ),
        "type" => "select"
      )
    )
  ),
  
  array(
    "name" => __( "Callout Box", 'theme_frontend' ),
    "value" => "callout",
    "options" => array(

      array(
        "name" => __( "Title", "theme_backend" ),
        "id" => "title",
        "default" => "",
        "type" => "text",
      ),
      array(
        "name" => __( "Description", "theme_backend" ),
        "id" => "desc",
        "default" => "",
        "type" => "textarea",
      ),
      array(
        "name" => __( "Button Text", "theme_backend" ),
        "id" => "button_text",
        "default" => "",
        "type" => "text",
      ),
      array(
        "name" => __( "Button skin", "theme_backend" ),
        "id" => "button_skin",
        "default" => "",
        "options" => $skin_colors,
        "width"=> 220,
        "option_structure" => 'sub',
        "divider" => true,
        "base" => 'color',
        "type" => "select"
      ),
      array(
        "name" => __( "Button URL", "theme_backend" ),
        "id" => "url",
        "default" => "",
        "type" => "text",
      ),

    )
  ),
  
  array(
    "name" => __( "Code & Pre", "theme_backend" ),
    "value" => "pre_code",
    "options" => array(
      array(
        "name" => "Type",
        "id" => "type",
        "default" => 'code',
        "options" => array(
          "pre" => 'Pre',
          "code" => 'Code'
        ),
        "type" => "select"
      ),
      array(
        "name" => "Content",
        "id" => "content",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),

  array(
    "name" => __( "Columns", "theme_backend" ),
    "value" => "columns",
    "options" => array(
      array(
        "name" => "Type",
        "id" => "type",
        "default" => '0',
        "options" => array(
          "one_half" => __( 'One Half', 'theme_frontend' ),
          "one_half_last" => __( 'One Half Last', 'theme_frontend' ),
          "one_third" => __( 'One Third', 'theme_frontend' ),
          "one_third_last" => __( 'One Third Last', 'theme_frontend' ),
          "two_third" => __( 'Two Third', 'theme_frontend' ),
          "two_third_last" => __( 'Two Third Last', 'theme_frontend' ),
          "one_fourth" => __( 'One Fourth', 'theme_frontend' ),
          "one_fourth_last" => __( 'One Fourth Last', 'theme_frontend' ),
          "three_fourth" => __( 'Three Fourth', 'theme_frontend' ),
          "three_fourth_last" => __( 'Three Fourth Last', 'theme_frontend' ),
          "one_fifth" => __( 'One Fifth', 'theme_frontend' ),
          "one_fifth_last" => __( 'One Fifth Last', 'theme_frontend' ),
          "two_fifth" => __( 'Two Fifth', 'theme_frontend' ),
          "two_fifth_last" => __( 'Two Fifth Last', 'theme_frontend' ),
          "three_fifth" => __( 'Three Fifth', 'theme_frontend' ),
          "three_fifth_last" => __( 'Three Fifth Last', 'theme_frontend' ),
          "four_fifth" => __( 'Four Fifth', 'theme_frontend' ),
          "four_fifth_last" => __( 'Four Fifth Last', 'theme_frontend' ),
          "one_sixth" => __( 'One Sixth', 'theme_frontend' ),
          "one_sixth_last" => __( 'One Sixth Last', 'theme_frontend' ),
          "five_sixth" => __( 'Five Sixth', 'theme_frontend' ),
          "five_sixth_last" => __( 'Five Sixth Last', 'theme_frontend' )
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Content", "theme_backend" ),
        "id" => "content",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),
    
  array(
    "name" => __( "Contact Form", "theme_backend" ),
    "value" => "contactform",
    "options" => array(
      array(
        "name" => __( "email", "theme_backend" ),
        "id" => "email",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Button skin (optional)", "theme_backend" ),
        "id" => "button_skin",
        "default" => "",
        "options" => $skin_colors,
        "width"=> 220,
        "option_structure" => 'sub',
        "divider" => true,
        "base" => 'color',
        "type" => "select"
      ),
      array(
        "name" => __( "Success Text", "theme_backend" ),
        "id" => "content",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),
	

  array(
    "name" => __( "Contact Info", "theme_backend" ),
    "value" => "contact_info",
    "options" => array(
      array(
        "name" => __( "Color (optional)", "theme_backend" ),
        "id" => "color",
        "default" => "",
        "options" => $skin_colors,
        "width"=> 220,
        "option_structure" => 'sub',
        "divider" => true,
        "base" => 'color',
        "type" => "select"
      ),
      array(
        "name" => __( "Phone", 'theme_frontend' ),
        "id" => "phone",
        "default" => "",
        "size" => 30,
        "type" => "text"
      ),
      array(
        "name" => __( "Cell Phone", 'theme_frontend' ),
        "id" => "cellphone",
        "default" => "",
        "size" => 30,
        "type" => "text"
      ),
      array(
        "name" => __( "email", 'theme_frontend' ),
        "id" => "email",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Address", 'theme_frontend' ),
        "id" => "address",
        "default" => "",
        "size" => 30,
        "type" => "text"
      ),
      array(
        "name" => __( "Name", 'theme_frontend' ),
        "id" => "name",
        "default" => "",
        "size" => 30,
        "type" => "text"
      )
    )
  ),
	
  array(
    "name" => __( "Custom List", "theme_backend" ),
    "value" => "customlist",
    "options" => array(
	  array(
       "name" => "Style",
       "id" => "style",
       "default" => 'arrow-right',
       "function" => 'icon_list_style',
	   "divider" => true,
       "type" => "custom"
  	   ),
	  
	array(
    "name" =>  __( "Color", "theme_backend" ),
    "id" => "color",
    "default" => "#151515",
    "option_structure" => 'sub',
    "divider" => true,
    "type" => "color"
  	 ),
      array(
        "name" => __( "Content", "theme_backend" ),
        "id" => "content",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),
	
  array(
    "name" => __( "Divider", "theme_backend" ),
    "value" => "divider",
    "options" => array(
      array(
        "name" => "Type",
        "id" => "style",
        "default" => 'style1',
        "options" => array(
          "top" => "Divider With Top",
          "clearboth" => "Clearboth",
          "style1" => "Style 1",
          "style2" => "Style 2",
          "style3" => "Style 3",
          "style4" => "Style 4",
          "style5" => "Style 5"
        ),
        "type" => "select"
      ),
      array(
        "name" => "Width",
        "id" => "width",
        "default" => 'full',
        "options" => array(
          "full" => "Full Width",
          "two_third" => "Two Third",
          "one_half" => "One Half",
          "one_third" => "One Third",
          "one_fourth" => "One Fourth",
          "one_fifth" => "One Fifth",
          "one_sixth" => "One Sixth"
        ),
        "type" => "select"
      ),
      array(
        "name" => "Align",
        "id" => "align",
        "default" => 'left',
        "options" => array(
          "left" => "Align Left",
          "right" => "Align Right",
          "center" => "Align Center"
        ),
        "type" => "select"
      )
    )
  ),

	
  array(
    "name" => __( "Drop Caps", "theme_backend" ),
    "value" => "dropcaps",
    "options" => array(
      array(
        "name" => "Text",
        "id" => "text",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Style", "theme_backend" ),
        "id" => "capsstyle",
        "default" => "caps_rounded",
        "prompt" => __( "Choose one..", "theme_backend" ),
        "options" => array(
          "simple" => "Simple",
          "fancy" => "Fancy"
        ),
        "type" => "select"
      )
    )
  ),
  
 
  array(
    "name" => __( "Flickr", "theme_backend" ),
    "value" => "flickr",
    "options" => array(
      array(
        "name" => __( "Flickr id (<a href='http://idgettr.com/' target='_blank'>idGettr</a>)", "theme_backend" ),
        "id" => "id",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Count", "theme_backend" ),
        "desc" => "",
        "id" => "count",
        "default" => '4',
        "min" => 0,
        "max" => 20,
        "step" => "1",
        "type" => "range"
      ),
      array(
        "name" => __( "Display", "theme_backend" ),
        "id" => "display",
        "default" => 'latest',
        "options" => array(
          "latest" => 'Latest',
          "random" => 'Random'
        ),
        "type" => "select"
      )
    )
  ),
  
  array(
    "name" => __( "Gallery", "theme_backend" ),
    "value" => "gallery_ws",
    "options" => array(
      array(
        "name" => "Column",
        "id" => "column",
        "default" => '1',
        "options" => array(
          "1" => "One Column",
          "2" => "Two Column",
          "3" => "Three Column",
          "4" => "Four Column"
        ),
        "type" => "select"
      ),
	  
	  array(
        "name" => __( "Layout", "theme_backend" ),
        "id" => "layout",
        "default" => 'sidebar',
        "options" => array(
          "sidebar" => "With Sidebar",
          "full" => "Full Layout"
        ),
        "type" => "select"
      ),
	  
      array(
        "name" => __( "Height of Images", "theme_backend" ),
        "id" => "height",
        "min" => "100",
        "max" => "1000",
        "step" => "10",
        "default" => "300",
        "type" => "range"
      ),
      array(
        "name" => __( "How many Images?", "theme_backend" ),
        "id" => "number",
        "min" => "1",
        "max" => "6",
        "step" => "1",
        "default" => "3",
        "type" => "range"
      ),
      array(
        "name" => sprintf( __( "item %d Title", "theme_backend" ), 1 ),
        "id" => "title_1",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Item %d Image src", "theme_backend" ), 1 ),
        "id" => "src_1",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "item %d Title", "theme_backend" ), 2 ),
        "id" => "title_2",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Item %d Image src", "theme_backend" ), 2 ),
        "id" => "src_2",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "item %d Title", "theme_backend" ), 3 ),
        "id" => "title_3",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Item %d Image src", "theme_backend" ), 3 ),
        "id" => "src_3",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "item %d Title", "theme_backend" ), 4 ),
        "id" => "title_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Item %d Image src", "theme_backend" ), 4 ),
        "id" => "src_4",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "item %d Title", "theme_backend" ), 5 ),
        "id" => "title_5",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Item %d Image src", "theme_backend" ), 5 ),
        "id" => "src_5",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "item %d Title", "theme_backend" ), 6 ),
        "id" => "title_6",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Item %d Image src", "theme_backend" ), 6 ),
        "id" => "src_6",
        "default" => "",
        "type" => "upload"
      )
    )
  ),
  
  array(
    "name" => __( "Google Maps", "theme_backend" ),
    "value" => "gmap",
    "options" => array(
      array(
        "name" => __( "Address (optional)", "theme_backend" ),
        "id" => "address",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Latitude", "theme_backend" ),
        "id" => "latitude",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Longitude", "theme_backend" ),
        "id" => "longitude",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Content for the marker", "theme_backend" ),
        "id" => "html",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Zoom", "theme_backend" ),
        "id" => "zoom",
        "default" => '14',
        "min" => 1,
        "max" => 19,
        "step" => "1",
        "type" => "range"
      ),
      array(
        "name" => __( "Auto popup the info?", 'theme_frontend' ),
        "id" => "popup",
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => __( "Height", "theme_backend" ),
        "id" => "height",
        "default" => '250',
        "min" => 10,
        "max" => 500,
        "step" => "1",
        "type" => "range"
      )
    )
  ),

  
  array(
    "name" => __( "Heading", "theme_backend" ),
    "value" => "fancy_heading",
    "options" => array(
      array(
        "name" => "Style",
        "id" => "style",
        "default" => 'style1',
        "options" => array(
          "style1" => __( 'Style 1', 'theme_frontend' ),
          "style2" => __( 'Style 2', 'theme_frontend' ),
          "style3" => __( 'Style 3', 'theme_frontend' ),
        ),
        "type" => "select"
      ),
      array(
        "name" => "size",
        "id" => "size",
        "default" => 'small',
        "options" => array(
          "small" => __( 'Small', 'theme_frontend' ),
          "medium" => __( 'Medium', 'theme_frontend' ),
          "large" => __( 'Large', 'theme_frontend' ),
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Content", "theme_backend" ),
        "id" => "content",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),
    
  array(
    "name" => __( "Highlight", "theme_backend" ) ,
    "value" => "highlight",
    "options" => array(
      array(
        "name" => __( "Content", "theme_backend" ),
        "id" => "content",
        "default" => "",
        "size" => 60,
        "type" => "text"
      )
    )
  ),
  
	
  array(
    "name" => __( "Icon Link", "theme_backend" ),
    "value" => "icon_link",
    "options" => array(
	  array(
       "name" => "Icon",
       "id" => "style",
       "default" => 'adjust',
       "function" => 'icon_font_list',
	   "divider" => true,
       "type" => "custom"
  	   ),
	  
	  array(
   		 "name" =>  __( "Color", "theme_backend" ),
    	"id" => "color",
    	"default" => "#151515",
    	"option_structure" => 'sub',
    	"divider" => true,
    	"type" => "color"
  	 	),
	  
      array(
        "name" => __( "Href", 'theme_frontend' ),
        "id" => "href",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Link Target", "theme_backend" ),
        "id" => "linkTarget",
        "default" => '',
        "prompt" => __( "Choose one..", "theme_backend" ),
        "options" => array(
          "_blank" => '_blank',
          "_self" => '_self',
          "_parent" => '_parent',
          "_top" => '_top'
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Text", 'theme_frontend' ),
        "id" => "text",
        "default" => "",
        "type" => "text"
      )
    )
  ),

  array(
    "name" => __( "Icon Text", "theme_backend" ),
    "value" => "icon_list",
    "options" => array(
	  array(
       "name" => "Icon",
       "id" => "style",
       "default" => 'adjust',
       "function" => 'icon_font_list',
	   "divider" => true,
       "type" => "custom"
  	   ),
	
	  
	  array(
   		 "name" =>  __( "Color", "theme_backend" ),
    	"id" => "color",
    	"default" => "#151515",
    	"option_structure" => 'sub',
    	"divider" => true,
    	"type" => "color"
  	 	),
	  
      array(
        "name" => __( "Text", "theme_backend" ),
        "id" => "text",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),
  
    array(
    "name" => __( "Icon Box", "theme_backend" ),
    "value" => "icon_box",
    "options" => array(
	  array(
       "name" => __( "Icon", "theme_backend" ),
       "id" => "style",
       "default" => 'adjust',
       "function" => 'icon_font_list',
	   "divider" => true,
       "type" => "custom"
  	   ),
	   
	   
	  array(
   		"name" =>  __( "Title", "theme_backend" ),
      	"id" => "title",
        "size" => 50,
        "default" => "",
    	"divider" => true,
    	"type" => "text"
  	 	),	   	
	  
	  array(
   		 "name" =>  __( "Color", "theme_backend" ),
    	"id" => "color",
    	"default" => "",
    	"option_structure" => 'sub',
    	"divider" => true,
    	"type" => "color"
  	 	),
		
	   array(
   		"name" =>  __( "Button Label", "theme_backend" ),
      	"id" => "button_label",
        "size" => 30,
        "default" => "Read More",
    	"divider" => true,
    	"type" => "text"
  	 	),	
		
		array(
        "name" => __( "Href", 'theme_frontend' ),
        "id" => "href",
		 "size" => 50,
        "default" => "",
        "type" => "text"
     	 ),
		 
     	 array(
        "name" => __( "Link Target", "theme_backend" ),
        "id" => "link_target",
        "default" => '',
        "prompt" => __( "Choose one..", "theme_backend" ),
        "options" => array(
          "_blank" => '_blank',
          "_self" => '_self',
          "_parent" => '_parent',
          "_top" => '_top'
        ),
        "type" => "select"
      ),
			
	  
      array(
        "name" => __( "Text", "theme_backend" ),
        "id" => "text",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),
  
  
  
  array(
    "name" => __( "Image", "theme_backend" ),
    "value" => "image",
    "options" => array(
      array(
        "name" => __( "Image Source Url", "theme_backend" ),
        "id" => "src",
        "size" => 50,
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => __( "Image Title (optional)", "theme_backend" ),
        "id" => "title",
        "size" => 30,
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Image Description (optional)", "theme_backend" ),
        "id" => "desc",
        "rows" => 2,
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => __( "Align (optional)", "theme_backend" ),
        "id" => "align",
        "default" => '',
        "prompt" => __( "Choose one..", "theme_backend" ),
        "options" => array(
          "left" => 'Left',
          "right" => 'Right',
          "center" => 'Center'
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Lightbox", "theme_backend" ),
        "id" => "lightbox",
        "default" => false,
        "type" => "toggle"
      ),
      array(
        "name" => __( "Lightbox group (optional)", "theme_backend" ),
        "id" => "group",
        "default" => '',
        "type" => "text"
      ),
      array(
        "name" => __( "width", "theme_backend" ),
        "id" => "width",
        "default" => '',
        "prompt" => __( "Choose one..", "theme_backend" ),
        "options" => array(
          "full" => 'Full',
          "full_sidebar" => 'Full with sidebar',
          "one_half" => 'One Half',
          "one_half_sidebar" => 'One Half With Sidebar',
          "one_third" => 'One Third',
          "one_third_sidebar" => 'One Third With Sidebar',
          "one_fourth" => 'One Fourth',
          "one_fourth_sidebar" => 'One Fourth With Sidebar'
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Height (optional)", "theme_backend" ),
        "id" => "height",
        "default" => 300,
        "min" => 0,
        "max" => 960,
        "step" => "1",
        "type" => "range"
      ),
      array(
        "name" => __( "Link (optional)", "theme_backend" ),
        "size" => 30,
        "id" => "link",
        "default" => "",
        "type" => "text"
      )
    )
  ),
  
  array(
    "name" => __( "Layouts", "theme_backend" ),
    "value" => __( "layouts", "theme_backend" ),
    "sub" => true,
    "options" => array(
      array(
        "name" => __( "Two Column", "theme_backend" ),
        "value" => "one_half_layout",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_half' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_half_last' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "Three Column", "theme_backend" ),
        "value" => "one_third_layout",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_third' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_third' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_third_last' ),
            "id" => "3",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "Four Column", "theme_backend" ),
        "value" => "one_fourth_layout",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_fourth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fourth' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fourth' ),
            "id" => "3",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fourth_last' ),
            "id" => "4",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "Five Column", "theme_backend" ),
        "value" => "one_fifth_layout",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_fifth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fifth' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fifth' ),
            "id" => "3",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fifth' ),
            "id" => "4",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fifth_last' ),
            "id" => "5",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "Six Column", "theme_backend" ),
        "value" => "one_sixth_layout",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_sixth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_sixth' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_sixth' ),
            "id" => "3",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_sixth' ),
            "id" => "4",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_sixth' ),
            "id" => "5",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_sixth_last' ),
            "id" => "6",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "One Third - Two Third", "theme_backend" ),
        "value" => "one_third_two_third",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_third' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'Two_third_last' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "Two Third - One Third", "theme_backend" ),
        "value" => "two_third_one_third",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'Two_third' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_third_last' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "One Fourth - Three Fourth", "theme_backend" ),
        "value" => "one_fourth_three_fourth",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_fourth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'Three_fourth_last' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "Three Fourth - One Fourth", "theme_backend" ),
        "value" => "three_fourth_one_fourth",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'Three_fourth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fourth_last' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "One Fourth - One Fourth - One Half", "theme_backend" ),
        "value" => "one_fourth_one_fourth_one_half",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_fourth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fourth' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_half_last' ),
            "id" => "3",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "One Fourth - One Half - One Fourth", "theme_backend" ),
        "value" => "one_fourth_one_half_one_fourth",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_fourth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_half' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fourth_last' ),
            "id" => "3",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "One Half - One Fourth - One Fourth", "theme_backend" ),
        "value" => "one_half_one_fourth_one_fourth",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_half' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fourth' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fourth_last' ),
            "id" => "3",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "Four Fifth - One Fifth", "theme_backend" ),
        "value" => "four_fifth_one_fifth",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'Four_fifth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_fifth_last' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "One Fifth - Four Fifth", "theme_backend" ),
        "value" => "one_fifth_four_fifth",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_fifth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'Four_Fifth_last' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "Two Fifth - Three Fifth", "theme_backend" ),
        "value" => "two_fifth_three_fifth",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'Two_fifth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'Three_Fifth_last' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "Three Fifth - Two Fifth", "theme_backend" ),
        "value" => "three_fifth_two_fifth",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'Three_fifth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'Two_Fifth_last' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "One Sixth - Five Sixth", "theme_backend" ),
        "value" => "one_sixth_five_sixth",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_sixth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'Five_sixth_last' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "Five Sixth - One Sixth", "theme_backend" ),
        "value" => "five_sixth_one_sixth",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'Five_sixth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_sixth_last' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          )
        )
      ),
      array(
        "name" => __( "One Sixth - One Sixth - One Sixth - One Half", "theme_backend" ),
        "value" => "one_sixth_one_sixth_one_sixth_one_half",
        "options" => array(
          array(
            "name" => sprintf( "%s Content", 'One_sixth' ),
            "id" => "1",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_sixth' ),
            "id" => "2",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_sixth' ),
            "id" => "3",
            "default" => "",
            "type" => "textarea"
          ),
          array(
            "name" => sprintf( "%s Content", 'One_half_last' ),
            "id" => "4",
            "default" => "",
            "type" => "textarea"
          )
        )
      )
    )
  ),


  array(
    "name" => __( "Message Boxes", "theme_backend" ),
    "value" => "messageboxes",
    "options" => array(
      array(
        "name" => "Type",
        "id" => "type",
        "default" => 'info',
        "options" => array(
          "success" => __( "Success", "theme_backend" ),
          "error" => __( "Error", "theme_backend" ),
          "warning" => __( "Warning", "theme_backend" ),
          "info" => __( "Info", "theme_backend" )
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Content", "theme_backend" ),
        "id" => "content",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),
  
  
    array(
    "name" => __( "News", "theme_backend" ),
    "value" => "news",
    "options" => array(
      array(
        "name" => "Column",
        "id" => "column",
        "default" => '1',
        "options" => array(
          "1" => "One Column",
          "2" => "Two Column",
          "3" => "Three Column",
          "4" => "Four Column"
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Layout", "theme_backend" ),
        "id" => "layout",
        "default" => 'sidebar',
        "options" => array(
          "sidebar" => "With Sidebar",
          "full" => "Full Layout"
        ),
        "type" => "select"
      ),
	  
	  array(
        "name" => __( "Parent Container", "theme_backend" ),
        "id" => "parent_container",
		"default" => 'full',
        "options" => array(
			'full' => __( 'Full Width', 'theme_frontend' ),
			'one_half' => __( 'One Half', 'theme_frontend' ),
			'one_third' => __( 'One Third', 'theme_frontend' ),
			"two_third" => __( 'Two Third', 'theme_frontend' ),
			"one_fourth" => __( 'One Fourth', 'theme_frontend' ),
			"three_fourth" => __( 'Three Fourth', 'theme_frontend' ),
			"one_fifth" => __( 'One Fifth', 'theme_frontend' ),
			"two_fifth" => __( 'Two Fifth', 'theme_frontend' ),
			"three_fifth" => __( 'Three Fifth', 'theme_frontend' ),
			"four_fifth" => __( 'Four Fifth', 'theme_frontend' )
        ),
        "type" => "select"
      ),
	  
      array(
        "name" => __( "Featured Image Height", "theme_backend" ),
        "desc" => "With this option you can set Featured Image height as you wish. Image width will be set based on columns count.",
        "id" => "image_height",
        "min" => "0",
        "max" => "800",
        "step" => "1",
        "unit" => 'px',
        "default" => "250",
        "type" => "range"
      ),
      array(
        "name" => __( "Count", "theme_backend" ),
        "desc" => __( "Number of posts to show per page", "theme_backend" ),
        "id" => "count",
        "default" => '4',
        "min" => 1,
        "max" => 40,
        "step" => "1",
        "type" => "range"
      ),
      array(
        "name" => __( "Offset", "theme_backend" ),
        "desc" => __( "offset (int) - number of post to displace or pass over", "theme_backend" ),
        "id" => "offset",
        "default" => 0,
        "min" => 0,
        "max" => 20,
        "step" => "1",
        "type" => "range"
      ),
      array(
        "name" => __( "Category (optional)", "theme_backend" ),
        "id" => "cat",
        "default" => array(),
        "target" => 'news_category',
        "type" => "multiselect"
      ),
      array(
        "name" => __( "Posts (optional)", "theme_backend" ),
        "desc" => __( "The specific posts you want to display", "theme_backend" ),
        "id" => "posts",
        "default" => array(),
        "target" => 'news',
        "type" => "multiselect"
      ),
      array(
        "name" => __( "Featured Image", "theme_backend" ),
        "id" => "featured_image",
        "desc" => __( "If you don't want to show featured image disable this option.", "theme_backend" ),
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => __( "Title", "theme_backend" ),
        "id" => "title",
        "desc" => __( "Enable Title.", "theme_backend" ),
        "default" => 'true',
        "type" => "toggle"
      ),
	  array(
        "name" => __( "Meta Box", "theme_backend" ),
        "id" => "meta",
        "desc" => __( "Enable Meta Box.", "theme_backend" ),
        "default" => 'true',
        "type" => "toggle"
      ),
	  
      array(
        "name" => __( "Excerpt", "theme_backend" ),
        "id" => "excerpt",
        "desc" => __( "Enable Excerpt.", "theme_backend" ),
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => __( "More Button", "theme_backend" ),
        "id" => "more_button",
        "desc" => __( "Show Read More Button.", "theme_backend" ),
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => "More Button Size",
        "id" => "button_size",
        "default" => 'medium',
        "options" => array(
          "small" => "Small",
          "medium" => "Medium",
          "large" => "Large",
        ),
        "type" => "select"
      ),
	   array(
        "name" => "More Button Align",
        "id" => "button_align",
        "default" => 'aligncenter',
        "options" => array(
          "alignleft" => "Left",
          "aligncenter" => "Center",
          "alignright" => "Right",
        ),
        "type" => "select"
      ),
	  
      array(
        "name" => __( "Pagination", "theme_backend" ),
        "id" => "pagination",
        "desc" => __( "Enable pagination", "theme_backend" ),
        "default" => true,
        "type" => "toggle"
      ),

      array(
        "name" => __( "Order", 'theme_frontend' ),
        "desc" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_frontend' ),
        "id" => "order",
        "default" => 'ASC',
        "options" => array(
          "ASC" => __( "Ascending Order", 'theme_frontend' ),
          "DESC" => __( "Descending Order", 'theme_frontend' )
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Orderby", 'theme_frontend' ),
        "desc" => __( "Sort retrieved portfolio items by parameter.", 'theme_frontend' ),
        "id" => "orderby",
        "default" => 'menu_order',
        "options" => array(
          "none" => __( "No order", 'theme_frontend' ),
          "id" => __( "Order by post id", 'theme_frontend' ),
          "author" => __( "Order by author", 'theme_frontend' ),
          "title" => __( "Order by title", 'theme_frontend' ),
          "date" => __( "Order by date", 'theme_frontend' ),
          "rand" => __( "Random order", 'theme_frontend' ),
          "modified" => __( "Order by last modified date", 'theme_frontend' ),
          "comment_count" => __( "Order by number of comments", 'theme_frontend' ),
          "parent" => __( "Order by post/page parent id", 'theme_frontend' )
        ),
        "type" => "select"
      ),
    )
  ),
  
  
  
  array(
    "name" => __( "Padding Divider", "theme_backend" ),
    "value" => "padding",
    "options" => array(
      array(
        "name" => "Distance",
        "id" => "height",
        "default" => '30',
        "type" => "range"
      )
    )
  ),
  
  array(
    "name" => __( "Portfolio", 'theme_frontend' ),
    "value" => "portfolio",
    "options" => array(

      array(
        "name" => "Column",
        "id" => "column",
        "default" => '1',
        "options" => array(
          "1" => "One Column",
          "2" => "Two Column",
          "3" => "Three Column",
          "4" => "Four Column"
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Load More", 'theme_frontend' ),
        "id" => "pagination",
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => __( "Sortable", 'theme_frontend' ),
        "id" => "sortable",
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => __( "Random Height?", 'theme_frontend' ),
        "desc" => __( "If this option is on, you will get random height between 150 to 400. whenever you create a new portfolio post or update it, the height will be generated randomly. you may disable this option and set a fixed height below for all items.", 'theme_frontend' ),
        "id" => "random_height",
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => __( "Fixed Height", 'theme_frontend' ),
        "desc" => __( "This option works when Random Height option above is off.", 'theme_frontend' ),
        "id" => "fixed_height",
        "default" => '300',
        "min" => 100,
        "max" => 1000,
        "step" => "1",
        "type" => "range"
      ),
      array(
        "name" => __( "Disable Permalink into single post?", 'theme_frontend' ),
        "desc" => __( "If your portfolios does not have single post or just simpley dont need you can enable this option to prevent going through single post. upon clicking the image the lightbox will either show featured image in full size or if you have defined a video it will display videos (youtube, vimeo,...).", 'theme_frontend' ),
        "id" => "disable_permalink",
        "default" => 'false',
        "type" => "toggle"
      ),
      array(
        "name" => __( "Posts Per Page", 'theme_frontend' ),
        "desc" => __( "Number of item to show per page, if set to -1 it will show all posts", 'theme_frontend' ),
        "id" => "max",
        "default" => '-1',
        "min" => -1,
        "max" => 50,
        "step" => "1",
        "type" => "range"
      ),

      array(
        "name" => __( "Category", 'theme_frontend' ),
		"desc" => __( "The specific category you want to display, this is not required.", 'theme_frontend' ),
        "id" => "cat",
        "default" => array(),
        "chosen" => 'true',
        "target" => 'portfolio_category',
        "prompt" => __( "Select Categories..", 'theme_frontend' ),
        "type" => "multiselect"
      ),
      array(
        "name" => __( "Ids", 'theme_frontend' ),
        "desc" => __( "The specific portfolios you want to display, this is not required.", 'theme_frontend' ),
        "id" => "ids",
        "default" => array(),
        "chosen" => 'true',
        "target" => 'portfolio',
        "prompt" => __( "Select Porfolios..", 'theme_frontend' ),
        "type" => "multiselect"
      ),
      array(
        "name" => __( "Order", 'theme_frontend' ),
        "desc" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_frontend' ),
        "id" => "order",
        "default" => 'ASC',
        "options" => array(
          "ASC" => __( "Ascending Order", 'theme_frontend' ),
          "DESC" => __( "Descending Order", 'theme_frontend' )
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Orderby", 'theme_frontend' ),
        "desc" => __( "Sort retrieved portfolio items by parameter.", 'theme_frontend' ),
        "id" => "orderby",
        "default" => 'menu_order',
        "options" => array(
          "none" => __( "No order", 'theme_frontend' ),
          "id" => __( "Order by post id", 'theme_frontend' ),
          "author" => __( "Order by author", 'theme_frontend' ),
          "title" => __( "Order by title", 'theme_frontend' ),
          "date" => __( "Order by date", 'theme_frontend' ),
          "rand" => __( "Random order", 'theme_frontend' ),
          "modified" => __( "Order by last modified date", 'theme_frontend' ),
          "comment_count" => __( "Order by number of comments", 'theme_frontend' ),
          "parent" => __( "Order by post/page parent id", 'theme_frontend' )
        ),
        "type" => "select"
      ),

      array(
        "name" => __( "Gray Scale Images", 'theme_frontend' ),
        "id" => "gray_scale",
        "default" => 'false',
        "type" => "toggle"
      ),
    )
  ),
  
 /* array(
    "name" => __( "Portfolio Newspaper Style", 'theme_frontend' ),
    "value" => "portfolio_newspaper",
    "options" => array(

      array(
        "name" => "Column",
        "id" => "column",
        "default" => '1',
        "options" => array(
          "1" => "One Column",
          "2" => "Two Column",
          "3" => "Three Column",
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Load More", 'theme_frontend' ),
        "id" => "pagination",
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => __( "Sortable?", 'theme_frontend' ),
        "id" => "sortable",
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => __( "Random Height?", 'theme_frontend' ),
        "desc" => __( "If this option is on, you will get random height between 150 to 400. whenever you create a new portfolio post or update it, the height will be generated randomly. you may disable this option and set a fixed height below for all items.", 'theme_frontend' ),
        "id" => "random_height",
        "default" => 'true',
        "type" => "toggle"
      ),
      array(
        "name" => __( "Fixed Height", 'theme_frontend' ),
        "desc" => __( "This option works when Random Height option above is off.", 'theme_frontend' ),
        "id" => "fixed_height",
        "default" => '300',
        "min" => 100,
        "max" => 1000,
        "step" => "1",
        "type" => "range"
      ),

      array(
        "name" => __( "Posts Per Page", 'theme_frontend' ),
        "desc" => __( "Number of item to show per page, if set to -1 it will show all posts", 'theme_frontend' ),
        "id" => "max",
        "default" => '-1',
        "min" => -1,
        "max" => 50,
        "step" => "1",
        "type" => "range"
      ),

      array(
        "name" => __( "Category", 'theme_frontend' ),
		"desc" => __( "The specific category you want to display, this is not required.", 'theme_frontend' ),
        "id" => "cat",
        "default" => array(),
        "chosen" => 'true',
        "target" => 'portfolio_category',
        "prompt" => __( "Select Categories..", 'theme_frontend' ),
        "type" => "multiselect"
      ),
      array(
        "name" => __( "Ids", 'theme_frontend' ),
        "desc" => __( "The specific portfolios you want to display, this is not required.", 'theme_frontend' ),
        "id" => "ids",
        "default" => array(),
        "chosen" => 'true',
        "target" => 'portfolio',
        "prompt" => __( "Select Porfolios..", 'theme_frontend' ),
        "type" => "multiselect"
      ),
      array(
        "name" => __( "Order", 'theme_frontend' ),
        "desc" => __( "Designates the ascending or descending order of the 'orderby' parameter.", 'theme_frontend' ),
        "id" => "order",
        "default" => 'ASC',
        "options" => array(
          "ASC" => __( "Ascending Order", 'theme_frontend' ),
          "DESC" => __( "Descending Order", 'theme_frontend' )
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Orderby", 'theme_frontend' ),
        "desc" => __( "Sort retrieved portfolio items by parameter.", 'theme_frontend' ),
        "id" => "orderby",
        "default" => 'menu_order',
        "options" => array(
          "none" => __( "No order", 'theme_frontend' ),
          "id" => __( "Order by post id", 'theme_frontend' ),
          "author" => __( "Order by author", 'theme_frontend' ),
          "title" => __( "Order by title", 'theme_frontend' ),
          "date" => __( "Order by date", 'theme_frontend' ),
          "rand" => __( "Random order", 'theme_frontend' ),
          "modified" => __( "Order by last modified date", 'theme_frontend' ),
          "comment_count" => __( "Order by number of comments", 'theme_frontend' ),
          "parent" => __( "Order by post/page parent id", 'theme_frontend' )
        ),
        "type" => "select"
      )
    )
  ),
  */
  array(
    "name" => __( "Pricing Table", "theme_backend" ),
 	   "value" => "pricing",
    "options" => array(
      array(
        "name" => __( "How many Plans?", "theme_backend" ),
        "id" => "column",
        "default" => 1,
        "min" => 1,
        "max" => 5,
        "step" => "1",
        "type" => "range"
      ),
      array(
        "name" => __( "Plan Name 1", "theme_backend" ),
        "id" => "name_1",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Price 1", "theme_backend" ),
        "id" => "price_1",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Per 1", "theme_backend" ),
        "desc" => __( "eg: Monthly, Annually, Daily,..", "theme_backend" ),
        "id" => "per_1",
        "default" => "",
        "type" => "text"
      ),

      array(
        "name" => __( "List Items 1", "theme_backend" ),
        "desc" => __( "eg: Monthly, Annually, Daily,..", "theme_backend" ),
        "id" => "list_1",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => __( "Skin 1", "theme_backend" ),
        "desc" => __( "Insert your un-ordered list (HTML code)", "theme_backend" ),
        "id" => "skin_1",
        "default" => "#383838",
        "type" => "color"
      ),
      array(
        "name" => __( "Button Text 1", "theme_backend" ),
        "id" => "button_text_1",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Button URL 1 (including http://)", "theme_backend" ),
        "id" => "url_1",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Popular Plan? 1", "theme_backend" ),
        "desc" => __( "Turn on this option if you want to make this offer highlighted", "theme_backend" ),
        "id" => "popular_1",
        "default" => "",
        "type" => "toggle"
      ),


      array(
        "name" => __( "Plan Name 2", "theme_backend" ),
        "id" => "name_2",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Price 2", "theme_backend" ),
        "id" => "price_2",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Per 2", "theme_backend" ),
        "desc" => __( "eg: Monthly, Annually, Daily,..", "theme_backend" ),
        "id" => "per_2",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "List Items 2", "theme_backend" ),
        "desc" => __( "eg: Monthly, Annually, Daily,..", "theme_backend" ),
        "id" => "list_2",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => __( "Skin 2", "theme_backend" ),
        "desc" => __( "Insert your un-ordered list (HTML code)", "theme_backend" ),
        "id" => "skin_2",
        "default" => "#383838",
        "type" => "color"
      ),
      array(
        "name" => __( "Button Text 2", "theme_backend" ),
        "id" => "button_text_2",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Button URL 2 (including http://)", "theme_backend" ),
        "id" => "url_2",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Popular Plan? 2", "theme_backend" ),
        "desc" => __( "Turn on this option if you want to make this offer highlighted", "theme_backend" ),
        "id" => "popular_1",
        "default" => "",
        "type" => "toggle"
      ),


      array(
        "name" => __( "Plan Name 3", "theme_backend" ),
        "id" => "name_3",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Price 3", "theme_backend" ),
        "id" => "price_3",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Per 3", "theme_backend" ),
        "desc" => __( "eg: Monthly, Annually, Daily,..", "theme_backend" ),
        "id" => "per_3",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "List Items 3", "theme_backend" ),
        "desc" => __( "eg: Monthly, Annually, Daily,..", "theme_backend" ),
        "id" => "list_3",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => __( "Skin 3", "theme_backend" ),
        "desc" => __( "Insert your un-ordered list (HTML code)", "theme_backend" ),
        "id" => "skin_3",
        "default" => "#383838",
        "type" => "color"
      ),
      array(
        "name" => __( "Button Text 3", "theme_backend" ),
        "id" => "button_text_3",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Button URL 3 (including http://)", "theme_backend" ),
        "id" => "url_3",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Popular Plan? 3", "theme_backend" ),
        "desc" => __( "Turn on this option if you want to make this offer highlighted", "theme_backend" ),
        "id" => "popular_3",
        "default" => "",
        "type" => "toggle"
      ),



      array(
        "name" => __( "Plan Name 4", "theme_backend" ),
        "id" => "name_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Price 4", "theme_backend" ),
        "id" => "price_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Per 4", "theme_backend" ),
        "desc" => __( "eg: Monthly, Annually, Daily,..", "theme_backend" ),
        "id" => "per_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "List Items 4", "theme_backend" ),
        "desc" => __( "eg: Monthly, Annually, Daily,..", "theme_backend" ),
        "id" => "list_4",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => __( "Skin 4", "theme_backend" ),
        "desc" => __( "Insert your un-ordered list (HTML code)", "theme_backend" ),
        "id" => "skin_4",
        "default" => "#383838",
        "type" => "color"
      ),
      array(
        "name" => __( "Button Text 4", "theme_backend" ),
        "id" => "button_text_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Button URL 4 (including http://)", "theme_backend" ),
        "id" => "url_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Popular Plan? 4", "theme_backend" ),
        "desc" => __( "Turn on this option if you want to make this offer highlighted", "theme_backend" ),
        "id" => "popular_4",
        "default" => "",
        "type" => "toggle"
      ),




      array(
        "name" => __( "Plan Name 5", "theme_backend" ),
        "id" => "name_5",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Price 5", "theme_backend" ),
        "id" => "price_5",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Per 5", "theme_backend" ),
        "desc" => __( "eg: Monthly, Annually, Daily,..", "theme_backend" ),
        "id" => "per_5",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "List Items 5", "theme_backend" ),
        "desc" => __( "eg: Monthly, Annually, Daily,..", "theme_backend" ),
        "id" => "list_5",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => __( "Skin 5", "theme_backend" ),
        "desc" => __( "Insert your un-ordered list (HTML code)", "theme_backend" ),
        "id" => "skin_5",
        "default" => "#383838",
        "type" => "color"
      ),
      array(
        "name" => __( "Button Text 5", "theme_backend" ),
        "id" => "button_text_5",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Button URL 5 (including http://)", "theme_backend" ),
        "id" => "url_5",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Popular Plan? 5", "theme_backend" ),
        "desc" => __( "Turn on this option if you want to make this offer highlighted", "theme_backend" ),
        "id" => "popular_5",
        "default" => "",
        "type" => "toggle"
      ),

    )
  ),


  array(
    "name" => __( "Recent Comments", "theme_backend" ),
    "value" => "recent_comments",
    "options" => array(
      array(
        "name" => __( "Count", "theme_backend" ),
        "id" => "count",
        "default" => '5',
        "min" => 0,
        "max" => 20,
        "step" => "1",
        "type" => "range"
      )
    )
  ),

    array(
    "name" =>  __( "Slideshow", "theme_backend" ),
    "value" => "slideshow",
    "options" => array(
      array(
        "name" => __( "Height (Default: 300px)", "Miorage" ),
        "id" => "height",
        "default" => '300',
        "min" => 0,
        "max" => 960,
        "step" => "1",
        "type" => "range"
      ),
      array(
        "name" => __( "Width (Default: 620px)", "theme_backend" ),
        "id" => "width",
        "default" => '620',
        "min" => 0,
        "max" => 1000,
        "step" => "1",
        "type" => "range"
      ),
      array(
        "name" => __( "Effects (Default: random)", "theme_backend" ),
        "id" => "effect",
        "default" => 'Fade',
        "options" => array(
          "fade" => 'Fade',
          "slide" => 'Slide'
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Pause", "theme_backend" ),
        "id" => "pause",
        "default" => '7000',
        "min" => 0,
        "max" => 20000,
        "step" => "100",
        "type" => "range"
      ),
      array(
        "name" => __( "Animation Speed", "theme_backend" ),
        "id" => "speed",
        "default" => '600',
        "min" => 0,
        "max" => 10000,
        "step" => "100",
        "type" => "range"
      ),
      array(
        "name" => __( "Number of Slides", "theme_backend" ),
        "id" => "number",
        "min" => "1",
        "max" => "10",
        "step" => "1",
        "default" => "2",
        "type" => "range"
      ),
      array(
        "name" => sprintf( __( "Slide %d Image URL", "theme_backend" ), 1 ),
        "id" => "image_1",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Slide %d Caption", "theme_backend" ), 1 ),
        "id" => "caption_1",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Slide %d Link to", "theme_backend" ), 1 ),
        "id" => "link_1",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Slide %d Image URL", "theme_backend" ), 2 ),
        "id" => "image_2",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Slide %d Caption", "theme_backend" ), 2 ),
        "id" => "caption_2",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Slide %d Link to", "theme_backend" ), 2 ),
        "id" => "link_2",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Slide %d Image URL", "theme_backend" ), 3 ),
        "id" => "image_3",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Slide %d Caption", "theme_backend" ), 3 ),
        "id" => "caption_3",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Slide %d Link to", "theme_backend" ), 3 ),
        "id" => "link_3",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Slide %d Image URL", "theme_backend" ), 4 ),
        "id" => "image_4",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Slide %d Caption", "theme_backend" ), 4 ),
        "id" => "caption_4",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Slide %d Link to", "theme_backend" ), 4 ),
        "id" => "link_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Slide %d Image URL", "theme_backend" ), 5 ),
        "id" => "image_5",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Slide %d Caption", "theme_backend" ), 5 ),
        "id" => "caption_5",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Slide %d Link to", "theme_backend" ), 5 ),
        "id" => "link_5",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Slide %d Image URL", "theme_backend" ), 6 ),
        "id" => "image_6",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Slide %d Caption", "theme_backend" ), 6 ),
        "id" => "caption_6",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Slide %d Link to", "theme_backend" ), 6 ),
        "id" => "link_6",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Slide %d Image URL", "theme_backend" ), 7 ),
        "id" => "image_7",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Slide %d Caption", "theme_backend" ), 7 ),
        "id" => "caption_7",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Slide %d Link to", "theme_backend" ), 7 ),
        "id" => "link_7",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Slide %d Image URL", "theme_backend" ), 8 ),
        "id" => "image_8",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Slide %d Caption", "theme_backend" ), 8 ),
        "id" => "caption_8",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Slide %d Link to", "theme_backend" ), 8 ),
        "id" => "link_8",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Slide %d Image URL", "theme_backend" ), 9 ),
        "id" => "image_9",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Slide %d Caption", "theme_backend" ), 9 ),
        "id" => "caption_9",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Slide %d Link to", "theme_backend" ), 9 ),
        "id" => "link_9",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Slide %d Image URL", "theme_backend" ), 10 ),
        "id" => "image_10",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Slide %d Caption", "theme_backend" ), 10 ),
        "id" => "caption_10",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Slide %d Link to", "theme_backend" ), 10 ),
        "id" => "link_10",
        "default" => "",
        "type" => "text"
      ),
    )
  ),
  
  array(
    "name" => __( "Skill Meter", "theme_backend" ),
    "value" => "skill_meter",
    "options" => array(
      array(
        "name" => "Name",
        "id" => "name",
        "default" => '',
        "type" => "text"
      ),
      array(
        "name" => __( "Percent of knowledge", "theme_backend" ),
        "id" => "percent",
        "min" => "0",
        "max" => "100",
        "step" => "1",
        "default" => "50",
        "type" => "range"
      ),
    )
  ),
  
   array(
    "name" => __( "Sitemap", "theme_backend" ),
    "value" => "sitemap",
    "sub" => true,
    "options" => array(
      array(
        "name" => __( "Sitemap Pages", "theme_backend" ),
        "value" => "sitemap_pages",
        "options" => array(
          array(
            "name" => __( "Number of pages", "theme_backend" ),
            "id" => "number",
            "default" => '10',
            "min" => 0,
            "max" => 200,
            "step" => "1",
            "type" => "range"
          ),
          array(
            "name" => __( "Depth", "theme_backend" ),
            "id" => "depth",
            "default" => '2',
            "min" => 0,
            "max" => 10,
            "step" => "1",
            "type" => "range"
          )
        )
      ),

      array(
        "name" => __( "Sitemap Categories", "theme_backend" ),
        "value" => "sitemap_categories",
        "options" => array(
          array(
            "name" => __( "Number of pages", "theme_backend" ),
            "id" => "number",
            "default" => '10',
            "min" => 0,
            "max" => 200,
            "step" => "1",
            "type" => "range"
          ),
          array(
            "name" => __( "Depth", "theme_backend" ),
            "id" => "depth",
            "default" => '2',
            "min" => 0,
            "max" => 10,
            "step" => "1",
            "type" => "range"
          ),
          array(
            "name" => __( "Show Count", 'theme_frontend' ),
            "id" => "show_count",
            "default" => 'true',
            "type" => "toggle"
          ),
          array(
            "name" => __( "Show Feed", 'theme_frontend' ),
            "id" => "show_feed",
            "default" => 'true',
            "type" => "toggle"
          )
        )
      ),
      array(
        "name" => __( "Sitemap Posts", "theme_backend" ),
        "value" => "sitemap_posts",
        "options" => array(
          array(
            "name" => __( "Number of Posts", "theme_backend" ),
            "id" => "number",
            "default" => '10',
            "min" => 0,
            "max" => 200,
            "step" => "1",
            "type" => "range"
          ),
          array(
            "name" => __( "Category", "theme_backend" ),
            "id" => "cat",
            "default" => array(),
            "target" => 'cat',
            "type" => "multiselect"
          ),
          array(
            "name" => __( "Posts", "theme_backend" ),
            "desc" => __( "The specific posts you don't want to display", "theme_backend" ),
            "id" => "posts",
            "default" => array(),
            "target" => 'post',
            "type" => "multiselect"
          ),
          array(
            "name" => __( "Author", "theme_backend" ),
            "id" => "author",
            "default" => array(),
            "target" => 'author',
            "type" => "multiselect"
          ),
          array(
            "name" => __( "Show Comment", 'theme_frontend' ),
            "id" => "show_comment",
            "default" => 'true',
            "type" => "toggle"
          )
        )
      ),
      array(
        "name" => __( "Sitemap Portfolios", "theme_backend" ),
        "value" => "sitemap_portfolios",
        "options" => array(
          array(
            "name" => __( "Number of Posts", "theme_backend" ),
            "id" => "number",
            "default" => '10',
            "min" => 0,
            "max" => 200,
            "step" => "1",
            "type" => "range"
          ),
          array(
            "name" => __( "Category", "theme_backend" ),
            "id" => "cat",
            "default" => array(),
            "target" => 'portfolio_category',
            "type" => "multiselect"
          ),
          array(
            "name" => __( "Show Comment", 'theme_frontend' ),
            "id" => "show_comment",
            "default" => 'true',
            "type" => "toggle"
          )
        )
      )
    )
  ), 
  
  array(
    "name" => __( "Tables", "theme_backend" ),
    "value" => "tables",
    "options" => array(
      array(
        "name" => __( "Table ID", "theme_backend" ),
        "id" => "id",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Content", "theme_backend" ),
        "id" => "content",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),
  array(
    "name" => __( "Tabs", "theme_backend" ),
    "value" => "tabs",
    "options" => array(
      array(
        "name" => __( "Style", "theme_backend" ),
        "id" => "style",
        "default" => __( 'classic', 'theme_frontend' ),
        "options" => array(
          "classic" => __( "Classic", "theme_backend" ),
		  "modern" => __( "Modern", "theme_backend" ),
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Number of tabs", "theme_backend" ),
        "id" => "number",
        "min" => "1",
        "max" => "6",
        "step" => "1",
        "default" => "2",
        "type" => "range"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 1 ),
        "id" => "title_1",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 1 ),
        "id" => "content_1",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 2 ),
        "id" => "title_2",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 2 ),
        "id" => "content_2",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 3 ),
        "id" => "title_3",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 3 ),
        "id" => "content_3",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 4 ),
        "id" => "title_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 4 ),
        "id" => "content_4",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 5 ),
        "id" => "title_5",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 5 ),
        "id" => "content_5",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 6 ),
        "id" => "title_6",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 6 ),
        "id" => "content_6",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),
  
  
  array(
    "name" => __( "Tag Cloud", "theme_backend" ),
    "value" => "tag_cloud",
    "options" => array(
      array(
        "name" => "Count",
        "id" => "count",
        "default" => '5',
        "min" => 0,
        "max" => 100,
        "step" => "1",
        "type" => "range"
      )
    )
  ),
  
   array(
    "name" => __( "Toggle", "theme_backend" ),
    "value" => "toggle",
    "options" => array(
      array(
        "name" => __( "Title", "theme_backend" ),
        "id" => "title",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Content", "theme_backend" ),
        "id" => "content",
        "default" => "",
        "type" => "textarea"
      )
    )
  ),
  
  array(
    "name" => __( "Testimonial Slider", "theme_backend" ),
    "value" => "testimonial_slider",
    "options" => array(
      array(
        "name" => __( "Auto Slide", "theme_backend" ),
        "desc" => __( "The value you specify is the amount of time between 2 consecutive slides. Set to zero will disables auto-scrolling.", "theme_backend" ),
        "id" => "auto",
        "default" => '3000',
		"unit" => 'millisecond',
        "min" => 0,
        "max" => 10000,
        "step" => "100",
        "type" => "range"
      ),
      array(
        "name" => __( "Speed", "theme_backend" ),
        "id" => "speed",
		"unit" => 'millisecond',
        "default" => '700',
        "min" => 0,
        "max" => 10000,
        "step" => "100",
        "type" => "range"
      ),
      array(
        "name" => "Effect",
        "id" => "effect",
        "default" => 'slide',
        "options" => array(
          "slide" => "Slide",
          "fade" => "Fade"
        ),
        "type" => "select"
      ),
      array(
        "name" => __( "Number of Testimonials", "theme_backend" ),
        "id" => "number",
        "min" => "1",
        "max" => "5",
        "step" => "1",
        "default" => "2",
        "type" => "range"
      ),

      array(
        "name" => sprintf( __( "Image %d", "theme_backend" ), 1 ),
        "id" => "image_1",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Content %d", "theme_backend" ), 1 ),
        "id" => "text_1",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Company Name %d", "theme_backend" ), 1 ),
        "id" => "company_1",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "URL %d", "theme_backend" ), 1 ),
        "id" => "url_1",
        "default" => "",
        "type" => "text"
      ),

      array(
        "name" => sprintf( __( "Image %d", "theme_backend" ), 2 ),
        "id" => "image_2",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Content %d", "theme_backend" ), 2 ),
        "id" => "text_2",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Company Name %d", "theme_backend" ), 2 ),
        "id" => "company_2",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "URL %d", "theme_backend" ), 2 ),
        "id" => "url_2",
        "default" => "",
        "type" => "text"
      ),

      array(
        "name" => sprintf( __( "Image %d", "theme_backend" ), 3 ),
        "id" => "image_3",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Content %d", "theme_backend" ), 3 ),
        "id" => "text_3",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Company Name %d", "theme_backend" ), 3 ),
        "id" => "company_3",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "URL %d", "theme_backend" ), 3 ),
        "id" => "url_3",
        "default" => "",
        "type" => "text"
      ),

      array(
        "name" => sprintf( __( "Image %d", "theme_backend" ), 4 ),
        "id" => "image_4",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Content %d", "theme_backend" ), 4 ),
        "id" => "text_4",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Company Name %d", "theme_backend" ), 4 ),
        "id" => "company_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "URL %d", "theme_backend" ), 4 ),
        "id" => "url_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Image %d", "theme_backend" ), 5 ),
        "id" => "image_5",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Content %d", "theme_backend" ), 5 ),
        "id" => "text_5",
        "default" => "",
        "type" => "textarea"
      ),
      array(
        "name" => sprintf( __( "Company Name %d", "theme_backend" ), 5 ),
        "id" => "company_5",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "URL %d", "theme_backend" ), 5 ),
        "id" => "url_5",
        "default" => "",
        "type" => "text"
      )
    )
  ),

  array(
    "name" => __( "Twitter", "theme_backend" ),
    "value" => "twitter",
    "options" => array(
      array(
        "name" => __( "Username", "theme_backend" ),
        "id" => "username",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => __( "Count", "theme_backend" ),
        "desc" => "",
        "id" => "count",
        "default" => '4',
        "min" => 0,
        "max" => 20,
        "step" => "1",
        "type" => "range"
      )
    )
  ),

  array(
    "name" => __( "Vertical Tabs", "theme_backend" ),
    "value" => "vertical_tabs",
    "options" => array(

      array(
        "name" => __( "Number of tabs", "theme_backend" ),
        "id" => "number",
        "min" => "1",
        "max" => "10",
        "step" => "1",
        "default" => "2",
        "type" => "range"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title Icon (optional)", "theme_backend" ), 1 ),
        "id" => "title_icon_1",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 1 ),
        "id" => "title_1",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 1 ),
        "id" => "content_1",
        "default" => "",
        "type" => "textarea"
      ),

      array(
        "name" => sprintf( __( "Tab %d Title Icon (optional)", "theme_backend" ), 2 ),
        "id" => "title_icon_2",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 2 ),
        "id" => "title_1",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 2 ),
        "id" => "content_2",
        "default" => "",
        "type" => "textarea"
      ),

      array(
        "name" => sprintf( __( "Tab %d Title Icon (optional)", "theme_backend" ), 3 ),
        "id" => "title_icon_3",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 3 ),
        "id" => "title_3",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 3 ),
        "id" => "content_3",
        "default" => "",
        "type" => "textarea"
      ),


      array(
        "name" => sprintf( __( "Tab %d Title Icon (optional)", "theme_backend" ), 4 ),
        "id" => "title_icon_4",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 4 ),
        "id" => "title_4",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 4 ),
        "id" => "content_4",
        "default" => "",
        "type" => "textarea"
      ),


      array(
        "name" => sprintf( __( "Tab %d Title Icon (optional)", "theme_backend" ), 5 ),
        "id" => "title_icon_5",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 5 ),
        "id" => "title_5",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 5 ),
        "id" => "content_5",
        "default" => "",
        "type" => "textarea"
      ),


      array(
        "name" => sprintf( __( "Tab %d Title Icon (optional)", "theme_backend" ), 6 ),
        "id" => "title_icon_6",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 6 ),
        "id" => "title_6",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 6 ),
        "id" => "content_6",
        "default" => "",
        "type" => "textarea"
      ),


      array(
        "name" => sprintf( __( "Tab %d Title Icon (optional)", "theme_backend" ), 7 ),
        "id" => "title_icon_7",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 7 ),
        "id" => "title_7",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 7 ),
        "id" => "content_7",
        "default" => "",
        "type" => "textarea"
      ),


      array(
        "name" => sprintf( __( "Tab %d Title Icon (optional)", "theme_backend" ), 8 ),
        "id" => "title_icon_8",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 8 ),
        "id" => "title_8",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 8 ),
        "id" => "content_8",
        "default" => "",
        "type" => "textarea"
      ),



      array(
        "name" => sprintf( __( "Tab %d Title Icon (optional)", "theme_backend" ), 9 ),
        "id" => "title_icon_9",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 9 ),
        "id" => "title_9",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 9 ),
        "id" => "content_9",
        "default" => "",
        "type" => "textarea"
      ),


      array(
        "name" => sprintf( __( "Tab %d Title Icon (optional)", "theme_backend" ), 10 ),
        "id" => "title_icon_10",
        "default" => "",
        "type" => "upload"
      ),
      array(
        "name" => sprintf( __( "Tab %d Title", "theme_backend" ), 10 ),
        "id" => "title_10",
        "default" => "",
        "type" => "text"
      ),
      array(
        "name" => sprintf( __( "Tab %d Content", "theme_backend" ), 10 ),
        "id" => "content_10",
        "default" => "",
        "type" => "textarea"
      ),



    )
  ),

  array(
    "name" => __( "Video", "theme_backend" ),
    "value" => "video",
    "sub" => true,
    "options" => array(
      array(
        "name" => "YouTube",
        "value" => "youtube",
        "options" => array(
          array(
            "name" => "Clip Id",
            "desc" => "e.g. http://www.youtube.com/watch?v=<span style='color:orange'>12345678901</span>",
            "id" => "clip_id",
            "size" => 30,
            "default" => "",
            "type" => "text"
          ),
          array(
            "name" => __( "Width (optional)", "theme_backend" ),
            "id" => "width",
            "default" => 0,
            "min" => 0,
            "max" => 960,
            "step" => "1",
            "type" => "range"
          ),
          array(
            "name" => __( "Height (optional)", "theme_backend" ),
            "id" => "height",
            "default" => 0,
            "min" => 0,
            "max" => 960,
            "step" => "1",
            "type" => "range"
          )
        )
      ),
      array(
        "name" => "Vimeo",
        "value" => "vimeo",
        "options" => array(
          array(
            "name" => "Clip Id",
            "desc" => "e.g. http://vimeo.com/<span style='color:orange'>123456</span>)",
            "id" => "clip_id",
            "size" => 30,
            "default" => "",
            "type" => "text"
          ),
          array(
            "name" => "Width (optional)",
            "id" => __( "width", "theme_backend" ),
            "default" => 0,
            "min" => 0,
            "max" => 960,
            "step" => "1",
            "type" => "range"
          ),
          array(
            "name" => __( "Height (optional)", "theme_backend" ),
            "id" => "height",
            "default" => 0,
            "min" => 0,
            "max" => 960,
            "step" => "1",
            "type" => "range"
          )
        )
      )
    )
  ),

  array(
    "name" => __( "[raw]", "theme_backend" ),
    "value" => "raw",
    "options" => array(
      array(
        "name" => "Content",
        "desc" => __( "This shortcode disables wordpress automatic formatting. insert your content into textarea if you need to get full control on your formatting.", "theme_backend" ),
        "id" => "content",
        "type" => "textarea"
      )
    )
  )
);



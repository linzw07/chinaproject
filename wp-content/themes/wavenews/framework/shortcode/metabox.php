<?php
require_once (THEME_ADMIN . '/shortcode/create.php');
function theme_get_image_size(){
	$customs =  theme_option('image','customs');
	$sizes = array(
		"small" => "Small",
		"medium" => "Medium",
		"large" => "Large",
	);
	if(!empty($customs)){
		$customs = explode(',',$customs);
		foreach($customs as $custom){
			$sizes[$custom] = ucfirst(strtolower($custom));
		}
	}
	return $sizes;
}

$config = array(
	'title' => 'Shortcode Generator',
	'id' => 'ws-shortcode',
	'pages' => array('page','post','portfolio','news'),
	'callback' => '',
	'context' => 'normal',
	'priority' => 'high',
);
$shortcodes = include(THEME_ADMIN . '/shortcode/options.php');
new shortcodesGenerator($config,$shortcodes);
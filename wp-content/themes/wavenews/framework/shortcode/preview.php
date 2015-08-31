<?php 
$full_path = __FILE__;
$path = explode( 'wp-content', $full_path );
require_once( $path[0] . '/wp-load.php' );
?>
<html>
<head>
<!--[if IE 7 ]><link href="<?php echo THEME_FONT_AWESOME;?>/css/font-awesome-ie7.min.css" media="screen" rel="stylesheet" type="text/css"><![endif]-->
<!--[if IE 7 ]><link href="<?php echo THEME_STYLES;?>/ie7.css" media="screen" rel="stylesheet" type="text/css"><![endif]-->
<!--[if IE 8 ]><link href="<?php echo THEME_STYLES;?>/ie8.css" media="screen" rel="stylesheet" type="text/css"><![endif]-->
<link href="<?php echo THEME_FONT_AWESOME;?>/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo THEME_STYLES.'/shortcodes.css'; ?>">
<link rel="stylesheet" href="<?php echo THEME_STYLES.'/general.css'; ?>">
<link rel="stylesheet" href="<?php echo THEME_STYLES.'/responsive.css'; ?>">
<link rel="stylesheet" href="<?php echo THEME_DIR_URL.'/style.php';?>" type="text/css"/>
</head>
<body class='shortcode_prev' bgcolor="#F1F1F1">
<?php
$shortcode = isset($_REQUEST['shortcode']) ? $_REQUEST['shortcode'] : '';
$shortcode = stripslashes($shortcode);
echo do_shortcode($shortcode);
?>
</body>
</html>

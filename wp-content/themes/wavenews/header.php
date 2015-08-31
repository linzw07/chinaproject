<!DOCTYPE html>
<?php 
/*------------------------------------------------------------- 
		Header
-------------------------------------------------------------*/
?>
<!--[if IE 7]><html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><html <?php language_attributes(); ?>><![endif]-->
<head>
<meta charset="<?php bloginfo( "charset" ); ?>" />
<meta name="Theme Version" content="<?php $theme_data = wp_get_theme(); echo $theme_data['Version']; ?>">
<title><?php bloginfo( "name" ); ?> <?php wp_title( "|", true ); ?></title>
<?php $custom_favicon = theme_option( THEME_OPTIONS, 'custom_favicon' ); if ( $custom_favicon ) : ?>
<link rel="shortcut icon" href="<?php echo $custom_favicon ?>"  />
<?php endif; ?>
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script><![endif]-->
<!--[if IE 7 ]><link href="<?php echo THEME_FONT_AWESOME;?>/css/font-awesome-ie7.min.css" media="screen" rel="stylesheet" type="text/css"><![endif]-->
<!--[if IE 7 ]><link href="<?php echo THEME_STYLES;?>/ie7.css" media="screen" rel="stylesheet" type="text/css"><![endif]-->
<!--[if IE 8 ]><link href="<?php echo THEME_STYLES;?>/ie8.css" media="screen" rel="stylesheet" type="text/css"><![endif]-->
<link href="<?php echo THEME_FONT_AWESOME;?>/css/font-awesome.min.css" media="screen" rel="stylesheet" type="text/css">
<?php
	if ( theme_option( THEME_OPTIONS, 'custom_fonts_type_1' ) == 'google' ) {
?>
<link rel='stylesheet' id='google-font-api-css'  href='http://fonts.googleapis.com/css?family=<?php echo theme_option( THEME_OPTIONS, 'custom_fonts_list_1' ); ?>' type='text/css' media='all' />
<?php
}
	if ( theme_option( THEME_OPTIONS, 'custom_font_type_2' ) == 'google' ) {
?>
<link rel='stylesheet' id='google-font-api-css'  href='http://fonts.googleapis.com/css?family=<?php echo theme_option( THEME_OPTIONS, 'custom_fonts_list_2' ); ?>' type='text/css' media='all' />
<?php } ?>
<script type="text/javascript">
	var body_parallax_speed = "<?php echo theme_option(THEME_OPTIONS, 'body_parallax_speed'); ?>";
	var page_parallax_speed = "<?php echo theme_option(THEME_OPTIONS, 'page_parallax_speed'); ?>";
</script>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="application/atom+xml" title="<?php bloginfo( 'name' ); ?> Atom Feed" href="<?php bloginfo( 'atom_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<?php if ( theme_option( THEME_OPTIONS, 'disable_responsive' ) == 'false' ) { ?>
<style>
@media only screen and (max-width : 1024px) {
body {width:1024px !important}
}
</style>
<?php } else { ?>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<?php } ?>
</head>

<body class="<?php if ( is_home() ) : ?> homepage_class <?php else : echo basename( get_permalink() ); endif; ?> <?php if(theme_option(THEME_OPTIONS, 'enable_body_parallax') == 'true') : ?>ws-body-parallax<?php endif; ?> <?php if(theme_option(THEME_OPTIONS, 'enable_nicescroll') == 'true') : ?>ws-nicescroll<?php endif; ?>"   <?php body_class(); ?> >
<div <?php body_class(); ?>>
<?php
if ( theme_option( THEME_OPTIONS, 'enable_side_social_networks' ) == 'true' ) : theme_function( 'side_social' ); endif;
?>
<?php if ( theme_option( THEME_OPTIONS, 'background_selector_orientation' ) == 'boxed_layout' ) { ?>
<div class="boxed_layout">
<?php } ?>
<header id="header" class="<?php if ( theme_option( THEME_OPTIONS, 'enable_header_fixed' ) == 'true' ) : ?> fixed_header <?php else : ?> relative_header <?php endif; ?>">
<div class="header_upper">
<div id="header_top_container" >
<div id="header_content">

<div class="top-navigation-left">

<?php 
$header_phone = theme_option( THEME_OPTIONS, 'header_phone_number' );
$header_email = theme_option( THEME_OPTIONS, 'header_email_address' );

?>

<?php if($header_phone): ?>
<span>
<i class="icon-phone header_content-icon" ></i> <?php echo $header_phone; ?>
</span>
<?php endif;?>
<?php if($header_email): ?>
<span>
<i class="icon-envelope-alt header_content-icon"></i> <?php echo $header_email; ?>
</span>
<?php endif;?>
</div>


<?php
if ( theme_option( THEME_OPTIONS, 'enable_header_social_networks' ) == 'true' ) {
    theme_function( 'header_social' );
}

if(theme_option( THEME_OPTIONS, 'disable_header_tagline' ) != 'false') {
?>
   <span class="header_tagline"><?php bloginfo( 'description' ); ?></span>

<?php
}

?>
</div>
<div class="clearboth"></div>
</div>
<div class="inner">
<?php
    $custom_logo = theme_option( THEME_OPTIONS, 'logo' );
if ( theme_option( THEME_OPTIONS, 'display_logo' ) == 'true' ):
    if ( !empty( $custom_logo ) ) {
?>
            <span class="logo">
            <a href="<?php echo home_url( '/' ); ?>"><img class="custom_logo ie_png" alt="" src="<?php echo $custom_logo; ?>" /></a>
            </span>
            <?php } else { ?>
            <span class="logo">
            <a href="<?php echo home_url( '/' ); ?>"><img class="custom_logo ie_png" alt="" src="<?php echo THEME_IMAGES; ?>/logo.png" /></a>
            </span>
            <?php } ?>
            <?php else: ?>
            <span class="logo">
            <a class="site_name" href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a>
            <?php $site_desc = get_bloginfo( 'description' ); if ( !empty( $site_desc ) ):?>
            <span class="site_description"><?php bloginfo( 'description' ); ?></span>
            <?php endif; ?>
            </span>
            <?php endif;


if ( theme_option( THEME_OPTIONS, 'enable_main_nav' ) == 'true' ) : ?>
            <div id="navigation_wrapper" class="main_nav_style_2">
            <?php theme_function( 'primary_menu' );?>
            <div class="clearboth"></div>
            </div>
            <?php endif; ?>

    <div class="clearboth"></div>
</div>	
</div>
<div id="navigation_shadows"></div>
  <div class="clearboth"></div>
</header>

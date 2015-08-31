<?php
class Theme_admin {
	function init(){
		$this->functions();
		add_action('admin_menu', array(&$this,'menus'));
		$this->theme_activated();

	}
	

	function functions(){
		require_once(THEME_ADMIN .'/framework-functions.php');
		require_once(THEME_ADMIN .'/backend-scripts.php');
		require_once(THEME_ADMIN .'/media-upload.php');
		
		require_once(THEME_SHORTCODES . '/create.php');
		require_once(THEME_SHORTCODES . '/metabox.php');

		include_once (THEME_WAVEOPTIONS . '/portfolio.php');
		include_once (THEME_WAVEOPTIONS . '/slideshow.php');
		include_once (THEME_WAVEOPTIONS . '/wavesnow-calls.php');
		
		include_once (THEME_GENERATORS . '/option-generator.php');
		include_once (THEME_GENERATORS . '/metabox-generator.php');
		
		include_once (THEME_METABOXES . '/pages-metabox.php');
		include_once (THEME_METABOXES . '/posts-metabox.php');
		include_once (THEME_METABOXES . '/portfolios-metabox.php');
		include_once (THEME_METABOXES . '/news-metabox.php');
		include_once (THEME_METABOXES . '/slideshow-metabox.php');
	}
	


	function menus(){
		add_menu_page('Wavesnow', 'Wavenews', 'edit_theme_options', 'wavesnow', array(&$this,'_load_option_page'), THEME_ADMIN_ASSETS_URI . '/images/settings-admin.png');
	}
	
	
	function theme_activated(){
		if ('themes.php' == basename($_SERVER['PHP_SELF']) && isset($_GET['activated']) && $_GET['activated']=='true' ) {
			$this->theme_save_skin_style();
			//wp_redirect( admin_url('admin.php?page=wavesnow') );
			//echo THEME_CACHE_DIR;
		}
	}
	

	
	function theme_save_skin_style() {
	if (is_writable(THEME_CACHE_DIR)) {
		if(is_multisite()){
				global $blog_id;
					$file = THEME_CACHE_DIR.'/skin'.$blog_id.'.css';
				} else {
					$file = THEME_CACHE_DIR.'/skin.css';
		}
		$fhandle = @fopen($file, 'w+'); 
		$content = include(THEME_DIR.'/style.php');
		if ($fhandle) fwrite($fhandle, $content, strlen($content));
	}
}
	
	
	function _load_option_page(){
		
		$page = include(THEME_ADMIN . "/options/" . $_GET['page'] . '.php');
	
		if($page['auto']){
			new optionGenerator($page['name'],$page['options']);
		}
	}


}

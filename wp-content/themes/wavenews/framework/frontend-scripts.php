<?php


function theme_enqueue_scripts() {
	if ( !is_admin() ) {

		$move_bottom = true;
		wp_register_script( 'cufon-yui', THEME_JS .'/cufon-yui.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'jquery-tweet', THEME_JS .'/jquery.tweet.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'jquery-tools-validator', THEME_JS .'/jquery.tools.validator.min.js', array( 'jquery' ), false, $move_bottom );
		wp_enqueue_script( 'jqueryslidemenu', THEME_JS .'/jqueryslidemenu.js', array( 'jquery' ), false, $move_bottom );
		wp_enqueue_script( 'jquery-tools-tabs', THEME_JS .'/jquery.tools.tabs.min.js', array( 'jquery' ), false, $move_bottom );
		wp_enqueue_script( 'jquery-animate-color', THEME_JS .'/animate.color.min.js', array( 'jquery' ), false, $move_bottom );
		wp_enqueue_script( 'jquery-colorbox', THEME_JS .'/jquery.colorbox-min.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'jquery-slides', THEME_JS .'/slides.min.jquery.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'jquery-nivo', THEME_JS .'/jquery.nivo.slider.pack.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'jquery-init', THEME_JS .'/nivoSliderInit.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'jquery-isotope', THEME_JS .'/jquery.isotope.min.js', array( 'jquery' ), '1.2.2' );
		wp_register_script( 'jquery-infinitescroll', THEME_JS .'/jquery.infinitescroll.min.js', array( 'jquery' ), '1.2.2', false, $move_bottom );
		wp_enqueue_script( 'jquery-easing', THEME_JS . '/jquery.easing.1.3.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'jquery-gmap', THEME_JS .'/jquery.gmap.min.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'anythingslider_fx', THEME_JS .'/jquery.anythingslider.fx.min.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'anythingslider', THEME_JS .'/jquery.anythingslider.min.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'anythingslider_video', THEME_JS .'/jquery.anythingslider.video.min.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'anything-init', THEME_JS . '/anythingSliderInit.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'jquery-kwicks', THEME_JS .'/jquery.kwicks-1.5.1.pack.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'kwicks-init', THEME_JS .'/kwicksSliderInit.js', array( 'jquery' ), false, $move_bottom );
		wp_enqueue_script( 'scrollTo', THEME_JS .'/jquery.scrollTo-1.4.2-min.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'jquery-tools-validator', THEME_JS .'/jquery.tools.validator.min.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'jquery-flexslider', THEME_JS .'/jquery.flexslider-min.js', array( 'jquery' ), false, $move_bottom );
		wp_register_script( 'jquery-carousel', THEME_JS .'/jquery.jcarousel.min.js', array( 'jquery' ), false, $move_bottom );
		
		wp_enqueue_script( 'jquery-waypoints', THEME_JS .'/waypoints.min.js', array( 'jquery' ), false, $move_bottom );

		//if ( theme_option( THEME_OPTIONS, 'enable_header_fixed' ) == 'true'){
			wp_enqueue_script( 'jquery-waypoints-stick', THEME_JS .'/waypoints-sticky.min.js', array( 'jquery' ), false, $move_bottom );
		//}

		wp_register_script( 'jquery-caroufredsel', THEME_JS .'/jquery.carouFredSel-5.6.4-packed.js', array( 'jquery' ), false, $move_bottom );
		wp_enqueue_script('jquery-scrollto', THEME_JS. '/jquery.scroll-to.js', array('jquery'), false, $move_bottom);

		if(theme_option(THEME_OPTIONS, 'enable_nicescroll') == 'true') {
			wp_enqueue_script('jquery-nicescroll', THEME_JS. '/jquery.nicescroll.min.js', array('jquery'), false, $move_bottom);
		}

		if(theme_option(THEME_OPTIONS, 'enable_body_parallax') == 'true' || theme_option(THEME_OPTIONS, 'enable_page_parallax') == 'true') {
			wp_enqueue_script('jquery-parallax', THEME_JS. '/jquery.parallax.js', array('jquery'), false, $move_bottom);
		}


		if ( is_singular() ) {
			wp_enqueue_script( 'comment-reply' );

		}




		if ( theme_option( THEME_OPTIONS, 'custom_fonts_type_1' ) == 'cufon' || theme_option( THEME_OPTIONS, 'custom_font_type_2' ) == 'cufon' ) {
			if ( theme_option( THEME_OPTIONS, 'custom_fonts_type_1' ) == 'cufon' ) {

				wp_enqueue_script( theme_option( THEME_OPTIONS, 'custom_fonts_list_1' ), THEME_FONT_URI .'/'.theme_option( THEME_OPTIONS, 'custom_fonts_list_1' ), array( 'cufon-yui' ), false, $move_bottom );


			} if ( theme_option( THEME_OPTIONS, 'custom_font_type_2' ) == 'cufon' ) {

				wp_enqueue_script( theme_option( THEME_OPTIONS, 'custom_fonts_list_2' ), THEME_FONT_URI .'/'.theme_option( THEME_OPTIONS, 'custom_fonts_list_2' ), array( 'cufon-yui' ), false, $move_bottom );

			}
			wp_enqueue_script( 'cufon-yui' );
		}

		wp_enqueue_script( 'custom', THEME_JS .'/custom.js', array( 'jquery' ), false, $move_bottom );




	}
}
add_action( 'init', 'theme_enqueue_scripts' );
add_action( 'wp_head', 'theme_enqueue_scripts' );


function theme_enqueue_styles() {
	wp_enqueue_style( 'theme-style', THEME_STYLES.'/general.css', false, false, 'all' );
	wp_enqueue_style( 'theme-widgets', THEME_STYLES.'/widgets.css', false, false, 'all' );
	wp_enqueue_style( 'theme-shortcodes', THEME_STYLES.'/shortcodes.css', false, false, 'all' );
	wp_enqueue_style( 'theme-animate', THEME_STYLES.'/animate.css', false, false, 'all' );
	wp_enqueue_style( 'theme-animate-min', THEME_STYLES.'/animate.min.css', false, false, 'all' );
	if ( theme_option( THEME_OPTIONS, 'disable_responsive' ) != 'false' ) {
		wp_enqueue_style( 'theme-responsive', THEME_STYLES.'/responsive.css', false, false, 'all' );
	}
	wp_enqueue_style( 'theme-skin', THEME_DIR_URL.'/style.php', false, false, 'all' );
}
add_action( 'wp_print_styles', 'theme_enqueue_styles' );











function theme_add_cufon_code() {
	if ( theme_option( THEME_OPTIONS, 'custom_fonts_type_1' ) == 'cufon' ) {
		$font_1 = theme_option( THEME_OPTIONS, 'custom_fonts_list_1' );
		$special_elements_1 = theme_option( THEME_OPTIONS, 'special_elements_1' );
		if ( is_array( $special_elements_1 ) ) {
			$special_elements_1 = implode( ', ', $special_elements_1 );
		}

		if ( isset( $font_1 ) ) {
			$file_content_1 = file_get_contents( THEME_FONT_DIR.'/'.$font_1 );
			if ( preg_match( '/font-family":"(.*?)"/i', $file_content_1, $match ) ) {
				$font_name_1 = $match[1];
			}
		}
	}
	if ( theme_option( THEME_OPTIONS, 'custom_font_type_2' ) == 'cufon' ) {
		$font_2 = theme_option( THEME_OPTIONS, 'custom_fonts_list_2' );
		$special_elements_2 = theme_option( THEME_OPTIONS, 'special_elements_2' );
		if ( is_array( $special_elements_2 ) ) {
			$special_elements_2 = implode( ', ', $special_elements_2 );
		}

		if ( isset( $font_2 ) ) {
			$file_content_2 = file_get_contents( THEME_FONT_DIR.'/'.$font_2 );
			if ( preg_match( '/font-family":"(.*?)"/i', $file_content_2, $match ) ) {
				$font_name_2 = $match[1];
			}
		}
	}

	$cufon_list_1 = '';
	if ( theme_option( THEME_OPTIONS, 'custom_fonts_type_1' ) == 'cufon' ) {
		$cufon_list_1 .= <<<CODE
Cufon.replace("{$special_elements_1}", {hover: true, fontFamily : "{$font_name_1}"});
CODE;
	}

	$cufon_list_2 = '';
	if ( theme_option( THEME_OPTIONS, 'custom_font_type_2' ) == 'cufon' ) {
		$cufon_list_2 .= <<<CODE
Cufon.replace("{$special_elements_2}", {hover: true, fontFamily : "{$font_name_2}"});

CODE;
	} 
	echo <<<HTML
<script type='text/javascript'>

{$cufon_list_1}
{$cufon_list_2}
Cufon.now();

</script>
HTML;



}

<?php


/*-------------------------------------------------------------
	 Grabs Post Categories
-------------------------------------------------------------*/
$categories = get_categories( 'hide__mpty=0&orderby=name' );
$wp_cats    = array();
foreach ( $categories as $category_list ) {
  $wp_cats[$category_list->cat_ID] = $category_list->cat_name;
}


/*-------------------------------------------------------------
	 Theme Elements for assigning font family to them
-------------------------------------------------------------*/
$font_replacement_objects = array(
    'h1, div.anythingSlider .with_description .desc_box, #load_more_posts .text' => "Heading 1",
    'h2' => "Heading 2",
    'h3' => "Heading 3",
    'h4' => "Heading 4",
    'h5' => "Heading 5",
    'h6' => "Heading 6",
    ".carousel_wrapper .title" => 'Hompage Carousel Post Title',
    ".pricing_table .plan .price" => 'Pricing Tables Price',
    '.site_name' => "Site Name",
    '.header_tagline' => "Header Toolbar Tagline",
    '.ws-button' => "Buttons",
    '#navigation ul li a' => "Main Navigation",
    '.dropcaps' => "Dropcaps",
    '.tabs a' => "Tabs Heading",
    '.toggle_title' => "Toggle Heading",
    '.accordion .tab' => "Accordion Heading",
    ".footer_slogan" => 'Footer Slogan',
    '.portfolio_title, #page #portfolios header a' => "Portfolio Title",
    '.portfolio_single_category, #portfolios .portfolio_item_category' => "Portfolio Category",
    '.client_slider .client_title' => "Client Slider Text",
    '#footer_nav a, .copyright' => "Footer Copyright",
    '.widget_sub_navigation a' => "Widget Sub-nav"
);




/*-------------------------------------------------------------
	 Grab Cufon fonts from the folder
-------------------------------------------------------------*/
if ( ! function_exists( "grab_fonts" ) ) {
    function grab_fonts() {
        $fonts = array();
        $stylesheet = FONTFACE_DIR.'/fontface_stylesheet.css';
        if ( file_exists( $stylesheet ) ) {
            $file_content = file_get_contents( $stylesheet );
            if ( preg_match_all( "/@font-face\s*{.*?font-family\s*:\s*('|\")(.*?)\\1.*?}/is", $file_content, $matchs ) ) {
                foreach ( $matchs[0] as $index => $css ) {
                    $fonts[$matchs[2][$index]] = array(
                        'name' => $matchs[2][$index],
                        'css' => $css,
                    );
                }

            }
        }

        return $fonts;
    }
}



if ( !function_exists( "theme_cufon_get_fonts" ) ) {
    function theme_cufon_get_fonts() {
        $fonts = array();
        foreach ( glob( THEME_FONT_DIR . "/*.js" ) as $font_file ) {
            $file_content = file_get_contents( $font_file );
            if ( preg_match( '/font-family":"(.*?)"/i', $file_content, $match ) ) {
                $fonts[$match[1]] = basename( $font_file );
            }
        }
        return $fonts;
    }
}

if(!function_exists("icon_list_style")){
	function icon_list_style($value,$default){
        $icon_fonts = array( 'angle-left','angle-right','angle-up','angle-down','arrow-down','arrow-left','arrow-right','arrow-up','caret-down','caret-left','caret-right','caret-up','chevron-down','chevron-left','chevron-right','chevron-up','chevron-sign-left','chevron-sign-right','chevron-sign-up','chevron-sign-down','circle-arrow-down','circle-arrow-left','circle-arrow-right','circle-arrow-up','double-angle-left','double-angle-right','double-angle-up','double-angle-down','hand-down','hand-left','hand-right','hand-up','adjust','anchor','asterisk','ban-circle','bar-chart','barcode','beaker','beer','bell-alt','bell','bolt','book','bookmark-empty','bookmark','briefcase','bullhorn','bullseye','calendar-empty','calendar','camera-retro','camera','certificate','check-empty','check-minus','check-sign','check','circle-blank','circle','cloud-download','cloud-upload','cloud','code-fork','code','coffee','cog','cogs','collapse-alt','comment-alt','comment','comments-alt','comments','credit-card','crop','dashboard','desktop','download-alt','download','edit-sign','edit','ellipsis-horizontal','ellipsis-vertical','envelope-alt','envelope','eraser','exchange','exclamation-sign','exclamation','expand-alt','external-link-sign','external-link','eye-close','eye-open','facetime-video','fighter-jet','film','filter','fire-extinguisher','fire','flag-alt','flag-checkered','flag','folder-close-alt','folder-close','folder-open-alt','folder-open','food','frown','gamepad','gift','glass','globe','group','hdd','headphones','heart-empty','heart','home','inbox','info-sign','info','key','keyboard','laptop','leaf','legal','lemon','level-down','level-up','lightbulb','location-arrow','lock','magic','magnet','mail-forward','mail-reply','mail-reply-all','map-marker','meh','microphone-off','microphone','minus-sign-alt','minus-sign','minus','mobile-phone','money','move','music','off','ok-circle','ok-sign','ok','pencil','phone-sign','phone','picture','plane','plus-sign','plus','print','pushpin','puzzle-piece','qrcode','question-sign','question','quote-left','quote-right','random','refresh','remove-circle','remove-sign','remove','reorder','reply-all','reply','resize-horizontal','resize-vertical','retweet','road','rocket','rotate-left','rotate-right','rss-sign','rss','screenshot','search','share-alt','share-sign','share','shield','shopping-cart','sign-blank','signal','signin','signout','sitemap','smile','sort-down','sort-up','sort','spinner','star-empty','star-half-full','star-half-empty','star-half','star','tablet','tag','tags','tasks','terminal','thumbs-down','thumbs-up','ticket','time','tint','trash','trophy','truck','umbrella','unlock-alt','unlock','upload-alt','upload','user-md','user','volume-down','volume-off','volume-up','warning-sign','wrench','zoom-in','zoom-out');

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        
		echo '<div class="ws-single-option '.$no_divider.' ">';
        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<select class="ws-chosen" name="'.$value['id'].'" id="'.$value['id'].'" style="width:220px;">';
        echo '<option data-type="" value="none">None</option>';

        /* List Icon Fonts */
        foreach ( $icon_fonts as $icon_font ) {
			//echo '<i class=" icon_list icon-'.$icon_font.' dark_gray" ></i>';
            echo '<option data-type="icon_font" ';
            if ( $default == $icon_font ) {
                echo ' selected="selected"';
            }
            echo ' value="' . $icon_font . '" >  Style - ' . $icon_font . '</option>';
			
			
        }
		
        echo '</select>';

        if ( isset( $value['help_link'] ) ) {
          echo '<div class="option-help-link"><a target="_blank" href="'.$value['help_link'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
    }
}



if(!function_exists("icon_font_list")){
	function icon_font_list($value,$default){
        $icon_fonts = array( 'adjust','anchor','asterisk','ban-circle','bar-chart','barcode','beaker','beer','bell-alt','bell','bolt','book','bookmark-empty','bookmark','briefcase','bullhorn','bullseye','calendar-empty','calendar','camera-retro','camera','certificate','check-empty','check-minus','check-sign','check','circle-blank','circle','cloud-download','cloud-upload','cloud','code-fork','code','coffee','cog','cogs','collapse-alt','comment-alt','comment','comments-alt','comments','credit-card','crop','dashboard','desktop','download-alt','download','edit-sign','edit','ellipsis-horizontal','ellipsis-vertical','envelope-alt','envelope','eraser','exchange','exclamation-sign','exclamation','expand-alt','external-link-sign','external-link','eye-close','eye-open','facetime-video','fighter-jet','film','filter','fire-extinguisher','fire','flag-alt','flag-checkered','flag','folder-close-alt','folder-close','folder-open-alt','folder-open','food','frown','gamepad','gift','glass','globe','group','hdd','headphones','heart-empty','heart','home','inbox','info-sign','info','key','keyboard','laptop','leaf','legal','lemon','level-down','level-up','lightbulb','location-arrow','lock','magic','magnet','mail-forward','mail-reply','mail-reply-all','map-marker','meh','microphone-off','microphone','minus-sign-alt','minus-sign','minus','mobile-phone','money','move','music','off','ok-circle','ok-sign','ok','pencil','phone-sign','phone','picture','plane','plus-sign','plus','print','pushpin','puzzle-piece','qrcode','question-sign','question','quote-left','quote-right','random','refresh','remove-circle','remove-sign','remove','reorder','reply-all','reply','resize-horizontal','resize-vertical','retweet','road','rocket','rotate-left','rotate-right','rss-sign','rss','screenshot','search','share-alt','share-sign','share','shield','shopping-cart','sign-blank','signal','signin','signout','sitemap','smile','sort-down','sort-up','sort','spinner','star-empty','star-half-full','star-half-empty','star-half','star','tablet','tag','tags','tasks','terminal','thumbs-down','thumbs-up','ticket','time','tint','trash','trophy','truck','umbrella','unlock-alt','unlock','upload-alt','upload','user-md','user','volume-down','volume-off','volume-up','warning-sign','wrench','zoom-in','zoom-out','angle-left','angle-right','angle-up','angle-down','arrow-down','arrow-left','arrow-right','arrow-up','caret-down','caret-left','caret-right','caret-up','chevron-down','chevron-left','chevron-right','chevron-up','chevron-sign-left','chevron-sign-right','chevron-sign-up','chevron-sign-down','circle-arrow-down','circle-arrow-left','circle-arrow-right','circle-arrow-up','double-angle-left','double-angle-right','double-angle-up','double-angle-down','hand-down','hand-left','hand-right','hand-up');

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        
		echo '<div class="ws-single-option '.$no_divider.' ">';
        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<select class="ws-chosen" name="'.$value['id'].'" id="'.$value['id'].'" style="width:220px;">';
        echo '<option data-type="" value="none">None</option>';

        /* List Icon Fonts */
        foreach ( $icon_fonts as $icon_font ) {
			//echo '<i class=" icon_list icon-'.$icon_font.' dark_gray" ></i>';
            echo '<option data-type="icon_font" ';
            if ( $default == $icon_font ) {
                echo ' selected="selected"';
            }
            echo ' value="' . $icon_font . '" >  Icon - ' . $icon_font . '</option>';
			
			
        }
		
        echo '</select>';

        if ( isset( $value['help_link'] ) ) {
          echo '<div class="option-help-link"><a target="_blank" href="'.$value['help_link'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
    }
}




if ( !function_exists( "fonts_list" ) ) {
    function fonts_list( $value, $default ) {

        /* 600 Google Fonts List
        -------------------------------------------------------------*/
        $google_webfonts = array( 'Abel', 'Abril+Fatface', 'Acid', 'Aclonica', 'Acme', 'Actor', 'Adamina', 'Advent+Pro', 'Aguafina+Script', 'Aladin', 'Aldrich', 'Alegreya', 'Alegreya+SC', 'Alex+Brush', 'Alfa+Slab+One', 'Alice', 'Alike', 'Alike+Angular', 'Allan', 'Allan:bold', 'Allerta', 'Allerta+Stencil', 'Allura', 'Almendra', 'Almendra+SC', 'Amaranth', 'Amatic+SC', 'Amethysta', 'Andada', 'Andika', 'Annie+Use+Your+Telescope', 'Anonymous+Pro', 'Antic', 'Antic+Didone', 'Antic+Slab', 'Anton', 'Arapey', 'Arbutus', 'Architects+Daughter', 'Arimo', 'Arizonia', 'Armata', 'Artifika', 'Arvo', 'Asap', 'Asset', 'Astloch', 'Asul', 'Atomic+Age', 'Aubrey', 'Audiowide', 'Average', 'Averia+Gruesa+Libre', 'Averia+Libre', 'Averia+Sans+Libre', 'Averia+Serif+Libre', 'Bad+Script', 'Balthazar', 'Bangers', 'Basic', 'Baumans', 'Belgrano', 'Belleza', 'Bentham', 'Berkshire+Swash', 'Bevan', 'Bigshot+One', 'Bilbo', 'Bilbo+Swash+Caps', 'Bitter', 'Black+Ops+One', 'Bonbon', 'Boogaloo', 'Bowlby+One', 'Bowlby+One+SC', 'Brawler', 'Bree+Serif', 'Bubblegum+Sans', 'Buda', 'Buda:light', 'Buenard', 'Butcherman', 'Butcherman+Caps', 'Butterfly+Kids', 'Cabin', 'Cabin+Condensed', 'Cabin+Sketch', 'Cabin+Sketch:bold', 'Cabin:bold', 'Caesar+Dressing', 'Cagliostro', 'Calligraffitti', 'Cambo', 'Candal', 'Cantarell', 'Cantata+One', 'Cardo', 'Carme', 'Carter+One', 'Caudex', 'Cedarville+Cursive', 'Ceviche+One', 'Changa+One', 'Chango', 'Chau+Philomene+One', 'Chelsea+Market', 'Cherry+Cream+Soda', 'Chewy', 'Chicle', 'Chivo', 'Coda', 'Coda:800', 'Codystar', 'Comfortaa', 'Coming+Soon', 'Concert+One', 'Condiment', 'Contrail+One', 'Convergence', 'Cookie', 'Copse', 'Corben', 'Corben:bold', 'Cousine', 'Coustard', 'Covered+By+Your+Grace', 'Crafty+Girls', 'Creepster', 'Creepster+Caps', 'Crete+Round', 'Crimson', 'Crushed', 'Cuprum', 'Cutive', 'Damion', 'Dancing+Script', 'Dawning+of+a+New+Day', 'Days+One', 'Delius', 'Delius+Swash+Caps', 'Delius+Unicase', 'Della+Respira', 'Devonshire', 'Didact+Gothic', 'Diplomata', 'Diplomata+SC', 'Doppio+One', 'Dorsa', 'Dosis', 'Dr+Sugiyama', 'Droid+Sans', 'Droid+Sans+Mono', 'Droid+Serif', 'Duru+Sans', 'Dynalight', 'EB+Garamond', 'Eater', 'Eater+Caps', 'Economica', 'Electrolize', 'Emblema+One', 'Emilys+Candy', 'Engagement', 'Enriqueta', 'Erica+One', 'Esteban', 'Euphoria+Script', 'Ewert', 'Exo', 'Expletus+Sans', 'Fanwood+Text', 'Fascinate', 'Fascinate+Inline', 'Federant', 'Federo', 'Felipa', 'Fjord+One', 'Flamenco', 'Flavors', 'Fondamento', 'Fontdiner+Swanky', 'Forum', 'Francois+One', 'Fredericka+the+Great', 'Fredoka+One', 'Fresca', 'Frijole', 'Fugaz+One', 'Galdeano', 'Gentium+Basic', 'Gentium+Book+Basic', 'Geo', 'Geostar', 'Geostar+Fill', 'Germania+One', 'Give+You+Glory', 'Glass+Antiqua', 'Glegoo', 'Gloria+Hallelujah', 'Goblin+One', 'Gochi+Hand', 'Gorditas', 'Goudy+Bookletter+1911', 'Graduate', 'Gravitas+One', 'Great+Vibes', 'Gruppo', 'Gudea', 'Habibi', 'Hammersmith+One', 'Handlee', 'Happy+Monkey', 'Henny+Penny', 'Herr+Von+Muellerhoff', 'Holtwood+One+SC', 'Homemade+Apple', 'Homenaje', 'IM+Fell', 'Iceberg', 'Iceland', 'Imprima', 'Inconsolata', 'Inder', 'Indie+Flower', 'Inika', 'Irish+Grover', 'Irish+Growler', 'Istok+Web', 'Italiana', 'Italianno', 'Jim+Nightshade', 'Jockey+One', 'Jolly+Lodger', 'Josefin+Sans', 'Josefin+Slab', 'Judson', 'Julee', 'Junge', 'Jura', 'Just+Another+Hand', 'Just+Me+Again+Down+Here', 'Kameron', 'Karla', 'Kaushan+Script', 'Kelly+Slab', 'Kenia', 'Knewave', 'Kotta+One', 'Kranky', 'Kreon', 'Kristi', 'Krona+One', 'La+Belle+Aurore', 'Lancelot', 'Lato', 'League+Script', 'Leckerli+One', 'Ledger', 'Lekton', 'Lemon', 'Lilita+One', 'Limelight', 'Linden+Hill', 'Lobster', 'Lobster+Two', 'Londrina+Shadow', 'Londrina+Sketch', 'Londrina+Solid', 'LondrinaOutline', 'Lora', 'Love+Ya+Like+A+Sister', 'Loved+by+the+King', 'Lovers+Quarrel', 'Luckiest+Guy', 'Lusitana', 'Lustria', 'Macondo', 'Macondo+Swash+Caps', 'Magra', 'Maiden+Orange', 'Mako', 'Marck+Script', 'Marko+One', 'Marmelad', 'Marvel', 'Mate', 'Mate+SC', 'Maven+Pro', 'Meddon', 'MedievalSharp', 'Medula+One', 'Megrim', 'Merienda+One', 'Merriweather', 'Metamorphous', 'Metrophobic', 'Michroma', 'Miltonian', 'Miltonian+Tattoo', 'Miniver', 'Miss+Fajardose', 'Miss+Saint+Delafield', 'Modern+Antiqua', 'Molengo', 'Monofett', 'Monoton', 'Monsieur+La+Doulaise', 'Montaga', 'Montez', 'Montserrat', 'Mountains+of+Christmas', 'Mr+Bedford', 'Mr+Bedfort', 'Mr+Dafoe', 'Mr+De+Haviland', 'Mrs+Saint+Delafield', 'Mrs+Sheppards', 'Muli', 'Mystery+Quest', 'Neucha', 'Neuton', 'News+Cycle', 'Niconne', 'Nixie+One', 'Nobile:400,700', 'Norican', 'Nosifer', 'Nosifer+Caps', 'Noticia+Text:400,700', 'Nova+Flat', 'Nova+Mono', 'Nova+Oval', 'Nova+Round', 'Nova+Script', 'Nova+Slim', 'Numans', 'Nunito', 'Old+Standard+TT', 'Oldenburg', 'Oleo+Script', 'Open+Sans:400,600,700,800', 'Orbitron', 'Original+Surfer', 'Oswald', 'Over+the+Rainbow', 'Overlock', 'Overlock+SC', 'Ovo', 'Oxygen', 'PT+Mono', 'PT+Sans:400,700', 'PT+Sans+Narrow', 'PT+Serif', 'PT+Serif+Caption', 'Pacifico', 'Parisienne', 'Passero+One', 'Passion+One', 'Patrick+Hand', 'Patua+One', 'Paytone+One', 'Permanent+Marker', 'Petrona', 'Philosopher', 'Piedra', 'Pinyon+Script', 'Plaster', 'Play', 'Playball', 'Playfair+Display', 'Podkova', 'Poiret+One', 'Poller+One', 'Poly', 'Pompiere', 'Pontano+Sans', 'Port+Lligat+Sans', 'Port+Lligat+Slab', 'Prata', 'Press+Start+2P', 'Princess+Sofia', 'Prociono', 'Prosto+One', 'Puritan', 'Quantico', 'Quattrocento', 'Quattrocento+Sans', 'Questrial', 'Quicksand', 'Qwigley', 'Radley', 'Raleway', 'Raleway:100', 'Rammetto+One', 'Rancho', 'Rationale', 'Redressed', 'Reenie+Beanie', 'Revalia', 'Ribeye', 'Ribeye+Marrow', 'Righteous', 'Rochester', 'Rock+Salt', 'Rokkitt', 'Ropa+Sans', 'Rosario', 'Rosarivo', 'Rouge+Script', 'Ruda', 'Ruge+Boogie', 'Ruluko', 'Ruslan+Display', 'Russo One', 'Ruthie', 'Sail', 'Salsa', 'Sancreek', 'Sansita+One', 'Sarina', 'Satisfy', 'Schoolbell', 'Seaweed+Script', 'Sevillana', 'Shadows+Into+Light', 'Shadows+Into+Light+Two', 'Shanti', 'Share', 'Shojumaru', 'Short+Stack', 'Sigmar+One', 'Signika', 'Signika+Negative', 'Simonetta', 'Sirin+Stencil', 'Six+Caps', 'Slackey', 'Smokum', 'Smythe', 'Sniglet', 'Sniglet:800', 'Snippet', 'Sofia', 'Sonsie+One', 'Sorts+Mill+Goudy', 'Special+Elite', 'Spicy+Rice', 'Spinnaker', 'Spirax', 'Squada+One', 'Stardos+Stencil', 'Stint+Ultra+Condensed', 'Stint+Ultra+Expanded', 'Stoke', 'Sue+Ellen+Francisco', 'Sunshiney', 'Supermercado+One', 'Swanky+and+Moo+Moo', 'Syncopate', 'Tangerine', 'Telex', 'Tenor+Sans', 'Terminal+Dosis', 'Terminal+Dosis+Light', 'The+Girl+Next+Door', 'Tienne', 'Tinos', 'Titan+One', 'Trade+Winds', 'Trocchi', 'Trochut', 'Trykker', 'Tulpen+One', 'Ubuntu', 'Ubuntu+Condensed', 'Ubuntu+Mono', 'Ultra', 'Uncial+Antiqua', 'UnifrakturCook', 'UnifrakturCook:bold', 'UnifrakturMaguntia', 'Unkempt', 'Unlock', 'Unna', 'VT323', 'Varela', 'Varela+Round', 'Vast+Shadow', 'Vibur', 'Vidaloka', 'Viga', 'Voces', 'Volkhov', 'Vollkorn', 'Voltaire', 'Waiting+for+the+Sunrise', 'Wallpoet', 'Walter+Turncoat', 'Wellfleet', 'Wire+One', 'Yanone+Kaffeesatz', 'Yellowtail', 'Yeseva+One', 'Yesteryear', 'Zeyada' );


        /* Safe Fonts List
        -------------------------------------------------------------*/
        $safe_fonts = array( 'Arial, Helvetica, sans-serif', 'Arial Black, Gadget, sans-serif', 'Bookman Old Style, serif', 'Comic Sans MS, cursive', 'Courier, monospace', 'Courier New, Courier, monospace', 'Garamond, serif', 'Georgia, serif', 'Impact, Charcoal, sans-serif', 'Lucida Console, Monaco, monospace', 'Lucida Grande, Lucida Sans Unicode, sans-serif', 'MS Sans Serif, Geneva, sans-serif', 'MS Serif, New York, sans-serif', 'Palatino Linotype, Book Antiqua, Palatino, serif', 'Tahoma, Geneva, sans-serif', 'Times New Roman, Times, serif', 'Trebuchet MS, Helvetica, sans-serif', 'Verdana, Geneva, sans-serif' );




        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<select class="ws-chosen" name="'.$value['id'].'" id="'.$value['id'].'" style="width:500px;">';
        echo '<option data-type="" value="none">None</option>';


        /* List Safe Fonts */
        foreach ( $safe_fonts as $safe_font ) {

            echo '<option data-type="safe_font" ';
            if ( $default == $safe_font ) {
                echo ' selected="selected"';
            }
            echo " value='" . $safe_font . "' >- Safe Font - " . $safe_font . "</option>";
        }


        /* List Cufon Fonts */
        $count = 1;
        foreach ( theme_cufon_get_fonts() as $font_name => $file_name ) {
            echo '<option data-type="cufon" ';

            if ( $default ==  $file_name ) {
                echo ' selected="selected"';
            }
            echo ' value="' . $file_name . '" >- Cufon - ' . $font_name . '</option>';
            $count++;
        }



        /* List Google Fonts */
        foreach ( $google_webfonts as $google_webfont ) {

            echo '<option data-type="google" ';
            if ( $default == $google_webfont ) {
                echo ' selected="selected"';
            }
            echo ' value="' . $google_webfont . '" >- Google Fonts - ' . str_replace( '+', ' ', $google_webfont ) . '</option>';
        }



        /* List Fontface Fonts */
        $fontface = grab_fonts();
        $count = 1;
        foreach ( $fontface as $values => $font ) {
            echo '<option data-type="fontface" ';
            if ( $default == $values ) {
                echo ' selected="selected"';
            }
            echo ' value="' . $values . '" >- Fontface - ' . $font['name'] . '</option>';
            $count++;
        }



        echo '</select>';

        if ( isset( $value['help_link'] ) ) {
          echo '<div class="option-help-link"><a target="_blank" href="'.$value['help_link'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }
        echo '</div>';
        if ( isset( $value['divider'] ) && $value['divider'] == true ) {

            echo '<div class="option-divider"></div>';
        }
    }
}


/* Common Functions*/

/**Auto Generate copyright time range*/
if ( !function_exists( "comicpress_copyright" ) ) {
	function comicpress_copyright() {
    	global $wpdb;
    	$copyright_dates = $wpdb->get_results("
    		SELECT
    		YEAR(min(post_date_gmt)) AS firstdate,
    		YEAR(max(post_date_gmt)) AS lastdate
    		FROM
    		$wpdb->posts
    		WHERE
    		post_status = 'publish'
    	");
    	$output = '';
    	if($copyright_dates) {
    		$copyright = " &copy; " . $copyright_dates[0]->firstdate;
    		if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
    			$copyright .= '-' . $copyright_dates[0]->lastdate;
    		}
    		$output = $copyright;
    	}
    	echo $output;
    }
}

?>
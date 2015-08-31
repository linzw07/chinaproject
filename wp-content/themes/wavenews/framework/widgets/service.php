<?php

/*
	FLICKR WIDGET
*/
class Wave_Flickr_Widget extends WP_Widget {

	function Wave_Flickr_Widget() {
		$widget_ops = array( 'classname' => 'widget_flickr', 'description' => 'Displays photos from a Flickr ID' );
		$this->WP_Widget( 'flickr', THEME_SLUG.' - '.'Flickr', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Photos on flickr' : $instance['title'], $instance, $this->id_base );
		$flickr_id = $instance['flickr_id'];
		$count = (int)$instance['count'];
		$display = empty( $instance['display'] ) ? 'latest' : $instance['display'];

		if ( $count < 1 ) {
			$count = 1;
		}

		if ( !empty( $flickr_id ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
?>
		<div class="flickr_container">
			<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=<?php echo $count; ?>&amp;display=<?php echo $display; ?>&amp;size=s&amp;layout=x&amp;source=user&amp;user=<?php echo $flickr_id; ?>"></script>
		</div>
		<div class="clearboth"></div>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['flickr_id'] = strip_tags( $new_instance['flickr_id'] );
		$instance['count'] = (int) $new_instance['count'];
		$instance['display'] = strip_tags( $new_instance['display'] );

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$flickr_id = isset( $instance['flickr_id'] ) ? esc_attr( $instance['flickr_id'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 3;
		$display = isset( $instance['display'] ) ? $instance['display'] : 'latest';
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title :</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'flickr_id' ); ?>">Flickr ID :</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'flickr_id' ); ?>" name="<?php echo $this->get_field_name( 'flickr_id' ); ?>" type="text" value="<?php echo $flickr_id; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>">Number of photo to show :</label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id( 'display' ); ?>">Method for display your photos:</label>
		<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">
			<option<?php if ( $display == 'latest' ) echo ' selected="selected"'?> value="latest">Latest</option>
			<option<?php if ( $display == 'random' ) echo ' selected="selected"'?> value="random">Random</option>
		</select>
<?php
	}
}
/***************************************************/

/*GOOGLE MAP WIDGET*/

class Wave_GoogleMap_Widget extends WP_Widget {

	function Wave_GoogleMap_Widget() {
		$widget_ops = array( 'classname' => 'widget_gmap', 'description' => __( 'Displays google map.', 'theme_frontend' ) );
		$this->WP_Widget( 'gmap', THEME_SLUG. '- Google Maps', $widget_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$address = $instance['address'];
		$latitude = !empty( $instance['latitude'] )?$instance['latitude']:0;
		$longitude = !empty( $instance['longitude'] )?$instance['longitude']:0;
		$zoom = (int)$instance['zoom'];
		$html = $instance['html'];
		$popup = $instance['popup'];
		$height = (int)$instance['height'];

		wp_print_scripts( 'jquery-gmap' );

		if ( $zoom < 1 ) {
			$zoom = 1;
		}

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		$id = mt_rand( 100, 3000 );
?>

		<div id="gmap_widget_<?php echo $id;?>" class="google_map" style="height:<?php echo $height;?>px"></div>
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<script type="text/javascript">
		jQuery(document).ready(function($) {
			jQuery("#gmap_widget_<?php echo $id;?>").gMap({
			    zoom: <?php echo $zoom;?>,
			    markers:[{
					address: "<?php echo $address;?>",
					latitude: <?php echo $latitude;?>,
			    	longitude: <?php echo $longitude;?>,
			    	html: "<?php echo $html;?>",
			    	popup: <?php echo $popup;?>
				}],
				controls: false,
				maptype: 'ROADMAP'
			});
		});
		</script>

		<div class="clearboth"></div>
		<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['address'] = strip_tags( $new_instance['address'] );
		$instance['latitude'] = strip_tags( $new_instance['latitude'] );
		$instance['longitude'] = strip_tags( $new_instance['longitude'] );
		$instance['zoom'] = (int) $new_instance['zoom'];
		$instance['html'] = strip_tags( $new_instance['html'] );
		$instance['popup'] = !empty( $new_instance['popup'] ) ? 1 : 0;
		$instance['height'] = (int) $new_instance['height'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$address = isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';
		$latitude = isset( $instance['latitude'] ) ? esc_attr( $instance['latitude'] ) : '';
		$longitude = isset( $instance['longitude'] ) ? esc_attr( $instance['longitude'] ) : '';
		$zoom = isset( $instance['zoom'] ) ? absint( $instance['zoom'] ) : 14;
		$html = isset( $instance['html'] ) ? esc_attr( $instance['html'] ) : '';
		$popup = isset( $instance['popup'] ) ? (bool) $instance['popup'] : false;
		$height = isset( $instance['height'] ) ? absint( $instance['height'] ) : 250;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:', 'theme_frontend' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e( 'Address (optional):', 'theme_frontend' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo $address; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'latitude' ); ?>"><?php _e( 'Latitude:', 'theme_frontend' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'latitude' ); ?>" name="<?php echo $this->get_field_name( 'latitude' ); ?>" type="text" value="<?php echo $latitude; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'longitude' ); ?>"><?php _e( 'Longitude:', 'theme_frontend' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'longitude' ); ?>" name="<?php echo $this->get_field_name( 'longitude' ); ?>" type="text" value="<?php echo $longitude; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'zoom' ); ?>"><?php _e( 'Zoom value from 1 to 19:', 'theme_frontend' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'zoom' ); ?>" name="<?php echo $this->get_field_name( 'zoom' ); ?>" type="text" value="<?php echo $zoom; ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id( 'html' ); ?>"><?php _e( 'Content for the marker:', 'theme_frontend' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'html' ); ?>" name="<?php echo $this->get_field_name( 'html' ); ?>" type="text" value="<?php echo $html; ?>" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'popup' ); ?>" name="<?php echo $this->get_field_name( 'popup' ); ?>"<?php checked( $popup ); ?> />
		<label for="<?php echo $this->get_field_id( 'popup' ); ?>"><?php _e( 'Auto popup the info?', 'theme_frontend' ); ?></label></p>

		<p><label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e( 'Height:', 'theme_frontend' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo $height; ?>" /></p>

<?php
	}
}
/***************************************************/



/* TWITTER WIDGET */

class Wave_Twitter_Widget extends WP_Widget {

	function Wave_Twitter_Widget() {
		$widget_ops = array( 'classname' => 'widget_twitter', 'description' => 'Displays a list of twitter feeds' );
		$this->WP_Widget( 'twitter', THEME_SLUG.' - '.'Twitter Feeds', $widget_ops );

		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_print_scripts', array( &$this, 'add_tweet_script' ) );
		}

	}

	function add_tweet_script() {
		wp_enqueue_script( 'jquery-tweet' );
	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = $instance['title'];
		$style = $instance['style'];
		$username = $instance['username'];
		$count = isset( $instance['count'] ) ? (int)$instance['count'] : 1;

		if ( $count < 1 ) {
			$count = 1;
		}
		if ( $count > 30 ) {
			$count = 30;
		}


		if ( $style == '' ) {
			$style = 'tw_focused';
		}



		if ( !empty( $username ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;

			$id = rand( 1, 1000 );

?>

<div class="twitter_shortcode <?php echo $style; ?>" style="margin-bottom:0">
<script type="text/javascript">
jQuery(document).ready(function($) {
	jQuery("#twitter_wrap_<?php echo $id; ?>").tweet({
		username: "<?php echo $username; ?>",
		count: <?php echo $count; ?>,
		template: '{join}{text}<div class="company_on_twitter"><?php echo get_bloginfo( 'name' ); ?> on Twitter</div>{time}'
	});
});
</script>
	<div id="twitter_wrap_<?php echo $id; ?>"></div>
	<div class="clearboth"></div>
</div>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['style'] = $new_instance['style'];
		$instance['username'] = strip_tags( $new_instance['username'] );
		$instance['count'] = (int) $new_instance['count'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$username = isset( $instance['username'] ) ? esc_attr( $instance['username'] ) : '';
		$style = isset( $instance['style'] ) ? esc_attr( $instance['style'] ) : 'tw_focused';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 1;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'username' ); ?>">Username:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo $username; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'count' ); ?>">Count</label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>" name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>


		   	<p>
			<label for="<?php echo $this->get_field_id( 'style' ); ?>">Orientation:</label>
			<select name="<?php echo $this->get_field_name( 'style' ); ?>" id="<?php echo $this->get_field_id( 'style' ); ?>" class="widefat">
            	<option value="tw_focused"<?php selected( $style, 'tw_focused' );?>>Focused</option>
				<option value="tw_list"<?php selected( $style, 'tw_list' );?>>List Style</option>

			</select>
		</p>
<?php

	}
}
/***************************************************/

/* VIDEO WIDGET */

class Wave_Video_Widget extends WP_Widget {

	function Wave_Video_Widget() {
		$widget_ops = array( 'classname' => 'widget_video', 'description' => 'You can add youtube and Vimeo' );
		$this->WP_Widget( 'video', THEME_SLUG.' - '.'Video', $widget_ops );

	}


	function widget( $args, $instance ) {
		extract( $args );
		$title = $instance['title'];
		$type= $instance['type'];
		$clip_id= $instance['clip_id'];
		$height= $instance['height'];
		$width= $instance['width'];


		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;

		if ( $type == 'youtube' ) {
			if ( $height && !$width )
				$width = intval( $height * 16 / 9 );
			if ( !$height && $width )
				$height = intval( $width * 9 / 16 ) + 25;

			if ( !empty( $clip_id ) ) {
?>
				<div class='widget_video_frame'><iframe src='http://www.youtube.com/embed/<?php echo $clip_id; ?>' width='<?php echo $width; ?>' height='<?php echo $height; ?>' frameborder='0'></iframe></div>
	<?php
			}

		}


		if ( $type == 'vimeo' ) {
			if ( $height && !$width )
				$width = intval( $height * 16 / 9 );
			if ( !$height && $width )
				$height = intval( $width * 9 / 16 );


			if ( !empty( $clip_id ) && is_numeric( $clip_id ) ) {
?>
		<div class='widget_video_frame'><iframe src='http://player.vimeo.com/video/<?php echo $clip_id; ?>?title=0&amp;byline=0&amp;portrait=0' width='<?php echo $width; ?>' height='<?php echo $height; ?>' frameborder='0'></iframe></div>
		<?php
			}

		}

		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['type'] = strip_tags( $new_instance['type'] );
		$instance['clip_id'] = $new_instance['clip_id'];
		$instance['height'] = (int) $new_instance['height'];
		$instance['width'] = (int) $new_instance['width'];

		return $instance;
	}

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$type = isset( $instance['type'] ) ? $instance['type'] : 'youtube';
		$clip_id = isset( $instance['clip_id'] ) ? $instance['clip_id'] : '';
		$height = isset( $instance['height'] ) ? absint( $instance['height'] ) : 180;
		$width = isset( $instance['width'] ) ? absint( $instance['width'] ) : 260;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

     	<p>
			<label for="<?php echo $this->get_field_id( 'type' ); ?>">Type:</label>
			<select name="<?php echo $this->get_field_name( 'type' ); ?>" id="<?php echo $this->get_field_id( 'type' ); ?>" class="widefat">
            	<option value="youtube"<?php selected( $type, 'youtube' );?>>Youtube</option>
				<option value="vimeo"<?php selected( $type, 'vimeo' );?>>Vimeo</option>

			</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'clip_id' ); ?>">Clip Id:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'clip_id' ); ?>" name="<?php echo $this->get_field_name( 'clip_id' ); ?>" type="text" value="<?php echo $clip_id; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'width' ); ?>">Width</label>
		<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" type="text" value="<?php echo $width; ?>" size="3" /></p>

        <p><label for="<?php echo $this->get_field_id( 'height' ); ?>">Height</label>
		<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" type="text" value="<?php echo $height; ?>" size="3" /></p>
<?php

	}
}
/***************************************************/

/*
	SOCIAL NETWORKS ICON
*/

class Wave_Social_Widget extends WP_Widget {

	var $sites = array(
		'behance', 'blogger', 'delicious', 'deviantart', 'digg', 'dribbble', 'facebook', 'flickr', 'lastfm', 'linkedin', 'livejournal', 'myspace', 'pinterest', 'google', 'rss', 'skype', 'stumble', 'tumblr', 'twitter', 'vimeo', 'wordpress', 'yahoo', 'yelp', 'youtube'
	);
	var $skins = array(

		'dark' => array(
			'name'=>'Black',
			'path'=>'social/{:name}.png',
		),

		'light' => array(
			'name'=>'White',
			'path'=>'social/{:name}.png',
		),



	);


	function Wave_Social_Widget() {
		$widget_ops = array( 'classname' => 'widget_social', 'description' => 'Displays a list of Social Icon icons' );
		$this->WP_Widget( 'social', THEME_SLUG.' - '.'Social Networks', $widget_ops );

		if ( 'widgets.php' == basename( $_SERVER['PHP_SELF'] ) ) {
			add_action( 'admin_print_scripts', array( &$this, 'add_admin_script' ) );
		}
	}

	function add_admin_script() {
		wp_enqueue_script( 'social-icon-widget', THEME_ADMIN_ASSETS_URI . '/js/social-icon-widget.js', array( 'jquery' ) );
	}


	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$alt = isset( $instance['alt'] )?$instance['alt']:'';
		$skins = $instance['skins'];
		$custom_count = $instance['custom_count'];
		$output ='';
		if ( !empty( $instance['enable_sites'] ) ) {
			foreach ( $instance['enable_sites'] as $site ) {
				$path = str_replace( '{:name}', strtolower( $site ), $this->skins[$skins]['path'] );
				$link = isset( $instance[strtolower( $site )] )?$instance[strtolower( $site )]:'#';
				if ( file_exists( THEME_DIR . '/images/'.$path ) ) {
					$output .= '<a href="'.$link.'" rel="nofollow" target="_blank"><img src="'.THEME_IMAGES.'/'.$path.'" alt="'.$alt.' '.$site.'" title="'.$alt.' '.$site.'"/></a>';
				}
			}
		}
		if ( $custom_count > 0 ) {
			for ( $i=1; $i<= $custom_count; $i++ ) {
				$name = isset( $instance['custom_'.$i.'_name'] )?$instance['custom_'.$i.'_name']:'';
				$icon = isset( $instance['custom_'.$i.'_icon'] )?$instance['custom_'.$i.'_icon']:'';
				$link = isset( $instance['custom_'.$i.'_url'] )?$instance['custom_'.$i.'_url']:'#';
				if ( !empty( $icon ) ) {
					$output .= '<a href="'.$link.'" rel="nofollow" target="_blank"><img src="'.$icon.'" alt="'.$alt.' '.$name.'" title="'.$alt.' '.$name.'"/></a>';
				}
			}
		}

		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
?>
		<div class="social_wrap">
			<?php echo $output; ?>

		</div>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['alt'] = strip_tags( $new_instance['alt'] );
		$instance['skins'] = strip_tags( $new_instance['skins'] );
		$instance['enable_sites'] = $new_instance['enable_sites'];
		$instance['custom_count'] = (int) $new_instance['custom_count'];

		if ( !empty( $instance['enable_sites'] ) ) {
			foreach ( $instance['enable_sites'] as $site ) {
				$instance[strtolower( $site )] = isset( $new_instance[strtolower( $site )] )?strip_tags( $new_instance[strtolower( $site )] ):'';
			}
		}
		for ( $i=1;$i<=$instance['custom_count'];$i++ ) {
			$instance['custom_'.$i.'_name'] = strip_tags( $new_instance['custom_'.$i.'_name'] );
			$instance['custom_'.$i.'_url'] = strip_tags( $new_instance['custom_'.$i.'_url'] );
			$instance['custom_'.$i.'_icon'] = strip_tags( $new_instance['custom_'.$i.'_icon'] );
		}
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$alt = isset( $instance['alt'] ) ? esc_attr( $instance['alt'] ) : 'Follow Us on';
		$skins = isset( $instance['skins'] ) ? $instance['skins'] : '';
		$enable_sites = isset( $instance['enable_sites'] ) ? $instance['enable_sites'] : array();
		foreach ( $this->sites as $site ) {
			$$site = isset( $instance[strtolower( $site )] ) ? esc_attr( $instance[strtolower( $site )] ) : '';
		}

		$custom_count = isset( $instance['custom_count'] ) ? absint( $instance['custom_count'] ) : 0;
		for ( $i=1;$i<=10;$i++ ) {
			$custom_name = 'custom_'.$i.'_name';
			$$custom_name = isset( $instance[$custom_name] ) ? $instance[$custom_name] : '';
			$custom_url = 'custom_'.$i.'_url';
			$$custom_url = isset( $instance[$custom_url] ) ? $instance[$custom_url] : '';
			$custom_icon = 'custom_'.$i.'_icon';
			$$custom_icon = isset( $instance[$custom_icon] ) ? $instance[$custom_icon] : '';
		}
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'alt' ); ?>">Icon Alt Title:</label> <input class="widefat" id="<?php echo $this->get_field_id( 'alt' ); ?>" name="<?php echo $this->get_field_name( 'alt' ); ?>" type="text" value="<?php echo $alt; ?>" /></p>
		<p>
			<label for="<?php echo $this->get_field_id( 'skins' ); ?>">Color:</label>
			<select name="<?php echo $this->get_field_name( 'skins' ); ?>" id="<?php echo $this->get_field_id( 'skins' ); ?>" class="widefat">
				<?php foreach ( $this->skins as $name => $value ):?>
				<option value="<?php echo $name;?>"<?php selected( $skins, $name );?>><?php echo $value['name'];?></option>
				<?php endforeach;?>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'enable_sites' ); ?>">Enable Social Icon:</label>
			<select name="<?php echo $this->get_field_name( 'enable_sites' ); ?>[]" style="height:10em" id="<?php echo $this->get_field_id( 'enable_sites' ); ?>" class="social_icon_select_sites widefat" multiple="multiple">
				<?php foreach ( $this->sites as $site ):?>
				<option value="<?php echo strtolower( $site );?>"<?php echo in_array( strtolower( $site ), $enable_sites )? 'selected="selected"':'';?>><?php echo $site;?></option>
				<?php endforeach;?>
			</select>
		</p>

		<p>
			<em><?php "Note: Please input FULL URL <br/>(e.g. <code>http://www.example.com</code>)";?></em>
		</p>
		<div class="social_icon_wrap">
		<?php foreach ( $this->sites as $site ):?>
		<p class="social_icon_<?php echo strtolower( $site );?>" <?php if ( !in_array( strtolower( $site ), $enable_sites ) ):?>style="display:none"<?php endif;?>>
			<label for="<?php echo $this->get_field_id( strtolower( $site ) ); ?>"><?php echo $site.' '.'URL:'?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( strtolower( $site ) ); ?>" name="<?php echo $this->get_field_name( strtolower( $site ) ); ?>" type="text" value="<?php echo $$site; ?>" />
		</p>
		<?php endforeach;?>
		</div>

		<p><label for="<?php echo $this->get_field_id( 'custom_count' ); ?>">How many custom icons to add?</label>
		<input id="<?php echo $this->get_field_id( 'custom_count' ); ?>" class="social_icon_custom_count" name="<?php echo $this->get_field_name( 'custom_count' ); ?>" type="text" value="<?php echo $custom_count; ?>" size="3" /></p>

		<div class="social_custom_icon_wrap">
		<?php for ( $i=1;$i<=10;$i++ ): $custom_name='custom_'.$i.'_name';$custom_url='custom_'.$i.'_url'; $custom_icon='custom_'.$i.'_icon'; ?>
			<div class="social_icon_custom_<?php echo $i;?>" <?php if ( $i>$custom_count ):?>style="display:none"<?php endif;?>>
				<p><label for="<?php echo $this->get_field_id( $custom_name ); ?>"><?php printf( 'Custom %s Name:', $i );?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $custom_name ); ?>" name="<?php echo $this->get_field_name( $custom_name ); ?>" type="text" value="<?php echo $$custom_name; ?>" /></p>
				<p><label for="<?php echo $this->get_field_id( $custom_url ); ?>"><?php printf( 'Custom %s URL:', $i );?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $custom_url ); ?>" name="<?php echo $this->get_field_name( $custom_url ); ?>" type="text" value="<?php echo $$custom_url; ?>" /></p>
				<p><label for="<?php echo $this->get_field_id( $custom_icon ); ?>"><?php printf( 'Custom %s Icon:', $i );?></label>
				<input class="widefat" id="<?php echo $this->get_field_id( $custom_icon ); ?>" name="<?php echo $this->get_field_name( $custom_icon ); ?>" type="text" value="<?php echo $$custom_icon; ?>" /></p>
			</div>

		<?php endfor;?>
		</div>

<?php

	}
}


/***************************************************/

?>
<?php



/*
	POPULAR POSTS WIDGET
*/


class Wave_Popular_Posts_Widget extends WP_Widget {

	function Wave_Popular_Posts_Widget() {
		$widget_ops = array( "classname" => "widget_popular_posts", "description" => "Displays the Popular posts" );
		$this-> WP_Widget( "popular_posts", THEME_SLUG . " - Popular Posts", $widget_ops );
		$this-> alt_option_name = "widget_popular_posts";

		add_action( "save_post", array( &$this, "flush_widget_cache" ) );
		add_action( "deleted_post", array( &$this, "flush_widget_cache" ) );
		add_action( "switch_theme", array( &$this, "flush_widget_cache" ) );
	}


	function widget( $args, $instance ) {

		$cache = wp_cache_get( "Wavesnow_Widget_Popular_Posts", "widget" );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract( $args );


		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 10;
		else if ( $posts_number < 1 )
				$posts_number = 1;
			else if ( $posts_number > 15 )
					$posts_number = 15;

				if ( !$desc_length = (int) $instance['desc_length'] )
					$desc_length = 80;
				else if ( $desc_length < 1 )
						$desc_length = 1;


					$disable_thumbnail = $instance["disable_thumbnail"] ? "1" : "0";
				$disable_desc = $instance["disable_desc"] ? "1" : "0";
			$disable_time = $instance["disable_time"] ? "1" : "0";
		$date_format = $instance['date_format'] ? $instance['date_format'] :'F j, Y';


		$query = array( "showposts" => $posts_number, "nopaging" => 0, "posts_status" => "publish", 'ignore_sticky_posts' => 1, "orderby" => "comment_count", "order" => "DSC" );

		if ( !empty( $instance["cats"] ) ) {
			$query["cat"] = implode( ",", $instance["cats"] );
		}


		$recent = new WP_Query( $query );

		if ( $recent-> have_posts() ) :

			echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title; ?>

        <ul class="widget_post">

		<?php while ( $recent-> have_posts() ) : $recent -> the_post(); ?>

        <li>
        <?php if ( $disable_thumbnail ) : ?>
        <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" class="thumb">


        		<?php if ( has_post_thumbnail() ) :
			the_post_thumbnail( array( 60, 60 ), array( "title" => get_the_title(), "alt" => get_the_title() ) );
		endif; ?>

			</a>
			<?php endif; ?>
            <div class="post_info">
       	<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>


       <?php if ( $disable_time ) : ?>
       		<time datetime="<?php the_time( $date_format ) ?>"><?php echo get_the_date( $date_format ); ?></time>
       <?php endif; ?>
       <?php if ( $disable_desc ) : ?>
      		 <span class="desc"><?php echo wp_html_excerpt( get_the_excerpt(), $desc_length );?>...</span>
	   <?php endif; ?>
       </div>
       </li>
        <div class="clearboth"></div>
        <?php endwhile;  ?>

        </ul>
        <?php
		echo $after_widget;

		wp_reset_query();


		endif;


		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'Wavesnow_Widget_Popular_Posts', $cache, 'widget' );


	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance["title"] = strip_tags( $new_instance["title"] );
		$instance["posts_number"] = (int) $new_instance["posts_number"];
		$instance["desc_length"] = (int) $new_instance["desc_length"];
		$instance["disable_thumbnail"] = !empty( $new_instance["disable_thumbnail"] ) ? 1 : 0;
		$instance["disable_desc"] = !empty( $new_instance["disable_desc"] ) ? 1 : 0;
		$instance["disable_time"] = !empty( $new_instance["disable_time"] ) ? 1 : 0;
		$instance["cats"] = $new_instance["cats"];
		$instance["date_format"] = $new_instance["date_format"];

		$this-> flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['Wavesnow_Widget_Popular_Posts'] ) )
			delete_option( 'Wavesnow_Widget_Popular_Posts' );

		return $instance;
	}



	function flush_widget_cache() {
		wp_cache_delete( 'Wavesnow_Widget_Popular_Posts', 'widget' );
	}

	function form( $instance ) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$disable_thumbnail = isset( $instance["disable_thumbnail"] ) ? (bool) $instance["disable_thumbnail"] : false;

		$disable_desc = isset( $instance["disable_desc"] ) ? (bool) $instance["disable_desc"] : false;
		$disable_time = isset( $instance["disable_time"] ) ? (bool) $instance["disable_time"] : false;
		$cats = isset( $instance['cats'] ) ? $instance['cats'] : array();
		$date_format = isset( $instance["date_format"] ) ? $instance["date_format"] : "F j, Y";

		if ( !isset( $instance['posts_number'] ) || !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 5;

		if ( !isset( $instance['desc_length'] ) || !$desc_length = (int) $instance['desc_length'] )
			$desc_length = 60;

		$categories = get_categories( 'orderby=name&hide_empty=0' );


?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'posts_number' ); ?>">Number of posts to show:</label>
		<input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" type="text" value="<?php echo $posts_number; ?>" size="3" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'disable_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'disable_thumbnail' ); ?>"<?php checked( $disable_thumbnail ); ?> />
		<label for="<?php echo $this->get_field_id( 'disable_thumbnail' ); ?>">Post Thumbnail</label></p>



        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'disable_desc' ); ?>" name="<?php echo $this->get_field_name( 'disable_desc' ); ?>"<?php checked( $disable_desc ); ?> />
		<label for="<?php echo $this->get_field_id( 'disable_desc' ); ?>">Post Description</label></p>



        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'disable_time' ); ?>" name="<?php echo $this->get_field_name( 'disable_time' ); ?>"<?php checked( $disable_time ); ?> />
		<label for="<?php echo $this->get_field_id( 'disable_time' ); ?>">Post Time</label></p>


				<p>
			<label for="<?php echo $this->get_field_id( 'date_format' ); ?>">Date Format:</label>
			<select name="<?php echo $this->get_field_name( 'date_format' ); ?>" id="<?php echo $this->get_field_id( 'date_format' ); ?>" class="widefat">
                <option value="F j, Y"<?php selected( $date_format, 'F j, Y' );?>>November 6, 2011</option>
                <option value="F, Y"<?php selected( $date_format, 'F, Y' );?>>November, 2011</option>
                <option value="D, F jS, Y"<?php selected( $date_format, 'D, F jS, Y' );?>>Sat, November 6th, 2011</option>
                <option value="F j, Y g:i A"<?php selected( $date_format, 'F j, Y g:i A' );?>>November 6, 2011 12:50 AM</option>
                <option value="M j, Y"<?php selected( $date_format, 'M j, Y' );?>>Nov 6, 2011</option>
                <option value="Y/m/d"<?php selected( $date_format, 'Y/m/d' );?>>2011/11/06</option>
                <option value="Y-m-d"<?php selected( $date_format, 'Y-m-d' );?>>2011-11-06</option>

			</select>
		</p>



		<p><label for="<?php echo $this->get_field_id( 'desc_length' ); ?>">Length of Description:</label>
		<input id="<?php echo $this->get_field_id( 'desc_length' ); ?>" name="<?php echo $this->get_field_name( 'desc_length' ); ?>" type="text" value="<?php echo $desc_length; ?>" size="3" /></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>">Categories:</label>
			<select style="height:15em" name="<?php echo $this->get_field_name( 'cats' ); ?>[]" id="<?php echo $this->get_field_id( 'cats' ); ?>" class="widefat" multiple="multiple">
				<?php foreach ( $categories as $category ):?>
				<option value="<?php echo $category->term_id;?>"<?php echo in_array( $category->term_id, $cats )? ' selected="selected"':'';?>><?php echo $category->name;?></option>
				<?php endforeach;?>
			</select>
		</p>
<?php


	}
}
/***************************************************/


/*
	RECENT POSTS
*/

class Wave_Recent_Posts_Widget extends WP_Widget {

	function Wave_Recent_Posts_Widget() {
		$widget_ops = array( "classname" => "widget_recent_posts", "description" => "Displays the Recent posts" );
		$this-> WP_Widget( "recent_posts", THEME_SLUG . " - Recent Posts", $widget_ops );
		$this-> alt_option_name = "widget_recent_posts";

		add_action( "save_post", array( &$this, "flush_widget_cache" ) );
		add_action( "deleted_post", array( &$this, "flush_widget_cache" ) );
		add_action( "switch_theme", array( &$this, "flush_widget_cache" ) );
	}


	function widget( $args, $instance ) {

		$cache = wp_cache_get( "Wavesnow_Widget_Recent_Posts", "widget" );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract( $args );


		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 10;
		else if ( $posts_number < 1 )
				$posts_number = 1;
			else if ( $posts_number > 15 )
					$posts_number = 15;

				if ( !$desc_length = (int) $instance['desc_length'] )
					$desc_length = 80;
				else if ( $desc_length < 1 )
						$desc_length = 1;


					$disable_thumbnail = $instance["disable_thumbnail"] ? "1" : "0";
				$disable_desc = $instance["disable_desc"] ? "1" : "0";
			$disable_time = $instance["disable_time"] ? "1" : "0";
		$date_format = $instance['date_format'] ? $instance['date_format'] :'F j, Y';



		$query = array( 'showposts' => $posts_number, 'nopaging' => 0, 'orderby'=> 'date', 'order'=>'DESC', 'post_status' => 'publish', 'ignore_sticky_posts' => 1 );
		if ( !empty( $instance["cats"] ) ) {
			$query["cat"] = implode( ",", $instance["cats"] );
		}

		$recent = new WP_Query( $query );

		if ( $recent-> have_posts() ) :

			echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title; ?>

        <ul class="widget_post">

		<?php

		while ( $recent-> have_posts() ) : $recent -> the_post(); ?>

        <li>
        <?php if ( $disable_thumbnail ) : ?>
        <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" class="thumb">


        		<?php if ( has_post_thumbnail() ) :
			the_post_thumbnail( array( 60, 60 ), array( "title" => get_the_title(), "alt" => get_the_title() ) );

		endif; ?>

			</a>
			<?php endif; ?>
            <div class="post_info">
       	<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>


       <?php if ( $disable_time ) : ?>
       		<time datetime="<?php the_time( $date_format ) ?>"><?php echo get_the_date( $date_format ); ?></time>
       <?php endif; ?>

       <?php if ( $disable_desc ) : ?>
      		 <span class="desc"><?php echo wp_html_excerpt( get_the_excerpt(), $desc_length );?>...</span>
	   <?php endif; ?>
       </div>
       </li>
        <div class="clearboth"></div>
        <?php endwhile;  ?>

        </ul>
        <?php
		echo $after_widget;

		wp_reset_query();


		endif;


		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'Widget_Recent_Posts', $cache, 'widget' );


	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance["title"] = strip_tags( $new_instance["title"] );
		$instance["posts_number"] = (int) $new_instance["posts_number"];
		$instance["desc_length"] = (int) $new_instance["desc_length"];
		$instance["disable_thumbnail"] = !empty( $new_instance["disable_thumbnail"] ) ? 1 : 0;
		$instance["disable_desc"] = !empty( $new_instance["disable_desc"] ) ? 1 : 0;
		$instance["disable_time"] = !empty( $new_instance["disable_time"] ) ? 1 : 0;
		$instance["cats"] = $new_instance["cats"];
		$instance["date_format"] = $new_instance["date_format"];

		$this-> flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['Widget_Recent_Posts'] ) )
			delete_option( 'Widget_Recent_Posts' );

		return $instance;
	}



	function flush_widget_cache() {
		wp_cache_delete( 'Widget_Recent_Posts', 'widget' );
	}





	function form( $instance ) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$disable_thumbnail = isset( $instance["disable_thumbnail"] ) ? (bool) $instance["disable_thumbnail"] : false;

		$disable_desc = isset( $instance["disable_desc"] ) ? (bool) $instance["disable_desc"] : false;
		$disable_time = isset( $instance["disable_time"] ) ? (bool) $instance["disable_time"] : false;
		$cats = isset( $instance['cats'] ) ? $instance['cats'] : array();
		$date_format = isset( $instance["date_format"] ) ? $instance["date_format"] : "F j, Y";

		if ( !isset( $instance['posts_number'] ) || !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 5;

		if ( !isset( $instance['desc_length'] ) || !$desc_length = (int) $instance['desc_length'] )
			$desc_length = 60;

		$categories = get_categories( 'orderby=name&hide_empty=0' );


?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'posts_number' ); ?>">Number of posts to show:</label>
		<input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" type="text" value="<?php echo $posts_number; ?>" size="3" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'disable_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'disable_thumbnail' ); ?>"<?php checked( $disable_thumbnail ); ?> />
		<label for="<?php echo $this->get_field_id( 'disable_thumbnail' ); ?>">Post Thumbnail</label></p>



        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'disable_desc' ); ?>" name="<?php echo $this->get_field_name( 'disable_desc' ); ?>"<?php checked( $disable_desc ); ?> />
		<label for="<?php echo $this->get_field_id( 'disable_desc' ); ?>">Post Description</label></p>



        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'disable_time' ); ?>" name="<?php echo $this->get_field_name( 'disable_time' ); ?>"<?php checked( $disable_time ); ?> />
		<label for="<?php echo $this->get_field_id( 'disable_time' ); ?>">Post Time</label></p>


				<p>
			<label for="<?php echo $this->get_field_id( 'date_format' ); ?>">Date Format:</label>
			<select name="<?php echo $this->get_field_name( 'date_format' ); ?>" id="<?php echo $this->get_field_id( 'date_format' ); ?>" class="widefat">
                <option value="F j, Y"<?php selected( $date_format, 'F j, Y' );?>>November 6, 2011</option>
                <option value="F, Y"<?php selected( $date_format, 'F, Y' );?>>November, 2011</option>
                <option value="D, F jS, Y"<?php selected( $date_format, 'D, F jS, Y' );?>>Sat, November 6th, 2011</option>
                <option value="F j, Y g:i A"<?php selected( $date_format, 'F j, Y g:i A' );?>>November 6, 2011 12:50 AM</option>
                <option value="M j, Y"<?php selected( $date_format, 'M j, Y' );?>>Nov 6, 2011</option>
                <option value="Y/m/d"<?php selected( $date_format, 'Y/m/d' );?>>2011/11/06</option>
                <option value="Y-m-d"<?php selected( $date_format, 'Y-m-d' );?>>2011-11-06</option>

			</select>
		</p>



		<p><label for="<?php echo $this->get_field_id( 'desc_length' ); ?>">Length of Description:</label>
		<input id="<?php echo $this->get_field_id( 'desc_length' ); ?>" name="<?php echo $this->get_field_name( 'desc_length' ); ?>" type="text" value="<?php echo $desc_length; ?>" size="3" /></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>">Categories:</label>
			<select style="height:15em" name="<?php echo $this->get_field_name( 'cats' ); ?>[]" id="<?php echo $this->get_field_id( 'cats' ); ?>" class="widefat" multiple="multiple">
				<?php foreach ( $categories as $category ):?>
				<option value="<?php echo $category->term_id;?>"<?php echo in_array( $category->term_id, $cats )? ' selected="selected"':'';?>><?php echo $category->name;?></option>
				<?php endforeach;?>
			</select>
		</p>
<?php


	}
}

/***************************************************/










/*
	RELATED POSTS
*/

class Wave_Related_Posts_Widget extends WP_Widget {

	function Wave_Related_Posts_Widget() {
		$widget_ops = array( "classname" => "widget_related_posts", "description" => "Displays the Recent posts" );
		$this-> WP_Widget( "related_posts", THEME_SLUG . " - Related Posts", $widget_ops );
		$this-> alt_option_name = "widget_related_posts";

		add_action( "save_post", array( &$this, "flush_widget_cache" ) );
		add_action( "deleted_post", array( &$this, "flush_widget_cache" ) );
		add_action( "switch_theme", array( &$this, "flush_widget_cache" ) );
	}


	function widget( $args, $instance ) {

		$cache = wp_cache_get( "Wavesnow_Widget_Related_Posts", "widget" );

		if ( !is_array( $cache ) )
			$cache = array();

		if ( isset( $cache[$args['widget_id']] ) ) {
			echo $cache[$args['widget_id']];
			return;
		}

		ob_start();
		extract( $args );


		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		if ( !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 10;
		else if ( $posts_number < 1 )
				$posts_number = 1;
			else if ( $posts_number > 15 )
					$posts_number = 15;

				if ( !$desc_length = (int) $instance['desc_length'] )
					$desc_length = 80;
				else if ( $desc_length < 1 )
						$desc_length = 1;


					$disable_thumbnail = $instance["disable_thumbnail"] ? "1" : "0";
				$disable_desc = $instance["disable_desc"] ? "1" : "0";
			$disable_time = $instance["disable_time"] ? "1" : "0";
		$date_format = $instance['date_format'] ? $instance['date_format'] :'F j, Y';

		global $post;
		if(empty($post->ID)) {
			return false;
		}
		$query = '';
		$tags = wp_get_post_tags($post->ID);
		$tagIDs = array();
		if ($tags) {
			$tagcount = count($tags);
			for ($i = 0; $i < $tagcount; $i++) {
				$tagIDs[$i] = $tags[$i]->term_id;
			}

			$query = array('tag__in' => $tagIDs,'post__not_in' => array($post->ID),'showposts' => $posts_number, 'nopaging' => 0, 'post_status' => 'publish', 'ignore_sticky_posts' => 1);
			if(!empty($instance['cat'])){
				$query['cat'] = implode(',', $instance['cat']);
			}
		}	
			$r = new WP_Query($query);
				if ($r->have_posts()) :		

			echo $before_widget;

		if ( $title ) echo $before_title . $title . $after_title; ?>

        <ul class="widget_post">

		<?php while ( $r-> have_posts() ) : $r -> the_post(); ?>

        <li>
        <?php if ( $disable_thumbnail ) : ?>
        <a href="<?php echo get_permalink(); ?>" title="<?php the_title(); ?>" class="thumb">


        		<?php if ( has_post_thumbnail() ) :
			the_post_thumbnail( array( 60, 60 ), array( "title" => get_the_title(), "alt" => get_the_title() ) );


		else : ?>

            	<img src="<?php echo THEME_IMAGES; ?>/empty_thumb.png" class="empty_thumb" alt="<?php get_the_title(); ?>" title="<?php get_the_title(); ?>"  />
             </a>
			<?php endif; ?>


			<?php endif; ?>
            <div class="post_info">
       	<a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>


       <?php if ( $disable_time ) : ?>
       		<time datetime="<?php the_time( $date_format ) ?>"><?php echo get_the_date( $date_format ); ?></time>
       <?php endif; ?>

       <?php if ( $disable_desc ) : ?>
      		 <span class="desc"><?php echo wp_html_excerpt( get_the_excerpt(), $desc_length );?>...</span>
	   <?php endif; ?>
       </div>
       </li>
        <div class="clearboth"></div>
        <?php endwhile;  ?>

        </ul>
        <?php
		echo $after_widget;
		wp_reset_query();


		endif;


		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set( 'Wavesnow_Widget_Related_Posts', $cache, 'widget' );

	}


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance["title"] = strip_tags( $new_instance["title"] );
		$instance["posts_number"] = (int) $new_instance["posts_number"];
		$instance["desc_length"] = (int) $new_instance["desc_length"];
		$instance["disable_thumbnail"] = !empty( $new_instance["disable_thumbnail"] ) ? 1 : 0;
		$instance["disable_desc"] = !empty( $new_instance["disable_desc"] ) ? 1 : 0;
		$instance["disable_time"] = !empty( $new_instance["disable_time"] ) ? 1 : 0;
		$instance["cats"] = $new_instance["cats"];
		$instance["date_format"] = $new_instance["date_format"];

		$this-> flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset( $alloptions['Wavesnow_Widget_Related_Posts'] ) )
			delete_option( 'Wavesnow_Widget_Related_Posts' );

		return $instance;
	}



	function flush_widget_cache() {
		wp_cache_delete( 'Wavesnow_Widget_Related_Posts', 'widget' );
	}

	function form( $instance ) {

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$disable_thumbnail = isset( $instance["disable_thumbnail"] ) ? (bool) $instance["disable_thumbnail"] : false;

		$disable_desc = isset( $instance["disable_desc"] ) ? (bool) $instance["disable_desc"] : false;
		$disable_time = isset( $instance["disable_time"] ) ? (bool) $instance["disable_time"] : false;
		$cats = isset( $instance['cats'] ) ? $instance['cats'] : array();
		$date_format = isset( $instance["date_format"] ) ? $instance["date_format"] : "F j, Y";

		if ( !isset( $instance['posts_number'] ) || !$posts_number = (int) $instance['posts_number'] )
			$posts_number = 5;

		if ( !isset( $instance['desc_length'] ) || !$desc_length = (int) $instance['desc_length'] )
			$desc_length = 60;

		$categories = get_categories( 'orderby=name&hide_empty=0' );


?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'posts_number' ); ?>">Number of posts to show:</label>
		<input id="<?php echo $this->get_field_id( 'posts_number' ); ?>" name="<?php echo $this->get_field_name( 'posts_number' ); ?>" type="text" value="<?php echo $posts_number; ?>" size="3" /></p>

		<p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'disable_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'disable_thumbnail' ); ?>"<?php checked( $disable_thumbnail ); ?> />
		<label for="<?php echo $this->get_field_id( 'disable_thumbnail' ); ?>">Post Thumbnail</label></p>



        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'disable_desc' ); ?>" name="<?php echo $this->get_field_name( 'disable_desc' ); ?>"<?php checked( $disable_desc ); ?> />
		<label for="<?php echo $this->get_field_id( 'disable_desc' ); ?>">Post Description</label></p>



        <p><input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id( 'disable_time' ); ?>" name="<?php echo $this->get_field_name( 'disable_time' ); ?>"<?php checked( $disable_time ); ?> />
		<label for="<?php echo $this->get_field_id( 'disable_time' ); ?>">Post Time</label></p>


				<p>
			<label for="<?php echo $this->get_field_id( 'date_format' ); ?>">Date Format:</label>
			<select name="<?php echo $this->get_field_name( 'date_format' ); ?>" id="<?php echo $this->get_field_id( 'date_format' ); ?>" class="widefat">
                <option value="F j, Y"<?php selected( $date_format, 'F j, Y' );?>>November 6, 2011</option>
                <option value="F, Y"<?php selected( $date_format, 'F, Y' );?>>November, 2011</option>
                <option value="D, F jS, Y"<?php selected( $date_format, 'D, F jS, Y' );?>>Sat, November 6th, 2011</option>
                <option value="F j, Y g:i A"<?php selected( $date_format, 'F j, Y g:i A' );?>>November 6, 2011 12:50 AM</option>
                <option value="M j, Y"<?php selected( $date_format, 'M j, Y' );?>>Nov 6, 2011</option>
                <option value="Y/m/d"<?php selected( $date_format, 'Y/m/d' );?>>2011/11/06</option>
                <option value="Y-m-d"<?php selected( $date_format, 'Y-m-d' );?>>2011-11-06</option>

			</select>
		</p>



		<p><label for="<?php echo $this->get_field_id( 'desc_length' ); ?>">Length of Description:</label>
		<input id="<?php echo $this->get_field_id( 'desc_length' ); ?>" name="<?php echo $this->get_field_name( 'desc_length' ); ?>" type="text" value="<?php echo $desc_length; ?>" size="3" /></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>">Categories:</label>
			<select style="height:15em" name="<?php echo $this->get_field_name( 'cats' ); ?>[]" id="<?php echo $this->get_field_id( 'cats' ); ?>" class="widefat" multiple="multiple">
				<?php foreach ( $categories as $category ):?>
				<option value="<?php echo $category->term_id;?>"<?php echo in_array( $category->term_id, $cats )? ' selected="selected"':'';?>><?php echo $category->name;?></option>
				<?php endforeach;?>
			</select>
		</p>
<?php


	}
}
/***************************************************/







?>
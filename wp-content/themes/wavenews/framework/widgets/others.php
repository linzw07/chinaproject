<?php


/*
	TESTIMONIAL WIDGET
*/

class Wave_Testimonials_Widget extends WP_Widget {

	function Wave_Testimonials_Widget() {
		$widget_ops = array( 'classname' => 'widget_testimonials', 'description' => 'Displays a testimonail slider.' );
		$this->WP_Widget( 'testimonial_widget', THEME_SLUG.' - '.'Testimonial', $widget_ops );

		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_enqueue_scripts', array( &$this, 'add_slide_script' ) );
		}

	}

	function add_slide_script() {
		wp_enqueue_script( 'jquery-slides' );
	}

	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Testimonial' : $instance['title'], $instance, $this->id_base );
		$count = (int)$instance["count"];
		$speed = (int)$instance["speed"];
		$pause = (int)$instance["pause"];
		$effect = $instance["effect"];
		$random = rand( 0, 999999 );
		$output = '<div class="testimonial_slider" id="testimonial_slider_' . $random . '"><div class="testimonial_arrow"><a class="prev"></a><a class="next"></a></div><div id="slides"><div  class="slides_container">';
		if ( $count > 0 ) {

			for ( $i=1; $i<=$count; $i++ ) {
				$quote =  isset( $instance["quote_".$i] ) ? $instance["quote_".$i] : '';
				$company =  isset( $instance["company_".$i] ) ? $instance["company_".$i]:'';
				$url =  isset( $instance["url_".$i] ) ? $instance["url_".$i]:'';

				$output .= '<div class="testimonial_item"><div class="testimonial_content "><div class="testimonail_icon"></div>' . $quote . '</div><a class="testimonial_company" href="' . $url .'">' . $company  . '</a></div>';

			}
		}

		$output .= "</div></div></div>";

		if ( !empty( $output ) ) {
			echo $before_widget;

?>

<script type="text/javascript">

		jQuery(document).ready(function() {
		widget_container_width = jQuery("#testimonial_slider_<?php echo $random; ?>").parent().outerWidth()-40;
		jQuery("#testimonial_slider_<?php echo $random; ?>, #testimonial_slider_<?php echo $random; ?> .testimonial_item").css('width', widget_container_width);
	   jQuery("#testimonial_slider_<?php echo $random; ?>").slides({preload: true, effect: "slide", generatePagination:false,  slideSpeed: <?php echo $speed; ?>,  autoHeight: true, play: <?php echo $pause; ?>, hoverPause: true, pause:<?php echo $pause; ?> })});

</script>
            <?php

			if ( $title )
				echo $before_title . $title . $after_title;

			echo $output;
			echo $after_widget;

		}

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['count'] = (int)$new_instance['count'];
		$instance['speed'] = (int)$new_instance['speed'];
		$instance['pause'] = (int)$new_instance['pause'];
		$instance['effect'] = $new_instance['effect'];
		for ( $i=1;$i<=$instance['count'];$i++ ) {
			$instance["quote_".$i] = isset( $new_instance['quote_'.$i] ) ? strip_tags( $new_instance['quote_'.$i] ) : '';
			$instance["company_".$i] =  isset( $new_instance['company_'.$i] ) ? strip_tags( $new_instance['company_'.$i] ) : '';
			$instance["url_".$i] = isset( $new_instance['url_'.$i] ) ? strip_tags( $new_instance['url_'.$i] ) : '';
		}

		return $instance;
	}


	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$count = isset( $instance['count'] ) ? absint( $instance['count'] ) : 3;
		$speed = isset( $instance['speed'] ) ? absint( $instance['speed'] ) : 800;
		$pause = isset( $instance['pause'] ) ? absint( $instance['pause'] ) : 10000;
		$effect = isset( $instance['effect'] ) ? $instance['effect'] : 'fade';
		for ( $i=1;$i<=10;$i++ ) {


			$quote = 'quote_'.$i;
			$$quote = isset( $instance[$quote] ) ? $instance[$quote] : '';
			$company = 'company_'.$i;
			$$company = isset( $instance[$company] ) ? $instance[$company] : '';
			$url = 'url_'.$i;
			$$url = isset( $instance[$url] ) ? $instance[$url] : '';
		}


?>

		<p>
        <label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
        </p>

        	<p><label for="<?php echo $this->get_field_id( 'count' ); ?>">How many Testimonials to rotate?</label>
		<input id="<?php echo $this->get_field_id( 'count' ); ?>"  name="<?php echo $this->get_field_name( 'count' ); ?>" type="text" value="<?php echo $count; ?>" size="3" /></p>

          <p><label for="<?php echo $this->get_field_id( 'speed' ); ?>">Speed</label>
		<input id="<?php echo $this->get_field_id( 'speed' ); ?>"  name="<?php echo $this->get_field_name( 'speed' ); ?>" type="text" value="<?php echo $speed; ?>" size="5" /> Milisec
         </p>

		  <p><label for="<?php echo $this->get_field_id( 'pause' ); ?>">Pause</label>
		<input id="<?php echo $this->get_field_id( 'pause' ); ?>"  name="<?php echo $this->get_field_name( 'pause' ); ?>" type="text" value="<?php echo $pause; ?>" size="5" /> Milisec
         </p>
                 	<p>
			<label for="<?php echo $this->get_field_id( 'effect' ); ?>">Effect:</label>
			<select name="<?php echo $this->get_field_name( 'effect' ); ?>" id="<?php echo $this->get_field_id( 'effect' ); ?>" class="widefat">
            	<option value="fade"<?php selected( $effect, 'fade' );?>>Fade</option>
				<option value="slide"<?php selected( $effect, 'slide' );?>>Slide</option>

			</select>
		</p>


<div class="testimonail_wrap">
<?php for ( $i=1;$i<=10;$i++ ): $quote = 'quote_'.$i; $company = 'company_'.$i; $url = 'url_'.$i; ?>
<div class="testimonial_<?php echo $i;?>" <?php if ( $i>$count ):?>style="display:none;"<?php endif;?> style="padding-bottom:30px">


<p>
<label for="<?php echo $this->get_field_id( $quote ); ?>"><?php printf( '#%s Quote:', $i );?></label>
<textarea style="width:98%" rows="6" id="<?php echo $this->get_field_id( $quote ); ?>" name="<?php echo $this->get_field_name( $quote ); ?>" ><?php echo $instance['quote_'.$i]; ?></textarea>
</p>

<p>
<label for="<?php echo $this->get_field_id( $company ); ?>"><?php printf( '#%s Company:', $i );?></label>
<input class="widefat" id="<?php echo $this->get_field_id( $company ); ?>" name="<?php echo $this->get_field_name( $company ); ?>" type="text" value="<?php echo $$company; ?>" />
</p>

<p>
<label for="<?php echo $this->get_field_id( $url ); ?>"><?php printf( '#%s URL:', $i );?></label>
<input class="widefat" id="<?php echo $this->get_field_id( $url ); ?>" name="<?php echo $this->get_field_name( $url ); ?>" type="text" value="<?php echo $$url; ?>" />
</p>
			</div>

		<?php endfor;?>
		</div>



	<?php
	}
}
/***************************************************/


/*
	SUBNAVIGATION WIDGET
*/

class Wave_Sub_Navigation_Widget extends WP_Widget {

	function Wave_Sub_Navigation_Widget() {
		$widget_ops = array( 'classname' => 'widget_sub_navigation', 'description' => 'Displays a list of Sub Pages' );
		$this->WP_Widget( 'subnav', THEME_SLUG.' - '. 'Sub Navigation', $widget_ops );
	}

	function widget( $args, $instance ) {
		global $post;
		$children=wp_list_pages( 'echo=0&child_of=' . $post->ID . '&title_li=' );
		if ( $children ) {
			$parent = $post->ID;
		}else {
			$parent = $post->post_parent;
			if ( !$parent ) {
				$parent = $post->ID;
			}
		}
		$parent_title = get_the_title( $parent );

		extract( $args );
		$title = $instance['title'];
		$sortby = empty( $instance['sortby'] ) ? 'menu_order' : $instance['sortby'];
		$exclude = $instance['exclude'];

		$output = wp_list_pages( array( 'title_li' => '', 'echo' => 0, 'child_of' =>$parent, 'sort_column' => $sortby, 'exclude' => $exclude, 'depth' => 1 ) );

		if ( !empty( $output ) ) {
			echo $before_widget;
			if ( $title )
				echo $before_title . $title . $after_title;
?>
		<ul>
			<?php echo $output; ?>
		</ul>
		<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		if ( in_array( $new_instance['sortby'], array( 'post_title', 'menu_order', 'ID' ) ) ) {
			$instance['sortby'] = $new_instance['sortby'];
		} else {
			$instance['sortby'] = 'menu_order';
		}

		$instance['exclude'] = strip_tags( $new_instance['exclude'] );

		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$instance = wp_parse_args( (array) $instance, array( 'sortby' => 'menu_order', 'title' => '', 'exclude' => '' ) );
		$title = esc_attr( $instance['title'] );
		$exclude = esc_attr( $instance['exclude'] );
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

        <p>
			<label for="<?php echo $this->get_field_id( 'sortby' ); ?>">Sort by:</label>
			<select name="<?php echo $this->get_field_name( 'sortby' ); ?>" id="<?php echo $this->get_field_id( 'sortby' ); ?>" class="widefat">
				<option value="menu_order"<?php selected( $instance['sortby'], 'menu_order' ); ?>>Page order</option>
				<option value="post_title"<?php selected( $instance['sortby'], 'post_title' ); ?>>Page title</option>
				<option value="ID"<?php selected( $instance['sortby'], 'ID' ); ?>>Page ID</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'exclude' ); ?>">Exclude:</label> <input type="text" value="<?php echo $exclude; ?>" name="<?php echo $this->get_field_name( 'exclude' ); ?>" id="<?php echo $this->get_field_id( 'exclude' ); ?>" class="widefat" />
			<br />
			<small>Page IDs, Separate with a comma (eg: 12,34,543,98)</small>
		</p>
<?php
	}

}
/***************************************************/


/*
	MOST POPULAR TAGS WIDGET
*/

class Wave_Most_Popular_Tags_Widget extends WP_Widget {

	/**
	 *
	 */
	function Wave_Most_Popular_Tags_Widget() {
		$widget_ops = array( 'classname' => 'widget_most_popular_tags', 'description' => "Displays the popular tags or categories on your site" );
		$this->WP_Widget( 'popular_tags', THEME_SLUG.' - '.'Popular tags, Categories', $widget_ops );
		$this->alt_option_name = 'widget_popular_tags';

	}
	/**
	 *
	 */
	function widget( $args, $instance ) {
		extract( $args );

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? ' ' : $instance['title'] );
		$tagcount = empty( $instance['tagcount'] ) ? 0 : $instance['tagcount'];
		$smallest = empty( $instance['smallest'] ) ? 12 : $instance['smallest'];
		$largest = empty( $instance['largest'] ) ? 12 : $instance['largest'];
		$unit = empty( $instance['unit'] ) ? 'px' : $instance['unit'];
		$format = empty( $instance['format'] ) ? 'flat' : $instance['format'];
		$orderby = empty( $instance['orderby'] ) ? 'count' : $instance['orderby'];
		$order = empty( $instance['order'] ) ? 'DESC' : $instance['order'];
		$taxonomy = empty( $instance['taxonomy'] ) ? 'post_tag' : $instance['taxonomy'];

		echo $before_widget;

		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		wp_tag_cloud( "smallest=$smallest".
			"&largest=$largest".
			"&number=$tagcount".
			"&orderby=$orderby".
			"&order=$order".
			"&unit=$unit".
			"&format=$format".
			"&taxonomy=$taxonomy" );

		echo $after_widget;
	}

	/**
	 *
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['tagcount'] = intval( $new_instance['tagcount'] );
		$instance['smallest'] = intval( $new_instance['smallest'] );
		$instance['largest'] = intval( $new_instance['largest'] );
		$instance['unit'] = $new_instance['unit'];
		$instance['format'] = $new_instance['format'];
	//	$instance['colorstyle'] = $new_instance['colorstyle'];
		$instance['orderby'] = $new_instance['orderby'];
		$instance['order'] = $new_instance['order'];
		$instance['taxonomy'] = $new_instance['taxonomy'];

		return $instance;
	}

	/**
	 *
	 */
	function form( $instance ) {
		$instance = wp_parse_args( (array)$instance, array( 'title' => 'Most Popular Tags',
				'tagcount' => 0,
				'smallest' => 12,
				'largest' => 12,
				'unit' => 'px',
				'format' => 'flat',
				'orderby' => 'count',
				'order' => 'DESC',
				'taxonomy' => 'post_tag' ) );

		$title = esc_html( $instance['title'] );
		$unit = $instance['unit'];
		$format = $instance['format'];
		$orderby = $instance['orderby'];
		$order = $instance['order'];
		$taxonomy = $instance['taxonomy'];


		$selected = "selected";

		if ( $instance['unit'] == "px" )
			$s1 = $selected;
		elseif ( $instance['unit'] == "pt" )
			$s2 = $selected;
		elseif ( $instance['unit'] == "%" )
			$s3 = $selected;
		elseif ( $instance['unit'] == "em" )
			$s4 = $selected;
		elseif ( $instance['unit'] == "pc" )
			$s5 = $selected;
		elseif ( $instance['unit'] == "mm" )
			$s6 = $selected;
		elseif ( $instance['unit'] == "cm" )
			$s7 = $selected;
		else
			$s8 = $selected;

		if ( $instance['format'] == "flat" ) {
			$f1 = $selected;
			$sepcss = "";
		}
		else {
			$f2 = $selected;
			$sepcss = "display:none";
		}

		if ( $instance['orderby'] == "count" )
			$ob1 = $selected;
		else
			$ob2 = $selected;

		if ( $instance['order'] == "ASC" )
			$o1 = $selected;
		elseif ( $instance['order'] == "DESC" )
			$o2 = $selected;
		else
			$o3 = $selected;

		if ( $instance['taxonomy'] == "post_tag" )
			$t1 = $selected;
		elseif ( $instance['taxonomy'] == "category" )
			$t2 = $selected;
		else
			$t3 = $selected;

		echo '<p>
          <label for="'.$this->get_field_name( 'title' ).'">Title: </label><br />
          <input class="widefat" type="text" id="'.$this->get_field_id( 'title' ).'" name="'.$this->get_field_name( 'title' ).'" value="'.$title.'"/>
        </p>
        <p>
        <p>
          <label for="'.$this->get_field_name( 'taxonomy' ).'">Show: </label><br />
          <select class="widefat" id="'.$this->get_field_id( 'taxonomy' ).'" name="'.$this->get_field_name( 'taxonomy' ).'">
            <option value="post_tag" '.$t1.'>Tags</option>
            <option value="category" '.$t2.'>Categories</option>
						<option value="link_category" '.$t3.'>Link categories</option>
          </select>
        </p>
        <p>
          <label for="'.$this->get_field_name( 'tagcount' ).'">Number of items to show: </label><br />
          <input class="widefat" type="text" id="'.$this->get_field_id( 'tagcount' ).'" name="'.$this->get_field_name( 'tagcount' ).'" value="'.$instance['tagcount'].'"/>
        </p>
        <p><small>0 shows all available items.</small></p>
        <p>
          <label for="'.$this->get_field_name( 'smallest' ).'">Smallest font size: </label><br />
          <input class="widefat" type="text" id="'.$this->get_field_id( 'smallest' ).'" name="'.$this->get_field_name( 'smallest' ).'" value="'.$instance['smallest'].'"/>
        </p>
        <p>
          <label for="'.$this->get_field_name( 'largest' ).'">Largest font size: </label><br />
          <input class="widefat" type="text" id="'.$this->get_field_id( 'largest' ).'" name="'.$this->get_field_name( 'largest' ).'" value="'.$instance['largest'].'"/>
        </p>
        <p>
          <label for="'.$this->get_field_name( 'unit' ).'">Unit: </label><br />
          <select class="widefat" id="'.$this->get_field_id( 'unit' ).'" name="'.$this->get_field_name( 'unit' ).'">
            <option value="px" '.$s1.'>Pixels (px)</option>
            <option value="pt" '.$s2.'>Points (pt)</option>
            <option value="%" '.$s3.'>Percent (%)</option>
            <option value="em" '.$s4.'>Ems (em)</option>
            <option value="pc" '.$s5.'>Picas (pc)</option>
            <option value="mm" '.$s6.'>Millimeters (mm)</option>
            <option value="cm" '.$s7.'>Centimeters (cm)</option>
            <option value="in" '.$s8.'>Inches (in)</option>
          </select>
        </p>
        <p><small>For more information about css units please refer to <a href="http://www.w3schools.com/css/css_units.asp">W3Schools</a>.</small></p>
        <p>
          <label for="'.$this->get_field_name( 'format' ).'">Format: </label><br />
          <select class="widefat" id="'.$this->get_field_id( 'format' ).'" name="'.$this->get_field_name( 'format' ).'" onChange="if(document.getElementById(\''.$this->get_field_id( 'format' ).'\').selectedIndex == 0) {document.getElementById(\''.$this->get_field_id( 'separator' ).'mptags\').style.display = \'\';} else {document.getElementById(\''.$this->get_field_id( 'separator' ).'mptags\').style.display = \'none\';}">
            <option value="flat" '.$f1.'>Flat</option>
            <option value="list" '.$f2.'>List</option>
          </select>
        </p>
        <p>
          <label for="'.$this->get_field_name( 'orderby' ).'">Order by: </label><br />
          <select class="widefat" id="'.$this->get_field_id( 'orderby' ).'" name="'.$this->get_field_name( 'orderby' ).'">
            <option value="count" '.$ob1.'>Number of posts</option>
            <option value="name" '.$ob2.'>Tag name</option>
          </select>
        </p>
        <p>
          <label for="'.$this->get_field_name( 'order' ).'">Order: </label><br />
          <select class="widefat" id="'.$this->get_field_id( 'order' ).'" name="'.$this->get_field_name( 'order' ).'">
            <option value="ASC" '.$o1.'>Ascending</option>
            <option value="DESC" '.$o2.'>Descending</option>
            <option value="RAND" '.$o3.'>Random</option>
          </select>
        </p>';
	}

}
/***************************************************/

?>
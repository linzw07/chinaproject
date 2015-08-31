<?php
/*
	ADVERTISEMENT WIDGET
*/
class Wave_Slogan_Widget extends WP_Widget {

	function Wave_Slogan_Widget() {
		$widget_ops = array( 'classname' => 'wave_slogan_widget', 'description' => 'Displays a Slogan' );
		$this->WP_Widget( 'wave_slogan_widget', THEME_SLUG.' - '.'Slogan', $widget_ops );

	}



	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$content=$instance['content'];
		
		//$size = $instance['size'];
		$count = (int)$instance['count'];

		$output =$content; 

		if ( !empty( $output ) ) {
			
		echo $before_widget;
		if ( $title ) echo $before_title . $title . $after_title;
		echo $output;
		echo $after_widget;	
			
	/*	echo '<div id="footer_banner">';
 		echo '<div >';
		if ( $title ) echo $title;
		echo '</div>';
		echo '<div class="footer_tagline">';
		echo $output;
		echo '</div>';
				*/
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['content']= strip_tags( $new_instance['content']);
		return $instance;
	}
	

	function form( $instance ) {
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$content = isset( $instance['content'] ) ? esc_attr( $instance['content'] ) : '';		
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<textarea style="width:98%" rows="6"  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" ><?php echo $title; ?></textarea></p>

		<p><label for="<?php echo $this->get_field_id( 'content' ); ?>">Slogan:</label>
	       <textarea style="width:98%" rows="6" id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" ><?php echo $instance['content']; ?></textarea>
		</p>
<?php
	}
}
?>

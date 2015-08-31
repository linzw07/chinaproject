<?php
/*
	CONTACT FORM WIDGET
*/

class Wave_Contact_Form_Widget extends WP_Widget {

	function Wave_Contact_Form_Widget() {
		$widget_ops = array( 'classname' => 'widget_contact_form', 'description' => 'Displays a email contact form.' );
		$this->WP_Widget( 'contact_form', THEME_SLUG.' - '.'Contact Form', $widget_ops );

		if ( is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'wp_print_scripts', array( &$this, 'add_script' ) );
		}
	}

	function add_script() {
		wp_enqueue_script( 'jquery-tools-validator' );

	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? 'Contact Us' : $instance['title'], $instance, $this->id_base );
		$email= $instance['email'];
		$skin = isset( $instance['skin'] ) ? $instance['skin'] : 'light';
		$success = $instance['success'];

		echo $before_widget;


		if ( $title )
			echo $before_title . $title . $after_title;

?>

		<form class="contact_form <?php echo $skin ?>" action="<?php echo THEME_DIR_URL;?>/sendmail.php" method="post" novalidate="novalidate">
			<div class="section_row"><input type="text" required="required" id="contact_name" name="contact_name" class="text_input" value=""  style="width:60%; margin-right:15px" tabindex="5" />
			<label for="contact_name">Name *</label></div>

			<div class="section_row"><input type="email" required="required" id="contact_email" name="contact_email" class="text_input" value="" style="width:60%; margin-right:15px" tabindex="6"  />
			<label for="contact_email">Email *</label></div>

			<div class="section_row"><textarea required="required" name="contact_content" style="width:90%;" class="textarea" cols="30" rows="5" tabindex="7"></textarea></div>
			<div class="section_row"><button type="submit" style="margin:0;" class="ws-button small contact_button"><span><?php _e( 'Submit', 'theme_frontend' ); ?></span></button>
            <div class="contact_loading" style="display:none"></div>
            </div>
			<input type="hidden" value="<?php echo $email;?>" name="contact_to"/>

		</form>
		 <div class="success_message" style="display:none;"><img src="<?php echo THEME_IMAGES; ?>/success_bubble_top.png" class="success_bubble_top" alt="" /><?php echo $success; ?></div>
<?php



		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['email'] = $new_instance['email'];
		$instance["skin"] = isset( $new_instance["skin"] ) ? $new_instance["skin"] : 'light';
		$instance["success"] = $new_instance["success"];
		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$email = isset( $instance['email'] ) ? $instance['email'] : get_bloginfo( 'admin_email' );
		$skin = isset( $instance['skin'] ) ? $instance['skin'] : 'light';
		$success = isset( $instance["success"] ) ? $instance["success"] : "Your message was successfully sent. <strong>Thank You!</strong>";
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>
		<p><label for="<?php echo $this->get_field_id( 'email' ); ?>">Email:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo $email; ?>" /></p>

        <p><label for="<?php echo $this->get_field_id( 'success' ); ?>">Success Message:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'success' ); ?>" name="<?php echo $this->get_field_name( 'success' ); ?>" type="text" value="<?php echo $success; ?>" /></p>

        		<p><label for="<?php echo $this->get_field_id( 'skin' ); ?>">Choose Fields Skin:</label>
		<select id="<?php echo $this->get_field_id( 'skin' ); ?>" name="<?php echo $this->get_field_name( 'skin' ); ?>">
			<option<?php if ( $skin == 'light' ) echo ' selected="selected"'?> value="light">For Light Backgrounf</option>
			<option<?php if ( $skin == 'dark' ) echo ' selected="selected"'?> value="dark">For Dark Background</option>
		</select></p>


<?php

	}

}


/***************************************************/


/* CONTACT INFORMATION WIDGET */
class Wave_Contact_Info_Widget extends WP_Widget {

	function Wave_Contact_Info_Widget() {
		$widget_ops = array( 'classname' => 'widget_contact_info', 'description' => 'Displays a list of contact info.' );
		$this->WP_Widget( 'contact_info', THEME_SLUG.' - '. 'Contact Info', $widget_ops );

	}

	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$color = $instance['color'];
		$text = $instance['text'];
		$phone = $instance['phone'];
		$cellphone = $instance['cellphone'];
		$email= $instance['email'];
		$address = $instance['address'];
		$name = $instance['name'];


		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
?>
			<div class="contact_info">
			<?php if ( !empty( $text ) ):?><span><strong><?php echo $text;?></strong></span><?php endif;?>
			<?php if ( !empty( $phone ) ):?><span class="icon_list"><i class="icon_list icon-fixed-width icon-phone <?php echo $color;?>"></i><?php echo $phone;?></span><?php endif;?>
			<?php if ( !empty( $cellphone ) ):?><span class="icon_list"><i class="icon_list icon-fixed-width icon-mobile-phone <?php echo $color;?>"></i><?php echo $cellphone;?></span><?php endif;?>
			<?php if ( !empty( $email ) ):?><span class="icon_list"><i class="icon_list icon-fixed-width icon-envelope <?php echo $color;?>"></i><?php echo $email;?></span><?php endif;?>
			<?php if ( !empty( $address ) ):?><span class="icon_list"><i class="icon_list icon-fixed-width icon-home <?php echo $color;?>"></i><?php echo $address;?></span><?php endif;?>
			<?php if ( !empty( $name ) ):?><span class="icon_list"><i class="icon_list icon-fixed-width icon-user <?php echo $color;?>"></i><?php echo $name;?></span><?php endif;?>
			</div>
		<?php
		echo $after_widget;

	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['text'] = strip_tags( $new_instance['text'] );
		$instance['color'] = strip_tags( $new_instance['color'] );
		$instance['phone'] = strip_tags( $new_instance['phone'] );
		$instance['cellphone'] = strip_tags( $new_instance['cellphone'] );
		$instance['email'] = strip_tags( $new_instance['email'] );
		$instance['address'] = strip_tags( $new_instance['address'] );
		$instance['name'] = strip_tags( $new_instance['name'] );


		return $instance;
	}

	function form( $instance ) {
		//Defaults
		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$color = isset( $instance['color'] ) ? esc_attr( $instance['color'] ) : '';
		$text = isset( $instance['text'] ) ? esc_attr( $instance['text'] ) : '';
		$phone = isset( $instance['phone'] ) ? esc_attr( $instance['phone'] ) : '';
		$cellphone = isset( $instance['cellphone'] ) ? esc_attr( $instance['cellphone'] ) : '';
		$email = isset( $instance['email'] ) ? esc_attr( $instance['email'] ) : '';
		$address = isset( $instance['address'] ) ? esc_attr( $instance['address'] ) : '';
		$name = isset( $instance['name'] ) ? esc_attr( $instance['name'] ) : '';
?>


		<p>
			<label for="<?php echo $this->get_field_id( 'color' ); ?>">Icons Color:</label>
			<select name="<?php echo $this->get_field_name( 'color' ); ?>" id="<?php echo $this->get_field_id( 'color' ); ?>" class="widefat">
				<option value="carenian"<?php selected( $color, 'carenian' );?>>Carenian</option>
                <option value="red"<?php selected( $color, 'red' );?>>Red</option>
                <option value="red_orange"<?php selected( $color, 'red_orange' );?>>Red Orange</option>
                <option value="sunglow"<?php selected( $color, 'sunglow' );?>>Sunglow</option>
                <option value="apple_green"<?php selected( $color, 'apple_green' );?>>Apple Green</option>
                <option value="green"<?php selected( $color, 'green' );?>>green</option>
                <option value="caribbean_green"<?php selected( $color, 'caribbean_green' );?>>Caribbean Green</option>
                <option value="cerulean"<?php selected( $color, 'cerulean' );?>>Cerulean</option>
                <option value="cobult"<?php selected( $color, 'cobult' );?>>Cobult</option>
                <option value="blue_purpule"<?php selected( $color, 'blue_purpule' );?>>Blue Purpule</option>
                <option value="deep_pink"<?php selected( $color, 'deep_pink' );?>>Deep Pink</option>
                <option value="almond"<?php selected( $color, 'almond' );?>>Almond</option>
                <option value="air_force_blue"<?php selected( $color, 'air_force_blue' );?>>Air Force Blue</option>
                <option value="dark_brown"<?php selected( $color, 'dark_brown' );?>>Dark Brown</option>
                <option value="brown"<?php selected( $color, 'brown' );?>>Brown</option>
                <option value="dark_gray"<?php selected( $color, 'dark_gray' );?>>Dark Gray</option>
                <option value="light_gray"<?php selected( $color, 'light_gray' );?>>Light Gray</option>

			</select>
		</p>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'text' ); ?>">Introduce text:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'text' ); ?>" name="<?php echo $this->get_field_name( 'text' ); ?>" type="text" value="<?php echo $text; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'phone' ); ?>">Phone:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" type="text" value="<?php echo $phone; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'cellphone' ); ?>">Cell phone:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'cellphone' ); ?>" name="<?php echo $this->get_field_name( 'cellphone' ); ?>" type="text" value="<?php echo $cellphone; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'email' ); ?>">Email:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" type="text" value="<?php echo $email; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'address' ); ?>">Address:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" type="text" value="<?php echo $address; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'name' ); ?>">Name:</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" type="text" value="<?php echo $name; ?>" /></p>

<?php
	}

}
/***************************************************/


?>

<?php

class metaboxesGenerator {
    var $config;
    var $options;
    var $saved_options;
    
    /**
     * Constructor
     * 
     * @param string $name
     * @param array $options
     */
    function metaboxesGenerator($config, $options) {
        $this->config = $config;
        $this->options = $options;
        
        add_action('admin_menu', array(&$this, 'create'));
        add_action('save_post', array(&$this, 'save'));
    }
     
    function create() {
        if (function_exists('add_meta_box')) {
            if (! empty($this->config['callback']) && function_exists($this->config['callback'])) {
                $callback = $this->config['callback'];
            } else {
                $callback = array(&$this, 'render');
            }
            foreach($this->config['pages'] as $page) {
                add_meta_box($this->config['id'], $this->config['title'], $callback, $page, $this->config['context'], $this->config['priority']);
            }
        }
    }
     
    function save($post_id) {
        if (! isset($_POST[$this->config['id'] . '_noncename'])) {
            return $post_id;
        }
        
        if (! wp_verify_nonce($_POST[$this->config['id'] . '_noncename'], plugin_basename(__FILE__))) {
            return $post_id;
        }
        
        if ('page' == $_POST['post_type']) {
            if (! current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } else {
            if (! current_user_can('edit_post', $post_id)) {
                return $post_id;
            }
        }
         
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        add_post_meta($post_id, 'textfalse', false, true);
        
        foreach($this->options as $option) {
            if (isset($option['id']) && ! empty($option['id'])) {
                
                if (isset($_POST[$option['id']])) {
                    if ($option['type'] == 'multidropdown') {
                        $value = array_unique(explode(',', $_POST[$option['id']]));
                    } else {
                        $value = $_POST[$option['id']];
                    }
                } else if ($option['type'] == 'toggle') {
                    $value = - 1;
                } else {
                    $value = false;
                }
                
                if (get_post_meta($post_id, $option['id']) == "") {
                    add_post_meta($post_id, $option['id'], $value, true);
                } elseif ($value != get_post_meta($post_id, $option['id'], true)) {
                    update_post_meta($post_id, $option['id'], $value);
                } elseif ($value == "") {
                    delete_post_meta($post_id, $option['id'], get_post_meta($post_id, $option['id'], true));
                }
            }
        }
    }
    
    function render() {
        global $post;
        echo '<div class="wavesnow-options-page wavesnow-metabox-wrapper ws-resets">';
        foreach($this->options as $option) {
            if (method_exists($this, $option['type'])) {
                if (isset($option['id'])) {
                    $default = get_post_meta($post->ID, $option['id'], true);
                    if ($default != "") {
                        $option['default'] = $default;
                    }
                }
                $this->$option['type']($option);
            }
        }
        echo '<div class="clearboth"></div></div>';
        echo '<input type="hidden" name="' . $this->config['id'] . '_noncename" id="' . $this->config['id'] . '_noncename" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '" />';
    }




    function heading( $value ) {

        echo '<div class="ws-single-option no-divider">';
        echo '<span class="option-title-main">'.$value['name'] .'</span>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '</div>';
    }



    function start_sub( $value ) {

        echo '<ul class="ws-sub-navigator ws-metabox-tabs">';
        foreach ( $value['options'] as $key => $option ) {
            echo '<li class="ws-sub-'.$key.'"><a href="#">'.$option.'</a></li>';
        }
        echo'</ul>';
        echo'<div class="ws-sub-options">';

    }



    function end_sub() {
        echo '</div>';
    }


    function start_sub_option() {
        echo '<div class="ws-sub-option">';
    }


    function end_sub_option() {
        echo '</div>';
    }


/*-------------------------------------------------------------
		Type : Text Box
-------------------------------------------------------------*/

    function text( $value ) {
        $size = isset( $value['size'] ) ? $value['size'] : '40';
        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.'">';
        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="' . (isset($value['default']) ?  $value['default'] : '') . '" />';
		$this->add_common_end($value);
    }



/*-------------------------------------------------------------
		Type : Upload Image
-------------------------------------------------------------*/

    function upload( $value ) {
        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.' upload-option">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

      if(version_compare(get_bloginfo('version'), '3.5.0', '>=')) {
        echo '<input class="ws-upload-url" type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" size="50"  value="'.$value['default'].'" /><a class="option-upload-button thickbox" id="' . $value['id'] . '_button" href="#">'.__( 'Upload', 'backend' ).'</a>';
    } else {
        echo '<input class="ws-upload-url" type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" size="50"  value="'.$value['default'].'" /><a class="option-upload-button thickbox" id="' . $value['id'] . '" href="media-upload.php?&post_id=0&target=' . $value['id'] . '&option_image_upload=1&type=image&TB_iframe=1&width=640&height=644">'.__( 'Upload', 'backend' ).'</a>';
    }

        echo '<span id="'.$value['id'].'-preview" class="show-upload-image"><img src="'.$value['default'].'" title="" /></span>';

       	$this->add_common_end($value);
    }






/*-------------------------------------------------------------
		Type : Toggle Button
-------------------------------------------------------------*/

    function toggle( $value ) {


        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.'">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<span class="ws-toggle-button"><input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/></span>';
		$this->add_common_end($value);

    }


/*-------------------------------------------------------------
		Type : Color Picker
-------------------------------------------------------------*/


    function color( $value ) {

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.'">';
        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" size="8" type="minicolors" class="color-picker" value="'. $value['default'] .'" />';
  		$this->add_common_end($value);
    }

/*-------------------------------------------------------------
		Type : Range Input
-------------------------------------------------------------*/

    function range( $value ) {
        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.' ">';
        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<div class="ws-range-input"><input class="range-input-selector" name="' . $value['id'] . '" id="' . $value['id'] . '" type="range" value="';
            echo $value['default'];
        if ( isset( $value['min'] ) ) {
            echo '" min="' . $value['min'];
        }
        if ( isset( $value['max'] ) ) {
            echo '" max="' . $value['max'];
        }
        if ( isset( $value['step'] ) ) {
            echo '" step="' . $value['step'];
        }
        echo '" />';
        if ( isset( $value['unit'] ) ) {
            echo '<span class="unit">' . $value['unit'] . '</span>';
        }
        echo '</div>';
		$this->add_common_end($value);


    }


/*-------------------------------------------------------------
		Type : Textarea
-------------------------------------------------------------*/

    function textarea( $value ) {
        $rows = isset( $value['rows'] ) ? $value['rows'] : '8';

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.' ">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<textarea id="' . $value['id'] . '" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">' . $value['default'] . '</textarea>';
 		$this->add_common_end($value);
    }




/*-------------------------------------------------------------
		Type : Textbox
-------------------------------------------------------------*/

    function checkbox( $value ) {
            $default = $value['default'];
    

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<div class="ws-select-radio">';


        foreach ( $value['options'] as $key => $option ) {
            echo '<input type="checkbox" value="' . $key . '" id="' . $value['id'] . '-checkbox-' . $key . '" name="' . $value['id'] . '[]"';
            if ( is_array( $value ) && in_array( $key, $value ) ) {
                echo ' checked="checked"';
            }
            echo '><label for="' . $value['id'] . '-checkbox-' . $key . '"><span></span>' . $option . '</label>';
        }
        echo '</div>';

		$this->add_common_end($value);
    }


/*-------------------------------------------------------------
		Type : Radio Button
-------------------------------------------------------------*/

    function radio( $value ) {
            $default = $value['default'];
 

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<div class="ws-select-radio">';


        foreach ( $value['options'] as $key => $option ) {
            echo '<input type="radio" value="' . $key . '" id="' . $value['id'] . '-radio-' . $key . '" name="' . $value['id'] . '[]"';
            if ( is_array( $value ) && in_array( $key, $value ) ) {
                echo ' checked="checked"';
            }
            echo '><label for="' . $value['id'] . '-radio-' . $key . '"><span></span>' . $option . '</label>';
        }
        echo '</div>';
		$this->add_common_end($value);
    }



/*-------------------------------------------------------------
		Type : Select Box
-------------------------------------------------------------*/

     function select( $value ) {

        $width = isset( $value['width'] ) ? $value['width'] : '300';
        $base = isset( $value['base'] ) ? $value['base'] : 'text';

        if ( isset( $value['target'] ) ) {
            if ( isset( $value['options'] ) ) {
                $value['options'] = $value['options'] + $this->get_select_target_options( $value['target'] );
            }
            else {
                $value['options'] = $this->get_select_target_options( $value['target'] );
            }
        }

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }


        echo '<div class="ws-advanced-selectbox '.$base.'-based" id="' . $value['id'] . '" style="width:'.$width.'px">';
        echo '<div class="ws-selector-heading">';
        if ( $base == 'color' ) {
            echo '<span class="selected_color"></span>';
        }
        if ( $base == 'color' ) {
            echo '<span class="selected_item"></span><span class="ws-selector-arrow"></span></div>';
        } else {
            $width = $width - 50;
            echo '<span class="selected_item" style="width:'.$width.'px"></span><span class="ws-selector-arrow"></span></div>';
        }
        echo '<div class="ws-select-options">';


        if ( $base == 'text' ) {
             echo '<span value="" class="ws-select-option">'.__('Select Option...', 'theme_frontend').'</span>';
            foreach ( $value['options'] as $key => $option ) {
                echo '<span value="' . $key . '" class="ws-select-option ';
                if ( isset( $this->saved_options[$value['id']] ) ) {
                    if ( stripslashes( $this->saved_options[$value['id']] ) == $key ) {
                        echo ' selected';
                    }
                }
                else if ( $key == $value['default'] ) {
                        echo ' selected';
                    }
                echo ' ">' . $option . '</span>';
            }
        } else {
            foreach ( $value['options'] as $key => $option ) {
                echo '<span value="' . str_replace( " ", "_", strtolower( $option ) ) . '" data-color="' . $key . '" class="ws-select-option';

                if ( isset( $this->saved_options[$value['id']] ) ) {
                    if ( stripslashes( $this->saved_options[$value['id']] ) == str_replace( " ", "_", strtolower( $option ) ) ) {
                        echo ' selected';
                    }
                }
                else if ( str_replace( " ", "_", strtolower( $option ) ) == $value['default'] ) {
                        echo ' selected';
                    }
                echo '"><span style="background-color:'.$key.'" class="ws-option-color"></span><b>' . $option . '</b></span>';
            }

        }

        echo '<input type="hidden" value="' .  $default . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
        echo '</div>';

        echo '</div>';
		$this->add_common_end($value);

    }




/*-------------------------------------------------------------
		Type : Multi Select
-------------------------------------------------------------*/

    function multiselect( $value ) {
        if ( isset( $value['target'] ) ) {
            if ( isset( $value['options'] ) ) {
                $value['options'] = $value['options'] + $this->get_select_target_options( $value['target'] );
            }
            else {
                $value['options'] = $this->get_select_target_options( $value['target'] );
            }
        }
        $width = isset( $value['width'] ) ? $value['width'] : '500';
        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<select class="ws-chosen" name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" style="width:'.$width.'px;">';

        if ( !empty( $value['options'] ) && is_array( $value['options'] ) ) {
            foreach ( $value['options'] as $key => $option ) {
                echo '<option value="' . $key . '"';
              if (in_array($key, $value['default'])) {
                echo ' selected="selected"';
            }
                echo '>' . $option . '</option>';
            }
        }
        echo '</select>';

  		$this->add_common_end($value);
    }




/*-------------------------------------------------------------
		Type : Page Layout
-------------------------------------------------------------*/

    function visual_selector( $value ) {

        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        $item_padding = isset( $value['item_padding'] ) ? $value['item_padding'] : '20px 30px 0 0';
        echo '<div class="ws-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }


        echo '<div id="' . $value['id'] . '_container" class="ws-visual-selector">';
        foreach ( $value['options'] as $key => $option ) {
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.$key.'"><img  src="' . THEME_ADMIN_ASSETS_URI . '/images/selector/'.$option.'.png" /></a>';
        }
        echo '<input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
        echo '</div>';

		$this->add_common_end($value);
    }



/*-------------------------------------------------------------
		Type : Wrodpress Built-in Editor
-------------------------------------------------------------*/

    function editor( $value ) {
        $rows = isset( $value['rows'] ) ? $value['rows'] : '7';
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $value['default'] = stripslashes( $this->saved_options[$value['id']] );
        }
        if ( isset( $value['name'] ) ) {
            echo '<h3 style="margin-top:40px">' . $value['name'] . '</h3>';
        }

        wp_editor( $value['default'], $value['id'] );
  		$this->add_common_end($value);
    }


/*-------------------------------------------------------------
		Type : Random Height generator for posts used in newspaper style
-------------------------------------------------------------*/
  
function random_height($value) {
        echo '<input type="hidden" value="' . $value ['fixed_data']. '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
}


/*-------------------------------------------------------------
		Type : Super Links
-------------------------------------------------------------*/
 
function superlink($value) {
        $target = '';
        if (! empty($value['default'])) {
            list($target, $target_value) = explode('||', $value['default']);
        }
      
           $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        echo '<div class="ws-single-option '.$no_divider.'">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        
        echo '<input type="hidden" id="' . $value['id'] . '" name="' . $value['id'] . '" value="' . $value['default'] . '"/>';
        
        $method_options = array(
            'page' => 'Link to page', 
            'cat' => 'Link to category', 
            'post' => 'Link to post', 
            'portfolio'=> 'Link to portfolio', 
            'manually' => 'Link manually'
        );
        echo '<select name="' . $value['id'] . '_selector" id="' . $value['id'] . '_selector">';
        echo '<option value="">' . __('Select Linking method','theme_frontend') . '</option>';
        foreach($method_options as $key => $option) {
            echo '<option value="' . $key . '"';
            if ($key == $target) {
                echo ' selected="selected"';
            }
            echo '>' . $option . '</option>';
        }
        echo '</select>';
        
        echo '<div style="margin-top:15px;" class="superlink-wrap">';
        
        //render page selector
        $hidden = ($target != "page") ? 'class="hidden"' : '';
        echo '<select name="' . $value['id'] . '_page" id="' . $value['id'] . '_page" ' . $hidden . '>';
        echo '<option value="">' . __('Select Page','theme_frontend') . '</option>';
        foreach($this->get_select_target_options('page') as $key => $option) {
            echo '<option value="' . $key . '"';
            if ($target == "page" && $key == $target_value) {
                echo ' selected="selected"';
            }
            echo '>' . $option . '</option>';
        }
        echo '</select>';
        
        //render portfolio selector
        $hidden = ($target != "portfolio") ? 'class="hidden"' : '';
        echo '<select name="' . $value['id'] . '_page" id="' . $value['id'] . '_portfolio" ' . $hidden . '>';
        echo '<option value="">' . __('Select Portfolio','theme_frontend') . '</option>';
        foreach($this->get_select_target_options('portfolio') as $key => $option) {
            echo '<option value="' . $key . '"';
            if ($target == "portfolio" && $key == $target_value) {
                echo ' selected="selected"';
            }
            echo '>' . $option . '</option>';
        }
        echo '</select>';

        //render category selector
        $hidden = ($target != "cat") ? 'class="hidden"' : '';
        echo '<select name="' . $value['id'] . '_cat" id="' . $value['id'] . '_cat" ' . $hidden . '>';
        echo '<option value="">' . __('Select Category','theme_frontend') . '</option>';
        foreach($this->get_select_target_options('cat') as $key => $option) {
            echo '<option value="' . $key . '"';
            if ($target == "cat" && $key == $target_value) {
                echo ' selected="selected"';
            }
            echo '>' . $option . '</option>';
        }
        echo '</select>';
        
        //render post selector
        $hidden = ($target != "post") ? 'class="hidden"' : '';
        echo '<select name="' . $value['id'] . '_post" id="' . $value['id'] . '_post" ' . $hidden . '>';
        echo '<option value="">' . __('Select Post','theme_frontend') . '</option>';
        foreach($this->get_select_target_options('post') as $key => $option) {
            echo '<option value="' . $key . '"';
            if ($target == "post" && $key == $target_value) {
                echo ' selected="selected"';
            }
            echo '>' . $option . '</option>';
        }
        echo '</select>';
        
        //render manually
        $hidden = ($target != "manually") ? 'class="hidden"' : '';
        echo '<input name="' . $value['id'] . '_manually" id="' . $value['id'] . '_manually" type="text" value="';
        if ($target == 'manually') {
            echo $target_value;
        }
        echo '" size="35" ' . $hidden . '/>';
        echo '</div>';
		$this->add_common_end($value);
    }


/*-------------------------------------------------------------
		Type : Slider Texture 
-------------------------------------------------------------*/

function slider_texture($value) {
            
     
         $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        $item_padding = isset( $value['item_padding'] ) ? $value['item_padding'] : '20px 30px 0 0';
        echo '<div class="ws-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$value['option_structure'].'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<div id="' . $value['id'] . '_container" class="ws-visual-selector slideshow-textures">';

            echo '<a style="margin:'.$item_padding.'" class="" rel="none"><img alt="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/empty-thumb.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" class="" rel="gradient.png"><img alt="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/gradient.jpg" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/3.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/t3.jpg" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/7.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/t7.jpg" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/10.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/t10.jpg" /></a>';
			echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/textures/18.jpg"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/textures/t18.jpg" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/1.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p1.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/2.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p2.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/3.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p3.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/4.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p4.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/5.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p5.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/6.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p6.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/7.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p7.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/8.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p8.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/9.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p9.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/10.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p10.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/11.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p11.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/12.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p12.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/13.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p13.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/14.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p14.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/15.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p15.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/16.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p16.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/17.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p17.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/18.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p18.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/19.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p19.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/20.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p20.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/21.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p21.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/22.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p22.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/23.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p23.png" /></a>';
			echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/24.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p24.png" /></a>';
		    echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/25.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p25.png" /></a>';
 			echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/26.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p26.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/27.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p27.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/28.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p28.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/29.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p29.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/30.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p30.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/31.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p31.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/32.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p32.png" /></a>';
            echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/33.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p33.png" /></a>';
			echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/34.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p34.png" /></a>';
		    echo '<a style="margin:'.$item_padding.'" href="#" rel="'.THEME_IMAGES.'/patterns/35.png"><img alt="" title="" src="'.THEME_ADMIN_ASSETS_URI.'/images/patterns/p35.png" /></a>';
            
       echo '<input type="hidden" value="' . $value['default'] . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
        echo '</div>';
		$this->add_common_end($value);
    }


	
/*-------------------------------------------------------------
		Other functions
-------------------------------------------------------------*/

/*Extract Array data from sources*/
    function get_select_target_options( $type ) {
        $options = array();
        switch ( $type ) {
        case 'page':
            $entries = get_pages( 'title_li=&orderby=name' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->ID] = $entry->post_title;
            }
            break;
        case 'cat':
            $entries = get_categories( 'orderby=name&hide_empty=0' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->term_id] = $entry->name;
            }
            break; 
        case 'author':
            global $wpdb;
            $order = 'user_id';
            $user_ids = $wpdb->get_col( $wpdb->prepare( "SELECT $wpdb->usermeta.user_id FROM $wpdb->usermeta where meta_key='wp_user_level' and meta_value>=1 ORDER BY %s ASC", $order ) );
            foreach ( $user_ids as $user_id ) :
                $user = get_userdata( $user_id );
            $options[$user_id] = $user->display_name;
            endforeach;
            break;
        case 'post':
            $entries = get_posts( 'orderby=title&numberposts=-1&order=ASC' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->ID] = $entry->post_title;
            }
            break;
        case 'portfolio':
            $entries = get_posts( 'post_type=portfolio&orderby=title&numberposts=-1&order=ASC' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->ID] = $entry->post_title;
            }
            break;
        case 'slideshow':
            $entries = get_posts( 'post_type=slideshow&orderby=title&numberposts=-1&order=ASC' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->ID] = $entry->post_title;
            }
            break;
        case 'portfolio_category':
            $entries = get_terms( 'portfolio_category', 'orderby=name&hide_empty=0' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->slug] = $entry->name;
            }
            break;
        case 'portfolio_category_id':
            $entries = get_terms( 'portfolio_category', 'orderby=name&hide_empty=0' );
            foreach ( $entries as $key => $entry ) {
                $options[$entry->term_id] = $entry->name;
            }

        }
        return $options;
    }


      function add_help_link( $value ) {
     	if ( isset( $value['help_link'] ) ) {
            echo '<div class="option-help-link"><a target="_blank" href="'.$value['help_link'].'">'.__( 'More Help', 'backend' ).'</a></div>';
        }

      }
	  
	  
	  function add_divider( $value ) {
     	if ( isset( $value['divider'] ) && $value['divider'] == true ) {
            echo '<div class="option-divider"></div>';
        }
      }
	  
	 function add_common_end( $value ){
	    $this->add_help_link( $value );
        echo '</div>';
		$this->add_divider($value);
	  }
}

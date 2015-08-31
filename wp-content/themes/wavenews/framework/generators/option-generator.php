<?php
class optionGenerator {
    var $name;
    var $options;
    var $saved_options;
    function optionGenerator( $name, $options ) {
        $this->__construct( $name, $options );
    }
    function __construct( $name, $options ) {
        $this->name = $name;
        $this->options = $options;
        $this->render();
    }



    function render() {
        $theme_data = wp_get_theme();
        $this->saved_options = get_option( THEME_OPTIONS );
?>

        <div class="wavesnow-options-page ws-resets">
        <form action="" type="post" name="wavesnow_settings" id="wavesnow_settings">

        <div id="ws-are-u-sure" class="ws-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/wavesnow/alert-icon.png" alt="" class="ws-loading-gif" />
        <span style="padding-bottom:20px;" class="ws-message-text"><?php _e( 'Are you sure you want to reset to default? Please Note all wavesnow settings will be restored to defaults.', 'backend' ); ?></span>
        <a href="#" class="ws-button dominant-color ws-secondary ws_reset_ok" id="ws_reset_ok">OK</a>
        <a href="#" class="ws-button highlight-color ws-secondary ws_reset_cancel" id="ws_reset_cancel">Cancel</a>
        </div>


        <div id="ws-saving-settings" class="ws-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/loading.gif" alt="" class="ws-loading-gif" />
        <span class="ws-message-text"><?php _e( 'Saving changes...', 'backend' ); ?></span>
        </div>

        <div id="ws-success-save" class="ws-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/wavesnow/success-icon.png" alt="" class="ws-loading-gif" />
        <span class="ws-message-text"><?php _e( 'The changes were saved successfully', 'backend' ); ?></span>
        </div>

        <div id="ws-success-reset" class="ws-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/wavesnow/success-icon.png" alt="" class="ws-loading-gif" />
        <span class="ws-message-text"><?php _e( 'All options restored to defaults', 'backend' ); ?></span>
        </div>

        <div id="ws-success-import" class="ws-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/wavesnow/success-icon.png" alt="" class="ws-loading-gif" />
        <span class="ws-message-text"><?php _e( 'All options have been imported successfully', 'backend' ); ?></span>
        </div>


        <div id="ws-already-saved" class="ws-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/wavesnow/alert-icon.png" alt="" class="ws-loading-gif" />
        <span class="ws-message-text"><?php _e( 'You have already saved the changes', 'backend' ); ?></span>
        </div>

        <div id="ws-fail-import" class="ws-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/wavesnow/alert-icon.png" alt="" class="ws-loading-gif" />
        <span class="ws-message-text"><?php _e( 'Nothing has been imported...', 'backend' ); ?></span>
        </div>


        <div id="ws-not-saved" class="ws-message-box">
        <img src="<?php echo THEME_ADMIN_ASSETS_URI; ?>/images/wavesnow/alert-icon.png" alt="" class="ws-loading-gif" />
        <span class="ws-message-text"><?php _e( 'The changes could not be saved', 'backend' ); ?></span>
        </div>



<!-- Wavesnow Settings Header -->
        <div id="wavesnow-header">
            <a href="#" alt="" title="" class="ws-logo"></a>
            <span class="ws-theme-version">v <?php echo $theme_data['Version']; ?></span>
            <div class="clearboth"></div>
        </div>




<div class="wavesnow-options-container">

<?php
        foreach ( $this->options as $option ) {
            if ( method_exists( $this, $option['type'] ) ) {
                $this->$option['type']( $option );
            }
        }
?>
<div class="wavesnow-footer-buttons">
<a type="submit" id="ws_reset_confirm" href="#" class="ws-button highlight-color"><span><?php _e( 'Restore Defaults', 'backend' ); ?></span></a>
<button type="submit" id="reset_theme_options" name="reset_theme_options" class="visuallyhidden">/button>
<button type="submit" id="save_theme_options" name="save_theme_options" class="ws-button dominant-color"><span><?php _e( 'Save Settings', 'backend' ); ?></span></button>
</div>
<input type="hidden" name="action" value="theme_data_save" />
<input type="hidden" name="security" value="<?php echo wp_create_nonce( 'theme-data' ); ?>" />
<input type="hidden" name="option_storage" value="<?php echo THEME_OPTIONS; ?>" />
<div class="clearboth"></div>
</div>
</form>
</div>

<?php
}


    function start( $value ) {
        echo '<ul class="ws-main-navigator">';
        foreach ( $value['options'] as $key => $option ) {
            echo '<li class="ws-main-'.$key.'"><a href="#"><span class="gray-scale"><span class="active"></span></span>'.$option.'</a></li>';
        }
        echo '</ul>';
        echo '<div class="ws-main-options">';
    }


    function heading( $value ) {
        echo '<div class="ws-single-option no-divider">';
        echo '<span class="option-title-main">'.$value['name'] .'</span>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '</div>';
    }


    function end() {
        echo '</div>';
    }


    function start_main_option() {
        echo '<div class="ws-main-option">';
    }


    function end_main_option() {
        echo '</div>';
    }


    function start_sub( $value ) {
        echo '<ul class="ws-sub-navigator">';
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
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="ws-single-option-wrapper">';
        echo '<div class="ws-single-option '.$no_divider.'">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" type="text" size="' . $size . '" value="';
        if ( isset( $this->saved_options[$value['id']] ) ) {
            echo stripslashes( $this->saved_options[$value['id']] );
        }
        else {
            echo $value['default'];
        }
        echo '" />';
		$this->add_common_end($value);

    }

/*-------------------------------------------------------------
		Type : Color Picker
-------------------------------------------------------------*/

    function color( $value ) {
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="ws-single-option-wrapper">';
        echo '<div class="ws-single-option '.$no_divider.'">';
        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<input name="' . $value['id'] . '" id="' . $value['id'] . '" size="8" data-opacity="1" type="minicolors" class="color-picker" value="';
        if ( isset( $this->saved_options[$value['id']] ) ) {
            echo stripslashes( $this->saved_options[$value['id']] );
        }
        else {
            echo $value['default'];
        }
        echo '" /><div class="rgba-value-console"></div>';
		$this->add_common_end($value);
    }



/*-------------------------------------------------------------
		Type : Upload Image
-------------------------------------------------------------*/
    function upload( $value ) {

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="ws-single-option-wrapper">';
        echo '<div class="ws-single-option '.$no_divider.' upload-option">';
        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        if(version_compare(get_bloginfo('version'), '3.5.0', '>=')) {
        echo '<input class="ws-upload-url" type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" size="50"  value="';
        echo $default;
        echo '" /><a class="option-upload-button thickbox" id="' . $value['id'] . '_button" href="#">'.__( 'Upload', 'backend' ).'</a>';
    } else {
        echo '<input class="ws-upload-url" type="text" id="' . $value['id'] . '" name="' . $value['id'] . '" size="50"  value="';
        echo $default;
        echo '" /><a class="option-upload-button thickbox" id="' . $value['id'] . '" href="media-upload.php?&post_id=0&target=' . $value['id'] . '&option_image_upload=1&type=image&TB_iframe=1&width=640&height=644">'.__( 'Upload', 'backend' ).'</a>';
    }
        echo '<span id="'.$value['id'].'-preview" class="show-upload-image" alt="'.$value['name'] .'"><img src="'.$default.'" title="" /></span>';
		$this->add_common_end($value);
    }




/*-------------------------------------------------------------
		Type : Toggle Button
-------------------------------------------------------------*/
    function toggle( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="ws-single-option-wrapper">';
        echo '<div class="ws-single-option '.$no_divider.'">';
        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<span class="ws-toggle-button"><input type="hidden" value="' . $default . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/></span>';
		$this->add_common_end($value);
    }




/*-------------------------------------------------------------
		Type : Range Input
-------------------------------------------------------------*/
    function range( $value ) {
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="ws-single-option-wrapper">';
        echo '<div class="ws-single-option '.$no_divider.' ws-range-option">';
        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<div class="ws-range-input"><input class="range-input-selector" name="' . $value['id'] . '" id="' . $value['id'] . '" type="range" value="';
        if ( isset( $this->saved_options[$value['id']] ) ) {
            echo stripslashes( $this->saved_options[$value['id']] );
        }
        else {
            echo $value['default'];
        }
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
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="ws-single-option-wrapper">';
        echo '<div class="ws-single-option '.$no_divider.' ">';
        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<textarea id="' . $value['id'] . '" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">';
        if ( isset( $this->saved_options[$value['id']] ) ) {
            echo stripslashes( $this->saved_options[$value['id']] );
        }
        else {
            if ( isset( $value['default'] ) ) {
                echo $value['default'];
            }
        }
        echo '</textarea>';
       $this->add_common_end($value);
    }


/*-------------------------------------------------------------
		Type : Checkbox
-------------------------------------------------------------*/
    function checkbox( $value ) {
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="ws-single-option-wrapper">';
        echo '<div class="ws-single-option '.$no_divider.' ">';
        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<div class="ws-select-radio">';
        $i = 0;
        foreach ( $value['options'] as $key => $option ) {
            $i++;
            $checked = '';
            if ( isset( $this->saved_options[$value['id']] ) ) {
                if ( is_array( $this->saved_options[$value['id']] ) ) {
                    if ( in_array( $key, $this->saved_options[$value['id']] ) ) {
                        $checked = ' checked="checked"';
                    }
                }
            } else if ( in_array( $key, $value['default'] ) ) {
                    $checked = ' checked="checked"';
                }
            echo '<input type="checkbox" value="' . $key . '" id="' . $value['id'] . '-checkbox-' . $key . '" name="' . $value['id'] . '[]" ' . $checked . ' /><label for="' . $value['id'] . '-checkbox-' . $key . '"><span></span>' . $option . '</label>';
        }
        echo '</div>';
		$this->add_common_end($value);
    }

/*-------------------------------------------------------------
		Type : Radio Button
-------------------------------------------------------------*/
    function radio( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $checked_key = $this->saved_options[$value['id']];
        } else {
            $checked_key = $value['default'];
        }
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div id="' . $value['id'] . '_wrapper" class="ws-single-option-wrapper">';
        echo '<div class="ws-single-option '.$no_divider.' ">';
        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<div class="ws-select-radio">';
        $i = 0;
        foreach ( $value['options'] as $key => $option ) {
            $i++;
            $checked = '';
            if ( $key == $checked_key ) {
                $checked = ' checked="checked"';
            }
            echo '<input type="radio" value="' . $key . '" ' . $checked . ' id="' . $value['id'] . '-radio-' . $key . '" name="' . $value['id'] . '"/><label for="' . $value['id'] . '-radio-' . $key . '"><span></span>' . $option . '</label>';
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
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
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
        echo '<div id="' . $value['id'] . '_wrapper" class="ws-single-option-wrapper">';
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
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        echo '<div id="' . $value['id'] . '_wrapper" class="ws-single-option-wrapper">';
        echo '<div class="ws-single-option '.$no_divider.' ">';

        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }

        echo '<select class="ws-chosen" name="' . $value['id'] . '[]" id="' . $value['id'] . '" multiple="multiple" style="width:'.$width.'px;">';

        if ( !empty( $value['options'] ) && is_array( $value['options'] ) ) {
            foreach ( $value['options'] as $key => $option ) {
                echo '<option value="' . $key . '"';
                if ( isset( $this->saved_options[$value['id']] ) ) {
                    if ( is_array( $this->saved_options[$value['id']] ) ) {
                        if ( in_array( $key, $this->saved_options[$value['id']] ) ) {
                            echo ' selected="selected"';
                        }
                    }
                }
                else if ( in_array( $key, $value['default'] ) ) {
                        echo ' selected="selected"';
                    }
                echo '>' . $option . '</option>';
            }
        }
        echo '</select>';
		$this->add_common_end($value);
    }





/*-------------------------------------------------------------
		Type : Visual Selector
-------------------------------------------------------------*/

    function visual_selector( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
		$paths = isset( $value['option_path'] ) ? $value['option_path'] : false;
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $item_padding = isset( $value['item_padding'] ) ? $value['item_padding'] : '20px 30px 0 0';
        echo '<div id="' . $value['id'] . '_wrapper" class="ws-single-option-wrapper">';
        echo '<div class="ws-single-option '.$no_divider.' '.$value['id'].'">';
        echo '<label><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<div class="ws-visual-selector">';
        foreach ( $value['options'] as $key => $option ) {
			if($paths){
				echo '<a style="margin:'.$item_padding.'" href="#" rel="'.$key.'"><img  src="' . THEME_IMAGES . '/selector/'.$option.'.png" /></a>';
			}
			else{
            	echo '<a style="margin:'.$item_padding.'" href="#" rel="'.$key.'"><img  src="' . THEME_ADMIN_ASSETS_URI . '/images/selector/'.$option.'.png" /></a>';
			}
        }
        echo '<input type="hidden" value="' .  $default . '" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
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
		Type : Custom Sidebar
-------------------------------------------------------------*/
    function custom_sidebar( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }
        $no_divider = $value['divider'] ? 'with-divider' : 'no-divider';
        if ( !empty( $default ) ) {
            $sidebars = explode( ',', $default );
        }
        else {
            $sidebars = array();
        }
        echo '<div class="ws-single-option '.$no_divider.' ">';
        echo '<label for="add_sidebar"><span class="option-title-main">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<div class="custom-sidebar-wrapper">';
        echo '<input type="text" id="add_sidebar" name="add_sidebar" size="50" /><a href="#" class="ws-button highlight-color ws-secondary" id="add_sidebar_item">'.__( 'Create', 'backend' ).'</a>';
        echo '</div>';
        echo '<span class="option-title-sub" style="margin-bottom:20px;">'.__( 'Current sidebars', 'backend' ) .'</span>';
        echo '<div id="selected-sidebar" class="selected-sidebar">';
        echo '<div id="sidebar-item" class="default-sidebar-item"><div class="slider-item-text"></div><a href="#" class="delete-sidebar"></a><input type="hidden" class="sidebar-item-value" /></div>';
        if ( !empty( $sidebars ) ) {
            foreach ( $sidebars as $sidebar ) {
                echo '<div id="sidebar-item" class="sidebar-item"><div class="slider-item-text">' . $sidebar . '</div><a href="#" class="delete-sidebar"></a><input type="hidden" class="sidebar-item-value" value="' . $sidebar . '"/></div>';
            }
        }
		
		echo '<input type="hidden" value="' . $default . '" name="' . $value['id'] . '" id="sidebars"/>';
        
		$this->add_common_end($value);
	
    }


/*-------------------------------------------------------------
		Type : Import
-------------------------------------------------------------*/
    function import( $value ) {
        $rows = isset( $value['rows'] ) ? $value['rows'] : '8';

        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div class="ws-single-option '.$no_divider.' ">';
        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<textarea id="' . $value['id'] . '" rows="' . $rows . '" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">';
        echo $value['default'];
        echo '</textarea>';
        echo '<button style="float:right; margin-bottom:20px;" type="submit" id="import_theme_options" name="import_theme_options" class="ws-button dominant-color"><span>'. __( 'Import', 'backend' ).'</span></button>';
        echo '<div class="clearboth"></div>';
		$this->add_help_link($value);
        echo '</div>';
   		$this->add_divider($value);

    }


/*-------------------------------------------------------------
		Type : Export
-------------------------------------------------------------*/


    function export( $value ) {
        $rows = isset( $value['rows'] ) ? $value['rows'] : '8';
        $option_structure = isset( $value['option_structure'] ) ? $value['option_structure'] : 'sub';
        $no_divider = isset( $value['divider'] ) ? 'with-divider' : 'no-divider';
        $value['divider'] = isset( $value['divider'] ) ? $value['divider'] : true;
        echo '<div class="ws-single-option '.$no_divider.' ">';

        echo '<label for="'.$value['id'].'"><span class="option-title-'.$option_structure.'">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
        echo '<textarea id="' . $value['id'] . '" rows="' . $rows . '" onclick="this.focus();this.select()" readonly="readonly" name="' . $value['id'] . '" type="' . $value['type'] . '" class="code">';
        echo base64_encode( serialize( get_option( THEME_OPTIONS ) ) );
        echo '</textarea>';

		$this->add_help_link($value);
        echo '</div>';
   		$this->add_divider($value);

    }




/*-------------------------------------------------------------
		Type : General Background Selector
-------------------------------------------------------------*/

    function general_background_selector( $value ) {

        $item_padding = isset( $value['item_padding'] ) ? $value['item_padding'] : '20px 30px 0 0';
        echo '<div class="ws-single-option ">';
        echo '<label><span class="option-title-main">'.$value['name'] .'</span></label>';
        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
?>

<div class="ws-general-bg-selector">
<div class="outer-wrapper">
  <div rel="body" class="body-section"> <span class="hover-state-body"><span class="section-indicator">
    <?php _e( 'Body', 'backend' ) ?>
    </span></span> </div>
  <div class="main-sections-wrapper">
    <div rel="header" class="header-section"><span class="hover-state"><span class="section-indicator">
      <?php _e( 'Header', 'backend' ) ?>
      </span></span></div>
    <div rel="page" class="page-section"><span class="hover-state"><span class="section-indicator">
      <?php _e( 'Page', 'backend' ) ?>
      </span></span></div>
    <div rel="footer" class="footer-section"><span class="hover-state"><span class="section-indicator">
      <?php _e( 'Footer', 'backend' ) ?>
      </span></span></div>
  </div>
</div>
<div id="ws-bg-edit-panel" class="ws-bg-edit-panel">
  <div class="ws-bg-panel-heading"> <span class="ws-bg-edit-panel-heading-text">Edit - <span class="ws-edit-panel-heading"></span></span> </div>
  <div>
    <div class="ws-bg-edit-left">
      <div class="ws-bg-edit-option"> <span class="ws-bg-edit-label">
        <?php  _e( 'Background Image', 'backend' )  ?>
        </span>
        <ul class="bg-background-type-tabs">
          <li><a rel="no-image" href="#" class="ws-bg-edit-option-no-image-button ws-button highlight-color bg-image-buttons">
            <?php  _e( 'No Image', 'backend' )  ?>
            </a></li>
          <li><a rel="preset" href="#" class="ws-bg-edit-option-preset-button ws-button highlight-color bg-image-buttons">
            <?php  _e( 'Presets', 'backend' )  ?>
            </a></li>
          <li><a rel="custom" href="#" class="ws-bg-edit-option-upload-button ws-button highlight-color bg-image-buttons">
            <?php  _e( 'Custom', 'backend' )  ?>
            </a></li>
        </ul>
        <div class="clearboth"></div>

      <div class="bg-background-type-panes">
        <div class="bg-background-type-pane bg-no-image"> </div>
        <div class="bg-background-type-pane bg-image-preset">
          <div class="bg-image-preset-wrapper">
            <ul class="bg-image-preset-tabs">
              <li><a href="#" class="">Patterns</a></li>
              <li><a href="#" class="">Textures</a></li>
            </ul>
            <div class="bg-image-preset-panes">
              <div class="bg-image-preset-pane">
                <ul class="bg-image-preset-thumbs">
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/1.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p1.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/2.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p2.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/3.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p3.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/4.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p4.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/5.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p5.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/6.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p6.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/7.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p7.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/8.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p8.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/9.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p9.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/10.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p10.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/11.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p11.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/12.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p12.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/13.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p13.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/14.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p14.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/15.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p15.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/16.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p16.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/17.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p17.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/18.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p18.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/19.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p19.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/20.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p20.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/21.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p21.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/22.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p22.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/23.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p23.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/24.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p24.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/25.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p25.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/26.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p26.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/27.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p27.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/28.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p28.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/29.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p29.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/30.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p30.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/31.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p31.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/32.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p32.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/33.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p33.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/34.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p34.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/35.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p35.png" /></a></li>
                </ul>
              </div>
              <div class="bg-image-preset-pane">
                <ul class="bg-image-preset-thumbs">
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/3.jpg"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/t3.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/7.jpg"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/t7.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/10.jpg"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/t10.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/18.jpg"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/t18.jpg" /></a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-background-type-pane bg-edit-panel-upload" style="padding-top:60px;">
          <div class="upload-option">
            <div id="bg_panel_upload-preview" class="custom-image-preview-block show-upload-image"><img src="" title="" /></div>
            <span class="bg-edit-panel-upload-title">
            <?php  _e( 'Upload a new custom image', 'backend' )  ?>
            </span>


         <?php if(version_compare(get_bloginfo('version'), '3.5.0', '>=')) {
        echo '<input class="ws-upload-url" type="text" id="bg_panel_upload" name="bg_panel_upload" size="40"  value="" /><a class="option-upload-button thickbox" id="bg_panel_upload_button" href="#">'.__( 'Upload', 'backend' ).'</a>';
         } else {
        echo '<input class="ws-upload-url" type="text" id="bg_panel_upload" name="bg_panel_upload" size="40"  value="" /><a class="option-upload-button thickbox" id="bg_panel_upload_button" href="media-upload.php?&post_id=0&target=bg_panel_upload&option_image_upload=1&type=image&TB_iframe=1&width=640&height=644">'.__( 'Upload', 'backend' ).'</a>';
    }
    ?>
</div>
        </div>
      </div>
      <div class="clearboth"></div>
    </div>
</div>
    <div class="ws-bg-edit-right">
      <div class="ws-bg-edit-option ws-bg-edit-bg-color"> <span class="ws-bg-edit-label">
        <?php  _e( 'Background color', 'backend' ) ?>
        </span>
        <div class="bg-edit-panel-color">
          <input name="bg_panel_color" id="bg_panel_color" size="8" type="minicolors" class="color-picker" value="" />
        </div>
        <div class="clearboth"></div>
      </div>
      <div class="ws-bg-edit-option ws-bg-edit-option-repeat"> <span class="ws-bg-edit-label">
        <?php  _e( 'Background Repeat', 'backend' )  ?>
        </span>
        <div class="bg-repeat-option"><a style="border:none" class="no-repeat" href="#" rel="no-repeat" title="no-repeat"></a><a href="#" rel="repeat" class="repeat" title="repeat"></a><a href="#" rel="repeat-x" class="repeat-x" title="repeat-x"></a><a href="#" rel="repeat-y" class="repeat-y" title="repeat-y"></a></div>
        <div class="clearboth"></div>
      </div>
      <div class="ws-bg-edit-option ws-bg-edit-option-attachment"> <span class="ws-bg-edit-label">
        <?php  _e( 'Background Attachment', 'backend' )  ?>
        </span>
        <div class="bg-attachment-option"> <a style="border:none" href="#" rel="fixed" class="fixed" title="fixed"></a><a href="#" rel="scroll" class="scroll" title="scroll"></a></div>
        <div class="clearboth"></div>
      </div>
      <div class="ws-bg-edit-option ws-bg-edit-option-position"> <span class="ws-bg-edit-label"><?php  _e( 'Background Position', 'backend' )  ?></span>
        <div class="bg-position-option">
            <a style="border-left:none" href="#" rel="left top" class="left-top" title="left top"></a><a href="#" rel="center top" class="center-top" title="center top"></a><a href="#" rel="right top" class="right-top" title="right top"></a>
          <div class="clearboth"></div>
          <a style="border-left:none" href="#" rel="left center" class="left-center" title="left center"></a><a href="#" rel="center center" class="center-center" title="center center"></a><a href="#" rel="right center" class="right-center" title="right center"></a>
          <div class="clearboth"></div>
          <a style="border-left:none; border-bottom:none;" href="#" rel="left bottom" class="left-bottom" title="left bottom"></a><a style="border-bottom:none;" href="#" rel="center bottom" class="center-bottom" title="center bottom"></a><a style="border-bottom:none;" href="#" rel="right bottom" class="right-bottom" title="right bottom"></a>
      </div>
        <div class="clearboth"></div>
      </div>
      <div class="clearboth"></div>
    </div>
    <div class="clearboth"></div>
  </div>
  <div class="ws-bg-edit-buttons"> <a id="ws_cancel_bg_selector" href="#" class="ws-button highlight-color"><span>
    <?php _e( 'Cancel', 'backend' ) ?>
    </span></a> <a id="ws_apply_bg_selector" href="#" class="ws-button dominant-color"><span>
    <?php _e( 'Apply', 'backend' ) ?>
    </span></a> </div>
</div>


<?php
        echo'</div>';
		$this->add_help_link($value);
        echo '</div>';
    }


    function hidden_input( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $default = $this->saved_options[$value['id']];
        }
        else {
            $default = $value['default'];
        }
        echo '<input class="hidden-input-'. $value['id'] .'" type="hidden" value="'.$default.'" name="' . $value['id'] . '" id="' . $value['id'] . '"/>';
    }





/*-------------------------------------------------------------
		Type : Custom Background Selector
-------------------------------------------------------------*/
    function custom_background_selector_start( $value ) {

        $item_padding = isset( $value['item_padding'] ) ? $value['item_padding'] : '20px 30px 0 0';
        echo '<div class="ws-single-option ">';

        echo '<label><span class="option-title-main">'.$value['name'] .'</span></label>';

        if ( isset( $value['desc'] ) ) {
            echo '<span class="option-desc">'.$value['desc'] .'</span>';
        }
?>

<div class="ws-specific-bg-selector" id="<?php echo $value['id']; ?>">
    <div class="ws-specific-bg-selector-right">
  <div class="ws-bg-edit-option ws-specific-edit-bg-color">

<?php

    }


/*-------------------------------------------------------------
		Type : Custom Background Selector Color
-------------------------------------------------------------*/

    function custom_background_selector_color( $value ) {

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $color = $this->saved_options[$value['id']];
        }
        else {
            $color = $value['default'];
        }

?>
<span class="ws-bg-edit-label">
        <?php  _e( 'Background color', 'backend' ) ?>
        </span>
        <div class="bg-edit-panel-color">

          <input name="<?php echo $value['id'] ?>" id="<?php echo $value['id'] ?>" size="8" type="minicolors" class="specific-color-picker" value="<?php echo $color; ?>" />

        </div>
        <div class="clearboth"></div>
   </div>


<?php
    }





/*-------------------------------------------------------------
		Type : Custom Background Selector Repeat
-------------------------------------------------------------*/

    function custom_background_selector_repeat( $value ) {

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $repeat = $this->saved_options[$value['id']];
        }
        else {
            $repeat = $value['default'];
        }

?>
   <div class="ws-bg-edit-option ws-specific-edit-option-repeat"> <span class="ws-bg-edit-label">
        <?php  _e( 'Background Repeat', 'backend' )  ?>
        </span>
        <div class="bg-repeat-option">
        <a style="border:none" class="no-repeat" href="#" rel="no-repeat" title="no-repeat"></a>
        <a href="#" rel="repeat" class="repeat" title="repeat"></a>
        <a href="#" rel="repeat-x" class="repeat-x" title="repeat-x"></a>
        <a href="#" rel="repeat-y" class="repeat-y" title="repeat-y"></a>
        <input class="specific-input-repeat" type="hidden" value="<?php echo $repeat; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"/>
   </div>
  	<div class="clearboth"></div>

    </div>

<?php
    }




/*-------------------------------------------------------------
		Type : Custom Background Selector Attachment
-------------------------------------------------------------*/

    function custom_background_selector_attachment( $value ) {

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $attachment = $this->saved_options[$value['id']];
        }
        else {
            $attachment = $value['default'];
        }

?>
      <div class="ws-bg-edit-option ws-specific-edit-option-attachment"> 
      <span class="ws-bg-edit-label"><?php  _e( 'Background Attachment', 'backend' )  ?></span>
        <div class="bg-attachment-option"> 
        	<a style="border:none" href="#" rel="fixed" class="fixed" title="fixed"></a>
            <a href="#" rel="scroll" class="scroll" title="scroll"></a>
            <input class="specific-input-attachment" type="hidden" value="<?php echo $attachment; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"/>
        </div>
        <div class="clearboth"></div>
      </div>

<?php
    }








/*-------------------------------------------------------------
		Type : Custom Background Selector Position
-------------------------------------------------------------*/

    function custom_background_selector_position( $value ) {

        if ( isset( $this->saved_options[$value['id']] ) ) {
            $position = $this->saved_options[$value['id']];
        }
        else {
            $position = $value['default'];
        }

?>
      <div class="ws-bg-edit-option ws-specific-edit-option-position"> <span class="ws-bg-edit-label"><?php  _e( 'Background Position', 'backend' )  ?></span>
        <div class="bg-position-option">
          <a style="border-left:none" href="#" rel="left top" class="left-top" title="left top"></a><a href="#" rel="center top" class="center-top" title="center top"></a><a href="#" rel="right top" class="right-top" title="right top"></a>
          <div class="clearboth"></div>
          <a style="border-left:none" href="#" rel="left center" class="left-center" title="left center"></a><a href="#" rel="center center" class="center-center" title="center center"></a><a href="#" rel="right center" class="right-center" title="right center"></a>
          <div class="clearboth"></div>
          <a style="border-left:none; border-bottom:none;" href="#" rel="left bottom" class="left-bottom" title="left bottom"></a><a style="border-bottom:none;" href="#" rel="center bottom" class="center-bottom" title="center bottom"></a><a style="border-bottom:none;" href="#" rel="right bottom" class="right-bottom" title="right bottom"></a>
          <input class="specific-input-position" type="hidden" value="<?php echo $position; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"/>
      </div>
 <div class="clearboth"></div>
    </div>

<div class="clearboth"></div></div>
<?php
    }




/*-------------------------------------------------------------
		Type : Custom Background Selector Source
-------------------------------------------------------------*/

    function custom_background_selector_source( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $image_source = $this->saved_options[$value['id']];
        }
        else {
            $image_source = $value['default'];
        }
?>

      <div class="clearboth"></div>
      <input class="specific-image-source" type="hidden" value="<?php echo $image_source; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"/>
 </div>

</div>

<div class="clearboth"></div>
</div>

<?php
}



/*-------------------------------------------------------------
		Type : Custom Background Selector Image
-------------------------------------------------------------*/

    function custom_background_selector_image( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $preset_image = $this->saved_options[$value['id']];
        }
        else {
            $preset_image = $value['default'];
        }
?>
<div class="ws-specific-bg-selector-left">
      <div class="ws-bg-edit-option specific-background-image"> <span class="ws-bg-edit-label"><?php  _e( 'Background Image', 'backend' )  ?></span>
        <div class="clearboth"></div>
        <ul class="bg-background-type-tabs">
          <li><a rel="no-image" href="#" class="ws-specific-edit-option-no-image-button ws-button highlight-color bg-image-buttons">
            <?php  _e( 'No Image', 'backend' )  ?>
            </a></li>
          <li><a rel="preset" href="#" class="ws-specific-edit-option-preset-button ws-button highlight-color bg-image-buttons">
            <?php  _e( 'Presets', 'backend' )  ?>
            </a></li>
          <li><a rel="custom" href="#" class="ws-specific-edit-option-upload-button ws-button highlight-color bg-image-buttons">
            <?php  _e( 'Custom', 'backend' )  ?>
            </a></li>
        </ul>
        <div class="clearboth"></div>

      <div class="bg-background-type-panes">
        <div class="bg-background-type-pane specific-no-image"> </div>
        <div class="bg-background-type-pane specific-image-preset">
          <div class="bg-image-preset-wrapper">
            <ul class="bg-image-preset-tabs">
              <li><a href="#" class="">Patterns</a></li>
              <li><a href="#" class="">Textures</a></li>
            </ul>
            <div class="bg-image-preset-panes">
              <div class="bg-image-preset-pane">
                <ul class="bg-image-preset-thumbs">
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/1.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p1.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/2.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p2.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/3.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p3.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/4.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p4.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/5.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p5.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/6.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p6.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/7.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p7.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/8.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p8.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/9.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p9.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/10.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p10.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/11.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p11.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/12.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p12.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/13.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p13.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/14.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p14.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/15.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p15.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/16.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p16.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/17.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p17.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/18.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p18.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/19.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p19.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/20.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p20.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/21.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p21.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/22.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p22.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/23.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p23.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/24.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p24.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/25.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p25.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/26.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p26.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/27.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p27.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/28.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p28.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/29.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p29.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/30.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p30.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/31.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p31.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/32.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p32.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/33.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p33.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/34.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p34.png" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/patterns/35.png"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/patterns/p35.png" /></a></li>
                  </ul>
              </div>
              <div class="bg-image-preset-pane">
                <ul class="bg-image-preset-thumbs">
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/3.jpg"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/t3.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/7.jpg"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/t7.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/10.jpg"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/t10.jpg" /></a></li>
                  <li><a href="#" rel="<?php echo THEME_IMAGES  ?>/textures/18.jpg"><img title="" alt="" src="<?php echo THEME_ADMIN_ASSETS_URI ?>/images/textures/t18.jpg" /></a></li>
                </ul>
              </div>
            </div>
          </div>
         <input class="specific-preset-image-url" type="hidden" value="<?php echo $preset_image; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"/>
        </div>


<?php


    }

/*-------------------------------------------------------------
		Type : Custom Background Selector Custom Image
-------------------------------------------------------------*/
    function custom_background_selector_custom_image( $value ) {
        if ( isset( $this->saved_options[$value['id']] ) ) {
            $custom_image = $this->saved_options[$value['id']];
        }
        else {
            $custom_image = $value['default'];
        }
?>
        <div class="bg-background-type-pane specific-edit-panel-upload">
              <div class="upload-option">
                        <span class="bg-edit-panel-upload-title"><?php  _e( 'Upload a new custom image', 'backend' )  ?></span>

            <input class="ws-upload-url" type="text" id="<?php echo $value['id'] ?>" name="<?php echo $value['id'] ?>" size="40"  value="<?php echo $custom_image; ?>" />
            <a class="option-upload-button thickbox" id="<?php echo $value['id'] ?>_button" href="#"><?php _e( 'Upload', 'backend' ) ?></a>
            <span id="<?php echo $value['id']; ?>-preview" class="show-upload-image" alt="<?php echo $value['name']; ?>"><img src="<?php echo $custom_image; ?>" title="" /></span>
            </div>
        </div>

<?php


    }


/*-------------------------------------------------------------
		Type : Custom Background Selector End
-------------------------------------------------------------*/

    function custom_background_selector_end( $value ) {
		$this->add_help_link( $value );
        echo '<div class="clearboth"></div></div></div>';
		$this->add_divider($value);
    }


/*-------------------------------------------------------------
		Type : Custom
-------------------------------------------------------------*/
    function custom( $value ) {
            if ( isset( $this->saved_options[$value['id']] ) ) {
                $default = $this->saved_options[$value['id']];
            }
            else {
                $default = $value['default'];
            }
             $value['function']( $value, $default );
        }


/*-------------------------------------------------------------
		Type : Custom Font
-------------------------------------------------------------*/

        function custom_font( $value ) {
            echo '<input type="hidden" id="'. $value['id']. '" name="' . $value['id'] .'"  value="';
            if ( isset( $this->saved_options[$value['id']] ) ) {
                echo $this->saved_options[$value['id']];
            }
            else {
                echo $value['default'];
            }
            echo '"/>';
        }




/*-------------------------------------------------------------
		Type : Extract Array data from sources
-------------------------------------------------------------*/

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
			case 'news':
                $entries = get_posts( 'post_type=news&orderby=title&numberposts=-1&order=ASC' );
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
			case 'news_category':
                $entries = get_terms( 'news_category', 'orderby=name&hide_empty=0' );
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


/*-------------------------------------------------------------
		Other functions
-------------------------------------------------------------*/

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
        echo '</div>';
	  }
}
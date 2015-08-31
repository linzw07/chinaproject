<?php
include_once (THEME_ADMIN . '/generators/option-generator.php');

class shortcodesGenerator extends optionGenerator {
	
	function shortcodesGenerator($config, $shortcodes){
		$this->config = $config;
		$this->options = $shortcodes;
		add_action('admin_init', array(&$this, 'add_script'));
		add_action('admin_menu', array(&$this, 'create'));
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
	
	function add_script(){
		
		if( theme_is_post_type_new($this->config['pages']) || theme_is_post_type_post($this->config['pages']) ){
			wp_enqueue_script('ws-shortcode',THEME_ADMIN_ASSETS_URI . '/js/shortcode.js',array('jquery'), false, true);
		}
	}
	
	function render() {
		global $post;
		echo '<div class="shortcode_selector" style="margin:30px 20px;"><select class="ws-chosen" style="width:300px; float:left" name="sc_selector">';
		echo '<option value="">' . __('Choose One Shortcode...','theme_frontend') . '</option>';
		foreach($this->options as $shortcode) {
			echo '<option value="'.$shortcode['value'].'">'.$shortcode['name'].'</option>';
		}
		echo '</select><div class="clearboth"></div></div>';
		foreach($this->options as $shortcode) {
			echo '<div id="shortcode_'.$shortcode['value'].'" class="shortcode_wrap visuallyhidden">';
			if(isset($shortcode['sub'])){
				/*
				
				
				echo '<div class="ws-single-option with-divider shortcode_sub_selector">';
				echo '<label><span class="option-title-sub">Type</span></label>';

				echo '<select name="sc_'.$shortcode['value'].'_selector">';
				echo '<option value="">' . __('Choose one...','theme_frontend') . '</option>';
				foreach($shortcode['options'] as $sub_shortcode) {
					echo '<option value="'.$sub_shortcode['value'].'">'.$sub_shortcode['name'].'</option>';
				}
				echo '</select><div class="clearboth"></div></div>';
				echo '<div class="option-divider"  style="margin-bottom:20px;"></div>';
				foreach($shortcode['options'] as $sub_shortcode) {
					echo '<div id="sub_shortcode_'.$sub_shortcode['value'].'" class="sub_shortcode_wrap visuallyhidden">';
					foreach($sub_shortcode['options'] as $option){
						if (method_exists($this, $option['type'])) {
							$option['id']='sc_'.$shortcode['value'].'_'.$sub_shortcode['value'].'_'.$option['id'];
							$this->$option['type']($option);
						}
					}
					echo '</div>';
				}*/
				
				
				$width = isset( $shortcode['width'] ) ? $shortcode['width'] : '300';
				 
				echo '<div class="ws-single-option with-divider shortcode_sub_selector">';
				echo '<label><span class="option-title-sub">Type</span></label>';
				echo '<div class="ws-advanced-selectbox text-based" id="sc_'.$shortcode['name'].'_type" style="width:'.$width.'px; "><div class="ws-selector-heading">';
				$width-=50;
				echo '<span class="selected_item" style="width:'.$width.'px; ">' . __('Select Option...','theme_frontend') . '</span><span class="ws-selector-arrow"></span></div>';
				echo '<div class="ws-select-options hidden" style="width: 298px; height: 300px; overflow-y: scroll; overflow-x: hidden; display: none;">';

				
				
				
				echo '<span class="ws-select-option" value="">' . __('Select Option...','theme_frontend') . '</span>';
				foreach($shortcode['options'] as $sub_shortcode) {
					echo '<span class="ws-select-option" value="'.$sub_shortcode['value'].'">'.$sub_shortcode['name'].'</span>';
				}
				
				echo '<input type="hidden"  name="sc_'.$shortcode['value'].'_selector" id="sc_'.$shortcode['name'].'_type" ></div></div></div>';
			
				echo '<div class="option-divider"></div>';
				
				foreach($shortcode['options'] as $sub_shortcode) {
					echo '<div id="sub_shortcode_'.$sub_shortcode['value'].'" class="sub_shortcode_wrap visuallyhidden">';
					foreach($sub_shortcode['options'] as $option){
						if (method_exists($this, $option['type'])) {
							$option['id']='sc_'.$shortcode['value'].'_'.$sub_shortcode['value'].'_'.$option['id'];
							$this->$option['type']($option);
						}
					}
					echo '</div>';
				}
				
				
				
				
			}else{
				foreach($shortcode['options'] as $option){
					if (method_exists($this, $option['type'])) {
						$option['id']='sc_'.$shortcode['value'].'_'.$option['id'];
						$this->$option['type']($option);
					}
				}
			}
			
			echo '</div>';
		}
		
		echo '<h4 style="float:left; line-height:30px; margin:0;"><label style="padding:0 30px 0 20px" for="shortcode_selector">'.__('Preview','theme_frontend').'</label></h4>';
		echo '<div id="shortcode_preview_buttons"><a class="ws-button dominant-color" id="shortcode_preview">'.__('Preview Content','theme_frontend').'</a></div>';
		echo '<div id="shortcode_preview_container" ><iframe id="shotcode_preview_iframeContainer" src="'.THEME_ADMIN_URI.'/shortcode/preview.php"></iframe> </div>';
		echo '<h4 style="float:left; line-height:30px; width:100%;"><label style="padding:0 30px 0 20px" >Short Code</label></h4>';
		echo '<div id="shortcode_preview_container" ><div id="shortcode_previewcode"><h2 style="width:100%;"></h2></div></div>';
		echo '<div id="shortcode_preview_container"><h5>'.__('Note: Copy the short code to the editor. If you use the <em>Insert Shortcode</em> button, there is no need to click <em>Preview Content</em> button first. ','theme_frontend').'</h5></div>';
		echo '<div id="shortcode_insert_buttons"><a href="#" class="ws-button dominant-color" id="shortcode_insert">Insert Shortcode</a></div>';
		echo '<div class="clear"></div>';
		
	}
	
}
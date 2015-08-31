<form class="searchform" method="get" id="searchform" action="<?php echo home_url(); ?>">
	<span><input type="text" class="text_input" value="<?php _e('Search', 'theme_frontend'); ?>.." name="s" id="s" onfocus="if(this.value == '<?php _e('Search', 'theme_frontend'); ?>..') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('Search', 'theme_frontend'); ?>..'}" /></span>
	<input value="" type="submit" class="search_button" type="submit" /> 
</form> 
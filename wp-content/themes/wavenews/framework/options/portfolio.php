<?php

/*-----------------------------------------------------------------------------------
		Manage portfolio's columns 
-----------------------------------------------------------------------------------*/

function edit_portfolio_columns($gallery_columns) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => _x('Portfolio Name', 'column name', 'theme_frontend' ),
		"portfolio_categories" => __('Categories', 'theme_frontend' ),
		"description" => __('Description', 'theme_frontend' )
	);

	return $columns;
}
add_filter('manage_edit-portfolio_columns', 'edit_portfolio_columns');

function manage_portfolio_columns($column) {
	global $post;
	
	if ($post->post_type == "portfolio") {
		switch($column){
			case "description":
				the_excerpt();
				break;
			case "portfolio_categories":
				$terms = get_the_terms($post->ID, 'portfolio_category');
				
				if (! empty($terms)) {
					foreach($terms as $t)
						$output[] = "<a href='edit.php?post_type=portfolio&portfolio_tag=$t->slug'> " . esc_html(sanitize_term_field('name', $t->name, $t->term_id, 'portfolio_tag', 'display')) . "</a>";
					$output = implode(', ', $output);
				} else {
					$t = get_taxonomy('portfolio_category');
					$output = "No $t->label";
				}
				
				echo $output;
				break;

		}
	}
}
add_action('manage_posts_custom_column', 'manage_portfolio_columns', 10, 2);

?>
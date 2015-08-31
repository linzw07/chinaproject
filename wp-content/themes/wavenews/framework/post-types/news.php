<?php

/*-----------------------------------------------------------------------------------
	PostType:News
-----------------------------------------------------------------------------------*/

function register_news_post_type() {
	register_post_type( 'news', array(
			'labels' => array(
				'name' => __( 'News', 'post type general name', 'theme_frontend' ),
				'singular_name' => __( 'News', 'post type singular name', 'theme_frontend' ),
				'add_new' => __( 'Add New', 'News', 'theme_frontend' ),
				'add_new_item' => __( 'Add New News', 'theme_frontend' ),
				'edit_item' => __( 'Edit News', 'theme_frontend' ),
				'new_item' => __( 'New News', 'theme_frontend' ),
				'view_item' => __( 'View News', 'theme_frontend' ),
				'search_items' => __( 'Search News', 'theme_frontend' ),
				'not_found' =>  __( 'No news found', 'theme_frontend' ),
				'not_found_in_trash' => __( 'No News found in Trash', 'theme_frontend' ),
				'parent_item_colon' => '',
			),
			'singular_label' => __( 'News', 'theme_frontend' ),
			'public' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'menu_icon' => THEME_ADMIN_ASSETS_URI . '/images/news-admin.png',
			'capability_type' => 'post',
			'menu_position' => 21,
			'hierarchical' => false,
			'rewrite' => array( 'slug' => 'news' ),
			'query_var' => false,
			'show_in_nav_menus' => true,
			'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'custom-fields', 'comments', 'page-attributes' )
		) );

	/* register taxonomy for news */
	
	register_taxonomy( 'news_category', 'news', array(
			'hierarchical' => true,
			'labels' => array(
				'name' => __( 'News Categories', 'taxonomy general name', 'theme_frontend' ),
				'singular_name' => __( 'News Category', 'taxonomy singular name', 'theme_frontend' ),
				'search_items' =>  __( 'Search Categories', 'theme_frontend' ),
				'popular_items' => __( 'Popular Categories', 'theme_frontend' ),
				'all_items' => __( 'All Categories', 'theme_frontend' ),
				'parent_item' => null,
				'parent_item_colon' => null,
				'edit_item' => __( 'Edit News Category', 'theme_frontend' ),
				'update_item' => __( 'Update News Category', 'theme_frontend' ),
				'add_new_item' => __( 'Add New News Category', 'theme_frontend' ),
				'new_item_name' => __( 'New News Category Name', 'theme_frontend' ),
				'separate_items_with_commas' => __( 'Separate News category with commas', 'theme_frontend' ),
				'add_or_remove_items' => __( 'Add or remove News category', 'theme_frontend' ),
				'choose_from_most_used' => __( 'Choose from the most used News category', 'theme_frontend' ),

			),
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => false,
			'show_in_nav_menus' => false,
		) );
}
add_action( 'init', 'register_news_post_type' );

function news_context_fixer() {
	if ( get_query_var( 'post_type' ) == 'news' ) {
		global $wp_query;
		$wp_query->is_home = false;
	}
	if ( get_query_var( 'taxonomy' ) == 'news_category' ) {
		global $wp_query;
		$wp_query->is_404 = true;
		$wp_query->is_tax = false;
		$wp_query->is_archive = false;
	}
}
add_action( 'template_redirect', 'news_context_fixer' );

/* Manage portfolio's columns */

function edit_news_columns($gallery_columns) {
	$columns = array(
		"cb" => "<input type=\"checkbox\" />",
		"title" => __('News Name', 'column name', 'theme_frontend' ),
		"news_categories" => __('Categories', 'theme_frontend' ),
		"description" => __('Description', 'theme_frontend' ),
		"thumbnail" => __('Thumbnail', 'theme_frontend' )
	);

	return $columns;
}
add_filter('manage_edit-news_columns', 'edit_news_columns');

function manage_news_columns($column) {
	global $post;
	
	if ($post->post_type == "news") {
		switch($column){
			case "description":
				the_excerpt();
				break;
			case "news_categories":
				$terms = get_the_terms($post->ID, 'news_category');
				
				if (! empty($terms)) {
					foreach($terms as $t)
						$output[] = "<a href='edit.php?post_type=news&news_tag=$t->slug'> " . esc_html(sanitize_term_field('name', $t->name, $t->term_id, 'news_tag', 'display')) . "</a>";
					$output = implode(', ', $output);
				} else {
					$t = get_taxonomy('news_category');
					$output = "No $t->label";
				}
				
				echo $output;
				break;
			
			case 'thumbnail':
				echo the_post_thumbnail('thumbnail');
				break;
		}
	}
}
add_action('manage_posts_custom_column', 'manage_news_columns');

?>
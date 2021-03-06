<?php
/* delminco Custom Post Type Example
This page walks you through creating 
a custom post type and taxonomies. You
can edit this one or copy the following code 
to create another one. 

I put this in a separate file so as to 
keep it organized. I find it easier to edit
and change things if they are concentrated
in their own file.

Developed by: Eddie Machado
URL: http://themble.com/delminco/
*/

// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'delminco_flush_rewrite_rules' );

// Flush your rewrite rules
function delminco_flush_rewrite_rules() {
	flush_rewrite_rules();
}

// let's create the function for the custom type


function suply_post_type() { 
	// creating (registering) the custom type 
	register_post_type( 'suply', /* (http://codex.wordpress.org/Function_Reference/register_post_type) */
		// let's now add all the options for this post type
		array( 'labels' => array(
			'name' => __( 'suply', 'delminco' ), /* This is the Title of the Group */
			'singular_name' => __( 'suply', 'delminco' ), /* This is the individual type */
			'all_items' => __( 'All suplies', 'delminco' ), /* the all items menu item */
			'add_new' => __( 'Add New', 'delminco' ), /* The add new menu item */
			'add_new_item' => __( 'Add New suply', 'delminco' ), /* Add New Display Title */
			'edit' => __( 'Edit', 'delminco' ), /* Edit Dialog */
			'edit_item' => __( 'Edit suply', 'delminco' ), /* Edit Display Title */
			'new_item' => __( 'New suply', 'delminco' ), /* New Display Title */
			'view_item' => __( 'View suply', 'delminco' ), /* View Display Title */
			'search_items' => __( 'Search suplies', 'delminco' ), /* Search Custom Type Title */ 
			'not_found' =>  __( 'Nothing found in the Database.', 'delminco' ), /* This displays if there are no entries yet */ 
			'not_found_in_trash' => __( 'Nothing found in Trash', 'delminco' ), /* This displays if there is nothing in the trash */
			'parent_item_colon' => ''
			), /* end of arrays */
			'description' => __( 'This is a suply', 'delminco' ), /* Custom Type Description */
			'public' => true,
			'show_in_nav_menus' => true,
			'publicly_queryable' => true,
			'exclude_from_search' => false,
			'show_ui' => true,
			'query_var' => true,
			'menu_position' => 8, /* this is what order you want it to appear in on the left hand side menu */ 
			'menu_icon' => get_stylesheet_directory_uri() . '/images/notify-icon.png', /* the icon for the custom post type menu */
			'rewrite'	=> array( 'slug' => 'suply', 'with_front' => false ), /* you can specify its url slug */
			'has_archive' => 'suply', /* you can rename the slug here */
			//'capability_type' => array('admin_suply','admin_suplies'),
			'map_meta_cap'        => true,
			'hierarchical' => false,
			/* the next one is important, it tells what's enabled in the post editor */
			'supports' => array( 'title', 'editor', /*'author','thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'comments'و 'revisions', 'sticky'*/)
		) /* end of options */
	); /* end of register post type */
	
	/* this adds your post categories to your custom post type */
	//register_taxonomy_for_object_type( 'category', 'tour' );
	/* this adds your post tags to your custom post type */
	//register_taxonomy_for_object_type( 'post_tag', 'tour' );
	
}

	// adding the function to the Wordpress init
	add_action( 'init', 'suply_post_type',10);
	

	// now let's add custom categories (these act like categories)
	register_taxonomy( 'suply_cat', 
		array('suply'), /* if you change the name of register_post_type( 'custom_type', then you have to change this */
		array('hierarchical' => true,     /* if this is true, it acts like categories */
			'labels' => array(
				'name' => __( 'suply Categories', 'delminco' ), /* name of the custom taxonomy */
				'singular_name' => __( 'suply Category', 'delminco' ), /* single taxonomy name */
				'search_items' =>  __( 'Search suply Categories', 'delminco' ), /* search title for taxomony */
				'all_items' => __( 'All suply Categories', 'delminco' ), /* all title for taxonomies */
				'parent_item' => __( 'Parent suply Category', 'delminco' ), /* parent title for taxonomy */
				'parent_item_colon' => __( 'Parent suply Category:', 'delminco' ), /* parent taxonomy title */
				'edit_item' => __( 'Edit suply Category', 'delminco' ), /* edit custom taxonomy title */
				'update_item' => __( 'Update suply Category', 'delminco' ), /* update title for taxonomy */
				'add_new_item' => __( 'Add New suply Category', 'delminco' ), /* add new title for taxonomy */
				'new_item_name' => __( 'New suply Category Name', 'delminco' ) /* name title for taxonomy */
			),
			'show_admin_column' => true, 
			'show_ui' => true,
			'query_var' => true,
			'rewrite' => array( 'slug' => 'suply-cat' ),
			'show_in_nav_menus' => true,
		)
	);
	
	// now let's add custom tags (these act like categories)
	

?>

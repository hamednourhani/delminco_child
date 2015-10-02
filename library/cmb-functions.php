<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the delminco directory)
 *
 * Be sure to replace all instances of 'delminco_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_delminco
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/delminco
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

// if ( file_exists( dirname( __FILE__ ) . '/cmb/init.php' ) ) {
// 	require_once dirname( __FILE__ ) . '/cmb/init.php';
// } elseif ( file_exists( dirname( __FILE__ ) . '/CMB/init.php' ) ) {
// 	require_once dirname( __FILE__ ) . '/CMB/init.php';
// }


// function ed_metabox_include_front_page( $display, $meta_box ) {
//     if ( ! isset( $meta_box['show_on']['key'] ) ) {
//         return $display;
//     }

//     if ( 'front-page' !== $meta_box['show_on']['key'] ) {
//         return $display;
//     }

//     $post_id = 0;

//     // If we're showing it based on ID, get the current ID
//     if ( isset( $_GET['post'] ) ) {
//         $post_id = $_GET['post'];
//     } elseif ( isset( $_POST['post_ID'] ) ) {
//         $post_id = $_POST['post_ID'];
//     }

//     if ( ! $post_id ) {
//         return !$display;
//     }

//     // Get ID of page set as front page, 0 if there isn't one
//     $front_page = get_option( 'page_on_front' );

//     // there is a front page set and we're on it!
//     return $post_id == $front_page;
// }
// //add_filter( 'cmb2_show_on', 'ed_metabox_include_front_page', 10, 2 );
// /**
//  * Conditionally displays a metabox when used as a callback in the 'show_on_cb' delminco_box parameter
//  *
//  * @param  delminco object $cmb delminco object
//  *
//  * @return bool             True if metabox should show
//  */
// function delminco_show_if_front_page( $cmb ) {
// 	// Don't show this metabox if it's not the front page template
// 	if ( $cmb->object_id !== get_option( 'page_on_front' ) ) {
// 		return false;
// 	}
// 	return true;
// }

// /**
//  * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
//  *
//  * @param  delminco_Field object $field Field object
//  *
//  * @return bool                     True if metabox should show
//  */
// function delminco_hide_if_no_cats( $field ) {
// 	// Don't show this field if not in the cats category
// 	if ( ! has_tag( 'cats', $field->object_id ) ) {
// 		return false;
// 	}
// 	return true;
// }

// /**
//  * Conditionally displays a message if the $post_id is 2
//  *
//  * @param  array             $field_args Array of field parameters
//  * @param  delminco_Field object $field      Field object
//  */
// function delminco_before_row_if_2( $field_args, $field ) {
// 	if ( 2 == $field->object_id ) {
// 		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
// 	} else {
// 		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
// 	}
// }



// /******************************************************************/
// /*------------          Suply maker         ----------------------*/
// /******************************************************************/

//  add_action( 'cmb2_init', 'delminco_page_has_content_metabox' );
// /**
//  * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
//  */
// function delminco_page_has_content_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_';

// 	/**
// 	 * Sample metabox to demonstrate each field type included
// 	 */
// 	$cmb_demo = new_cmb2_box( array(
// 		'id'            => $prefix . 'sub_mother',
// 		'title'         => __( 'Page has Content', 'delminco' ),
// 		'object_types'  => array( 'page' ), // Post type
// 		// 'show_on_cb' => 'delminco_show_if_front_page', // function should return a bool value
// 		// 'context'    => 'normal',
// 		// 'priority'   => 'high',
// 		// 'show_names' => true, // Show field names on the left
// 		// 'cmb_styles' => false, // false to disable the CMB stylesheet
// 		// 'closed'     => true, // true to keep the metabox closed by default
// 	) );


	
// 	$cmb_demo->add_field( array(
// 		'name'         => __( 'Page Contnet', 'delminco' ),
// 		'desc'         => __( 'does page has Content or show the first subpage content?', 'delminco' ),
// 		'id'           => $prefix . 'sub_mother_page',
// 		'type'         => 'radio_inline',
// 		'options'	   => array(
// 			'has_content'	=> __('Page has Content','delminco'),
// 			'show_first_subpage'		=> __('Show first SubPage','delminco'),
// 			'redirect_to'   => __('Redirect to Other Page','delminco'),
			
// 			),
// 		'default' => 'show_first_subpage',
// 	) );

// 	$cmb_demo->add_field( array(
// 		'name'         => __( 'Redirect To Page', 'delminco' ),
// 		'desc'         => __( 'enter the page url', 'delminco' ),
// 		'id'           => $prefix . 'redirect_to',
// 		'type'         => 'text_url',
		
// 	) );
	

// }


/* Create a front-end submission form for CMB which creates new posts/post-type entries.
 *
 * @package  Custom Metaboxes and Fields for WordPress
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

// class Example_Front_End_Form {

//     // Set prefix
    

//     public $prefix = '_suply_'; // Change this to your prefix


//     /**
//      * Construct the class.
//      */
//     public function __construct() {
//         add_filter( 'cmb_meta_boxes', array( $this, 'cmb_metaboxes' ) );
//         add_shortcode( 'cmb-form', array( $this, 'do_frontend_form' ) );
//         add_action( 'init', array( $this, 'initialize_cmb_meta_boxes' ), 9 );
//         add_action( 'cmb_save_post_fields', array( $this, 'save_featured_image' ), 10, 4 );
//     }


//     /**
//      * Define the metabox and field configurations.
//      */
//     public function cmb_metaboxes( array $meta_boxes ) {

//         /**
//          * Metabox for the "Memorials" front-end submission form
//          */
//         $meta_boxes['memorials_metabox'] = array(
//             'id'         => 'memorials',
//             'title'      => __( 'Memorial Information', 'cmb' ),
//             'pages'      => array( 'memorials' ), // Post type
//             'context'    => 'normal',
//             'priority'   => 'high',
//             'show_names' => true, // Show field names on the left
//             'fields'     => array(
//                 array(
//                     'name' => __( 'First Name', 'cmb' ),
//                     'desc' => __( '', 'cmb' ),
//                     'id'   => $this->prefix . 'memorial_first_name',
//                     'type' => 'text_medium',
//                 ),
//                 array(
//                     'name' => __( 'Last Name', 'cmb' ),
//                     'desc' => __( '', 'cmb' ),
//                     'id'   => $this->prefix . 'memorial_last_name',
//                     'type' => 'text_medium',
//                 ),
//                 array(
//                     'name' => __( 'Date of birth', 'cmb' ),
//                     'desc' => __( '', 'cmb' ),
//                     'id'   => $this->prefix . 'memorial_date_of_birth',
//                     'type' => 'text_date_timestamp',
//                 ),
//                 array(
//                     'name' => __( 'Date of death', 'cmb' ),
//                     'desc' => __( '', 'cmb' ),
//                     'id'   => $this->prefix . 'memorial_date_of_death',
//                     'type' => 'text_date_timestamp',
//                 ),
//                 array(
//                     'name' => __( 'Image', 'cmb' ),
//                     'desc' => __( 'Upload an image or enter a URL.', 'cmb' ),
//                     'id'   => $this->prefix . 'memorial_image',
//                     'type' => 'file',
//                 ),
//                 array(
//                     'name'    => __( 'Obituary', 'cmb' ),
//                     'id'      => $this->prefix . 'memorial_story',
//                     'type'    => 'wysiwyg',
//                     'options' => array(
//                         'media_buttons' => false,
//                         'wpautop'       => true
//                     )
//                 ),
//             ),
//         );

//         return $meta_boxes;
//     }


//     /**
//      * Shortcode to display a CMB form for a post ID.
//      */
//     public function do_frontend_form() {

//         // Default metabox ID
//         $metabox_id = 'memorials_metabox';

//         // Get all metaboxes
//         $meta_boxes = apply_filters( 'cmb_meta_boxes', array() );

//         // If the metabox specified doesn't exist, yell about it.
//         if ( ! isset( $meta_boxes[ $metabox_id ] ) ) {
//             return __( "A metabox with the specified 'metabox_id' doesn't exist.", 'cmb' );
//         }

//         // This is the WordPress post ID where the data should be stored/displayed.
//         $post_id = 0;

//         if ( $new_id = $this->intercept_post_id() ) {
//             $post_id = $new_id;
//             echo 'Thank You for your submission.';
//         }

//         var_dump('new_id :'.$new_id);
//         var_dump('post_id :'.$post_id);

//         // Shortcodes need to return their data, not echo it.
//         $echo = false;

//         // Get our form
//         $form = cmb2_get_metabox_form( $meta_boxes[ $metabox_id ], $post_id, $echo );
        

//         return $form;
//     }


//     /**
//      * Get data before saving to CMB.
//      */
//     public function intercept_post_id() {

//     	global $post;
//     global $wp_query;
//         // Check for $_POST data
//         if ( empty( $_POST ) ) {
            
//             return false;
            
//         }

//         // Check nonce
//         if ( ! ( isset( $_POST['submit-cmb'], $_POST['wp_meta_box_nonce'] ) && wp_verify_nonce( $_POST['wp_meta_box_nonce'], cmb_Meta_Box::nonce() ) ) ) {
//              var_dump('$_POST'.$_POST['submit-cmb'].'/'.cmb_Meta_Box::nonce());
//             return;
            
//         }

        
//         // Setup and sanitize data
//         if ( isset( $_POST[ $this->prefix . 'memorial_first_name' ] ) ) {

//             add_filter( 'user_has_cap', array( $this, 'grant_publish_caps' ), 0,  3);

//             $this->new_submission = wp_insert_post( array(
//                 'post_title'            => sanitize_text_field( $_POST[ $this->prefix . 'memorial_first_name' ] . ' ' . $_POST[ $this->prefix . 'memorial_last_name' ] ),
//                 'post_author'           => get_current_user_id(),
//                 'post_status'           => 'draft', // Set to draft so we can review first
//                 'post_type'             => 'suply',
//                 'post_content_filtered' => wp_kses( $_POST[ $this->prefix . 'memorial_story' ], '<b><strong><i><em><h1><h2><h3><h4><h5><h6><pre><code><span>' ),
//             ), true );

//             // If no errors, save the data into a new post draft
//             if ( ! is_wp_error( $this->new_submission ) ) {
//                 return $this->new_submission;
//             }

//         }

//         return false;
//     }

//     /**
//      * Grant temporary permissions to subscribers.
//      */
//     public function grant_publish_caps( $caps, $cap, $args ) {

//         if ( 'edit_post'  == $args[0] ) {
//             $caps[$cap[0]] = true;
//         }

//         return $caps;
//     }

//     /**
//      * Save featured image.
//      */
//     public function save_featured_image( $object_id, $meta_box_id, $updated, $meta_box ) {

//         if ( isset( $updated ) && in_array( '_example_memorial_image', $updated ) ) {
//             set_post_thumbnail( $object_id, get_post_meta( $object_id, '_example_memorial_image_id', 1 ) );
//         }

//     }


//     /**
//      * Initialize CMB.
//      */
//     public function initialize_cmb_meta_boxes() {

//         if ( ! class_exists( 'cmb_Meta_Box' ) ) {
//             require_once dirname( __FILE__ ) . '/cmb/init.php';
//         }

//     }


// } // end class

// $Example_Front_End_Form = new Example_Front_End_Form();


// add_action( 'cmb2_init', 'delminco_select_subpage_metabox' );
// function delminco_select_subpage_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_group_';
	
// 	$cmb_group = new_cmb2_box( array(
// 		'id'           => $prefix . 'sub',
// 		'title'        => __( 'Sub Pages Layout', 'delminco' ),
// 		'object_types' => array( 'page'),
// 	) );

// 	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
// 	$group_field_id = $cmb_group->add_field( array(
// 		'id'          => $prefix . 'sub_pages',
// 		'type'        => 'group',
// 		'description' => __( 'Layout sub pages', 'delminco' ),
// 		'options'     => array(
// 			'group_title'   => __( 'sub page {#}', 'delminco' ), // {#} gets replaced by row number
// 			'add_button'    => __( 'Add sub page', 'delminco' ),
// 			'remove_button' => __( 'Remove sub page', 'delminco' ),
// 			'sortable'      => true, // beta
// 		),
// 	) );

	
	
	
 	

// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'List Name', 'delminco' ),
// 		'desc'    => __( 'The name of sub page in List ', 'delminco' ),
// 		'id'      => 'list_name',
// 		'type'    => 'text',
		
			
// 	) );

	
	
	
// 		$post_id = ($_GET['post'])?($_GET['post']):"";
	
// 	$args = array(
// 	    'child_of'     => $post_id,
// 	    'sort_order'   => 'ASC',
// 	    'sort_column'  => 'post_title',
// 	    'post_type' => 'page',
// 		'post_status' => 'publish',
// 		'hierarchical' => 1,
// 		'parent' => $post_id,
// 	);

// 	 $sub_pages_list = get_pages($args);

// 	 $sub_array = array();
// 	 $sub_array['none'] = '--';
// 	foreach ( $sub_pages_list as $page ) : setup_postdata( $page );
// 			$sub_array[$page->ID] = $page->post_title;
//  	endforeach; 




// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Sub Page', 'delminco' ),
// 		'desc'    => __( 'Select The sub page', 'delminco' ),
// 		'id'      => 'sub_id',
// 		'type'    => 'select',
// 		'options' =>  $sub_array,
// 		'default' => 'none',
			
// 	) );


	
// }


// add_action( 'cmb2_init', 'delminco_select_related_pages_metabox' );
// function delminco_select_related_pages_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_group_';
	
// 	$cmb_group = new_cmb2_box( array(
// 		'id'           => $prefix . 'related',
// 		'title'        => __( 'Related Pages Layout', 'delminco' ),
// 		'object_types' => array( 'page'),
// 	) );

// 	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
// 	$group_field_id = $cmb_group->add_field( array(
// 		'id'          => $prefix . 'related_pages',
// 		'type'        => 'group',
// 		'description' => __( 'Layout Related pages', 'delminco' ),
// 		'options'     => array(
// 			'group_title'   => __( 'Related page {#}', 'delminco' ), // {#} gets replaced by row number
// 			'add_button'    => __( 'Add Related page', 'delminco' ),
// 			'remove_button' => __( 'Remove Related page', 'delminco' ),
// 			'sortable'      => true, // beta
// 		),
// 	) );

	
	
	
 	

// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'List Name', 'delminco' ),
// 		'desc'    => __( 'The name of Related page in List ', 'delminco' ),
// 		'id'      => 'list_name',
// 		'type'    => 'text',
		
			
// 	) );

// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Link Type', 'delminco' ),
// 		'desc'    => __( 'is this a page or a link ', 'delminco' ),
// 		'id'      => 'link_or_page',
// 		'type'    => 'radio_inline',
// 		'options' => array(
// 			'link' =>__('Link','delminco'),
// 			'page' => __('page','delminco'),
// 			),
// 		'default' => 'page'
					
// 	) );

// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Link url', 'delminco' ),
// 		'desc'    => __( 'Enter the link url ', 'delminco' ),
// 		'id'      => 'link_url',
// 		'type'    => 'text_url',
		
					
// 	) );

	
    
// 		$post_id = ($_GET['post'])?($_GET['post']):"";
		
// 	// global $post;
// 	// $post_id = $post->ID;
	
// 	$args = array(
// 	    'child_of'     => $post_id,
// 	    'sort_order'   => 'ASC',
// 	    'sort_column'  => 'post_title',
// 	    'post_type' => 'page',
// 		'post_status' => 'publish',
// 		'hierarchical' => 1,
// 		'parent' => $post_id,
// 	);

// 	 $sub_pages_list = get_pages($args);

// 	 $sub_array = array();
// 	 $sub_array['none'] = '--';
// 	foreach ( $sub_pages_list as $page ) : setup_postdata( $page );
// 			$sub_array[$page->ID] = $page->post_title;
//  	endforeach; 




// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Related Page', 'delminco' ),
// 		'desc'    => __( 'Select The Related page', 'delminco' ),
// 		'id'      => 'sub_id',
// 		'type'    => 'select',
// 		'options' =>  $sub_array,
// 		'default' => 'none',
			
// 	) );

// 	}

// /******************************************************************/
// /*--------------------Link Page-----------------------------------*/
// /******************************************************************/

// add_action('cmb2_init','delminco_register_link_metabox');
// // add_action('cmb2_init','delminco_register_tour_information_metabox');
// function delminco_register_link_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_';

// 	/**
// 	 * Sample metabox to demonstrate each field type included
// 	 */
// 	$cmb_demo = new_cmb2_box( array(
// 		'id'            => $prefix . 'link_metabox',
// 		'title'         => __( 'Link Information', 'delminco' ),
// 		'object_types'  => array( 'link' ), // Post type
// 		// 'show_on_cb' => 'delminco_show_if_front_page', // function should return a bool value
// 		// 'context'    => 'normal',
// 		// 'priority'   => 'high',
// 		// 'show_names' => true, // Show field names on the left
// 		// 'cmb_styles' => false, // false to disable the CMB stylesheet
// 		// 'closed'     => true, // true to keep the metabox closed by default
// 	) );

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'link address', 'delminco' ),
// 		'desc'       => __( 'the web address of link', 'delminco' ),
// 		'id'         => $prefix . 'link_url',
// 		'type'       => 'text_url',
// 		//'show_on_cb' => 'delminco_hide_if_no_cats', // function should return a bool value
// 		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
// 		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
// 		// 'on_front'        => false, // Optionally designate a field to wp-admin only
// 		// 'repeatable'      => true,
// 	) );

	
// }


// /******************************************************************/
// /*--------------------Link Page-----------------------------------*/
// /******************************************************************/

// add_action('cmb2_init','delminco_register_download_metabox');
// // add_action('cmb2_init','delminco_register_tour_information_metabox');
// function delminco_register_download_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_';

// 	/**
// 	 * Sample metabox to demonstrate each field type included
// 	 */
// 	$cmb_demo = new_cmb2_box( array(
// 		'id'            => $prefix . 'download_metabox',
// 		'title'         => __( 'Download Information', 'delminco' ),
// 		'object_types'  => array( 'download' ), // Post type
// 		// 'show_on_cb' => 'delminco_show_if_front_page', // function should return a bool value
// 		// 'context'    => 'normal',
// 		// 'priority'   => 'high',
// 		// 'show_names' => true, // Show field names on the left
// 		// 'cmb_styles' => false, // false to disable the CMB stylesheet
// 		// 'closed'     => true, // true to keep the metabox closed by default
// 	) );

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'download file address', 'delminco' ),
// 		'desc'       => __( 'the web address of download', 'delminco' ),
// 		'id'         => $prefix . 'download_url',
// 		'type'       => 'text_url',
// 		//'show_on_cb' => 'delminco_hide_if_no_cats', // function should return a bool value
// 		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
// 		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
// 		// 'on_front'        => false, // Optionally designate a field to wp-admin only
// 		// 'repeatable'      => true,
// 	) );

	
// }


// /******************************************************************/
// /*--------------------Gallery Page-----------------------------------*/
// /******************************************************************/


//  add_action( 'cmb2_init', 'delminco_register_gallery_metabox' );
// /**
//  * Hook in and add a demo metabox. Can only happen on the 'cmb2_init' hook.
//  */
// function delminco_register_gallery_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_';

// 	/**
// 	 * Sample metabox to demonstrate each field type included
// 	 */
// 	$cmb_demo = new_cmb2_box( array(
// 		'id'            => $prefix . 'gallery_metabox',
// 		'title'         => __( 'Gallery Images', 'delminco' ),
// 		'object_types'  => array( 'gallery' ), // Post type
// 		// 'show_on_cb' => 'delminco_show_if_front_page', // function should return a bool value
// 		// 'context'    => 'normal',
// 		// 'priority'   => 'high',
// 		// 'show_names' => true, // Show field names on the left
// 		// 'cmb_styles' => false, // false to disable the CMB stylesheet
// 		// 'closed'     => true, // true to keep the metabox closed by default
// 	) );


	
// 	$cmb_demo->add_field( array(
// 		'name'         => __( 'Images', 'delminco' ),
// 		'desc'         => __( 'Upload or add multiple images/attachments.', 'delminco' ),
// 		'id'           => $prefix . 'image_list',
// 		'type'         => 'file_list',
// 		'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
// 	) );

	

// }

// /******************************************************************/
// /*--------------------Tab Maker Page-------------------------------*/
// /******************************************************************/
//  add_action( 'cmb2_init', 'delminco_register_tab_maker_metabox' );
// function delminco_register_tab_maker_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_group_';
	
// 	$cmb_group = new_cmb2_box( array(
// 		'id'           => $prefix . 'tab_metabox',
// 		'title'        => __( 'Tabs', 'delminco' ),
// 		'object_types' => array( 'tab', ),
// 	) );

// 	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
// 	$group_field_id = $cmb_group->add_field( array(
// 		'id'          => $prefix.'tab',
// 		'type'        => 'group',
// 		'description' => __( 'Generates reusable form entries', 'delminco' ),
// 		'options'     => array(
// 			'group_title'   => __( 'Sub Tab {#}', 'delminco' ), // {#} gets replaced by row number
// 			'add_button'    => __( 'Add Another Sub Tab', 'delminco' ),
// 			'remove_button' => __( 'Remove Sub Tab', 'delminco' ),
// 			'sortable'      => true, // beta
// 		),
// 	) );

// 	/**
// 	 * Group fields works the same, except ids only need
// 	 * to be unique to the group. Prefix is not needed.
// 	 *
// 	 * The parent field's id needs to be passed as the first argument.
// 	 */
// 	// WP_Query arguments
	
	
// 	$sub_tabs = get_posts(array(
// 			'post_type' => 'sub_tab',
// 			// 'posts_per_page' => -1,
// 			)
// 	);
	

	
// 	$sub_array = array();
// 	foreach ( $sub_tabs as $sub_tab ) : setup_postdata( $sub_tab );
// 			$sub_array[$sub_tab->ID] = $sub_tab->post_title;
//  	endforeach; 
//  	//wp_reset_postdata();
	
// 	// $cmb_group->add_group_field( $group_field_id, array(
// 	// 	'name'        => __( 'Tab Title', 'delminco' ),
// 	// 	'description' => __( 'Enter Tab Title', 'delminco' ),
// 	// 	'id'          => 'tab_title',
// 	// 	'type'        => 'text',
// 	// ) );

	
 	
//  	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Sub Tab Name', 'delminco' ),
// 		'desc'    => __( 'write the sub tab name ', 'delminco' ),
// 		'id'      => 'tab_name',
// 		'type'    => 'text',
		
			
// 	) );
	
// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Choose a sub Tab ', 'delminco' ),
// 		'desc'    => __( 'Choose a  the sub tab from list ', 'delminco' ),
// 		'id'      => 'tab_id',
// 		'type'    => 'select',
// 		'options' => $sub_array,
			
// 	) );
	
	
// }
// /******************************************************************/
// /*--------------------Section Maker-------------------------------*/
// /******************************************************************/

// add_action('cmb2_init','delminco_register_section_maker_metabox');
// // add_action('cmb2_init','delminco_register_tour_information_metabox');
// function delminco_register_section_maker_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_';

// 	/**
// 	 * Sample metabox to demonstrate each field type included
// 	 */
// 	$cmb_demo = new_cmb2_box( array(
// 		'id'            => $prefix . 'section_maker_metabox',
// 		'title'         => __( 'Section Selection', 'delminco' ),
// 		'object_types'  => array( 'post','page','news' ), // Post type
// 		// 'show_on_cb' => 'delminco_show_if_front_page', // function should return a bool value
// 		// 'context'    => 'normal',
// 		// 'priority'   => 'high',
// 		// 'show_names' => true, // Show field names on the left
// 		// 'cmb_styles' => false, // false to disable the CMB stylesheet
// 		// 'closed'     => true, // true to keep the metabox closed by default
// 	) );

	

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'news slider', 'delminco' ),
// 		'desc'       => __( 'show news slider', 'delminco' ),
// 		'id'         => $prefix . 'slider_show',
// 		'type'       => 'radio_inline',
// 		'show_option_none' => true,
// 		'options'          => array(
// 			'true' => __( 'Yes', 'delminco' ),
			
// 		),	
		
// 		//'show_on_cb' => 'delminco_hide_if_no_cats', // function should return a bool value
// 		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
// 		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
// 		// 'on_front'        => false, // Optionally designate a field to wp-admin only
// 		// 'repeatable'      => true,
// 	) );

// 	$news_array = array();
// 	$news_array['none'] = "---";
// 	$news_cats = get_terms('news_cat');
// 	if(count($news_cats)>0){
// 		foreach($news_cats as $news_cat){
// 				$news_array[$news_cat->term_id] = $news_cat->name;
// 		}
// 	}
// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'News Category', 'delminco' ),
// 		'desc'       => __( 'which news category?', 'delminco' ),
// 		'id'         => $prefix . 'news_cat',
// 		'type'       => 'select',
// 		'options'          => $news_array,
// 	));

	
// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'hide content', 'delminco' ),
// 		'desc'       => __( 'hide page content', 'delminco' ),
// 		'id'         => $prefix . 'content',
// 		'type'       => 'radio_inline',
// 		'show_option_none' => true,
// 		'options'          => array(
// 			'true' => __( 'Yes', 'delminco' ),
			
			
			
			
// 		),
// 		//'show_on_cb' => 'delminco_hide_if_no_cats', // function should return a bool value
// 		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
// 		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
// 		// 'on_front'        => false, // Optionally designate a field to wp-admin only
// 		// 'repeatable'      => true,
// 	) );

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'show comments', 'delminco' ),
// 		'desc'       => __( 'show  page coments', 'delminco' ),
// 		'id'         => $prefix . 'comments',
// 		'type'       => 'radio_inline',
// 		'show_option_none' => true,
// 		'options'          => array(
// 			'true' => __( 'Yes', 'delminco' ),
			
			
			
			
// 		),
// 		//'show_on_cb' => 'delminco_hide_if_no_cats', // function should return a bool value
// 		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
// 		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
// 		// 'on_front'        => false, // Optionally designate a field to wp-admin only
// 		// 'repeatable'      => true,
// 	) );

	





// 	// var_dump($news_cats);
// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'hide sidebar', 'delminco' ),
// 		'desc'       => __( 'hide page sidebar', 'delminco' ),
// 		'id'         => $prefix . 'sidebar',
// 		'type'       => 'radio_inline',
// 		'show_option_none' => true,
// 		'options'          => array(
// 			'true' => __( 'Yes', 'delminco' ),
			
			
			
			
// 		),
// 		//'show_on_cb' => 'delminco_hide_if_no_cats', // function should return a bool value
// 		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
// 		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
// 		// 'on_front'        => false, // Optionally designate a field to wp-admin only
// 		// 'repeatable'      => true,
// 	) );

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'show tabs', 'delminco' ),
// 		'desc'       => __( 'show tabs or not', 'delminco' ),
// 		'id'         => $prefix . 'show_tabs',
// 		'type'       => 'radio_inline',
// 		'show_option_none' => true,
// 		'options'          => array(
// 			'true' => __( 'Yes', 'delminco' ),
// 		),
// 	) );

	
// 	$tabs_list = get_posts(array(
// 			'post_type' => 'tab',
// 			'posts_per_page' => '100',
// 			)
// 	);
	

	
// 	$tab_array = array();
// 	foreach ( $tabs_list as $tab ) : setup_postdata( $tab );
// 			$tab_array[$tab->ID] = $tab->post_title;
//  	endforeach; 


// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'tabs category', 'delminco' ),
// 		'desc'       => __( 'which tab category?', 'delminco' ),
// 		'id'         => $prefix . 'tab_id',
// 		'type'       => 'select',
// 		'options'          => $tab_array,

		
// 	));
	

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'show related links', 'delminco' ),
// 		'desc'       => __( 'show related links or not', 'delminco' ),
// 		'id'         => $prefix . 'related_links',
// 		'type'       => 'radio_inline',
// 		'show_option_none' => true,
// 		'options'          => array(
// 			'true' => __( 'Yes', 'delminco' ),
			
			
			
// 		),
		
// 	) );

// 	$link_array = array();
// 	$link_array['none'] = "---";
// 	$link_cats = get_terms('link_cat');
// 	if(count($link_cats)>0){
// 		foreach($link_cats as $link_cat){
// 				$link_array[$link_cat->term_id] = $link_cat->name;
// 		}
// 	}
// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Links Category', 'delminco' ),
// 		'desc'       => __( 'which Link category?', 'delminco' ),
// 		'id'         => $prefix . 'links_cat',
// 		'type'       => 'select',
// 		'options'          => $link_array,
// 	));

	
// }

// /******************************************************************/
// /*--------------------Tab Maker Page-------------------------------*/
// /******************************************************************/
//  add_action( 'cmb2_init', 'delminco_register_management_maker_metabox' );
// function delminco_register_management_maker_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_group_';
	
// 	$cmb_group = new_cmb2_box( array(
// 		'id'           => $prefix . 'management_metabox',
// 		'title'        => __( 'Pages', 'delminco' ),
// 		'object_types' => array( 'management', ),
// 	) );

// 	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
// 	$group_field_id = $cmb_group->add_field( array(
// 		'id'          => $prefix . 'sub_page',
// 		'type'        => 'group',
// 		'description' => __( 'Generates reusable form entries', 'delminco' ),
// 		'options'     => array(
// 			'group_title'   => __( 'Page {#}', 'delminco' ), // {#} gets replaced by row number
// 			'add_button'    => __( 'Add Another Page', 'delminco' ),
// 			'remove_button' => __( 'Remove Page', 'delminco' ),
// 			'sortable'      => true, // beta
// 		),
// 	) );

	
	
// 	$pages = get_posts(array(
// 			'post_type' => 'sub_management',
// 			'posts_per_page' => '100',
// 			)
// 	);
	

	
// 	$sub_array = array();
// 	foreach ( $pages as $page ) : setup_postdata( $page );
// 			$sub_array[$page->ID] = $page->post_title;
//  	endforeach; 
 	

// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Page Name', 'delminco' ),
// 		'desc'    => __( 'The name of Sub Page ', 'delminco' ),
// 		'id'      => 'sub_name',
// 		'type'    => 'text',
		
			
// 	) );

	
// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Page', 'delminco' ),
// 		'desc'    => __( 'choose a sub page ', 'delminco' ),
// 		'id'      => 'sub_id',
// 		'type'    => 'select',
// 		'options' => $sub_array,
			
// 	) );
	
	
// }




//  add_action( 'cmb2_init', 'delminco_register_education_maker_metabox' );
// function delminco_register_education_maker_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_group_';
	
// 	$cmb_group = new_cmb2_box( array(
// 		'id'           => $prefix . 'education_metabox',
// 		'title'        => __( 'Pages', 'delminco' ),
// 		'object_types' => array( 'education', ),
// 	) );

// 	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
// 	$group_field_id = $cmb_group->add_field( array(
// 		'id'          => $prefix . 'sub_page',
// 		'type'        => 'group',
// 		'description' => __( 'Generates reusable form entries', 'delminco' ),
// 		'options'     => array(
// 			'group_title'   => __( 'Page {#}', 'delminco' ), // {#} gets replaced by row number
// 			'add_button'    => __( 'Add Another Page', 'delminco' ),
// 			'remove_button' => __( 'Remove Page', 'delminco' ),
// 			'sortable'      => true, // beta
// 		),
// 	) );

		
	
// 	$pages = get_posts(array(
// 			'post_type' => 'sub_education',
// 			'posts_per_page' => '100',
// 			)
// 	);
	

	
// 	$sub_array = array();
// 	foreach ( $pages as $page ) : setup_postdata( $page );
// 			$sub_array[$page->ID] = $page->post_title;
//  	endforeach; 
//  	//wp_reset_postdata();
	
	

// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Page Name', 'delminco' ),
// 		'desc'    => __( 'The name of Sub Page ', 'delminco' ),
// 		'id'      => 'sub_name',
// 		'type'    => 'text',
		
			
// 	) );

	
// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Page', 'delminco' ),
// 		'desc'    => __( 'choose a sub page ', 'delminco' ),
// 		'id'      => 'sub_id',
// 		'type'    => 'select',
// 		'options' => $sub_array,
			
// 	) );
	
	
// }

// add_action( 'cmb2_init', 'delminco_register_related_widget_metabox' );
// function delminco_register_related_widget_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_group_';
	
// 	$cmb_group = new_cmb2_box( array(
// 		'id'           => $prefix . 'related_widget',
// 		'title'        => __( 'Related Links', 'delminco' ),
// 		'object_types' => array( 'management','education' ),
// 	) );

// 	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
// 	$group_field_id = $cmb_group->add_field( array(
// 		'id'          => $prefix . 'related_links',
// 		'type'        => 'group',
// 		'description' => __( 'Generates reusable form entries', 'delminco' ),
// 		'options'     => array(
// 			'group_title'   => __( 'Link {#}', 'delminco' ), // {#} gets replaced by row number
// 			'add_button'    => __( 'Add Another Link', 'delminco' ),
// 			'remove_button' => __( 'Remove Link', 'delminco' ),
// 			'sortable'      => true, // beta
// 		),
// 	) );

	
	
	
 	

// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Link Name', 'delminco' ),
// 		'desc'    => __( 'The name of related link ', 'delminco' ),
// 		'id'      => 'link_name',
// 		'type'    => 'text',
		
			
// 	) );

// 	$cmb_group->add_group_field($group_field_id , array(
// 		'name'    => __( 'Link Url', 'delminco' ),
// 		'desc'    => __( 'The Url of Link ', 'delminco' ),
// 		'id'      => 'link_url',
// 		'type'    => 'text_url',
		
			
// 	) );
// }
// /******************************************************************/
// /*--------------------Scientifc Board user Profile ----------------*/
// /******************************************************************/
// global $user_ID,$pagenow;

// $current_user_id = get_current_user_id();


// // if ( $role == "administrator" || $role == 'editor' || $role == 'sciences_board') {
// // 	add_action('cmb2_init','delminco_science_article_metabox');
// // }
// // =======
// if($pagenow == 'profile.php' || $pagenow == 'user-edit.php'){


// 	if (isset($_GET['user_id']) && is_user_logged_in()){
		
// 		$userProfile = get_userdata( $_GET['user_id']);
// 		$roles = $userProfile->roles;
// 		$current_role = array_shift($roles);

// 	}elseif(isset($current_user_id) && is_user_logged_in()){
// 		$userProfile = get_userdata($current_user_id);
// 		$roles = $userProfile->roles;
// 		$current_role = array_shift($roles);


// 	}
// 	if (isset($current_role) &&  ($current_role == 'si_board' || $current_role == 'administrator') ) {
// 			add_action('cmb2_init','delminco_science_profile_metabox');
// 			add_action('cmb2_init','delminco_science_extra_info_metabox');
			
// 		}
// }

// function delminco_science_profile_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_user_';

// 	/**
// 	 * Sample metabox to demonstrate each field type included
// 	 */
// 	$cmb_demo = new_cmb2_box( array(
// 		'id'            => $prefix . 'metabox',
// 		'title'         => __( 'Profile', 'delminco' ),
// 		'object_types'  => array( 'user' ), // Post type
// 		'new_user_section' => 'add-exiting-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
		
// 	) );

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Profile Picture', 'delminco' ),
// 		'desc'       => __( 'Upload profile picture or enter the url', 'delminco' ),
// 		'id'         => $prefix . 'picture',
// 		'type'       => 'file',
		
// 		)
		
// 	);
// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Science Degree', 'delminco' ),
// 		'desc'       => __( 'enter the science degree ', 'delminco' ),
// 		'id'         => $prefix . 'degree',
// 		'type'       => 'text',
		
// 		)
		
// 	);

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Educational Group', 'delminco' ),
// 		'desc'       => __( 'select educational group ', 'delminco' ),
// 		'id'         => $prefix . 'edu_group',
// 		'type'       => 'select',
// 		'options'    => array(

// 								'electronic' => __('Electronic','delminco'),
// 								'mechanic' => __('Mechanic','delminco'),
// 								'building' => __('Building','delminco'),
// 								'material' => __('Material','delminco'),
// 								'computer' => __('Computer','delminco'),
// 								'public' => __('Public','delminco'),
// 			),
		
// 		)
		
// 	 );
	
// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Emails', 'delminco' ),
// 		'desc'       => __( 'Upload email addresses Photo', 'delminco' ),
// 		'id'         => $prefix . 'emails',
// 		'type'       => 'file',
		
// 		)
		
// 	 );
// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Phone', 'delminco' ),
// 		'desc'       => __( 'enter the Email Addresses sepeprate with comma eg. info@gmail.com , info@yahoo.com ', 'delminco' ),
// 		'id'         => $prefix . 'phone',
// 		'type'       => 'text',
		
// 		)
		
// 	 );
	
// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Education', 'delminco' ),
// 		'desc'       => __( 'Enter Description', 'delminco' ),
// 		'id'         => $prefix . 'education',
// 		'type' => 'wysiwyg',
// 	    'options' => array(
// 	        // 'wpautop' => true, // use wpautop?
// 	        // 'media_buttons' => true, // show insert/upload button(s)
// 	        // 'textarea_name' => $editor_id, // set the textarea name to something different, square brackets [] can be used here
// 	        // 'textarea_rows' => get_option('default_post_edit_rows', 10), // rows="..."
// 	        // 'tabindex' => '',
// 	        // 'editor_css' => '', // intended for extra styles for both visual and HTML editors buttons, needs to include the `<style>` tags, can use "scoped".
// 	        // 'editor_class' => '', // add extra class(es) to the editor textarea
// 	        // 'teeny' => false, // output the minimal editor config used in Press This
// 	        // 'dfw' => false, // replace the default fullscreen with DFW (needs specific css)
// 	        // 'tinymce' => true, // load TinyMCE, can be used to pass settings directly to TinyMCE using an array()
// 	        // 'quicktags' => true // load Quicktags, can be used to pass settings directly to Quicktags using an array()  
// 	    )
// 	));

	
// }

// function delminco_science_extra_info_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_science_';

// 	/**
// 	 * Sample metabox to demonstrate each field type included
// 	 */
// 	$cmb_demo = new_cmb2_box( array(
// 		'id'            => $prefix . 'metabox',
// 		'title'         => __( '', 'delminco' ),
// 		'object_types'  => array( 'user' ), // Post type
// 		'new_user_section' => 'add-exiting-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
		
// 	) );

// 	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Academic Positions', 'delminco' ),
// 		'desc'       => __( 'Enter Description', 'delminco' ),
// 		'id'         => $prefix . 'academic_positions',
// 		'type' => 'wysiwyg',
// 	    'options' => array(
	 
// 	    )
// 	));

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Industrial Experience', 'delminco' ),
// 		'desc'       => __( 'Enter Description', 'delminco' ),
// 		'id'         => $prefix . 'industrial_experience',
// 		'type' => 'wysiwyg',
// 	    'options' => array(
	 
// 	    )
// 	));

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Books', 'delminco' ),
// 		'desc'       => __( 'Enter Description', 'delminco' ),
// 		'id'         => $prefix . 'books',
// 		'type' => 'wysiwyg',
// 	    'options' => array(
	 
// 	    )
// 	));

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Journal Papers', 'delminco' ),
// 		'desc'       => __( 'Enter Description', 'delminco' ),
// 		'id'         => $prefix . 'journal_papers',
// 		'type' => 'wysiwyg',
// 	    'options' => array(
	 
// 	    )
// 	));

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Conference Papers', 'delminco' ),
// 		'desc'       => __( 'Enter Description', 'delminco' ),
// 		'id'         => $prefix . 'conference_papers',
// 		'type' => 'wysiwyg',
// 	    'options' => array(
	 
// 	    )
// 	));

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Research Projects', 'delminco' ),
// 		'desc'       => __( 'Enter Description', 'delminco' ),
// 		'id'         => $prefix . 'research_projects',
// 		'type' => 'wysiwyg',
// 	    'options' => array(
	 
// 	    )
// 	));

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Comments', 'delminco' ),
// 		'desc'       => __( 'Enter Description', 'delminco' ),
// 		'id'         => $prefix . 'comments',
// 		'type' => 'wysiwyg',
// 	    'options' => array(
	 
// 	    )
// 	));


// 	// $author_id = get_current_user_id();
// 	// $author = get_userdata( $author_id );
// 	// var_dump($author);

	

// }

// add_action('cmb2_init','delminco_courses_metabox');


// function delminco_courses_metabox() {

// 	// Start with an underscore to hide fields from custom fields list
// 	$prefix = '_delminco_course_';

// 	/**
// 	 * Sample metabox to demonstrate each field type included
// 	 */
// 	$cmb_demo = new_cmb2_box( array(
// 		'id'            => $prefix . 'metabox',
// 		'title'         => __( 'Pages', 'delminco' ),
// 		'object_types'  => array( 'course' ), // Post type
// 		// 'new_user_section' => 'add-exiting-user', // where form will show on new user page. 'add-existing-user' is only other valid option.
		
// 	) );

// 	// $group_field_id is the field id string, so in this case: $prefix . 'demo'
// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Lecture & reading ', 'delminco' ),
// 		'desc'       => __( 'Enter Description', 'delminco' ),
// 		'id'         => $prefix . 'lecture_reading',
// 		'type' => 'wysiwyg',
// 	    'options' => array(
// 	 			'wpautop' => true, // use wpautop?
// 	    )
// 	));

// 	$cmb_demo->add_field( array(
// 		'name'       => __( 'Homework & Exame', 'delminco' ),
// 		'desc'       => __( 'Enter Description', 'delminco' ),
// 		'id'         => $prefix . 'homework_exame',
// 		'type' => 'wysiwyg',
// 	    'options' => array(
// 	 			'wpautop' => true, // use wpautop?
// 	 	)
// 	));

// }




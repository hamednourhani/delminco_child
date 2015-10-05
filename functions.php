<?php 

if( !class_exists("CMB2") ){
    require_once( dirname(__FILE__)."/library/cmb/init.php" );
}
require_once( 'library/cmb-functions.php' );


require_once('library/country-codes.php');

function delminco_child_ahoy() {

 load_child_theme_textdomain( 'delminco', get_stylesheet_directory_uri() . '/languages' );
require_once( 'library/custom-post-type.php' );

} /* end delminco ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'delminco_child_ahoy' );



add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'bootstrap', 'parent-style' ) );
    wp_enqueue_style( 'flags-style', get_stylesheet_directory_uri().'/css/flags16.css', array() );

//     // custom jquery
//     wp_register_script( 'custom_js', get_stylesheet_uri() . '/js/jquery.custom.js', array( 'jquery','validation' ), '1.0', TRUE );
//     wp_enqueue_script( 'custom_js' );
 
// // validation
//     wp_register_script( 'validation', get_stylesheet_uri().'/js/jquery.validate.min.js', array( 'jquery' ) );
//     wp_enqueue_script( 'validation' );
}

if ( ICL_LANGUAGE_CODE=='en'){ 
  
        remove_filter('the_title', 'ztjalali_persian_num');
        remove_filter('the_content', 'ztjalali_persian_num');
        remove_filter('the_excerpt', 'ztjalali_persian_num');
        remove_filter('comment_text', 'ztjalali_persian_num');
    // change arabic characters
        remove_filter('the_content', 'ztjalali_ch_arabic_to_persian');
        remove_filter('the_title', 'ztjalali_ch_arabic_to_persian');
        remove_filter('the_excerpt', 'ztjalali_ch_arabic_to_persian');
        remove_filter('comment_text', 'ztjalali_ch_arabic_to_persian');
        remove_filter('date_i18n', 'ztjalali_ch_date_i18n',111);


}


function delminco_template_chooser($template)   
{    
  global $wp_query;   
  $post_type = get_query_var('post_type');   
  if( $wp_query->is_search && $post_type == 'suply' )   
  {
    return locate_template('suply-search.php');  //  redirect to archive-search.php
  }   
  return $template;   
}
add_filter('template_include', 'delminco_template_chooser'); 


function delminco_pagination(){
  global $wp_query;
      
      $big = 999999999; 
      echo paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'prev_text'    => __('<i class="fa fa-angle-double-right"></i>','naiau'),
        'next_text'    => __('<i class="fa fa-angle-double-left"></i>','naiau')
      ) );
}

/*-----------------------Shortcodes----------------------------*/
function delminco_suply_in_sell_or_buy( $atts, $content = null ) {
   global $wp_query;
    $a = shortcode_atts( array(
        
        'qty' => -1,
        'sb_type' => '',
        'show_more' => true,
        // ...etc
    ), $atts );

   

$suplies = get_posts(array(
                            'post_type' => 'suply',
                            'posts_per_page' => $a['qty'],
                            'meta_key'         => '_suply_sell_buy',
                            'meta_value'         => $a['sb_type'],
                            )
                        );

  

    $suply_list = '';
    
     if(!empty($suplies)){ 
            setup_postdata($suplies ); 
            $suply_list .= '<table class="suply-archive-table">';
              $suply_list .= '<tbody>';
                $suply_list .= '<tr>';
                  $suply_list .= '<th>'. __('For','delminco').'</th>';
                  $suply_list .= '<th>'. __('Name','delminco').'</th>';
                  $suply_list .= '<th>'. __('Date','delminco').'</th>';
                  $suply_list .= '<th>'.__('Country','delminco').'</th>';
                  $suply_list .= '<th>'. __('ID','delminco').'</th>';
                $suply_list .= '</tr>';
              
               foreach($suplies as $suply){; 
                  $suply_list .= '<tr>';
                     $suply_list .= '<td>';
                       $sell_buy = get_post_meta($suply->ID,'_suply_sell_buy',1);
                                if($sell_buy == 'sell'){
                                  $sell_buy_icon = '<i class="fa fa-arrow-up"></i>'.'   '.__('Sell','delminco');
                                } elseif($sell_buy == 'buy') {
                                  $sell_buy_icon = '<i class="fa fa-arrow-down"></i>'.'   '.__('Buy','delminco');
                                }
                                $suply_list .=  $sell_buy_icon;
                     $suply_list .= '</td>';
                     $suply_list .= '<td><a href="'. get_the_permalink($suply->ID).'">'.$suply->post_title.'</a></td>';
                     $suply_list .= '<td>'.get_the_date(get_option('date_format'),$suply->ID).'</td>';
                     $suply_list .= '<td>';
                      
                        $user_id = $suply->post_author;
                        $country_array = country_array();
                        $country_code = get_usermeta($user_id,'billing_country',1);
                         $suply_list .= '<span class="f16 country-flag"><span class="flag '.strtolower($country_code).'"></span>'.'  '.$country_array[$country_code].'</span>';
                     
                     $suply_list .= '</td>';
                     $suply_list .= '<td>'.$suply->ID.'</td>';
                   $suply_list .= '</tr>';
                }
               $suply_list .= '</tbody>';
             $suply_list .= '</table>';
             if($a['show_more'] == true){
                if ( ICL_LANGUAGE_CODE=='en'){
                  $suply_list .= '<a href="'.add_query_arg(array('post_type'=>'suply','sb_type'=>$a['sb_type'],'lang'=>'en'),site_url().'/').'" class="more-suply">'.__('More Products','delminco').'</a>';
                } else{
                  $suply_list .= '<a href="'.add_query_arg(array('post_type'=>'suply','sb_type'=>$a['sb_type']),site_url().'/').'" class="more-suply">'.__('More Products','delminco').'</a>';
                }
              }
           
        }
        //print_filters_for('the_date');
  return $suply_list;
  wp_reset_query();
}
add_shortcode( 'suply', 'delminco_suply_in_sell_or_buy' );


function delminco_page_permalink( $atts, $content = null ) {
    global $post;
    $a = shortcode_atts( array(), $atts );
    
    $page_permalink = get_the_permalink();
    return $page_permalink;
}
add_shortcode( 'page-permalnik', 'delminco_page_permalink' );


/*-----------------------Shortcodes----------------------------*/
/**
* Add the input field to the form
*
* @param int $form_id
* @param null|int $post_id
* @param array $form_settings
*/
function delminco_render_user_country_code_hook( $form_id, $post_id, $form_settings ) {
    
  
    
              
       $suplyer_country_code = get_user_meta($post_id ,'billing_country',1);
              
       $country_array = country_array(); 
       //var_dump($suplyer_country_code);
       ?>

    <div class="wpuf-label">
        <label><?php echo __('Country Name','deminco');?></label>
    </div>
  
    <div class="wpuf-fields">
        <select name="billing_country"><?php //echo esc_attr( $value ); ?>
            <?php foreach($country_array as $key=>$name){
                if($suplyer_country_code == $key){
                  echo '<option value="'.$key.'"selected >'.$name.'</option>';
                }else {
                  echo '<option value="'.$key.'">'.$name.'</option>';

                }
            }?>
        </select>
    </div>
    <?php
}
 
add_action( 'user_country_code_hook', 'delminco_render_user_country_code_hook', 10, 3 );

function delminco_after_user_registration( $user_id, $userdata, $form_id, $form_settings ) {
   
    if ( isset( $_POST['billing_country'] ) ) {
        update_user_meta( $user_id, 'billing_country', $_POST['billing_country'] );
    }
}
 
add_action( 'wpuf_after_register', 'delminco_after_user_registration' );
add_action( 'wpuf_update_profile', 'delminco_after_user_registration' );

/*-----------------query vars -----------------------*/
add_filter( 'query_vars', 'delminco_custom_query_vars' );
function delminco_custom_query_vars( $query_vars ){
    $query_vars[] = 'sb_type';
    
    return $query_vars;
}


function delminco_sell_buy_archive_query_vars( $query ) {
    if ( $query->is_archive() && $query->is_main_query() ) {
        $sb_type = get_query_var('sb_type');
        if(isset($sb_type)){
          $query->set( 'meta_key' ,'_suply_sell_buy' );
          $query->set( 'meta_value', $sb_type );
        }
    }
}
add_action( 'pre_get_posts', 'delminco_sell_buy_archive_query_vars' );

/*-----------------print_filters for special hook -----------------------*/
function print_filters_for( $hook = '' ) {
    global $wp_filter;
    if( empty( $hook ) || !isset( $wp_filter[$hook] ) )
        return;

    print '<pre>';
    print_r( $wp_filter[$hook] );
    print '</pre>';
}
/*-----------------user roles config functions -----------------------*/
// function delminco_profile_admin_css() {
//     $screen_id = isset( get_current_screen()->id ) ? get_current_screen()->id : null;

//     if ( 'profile' === $screen_id || 'user-edit' === $screen_id ) {
//         wp_enqueue_style( 'profile-admin-css', get_template_directory_uri().'/css/profile.css' );
//     }
// }
// add_action( 'admin_enqueue_scripts', 'delminco_profile_admin_css' );

// function delminco_add_user_roles(){
// remove_role('scientific_board');
// remove_role('sciences_board');
// remove_role('sciene_board');
// remove_role('science_board');
// remove_role('s_board');



// $role = add_role( 'si_board', __(
// 'Scientific Board','delminco' ),
// array(


//       'read' => true, // true allows this capability
//       'edit_posts' => false, // Allows user to edit their own posts
//       'edit_pages' => false, // Allows user to edit pages
//       'edit_others_posts' => false, // Allows user to edit others posts not just their own
//       'create_posts' => false, // Allows user to create new posts
//       'manage_categories' => false, // Allows user to manage post categories
//       'publish_posts' => false, // Allows the user to publish, otherwise posts stays in draft mode
//       'edit_themes' => false, // false denies this capability. User can’t edit your theme
//       'install_plugins' => false, // User cant add new plugins
//       'update_plugin' => false, // User can’t update any plugins
//       'update_core' => false, // user cant perform core updates
//       'upload_files' => true,
//       'moderate_comments' => false,


//  ) );
   
// }
// // let's get this party started
// add_action( 'after_setup_theme', 'delminco_add_user_roles',11 );

// add_action('admin_init','delminco_add_role_caps',999);
//     function delminco_add_role_caps() {

//     // Add the roles you'd like to administer the custom post types
//     $roles = array('editor','administrator');
    
//     // Loop through each role and assign capabilities
//     foreach($roles as $the_role) { 

//          $role = get_role($the_role);

      
//                $role->add_cap( 'read' );
//                $role->add_cap( 'read_admin_post');
//                $role->add_cap( 'read_admin_posts' );
//                $role->add_cap( 'edit_admin_post' );
//                $role->add_cap( 'edit_admin_posts' );
//                $role->add_cap( 'edit_others_admin_posts' );
//                $role->add_cap( 'edit_published_admin_posts' );
//                $role->add_cap( 'publish_admin_posts' );
//                $role->add_cap( 'delete_others_admin_posts' );
//                $role->add_cap( 'delete_private_admin_posts' );
//                $role->add_cap( 'delete_published_admin_posts' );

//                $role->add_cap( 'read' );
//                $role->add_cap( 'read_science_course');
//                $role->add_cap( 'read_science_courses' );
//                $role->add_cap( 'edit_science_course' );
//                $role->add_cap( 'edit_science_courses' );
//                // $role->add_cap( 'edit_others_science_courses' );
//                $role->add_cap( 'edit_published_science_courses' );
//                $role->add_cap( 'publish_science_courses' );
//                $role->add_cap( 'publish_science_course' );
//                // $role->add_cap( 'delete_others_science_courses' );
//                $role->add_cap( 'delete_private_science_courses' );
//                $role->add_cap( 'delete_published_science_courses' );
    
//     }
//      $role = get_role('si_board');

//        $role->add_cap( 'read' );
//        $role->add_cap( 'read_science_course');
//        $role->add_cap( 'read_science_courses' );
//        $role->add_cap( 'edit_science_course' );
//        $role->add_cap( 'edit_science_courses' );
//        // $role->add_cap( 'edit_others_science_courses' );
//        $role->add_cap( 'edit_published_science_courses' );
//        $role->add_cap( 'publish_science_courses' );
//        $role->add_cap( 'publish_science_course' );
//        // $role->add_cap( 'delete_others_science_courses' );
//        $role->add_cap( 'delete_private_science_courses' );
//        $role->add_cap( 'delete_published_science_courses' );


// }

// add_action( 'admin_init', 'delminco_remove_menu_pages',999 );
// function delminco_remove_menu_pages() {

//     global $user_ID,$wp_roles;
    
//     $current_user = wp_get_current_user();
//     $roles = $current_user->roles;
//     $role = array_shift($roles);

    
    

//     if ( $role == "administrator" || $role == 'editor') {
//       //some code
//     } else {

   
      
//       // remove_menu_page('upload.php'); // Media
//       remove_menu_page('link-manager.php'); // Links
//       remove_menu_page('edit-comments.php'); // Comments
//       // remove_menu_page('edit.php?post_type=page'); // Pages
//       remove_menu_page('plugins.php'); // Plugins
//       remove_menu_page('themes.php'); // Appearance
//       // remove_menu_page('users.php'); // Users
//       remove_menu_page('tools.php'); // Tools
//       remove_menu_page('options-general.php'); // Settings   
//       remove_menu_page('admin.php?page=wpcf7'); // contact form  
//       remove_menu_page('upload.php'); // Settings 
//       remove_menu_page( 'wpcf7' );
//     }
// }

// add_action( 'after_setup_theme', 'delminco_remove_core_updates' );
// function delminco_remove_core_updates()
// {
//     if ( current_user_can( 'update_core' ) ) {
//         return;
//     }
//     add_action( 'init', create_function( '$a', "remove_action( 'init', 'wp_version_check' );" ), 2 );
//     add_filter( 'pre_option_update_core', '__return_null' );
//     add_filter( 'pre_site_transient_update_core', '__return_null' ); 
//     remove_action( 'load-update-core.php', 'wp_update_plugins' );
//     add_filter( 'pre_site_transient_update_plugins', '__return_null' );
// } 

// add_shortcode( 'delminco_register', 'delminco_show_download' );

// //user login shortcode
// function delminco_show_download(){
//   $args = array('echo'=>false);
//   if ( !is_user_logged_in() ) {
//       return '<div class="login-container">'.wp_login_form( $args ).'</div>';
//   }
// }
// 
/*-----------------------Shortcodes----------------------------*/
// function delminco_notifies_in_cat( $atts, $content = null ) {
//    global $wp_query;
//     $a = shortcode_atts( array(
//         'cat' => '',
//         'qty' => -1,
//         'icon' => 'fa-graduation-cap',
//         'show_more' => "true",
//         // ...etc
//     ), $atts );

   

// $notifies = get_posts(array(
//                             'post_type' => 'notify',
//                             'posts_per_page' => $a['qty'],
//                             'notify_cat'         => $a['cat'],
//                             )
//                         );

//   $notify_cat_url = get_term_link($a['cat'],'notify_cat');
//   if(is_wp_error($notify_cat_url)){
//       $notify_cat_url = home_url('/').'?post_type=notify';
//   } 

  
//   if(!empty($notifies)){
    
    
//      $notify_list = ''; 
//      foreach($notifies as $notify){
//         setup_postdata( $notify ) ;
               
//         $notify_list .= '<li>';
//         $notify_list .= '<i class="fa '.$a['icon'].'"></i>';
//         $notify_list .= '<a href="'.get_the_permalink($notify->ID).'">';
//         $notify_list .= '<span>'.$notify->post_title.'</span>';
//         $notify_list .= '</a>';
          
//         $notify_list .= '</li>';
//       } 
//     if($a['show_more'] == "true"){  
//         $notify_list .='<li><a href="'.$notify_cat_url.'">'.__('More Items ','delminco').'<i class="fa fa-long-arrow-left"></i></a></li>';
//     }
      
   
//   } 
//   return $notify_list;
//   wp_reset_query();
// }
// add_shortcode( 'notifies', 'delminco_notifies_in_cat' );


// function delminco_downloads_in_cat( $atts, $content = null ) {
//    global $wp_query;
//     $a = shortcode_atts( array(
//         'cat' => '',
//         'qty' => -1,
//         'icon' => 'fa-cloud-download',
//         'show_more' => "true",
//         // ...etc
//     ), $atts );

   

// $downloads = get_posts(array(
//                             'post_type' => 'download',
//                             'posts_per_page' => $a['qty'],
//                             'download_cat'         => $a['cat'],
//                             )
//                         );

//   $download_cat_url = get_term_link($a['cat'],'download_cat');
//   if(is_wp_error($download_cat_url)){
//       $download_cat_url = home_url('/').'?post_type=download';
//   } 

  
//   if(!empty($downloads)){
    
    
//      $download_list = ''; 
//      foreach($downloads as $download){
//         setup_postdata( $download ) ;
               
//         $download_list .= '<li>';
//         $download_list .= '<i class="fa '.$a['icon'].'"></i>';
//         $download_list .= '<a href="'.get_post_meta($download->ID,'_delminco_download_url',1).'">';
//         $download_list .= '<span>'.$download->post_title.'</span>';
//         $download_list .= '</a>';
          
//         $download_list .= '</li>';
//       } 
//     if($a['show_more'] == "true"){  
//         $download_list .='<li><a href="'.$download_cat_url.'">'.__('More Items ','delminco').'<i class="fa fa-long-arrow-left"></i></a></li>';
//     }
      
   
//   } 
//   return $download_list;
//   wp_reset_query();
// }
// add_shortcode( 'downloads', 'delminco_downloads_in_cat' );


// function delminco_circulars_in_cat( $atts, $content = null ) {
//    global $wp_query;
//     $a = shortcode_atts( array(
//         'cat' => '',
//         'qty' => -1,
//         'icon' => 'fa-file-text',
//         'show_more' => "true",
//         // ...etc
//     ), $atts );

   

// $circulars = get_posts(array(
//                             'post_type' => 'circular',
//                             'posts_per_page' => $a['qty'],
//                             'circular_cat'         => $a['cat'],
//                             )
//                         );

//   $circular_cat_url = get_term_link($a['cat'],'circular_cat');
//   if(is_wp_error($circular_cat_url)){
//       $circular_cat_url = home_url('/').'?post_type=circular';
//   } 

  
//   if(!empty($circulars)){
    
    
//      $circular_list = ''; 
//      foreach($circulars as $circular){
//         setup_postdata( $circular ) ;
               
//         $circular_list .= '<li>';
//         $circular_list .= '<i class="fa '.$a['icon'].'"></i>';
//         $circular_list .= '<a href="'.get_the_permalink($circular->ID).'">';
//         $circular_list .= '<span>'.$circular->post_title.'</span>';
//         $circular_list .= '</a>';
          
//         $circular_list .= '</li>';
//       } 
//     if($a['show_more'] == "true"){  
//         $circular_list .='<li><a href="'.$circular_cat_url.'">'.__('More Items ','delminco').'<i class="fa fa-long-arrow-left"></i></a></li>';
//     }
      
   
//   } 
//   return $circular_list;
//   wp_reset_query();
// }
// add_shortcode( 'circulars', 'delminco_circulars_in_cat' );

// function delminco_custom_rewrite_basic() {
//   add_rewrite_rule(
//         // The regex to match the incoming URL
//         'science/([^/]+)/?',
//         // The resulting internal URL: `index.php` because we still use WordPress
//         // `pagename` because we use this WordPress page
//         // `designer_slug` because we assign the first captured regex part to this variable
//         'index.php?pagename=science&sb=$matches[1]',
//         // This is a rather specific URL, so we add it to the top of the list
//         // Otherwise, the "catch-all" rules at the bottom (for pages and attachments) will "win"
//         'top' );
// }
// add_action('init', 'delminco_custom_rewrite_basic');

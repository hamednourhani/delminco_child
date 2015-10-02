<?php

	/*	---------------------------------------------------------------------	* 
	 *	Initialization
	 *	---------------------------------------------------------------------	*/

	// Custom Meta Box
	add_action( 'add_meta_boxes', 'delminco_project_add_meta');

	// Save Meta Data
	add_action('save_post', 'delminco_post_save_data');

	/*	---------------------------------------------------------------------	* 
	 *	Custom Project Meta Box
	 *	---------------------------------------------------------------------	*/

	// Field Array
	$prefix = 'delminco_';

	$delminco_post_meta_box = array(
		'id' => 'delminco-post-meta-box',
		'title' => __('Product Information', 'delminco'),
		'page' => 'suply',
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => __('Product Quantity: ', 'delminco'),
				'desc' => __('Enter Amount', 'delminco'),
				'id' => $prefix.'qty',
				'type' => 'text'
			),
			array(
				'name' => __('Product Formula: ', 'delminco'),
				'desc' => __('Enter Formula', 'delminco'),
				'id' => $prefix.'formula',
				'type' => 'text'
			),
			array(
				'name' => __('Sell or Buy: ', 'delminco'),
				'desc' => __('For Sell Porduct or Buy ', 'delminco'),
				'id' => $prefix.'sell_buy',
				'type' => 'select',
				'options' =>array(
						'sell'=>__('Sell','delminco'),
						'buy'=>__('Buy','delminco'),

					),
			),
		)
	);

	/*	---------------------------------------------------------------------	* 
	 *	Create / Add Meta Box
	 *	---------------------------------------------------------------------	*/

	// Custom Meta Box
	add_action( 'add_meta_boxes', 'delminco_project_add_meta');

	function delminco_project_add_meta()
	{
		global $delminco_post_meta_box;

		add_meta_box($delminco_post_meta_box['id'], $delminco_post_meta_box['title'], 'delminco_display_post_meta', $delminco_post_meta_box['page'], $delminco_post_meta_box['context'], $delminco_post_meta_box['priority']);

	} // END OF Function: delminco_project_add_meta

	/*	---------------------------------------------------------------------	* 
	 *	Ouput Project Meta Box
	 *	---------------------------------------------------------------------	*/

	function delminco_display_post_meta()
	{
		global $delminco_post_meta_box, $post;

		// Use nonce for verification
		echo '<input type="hidden" name="delminco_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />'; 

		echo '<table class="form-table">';

			foreach ($delminco_post_meta_box['fields'] as $field) 
			{
				
				// get current post meta data
				$meta = get_post_meta($post->ID, $field['id'], true);

				switch($field['type'])
				{

					// If Text
					case 'text':
					
					echo '<tr style="border-top:1px solid #eeeeee;">',
						'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; line-height: 20px; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
						'<td>';
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : stripslashes(htmlspecialchars(( $field['std']), ENT_QUOTES)), '" size="30" style="width:75%; margin-right: 20px; float:left;" />';
					
					break;

					case 'select':
					
					echo '<tr style="border-top:1px solid #eeeeee;">',
						'<th style="width:25%"><label for="', $field['id'], '"><strong>', $field['name'], '</strong><span style=" display:block; color:#999; line-height: 20px; margin:5px 0 0 0;">'. $field['desc'].'</span></label></th>',
						'<td>';
						$select = '<select name="'.$field['id'].'" id="'.$field['id'].'">';
						  foreach($field['options'] as $key=>$value){
							   if($key == $meta){
							   		$select .= '<option value="'.$option.'" size="30" style="width:75%; margin-right: 20px; float:left;" selected >'.$value.'</option>';
						  		} else {
							   		$select .= '<option value="'.$option.'" size="30" style="width:75%; margin-right: 20px; float:left;">'.$value.'</option>';

						  		}
								
							}
							$select .= '</select>';
						echo $select;
					break;
				}

			}

		echo '</table>';

	} // END Of Function: delminco_display_post_meta

	/*	---------------------------------------------------------------------	* 
	 *	Save Client Meta Data
	 *	---------------------------------------------------------------------	*/

	function delminco_post_save_data($post_id)
	{
		global $delminco_post_meta_box;
		
		// verify nonce
		if (!isset($_POST['delminco_meta_box_nonce']) || !wp_verify_nonce($_POST['delminco_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
	 
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
	 
		// check permissions
		if ('suply' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
	 
		foreach ($delminco_post_meta_box['fields'] as $field) 
		{

			$old = get_post_meta($post_id, $field['id'], true);
			$new = $_POST[$field['id']];
	 
			if ($new && $new != $old) {
				update_post_meta($post_id, $field['id'], $new);
			} elseif ('' == $new && $old) {
				delete_post_meta($post_id, $field['id'], $old);
			}
		}

	} // END Of Function: delminco_post_save_data

	/*	---------------------------------------------------------------------	* 
	 *	Queue Scripts
	 *	---------------------------------------------------------------------	*/

	function delminco_project_scripts()
	{

		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');

	} // END Of Function: delminco_project_scripts


	function delminco_project_styles()
	{
		wp_enqueue_style('thickbox');

	} // END Of Function: delminco_project_styles

	add_action('admin_print_scripts', 'delminco_project_scripts');
	add_action('admin_print_styles', 'delminco_project_styles');


<?php /* Template Name: Edit suplys */ 

$query = new WP_Query(array('post_type' => 'suply', 'posts_per_page' =>'-1', 'post_status' => array('publish', 'pending', 'draft', 'private', 'trash') ) );

if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post();
	
	if(isset($_GET['post'])) {
		
		if($_GET['post'] == $post->ID)
		{
			$current_post = $post->ID;

			$title = get_the_title();
			$content = get_the_content();

			$qty = get_post_meta($current_post, 'delminco_qty', true);
			$formula = get_post_meta($current_post, 'delminco_formula', true);
			$sell_buy = get_post_meta($current_post, 'delminco_sell_buy', true);
		}
	}

endwhile; endif;
wp_reset_query();

global $current_post;

$postTitleError = '';

if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

	if(trim($_POST['postTitle']) === '') {
		$postTitleError = 'Please enter a title.';
		$hasError = true;
	} else {
		$postTitle = trim($_POST['postTitle']);
	}

	$post_information = array(
		'ID' => $current_post,
		'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
		'post_content' => esc_attr(strip_tags($_POST['postContent'])),
		'post-type' => 'suply',
		'post_status' => 'pending'
	);

	$post_id = wp_update_post($post_information);

	if($post_id)
	{

		// Update Custom Meta
		update_post_meta($post_id, 'delminco_qty', esc_attr(strip_tags($_POST['delmincoQty'])));
		update_post_meta($post_id, 'delminco_formula', esc_attr(strip_tags($_POST['delmincoFormula'])));
		update_post_meta($post_id, 'delminco_sell_buy', esc_attr(strip_tags($_POST['delmincoSellBuy'])));

		wp_redirect( home_url() ); exit;
	}

}

?>

<?php get_header(); ?>
<?php 

	$l = et_page_config();

?>

<?php do_action( 'et_page_heading' ); ?>

	<div class="container content-page">
		<div class="page-content sidebar-position-<?php esc_attr_e( $l['sidebar'] ); ?>">
			<div class="row">

				<div class="content <?php esc_attr_e( $l['content-class'] ); ?>">

	
				<table class="insert-form">
					<form action="" id="primaryPostForm" method="POST">
					
						<fieldset>
							<tr>
								<td><label for="postTitle"><?php _e('Post\'s Title:', 'delminco') ?></label></td>

								<td><input type="text" name="postTitle" id="postTitle" value="<?php echo $title; ?>" class="required" /></td>
							</tr>
						</fieldset>

						<?php if($postTitleError != '') { ?>
							<span class="error"><?php echo $postTitleError; ?></span>
							<div class="clearfix"></div>
						<?php } ?>

						<fieldset>
							<tr>			
								<td><label for="postContent"><?php _e('Post\'s Content:', 'delminco') ?></label></td>

								<td><textarea name="postContent" id="postContent" rows="8" cols="30"><?php echo $content; ?></textarea></td>
							</tr>
						</fieldset>

						<fieldset>
							<tr>
								<td><label for="delmincoQty"><?php _e('Product Quantity:', 'delminco') ?></label></td>

								<td><input type="text" name="delmincoQty" id="delmincoQty" value="<?php if($qty) echo $qty;?>" /></td>
							</tr>
						</fieldset>

						<fieldset>
							<tr>
								<td><label for="delmincoFormula"><?php _e('Product Formula:', 'delminco') ?></label></td>

								<td><input type="text" name="delmincoFormula" id="delmincoFormula" value="<?php if($formula) echo $formula;?>" /></td>
							</tr>
						</fieldset>

						<fieldset>
							<tr>
								<td><label for="delmincoSellBuy"><?php _e('For Sell or Buy:', 'delminco') ?></label></td>

								<td><select name="delmincoSellBuy" id="delmincoSellBuy" >
										<option value="sell" <?php if($sell_buy && $sell_buy == 'sell' ){echo  "selected";}?> ><?php echo __('Sell','delminco');?></option>
										<option value="buy" <?php if($sell_buy && $sell_buy == 'buy' ){echo "selected";}?> ><?php echo __('Buy','delminco');?></option>
								</select></td>
							</tr>
						</fieldset>

						<fieldset>
							<tr>	
								<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>

								<td><input type="hidden" name="submitted" id="submitted" value="true" /></td>
								<td><button type="submit"><?php _e('Update Post', 'delminco') ?></button></td>
							</tr>
						</fieldset>

					</form>
					</table>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>


<?php get_footer(); ?>
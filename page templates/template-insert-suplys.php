<?php /* Template Name: Insert suplys */

$postTitleError = '';

if(isset($_POST['submitted']) && isset($_POST['post_nonce_field']) && wp_verify_nonce($_POST['post_nonce_field'], 'post_nonce')) {

	if(trim($_POST['postTitle']) === '') {
		$postTitleError = 'Please enter a title.';
		$hasError = true;
	} else {
		$postTitle = trim($_POST['postTitle']);
	}

	$post_information = array(
		'post_title' => esc_attr(strip_tags($_POST['postTitle'])),
		'post_content' => esc_attr(strip_tags($_POST['postContent'])),
		'post_type' => 'suply',
		'post_status' => 'pending'
	);

	$post_id = wp_insert_post($post_information);

	if($post_id)
	{

		// Update Custom Meta
		update_post_meta($post_id, 'delminco_qty', esc_attr(strip_tags($_POST['delmincoQty'])));
		update_post_meta($post_id, 'delminco_formula', esc_attr(strip_tags($_POST['delmincoFormula'])));
		update_post_meta($post_id, 'delminco_sell_buy', esc_attr(strip_tags($_POST['delmincoSellBuy'])));

		// Redirect
		wp_redirect( home_url() ); exit;
	}

} ?>

<?php get_header(); ?>
<?php 

	$l = et_page_config();

?>

<?php do_action( 'et_page_heading' ); ?>

	<div class="container content-page">
		<div class="page-content sidebar-position-<?php esc_attr_e( $l['sidebar'] ); ?>">
			<div class="row">

				<div class="content <?php esc_attr_e( $l['content-class'] ); ?>">

				<form action="" id="primaryPostForm" method="POST">

					<table class="insert-form">
						<fieldset>
							<tr>
								<td><label for="postTitle"><?php _e('Post\'s Title:', 'delminco') ?></label></td>

								<td><input type="text" name="postTitle" id="postTitle" value="<?php if(isset($_POST['postTitle'])) echo $_POST['postTitle'];?>" class="required" /></td>
							</tr>
						</fieldset>

							<?php if($postTitleError != '') { ?>
								<span class="error"><?php echo $postTitleError; ?></span>
								<div class="clearfix"></div>
							<?php } ?>

						<fieldset>
							<tr>			
								<td><label for="postContent"><?php _e('Post\'s Content:', 'delminco') ?></label></td>

								<td><textarea name="postContent" id="postContent" rows="8" cols="30"><?php if(isset($_POST['postContent'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['postContent']); } else { echo $_POST['postContent']; } } ?></textarea></td>
							</tr>
						</fieldset>

						<fieldset>
							<tr>
								<td><label for="delmincoQty"><?php _e('Product Quantity:', 'delminco') ?></label></td>

								<td><input type="text" name="delmincoQty" id="delmincoQty" value="<?php if(isset($_POST['delmincoQty'])) echo $_POST['delmincoQty'];?>" /></td>
							</tr>
						</fieldset>

						<fieldset>
							<tr>
								<td><label for="delmincoFormula"><?php _e('Product Formula:', 'delminco') ?></label></td>

								<td><input type="text" name="delmincoFormula" id="delmincoFormula" value="<?php if(isset($_POST['delmincoFormula'])) echo $_POST['delmincoFormula'];?>" /></td>
							</tr>
						</fieldset>

						<fieldset>
							<tr>
								<td><label for="delmincoSellBuy"><?php _e('For Sell or Buy:', 'delminco') ?></label></td>

								<td><select name="delmincoSellBuy" id="delmincoSellBuy" >
										<option value="sell" <?php if(isset($_POST['delmincoSellBuy']) && $_POST['delmincoSellBuy'] == 'sell' ){echo "selected";}?> ><?php echo __('Sell','delminco');?></option>
										<option value="buy" <?php if(isset($_POST['delmincoSellBuy']) && $_POST['delmincoSellBuy'] == 'buy' ){echo "selected";}?> ><?php echo __('Buy','delminco');?></option>
								</select></td>
							</tr>
						</fieldset>
					</table>

					<fieldset>
						
						<?php wp_nonce_field('post_nonce', 'post_nonce_field'); ?>

						<input type="hidden" name="submitted" id="submitted" value="true" />
						<button type="submit"><?php _e('Add Post', 'delminco') ?></button>

					</fieldset>

				</form>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>


<?php get_footer(); ?>
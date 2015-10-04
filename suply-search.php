<?php 
/**
 * The main template file.
 *
 */
	get_header();
?>
<?php 

	$l = et_page_config();

	$content_layout = etheme_get_option('blog_layout');

	$full_width = false;

	if($content_layout == 'mosaic') {
		$full_width = etheme_get_option('blog_full_width');
	}

	if($content_layout == 'mosaic') {
		$content_layout = 'grid';
	}
?>

<?php do_action( 'et_page_heading' ); ?>

<div class="<?php echo (!$full_width) ? 'container' : 'blog-full-width'; ?>">
	<div class="page-content sidebar-position-<?php esc_attr_e( $l['sidebar'] ); ?>">
		<div class="row">
			<div class="content <?php esc_attr_e( $l['content-class'] ); ?>">
		
				<div class="<?php if ($content_layout == 'grid'): ?>blog-masonry row<?php endif ?>">
					<?php if(have_posts()): ?>
						<table>
							<tbody>
								<tr>
									<th><?php echo __('For','delminco');?></th>
									<th><?php echo __('Name','delminco');?></th>
									<th><?php echo __('Date','delminco');?></th>
									<th><?php echo __('Country','delminco');?></th>
									<th><?php echo __('ID','delminco');?></th>
								</tr>
							
								<?php while(have_posts()) : the_post(); ?>
									<tr>
										<td>
											<?php $sell_buy = get_post_meta(get_the_ID(),'_suply_sell_buy',1);
	                    					if($sell_buy == 'sell'){
	                    						$sell_buy_icon = '<i class="fa fa-arrow-up"></i>'.'   '.__('Sell','delminco');
	                    					} elseif($sell_buy == 'buy') {
	                    						$sell_buy_icon = '<i class="fa fa-arrow-down"></i>'.'   '.__('Buy','delminco');
	                    					}
	                    					echo $sell_buy_icon;?>
										</td>
										<td><a href="<?php echo get_the_permalink();?>"><?php the_title();?></a></td>
										<td><?php the_time(get_option('date_format'));?></td>
										<td>
											<?php
												$user_id = get_the_author_ID();
											 	$country_array = country_array();
											 	$country_code = get_usermeta($user_id,'billing_country',1);
											 	echo '<span class="f32">'.$country_array($country_code).' '.'<span class="flag '.strtolower($country_code).'"></span></span>';
											?>
										</td>
										<td><?php echo get_the_ID();?></td>
									</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					<?php else: ?>

						<h1><?php _e('No posts were found!', ET_DOMAIN) ?></h1>

					<?php endif; ?>
				</div>

				<div class="articles-nav">
					<?php delminco_pagination(); ?>
				</div>

			</div>

			<?php get_sidebar(); ?>
		</div>
	</div>
</div>

<?php
	get_footer();
?>
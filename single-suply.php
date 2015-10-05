<?php 
	get_header();
?>

<?php 

    $l = et_page_config();
    
    $blog_slider = etheme_get_option('blog_slider');
    
    
    
    
?>


<?php do_action( 'et_page_heading' ); ?>

<div class="container">
	<div class="page-content sidebar-position-<?php esc_attr_e( $l['sidebar'] ); ?>">
		<div class="row">
			
			<div class="content <?php esc_attr_e( $l['content-class'] ); ?>">
				<?php if(have_posts()): while(have_posts()) : the_post(); ?>
				
					<article <?php post_class('blog-post post-single'); ?> id="post-<?php the_ID(); ?>" >
					
					    <h2><?php the_title();?></h2>

					    				    
					    <div class="suply-info">
                        	<table class="suply-single-table">
                    			<tr><td><strong><?php 
                    					
                    					$sell_buy = get_post_meta($post->ID,'_suply_sell_buy',1);
                    					if($sell_buy == 'sell'){
	                    						$sell_buy_icon = '<i class="fa fa-arrow-up"></i>'.'   '.__('Sell','delminco');
                    					} elseif($sell_buy == 'buy') {
                    						$sell_buy_icon = '<i class="fa fa-arrow-down"></i>'.'   '.__('Buy','delminco');
                    					}
                    					echo __('for : ','delminco').'</strong></td><td>'.' '.$sell_buy_icon;
                    				?>
                    			</td></tr>
								
								<tr><td><strong>
									<?php
										$user_id = get_the_author_ID();
											 	$country_array = country_array();
											 	$country_code = get_usermeta($user_id,'billing_country',1);
											 	
									 	echo __('From Country : ','delminco').'</strong></td><td><span class="f16 country-flag"><span class="flag '.strtolower($country_code).'"></span>'.'  '.$country_array[$country_code].'</span>';
									?>
								</td></tr>

                    			<tr><td><strong><?php echo __('Alloys : ','delminco').'</strong></td><td>'.get_post_meta($post->ID,'_suply_alloys',1);?></td></tr>
                    			<tr><td><strong><?php echo __('Quantity : ','delminco').'</strong></td><td>'.get_post_meta($post->ID,'_suply_qty',1);?></td></tr>
                    			<tr><td><strong><?php echo __('Submit Date : ','delminco').'</strong></td><td>'.get_the_time(get_option('date_format')); ?></td></tr> 
                    			<tr><td><strong><?php echo __('Product ID : ','delminco').'</strong></td><td>'.$post->ID;?></td></tr>
                    			<tr><td><strong>
                    							<?php 
                    									
                    									$suply_cat = get_term( $suply_cat_id, 'suply_cat' );
                    									echo __('Product Category : ','delminco').'</strong></td><td>'.get_the_term_list( $post->ID, 'suply_cat', ' ', '  -  ' );
                    								?>
                    			</td></tr>

                    			<?php if(current_user_can('edit_posts') || $user_id == get_current_user_id()){ ?>
								
									<tr><td><strong><?php echo __('Price : ','delminco').'</strong></td><td>'.get_post_meta($post->ID,'_suply_price',1);?></td></tr>
										<?php 
											$user = get_userdata( $user_id );
											$resuma = get_usermeta($user_id,'_suply_user_resume',1);
											if($sell_buy == 'sell'){
												echo '<tr><td><strong>'.__('Seller Name : ','delminco').'</strong></td><td>'.$user->user_nicename.'</td></tr>';
												echo '<tr><td><strong>'.__('Seller Phone : ','delminco').'</strong></td><td>'.get_usermeta($user_id,'billing_phone',1).'</td></tr>';
												echo '<tr><td><strong>'.__('Seller Email : ','delminco').'</strong></td><td>'.$user->user_email.'</td></tr>';
												if($resuma !== ''){
													echo '<tr><td><strong>'.__('Seller Catalog : ','delminco').'</strong></td><td><a href="'.get_usermeta($user_id,'_suply_user_resume',1).'">'.__('Download Catalog','delminco').'</a></td></tr>';
												}
											                 						
		                					} elseif($sell_buy == 'buy') {
		                						echo '<tr><td><strong>'.__('Buyer Name : ','delminco').'</strong></td><td>'.$user->user_nicename.'</td></tr>';
												echo '<tr><td><strong>'.__('Buyer Phone : ','delminco').'</strong></td><td>'.get_usermeta($user_id,'billing_phone',1).'</td></tr>';
												echo '<tr><td><strong>'.__('Buyer Email : ','delminco').'</strong></td><td>'.$user->user_email.'</td></tr>';
												if($resuma !== ''){
													echo '<tr><td><strong>'.__('Buyer Catalog : ','delminco').'</strong></td><td><a href="'.get_usermeta($user_id,'_suply_user_resume',1).'">'.__('Download Catalog','delminco').'</a></td></tr>';
												}
		                					}
                    			
                    			 }?>
                        		
                        	</table>
                        </div>

					    <div class="content-article">
                           <!--  <hr/> -->
                            <?php the_content(); ?>
                        </div>

                        <div class="enquery-form">
							<hr/>
							<h4 class="enquery-title">
								<?php if($sell_buy == 'sell'){
	                    						echo __('Buy Product From Seller','delminco');
                    					} elseif($sell_buy == 'buy') {
                    						echo __('Sell product to Buyer','delminco');
                    					}
                    			?>
							</h4>
							<?php
							// contact form 7 shortcodes for product enquery.
							 if(ICL_LANGUAGE_CODE == 'en'){
					        	echo do_shortcode('[contact-form-7 id="15354"]');
					         }else{
					         	echo do_shortcode('[contact-form-7 id="15352"]');
					         } ?>
                        </div>
                 
					
						<?php if(etheme_get_option('post_share')): ?>
							<div class="share-post">
								<?php echo do_shortcode('[share title="'.__('Share Product', 'delminco').'"]'); ?>
							</div>
						<?php endif; ?>
						
						<?php if(etheme_get_option('posts_links')): ?>
							<?php etheme_project_links(array()); ?>
						<?php endif; ?>
						
						
						
						
						<?php if(etheme_get_option('post_related')): ?>
							<div class="related-posts">
								<?php et_get_related_posts(); ?>
							</div>
						<?php endif; ?>
					
					</article>


				<?php endwhile; else: ?>

					<h1><?php _e('No products were found!', ETHEME_DOMAIN) ?></h1>

				<?php endif; ?>

				

			</div>

			<?php get_sidebar(); ?>

		</div>

	</div>
</div>
	
<?php
	get_footer();
?>
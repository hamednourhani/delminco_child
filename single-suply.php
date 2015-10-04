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
                        	<table class="suply-ifo-table">
                    			<tr><td><strong><?php 
                    					
                    					$sell_buy = get_post_meta($post->ID,'_suply_sell_buy',1);
                    					if($sell_buy == 'sell'){
	                    						$sell_buy_icon = '<i class="fa fa-arrow-up"></i>'.'   '.__('Sell','delminco');
                    					} elseif($sell_buy == 'buy') {
                    						$sell_buy_icon = '<i class="fa fa-arrow-down"></i>'.'   '.__('Buy','delminco');
                    					}
                    					echo __('for : ','delminco').'</strong>'.' '.$sell_buy_icon;
                    				?>
                    			</td></tr>
								
								<tr><td><strong>
									<?php
									 	$country_code = get_usermeta($user_id,'_suplyer_country_code',1);
									 	$country_array = country_array();
									 	echo __('From Country : ','delminco').'</strong>'.'<span class="f32"><span class="flag '.$country_code.'"></span></span>  '.$country_array[$country_code].'  </span>';
									?>
								</td></tr>

                    			<tr><td><strong><?php echo __('Alloys : ','delminco').'</strong>'.get_post_meta($post->ID,'_suply_alloys',1);?></td></tr>
                    			<tr><td><strong><?php echo __('Quantity : ','delminco').'</strong>'.get_post_meta($post->ID,'_suply_qty',1);?></td></tr>
                    			<tr><td><strong><?php echo __('Submit Date : ','delminco').'</strong>'.the_time(get_option('date_format')); ?></td></tr> 
                    			<tr><td><strong><?php echo __('Product ID : ','delminco').$post->ID.'</strong>';?></td></tr>
                    			<tr><td><strong>
                    							<?php 
                    									
                    									$suply_cat = get_term( $suply_cat_id, 'suply_cat' );
                    									echo __('Product Category : ','delminco').'</strong>'.get_the_term_list( $post->ID, 'suply_cat', ' ', '  -  ' );
                    								?>
                    			</td></tr>
                        		
                        	</table>
                        </div>

					    <div class="content-article">
                           <!--  <hr/> -->
                            <?php the_content(); ?>
                        </div>

                        <div class="enquery-form">
							<hr/>
							<h4 class="enquery-title">
								<?php echo __('Product  Enquery  Form','delminco');?>
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
								<?php echo do_shortcode('[share title="'.__('Share Product', ETHEME_DOMAIN).'"]'); ?>
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

					<h1><?php _e('No posts were found!', ETHEME_DOMAIN) ?></h1>

				<?php endif; ?>

				

			</div>

			<?php get_sidebar(); ?>

		</div>

	</div>
</div>
	
<?php
	get_footer();
?>
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

					    <div class="meta-post">
                            <?php _e('Posted on', ETHEME_DOMAIN) ?>
                            <?php the_time(get_option('date_format')); ?> 
                            <?php _e('at', ETHEME_DOMAIN) ?> 
                            <?php the_time(get_option('time_format')); ?>
                                
                    	</div>
					    
					    <div class="suply-info">
                        	<table class="suply-ifo-table">
                    			<tr><td><?php 
                    					
                    					$sell_buy = get_post_meta($post->ID,'_suply_sell_buy');
                    					if($sell_buy == 'sell'){
                    						$sell_buy_class = '';
                    					} else {
                    						$sell_buy_class = '';
                    					}
                    					echo __('for : ','delminco').$sell_buy.'<i class="fa '.$sell_buy_class.'"></i>';
                    				?></td></tr>

                    			<tr><td><?php echo __('Alloys : ','delminco').get_post_meta($post->ID,'_suply_alloys');?></td></tr>
                    			<tr><td><?php echo __('Quantity : ','delminco').get_post_meta($post->ID,'_suply_qty');?></td></tr>
                    			<tr><td><?php echo __('Product ID : ','delminco').$post->ID;?></td></tr>
                        		
                        	</table>
                        </div>

					    <div class="content-article">
                            <hr/>
                            <?php the_content(); ?>
                        </div>

                        <div class="enquery-form">
							<hr/>
							<h4 class="enquery-title">
								<?php echo __('Product Enquery Form','delminco');?>
							</h4>
							<?php if(ICL_LANGUAGE_CODE == 'en'){
					        	echo do_shortcode('[contact-form id="3"]');
					         }else{
					         	echo do_shortcode('[contact-form id="4"]');
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
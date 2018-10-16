<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package destino
 */
global $redux_destino;
?>
<!-- Sidebar -->
				<div class="col-lg-3">
					<div class="sidebar">
						<div class="sidebar_search">
							<input type="search" class="sidebar_search_input" placeholder="Search">
						</div>
						<?php $last_news = new WP_Query(array('post_type' => 'post','posts_per_page' => 3 ));
							if ( $last_news->have_posts() ) :

							/* Start the Loop */
							while ( $last_news->have_posts() ) :
								$last_news->the_post();
								$img = $redux_destino['destino-sidebar-img1']['url'];?>
						<!-- Featured Posts -->
						<div class="sidebar_featured">
							<!-- Featured Post -->
							<div class="sidebar_featured_post">
								<div class="sidebar_featured_image"><?php echo the_post_thumbnail('news_mini_img'); ?></div>
								<div class="sidebar_featured_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
								<div class="sidebar_featured_meta">
									<ul>
										<li>by <?php the_author(); ?></li>
										<li><?php echo get_the_date('', $post->ID); ?></li>
										<li><?php echo get_comments_number(get_the_ID()); if(get_comments_number(get_the_ID()) == 1){ ?> comment <?php }else{ ?> comments <?php } ?></li>
									</ul>
								</div>
							</div>
						</div>
						<?php
						endwhile;
					endif;
					wp_reset_query();
					?>
						<!-- Offers -->
						<div class="sidebar_offers">
							<?php $offer = new WP_Query(array('post_type' => 'offers'));
							if ( $offer->have_posts() ) :
								/* Start the Loop */
								$img = $redux_destino['destino-sidebar-img']['url'];
								if( $redux_destino['destino-sidebar-offer1']){
									$post = $redux_destino['destino-sidebar-offer1'];?>
							<!-- Offer -->
							<div class="sidebar_offer">
								<div class="sidebar_offer_background" style="background-image:url(<?php if($img){ echo $img; }else{ echo get_template_directory_uri(); ?>/images/last.jpg<?php } ?>)"></div>
								<div class="sidebar_offer_content">
									<div class="sidebar_offer_destination"><?php the_title() ?></div>
									<div class="sidebar_offer_percent"><?php if($redux_destino['destino-sidebar-percent1']) echo $redux_destino['destino-sidebar-percent1']; else echo 0;?>%</div>
									<div class="sidebar_offer_title"><?php echo __('Last Minute Offer','destino'); ?></div>
									<div class="sidebar_offer_text"><?php echo $redux_destino['destino-sidebar-desc1']; ?></div>
									<div class="sidebar_offer_button"><a href="<?php the_permalink(); ?>"><?php echo __('See Offer','destino'); ?></a></div>
								</div>
							</div>
							<?php
								}
								if( $redux_destino['destino-sidebar-offer2']){
									$post = $redux_destino['destino-sidebar-offer2'];?>
							<!-- Offer -->
							<div class="sidebar_offer">
								<div class="sidebar_offer_background" style="background-image:url(<?php if($img){ echo $img; }else{ echo get_template_directory_uri(); ?>/images/last.jpg<?php } ?>)"></div>
								<div class="sidebar_offer_content">
									<div class="sidebar_offer_destination"><?php the_title() ?></div>
									<div class="sidebar_offer_percent"><?php if($redux_destino['destino-sidebar-percent2']) echo $redux_destino['destino-sidebar-percent2']; else echo 0;?>%</div>
									<div class="sidebar_offer_title"><?php echo __('Last Minute Offer','destino'); ?></div>
									<div class="sidebar_offer_text"><?php echo $redux_destino['destino-sidebar-desc2']; ?></div>
									<div class="sidebar_offer_button"><a href="<?php the_permalink(); ?>"><?php echo __('See Offer','destino'); ?></a></div>
								</div>
							</div>
							<?php
								}
							endif;
							wp_reset_query();
							?>
						</div>
						<?php
						if( $redux_destino['destino-quote-text']){
						?>
						<!-- Sidebar Quote -->
						<div class="sidebar_quote">
							<div class="quote_box"><img src="<?php echo get_template_directory_uri();?>/images/quote.png" alt=""></div>
							<?php
							$str = $redux_destino['destino-quote-text'];
							$pos = strpos($str," ");
							$str1 = substr($str,0,$pos);
							$str2 = substr($str,$pos);
							?>
							<div class="quote_text"><span>“<?php echo $str1; ?></span> <?php echo $str2; ?>”</div>
						</div>
					<?php } ?>
					</div>
				</div>

			</div>
		</div>
	</div>

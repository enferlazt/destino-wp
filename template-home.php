<?php
/**
 * Template name: Homepage
 */

wp_enqueue_style( 'destino_home_styles', get_template_directory_uri() . '/layouts/main_styles.css', array('bootstrap', 'font-awesome', 'OwlCarousel2-2.2.1-carousel', 'OwlCarousel2-2.2.1-owl.theme.default', 'OwlCarousel2-2.2.1-animate', 'magnific-popup'));
wp_enqueue_style( 'destino_home_responsive', get_template_directory_uri() . '/layouts/responsive.css', array('bootstrap', 'font-awesome', 'OwlCarousel2-2.2.1-carousel', 'OwlCarousel2-2.2.1-owl.theme.default', 'OwlCarousel2-2.2.1-animate', 'magnific-popup'));
get_header();

?>

	<div class="top">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center"><?php 
					if(get_post_meta($post->ID, "des_offers_title" , true))
						echo "<h2>" . get_post_meta($post->ID, "des_offers_title" , true) . "</h2>";
					if(get_post_meta($post->ID, "des_offers_subtitle" , true))
						echo "<div>" . get_post_meta($post->ID, "des_offers_subtitle" , true) . "</div>";
					?>
					</div>
				</div>
			</div>
			<div class="row top_content">
				<?php
				$offer = new WP_Query(array('post_type' => 'offers'));
				for($j = 1; $j < 5; $j++){
					if ( $offer->have_posts() ) :
					/* Start the Loop */
					
						if(get_post_meta($post->ID, "des_offer$j" , true)){
							$post = get_post_meta($post->ID, "des_offer$j" , true);

				?>
				<div class="col-lg-3 col-md-6 top_col">

					<!-- Top Destination Item -->
					<div class="top_item">
						<a href="<?php the_permalink(); ?>">
							<div class="top_item_image"><?php the_post_thumbnail('offers_img'); ?></div>
							<div class="top_item_content">
								<div class="top_item_price">From $<?php if(get_post_meta(get_the_ID(), 'des_price', true)){ echo get_post_meta(get_the_ID(), 'des_price', true); }else{ echo 0; }?></div>
								<div class="top_item_text"><?php the_title();?>
									<div class="rating rating_5" data-rating="5">
									<?php
									$stars = get_the_terms( $post->ID, 'stars' );
									foreach( $stars as $star ){
										$n = $star->name;
										for($i = 0; $i < 5; $i++){
											if($n == 0){
												echo "<i class='fa fa-star-o'></i>";
											}
											elseif($n == 0.5){
												echo "<i class='fa fa-star-half-o'></i>";
												$n = $n - 0.5;
											}
											else{
												echo "<i class='fa fa-star'></i>";
												$n = $n - 1;
											}
										}
									}
									?>
									</div>
								</div>
								<div class="top_item_text"><?php $location = get_the_terms( $post->ID, 'location' );
																foreach ($location as $loc) {
																 	echo $loc->name;
																 } ?></div>
							</div>
						</a>
					</div>
				</div>
				<?php }

			endif;
			wp_reset_query();
			} ?>
			</div>
		</div>
	</div>

	<!-- Last -->

	<div class="last">
		<!-- Image by https://unsplash.com/@thanni -->
		<div class="last_background parallax-window" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri() . '/images/last.jpg';?>" data-speed="0.8"></div>
		<?php if ( $offer->have_posts() ) :
			/* Start the Loop */?>
		<div class="container">
			<div class="row">
				<div class="last_logo"><img src="<?php echo get_template_directory_uri() . 'images/last_logo.png';?>" alt=""></div>
				<?php
								$img = $redux_destino['destino-sidebar-img']['url'];
								if( $redux_destino['destino-sidebar-offer1']){
									$post = $redux_destino['destino-sidebar-offer1'];?>
				<div class="col-lg-6 last_col">
					<div class="last_item">
						<div class="last_item_content">
							<div class="last_subtitle"><?php the_title() ?></div>
							<div class="last_percent"><?php if($redux_destino['destino-sidebar-percent1']) echo $redux_destino['destino-sidebar-percent1']; else echo 0;?>%</div>
							<div class="last_title"><?php echo __('Last Minute Offer','destino'); ?></div>
							<div class="last_text"><?php echo $redux_destino['destino-sidebar-desc1']; ?></div>
							<div class="button last_button"><a href="<?php the_permalink(); ?>"><?php echo __('See Offer','destino'); ?></a></div>
						</div>
					</div>
				</div><?php
								}
								if( $redux_destino['destino-sidebar-offer2']){
									$post = $redux_destino['destino-sidebar-offer2'];?>
				<div class="col-lg-6 last_col">
					<div class="last_item">
						<div class="last_item_content">
							<div class="last_subtitle"><?php the_title() ?></div>
							<div class="last_percent"><?php if($redux_destino['destino-sidebar-percent2']) echo $redux_destino['destino-sidebar-percent2']; else echo 0;?>%</div>
							<div class="last_title"><?php echo __('Last Minute Offer','destino'); ?></div>
							<div class="last_text"><?php echo $redux_destino['destino-sidebar-desc2']; ?></div>
							<div class="button last_button"><a href="<?php the_permalink(); ?>"><?php echo __('See Offer','destino'); ?></a></div>
						</div>
					</div>
				</div>
			
				<?php
					}
				endif;
				wp_reset_query();
				?>
			</div>
		</div>
	</div>

	<!-- Video -->
	<?php if(get_post_meta($post->ID, "des_video" , true) == 0){ ?>
	<div class="video_section d-flex flex-column align-items-center justify-content-center">
		<!-- Image by https://unsplash.com/@peecho -->
		<div class="video_background parallax-window" data-parallax="scroll" data-image-src="<?php if(get_post_meta($post->ID, 'des_video_background' , true)) echo get_post_meta($post->ID, "des_video_background" , true); else echo get_template_directory_uri() . '/images/video.jpg';?>" data-speed="0.8"></div>
		<div class="video_content">
			<?php if(get_post_meta($post->ID, "des_video_title" , true))
				echo '<div class="video_title">' . get_post_meta($post->ID, "des_video_title" , true) . '</div>';
			if(get_post_meta($post->ID, "des_video_subtitle" , true))
				echo '<div class="video_subtitle">' . get_post_meta($post->ID, "des_video_subtitle" , true) . '</div>'; ?>
			<div class="video_play">
				<a  class="video" href="<?php echo get_post_meta($post->ID, 'des_video_url' , true); ?>">
					<svg version="1.1" id="Layer_1" class="play_button" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="140px" height="140px" viewBox="0 0 140 140" enable-background="new 0 0 140 140" xml:space="preserve">
						<g id="Layer_2">
							<circle class="play_circle" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" cx="70.333" cy="69.58" r="68.542"/>
							<polygon class="play_triangle" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" points="61.583,56 61.583,84.417 84.75,70 	"/>
						</g>
					</svg>
				</a>
			</div>
		</div>
	</div>
<?php } ?>

	<!-- Popular -->

	<div class="popular">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center"><?php 
					if(get_post_meta($post->ID, "des_excursions_title" , true))
						echo "<h2>" . get_post_meta($post->ID, "des_excursions_title" , true) . "</h2>";
					if(get_post_meta($post->ID, "des_excursions_subtitle" , true))
						echo "<div>" . get_post_meta($post->ID, "des_excursions_subtitle" , true) . "</div>";
					?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="popular_content d-flex flex-md-row flex-column flex-wrap align-items-md-center align-items-start justify-content-md-between justify-content-start">
						
						<!-- Popular Item -->
						<?php
						$excursions = new WP_Query(array('post_type' => 'excursions', 'posts_per_page' => 2));
							for($j = 1; $j < 3; $j++){
								if ( $excursions->have_posts() ) :
								/* Start the Loop */
								
									if(get_post_meta($post->ID, "des_excursion$j" , true)){
										$post = get_post_meta($post->ID, "des_excursion$j" , true);

						?>
						<div class="popular_item">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail('excursion_img'); ?>
								<div class="popular_item_content">
									<div class="popular_item_price">From $<?php if(get_post_meta(get_the_ID(), 'des_price', true)){ echo get_post_meta(get_the_ID(), 'des_price', true); }else{ echo 0; }?></div>
									<div class="popular_item_title"><?php the_title(); ?></div>
								</div>
							</a>	
						</div>
						<?php }
							endif;
						wp_reset_query();
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Special -->
			<?php 
			$offer = new WP_Query(array('post_type' => 'offers'));
			if ( $offer->have_posts() ) :
				if(get_post_meta(get_the_ID(), 'des_tax', true)){
					?>
	<div class="special">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center"><?php 
					if(get_post_meta($post->ID, "des_loc_title" , true))
						echo "<h2>" . get_post_meta($post->ID, "des_loc_title" , true) . "</h2>";
					if(get_post_meta($post->ID, "des_loc_subtitle" , true))
						echo "<div>" . get_post_meta($post->ID, "des_loc_subtitle" , true) . "</div>";
					?>
					</div>
				</div>
			</div>
		</div>
		<div class="special_content">
			<div class="special_slider_container">
				<div class="owl-carousel owl-theme special_slider">
			<?php
					$metabox = get_post_meta(get_the_ID(), 'des_tax', true);
					$location = get_the_terms( $post->ID, 'location' );
					foreach ($metabox as $meta) {
						foreach ($location as $loc) {
						 	if($meta == $loc->term_id){
						 	$upload_image = get_term_meta($loc->term_id, 'term_image', true);
						 	$url = get_term_link($loc->name, 'location');
					?>
					<!-- Special Offers Item -->
					<div class="owl-item">
						<div class="special_item d-flex flex-column align-items-center justify-content-center">
							<div class="special_item_background"><img src="<?php if($upload_image){ echo $upload_image; }else echo get_template_directory_uri() . '/images/special_1.jpg';?>"></div>
							<div class="special_item_content text-center">
								<div class="special_category"><?php echo __('Visiting', 'destino'); ?></div>
								<div class="special_title"><a href="<?php echo $url; ?>"><?php echo $loc->name; ?></a></div>
							</div>
						</div>
					</div>
					<?php 
							}
						}
					}
					wp_reset_query();
					 ?>
				</div>

				<div class="special_slider_nav d-flex flex-column align-items-center justify-content-center">
					<img src="<?php echo get_template_directory_uri() . '/images/special_slider.png';?>" alt="">
				</div>
			</div>
		</div>
	</div>
<?php
				}
			endif;

get_footer();
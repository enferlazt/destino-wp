<?php

get_header();
global $wp_query;
wp_enqueue_style( 'destino_offers_styles', get_template_directory_uri() . '/layouts/offers_styles.css', array('font-awesome', 'bootstrap'));
wp_enqueue_style( 'destino_offers_responsive', get_template_directory_uri() . '/layouts/offers_responsive.css', array('font-awesome', 'bootstrap'));
global $redux_destino;
?>

<div class="offers">
		<div class="container">
			<div class="row"><?php
			$path = $_SERVER['REQUEST_URI'];
			$link = strstr($path, '=');
			$url = substr($link, 1);
				$default_query = new WP_Query(array('post_type' => 'offers', 'location' => $url, 'posts_per_page' => 20, 'paged' => get_query_var('paged') ? get_query_var('paged') : 1));

		$wp_query = $default_query;

		if ( $default_query->have_posts() ) :?>
				<div class="col">
					<div class="section_title text-center">
						<h2><?php if($redux_destino['destino-offers-title']) echo $redux_destino['destino-offers-title'];?></h2>
						<div><?php if($redux_destino['destino-offers-subtitle']) echo $redux_destino['destino-offers-subtitle'];?></div>
					</div>
				</div>
			</div>
			<div class="row filtering_row">
				<div class="col">
					<div class="sorting_group_2 clearfix">
						<div class="sorting_icons clearfix">
							<div class="detail_view"><i class="fa fa-bars" aria-hidden="true"></i></div>
							<div class="box_view"><i class="fa fa-th-large" aria-hidden="true"></i></div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<?php


				?>
				<div class="col">
					<div class="items item_grid clearfix"><?php
			/* Start the Loop */
			while ( $default_query->have_posts() ) :
				$default_query->the_post();
				
					//if(strcasecmp($loc->name, $url) == 0 ){
				?>
				
						<!-- Item -->
						<div class="item clearfix rating_5">
							<div class="item_image"><?php the_post_thumbnail('offers_img'); ?></div>
							<div class="item_content">
								<div class="item_price">From $<?php if(get_post_meta(get_the_ID(), 'des_price', true)){ echo get_post_meta(get_the_ID(), 'des_price', true); }else{ echo 0; }?></div>
								<div class="item_title"><?php the_title(); ?></div>
								<div class="item_title"><?php   $location = get_the_terms( $post->ID, 'location' );
																foreach ($location as $loc) {
																	$url = get_term_link($loc->name, 'location');
																	echo "<a href='$url'>".$loc->name."</a>";
																}	?></div>
								<p><?php echo get_post_meta(get_the_ID(), 'des_desc', true); ?></p>
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
								<div class="item_text"><?php the_excerpt(); ?></div>
								<div class="item_more_link"><a href="<?php the_permalink(); ?>">Read More</a></div>
							</div>
						</div>
					<?php
			endwhile;
		endif;
			?>
					</div>
				</div>	
			</div>

			<div class="row">
				<div class="col">
					<?php
					bittersweet_pagination(); ?>
				</div>
			</div>
		</div>

		</div>
	</div>
<?php get_footer();
<?php
get_header();?>
	<div class="offers">
		<div class="container">
			<div class="row">
				
			
<?php		global $wp_query;
global $redux_destino;
wp_enqueue_style( 'destino_offers_styles', get_template_directory_uri() . '/layouts/offers_styles.css', array('font-awesome', 'bootstrap'));
wp_enqueue_style( 'destino_offers_responsive', get_template_directory_uri() . '/layouts/offers_responsive.css', array('font-awesome', 'bootstrap'));
		$excursions_query = new WP_Query(array('post_type' => 'excursions', 'posts_per_page' => 4, 'paged' => get_query_var('paged') ? get_query_var('paged') : 1));

		$wp_query = $excursions_query;

		if ( $excursions_query->have_posts() ) :?>
				<div class="col">
					<div class="section_title text-center">
						<h2><?php if($redux_destino['destino-excursions-title']) echo $redux_destino['destino-excursions-title'];?></h2>
						<div><?php if($redux_destino['destino-excursions-subtitle']) echo $redux_destino['destino-excursions-subtitle'];?></div>
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
				<div class="col">
					<div class="items item_grid clearfix">

			<?php
			/* Start the Loop */
			while ( $excursions_query->have_posts() ) :
				$excursions_query->the_post();
				?>
						<!-- Item -->
						<div class="item clearfix rating_5">
							<div class="item_image"><?php the_post_thumbnail('offers_img'); ?></div>
							<div class="item_content">
								<div class="item_price">From $<?php if(get_post_meta(get_the_ID(), 'des_price', true)){ echo get_post_meta(get_the_ID(), 'des_price', true); }else{ echo 0; }?></div>
								<div class="item_title"><?php the_title(); ?></div>
								<div class="item_text"><?php the_excerpt(); ?></div>
								<div class="item_more_link"><a href="<?php the_permalink(); ?>">Read More</a></div>
							</div>
						</div>

						<!-- Item -->
						
						
		
					
				<?php

			endwhile;

			?>
					</div>
				</div>	
			</div>

			<div class="row">
				<div class="col">
					<?php bittersweet_pagination(); ?>
				</div>
			</div>
		</div>
				<?php
		else :
			?>
			<br/>
			<br/>
			<?php echo "No find excursions"; ?>
			<br/>
			<br/>
			<?php
		endif; ?>

		</div>
	</div>
<?php get_footer();
<?php
/**
 * Template name: About Template
 */
wp_enqueue_style( 'destino_about_styles', get_template_directory_uri() . '/layouts/about_styles.css', array('bootstrap', 'font-awesome'));
wp_enqueue_style( 'destino_about_responsive', get_template_directory_uri() . '/layouts/about_responsive.css', array('bootstrap', 'font-awesome'));
get_header();
?>

<!-- About -->

	<div class="about"><?php
	while ( have_posts() ) :
		the_post(); ?>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center">
						<h2><?php if(get_post_meta($post->ID, 'des_title', true)) echo get_post_meta($post->ID, 'des_title', true); ?></h2>
						<div><?php if(get_post_meta($post->ID, 'des_subtitle', true)) echo get_post_meta($post->ID, 'des_subtitle', true); ?></div>
					</div>
				</div>
			</div>
			<div class="row about_row">
				<div class="col-lg-6 about_col order-lg-1 order-2">
					<div class="about_content">
						<p><?php the_content(); ?></p>
						<?php if(get_post_meta($post->ID, 'des_read_more', true) == 0) {?>
						<div class="button about_button"><a href="#">Read More</a></div>
						<?php }else{} ?>
					</div>
				</div>
				<div class="col-lg-6 about_col order-lg-2 order-1">
					<div class="about_image">
						<img src="<?php if(get_post_meta($post->ID, 'des_image', true)){ echo get_post_meta($post->ID, 'des_image', true);} ?>" alt="">
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Milestones -->
	<?php if(get_post_meta($post->ID, 'des_new_s1', true) == 0) { ?>
	<div class="milestones">
		<div class="milestones_background parallax-window" data-parallax="scroll" data-image-src="<?php echo get_post_meta($post->ID, 'des_bg_s1', true); ?>" data-speed="0.8"></div>
		<div class="container">
			<?php if(get_post_meta($post->ID, 'des_title_s1', true) || get_post_meta($post->ID, 'des_subtitle_s1', true)){ ?>
			<div class="row">
				<div class="col">
					<div class="section_title text-center">
						<h2><?php echo get_post_meta($post->ID, 'des_title_s1', true); ?></h2>
						<div><?php echo get_post_meta($post->ID, 'des_subtitle_s1', true); ?></div>
					</div>
				</div>
			</div>
		<?php }else{} ?>
			<div class="row">
				<div class="col-lg-8 offset-lg-2">
					<div class="milestones_text">
						<p><?php echo get_post_meta($post->ID, 'des_content_s1', true); ?></p>
					</div>
				</div>
					
			</div>
			<div class="row milestones_container">
				<?php if(get_post_meta($post->ID, 'des_i_counter1', true) || get_post_meta($post->ID, 'des_int_counter1', true) || get_post_meta($post->ID, 'des_txt_counter1', true)){ ?>
				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="<?php echo get_post_meta($post->ID, 'des_i_counter1', true); ?>" alt=""></div>
						<div class="milestone_counter" data-end-value="<?php echo get_post_meta($post->ID, 'des_int_counter1', true); ?>">0</div>
						<div class="milestone_text"><?php echo get_post_meta($post->ID, 'des_txt_counter1', true); ?></div>
					</div>
				</div>
				<?php
				}else{}
				if(get_post_meta($post->ID, 'des_i_counter2', true) || get_post_meta($post->ID, 'des_int_counter2', true) || get_post_meta($post->ID, 'des_txt_counter2', true)){
				?>
				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="<?php echo get_post_meta($post->ID, 'des_i_counter2', true); ?>" alt=""></div>
						<div class="milestone_counter" data-end-value="<?php echo get_post_meta($post->ID, 'des_int_counter2', true); ?>">0</div>
						<div class="milestone_text"><?php echo get_post_meta($post->ID, 'des_txt_counter2', true); ?></div>
					</div>
				</div>
				<?php
				}else{}
				if(get_post_meta($post->ID, 'des_i_counter3', true) || get_post_meta($post->ID, 'des_int_counter3', true) || get_post_meta($post->ID, 'des_txt_counter3', true)){
				?>
				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="<?php echo get_post_meta($post->ID, 'des_i_counter3', true); ?>" alt=""></div>
						<div class="milestone_counter" data-end-value="<?php echo get_post_meta($post->ID, 'des_int_counter3', true); ?>">0</div>
						<div class="milestone_text"><?php echo get_post_meta($post->ID, 'des_txt_counter3', true); ?></div>
					</div>
				</div>
				<?php
				}else{}
				if(get_post_meta($post->ID, 'des_i_counter4', true) || get_post_meta($post->ID, 'des_int_counter4', true) || get_post_meta($post->ID, 'des_txt_counter4', true)){
				?>
				<!-- Milestone -->
				<div class="col-lg-3 milestone_col">
					<div class="milestone text-center">
						<div class="milestone_icon"><img src="<?php echo get_post_meta($post->ID, 'des_i_counter4', true); ?>" alt=""></div>
						<div class="milestone_counter" data-end-value="<?php echo get_post_meta($post->ID, 'des_int_counter4', true); ?>">0</div>
						<div class="milestone_text"><?php echo get_post_meta($post->ID, 'des_txt_counter4', true); ?></div>
					</div>
				</div>
				<?php
				}else{}
				?>
			</div>
		</div>
	</div>
<?php }else{} ?>
	<!-- Services -->

	<div class="services">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center">
						<h2>Popular services that we offer</h2>
						<div>take a look at these offers</div>
					</div>
				</div>
			</div>
			<div class="row icon_box_container">
				<?php if(get_post_meta($post->ID, 'des_i_link1', true) || get_post_meta($post->ID, 'des_title_link1', true) || get_post_meta($post->ID, 'des_content_link1', true)){
				?>
				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="<?php echo get_post_meta($post->ID, 'des_i_link1', true); ?>" class="svg" alt=""></div>
						<div class="icon_box_title"><?php echo get_post_meta($post->ID, 'des_title_link1', true); ?></div>
						<p class="icon_box_text"><?php echo get_post_meta($post->ID, 'des_content_link1', true); ?></p>
						<a href="#" class="icon_box_more">Read More</a>
					</div>
				</div>
				<?php
				}else{}
				if(get_post_meta($post->ID, 'des_i_link2', true) || get_post_meta($post->ID, 'des_title_link2', true) || get_post_meta($post->ID, 'des_content_link2', true)){
				?>
				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="<?php echo get_post_meta($post->ID, 'des_i_link2', true); ?>" class="svg" alt=""></div>
						<div class="icon_box_title"><?php echo get_post_meta($post->ID, 'des_title_link2', true); ?></div>
						<p class="icon_box_text"><?php echo get_post_meta($post->ID, 'des_content_link2', true); ?></p>
						<a href="#" class="icon_box_more">Read More</a>
					</div>
				</div>
				<?php
				}else{}
				if(get_post_meta($post->ID, 'des_i_link3', true) || get_post_meta($post->ID, 'des_title_link3', true) || get_post_meta($post->ID, 'des_content_link3', true)){
				?>
				<!-- Icon Box -->
				<div class="col-lg-4 icon_box_col">
					<div class="icon_box">
						<div class="icon_box_image"><img src="<?php echo get_post_meta($post->ID, 'des_i_link3', true); ?>" class="svg" alt=""></div>
						<div class="icon_box_title"><?php echo get_post_meta($post->ID, 'des_title_link3', true); ?></div>
						<p class="icon_box_text"><?php echo get_post_meta($post->ID, 'des_content_link3', true); ?></p>
						<a href="#" class="icon_box_more">Read More</a>
					</div>
				</div>
				<?php
				}else{}
				?>
			</div>
		</div><?php
		endwhile; // End of the loop.
		?>
	</div>

<?php get_footer();

<?php
/**
 * Template name: Contact Template
 */
wp_enqueue_style( 'destino_contact_styles', get_template_directory_uri() . '/layouts/contact_styles.css', array('font-awesome', 'bootstrap'));
wp_enqueue_style( 'destino_contact_responsive', get_template_directory_uri() . '/layouts/contact_responsive.css', array('font-awesome', 'bootstrap'));
get_header();
?>
	<div class="contact"><?php
	while ( have_posts() ) :
		the_post(); ?>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="contact_title"><?php if(get_post_meta($post->ID, 'des_title', true)) echo get_post_meta($post->ID, 'des_title', true); ?></div>
					<div class="contact_subtitle"><?php if(get_post_meta($post->ID, 'des_subtitle', true)) echo get_post_meta($post->ID, 'des_subtitle', true); ?></div>
				</div>
			</div>
			<div class="row contact_content">
				<div class="col-lg-5">
					<div class="contact_text">
						<?php the_content(); ?>
					</div>
					<div class="contact_info">
						<?php
						$address = get_post_meta($post->ID, 'des_address', true);
						$phone = get_post_meta($post->ID, 'des_phone', true);
						$email = get_post_meta($post->ID, 'des_email', true);
						if(!$address && !$phone && !$email){}
						else{ ?>
						<div class="contact_info_box">i</div>
						<div class="contact_info_container">
							<div class="contact_info_content">
								<ul>
									<?php if($address){ ?>
									<li>Address: <?php echo $address; ?></li>
									<?php }else{}
									if($phone){ ?>
									<li>Phone: <?php echo $phone; ?></li>
									<?php }else{}
									if($email){ ?>
									<li>Email: <?php echo $email; ?></li>
									<?php }else{} ?>
								</ul>
							</div>
						</div>
					<?php } ?>
					</div>
				</div>
				<div class="col-lg-7">
					<div class="contact_form_container">
						<?php
						$form = get_post_meta($post->ID, 'des_formcode', true);
						echo do_shortcode($form);
						?>
					</div>
				</div>
			</div>
			<div class="row contact_map">
				<!-- Google Map -->

				<div class="col">
					<?php
							$map = '[pw_map address="'.$address.'"]';
							echo do_shortcode($map);
							?>
				</div>

			</div>
		</div><?php
		endwhile; // End of the loop.
		?>
	</div>
<?php get_footer();

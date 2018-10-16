<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package destino
 */
wp_enqueue_style( 'destino_contact_styles', get_template_directory_uri() . '/layouts/contact_styles.css', array('font-awesome', 'bootstrap'));
wp_enqueue_style( 'destino_contact_responsive', get_template_directory_uri() . '/layouts/contact_responsive.css', array('font-awesome', 'bootstrap'));
get_header();
?>

<div class="contact"><?php
	while ( have_posts() ) :
		the_post(); ?>
		<div class="container">
			<div class="row contact_content">
				<div class="col-lg-12">
					<div class="contact_text">
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		</div><?php
		endwhile; // End of the loop.
		?>
	</div>
<?php
get_footer();

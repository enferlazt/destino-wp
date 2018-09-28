<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package destino
 */

get_header();
wp_enqueue_style( 'destino_offers_styles', get_template_directory_uri() . '/layouts/offers_styles.css', array('font-awesome', 'bootstrap'));
wp_enqueue_style( 'destino_offers_responsive', get_template_directory_uri() . '/layouts/offers_responsive.css', array('font-awesome', 'bootstrap'));
?>
	<div class="offers">
		<div class="container">
			<div class="row">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );
			$map = '[pw_map address="' . get_post_meta($post->ID, 'des_map', true) . '"]';
			echo do_shortcode($map);
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
		</div>
	</div>
<?php
get_footer();

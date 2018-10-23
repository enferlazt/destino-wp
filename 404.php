<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package destino
 */
wp_enqueue_style( 'destino_contact_styles', get_template_directory_uri() . '/layouts/contact_styles.css', array('font-awesome', 'bootstrap'));
wp_enqueue_style( 'destino_contact_responsive', get_template_directory_uri() . '/layouts/contact_responsive.css', array('font-awesome', 'bootstrap'));
get_header();
?>
	<div class="contact">
		<div class="container">
			<div class="row">
				<div class="col">

					<section class="error-404 not-found">
						<header class="page-header">
							<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'destino' ); ?></h1>
						</header><!-- .page-header -->

					</section><!-- .error-404 -->

				</div>
			</div>
		</div>
	</div>

<?php
get_footer();

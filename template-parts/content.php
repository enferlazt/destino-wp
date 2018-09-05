<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package destino
 */

?>

				<div class="col">
					<div class="section_title text-center">
		<?php
		if ( is_singular() ) :
			the_title( '<h2>', '</h2>' );
		else :
			the_title( '<h2"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;
		if ( 'post' === get_post_type() ) :
			?>
			<div>
				<?php
				destino_posted_on();?>
			</div>
			<div>
				<?php
				destino_posted_by();
				?>
			</div><!-- .entry-meta -->
					
		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php destino_post_thumbnail(); ?>
					</div>
				</div>
			</div>
	<div class="entry-content">
		<?php
		the_content( sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'destino' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		) );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'destino' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->


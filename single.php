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
				<div class="col">
		<?php
		while ( have_posts() ) :
			the_post();

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
		echo strip_shortcode_gallery( get_the_content() );

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'destino' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content --><?php
			$map = '[pw_map address="' . get_post_meta($post->ID, 'des_map', true) . '"]';
			if ( get_post_gallery() ) :
	            $gallery = get_post_gallery( get_the_ID(), false );
	            /* Loop through all the image and output them one by one */?>
	            <div class="popup-gallery">
	            <?php
	            foreach( $gallery['src'] as $src ) : 
	            	$url = substr_replace($src, '', -12, -4 );
	            	?>
	            	<a href="<?php echo $url; ?>" class="image-popup-vertical-fit">
	                <img src="<?php echo $src; ?>" class="my-custom-class" alt="Gallery image" />
	                </a>
	                <?php
	            endforeach;
	            ?>
	        	</div>
	            <?php
	        endif;
			echo do_shortcode($map);
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
				</div>
			</div>
		</div>
	</div>
<?php
get_footer();

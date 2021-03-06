<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package destino
 */
wp_enqueue_style( 'destino_offers_styles', get_template_directory_uri() . '/layouts/offers_styles.css', array('font-awesome', 'bootstrap'));
wp_enqueue_style( 'destino_offers_responsive', get_template_directory_uri() . '/layouts/offers_responsive.css', array('font-awesome', 'bootstrap'));
get_header();

?>
	<div class="offers">
		<div class="container">
			<div class="row">
				<div class="col">
		<?php
		while ( have_posts() ) :
			the_post();

?>					<div class="section_title text-center thumbnail">
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
				echo the_time('F jS, Y');
				?>
			</div>
			<div>
				<?php
				destino_posted_by();
				?>
			</div><!-- .entry-meta --><?php
		endif;
		if ( 'offers' === get_post_type() ) :
			?>
			<div>
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
			<div>
				<?php
				$location = get_the_terms( $post->ID, 'location' );
				foreach ($location as $loc) {
					$url = get_term_link($loc->name, 'location');
				 	echo "<a href='$url'>".$loc->name."</a>";
				} ?>
			</div><?php
		endif;
		?>

	<?php destino_post_thumbnail(); ?>
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
	</div><!-- .entry-content -->
	<div class="col">
		<div class="section_title text-center gallery">
	<?php
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
	        ?>
			        	</div>
	        <?php
			if(is_singular('offers') || is_singular('excursions')){
				$map = '[pw_map address="' . get_post_meta($post->ID, 'des_map', true) . '"]';
				echo do_shortcode($map);
			}
			?><?php
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

<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package destino
 */

?>

<article id="post-<?php the_ID(); ?>">
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php
			echo get_the_date('', $post->ID).',';
			destino_posted_by();
			?>
		</div><!-- .entry-meta -->
		<?php endif;
		if ( 'offers' === get_post_type() ) :
			?>
			<div>
				From $<?php if(get_post_meta(get_the_ID(), 'des_price', true)){ echo get_post_meta(get_the_ID(), 'des_price', true); }else{ echo 0; }?>
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
		if ( 'excursions' === get_post_type() ) :
			?>
			<div>
				From $<?php if(get_post_meta(get_the_ID(), 'des_price', true)){ echo get_post_meta(get_the_ID(), 'des_price', true); }else{ echo 0; }?>
			</div><?php
		endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-<?php the_ID(); ?> -->

<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package destino
 */


wp_enqueue_style( 'destino_offers_styles', get_template_directory_uri() . '/layouts/news_styles.css', array('bootstrap', 'font-awesome'));
wp_enqueue_style( 'destino_offers_responsive', get_template_directory_uri() . '/layouts/news_responsive.css', array('bootstrap', 'font-awesome'));

get_header();
?>
	<div class="news">
		<div class="container">
			<div class="row">

				<!-- News Posts -->
				<div class="col-lg-9">
					<div class="news_posts">
						

		<?php
		if ( have_posts() ) :

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				?>
						<!-- News Post -->
						<div class="news_post">
							<div class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>
							<div class="post_meta">
								<ul>
									<li>by <?php the_author(); ?></li>
									<li><?php echo get_the_date('', $post->ID); ?></li>
									<li><?php echo get_comments_number(get_the_ID()); if(get_comments_number(get_the_ID()) == 1){ ?> comment <?php }else{ ?> comments <?php } ?></li>
								</ul>
							</div>
							<div class="post_image">
								<?php echo the_post_thumbnail(); ?>
							</div>
							<div class="post_text">
								<p><?php the_excerpt(); ?></p>
							</div>
						</div>
<?php
			endwhile;?>
			<div class="row">
				<div class="col">
					<?php bittersweet_pagination(); ?>
				</div>
			</div>
<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
					</div>
				</div>
<?php
get_sidebar();
get_footer();

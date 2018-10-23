<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package destino
 */
global $search;
if($search == 3){
wp_enqueue_style( 'destino_news_styles', get_template_directory_uri() . '/layouts/news_styles.css', array('bootstrap', 'font-awesome'));
wp_enqueue_style( 'destino_news_responsive', get_template_directory_uri() . '/layouts/news_responsive.css', array('bootstrap', 'font-awesome'));
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
									<li><?php destino_posted_by(); ?></li>
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
}else{
wp_enqueue_style( 'destino_news_styles', get_template_directory_uri() . '/layouts/news_styles.css', array('font-awesome', 'bootstrap'));
wp_enqueue_style( 'destino_news_responsive', get_template_directory_uri() . '/layouts/news_responsive.css', array('font-awesome', 'bootstrap'));
get_header();
?>
<div class="news">
	<div class="container">
		<div class="row">
			<section id="primary" class="content-area">
				<main id="main" class="site-main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php
						/* translators: %s: search query. */
						printf( esc_html__( 'Search Results for: %s', 'destino' ), '<span>' . get_search_query() . '</span>' );
						?>
					</h1>
				</header><!-- .page-header -->

				<?php
				/* Start the Loop */
				while ( have_posts() ) :
					the_post();

					/**
					 * Run the loop for the search to output the results.
					 * If you want to overload this in a child theme then include a file
					 * called content-search.php and that will be used instead.
					 */
					get_template_part( 'template-parts/content', 'search' );

				endwhile;

	?>			</main>
			</section>
		</div>
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
get_footer();
}

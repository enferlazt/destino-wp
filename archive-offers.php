<?php
wp_enqueue_style( 'destino_offers_styles', get_template_directory_uri() . '/layouts/offers_styles.css', array('font-awesome', 'bootstrap'));
wp_enqueue_style( 'destino_offers_responsive', get_template_directory_uri() . '/layouts/offers_responsive.css', array('font-awesome', 'bootstrap'));
get_header();?>
<div class="offers">
	<div class="container">
		<div class="row">
				
			
<?php	filters_offers($_POST); ?>

	</div>
</div>
<?php get_footer();
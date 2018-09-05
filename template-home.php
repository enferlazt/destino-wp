<?php
/**
 * Template name: Homepage
 */

wp_enqueue_style( 'destino_home_styles', get_template_directory_uri() . '/layouts/main_styles.css', array('bootstrap', 'font-awesome', 'OwlCarousel2-2.2.1-carousel', 'OwlCarousel2-2.2.1-owl.theme.default', 'OwlCarousel2-2.2.1-animate', 'magnific-popup'));
wp_enqueue_style( 'destino_home_responsive', get_template_directory_uri() . '/layouts/responsive.css', array('bootstrap', 'font-awesome', 'OwlCarousel2-2.2.1-carousel', 'OwlCarousel2-2.2.1-owl.theme.default', 'OwlCarousel2-2.2.1-animate', 'magnific-popup'));
get_header();

?>

	<div class="top">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center">
						<h2>Top destinations in Europe</h2>
						<div>take a look at these offers</div>
					</div>
				</div>
			</div>
			<div class="row top_content">

				<div class="col-lg-3 col-md-6 top_col">

					<!-- Top Destination Item -->
					<div class="top_item">
						<a href="#">
							<div class="top_item_image"><img src="<?php echo get_template_directory_uri() . '/images/top_1.jpg'; ?>" alt="https://unsplash.com/@sgabriel"></div>
							<div class="top_item_content">
								<div class="top_item_price">From $890</div>
								<div class="top_item_text">Paris, France</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 top_col">

					<!-- Top Destination Item -->
					<div class="top_item">
						<a href="#">
							<div class="top_item_image"><img src="<?php echo get_template_directory_uri() . '/images/top_2.jpg';?>" alt="https://unsplash.com/@jenspeter"></div>
							<div class="top_item_content">
								<div class="top_item_price">From $890</div>
								<div class="top_item_text">Italian Riviera</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 top_col">

					<!-- Top Destination Item -->
					<div class="top_item">
						<a href="#">
							<div class="top_item_image"><img src="<?php echo get_template_directory_uri() . '/images/top_3.jpg';?>" alt="https://unsplash.com/@anikindimitry"></div>
							<div class="top_item_content">
								<div class="top_item_price">From $890</div>
								<div class="top_item_text">Cinque Terre</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-lg-3 col-md-6 top_col">

					<!-- Top Destination Item -->
					<div class="top_item">
						<a href="#">
							<div class="top_item_image"><img src="<?php echo get_template_directory_uri() . '/images/top_4.jpg';?>" alt="https://unsplash.com/@hellolightbulb"></div>
							<div class="top_item_content">
								<div class="top_item_price">From $890</div>
								<div class="top_item_text">Santorini, Greece</div>
							</div>
						</a>	
					</div>
				</div>

			</div>
		</div>
	</div>

	<!-- Last -->

	<div class="last">
		<!-- Image by https://unsplash.com/@thanni -->
		<div class="last_background parallax-window" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri() . '/images/last.jpg';?>" data-speed="0.8"></div>

		<div class="container">
			<div class="row">
				<div class="last_logo"><img src="<?php echo get_template_directory_uri() . 'images/last_logo.png';?>" alt=""></div>
				<div class="col-lg-6 last_col">
					<div class="last_item">
						<div class="last_item_content">
							<div class="last_subtitle">maldive</div>
							<div class="last_percent">50%</div>
							<div class="last_title">Last Minute Offer</div>
							<div class="last_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pulvinar sed mauris eget tincidunt. Sed lectus nulla, tempor vel.</div>
							<div class="button last_button"><a href="offers.html">See Offer</a></div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 last_col">
					<div class="last_item">
						<div class="last_item_content">
							<div class="last_subtitle">bali</div>
							<div class="last_percent">38%</div>
							<div class="last_title">Last Minute Offer</div>
							<div class="last_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer pulvinar sed mauris eget tincidunt. Sed lectus nulla, tempor vel.</div>
							<div class="button last_button"><a href="offers.html">See Offer</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Video -->

	<div class="video_section d-flex flex-column align-items-center justify-content-center">
		<!-- Image by https://unsplash.com/@peecho -->
		<div class="video_background parallax-window" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri() . '/images/video.jpg';?>" data-speed="0.8"></div>
		<div class="video_content">
			<div class="video_title">A day on the island</div>
			<div class="video_subtitle">A trip organized by Destino's team</div>
			<div class="video_play">
				<a  class="video" href="https://www.youtube.com/watch?v=BzMLA8YIgG0">
					<svg version="1.1" id="Layer_1" class="play_button" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="140px" height="140px" viewBox="0 0 140 140" enable-background="new 0 0 140 140" xml:space="preserve">
						<g id="Layer_2">
							<circle class="play_circle" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" cx="70.333" cy="69.58" r="68.542"/>
							<polygon class="play_triangle" fill="none" stroke="#FFFFFF" stroke-width="2" stroke-miterlimit="10" points="61.583,56 61.583,84.417 84.75,70 	"/>
						</g>
					</svg>
				</a>
			</div>
		</div>
	</div>

	<!-- Popular -->

	<div class="popular">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center">
						<h2>Popular destinations in 2018</h2>
						<div>take a look at these offers</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="popular_content d-flex flex-md-row flex-column flex-wrap align-items-md-center align-items-start justify-content-md-between justify-content-start">
						
						<!-- Popular Item -->
						<div class="popular_item">
							<a href="offers.html">
								<img src="<?php echo get_template_directory_uri() . '/images/popular_1.jpg';?>" alt="image by Egzon Bytyqi">
								<div class="popular_item_content">
									<div class="popular_item_price">From $890</div>
									<div class="popular_item_title">Turkey</div>
								</div>
							</a>	
						</div>

						<!-- Popular Item -->
						<div class="popular_item">
							<a href="offers.html">
								<img src="images/popular_2.jpg" alt="https://unsplash.com/@michael75">
								<div class="popular_item_content">
									<div class="popular_item_price">From $890</div>
									<div class="popular_item_title">Hawai</div>
								</div>
							</a>	
						</div>

						<!-- Popular Item -->
						<div class="popular_item">
							<a href="offers.html">
								<img src="images/popular_3.jpg" alt="https://unsplash.com/@sapegin">
								<div class="popular_item_content">
									<div class="popular_item_price">From $890</div>
									<div class="popular_item_title">Ireland</div>
								</div>
							</a>	
						</div>

						<!-- Popular Item -->
						<div class="popular_item">
							<a href="offers.html">
								<img src="images/popular_4.jpg" alt="https://unsplash.com/@kensuarez">
								<div class="popular_item_content">
									<div class="popular_item_price">From $890</div>
									<div class="popular_item_title">Thailand</div>
								</div>
							</a>
						</div>

						<!-- Popular Item -->
						<div class="popular_item">
							<a href="offers.html">
								<img src="images/popular_5.jpg" alt="https://unsplash.com/@noahbasle">
								<div class="popular_item_content">
									<div class="popular_item_price">From $890</div>
									<div class="popular_item_title">Croatia</div>
								</div>
							</a>
						</div>

						<!-- Popular Item -->
						<div class="popular_item">
							<a href="offers.html">
								<img src="images/popular_6.jpg" alt="https://unsplash.com/@seb">
								<div class="popular_item_content">
									<div class="popular_item_price">From $890</div>
									<div class="popular_item_title">Bali</div>
								</div>
							</a>
						</div>

						<!-- Popular Item -->
						<div class="popular_item">
							<a href="offers.html">
								<img src="images/popular_7.jpg" alt="https://unsplash.com/@nevenkrcmarek">
								<div class="popular_item_content">
									<div class="popular_item_price">From $890</div>
									<div class="popular_item_title">France</div>
								</div>
							</a>	
						</div>

						<!-- Popular Item -->
						<div class="popular_item">
							<a href="offers.html">
								<img src="images/popular_8.jpg" alt="https://unsplash.com/@bergeryap87">
								<div class="popular_item_content">
									<div class="popular_item_price">From $890</div>
									<div class="popular_item_title">Vietnam</div>
								</div>
							</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Special -->

	<div class="special">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="section_title text-center">
						<h2>Special offers</h2>
						<div>take a look at these offers</div>
					</div>
				</div>
			</div>
		</div>
		<div class="special_content">
			<div class="special_slider_container">
				<div class="owl-carousel owl-theme special_slider">
					
					<!-- Special Offers Item -->
					<div class="owl-item">
						<div class="special_item">
							<div class="special_item_background"><img src="<?php echo get_template_directory_uri() . '/images/special_1.jpg';?>" alt="https://unsplash.com/@garciasaldana_"></div>
							<div class="special_item_content text-center">
								<div class="special_category">Visiting</div>
								<div class="special_title"><a href="offers.html">Indonesia</a></div>
							</div>
						</div>
					</div>

					<!-- Special Offers Item -->
					<div class="owl-item">
						<div class="special_item d-flex flex-column align-items-center justify-content-center">
							<div class="special_item_background"><img src="<?php echo get_template_directory_uri() . '/images/special_2.jpg';?>" alt="https://unsplash.com/@varshesh"></div>
							<div class="special_item_content text-center">
								<div class="special_category">Culture</div>
								<div class="special_title"><a href="offers.html">India</a></div>
							</div>
						</div>
					</div>

					<!-- Special Offers Item -->
					<div class="owl-item">
						<div class="special_item d-flex flex-column align-items-center justify-content-center">
							<div class="special_item_background"><img src="<?php echo get_template_directory_uri() . '/images/special_3.jpg'?>" alt="https://unsplash.com/@paulgilmore_"></div>
							<div class="special_item_content text-center">
								<div class="special_category">Sunbathing</div>
								<div class="special_title"><a href="offers.html">Thailand</a></div>
							</div>
						</div>
					</div>

					<!-- Special Offers Item -->
					<div class="owl-item">
						<div class="special_item d-flex flex-column align-items-center justify-content-center">
							<div class="special_item_background"><img src="<?php echo get_template_directory_uri() . '/images/special_4.jpg';?>" alt="https://unsplash.com/@hellolightbulb"></div>
							<div class="special_item_content text-center">
								<div class="special_category">Visiting</div>
								<div class="special_title"><a href="offers.html">Bali</a></div>
							</div>
						</div>
					</div>

					<!-- Special Offers Item -->
					<div class="owl-item">
						<div class="special_item d-flex flex-column align-items-center justify-content-center">
							<div class="special_item_background"><img src="<?php echo get_template_directory_uri() . '/images/special_5.jpg';?>" alt="https://unsplash.com/@dnevozhai"></div>
							<div class="special_item_content text-center">
								<div class="special_category">Visiting</div>
								<div class="special_title"><a href="offers.html">France</a></div>
							</div>
						</div>
					</div>

				</div>

				<div class="special_slider_nav d-flex flex-column align-items-center justify-content-center">
					<img src="<?php echo get_template_directory_uri() . '/images/special_slider.png';?>" alt="">
				</div>
			</div>
		</div>
	</div>
<?php

get_footer();
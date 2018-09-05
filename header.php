<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package destino
 */
global $redux_destino;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body>

<?php $logo = $redux_destino['destino-logo']['url'];
if(is_front_page()){
	$slogan_image = $redux_destino['destino-slogan-image']['url'];
	?>
<div class="super_container">
	
	<!-- Header -->

	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="header_container d-flex flex-row align-items-center justify-content-start">

						<!-- Logo -->
						<div class="logo_container">
							<div class="logo_image"><img src= "<?php if($logo){ echo $logo;}else echo '#'; ?>" alt=""></div>
							<div class="logo">
								<div><?php if($redux_destino['destino-title']) echo $redux_destino['destino-title']; else echo "Destino";?></div>
								<div><?php if($redux_destino['destino-subtitle']){ echo $redux_destino['destino-subtitle'];}else{ echo ""; } ?></div>
							</div>
						</div>

						<!-- Main Navigation -->
						<nav class="main_nav ml-auto">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu',
								'menu_id'        => false,
								'menu_class'	 => 'main_nav_list',
								'container' 	 => 'ul',
							) );
							?>
						</nav>

						<!-- Search -->
						<div class="search">
							<form action="#" class="search_form">
								<input type="search" name="search_input" class="search_input ctrl_class" required="required" placeholder="Keyword">
								<button type="submit" class="search_button ml-auto ctrl_class"><img src="<?php echo get_template_directory_uri() . '/images/search.png'; ?>" alt=""></button>
							</form>
						</div>

						<!-- Hamburger -->
						<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>

					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu_container menu_mm">

		<!-- Menu Close Button -->
		<div class="menu_close_container">
			<div class="menu_close"></div>
		</div>

		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="menu menu_mm">
				<div class="menu_search_form_container">
					<form action="#" id="menu_search_form">
						<input type="search" class="menu_search_input menu_mm">
						<button id="menu_search_submit" class="menu_search_submit" type="submit"><img src="<?php echo get_template_directory_uri() . '/images/search_2.png'; ?>" alt=""></button>
					</form>
				</div>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'mobile-menu',
					'menu_id'        => false,
					'menu_class'	 => 'menu_list menu_mm',
					'container' 	 => 'ul',
				) );
				?>
				<!-- Menu Social -->
				
				<div class="menu_social_container menu_mm">
					<ul class="menu_social menu_mm">
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					</ul>
				</div>

				<div class="menu_copyright menu_mm">Colorlib All rights reserved</div>
			</div>

		</div>

	</div>
	
	<!-- Home -->

	<div class="home">
		<div class="home_background" style="background-image:url(<?php if($slogan_image) echo $slogan_image; else echo get_template_directory_uri() . '/images/home.jpg)'; ?>"></div>
		<div class="home_content">
			<div class="home_content_inner">
				<div class="home_text_large"><?php if($redux_destino['destino-short-slogan']) echo $redux_destino['destino-short-slogan']; else echo "";?></div>
				<div class="home_text_small"><?php if($redux_destino['destino-slogan']) echo $redux_destino['destino-slogan']; else echo "";?></div>
			</div>
		</div>
	</div>

	<!-- Find Form -->

	<div class="find">
		<!-- Image by https://unsplash.com/@garciasaldana_ -->
		<div class="find_background parallax-window" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri() . '/images/find.jpg'; ?>" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="find_title text-center"><?php if($redux_destino['destino-search-form-title']) echo $redux_destino['destino-search-form-title']; else echo "Find the Adventure of a lifetime";?></div>
				</div>
				<div class="col-12">
					<div class="find_form_container">
						<form method="post" action="<?php echo home_url("/offers"); ?>" id="find_form" class="find_form d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-md-between justify-content-start flex-wrap">
							<div class="find_item">
								<div>Location:</div>
								<?php
								$current_location = get_terms('location');
								?>
								<select name="location" id="adventure" class="dropdown_item_select find_input">
								<?php foreach ($current_location as $location) {?>
									<option><?php echo $location->name; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="find_item">
								<div>Hotel stars:</div>
								<?php
								$current_stars = get_terms('stars');
								?>
								<select name="stars" id="adventure" class="dropdown_item_select find_input">
								<?php foreach ($current_stars as $stars) {?>
									<option><?php echo $stars->name; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="find_item">
								<div>Price from:</div>
								<input type="text" class="destination find_input" name="min_price" required="required" placeholder="Min price">
							</div>
							<div class="find_item">
								<div>Price to:</div>
								<input type="text" class="destination find_input" name="max_price" required="required" placeholder="Max price">
							</div>
							<button class="button find_button" >Find</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}elseif(is_home() && ! is_front_page()){
	$offers_image = $redux_destino['destino-offers-bg']['url'];
?>
<div class="super_container">
	
	<!-- Header -->

	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="header_container d-flex flex-row align-items-center justify-content-start">

						<!-- Logo -->
						<div class="logo_container">
							<div class="logo_image"><img src= "<?php if($logo){ echo $logo;}else echo '#'; ?>" alt=""></div>
							<div class="logo">
								<div><?php if($redux_destino['destino-title']) echo $redux_destino['destino-title']; else echo "Destino";?></div>
								<div><?php if($redux_destino['destino-subtitle']){ echo $redux_destino['destino-subtitle'];}else{ echo ""; } ?></div>
							</div>
						</div>

						<!-- Main Navigation -->
						<nav class="main_nav ml-auto">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu',
								'menu_id'        => false,
								'menu_class'	 => 'main_nav_list',
								'container' 	 => 'ul',
							) );
							?>
						</nav>

						<!-- Search -->
						<div class="search">
							<form action="#" class="search_form">
								<input type="search" name="search_input" class="search_input ctrl_class" required="required" placeholder="Keyword">
								<button type="submit" class="search_button ml-auto ctrl_class"><img src="<?php echo get_template_directory_uri() . '/images/search.png'; ?>" alt=""></button>
							</form>
						</div>

						<!-- Hamburger -->
						<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>

					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu_container menu_mm">

		<!-- Menu Close Button -->
		<div class="menu_close_container">
			<div class="menu_close"></div>
		</div>

		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="menu menu_mm">
				<div class="menu_search_form_container">
					<form action="#" id="menu_search_form">
						<input type="search" class="menu_search_input menu_mm">
						<button id="menu_search_submit" class="menu_search_submit" type="submit"><img src="<?php echo get_template_directory_uri() . '/images/search_2.png'; ?>" alt=""></button>
					</form>
				</div>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'mobile-menu',
					'menu_id'        => false,
					'menu_class'	 => 'menu_list menu_mm',
					'container' 	 => 'ul',
				) );
				?>
				<!-- Menu Social -->
				
				<div class="menu_social_container menu_mm">
					<ul class="menu_social menu_mm">
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					</ul>
				</div>

				<div class="menu_copyright menu_mm">Colorlib All rights reserved</div>
			</div>

		</div>

	</div>
	
	<!-- Home -->

	<div class="home">
		<!-- Image by https://unsplash.com/@peecho -->
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php if($offers_image){ echo $offers_image; }else{ echo get_template_directory_uri() . '/images/offers.jpg';} ?>" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_content">
						<div class="home_content_inner">
							<div class="home_title"><?php single_post_title();?></div>
							<?php echo get_breadcrumbs(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>

	<!-- Find Form -->

	<div class="find">
		<!-- Image by https://unsplash.com/@garciasaldana_ -->
		<div class="find_background_container prlx_parent">
			<div class="find_background prlx" style="background-image:url(<?php echo get_template_directory_uri() . '/images/find.jpg'; ?>)"></div>
		</div>
		<!-- <div class="find_background parallax-window" data-parallax="scroll" data-image-src="images/find.jpg" data-speed="0.8"></div> -->
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="find_title text-center"><?php if($redux_destino['destino-search-form-title']) echo $redux_destino['destino-search-form-title']; else echo "Find the Adventure of a lifetime";?></div>
				</div>
				<div class="col-12">
					<div class="find_form_container">
						<form method="post" action="<?php echo home_url("/offers");?>" id="find_form" class="find_form d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-md-between justify-content-start flex-wrap">
							<div class="find_item">
								<div>Location:</div>
								<?php
								$current_location = get_terms('location');
								?>
								<select name="location" id="adventure" class="dropdown_item_select find_input">
								<?php foreach ($current_location as $location) {?>
									<option><?php echo $location->name; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="find_item">
								<div>Hotel stars:</div>
								<?php
								$current_stars = get_terms('stars');
								?>
								<select name="stars" id="adventure" class="dropdown_item_select find_input">
								<?php foreach ($current_stars as $stars) {?>
									<option><?php echo $stars->name; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="find_item">
								<div>Price from:</div>
								<input type="text" class="destination find_input" name="min_price" required="required" placeholder="Min price">
							</div>
							<div class="find_item">
								<div>Price to:</div>
								<input type="text" class="destination find_input" name="max_price" required="required" placeholder="Max price">
							</div>
							<button class="button find_button">Find</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
}elseif(is_post_type_archive('offers') || is_post_type_archive('excursions')){
	$offers_image = $redux_destino['destino-offers-bg']['url'];
?>
<div class="super_container">
	
	<!-- Header -->

	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="header_container d-flex flex-row align-items-center justify-content-start">

						<!-- Logo -->
						<div class="logo_container">
							<div class="logo_image"><img src= "<?php if($logo){ echo $logo;}else echo '#'; ?>" alt=""></div>
							<div class="logo">
								<div><?php if($redux_destino['destino-title']) echo $redux_destino['destino-title']; else echo "Destino";?></div>
								<div><?php if($redux_destino['destino-subtitle']){ echo $redux_destino['destino-subtitle'];}else{ echo ""; } ?></div>
							</div>
						</div>

						<!-- Main Navigation -->
						<nav class="main_nav ml-auto">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu',
								'menu_id'        => false,
								'menu_class'	 => 'main_nav_list',
								'container' 	 => 'ul',
							) );
							?>
						</nav>

						<!-- Search -->
						<div class="search">
							<form action="#" class="search_form">
								<input type="search" name="search_input" class="search_input ctrl_class" required="required" placeholder="Keyword">
								<button type="submit" class="search_button ml-auto ctrl_class"><img src="<?php echo get_template_directory_uri() . '/images/search.png'; ?>" alt=""></button>
							</form>
						</div>

						<!-- Hamburger -->
						<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>

					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu_container menu_mm">

		<!-- Menu Close Button -->
		<div class="menu_close_container">
			<div class="menu_close"></div>
		</div>

		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="menu menu_mm">
				<div class="menu_search_form_container">
					<form action="#" id="menu_search_form">
						<input type="search" class="menu_search_input menu_mm">
						<button id="menu_search_submit" class="menu_search_submit" type="submit"><img src="<?php echo get_template_directory_uri() . '/images/search_2.png'; ?>" alt=""></button>
					</form>
				</div>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'mobile-menu',
					'menu_id'        => false,
					'menu_class'	 => 'menu_list menu_mm',
					'container' 	 => 'ul',
				) );
				?>
				<!-- Menu Social -->
				
				<div class="menu_social_container menu_mm">
					<ul class="menu_social menu_mm">
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					</ul>
				</div>

				<div class="menu_copyright menu_mm">Colorlib All rights reserved</div>
			</div>

		</div>

	</div>
	
	<!-- Home -->

	<div class="home">
		<!-- Image by https://unsplash.com/@peecho -->
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php if($offers_image){ echo $offers_image; }else{ echo get_template_directory_uri() . '/images/offers.jpg';} ?>" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_content">
						<div class="home_content_inner">
							<div class="home_title"><?php $postType = get_post_type_object(get_post_type());
							if ($postType) {
							    echo esc_html($postType->labels->singular_name);
							} ?></div>
							<?php echo get_breadcrumbs(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>

	<!-- Find Form -->

	<div class="find">
		<!-- Image by https://unsplash.com/@garciasaldana_ -->
		<div class="find_background_container prlx_parent">
			<div class="find_background prlx" style="background-image:url(<?php echo get_template_directory_uri() . '/images/find.jpg'; ?>)"></div>
		</div>
		<!-- <div class="find_background parallax-window" data-parallax="scroll" data-image-src="images/find.jpg" data-speed="0.8"></div> -->
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="find_title text-center"><?php if($redux_destino['destino-search-form-title']) echo $redux_destino['destino-search-form-title']; else echo "Find the Adventure of a lifetime";?></div>
				</div>
				<div class="col-12">
					<div class="find_form_container">
						<form method="post" action="<?php echo home_url("/offers");?>" id="find_form" class="find_form d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-md-between justify-content-start flex-wrap">
							<div class="find_item">
								<div>Location:</div>
								<?php
								$current_location = get_terms('location');
								?>
								<select name="location" id="adventure" class="dropdown_item_select find_input">
								<?php foreach ($current_location as $location) {?>
									<option><?php echo $location->name; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="find_item">
								<div>Hotel stars:</div>
								<?php
								$current_stars = get_terms('stars');
								?>
								<select name="stars" id="adventure" class="dropdown_item_select find_input">
								<?php foreach ($current_stars as $stars) {?>
									<option><?php echo $stars->name; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="find_item">
								<div>Price from:</div>
								<input type="text" class="destination find_input" name="min_price" required="required" placeholder="Min price">
							</div>
							<div class="find_item">
								<div>Price to:</div>
								<input type="text" class="destination find_input" name="max_price" required="required" placeholder="Max price">
							</div>
							<button class="button find_button">Find</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php }else{
?>
<div class="super_container">
	
	<!-- Header -->

	<header class="header">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="header_container d-flex flex-row align-items-center justify-content-start">

						<!-- Logo -->
						<div class="logo_container">
							<div class="logo_image"><img src= "<?php if($logo){ echo $logo;}else echo '#'; ?>" alt=""></div>
							<div class="logo">
								<div><?php if($redux_destino['destino-title']) echo $redux_destino['destino-title']; else echo "Destino";?></div>
								<div><?php if($redux_destino['destino-subtitle']){ echo $redux_destino['destino-subtitle'];}else{ echo ""; } ?></div>
							</div>
						</div>

						<!-- Main Navigation -->
						<nav class="main_nav ml-auto">
							<?php
							wp_nav_menu( array(
								'theme_location' => 'menu',
								'menu_id'        => false,
								'menu_class'	 => 'main_nav_list',
								'container' 	 => 'ul',
							) );
							?>
						</nav>

						<!-- Search -->
						<div class="search">
							<form action="#" class="search_form">
								<input type="search" name="search_input" class="search_input ctrl_class" required="required" placeholder="Keyword">
								<button type="submit" class="search_button ml-auto ctrl_class"><img src="<?php echo get_template_directory_uri() . '/images/search.png'; ?>" alt=""></button>
							</form>
						</div>

						<!-- Hamburger -->
						<div class="hamburger ml-auto"><i class="fa fa-bars" aria-hidden="true"></i></div>

					</div>
				</div>
			</div>
		</div>
	</header>

	<!-- Menu -->

	<div class="menu_container menu_mm">

		<!-- Menu Close Button -->
		<div class="menu_close_container">
			<div class="menu_close"></div>
		</div>

		<!-- Menu Items -->
		<div class="menu_inner menu_mm">
			<div class="menu menu_mm">
				<div class="menu_search_form_container">
					<form action="#" id="menu_search_form">
						<input type="search" class="menu_search_input menu_mm">
						<button id="menu_search_submit" class="menu_search_submit" type="submit"><img src="<?php echo get_template_directory_uri() . '/images/search_2.png'; ?>" alt=""></button>
					</form>
				</div>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'mobile-menu',
					'menu_id'        => false,
					'menu_class'	 => 'menu_list menu_mm',
					'container' 	 => 'ul',
				) );
				?>
				<!-- Menu Social -->
				
				<div class="menu_social_container menu_mm">
					<ul class="menu_social menu_mm">
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li class="menu_social_item menu_mm"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
					</ul>
				</div>

				<div class="menu_copyright menu_mm">Colorlib All rights reserved</div>
			</div>

		</div>

	</div>
	
	<!-- Home -->

	<div class="home">
		<!-- Image by https://unsplash.com/@peecho -->
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="<?php if(get_post_meta(get_the_ID(), 'des_background', true)){ echo get_post_meta(get_the_ID(), 'des_background', true); }else{ echo get_template_directory_uri() . '/images/news.jpg';} ?>" data-speed="0.8"></div>
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="home_content">
						<div class="home_content_inner">
							<div class="home_title"><?php the_title(); ?></div>
							<?php echo get_breadcrumbs(); ?>
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>

	<!-- Find Form -->

	<div class="find">
		<!-- Image by https://unsplash.com/@garciasaldana_ -->
		<div class="find_background_container prlx_parent">
			<div class="find_background prlx" style="background-image:url(<?php echo get_template_directory_uri() . '/images/find.jpg'; ?>)"></div>
		</div>
		<!-- <div class="find_background parallax-window" data-parallax="scroll" data-image-src="images/find.jpg" data-speed="0.8"></div> -->
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="find_title text-center"><?php if($redux_destino['destino-search-form-title']) echo $redux_destino['destino-search-form-title']; else echo "Find the Adventure of a lifetime";?></div>
				</div>
				<div class="col-12">
					<div class="find_form_container">
						<form method="post" action="<?php echo home_url("/offers");?>" id="find_form" class="find_form d-flex flex-md-row flex-column align-items-md-center align-items-start justify-content-md-between justify-content-start flex-wrap">
							<div class="find_item">
								<div>Location:</div>
								<?php
								$current_location = get_terms('location');
								?>
								<select name="location" id="adventure" class="dropdown_item_select find_input">
								<?php foreach ($current_location as $location) {?>
									<option><?php echo $location->name; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="find_item">
								<div>Hotel stars:</div>
								<?php
								$current_stars = get_terms('stars');
								?>
								<select name="stars" id="adventure" class="dropdown_item_select find_input">
								<?php foreach ($current_stars as $stars) {?>
									<option><?php echo $stars->name; ?></option>
								<?php } ?>
								</select>
							</div>
							<div class="find_item">
								<div>Price from:</div>
								<input type="text" class="destination find_input" name="min_price" required="required" placeholder="Min price">
							</div>
							<div class="find_item">
								<div>Price to:</div>
								<input type="text" class="destination find_input" name="max_price" required="required" placeholder="Max price">
							</div>
							<button class="button find_button">Find</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }?>
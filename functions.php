<?php
/**
 * destino functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package destino
 */

if ( ! function_exists( 'destino_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function destino_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on destino, use a find and replace
		 * to change 'destino' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'destino', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu' => esc_html__( 'Primary', 'destino' ),
			'mobile-menu' => esc_html__( 'Mobile menu', 'destino' ),
		) );

		function atg_menu_classes($classes, $item, $args) {
		  if($args->theme_location == 'menu') {
		    $classes[] = 'main_nav_item';
		  }
		  return $classes;
		}
		add_filter('nav_menu_css_class', 'atg_menu_classes', 1, 3);

		function special_nav_class ($classes, $item) {
		    if (in_array('current-menu-item', $classes) ){
		        $classes[] = 'active';
		    }
		    return $classes;
		}
		add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

		function atg_menu_classes_mobile($classes, $item, $args) {
		  if($args->theme_location == 'mobile-menu') {
		    $classes[] = 'menu_item menu_mm';
		  }
		  return $classes;
		}
		add_filter('nav_menu_css_class', 'atg_menu_classes_mobile', 1, 3);
		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'destino_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_image_size( 'offers_img', 285, 390 );
		add_image_size( 'news_mini_img', 210 );
		add_image_size( 'excursion_img', 510, 384 );
	}
endif;
add_action( 'after_setup_theme', 'destino_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function destino_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'destino_content_width', 640 );
}
add_action( 'after_setup_theme', 'destino_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function destino_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'destino' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'destino' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'destino_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function destino_scripts() {

/* styles */

	wp_enqueue_style( 'destino-style', get_stylesheet_uri() );

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/layouts/bootstrap4/bootstrap.min.css');

	wp_enqueue_style( 'OwlCarousel2-2.2.1-carousel', get_template_directory_uri() . '/plugins/OwlCarousel2-2.2.1/owl.carousel.css');
	wp_enqueue_style( 'OwlCarousel2-2.2.1-owl.theme.default', get_template_directory_uri() . '/plugins/OwlCarousel2-2.2.1/owl.theme.default.css');
	wp_enqueue_style( 'OwlCarousel2-2.2.1-animate', get_template_directory_uri() . '/plugins/OwlCarousel2-2.2.1/animate.css');

	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/plugins/magnific-popup/magnific-popup.css');
	
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/plugins/font-awesome-4.7.0/css/font-awesome.min.css');

	//wp_enqueue_style( 'destino_about_responsive', get_template_directory_uri() . '/layouts/about_responsive.css');
	//wp_enqueue_style( 'destino_about_styles', get_template_directory_uri() . '/layouts/about_styles.css');
	//wp_enqueue_style( 'destino_contact_responsive', get_template_directory_uri() . '/layouts/contact_responsive.css');
	//wp_enqueue_style( 'destino_contact_styles', get_template_directory_uri() . '/layouts/contact_styles.css');
	//wp_enqueue_style( 'destino_elements_responsive', get_template_directory_uri() . '/layouts/elements_responsive.css');
	//wp_enqueue_style( 'destino_elements_styles', get_template_directory_uri() . '/layouts/elements_styles.css');
	//wp_enqueue_style( 'destino_main_styles', get_template_directory_uri() . '/layouts/main_styles.css');
	//wp_enqueue_style( 'destino_news_responsive', get_template_directory_uri() . '/layouts/news_responsive.css');
	//wp_enqueue_style( 'destino_news_styles', get_template_directory_uri() . '/layouts/news_styles.css');
	//wp_enqueue_style( 'destino_offers_responsive', get_template_directory_uri() . '/layouts/offers_responsive.css');
	//wp_enqueue_style( 'destino_offers_style', get_template_directory_uri() . '/layouts/offers_style.css');
	//wp_enqueue_style( 'destino_responsive', get_template_directory_uri() . '/layouts/responsive.css');

/* scripts */

	wp_enqueue_script( 'jquery-3.2.1', get_template_directory_uri() . '/js/libs/jquery-3.2.1.min.js', array(), '', true );
	wp_enqueue_script( 'bootstrap-popper', get_template_directory_uri() . '/layouts/bootstrap4/popper.js', array(), '', true );
	wp_enqueue_script( 'bootstrap.min.js', get_template_directory_uri() . '/layouts/bootstrap4/bootstrap.min.js', array(), '', true );
	wp_enqueue_script( 'greensock-TweenMax', get_template_directory_uri() . '/plugins/greensock/TweenMax.min.js', array(), '', true );
	wp_enqueue_script( 'greensock-TimelineMax', get_template_directory_uri() . '/plugins/greensock/TimelineMax.min.js', array(), '', true );
	wp_enqueue_script( 'scrollmagic', get_template_directory_uri() . '/plugins/scrollmagic/ScrollMagic.min.js', array(), '', true );
	wp_enqueue_script( 'greensock-animation.gsap', get_template_directory_uri() . '/plugins/greensock/animation.gsap.min.js', array(), '', true );
	wp_enqueue_script( 'greensock-ScrollToPlugin', get_template_directory_uri() . '/plugins/greensock/ScrollToPlugin.min.js', array(), '', true );
	wp_enqueue_script( 'Isotope', get_template_directory_uri() . '/plugins/Isotope/isotope.pkgd.min.js', array(), '', true );
	wp_enqueue_script( 'OwlCarousel2-2.2.1-owl.carousel', get_template_directory_uri() . '/plugins/OwlCarousel2-2.2.1/owl.carousel.js', array(), '', true );
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/plugins/easing/easing.js', array(), '', true );
	wp_enqueue_script( 'parallax', get_template_directory_uri() . '/plugins/parallax-js-master/parallax.min.js', array(), '', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/plugins/magnific-popup/jquery.magnific-popup.min.js', array(), '', true );
	wp_enqueue_script( 'progressbar', get_template_directory_uri() . '/plugins/progressbar/progressbar.min.js', array(), '', true );
	//wp_enqueue_script( 'googleapis', 'https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCIwF204lFZg1y4kPSIhKaHEXMLYxxuMhA', array(), '', true );

	wp_enqueue_script( 'destino_about_custom', get_template_directory_uri() . '/js/libs/about_custom.js', array(), '', true );
	wp_enqueue_script( 'destino_contact_custom', get_template_directory_uri() . '/js/libs/contact_custom.js', array(), '', true );
	wp_enqueue_script( 'destino_custom', get_template_directory_uri() . '/js/libs/custom.js', array(), '', true );
	wp_enqueue_script( 'destino_elements_custom', get_template_directory_uri() . '/js/libs/elements_custom.js', array(), '', true );
	wp_enqueue_script( 'destino_news_custom', get_template_directory_uri() . '/js/libs/news_custom.js', array(), '', true );
	wp_enqueue_script( 'destino_offers_custom', get_template_directory_uri() . '/js/libs/offers_custom.js', array(), '', true );

	wp_enqueue_script( 'destino-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '', true );

	wp_enqueue_script( 'destino-script', get_template_directory_uri() . '/js/script.js', array(), '', true );	

	wp_enqueue_script( 'destino-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'destino_scripts' );

function admin_scripts($hook) {

	if($hook == 'post.php' || $hook == 'new-post.php' || $hook == 'page.php' || $hook == 'new-page.php'){
		wp_enqueue_script( 'destino_metaboxes',  get_template_directory_uri() . '/inc/js/metaboxes.js', array( 'jquery', 'jquery-ui-core', 'jquery-ui-datepicker', 'media-upload', 'thickbox') );
	}
}
add_action( 'admin_enqueue_scripts', 'admin_scripts', 10 );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Redux Framework
 */
require get_template_directory() . '/inc/sample-config.php';

/**
 * Breadcrumbs
 */
require get_template_directory() . '/inc/breadcrumbs.php';

/**
 * Metaboxes
 */
require get_template_directory() . '/inc/metaboxes.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

function des_custom_post_type() {
    $labels = array(
        'name'                  => __( 'Offers', 'Post type general name', 'destino' ),
        'singular_name'         => __( 'Offer', 'Post type singular name', 'destino' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'offers' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail'),
    );

    register_post_type( 'offers', $args );

    $labels = array(
        'name'                  => __( 'Excursions', 'Post type general name', 'destino' ),
        'singular_name'         => __( 'Excursion', 'Post type singular name', 'destino' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'excursions' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail'),
    );
    
    register_post_type( 'excursions', $args );
}
 
add_action( 'init', 'des_custom_post_type' );

function des_custom_taxonomy(){
	$args = array(
		'label' 	   => __('Location' ,'destino'),
		'public'	   => true,
		'rewrite'	   => false,
		'hierarchical' => true
	);
	$args_stars = array(
		'label' 	   => __('Stars' ,'destino'),
		'public'	   => true,
		'rewrite'	   => false,
		'hierarchical' => true
	);
	register_taxonomy('location', 'offers', $args);
	register_taxonomy('stars', 'offers', $args_stars);
}
add_action( 'init', 'des_custom_taxonomy', 0 );

function bittersweet_pagination() {

	global $wp_query;
	//if ( $wp_query->max_num_pages <= 1 ) return; 
	$before_page_number = 0;

	$big = 9999; // need an unlikely integer
	$pages = paginate_links( array(
	        'base' => str_replace( $big, '%_%', esc_url( get_pagenum_link( $big ) ) ),
	        'format' => '%#%',
	        'current' => max( 1, get_query_var('paged') ),
	        'total' => $wp_query->max_num_pages,
	        'prev_next' => false,
	        'type'  => 'array',
			'before_page_number'  => $before_page_number,
			'after_page_number'  => '.',
	    ) );
		//print_r(get_option('posts_per_page'));
    if( is_array( $pages ) ) {
        $paged = ( get_query_var('paged') == 0 ) ? 1 : get_query_var('paged');
        echo '<div class="pages"><ul class="pages_list">';
        foreach ( $pages as $page ) {
	                echo "<li class='page'>$page</li>&nbsp;";
	        }
        echo '</ul></div>';
    }
}

/**
 * Filters for taxonomy.
 */
require get_template_directory() . '/inc/filters-offers.php';

add_filter( 'category_link', function($a){
	return str_replace( 'category/', '', $a );
}, 99 );

add_action( 'init', 'unregister_cat_tag' );
/**
 * Removes tags from blog posts
 */
function unregister_cat_tag() {
    unregister_taxonomy_for_object_type( 'post_tag', 'post' );
    unregister_taxonomy_for_object_type( 'category', 'post' );
}

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
 
add_action( 'tgmpa_register', 'mytheme_require_plugins' );
 
function mytheme_require_plugins() {
 
    $plugins = array( 
    	array(
	        'name'      => 'Contact Form 7',
	        'slug'      => 'contact-form-7',
	        'required'  => false, // this plugin is recommended
    	),
    	array(
	        'name'      => 'Redux Framework',
	        'slug'      => 'redux-framework',
	        'required'  => false, // this plugin is recommended
    	),
     );
    $config = array( /* The array to configure TGM Plugin Activation */ );
 
    tgmpa( $plugins, $config );
 
}
function strip_shortcode_gallery( $content ) {
    preg_match_all( '/' . get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if( false !== $pos ) {
                    return substr_replace( $content, '', $pos, strlen( $shortcode[0] ) );
                }
            }
        }
    }

    return $content;
}
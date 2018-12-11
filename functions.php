<?php


/**
 * Jerry's Theme
 * This file adds functions to the Jerry's Theme.
 *
 * @package Jerrys 
 * @author  Nick Julia
 * @license GPL-2.0+
 * @link    http://www.mindheros.com/
 */


//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Jerry' );
define( 'CHILD_THEME_URL', 'http://www.mindheros.com/' );
define( 'CHILD_THEME_VERSION', '2.2.4' );

// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

//* We tell the name of our child theme
define( 'Child_Theme_Name', __( 'Jerrys', 'jerrys' ) );
//* We tell the web address of our child theme (More info & demo)
define( 'Child_Theme_Url', 'http://mindheros.com' );
//* We tell the version of our child theme
define( 'Child_Theme_Version', '1.0' );




function theme_enqueue_styles() {

    $parent_style = 'genesis';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

add_action('wp_enqueue_scripts', 'load_javascript_files');
function load_javascript_files() {
	//wp_register_script('combined-min', get_stylesheet_directory_uri() . '/combined-min.js', array('jquery'), true );
	//wp_enqueue_script('combined-min');
}


add_filter('the_content', 'specific_no_wpautop', 9);
function specific_no_wpautop($content) {
    if (is_front_page()) { // or whatever other condition you like
        remove_filter( 'the_content', 'wpautop' );
        return $content;
    } else {
        return $content;
    }
}


add_action( 'genesis_setup', 'gs_theme_setup', 15 );

//Theme Set Up Function
function gs_theme_setup() {
  
  //Enable HTML5 Support
  add_theme_support( 'html5' );

  //Enable Post Navigation
  add_action( 'genesis_after_entry_content', 'genesis_prev_next_post_nav', 5 );

  /** 
   * 01 Set width of oEmbed
   * genesis_content_width() will be applied; Filters the content width based on the user selected layout.
   *
   * @see genesis_content_width()
   * @param integer $default Default width
   * @param integer $small Small width
   * @param integer $large Large width
   */
  // $content_width = apply_filters( 'content_width', 600, 430, 920 );
  
  //Custom Image Sizes
  add_image_size( 'featured-image', 225, 160, TRUE );
  
  // Enable Custom Background
  //add_theme_support( 'custom-background' );

  // Enable Custom Header
  //add_theme_support('genesis-custom-header');


  // Add support for structural wraps
  add_theme_support( 'genesis-structural-wraps', array(
    'header',
    'nav',
    'subnav',
    'inner',
    'footer-widgets',
    'footer'
  ) );

  /**
   * 07 Footer Widgets
   * Add support for 3-column footer widgets
   * Change 3 for support of up to 6 footer widgets (automatically styled for layout)
   */
  add_theme_support( 'genesis-footer-widgets', 3 );
  
  // Add Mobile Navigation
  add_action( 'genesis_before', 'gs_mobile_navigation', 5 );
  
  //Enqueue Sandbox Scripts
  add_action( 'wp_enqueue_scripts', 'gs_enqueue_scripts' );
  
  /**
   * 13 Editor Styles
   * Takes a stylesheet string or an array of stylesheets.
   * Default: editor-style.css 
   */
  //add_editor_style();
  
  
  // Register Sidebars
  gs_register_sidebars();
  
} // End of Set Up Function

// Register Sidebars
function gs_register_sidebars() {
  $sidebars = array(
    array(
      'id'      => 'home-top',
      'name'      => __( 'Home Top', CHILD_DOMAIN ),
      'description' => __( 'This is the top homepage section.', CHILD_DOMAIN ),
    ),
    array(
      'id'      => 'home-middle-01',
      'name'      => __( 'Home Left Middle', CHILD_DOMAIN ),
      'description' => __( 'This is the homepage left section.', CHILD_DOMAIN ),
    ),
    array(
      'id'      => 'home-middle-02',
      'name'      => __( 'Home Middle Middle', CHILD_DOMAIN ),
      'description' => __( 'This is the homepage middle section.', CHILD_DOMAIN ),
    ),
    array(
      'id'      => 'home-middle-03',
      'name'      => __( 'Home Right Middle', CHILD_DOMAIN ),
      'description' => __( 'This is the homepage right section.', CHILD_DOMAIN ),
    ),
    array(
      'id'      => 'home-bottom',
      'name'      => __( 'Home Bottom', CHILD_DOMAIN ),
      'description' => __( 'This is the homepage right section.', CHILD_DOMAIN ),
    ),
    array(
      'id'      => 'portfolio',
      'name'      => __( 'Portfolio', CHILD_DOMAIN ),
      'description' => __( 'Use featured posts to showcase your portfolio.', CHILD_DOMAIN ),
    ),
    array(
      'id'      => 'after-post',
      'name'      => __( 'After Post', CHILD_DOMAIN ),
      'description' => __( 'This will show up after every post.', CHILD_DOMAIN ),
    ),
  );
  
  foreach ( $sidebars as $sidebar )
    genesis_register_sidebar( $sidebar );
}


/** Reposition footer outside main wrap */
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 ) ;

add_action( 'genesis_after', 'genesis_footer_markup_open', 5 );
add_action( 'genesis_after', 'genesis_do_footer' );
add_action( 'genesis_after', 'genesis_footer_markup_close', 15 );

/** Reposition header outside main wrap */
remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
remove_action( 'genesis_header', 'genesis_do_header' );
remove_action( 'genesis_header', 'genesis_header_markup_close', 15 ) ;

add_action( 'genesis_before', 'genesis_header_markup_open', 5 );
add_action( 'genesis_before', 'genesis_do_header' );
add_action( 'genesis_before', 'genesis_header_markup_close', 15 );

/**  Register Menus - hopefully */
// Register Navigation Menus
function register_my_menus() {
  register_nav_menus(
    array(
    	'header-above-menu' => __( 'Header Above Menu' ),
      'header-top-menu' => __( 'Header Top Menu' ),
      'header-btm-menu' => __( 'Header Btm Menu' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


/*** Remove Query String from Static Resources ***/
function remove_cssjs_ver( $src ) {
 if( strpos( $src, '?ver=' ) )
 $src = remove_query_arg( 'ver', $src );
 return $src;
}
add_filter( 'style_loader_src', 'remove_cssjs_ver', 10, 2 );
add_filter( 'script_loader_src', 'remove_cssjs_ver', 10, 2 );


//* Add HTML5 markup structure from Genesis
add_theme_support( 'html5' );

//* Add HTML5 responsive recognition
add_theme_support( 'genesis-responsive-viewport' );
//* Add featured image support
add_theme_support( 'post-thumbnails' );

//* Add Image Sizes
add_image_size( 'featured-image', 720, 400, TRUE );

//* Modify size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {

  return 90;

}

//* Modify size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

  $args['avatar_size'] = 60;

  return $args;

}

// remove genesis bs
remove_action('genesis_entry_header', 'genesis_do_post_title');
remove_action('genesis_post_title', 'genesis_do_post_title');
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );
remove_action( 'genesis_site_description', 'genesis_seo_site_description' );

//* Remove the entry header markup (requires HTML5 theme support)
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

// Remove site footer.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );



?>
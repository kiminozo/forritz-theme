<?php

@include_once('includes/functions-record.php');
@include_once('includes/functions-metabox.php');
@include_once('includes/functions-shortcode.php');
@include_once('includes/functions-override.php');
@include_once("includes/functions-template.php");
@include_once("includes/functions-seo.php");
@include_once('includes/widget-taxonomy.php');
@include_once("includes/nav-menu-walker.php");


/*Setup
-----------------------------------------------------------------------------*/
if (!function_exists( 'forritz_theme_setup' ))
	:

function forritz_theme_setup(){
	load_theme_textdomain( 'forritz', get_template_directory() . '/lang' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Adds RSS feed links to <head> for posts and comments.
	//add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' ,array('record'));

	register_nav_menus( array( 'main-menu' => __( 'Main Menu', 'forritz' ),  ) );
}     

endif;
add_action( 'after_setup_theme', 'forritz_theme_setup'); 



/**
 * Enqueues scripts and styles for front-end.
 */
// function forritz_styles() {
// 	$template = get_template_directory_uri();

// 	wp_register_style('bootstrap', $template.'/css/bootstrap.min.css');
// 	wp_register_style('bootstrap-responsive', $template.'/css/bootstrap-responsive.min.css');

// 	wp_enqueue_style('bootstrap');
// 	wp_enqueue_style('bootstrap-responsive');
// }
// add_action("wp_head", "forritz_styles");

function forritz_css_loader() {
	$template = get_template_directory_uri();
	wp_enqueue_style('style', $template.'/style.css');
	wp_enqueue_style('bootstrap', $template.'/css/bootstrap.min.css');
	//wp_enqueue_style('bootstrap-responsive',$template.'/css/bootstrap-responsive.min.css');
}
add_action('wp_enqueue_scripts', 'forritz_css_loader');

function forritz_js_loader(){
	$template = get_template_directory_uri();
	wp_enqueue_script('bootstrapjs', $template.'/js/bootstrap.min.js', array('jquery'),'0.90', true );
}
add_action('wp_enqueue_scripts', 'forritz_js_loader');






function forritz_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'twentytwelve' ),
		'id' => 'main-sidebar',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'twentytwelve' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// register_sidebar( array(
	// 	'name' => __( 'First Front Page Widget Area', 'twentytwelve' ),
	// 	'id' => 'sidebar-2',

	// 	'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
	// 	'before_widget' => '<aside id="%1$s" class="widget %2$s"><ul class="no-border">',
	// 	'after_widget' => '</aside>',
	// 	'before_title' => '<h3 class="widget-title">',
	// 	'after_title' => '</h3>',
	// ) );

	// register_sidebar( array(
	// 	'name' => __( 'Second Front Page Widget Area', 'twentytwelve' ),
	// 	'id' => 'sidebar-3',
	// 	'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'twentytwelve' ),
	// 	'before_widget' => '<aside id="%1$s" class="widget %2$s">',
	// 	'after_widget' => '</aside>',
	// 	'before_title' => '<h3 class="widget-title">',
	// 	'after_title' => '</h3>',
	// ) );
}
add_action( 'widgets_init', 'forritz_widgets_init' );







/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function bootstrap_page_menu_args( $args ) {
  $args['show_home'] = true;
  return $args;
}
add_filter( 'wp_page_menu_args', 'bootstrap_page_menu_args' );

function forritz_taxonomy_orderby( $orderby )
{
  global $gloss_category;

  if(is_front_page() || is_home())
 	return "post_modified DESC"; 
  elseif(is_category())
  	return "post_name ASC";
  else if( taxonomy_exists('discography')) 
    return "menu_order ASC";
  // not in glossary category, return default order by
  return $orderby;
}
add_filter('posts_orderby', 'forritz_taxonomy_orderby' );

function forritz_display_continue_reading(){
	printf('<span class="continue-reading"><a href="%2$s">%1$s</a></span>',__('Continue Reading','forritz'),get_permalink());
}

function forritz_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'forritz_excerpt_length' );


function forritz_headicon(){
	printf('<link rel="shortcut icon" href="%s/img/favicon.ico" type="image/x-icon" />',get_template_directory_uri());
	echo "\n";
}
add_action('wp_head', 'forritz_headicon');

remove_action( 'wp_head', 'feed_links_extra', 3 ); 
// Display the links to the extra feeds such as category feeds

remove_action( 'wp_head', 'feed_links', 2 ); 
// Display the links to the general feeds: Post and Comment Feed

remove_action( 'wp_head', 'rsd_link' ); 
// Display the link to the Really Simple Discovery service endpoint, EditURI link

remove_action( 'wp_head', 'wlwmanifest_link' ); 
// Display the link to the Windows Live Writer manifest file.

remove_action( 'wp_head', 'index_rel_link' ); 
// index link

remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); 
// prev link

remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
 // start link

remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); 
// Display relational links for the posts adjacent to the current post.

remove_action( 'wp_head', 'wp_generator' ); 
// Display the XHTML generator that is generated on the wp_head hook, WP version
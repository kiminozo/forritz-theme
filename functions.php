<?php

@include_once('functions-record.php');
@include_once('functions-metabox.php');
@include_once('functions-shortcode.php');
@include_once('functions-override.php');
@include_once('widget-taxonomy.php');


/*Setup
-----------------------------------------------------------------------------*/
add_action( 'after_setup_theme', 'custom_setup_theme', 0 ); 

if ( ! function_exists( 'custom_setup_theme' ) ) :
function custom_setup_theme(){
    $template = TEMPLATEPATH;
    $template = str_replace('/twentyten','/forritz',$template);
    $url =  $template.'/languages';
	load_theme_textdomain('forritz', $url);
	return $url;
}     
                                      
endif;


if ( ! function_exists( 'custom_get_template_url' ) ) :
function custom_get_template_url(){
	$template = get_bloginfo('template_url');
	$template = str_replace('/twentyten','/forritz',$template);
	return $template;
}
endif;


/* add a custom js
----------------------------------------------------*/
add_action( 'init', 'jquery_extend', 0 );
if ( ! function_exists( 'jquery_extend' ) ) :
function jquery_extend() {
	   $template = custom_get_template_url();
       wp_register_script('jquery-extend', $template.'/js/jquery_extend.js',array('jquery-ui-tabs'),'1.0');
}
endif;



/*
remove junk from head
----------------------------------------------------*/
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);


add_action('wp_head', 'custom_feed_link');
function custom_feed_link(){
	printf('<link rel="alternate" type="application/rss+xml" title="%s %s" href="%s" />',get_bloginfo('name'),get_bloginfo( 'description', 'display' ),get_bloginfo('rss2_url'));
}

add_action('wp_footer', 'add_googleanalytics');
function add_googleanalytics() { 
	printf('
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push([\'_setAccount\', \'UA-1159843-3\']);
  _gaq.push([\'_trackPageview\']);

  (function() {
    var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
    ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
    var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>');
}

/*custom_orderby
------------------------------------------------------------------*/
add_filter('posts_orderby', 'custom_taxonomy_orderby' );
//add_filter('posts_groupby', 'custom_taxonomy_groupby' );

function custom_taxonomy_orderby( $orderby )
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

function custom_display_continue_reading(){
	printf('<span class="continue-reading"><a href="%2$s">%1$s</a></span>',__('Continue Reading','forritz'),get_permalink());
}

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length' );


function custom_display_posted_on(){
	$tag_list = get_the_tag_list( '', ', ' );
	$category_list = get_the_category_list( ', ' );
	if($category_list && $tag_list)
		$posted_in = __( '<span>Categories:</span> %1$s <span>Tags:</span> %2$s', 'forritz');
	elseif ( $tag_list ) 
		$posted_in = __( '<span>Tags:</span> %2$s', 'forritz');
	elseif($category_list)
		$posted_in = __( '<span>Categories:</span> %1$s', 'forritz');
	else
		$posted_in = '&nbsp;';
	printf(
		$posted_in,
		$category_list,
		$tag_list
	);
	
}



function par_pagenavi($range = 9){
	global $paged, $wp_query;
	if ( !$max_page ) {$max_page = $wp_query->max_num_pages;}
	if($max_page > 1){if(!$paged){$paged = 1;}
	if($paged != 1){echo "<a href='" . get_pagenum_link(1) . "' class='extend' title='".__( 'First page', 'forritz' )."'>".__( 'First page', 'forritz' )."</a>";}
	previous_posts_link(__( 'Previous page', 'forritz' ));
    if($max_page > $range){
		if($paged < $range){for($i = 1; $i <= ($range + 1); $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
    elseif($paged >= ($max_page - ceil(($range/2)))){
		for($i = $max_page - $range; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
		if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	elseif($paged >= $range && $paged < ($max_page - ceil(($range/2)))){
		for($i = ($paged - ceil($range/2)); $i <= ($paged + ceil(($range/2))); $i++){echo "<a href='" . get_pagenum_link($i) ."'";if($i==$paged) echo " class='current'";echo ">$i</a>";}}}
    else{for($i = 1; $i <= $max_page; $i++){echo "<a href='" . get_pagenum_link($i) ."'";
    if($i==$paged)echo " class='current'";echo ">$i</a>";}}
	next_posts_link(__( 'Next page', 'forritz' ));
    if($paged != $max_page){echo "<a href='" . get_pagenum_link($max_page) . "' class='extend' title='".__( 'Last page', 'forritz' )."'>".__( 'Last page', 'forritz' )."</a>";}}
}






























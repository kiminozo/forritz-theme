<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" class="discography" role="main">

<?php 
	/* Queue the first post, that way we know
	 * what date we're dealing with (if that is the case).
	 *
	 * We reset this later so we can run the loop
	 * properly with a call to rewind_posts().
	 */
	//if ( have_posts() )
	//	the_post();
    $query_term = get_query_var( 'term' );
    $term = get_term_by('slug',$query_term,'discography');
    $child_terms = get_term_children($term->term_id,'discography');
    //echo count($child_terms);
    if( count($child_terms) == 0)
		get_template_part( 'custom','record');
	else
		get_template_part( 'custom','record-list');

?>



			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

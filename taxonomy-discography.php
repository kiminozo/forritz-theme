<?php
/**
 * The page template file.
 */
forritz_set_menu_discography();
get_header(); ?>
<section id="primary" class="span9 site-content">
	<div id="discography" role="main">
<?php 
    $query_term = get_query_var( 'term' );
    $term = get_term_by('slug',$query_term,'discography');
    $child_terms = get_term_children($term->term_id,'discography');
    if( count($child_terms) == 0)
		get_template_part( 'templates/record','single');
	else
		get_template_part( 'templates/record','list');
?>
</div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
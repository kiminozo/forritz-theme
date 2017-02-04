<?php
/**
 * The page template file.
 */
forritz_set_menu_discography();
get_header(); ?>

<section id="primary" class="span9 site-content">
	<div id="artist" role="main">
<?php 
	get_template_part( 'templates/artist','list');
?>
</div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
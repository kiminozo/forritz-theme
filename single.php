<?php
/**
 * The page template file.
 */
forritz_set_menu_posts();
get_header(); ?>

<section id="primary" class="span9 site-content">
	<div id="content" role="main">
		<?php /* Start the Loop */ ?>
		<?php if ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header page-header">
				<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<footer  class="entry-footer">
				<?php 
				forritz_postfooter();
				forritz_licenseblock(); 
				?>

			</footer>

		</article><!-- #post -->

	<?php endif; ?>

</div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
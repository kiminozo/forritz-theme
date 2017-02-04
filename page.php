<?php
/**
 * The page template file.
 */

get_header(); ?>

<section id="primary" class="span9 site-content">
	<div id="content" role="main">
		<?php /* Start the Loop */ ?>
		<?php if ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header page-header">
				<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
			</header>

			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<footer class="entry-footer">
				<?php forritz_licenseblock(); ?>
			</footer>
		</article><!-- #post -->

	<?php endif; ?>

</div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); ?>

<section id="primary" class="span12 site-content">
	<div id="content" role="main">
		<article id="post-0" class="post no-results not-found ">

			<div class="hero-unit">
				<h1 class="entry-title">
					<?php _e( 'Nothing Found', 'forritz' ); ?>
				</h1>
				<p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'forritz' ); ?></p>
				<?php forritz_search_form(); ?>
			</div><!-- .entry-content -->

		</article><!-- #post-0 -->
	</div><!-- #content -->
</section><!-- #primary -->

<?php get_footer(); ?>
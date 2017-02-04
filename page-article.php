<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

<h1 class="page-title"><?php
					print( __( 'lastest news', 'forritz' ) );
				?></h1>
<?php query_posts('post_type=post&posts_per_page=10&orderby=modified'); ?>				

<?php if(have_posts()):?>
	<div class="sub-title"><?php _e('Post List','forritz')?></div>
<?php endif;?>

<?php get_template_part( 'loop'); ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

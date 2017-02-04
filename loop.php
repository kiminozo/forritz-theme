<?php
/**
 * The page template file.
 */

get_header(); ?>

<section id="primary" class="span9 site-content">
	<div id="content" role="main">
		<h2 class="page-title page-header"><?php echo single_cat_title( '', false );?></h2>
		<?php if($paged == 0):
		$category_description = category_description();
		if (! empty( $category_description ) ):?>

		<h3 class="sub-title "><?php _e('Summary','forritz')?></h3>
		<div class="category-description"><?php echo $category_description ?></div>	
		<hr/>					
	<?php endif;?>

	<?php if(have_posts()):?>	
	<h3 class="sub-title "><?php _e('Post List','forritz')?></h3>
<?php endif;?>
<?php endif;//isfirstpage?>
<?php /* Start the Loop */ ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="loop-header">
			<h4>
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'forritz' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h4>
			
		</header>
		<div class="loop-excerpt">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->
		<footer class="loop-footer">
			<?php forritz_tagsblock();?>
		</footer>
	</article><!-- #post -->
<?php endwhile; ?>

<?php forritz_pagination(); ?>

</div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
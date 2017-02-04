<?php
/**
 * The page template file.
 */
forritz_set_menu_discography();
get_header(); ?>

<section id="primary" class="span9 site-content">
	<div id="content" role="main">
		<?php /* Start the Loop */ ?>
		<?php if ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="entry-header page-header">
				<h2 class="entry-title">
					<?php the_title('',''); ?>
					<?php 
					$title_trans = get_post_meta(get_the_ID(),'song-title-trans',true);
					if($title_trans)
						printf('<small class="song-sub-title">%s</small>',$title_trans);
					?>
				</h2>
			</header>
			<div class="row-fluid">
				<div id="song-info" class="span3">
					<h4><small><?php _e('From album','forritz');?></small></h4>
					<?php show_song_thumbnail();?>
					<hr/>
					<?php show_song_description($post->ID)?>
				</div>
				<div class="song-context span9">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</div><!-- row-fluid -->
			<footer class="entry-footer">
				<?php forritz_licenseblock(); ?>
			</footer>
		</article><!-- #post -->

		<?php endif;
		?>

	</div><!-- #content -->
</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
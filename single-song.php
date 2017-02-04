<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Ten
 * @since Twenty Ten 1.0
 */

get_header(); ?>
		<div id="song-info2" style="float:left;width:150px">
			
		</div>

		<div id="container">
			<div id="content" role="main">

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="page-title">
						<?php the_title(); ?>
						<?php 
							$title_trans = get_post_meta(get_the_ID(),'song-title-trans',true);
							if($title_trans)
								printf('<span class="song-sub-title">(%s)</span>',$title_trans);
						?>
					</h1>
			
			<div id="song-info">
			
			<div class="record-cover">
			<?php show_song_thumbnail();?>
			</div>
			<?php 
			$sw_list = get_the_term_list(get_the_ID(),'discography','',',','');
			if($sw_list)
				printf('<div class="from-album"><div>%s</div>%s</div>',__('From album:','forritz'),$sw_list);
				//echo $sw_list;
			?>
			
			
			<ul class="entry-taxonomy">
				<?php show_custom_taxonomy($post->ID, 'songwriter','li');
				 show_custom_taxonomy($post->ID, 'lyricwriter','li');
				 show_custom_taxonomy($post->ID, 'singer','li');
				 show_custom_taxonomy($post->ID, 'arranger','li');
				?>
			</ul><!-- .entry-taxonomyo -->
			</div> 
			<div id="song-content" class="entry-content">
				<?php the_content(); ?>
				<?php wp_link_pages(array( 'before' => '<div class="page-link">' . __( 'Pages:', 'twentyten' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
			<div class="song-utility">
				<?php get_template_part( 'custom','posted-licenses');  ?>
				<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
			</div>
			</div><!-- #post-## -->


				<div id="nav-below" class="navigation entry-content">
					<div class="nav-previous"><?php previous_post_link( '&laquo;<span class="meta-nav">'.__( 'Previous song link', 'forritz' ).'</span>%link', '%title' ); ?></div>
					<div class="nav-next"><?php next_post_link( '<span class="meta-nav">'.__( 'Next song link', 'forritz' ).'</span>%link&raquo;', '%title' ); ?></div>
				</div><!-- #nav-below -->

				<?php comments_template( '', true ); ?>

<?php endwhile; // end of the loop. ?>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

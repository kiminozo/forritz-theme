<?php
/**
 * The template for displaying record pages.
 */
$query_taxonomy = get_query_var( 'taxonomy' );
$query_term = get_query_var( 'term' );
$term = get_term_by('slug',$query_term,$query_taxonomy);
$taxonomy = get_taxonomy($query_taxonomy);	
?>
<article>
	<header>
		<h2 class="page-title page-header">
			<?php printf('%s<small>%s</small>',$taxonomy->label,$term->name); ?>
		</h2>
	</header>
	<?php 
	$category_description = category_description();
	if ($paged == 0 && ! empty( $category_description ) ):
		?>
	<h3 class="sub-title"><?php _e('Artist Profile','forritz')?></h3>
	<div class="artist-profile"><?php echo $category_description?></div>
	<hr/>
	<?php endif;?>
	<h3 class="sub-title"><?php _e('Songs List','forritz')?></h3>

	<ul id="artist" class="unstyled">
		<?php while ( have_posts() ): the_post();?>

		<li class="song-title">
			<?php 
			$separator = '<span class="separator">,<span>';
			$sw_list = get_the_term_list(get_the_ID(),'discography','',$separator,'');  
			if($sw_list)
				//printf('<span class="from-record pull-right"><span>%s</span>%s</span>',__('From album:','forritz'),$sw_list);
				//printf('<span class="from-record pull-right">%s</span>',$sw_list);
			?>
			<i class=" icon-music"></i>
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</li>
		<li class="artist-list">
			<ul class="inline">
				<?php 	
				show_custom_taxonomy(get_the_ID(),'songwriter','li');
				show_custom_taxonomy(get_the_ID(),'lyricwriter','li');
				show_custom_taxonomy(get_the_ID(),'singer','li');
				show_custom_taxonomy(get_the_ID(),'arranger','li');
				?>
			</ul>
		</li><!--artist-list-->

		<?php endwhile ;?> 
	</ul><!--#artist-->

	<?php forritz_pagination(); ?>
</article>



<?php
/**
 * The template for displaying record pages.
 */
    $query_term = get_query_var( 'term' );
    $term = get_term_by('slug',$query_term,'discography');
?>

<?php 
	$category_description = category_description();
	if ( ! empty( $category_description ) ):
?>
<div class="sub-title"><?php _e('Artist Profile','forritz')?></div>
<div id="artist-profile"><?php echo $category_description?></div>
<?php endif;?>



<?php 
	rewind_posts();
?>

<div class="sub-title"><?php _e('Songs List','forritz')?></div>
<ul id="artist">
<?php while ( have_posts() ): the_post();?>

<li class="song-title">
<?php 
	$sw_list = get_the_term_list(get_the_ID(),'discography','','|','');  
	if($sw_list)
	printf('<span class="from-record"><span>%s</span>%s</span>',__('From album:','forritz'),$sw_list);
?>
<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
</li>
<li class="artist-list">
<ul>
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

<?php if (  $wp_query->max_num_pages > 1 ) : ?>
	<div class="page_navi"><?php par_pagenavi(9); ?></div>
<?php endif; ?>


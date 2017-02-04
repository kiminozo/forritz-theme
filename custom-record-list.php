<?php
/**
 * The template for displaying record pages.
 */
 
?>

<h1 class="page-title">
<?php 
    $taxonomy = get_taxonomy('discography');	
    $query_term = get_query_var( 'term' );
    $term = get_term_by('slug',$query_term,'discography');
    $child_terms = get_term_children($term->term_id,'discography'); 
    
	printf( '%s: <span>%s</span>', $taxonomy->label,$term->name);
?>
			</h1>
			<?php
					//$category_description = category_description();
					//if ( ! empty( $category_description ) )
					//	echo '<div class="archive-meta">' . $category_description . '</div>';
			?>
			
<ul id="record-list">
<?php
sort($child_terms);   
foreach($child_terms as $child_id):
$child_term = get_term($child_id,'discography');
if($child_term->count == 0)
	continue;
?>
<li class="record">
<?php
$args=array(
   'post_type'=>'record',
   'name' => $child_term->slug
   );
$the_query = new WP_Query($args);
if ($the_query->have_posts()) : $the_query->the_post(); ?>
<div class="record-cover">
		<a href="<?php echo get_term_link($child_term,'discography')?>">
			<?php has_post_thumbnail()? the_post_thumbnail(array(100,100)):show_default_cd_img(array(100,100),$child_term->name);?>
		</a>
</div>
<ul class="record-info">
	<li class="record-title"><a href="<?php echo get_term_link($child_term,'discography')?>"><?php echo $child_term->name?></a></li>
	<li class="record-description">
        <?php show_meta_record_artist($child_term->slug); ?> |
 	  	 <?php show_meta_record_type(get_the_ID())?> | 
		 <?php show_meta_record_release_date(get_the_ID()); ?> | 
		 <?php show_meta_record_publisher(get_the_ID()); ?>
	</li>
<?php else:?>		 
<div class="record-cover">
	<a href="<?php echo get_term_link($child_term,'discography')?>">
		<?php show_default_cd_img(array(100,100),$child_term->name);?>
	</a>	
</div>
<ul class="record-info">
	<li class="record-title"><a href="<?php echo get_term_link($child_term,'discography')?>"><?php echo $child_term->name?></a></li>
	<li class="record-description">
		<?php show_meta_record_artist($child_term->slug); ?>
	</li>
<?php endif; ?>
<li class="record-content">
<?php 
$args=array(
   'post_type'=>'song',
   'discography' => $child_term->slug,
   'posts_per_page' => -1
   );
$tmp_no = 0;   
$the_query = new WP_Query($args);?>
<ol>
<?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
  <li class="<?php echo ($tmp_no++%2 == 1)?'light':'dark'; ?>"><a href="<?php the_permalink(); ?>"><?php the_title();?></a></li>
<?php endwhile;?>
</ol>
</li><!--record-content-->
</ul><!--record-info-->
</li><!--record-->
<?php endforeach; ?>
<?php 
	rewind_posts();
?>
</ul>



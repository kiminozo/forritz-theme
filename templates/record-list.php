<?php
/**
 * The template for displaying record pages.
 */
 
?>
<article>
	<header>
		<h1 class="page-title page-header">
<?php 
    $taxonomy = get_taxonomy('discography');	
    $query_term = get_query_var( 'term' );
    $parent_term = get_term_by('slug',$query_term,'discography');
    //$child_terms = get_term_children($term->term_id,'discography'); 
    $child_terms = get_terms('discography',	array('child_of'=> $parent_term->term_id));
	printf( '%s<small>%s</small>', $taxonomy->label,$parent_term->name);
?>
	</h1>
</header>
			
<ul class="media-list record-list">
<?php
$record_terms = forritz_sort_by_record_order($child_terms);
foreach($record_terms as $child_term):
?>
<li class="media record">
<?php
$args=array(
   'post_type'=>'record',
   'name' => $child_term->slug
   );
$the_query = new WP_Query($args);
if ($the_query->have_posts()) : $the_query->the_post(); ?>
<div class="record-list-cover pull-left">
	<a href="<?php echo get_term_link($child_term,'discography')?>">
		<?php the_record_cover();?>
	</a>
</div>
<div class="media-body">
	<h4 class="media-heading">
		<a href="<?php echo get_term_link($child_term,'discography')?>"><?php echo $child_term->name?></a>
	</h4>
	<div class="record-description">
       	<?php show_meta_record_artist($child_term->slug); ?> |
 	  	<?php show_meta_record_type(get_the_ID())?> | 
		<?php show_meta_record_release_date(get_the_ID()); ?> | 
		<?php show_meta_record_publisher(get_the_ID()); ?>
	</div>
<?php else:?>	
<a class="pull-left" href="<?php echo get_term_link($child_term,'discography')?>">
	<?php show_default_cd_img(array(100,100),$child_term->name);?>
</a>	
<div class="media-body">
	<h4 class="media-heading">
		<a href="<?php echo get_term_link($child_term,'discography')?>"><?php echo $child_term->name?></a>
	</h4>
	<div class="record-description">
			<?php show_meta_record_artist($child_term->slug); ?>
	</div>
<?php endif; ?>
<div class="record-content">
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
</div><!--record-content-->
</div><!-- media-body -->
</li><!--record-->
<?php endforeach; ?>
<?php 
	rewind_posts();
?>
</ul>
<article>


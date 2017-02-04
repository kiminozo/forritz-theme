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

<h1 class="page-title">
<?php 
    $taxonomy = get_taxonomy('discography');	
    $child_terms = get_terms('discography');
	printf( '%s', $taxonomy->label);
?>
</h1>
		
<ul id="record-list">
<?php
sort($child_terms);   
foreach($child_terms as $child_id):
$child_term = get_term($child_id,'discography');

if(count(get_term_children($child_term->term_id,'discography')) != 0)
{
	continue;
}

?>
<li class="record-low">
<?php
$args=array(
   'post_type'=>'record',
   'name' => $child_term->slug
   );
$the_query = new WP_Query($args);
if ($the_query->have_posts()) : $the_query->the_post(); ?>
<div class="record-small-cover">
		<a href="<?php echo get_term_link($child_term,'discography')?>">
			<?php has_post_thumbnail()? the_post_thumbnail(array(64,64)):show_default_cd_img(array(64,64),$child_term->name);?>
		</a>
</div>
<ul class="record-big-info">
	<li class="record-title"><a href="<?php echo get_term_link($child_term,'discography')?>"><?php echo $child_term->name?></a></li>
	<li class="record-description">
        <?php show_meta_record_artist($child_term->slug); ?> |
 	  	 <?php show_meta_record_type(get_the_ID())?> | 
		 <?php show_meta_record_release_date(get_the_ID()); ?> | 
		 <?php show_meta_record_publisher(get_the_ID()); ?>
	</li>
<?php else:?>		 
<div class="record-small-cover">
	<a href="<?php echo get_term_link($child_term,'discography')?>">
		<?php show_default_cd_img(array(64,64));?>
	</a>	
</div>
<ul class="record-big-info">
	<li class="record-title"><a href="<?php echo get_term_link($child_term,'discography')?>"><?php echo $child_term->name?></a></li>
	<li class="record-description">
		<?php show_meta_record_artist($child_term->slug); ?>
	</li>
<?php endif; ?>
</ul><!--record-info-->
</li><!--record-->
<?php endforeach; ?>
<?php 
	rewind_posts();
?>
</ul>

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

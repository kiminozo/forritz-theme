<?php
/**
 * The template for displaying record pages.
 */
    $query_term = get_query_var( 'term' );
    $term = get_term_by('slug',$query_term,'discography');
?>

<h2><?php echo $term->name?></h2>
<?php
$args=array(
   'post_type'=>'record',
   'name' => $term->slug
   );
$the_query = new WP_Query($args);
if ($the_query->have_posts()) : $the_query->the_post(); ?>
		<div id="record-info">
		<div class="record-cover">
			<?php has_post_thumbnail()? the_post_thumbnail(array(148,148)):show_default_cd_img(array(148,148),$term->name);?>
		</div>
		<ul class="record-meta">
		 <li><?php show_meta_record_no(get_the_ID());?></li>
		 <li><?php show_meta_record_artist($term->slug);?></li>
		 <li><?php show_meta_record_type(get_the_ID());?></li>
		 <li><?php show_meta_record_release_date(get_the_ID());?></li>
		 <li><?php show_meta_record_publisher(get_the_ID());?></li>
 		 <li><?php show_meta_record_price(get_the_ID());?></li>
		</ul>
		</div><!--#discography-info-->
		<div class="sub-title"><?php _e('Summary','forritz')?></div>
		<div class="record-summary">
			<?php the_content();?>
			<?php edit_post_link( __( 'Edit', 'twentyten' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
<?php 
else:
	$category_description = category_description();
	if ( ! empty( $category_description ) ):
?>
	<div class="sub-title"><?php _e('Summary','forritz')?></div>
	<div class="record-summary">
  		<?php echo $category_description; ?>
	</div>
<?php endif;endif; ?>


<?php 
	$args=array(
   'post_type'=>'song',
   'discography' => $query_term,
   'posts_per_page' => -1
   );
	query_posts($args);	
?>


<?php if ( have_posts() ):?>
<div class="sub-title"><?php _e('Songs List','forritz')?></div>
<table id="song-list">
<thead>
<tr>
<td class="no" rowspan="2"><?php _e('Series','forritz')?></td>
<td class="label song-title" colspan="4"><?php _e("Song Title","forritz") ?></td>
<td class="remarks" rowspan="2"><?php _e('Other/Remarks','forritz')?></td>
</tr>
<tr>
<td class="label songwriter"><?php echo get_taxonomy('songwriter')->label; ?></td>
<td class="label lyricwriter"><?php echo get_taxonomy('lyricwriter')->label; ?></td>
<td class="label singer"><?php echo get_taxonomy('singer')->label; ?></td>
<td class="label arranger"><?php echo get_taxonomy('arranger')->label; ?></td>
</tr>
</thead>
<tbody>
<?php 
$no = 0;
while ( have_posts() ) : the_post(); ?>
				<tr>
				<td class="no" rowspan="2"><?php echo ++$no;?></td>
				<td id="post-<?php the_ID(); ?>" class="item song-title" colspan="4">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</td>
				<td class="remarks" rowspan="2"><?php echo get_post_meta(get_the_ID(),'song-remarks',true);?></td>
				</tr>
				<tr>	
				<?php 
            	 printf("<td class=\"item songwriter\">%s</td>",get_the_term_list(get_the_ID(),'songwriter'),'','|','');  
            	 printf("<td class=\"item lyricwriter\">%s</td>",get_the_term_list(get_the_ID(),'lyricwriter'),'','|','');  
            	 printf("<td class=\"item singer\">%s</td>",get_the_term_list(get_the_ID(),'singer'),'','|','');  
            	 printf("<td class=\"item arranger\">%s</td>",get_the_term_list(get_the_ID(),'arranger'),'','|','');  
				?>
				</tr>
<?php endwhile;?>
</tbody>
</table><!--song-list-->    
<?php endif;?> 


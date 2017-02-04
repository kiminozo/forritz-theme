<?php
/**
 * The template for displaying record pages.
 */
$query_term = get_query_var( 'term' );
$term = get_term_by('slug',$query_term,'discography');
?>
<article>
	<header>
		<h2 class="page-title page-header"><?php echo $term->name?></h2>
	</header>
	<?php
	$args=array(
		'post_type'=>'record',
		'name' => $term->slug
		);
	$the_query = new WP_Query($args);
	if ($the_query->have_posts()) : $the_query->the_post(); ?>
	<div id="record-info" class="media">
		<div class="pull-left record-cover">
			<?php the_record_cover(array(148,148));?>
		</div>
		<div class="media-body">
			<ul class="unstyled">
				<li><?php show_meta_record_no(get_the_ID());?></li>
				<li><?php show_meta_record_artist($term->slug);?></li>
				<li><?php show_meta_record_type(get_the_ID());?></li>
				<li><?php show_meta_record_release_date(get_the_ID());?></li>
				<li><?php show_meta_record_publisher(get_the_ID());?></li>
				<li><?php show_meta_record_price(get_the_ID());?></li>
			</ul>
		</div>
	</div><!--#discography-info-->
	<?php if( !empty( $post->post_content)):?>
	<h3 class="sub-title"><?php _e('Summary','forritz')?></h3>
	<div class="record-summary">
		<?php the_content();?>
		<?php edit_post_link( __( 'Edit', 'forritz' ), '<span class="edit-link">', '</span>' ); ?>
	</div>
	<?php endif?>
	<hr/>
	<?php 
	else:
		$category_description = category_description();
	if ( ! empty( $category_description ) ):
		?>
	<h3 class="sub-title"><?php _e('Summary','forritz')?></h3>
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
	<h3 class="sub-title"><?php _e('Songs List','forritz')?></h3>
	<table id="song-list" class="table table-condensed">
		<thead>
			<tr>
				<th class="no" rowspan="2">#</th>
				<th class="song-title" colspan="4"><?php _e("Song Title","forritz") ?></th>
				<th class="remarks" rowspan="2"><?php _e('Other/Remarks','forritz')?></th>
			</tr>
			<tr>
				<th class="songwriter"><?php echo get_taxonomy('songwriter')->label; ?></th>
				<th class="lyricwriter"><?php echo get_taxonomy('lyricwriter')->label; ?></th>
				<th class="singer"><?php echo get_taxonomy('singer')->label; ?></th>
				<th class="arranger"><?php echo get_taxonomy('arranger')->label; ?></th>
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
				<td class="remarks" rowspan="2">
					<?php echo get_post_meta(get_the_ID(),'song-remarks',true);?>
				</td>
			</tr>
			<tr>	
				<?php 
				$separator = '<span class="separator">,<span>';
				printf("<td class=\"item item-artist songwriter\">%s</td>",get_the_term_list(get_the_ID(),'songwriter','',$separator,''));  
				printf("<td class=\"item item-artist lyricwriter\">%s</td>",get_the_term_list(get_the_ID(),'lyricwriter','',$separator,''));  
				printf("<td class=\"item item-artist singer\">%s</td>",get_the_term_list(get_the_ID(),'singer','',$separator,''));  
				printf("<td class=\"item item-artist arranger\">%s</td>",get_the_term_list(get_the_ID(),'arranger','',$separator,''));  
				?>
			</tr>
		<?php endwhile;?>
	</tbody>
</table><!--song-list-->    
<?php endif;?> 
</article>


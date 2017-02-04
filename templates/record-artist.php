<?php
/**
 * The template for displaying record pages.
 */
$taxonomy = 'discography';
$taxonomy_item = get_taxonomy($taxonomy);	
$query_term = get_query_var( 'term' );
$parent_term = get_term_by('slug',$query_term,$taxonomy);
    //$child_terms = get_term_children($term->term_id,'discography'); 
$artist_terms = get_terms('discography',array('child_of'=> $parent_term->term_id));
sort($artist_terms);
?>
<article>
	<header>
		<h1 class="page-title page-header">
			<?php printf( '%s<small>%s</small>', $taxonomy_item->label,$parent_term->name);?>
		</h1>
	</header>
	<ul id="artist" class="unstyled">
		<?php foreach ($artist_terms as $artist_term) :
			if($artist_term->count > 0)continue;
		?>
		<li>
			<h3 >
				<?php 
				$link = get_term_link($artist_term,$taxonomy);
				printf('<a href="%s" title="%s">%s</a>',$link,$artist_term->name,$artist_term->name);
				?>
			</h3>





			<?php
				$child_terms = get_terms($taxonomy,
					array('child_of'=> $parent_term->term_id));
				sort($child_terms);
				$record_names = array();
				foreach($artist_terms as $child){
					if($child->count == 0)continue;
					if($child->parent != $artist_term->term_id)continue;
					$record_names[] = $child->slug;
				}
				forritz_record_img_list($record_names,array(100,100));
			?>








			<hr/>
		</li>
		<?php endforeach;
		?>
	</ul>
</article>



<?php
/**
 * The template for displaying record pages.
 */
//$taxonomy = get_taxonomy('discography');	//
$taxonomy = 'discography';
$terms = get_terms($taxonomy);
$parent_terms = array();
foreach($terms as $term){
	if($term->parent == 0)
		$parent_terms[] = $term;
}
sort($parent_terms)
?>
<article>
	<ul class="unstyled">
		<?php
		foreach($parent_terms as $parent_term):?>
		<li>
			<h3>
				<?php 
				$link = get_term_link($parent_term,$taxonomy);
				printf('<a href="%s" title="%s">%s</a>',$link,$parent_term->name,$parent_term->name);
				?>
			</h3>
			<?php
				$children = get_terms($taxonomy,
					array('child_of'=> $parent_term->term_id));
				$children = forritz_sort_by_record_order($children);
				$record_names = array();
				foreach($children as $child){
					$record_names[] = $child->slug;
				}
				forritz_record_img_list($record_names,array(100,100));
			?>
			<hr/>
		</li>
		<?php endforeach; //$parent_terms
		?>
		<ul>
		</article>


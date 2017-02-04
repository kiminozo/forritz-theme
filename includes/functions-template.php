<?php
/**
 * The template for post-license.
 */
function forritz_licenseblock() {

	$license_type = get_post_meta(get_the_ID(), 'license-type',true);
	if($license_type):?>

	<div id="post-license" class="alert alert-info">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<ul class="unstyled">
			<li><?php _e('This website following the <a href="http://creativecommons.org/licenses/by-nc-sa/3.0/" rel="external nofollow">Attribution-NonCommercial-ShareAlike 3.0</a>.','forritz')?></li>
			<li>
				<?php 

				if($license_type == 'original')
				{
					_e('This post is Original.','forritz');
					$author = get_post_meta(get_the_ID(), 'license-author',true);
					printf(__('For reproduced, please specify from <a href="%1$s">%2$s</a>[<a href="%1$s">%1$s</a>],the author is:%3$s.','forritz'),
						get_bloginfo('url'),get_bloginfo('name').' '.get_bloginfo('description'),$author);
				}
				else if($license_type == 'reproduced')
				{
					_e('This post is Reproduced.','forritz');
					$url = get_post_meta(get_the_ID(), 'license-reproduced-url',true);
					$website = get_post_meta(get_the_ID(), 'license-reproduced-website',true);
					$author = get_post_meta(get_the_ID(), 'license-author',true);
					if($website){
						printf(__('Reproduced from  <a href="%1$s">%2$s</a>[<a href="%1$s">%1$s</a>],the author is:%3$s.','forritz'),
							$url,$website, $author);
					}
					else{
						printf(__('Reproduced from [<a href="%1$s">%1$s</a>],the author is:%2$s.','forritz'),
							$url,$author);
					}				
				}
				else if($license_type == 'translated')
				{
					_e('This post is Translated.','forritz');
					$url = get_post_meta(get_the_ID(), 'license-reproduced-url',true);
					$website = get_post_meta(get_the_ID(), 'license-reproduced-website',true);
	  //if(!$website)$website = $url;

					$author = get_post_meta(get_the_ID(), 'license-author',true);
					$translator = get_post_meta(get_the_ID(), 'license-translator',true);

					if($website)
						if($url)
							printf(__('Reproduced from <a href="%1$s">%2$s</a>[<a href="%1$s">%1$s</a>],the author is:%3$s, and the translator is:%4$s.','forritz'),
								$url,$website, $author,$translator);
						else
							printf(__('Reproduced from %s,the author is:%s, and the translator is:%s.','forritz'),
								$website, $author,$translator);
						elseif($author)
							printf(__('The author is:%s, and the translator is:%s.','forritz'),
								$author,$translator);		
						else
							printf(__('The translator is:%s.','forritz'),
								$translator);		

					}
					?></li>
					<li><?php printf(__('Bookmark: <a href="%1$s">%1$s</a>','forritz'),get_permalink()); ?></li>
				</ul>
			</div>

			<?php endif;
		}?>
<?php
/**
 * The template for post-license.
 */
function forritz_tagsblock()
{
	$start = '<span class="tag label">';
	$end = '</span>';
	$tags_list = get_the_tag_list( $start, $end.$start,$end);
	if ( $tags_list ):?>
	<i class="icon-tags"></i>
	<span class="tag-links"><?php echo $tags_list ; ?></span>
<?php endif; 
}?>
<?php
function forritz_postfooter() 
{?>

	<div class="alert alert-success">
		<?php if (  count( get_the_category() ) ) : ?>
		<i class="icon-book"></i>
		<span class="cat-links">
			<?php echo get_the_category_list( ', ' ); ?>
		</span>
		
	<?php endif; ?>
	<?php
	$start = '<span class="tag label">';
	$end = '</span>';
	$tags_list = get_the_tag_list( $start, $end.$start,$end);
	if ( $tags_list ):?>
	<span class="meta-sep">|</span>
	<i class="icon-tags"></i>
	<span class="tag-links"><?php echo $tags_list ; ?></span>
<?php endif; ?>
</div>
<?php }?>
<?php
/*
*
*
*/
function forritz_pagination() {
	global $wp_query, $wp_rewrite;

	$paged			=	( get_query_var( 'paged' ) ) ? intval( get_query_var( 'paged' ) ) : 1;

	$pagenum_link	=	html_entity_decode( get_pagenum_link() );
	$query_args		=	array();
	$url_parts		=	explode( '?', $pagenum_link );
	
	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}
	$pagenum_link	=	remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link	=	trailingslashit( $pagenum_link ) . '%_%';
	
	$format			=	( $wp_rewrite->using_index_permalinks() AND ! strpos( $pagenum_link, 'index.php' ) ) ? 'index.php/' : '';
	$format			.=	$wp_rewrite->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';
	
	$links	=	paginate_links( array(
		'base'		=>	$pagenum_link,
		'format'	=>	$format,
		'total'		=>	$wp_query->max_num_pages,
		'current'	=>	$paged,
		'mid_size'	=>	3,
		'type'		=>	'list',
		'add_args'	=>	array_map( 'urlencode', $query_args )
		) );

	if ( $links ) {
		echo "<hr/><nav class=\"pagination pagination-centered clearfix\">{$links}</nav>";
	}
}?>
<?php
/*

*/
function forritz_content_quote($name,$type = 'post'){
	$query=array(
		'post_type'=> $type,
		'name' => $name);
	$query = get_posts($query);
	if($query)	{
		$content = $query[0]->post_content;
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]&gt;', $content);
		echo $content;
	}
}





function forritz_get_post_link($name,$type = 'post'){
	$query=array(
		'post_type'=> $type,
		'name' => $name);
	$query = get_posts($query);
	if($query)
	{
		$post = array_shift($query);
		if($post){
			return get_permalink($post->ID);
		}
	}
	return '';
}

function forritz_get_term_link($name,$type = 'tag')
{
	$term = get_term_by('slug',$name,$type);
	return get_term_link($term,$taxonomy);
}
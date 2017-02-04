<?php
function cut_str($string, $sublen, $start = 0) 
{ 
	
	$pa ="/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 
	preg_match_all($pa, $string, $t_string); if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen)); 
	return join('', array_slice($t_string[0], $start, $sublen)); 
	
} 



function forritz_get_seo_description($post,$length = 160){
	$description;
	if ($post->post_excerpt) {
		$description = $post->post_excerpt;
		$description = str_replace("\r\n",'',$description);
	} else {
		$description = cut_str(strip_tags($post->post_content),$length);
		$description = str_replace("\r\n",'',$description);
		$description = str_replace("&nbsp;",'',$description);
	}
	return $description;
}

function forritz_get_post_seo_description($name,$type = 'post',$length = 160){
	$query=array(
		'post_type'=> $type,
		'name' => $name);
	$query = get_posts($query);
	if($query)	{
		$excerpt = forritz_get_seo_description($query[0],$length);
	}
	return $excerpt;
}

// function forritz_get_taxonomy_description($type = 'discography'){
// 	$query_term = get_query_var('term');
//     $term = get_term_by('slug',$query_term,$type);

// }

function forritz_keywords_meta()
{
	$keywords = '';
	$description = '';
	if(is_home())
	{
		$description = forritz_get_post_seo_description('home','info');
	}
	else if(is_single() OR is_page())
	{
		global $post;
		$keywordlist = array();
		$taxonomys;
		if($post->post_type == 'song'){
			$taxonomys =array('discography','songwriter','lyricwriter','arranger','singer');
			$keywordlist[] = __('Lyric','forritz');
		}
		else{
			$taxonomys =array('category','post_tag');
		}
		foreach ($taxonomys as $taxonomy) {
			$terms = get_the_terms($post->ID, $taxonomy);
			if ($terms){
				foreach ($terms as $tag) {
					$keywordlist[] = $tag->name;
				}
			}
		}
		$keywordlist = array_unique($keywordlist);
		
		foreach ($keywordlist as $keyword) {
			$keywords .=$keyword.',';
		}
		$keywords = rtrim($keywords, ",");
		$description = forritz_get_seo_description($post);
	}
	else if(is_taxonomy('discography'))
	{
		$keywords .= trim(strip_tags(single_cat_title(”, false)));
		$query_term = get_query_var( 'term' );
		$term = get_term_by('slug',$query_term,'discography');
		$child_terms = get_term_children($term->term_id,'discography');
		if(count($child_terms) > 0)
		{
			$description = trim(strip_tags(category_description()));
		}
		else{
			$description = forritz_get_post_seo_description($term->slug,'record');
		}
	}
	else if (is_category()
		OR is_taxonomy('songwriter')
		OR is_taxonomy('lyricwriter')
		OR is_taxonomy('singer')
		OR is_taxonomy('arranger'))
	{
		$keywords .= trim(strip_tags(single_cat_title(”, false)));
		$description = trim(strip_tags(category_description()));
	}
	else if (is_tag())
	{
		$keywords .= trim(strip_tags(single_tag_title(”, false)));
		$description = trim(strip_tags(tag_description()));
	}
	if($keywords){
		$keywords .= ','.__("Okazaki Ritsuko Wiki","forritz");	
	}
	else{
		$keywords .= __("Okazaki Ritsuko Wiki","forritz");		
	}
	
	printf('<meta name="keywords" content="%s" />',$keywords);
	echo "\n";
	printf('<meta name="description" content="%s" />',$description);
	echo "\n";
}
add_action('wp_head', 'forritz_keywords_meta');


add_action('wp_footer', 'add_googleanalytics');
function add_googleanalytics() { 
	printf('
		<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push([\'_setAccount\', \'UA-1159843-3\']);
		_gaq.push([\'_trackPageview\']);

		(function() {
			var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
			ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
			var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
		})();

	</script>');
}
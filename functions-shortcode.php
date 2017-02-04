<?php

/*
build_custom_shortcodes
----------------------------------------------------*/
add_action( 'init', 'build_custom_shortcodes', 0 ); 

function build_custom_shortcodes(){
	add_shortcode('demo','shortcode_demo');
	add_shortcode('trans','shortcode_trans');
	add_shortcode('pagelink','shortcode_page_link');
	add_shortcode('lrc','shortcode_lrc');
	add_shortcode('quote','shortcode_quote');
}

//shortcode:[demo][/demo]
function shortcode_demo($atts, $content = null){
    if($content)
		return "<span class=\"demo\">".$content."</span>";
	else
		return "";	
}


//shortcode:[trans]<!--trans-->[/trans]
function shortcode_trans($atts, $content = null){
    if(!$content)
		return "";
	$strs = explode('<!--trans-->',$content);
	
	if(!$strs || count($strs) != 2)
	{
		return $content;
	}

	$str = '<div class="tabs">';	
	$str .= '<ul><li><a href="#tab-original">'.__('Original','forritz').'</a></li>';
	$str .= '<li><a href="#tab-translation">'.__('Translation','forritz').'</a></li></ul>';
	$str .= '<div id="tab-original">'.$strs[0].'</div>';
	$str .= '<div id="tab-translation">'.$strs[1].'</div>';
	$str .= '</div>';
	return $str;
}

//shortcode:[lrc]<!--lrc--><!--lrc-->[/lrc]
function shortcode_lrc($atts, $content = null){
    if(!$content)
		return "";
	$strs = explode('<!--lrc-->',$content);
	
	if(!$strs || count($strs) < 2 || count($strs) > 3)
	{
		return $content;
	}

	$str = '<div class="tabs">';	
	$str .= '<ul><li><a href="#tab-original">'.__('Original','forritz').'</a></li>';
	$str .= '<li><a href="#tab-translation">'.__('Translation','forritz').'</a></li>';
	if(count($strs) == 3)
	{
		$str .= '<li><a href="#tab-romaji">'.__('Romaji','forritz').'</a></li></ul>';
	}
	else
	{
		$str .= '</ul>';
	}
	$str .= '<div id="tab-original">'.$strs[0].'</div>';
	$str .= '<div id="tab-translation">'.$strs[1].'</div>';
	if(count($strs) == 3)
	{
		$str .= '<div id="tab-romaji">'.$strs[2].'</div>';			
	}
	$str .= '</div>';
	return $str;
}


//shortcode:[pagelink name='abort'][/pagelink]
function shortcode_page_link($atts, $content = null){
	if(!$content)
		return "";
	extract(shortcode_atts(array(
		'id' => '',
		'name'=> '',
	), $atts));	
	
	if($id)
	{
		$link = get_page_link($id);
		return "<a href=\"{$link}\">{$content}</a>";
	}
	if($name){
	    $tmp = get_page_by_path($name);
	    if($tmp)
	    {
	   		$link = get_page_link($tmp->ID);
			return "<a href=\"{$link}\">{$content}</a>";
		}
	}
	return "";
}

//shortcode:[postlink type='post' name='abc'][/postlink]
function shortcode_post_link($atts, $content = null){
	if(!$content)
		return "";
	extract(shortcode_atts(array(
		'type' => 'post',
		'id' => '',
		'name' => '',
	), $atts));	
	if($id)
	{
		$link = get_post_permalink($id);
		return "<a href=\"{$link}\">{$content}</a>";
	}
	if($name){
		$link = get_post_permalink(0,$name);
		return "<a href=\"{$link}\">{$content}</a>";
	}
	return "";
}

//shortcode:[quote type='post' name='xxx'][/quote]
function shortcode_quote($atts, $content = null){
   extract(shortcode_atts(array(
		'type' => 'post',
		'id' => '',
		'name' => '',
	), $atts));	
	
	if($name){
		$query=array(
          'post_type'=> $type,
          'name' => $name);
		$query = get_posts($query);
		if($query)	{
		   $content = $query[0]->post_content;
		   $content = apply_filters('the_content', $content);
		   $content = str_replace(']]>', ']]&gt;', $content);
		   return $content;
       }
		return "";
	}
	if($id){
		$content_post = get_post($my_postid);
		if($content_post)	{
			$content = $content_post->post_content;
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			return $content;
		}
	}
	return "";
}





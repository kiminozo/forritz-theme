<?php
/**
 * The template for post-license.
 */
 $license_type = get_post_meta(get_the_ID(), 'license-type',true);
 if($license_type):
?>

<div id="post-license">

<ul>
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

<?php endif;?>
<?php

/* add a default cd 
----------------------------------------------------*/
function show_default_cd_img($size = array(148,148),$title = 'default-cd') {
	echo get_default_cd_img($size,$title);
}
function get_default_cd_img($size = array(148,148),$title = 'default-cd') {
  $template = custom_get_template_url();
  return sprintf('<img width="%1$s" height="%2$s" src="%3$s/images/default-cd.png" class="wp-post-image" alt="%4$s" title="%4$s" />',$size[0],$size[1], $template,$title);

}


if ( ! function_exists( 'show_custom_term' ) ) :
function show_custom_taxonomy( $post_id, $taxonomy_name,$fomart = 'span'){
	$taxonomy = get_taxonomy($taxonomy_name);
	if($taxonomy){

		$sw_list = get_the_term_list($post_id,$taxonomy->name,'','|','');  
		if ($sw_list){
			$taxonomy_text = "<%s class=\"taxonomy taxonomy-%s\"><span class=\"label\">%s:</span>%s</%s>\n"; 
			printf($taxonomy_text,$fomart,$taxonomy->name,$taxonomy->label,$sw_list,$fomart);
		}   
	}

}
endif;   



/* build_post_types
-----------------------------------------------------------------------------*/
add_action( 'init', 'build_post_types', 0 );  
if ( ! function_exists( 'build_post_types' ) ) :
function build_post_types() {
 //song
 $labels = array(
    'name' => __('Songs', 'forritz'),
    'singular_name' => __('Song', 'forritz'),
    'add_new' => __('Add New', 'forritz'),
    'add_new_item' => __('Add New Song','forritz'),
    'edit_item' => __('Edit Song','forritz'),
    'new_item' => __('New Song','forritz'),
    'view_item' => __('View Song','forritz'),
    'search_items' => __('Search Song','forritz'),
    'not_found' =>  __('No songs found','forritz'),
    'not_found_in_trash' => __('No songs found in Trash','forritz'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => array('slug' => 'songs'),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title', 'editor', 'trackbacks', 'custom-fields', 'comments', 'revisions', 'page-attributes')
  ); 
  register_post_type('song',$args);
  
  
  //record
  $labels = array(
    'name' => __('Records', 'forritz'),
    'singular_name' => __('Record', 'forritz'),
    'add_new' => __('Add New', 'forritz'),
    'add_new_item' => __('Add New Record','forritz'),
    'edit_item' => __('Edit Record','forritz'),
    'new_item' => __('New Record','forritz'),
    'view_item' => __('View Record','forritz')
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => true, 
    'query_var' => false,
    'exclude_from_search' => false,
    'rewrite' => array('slug' => 'records'),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array( 'title','excerpt','editor', 'custom-fields',  'revisions', 'thumbnail',  'page-attributes')
  ); 
  register_post_type('record',$args);
  
  
  //information
  $labels = array(
    'name' => __('Info', 'forritz'),
    'singular_name' => __('Info', 'forritz'),
    'add_new' => __('Add New', 'forritz'),
    'add_new_item' => __('Add New Info','forritz'),
    'edit_item' => __('Edit Info','forritz'),
    'new_item' => __('New Info','forritz'),
    'view_item' => __('View Info','forritz')
  );
  $args = array(
    'labels' => $labels,
    'public' => false,
    'publicly_queryable' => false,
    'show_ui' => true, 
    'query_var' => false,
    'exclude_from_search' => false,
    'rewrite' => array('slug' => 'info'),
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array()
  ); 
  register_post_type('info',$args);


}
endif;

add_action( 'init', 'build_taxonomies', 0 ); 
if ( ! function_exists( 'build_taxonomies' ) ) :
function build_taxonomies() {
     //discography
     $args = array(
     'label' => __('Discography','forritz'),
     'hierarchical' => true, 
     'query_var' => true,
	 'rewrite' => true );
	 register_taxonomy( 'discography', 'song', $args);  
	 
	  //songwriter
     $args = array(
     'label' => __('Song Writer','forritz'),
     'hierarchical' => false, 
     'query_var' => true,
	 'rewrite' => true );
	 register_taxonomy( 'songwriter', 'song', $args);  



     //lyricwriter
     $args = array(
     'label' => __('Lyric Writer','forritz'),
     'hierarchical' => false, 
     'query_var' => true,
	 'rewrite' => true );
	 register_taxonomy( 'lyricwriter', 'song', $args);  


    //arranger
     $args = array(
     'label' => __('Arranger','forritz'),
     'hierarchical' => false, 
     'query_var' => true,
	 'rewrite' => true );
	 register_taxonomy( 'arranger', 'song', $args);  
	 
	 //singer
     $args = array(
     'label' => __('Singer','forritz'),
     'hierarchical' => false, 
     'query_var' => true,
	 'rewrite' => true );
	 register_taxonomy( 'singer', 'song', $args); 


};
endif;


/*meta_box
----------------------------------------------------*/


add_action( 'admin_menu', 'custom_create_meta_box' );
add_action( 'save_post', 'custom_save_postdata' );

function custom_create_meta_box() {
	add_meta_box('song_custom_box', __('Post Options','forritz'), 'post_song_custom_box', 'song', 'normal', 'high' );
	add_meta_box('record_custom_box', __('Post Options','forritz'), 'post_record_custom_box', 'record', 'normal', 'high' );
}

function post_song_custom_box($post){
    
     $key = 'song-title-trans';
	 $label = __("Song Title Translation:", 'forritz' );
	 $value = get_post_meta($post->ID, $key , true );
	 printf('<label for="%s">%s</label>',$key,$label);
     printf('<input type="text" name="%s" value="%s" size="100" /><br/>',$key, $value);
	
     $value = get_post_meta( $post->ID, 'song-remarks', true );
	 printf('<label for="song-remarks">%s</label>', __("Remarks:", 'forritz' ));
     print('<textarea name="song-remarks" cols="60" rows="4" tabindex="30" style="width: 97%;">'.$value.'</textarea><br/>');
}

function post_record_custom_box($post){
	
	 $key = 'record-no';
	 $label = __("No.:", 'forritz' );
	 $value = get_post_meta($post->ID, $key , true );
	 printf('<label for="%s">%s</label>',$key,$label);
     printf('<input type="text" name="%s" value="%s" size="25" /><br/>',$key, $value);
     
     $key = 'record-price';
	 $label = __("Price:", 'forritz' );
	 $value = get_post_meta($post->ID, $key , true );
	 printf('<label for="%s">%s</label>',$key,$label);
     printf('<input type="text" name="%s" value="%s" size="25" /><br/>',$key, $value);

     $key = 'record-release-date';
	 $label = __("Release Date:", 'forritz' );
	 $value = get_post_meta($post->ID, $key , true );
	 printf('<label for="%s">%s</label>',$key,$label);
     printf('<input type="text" name="%s" value="%s" size="25" /><br/>',$key, $value);
	 
	 $key = 'record-publisher';
	 $label = __("Publisher:", 'forritz' );
	 $value = get_post_meta($post->ID, $key , true );
	 printf('<label for="%s">%s</label>',$key,$label);
     printf('<input type="text" name="%s" value="%s" size="25" /><br/>',$key, $value);
	 
	 $key = 'record-type';
	 $label = __("Record Type:", 'forritz' );
	 $value = get_post_meta($post->ID, $key , true );
	 printf('<label for="%s">%s</label>',$key,$label);
     printf('<input type="text" name="%s" value="%s" size="100" /><br/>',$key, $value);
}


function custom_save_postdata($post_id) {
	if (isset($_POST['_inline_edit'])) //quick_edit
		return $post_id;

	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) //AUTOSAVE
   		return $post_id;


     $post_type = $_POST['post_type'];
	 if ( 'song' ==  $post_type){
	 	if ( !current_user_can( 'edit_post', $post_id ) )
     		 return $post_id;
     	
		$meta_name = 'song-title-trans';
		custom_save_post_meta($post_id, $meta_name);
	 
     	$meta_name = 'song-remarks';
		custom_save_post_meta($post_id, $meta_name);
	 }
	 elseif('record' == $post_type)
	 {
		 if ( !current_user_can( 'edit_post', $post_id ) )
     		 return $post_id;
     		 
	 	 $meta_name = 'record-no';
	 	 custom_save_post_meta($post_id, $meta_name);
	 	 
	 	 $meta_name = 'record-price';
	 	 custom_save_post_meta($post_id, $meta_name);
	 	 
	 	 $meta_name = 'record-release-date';
	 	 custom_save_post_meta($post_id, $meta_name);
	 	 
	 	 $meta_name = 'record-publisher';
	 	 custom_save_post_meta($post_id, $meta_name);

		 $meta_name = 'record-type';
	 	 custom_save_post_meta($post_id, $meta_name);
	 	 
	 	 return $post_id;
	 }
	 else
	 	return $post_id;
}


/* show_meta
------------------------------------------------------------------*/
function show_meta_record_no($post_id){
	printf('<span>%s</span>%s',	__("No.:", 'forritz' ),get_post_meta($post_id,'record-no',true));
}
function show_meta_record_price($post_id){
	printf('<span>%s</span>%s',	__("Price:", 'forritz' ),get_post_meta($post_id,'record-price',true));
}
function show_meta_record_release_date($post_id){
	printf('<span>%s</span>%s',	__("Release Date:", 'forritz' ),get_post_meta($post_id,'record-release-date',true));
}
function show_meta_record_publisher($post_id){
	printf('<span>%s</span>%s',	__("Publisher:", 'forritz' ),get_post_meta($post_id,'record-publisher',true));
}
function show_meta_record_type($post_id){
	printf('<span>%s</span>%s',	__("Record Type:", 'forritz' ),get_post_meta($post_id,'record-type',true));
}

function show_meta_record_artist($record_slug){
	$args=array(
	   'post_type'=>'song',
	   'discography' => $record_slug
    );
	$posts = get_posts($args);
	
	$artists = array();
	foreach($posts as $p){
		$tmp = get_the_term_list($p->ID,'singer');
		if($tmp)
			array_push($artists,$tmp);
	}
	$artists = array_unique($artists);
	$str = '<span>'.__("Artist:", 'forritz' ).'</span>';
	foreach($artists as $p)
		$str .= $p.' ';
	print($str);
}



function show_song_thumbnail($size = array(100,100)){
    $id = get_the_ID();
	$taxonomy = 'discography';
	$terms = get_the_terms($id,$taxonomy);
	if (count( $terms ) == 0)
	{
		show_default_cd_img($size);
		return;
	}
	$term = array_shift($terms);
	$args=	array(
	   'post_type'=>'record',
	   'name' => $term->slug
	);
	$posts = get_posts($args);
	if( count( $posts ) == 0)
	{
		printf('<a href="%s">%s</a>',get_term_link($term,$taxonomy),get_default_cd_img($size,$term->name));
		return;
	}
	$thumbnail = get_the_post_thumbnail(array_shift($posts)->ID,$size);
	if($thumbnail)
		printf('<a href="%s">%s</a>',get_term_link($term,$taxonomy),$thumbnail);
	else
		printf('<a href="%s">%s</a>',get_term_link($term,$taxonomy),get_default_cd_img($size,$term->name));

}



































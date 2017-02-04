<?php


add_action( 'admin_menu', 'custom_create_license_meta_box' );
add_action( 'save_post', 'custom_license_save_postdata' );

function custom_create_license_meta_box() {
	global $theme_name;

	add_meta_box( 'post-license-meta-boxes', __('License Options','forritz'), 'custom_license_meta_boxes', 'post', 'normal', 'high' );
	add_meta_box( 'page-license-meta-boxes', __('License Options','forritz'), 'custom_license_meta_boxes', 'page', 'normal', 'high' );
	add_meta_box( 'song-license-meta-boxes', __('License Options','forritz'), 'custom_license_meta_boxes', 'song', 'normal', 'high' );
}

function custom_license_meta_boxes($post){
	 $key = 'license-type';
	 $label = __("License Type:", 'forritz' );
	 $value = get_post_meta($post->ID, $key,true);
	 $selected = 'selected="selected"';
	 printf('<label for="%s">%s</label>',$key,$label);
	 printf('<select name="%s" style="width: 200px">',$key);
	 printf('<option value="">%s</option>', __('none','forritz'));
  	 printf('<option value="original" %s>%s</option>',$value=='original'?$selected:'', __('original','forritz'));
  	 printf('<option value="reproduced" %s>%s</option>',$value=='reproduced'?$selected:'',__('reproduced','forritz'));
  	 printf('<option value="translated" %s>%s</option>',$value=='translated'?$selected:'',__('translated','forritz'));
	 print('</select><br/>');
	 
	 $key = 'license-author';
	 $label = __("Author:", 'forritz' );
	 $value = get_post_meta($post->ID, $key,true);
	 printf('<label for="%s">%s</label>',$key,$label);
     printf('<input type="text" name="%s" value="%s" size="25" /><br/>',$key, $value);
	 
	 $key = 'license-translator';
	 $label = __("Translator:", 'forritz');
	 $value = get_post_meta($post->ID, $key,true);
	 printf('<label for="%s">%s</label>',$key,$label);
     printf('<input type="text" name="%s" value="%s" size="25" /><br/>',$key, $value);
	 
	 $key = 'license-reproduced-website';
	 $label = __("Reproduced Website:", 'forritz' );
	 $value = get_post_meta($post->ID, $key,true);
	 printf('<label for="%s">%s</label>',$key,$label);
     printf('<input type="text" name="%s" value="%s" size="25" /><br/>',$key, $value);
     
	 $key = 'license-reproduced-url';
	 $label = __("Reproduced Url:", 'forritz' );
	 $value = get_post_meta($post->ID, $key,true);
	 printf('<label for="%s">%s</label>',$key,$label);
     printf('<input type="text" name="%s" value="%s" size="100" /><br/>',$key, $value);
	 


}

function custom_license_save_postdata($post_id) {
	
	if (isset($_POST['_inline_edit'])) //quick_edit
		return $post_id;
	
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) //AUTOSAVE
   		return $post_id;
	
	$post_type = $_POST['post_type'];
	 if ( 'page' ==  $post_type 
	 	|| 'post' == $post_type 
	 	|| 'song' == $post_type){
	 	
		 if ( !current_user_can( 'edit_post', $post_id ) )
     		 return $post_id;
     		 
	 	 $meta_name = 'license-type';
	 	 custom_save_post_meta($post_id, $meta_name);
	 	 
	 	 $meta_name = 'license-author';
	 	 custom_save_post_meta($post_id, $meta_name);
	 	 
	 	 $meta_name = 'license-translator';
	 	 custom_save_post_meta($post_id, $meta_name);
	 	 
	 	 $meta_name = 'license-reproduced-url';
	 	 custom_save_post_meta($post_id, $meta_name);

		 $meta_name = 'license-reproduced-website';
	 	 custom_save_post_meta($post_id, $meta_name);
	 	 
  	     return $post_id;

	 }

}

function custom_save_post_meta($post_id, $meta_name)
{
    $data = stripslashes( $_POST[$meta_name] );
     		 
    if ( get_post_meta( $post_id,$meta_name ) == '' )
		add_post_meta( $post_id, $meta_name, $data);
			
	elseif ( $data != get_post_meta( $post_id,$meta_name, true ) )
		update_post_meta( $post_id, $meta_name, $data );

	elseif ( $data == '' )
		delete_post_meta( $post_id, $meta_name, get_post_meta( $post_id, $meta_name, true ) );
	
}
<?php
/**
 * 
 */

get_header(); ?>

<section class="span3">
	<div id="profile" class='thumbnail '>
		<div class="photo text-center">
			<?php
			printf('<img width="180" height="237" alt="" src="%s/img/steps.jpg"/>',get_template_directory_uri());
			?>
		</div>   
		<div class="info">  
			<h4><?php _e('Okazaki Ritsuko','forritz');?></h4>
			<hr/>
			<?php forritz_content_quote('okazaki-ritsuko','info');?> 
		</div>                 
	</div>
</section>
<section class="span9">
	<!-- Main hero unit for a primary marketing message or call to action -->
	<div class="row">
		<?php forritz_content_quote('home','info');?>
	</div>
	<hr/>
	<div class="row">
		<h4><?php _e('Discography','forritz');?></h4>
		<?php
		$record_names = 
		array("sincerely-yours","joyful-calendar","a-happy-life",
			"ritzberry-fields","rain-or-shine","ohayou",
			"lovehina-okazaki-collection","life-is-lovely",
			"forritz","love-and-life","for-fruit-basket",
			"morning-grace","melodic-hard-cure");
		forritz_record_img_list($record_names,array(80,80));
		?>
		<?php 
		$link = forritz_get_post_link('discography','page');
		printf('<a class="btn" href="%s">%s</a>',$link,__('Learn more »','forritz'));
		?>
	</div>
</section>

<?php get_footer(); ?>
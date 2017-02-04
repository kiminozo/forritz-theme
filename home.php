<?php
/**
 * The template for home
 */
get_header(); ?>

		<div id="container" class="home-page">
			<div id="content" role="main">
			
<div id="profile">
<div id="photo">
<img src="<?php echo custom_get_template_url() ?>/images/lovelife.jpg" alt="" />
</div>   
<div id="info">                      
<?php
$args=array(
   'post_type'=>'info',
   'name' => 'okazaki-ritsuko'
);
$the_query = new WP_Query($args);     
?>
 
<?php if ($the_query->have_posts()) : $the_query->the_post();   ?>    
<div id="info-title"><?php the_title(); ?></div>
<div id="info-content"><?php the_content(); ?> </div>             
<?php endif; ?>
</div>
</div>			
            
<div id="welcome">
<?php
$args=array(
   'post_type'=>'info',
   'name' => 'home'
);
$the_query = new WP_Query($args);
if ($the_query->have_posts()) : $the_query->the_post(); 
		 the_content();
endif; ?>
</div><!--#welcome-->

<?php 
$args=array(
   'post_type'=>array('post','song'),
   'posts_per_page' => 5,
   'orderby' => 'modified'
);
query_posts($args); 
?>	
<div id="news">
<h4><?php _e("lastest news","forritz")?></h4>
<ul>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<li id="post-<?php the_ID(); ?>">
					<span class="date"><?php the_modified_date(); ?></span>
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li><!-- #post-## -->
<?php endwhile; ?>
</ul> 
</div><!--#news-->      

			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
   
		
		

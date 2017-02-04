<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package forritz
 */

get_header(); ?>

		<div id="container">
			<div id="content" role="main">

				<h1 class="page-title"><?php
					printf( __( 'Category Archives: %s', 'twentyten' ), '<span>' . single_cat_title( '', false ) . '</span>' );
				?></h1>
				<?php
					$category_description = category_description();
					if (! empty( $category_description ) ):?>
					
						<div class="sub-title"><?php _e('Summary','forritz')?></div>
						<div class="category-description"><?php echo $category_description ?></div>						
					<?php endif;?>
					
				<?php if(have_posts()):?>	
				<div class="sub-title"><?php _e('Post List','forritz')?></div>	
				<?php endif;?>
				<?php
				/* Run the loop for the category page to output the posts.
				 * If you want to overload this in a child theme then include a file
				 * called loop-category.php and that will be used instead.
				 */
				get_template_part( 'loop', 'category' );
				?>
			</div><!-- #content -->
		</div><!-- #container -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

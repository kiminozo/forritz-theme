<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package ForRITZ
 * @subpackage Two
 * @since ForRITZ Theme 1.0
 */
?>

	<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
		<section id="secondary" class="widget-area span3" role="complementary">
			<div class="well sidebar-nav">
				<?php dynamic_sidebar( 'main-sidebar' ); ?>
			</div>
		</section><!-- #secondary -->
	<?php endif; ?>
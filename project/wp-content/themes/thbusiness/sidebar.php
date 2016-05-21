<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package thbusiness
 */
?>
	<div id="secondary" class="widget-area" role="complementary">
		<?php if ( ! dynamic_sidebar( 'thbusiness-main-sidebar' ) ) : ?>
			<?php get_search_form(); ?>
		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->

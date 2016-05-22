<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package thbusiness
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="page-header">
		<?php /* the_title( '<h1 class="page-title">', '</h1>' ); */ ?>
	</header><!-- .page-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'thbusiness' ),
				'after'  => '</div>',
				'link_before' => '<span>',
				'link_after' => '</span>',
			) );
		?>
	</div><!-- .entry-content -->
	<footer class="entry-footer-insinglepost">
		<?php edit_post_link( __( 'Edit', 'thbusiness' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

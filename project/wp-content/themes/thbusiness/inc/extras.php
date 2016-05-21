<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package thbusiness
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 * @return array
 */
function thbusiness_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'thbusiness_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function thbusiness_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'thbusiness_body_classes' );

/**
 * Add backward compatibility for the title-tag.
 */
if ( ! function_exists( '_wp_render_title_tag' ) ) {

function thbusiness_render_title() { ?>

	<title><?php wp_title( '|', true, 'right' ); ?></title>

<?php }
	
add_action( 'wp_head', 'thbusiness_render_title' );

}

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 * @return void
 */
function thbusiness_setup_author() {
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'thbusiness_setup_author' );

/**
 * Sets the post excerpt length to 70 words.
 *
 * function tied to the excerpt_length filter hook.
 *
 * @uses filter excerpt_length
 */
function thbusiness_excerpt_length( $length ) {
	return 70;
}
add_filter( 'excerpt_length', 'thbusiness_excerpt_length' );

/**
 * Replaces content [...] with ...
 */
function thbusiness_excerpt_more() {
	return '&hellip; ';
}
add_filter( 'excerpt_more', 'thbusiness_excerpt_more' );

/**
 * Custom length excerpt
 */
function thbusiness_excerpt( $limit ) {
    return wp_trim_words( get_the_excerpt(), $limit );
}


/**
* thbusiness slider function inserts a slider.
*/
if ( !function_exists( 'thbusiness_homepage_slider' ) ) :

function thbusiness_homepage_slider() {
global $post;
?>

<section class="slider">
	<div class="flexslider">
		<ul class="slides">
			<?php
				for( $i = 1; $i <= 8; $i++ ) {
					$slider_title = get_theme_mod( 'custom_slide_title_'.$i , '' );
					$slider_description = get_theme_mod( 'custom_slide_description_'.$i , '' );
					$slider_image = get_theme_mod( 'custom_slide_img_'.$i , '' );
					$slider_link = get_theme_mod( 'custom_slide_url_'.$i , '#' );
					$slider_link_text = get_theme_mod( 'custom_slide_button_text_'.$i , 'Read More' );
				?>
					<?php  if( !empty( $thbusiness_pro_header_title ) || !empty( $slider_description ) || !empty( $slider_image ) ) : ?>
					<li>
						<div class="th-slider-container">
							<figure>
								<img alt="<?php echo esc_attr( $slider_title ); ?>" src="<?php echo esc_url( $slider_image ); ?>">
							</figure>

							<?php if( !empty( $slider_title ) || !empty( $slider_description ) ) { ?>
								<div class="container">
									<div class="th-slider-details-container">
										<?php if( !empty( $slider_title ) ) { ?>
											<div class="th-slider-title">
												<h3><a href="<?php echo esc_url( $slider_link ); ?>" title="<?php echo esc_attr( $slider_title ); ?>"><span><?php echo $slider_title; ?></span></a></h3>
											</div><!-- .th-slider-title -->
										<?php } ?>
										
										<?php if( !empty( $slider_description ) ) { ?>
											<div class="th-slider-description">
												<p><?php echo $slider_description; ?></p>
											</div><!-- .th-slider-description -->
										<?php } ?>
										<?php if( !empty( $slider_link_text ) ) { ?>
											<div class="th-slider-readmore-button">
												<a href="<?php echo esc_url( $slider_link ); ?>" title="<?php echo esc_attr( $slider_title ); ?>"><?php echo $slider_link_text; ?></a>
											</div><!-- .th-slider-readmore-button -->
										<?php } ?>
									</div><!-- .th-slider-details-container -->
								</div><!-- .container -->
							<?php } ?>
						</div><!-- .th-slider-container -->
					</li>
					<?php endif; ?>
			<?php } ?>
		</ul>
	</div>
</section>

<?php }

endif;
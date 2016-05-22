<?php
/**
 * Contains all the functions related to widgets.
 *
 * @package thbusiness.
 */

/**
 * Widget to display pages as services.
 */
class Thbusiness_Services_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'thbusiness_services_widget', // Base ID
			__( 'THBusiness Services Widget', 'thbusiness' ), // Name
			array( 'description' => __( 'Displays pages as services. Best for Business Template Top/Bottom Area.', 'thbusiness' ), ) // Args
		);	
	}

	public function form( $instance ) { 
 		for ( $i=0; $i<6; $i++ ) {
 			$var = 'page_id'.$i;
 			$icons = 'icon'.$i;
 			$defaults[$icons] = '';
 			$defaults[$var] = '';
 		}

 		$instance = wp_parse_args( (array) $instance, $defaults );
 		for ( $i=0; $i<6; $i++ ) {
 			$var = 'page_id'.$i;
 			$var = absint( $instance[ $var ] );
		}

	?>
		<?php _e( 'If there is not an icon it will display the featured image of the page as the icon.<br /> Give the name of the font awesome icon to the Icon input field.You can find the icon names from the readme.txt <br /> eg: fa-angle-double-up', 'thbusiness' ); ?>
		<?php for( $i=0; $i<6; $i++) { ?>
		<?php $j = $i+1; ?>
			<p>
				<label for="<?php echo $this->get_field_id( 'icon'.$i ); ?>"><?php _e( 'Icon ', 'thbusiness' ); echo $j; ?>:</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'icon'.$i ); ?>" name="<?php echo $this->get_field_name( 'icon'.$i ); ?>" value="<?php echo esc_attr( $instance[ 'icon'.$i ] ); ?>" />
			</p>		
			<p>
				<label for="<?php echo $this->get_field_id( 'page_id'.$i ); ?>"><?php _e( 'Page ', 'thbusiness' ); echo $j; ?>:</label>
				<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'page_id'.$i ), 'selected' => $instance[ 'page_id'.$i ], 'class' => 'widefat' ) ); ?>
			</p>
		<?php
		
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		for( $i=0; $i<6; $i++ ) {
			$var = 'page_id'.$i;
			$instance[ $var ] = absint( $new_instance[ $var ] );
			$instance[ 'icon'.$i ] = strip_tags( $new_instance[ 'icon'.$i ] ); 
		}

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$page_array = array();

 		for( $i=0; $i<6; $i++ ) {
 			$icon = 'icon'.$i;
 			$var = 'page_id'.$i;
 			$icons[] = isset( $instance[ $icon ] ) ? $instance[ $icon ] : '';
 			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';


 			if( !empty( $page_id ) ) {
 				array_push( $page_array, $page_id );// Push the page id in the array
 			}
 		}
		$get_services_pages = new WP_Query( array(
			'posts_per_page' 			=> -1,
			'post_type'					=>  array( 'page' ),
			'post__in'		 			=> $page_array,
			'orderby' 		 			=> 'post__in'
		) ); 
	?>
	<div class="container-fluid th-business-page-widget">
	<div class="container">
	<div class="row">
		<?php echo $before_widget; ?>
		<?php 
			$k = 1; 
			$i = 0;
		?>

		<?php while ($get_services_pages->have_posts()) : $get_services_pages->the_post(); ?>

			<?php
				if ( $k==3 ) {
					$class="col-xs-12 col-sm-6 col-md-4 col-lg-4 th-clear-third";
				} elseif ( $k==4 ) {
					$class="col-xs-12 col-sm-6 col-md-4 col-lg-4 th-clear-fourth";			
				} else {
					$class="col-xs-12 col-sm-6 col-md-4 col-lg-4";
				}
			?>
			<div class="<?php echo $class; ?>">
				<div class="th-services-box">
					<?php if( ( has_post_thumbnail() ) && ( empty ($icons[$i]) ) )  { ?>
						<div class="th-services-image">
							<?php the_post_thumbnail( 'small' ); ?>
						</div>
					<?php } elseif( !empty($icons[$i]) ) { ?>
						<div class="th-services-icon">
							<i class="fa th-fa-services-custom <?php echo esc_attr( $icons[$i] ); ?>"></i>
						</div>
					<?php } ?>	
					<?php echo $before_title; ?><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a><?php echo $after_title; ?>
					<article class="th-front-page-summery">
						<?php 
						if ( empty( $post->post_excerpt ) ) {
							echo thbusiness_excerpt(30); 
						} else {
							echo the_excerpt();
						}
						
						?>
					</article>
					<div class="th-morelink-sep"><a class="th-morelink" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'thbusiness' ) ?></a></div>
				</div><!-- .thbusiness-services-boxset -->
			</div>

		<?php 
			$k++; 
			$i++;
		?>
		
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
		<?php echo $after_widget; ?>
	</div><!-- .row -->
	</div><!-- .container -->
	</div><!-- .container-fluid -->	
	<?php }

}

function thbusiness_register_services_widget() {
	register_widget( 'Thbusiness_Services_Widget' );
}
add_action( 'widgets_init', 'thbusiness_register_services_widget' );


/**
 * Widget to display pages as Recent Work.
 */

class Thbusiness_RecentWork_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'thbusiness_recentwork_widget', // Base ID
			__( 'THBusiness Recent Work Widget', 'thbusiness' ), // Name
			array( 'description' => __( 'Displays pages as recent work.Featured image of the page will show up first. Best for Business Template Top/Bottom Area.', 'thbusiness' ), ) // Args
		);	
	}

	public function form( $instance ) { 
 		for ( $i=0; $i<4; $i++ ) {
 			$var = 'page_id'.$i;
 			$defaults[$var] = '';
 		}
 		$att_defaults = $defaults;
 		$att_defaults['title'] = '';
 		$att_defaults['show_page_titles'] = 1;
 		$att_defaults['show_page_excerpts'] = 0;

 		$instance = wp_parse_args( (array) $instance, $att_defaults );
 		for ( $i=0; $i<4; $i++ ) {
 			$var = 'page_id'.$i;
 			$var = absint( $instance[ $var ] );
		}
		$title = esc_attr( $instance[ 'title' ] );
		$show_page_titles = $instance['show_page_titles'] ? 'checked="checked"' : '';
		$show_page_excerpts = $instance['show_page_excerpts'] ? 'checked="checked"' : '';

	?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'thbusiness' ); ?></label> 
			<input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>	
		<p>
			<input class="checkbox" type="checkbox" <?php echo $show_page_titles; ?> id="<?php echo $this->get_field_id( 'show_page_titles' ); ?>" name="<?php echo $this->get_field_name( 'show_page_titles' ); ?>" />		
			<label for="<?php echo $this->get_field_id( 'show_page_titles' ); ?>"><?php _e( 'Display page titles.', 'thbusiness' ); ?></label> 
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo $show_page_excerpts; ?> id="<?php echo $this->get_field_id( 'show_page_excerpts' ); ?>" name="<?php echo $this->get_field_name( 'show_page_excerpts' ); ?>" />		
			<label for="<?php echo $this->get_field_id( 'show_page_excerpts' ); ?>"><?php _e( 'Display page excerpts.', 'thbusiness' ); ?></label> 
		</p>
		
		<?php for( $i=0; $i<4; $i++) { ?>
			<p>
				<label for="<?php echo $this->get_field_id( key($defaults) ); ?>"><?php _e( 'Page', 'thbusiness' ); ?>:</label>
				<?php wp_dropdown_pages( array( 'show_option_none' =>' ','name' => $this->get_field_name( key($defaults) ), 'selected' => $instance[key($defaults)] ) ); ?>
			</p>
		<?php
		next( $defaults );// forwards the key of $defaults array
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );		
		$instance[ 'show_page_titles' ] = isset( $new_instance[ 'show_page_titles' ] ) ? 1 : 0;
		$instance[ 'show_page_excerpts' ] = isset( $new_instance[ 'show_page_excerpts' ] ) ? 1 : 0;


		for( $i=0; $i<4; $i++ ) {
			$var = 'page_id'.$i;
			$instance[ $var] = absint( $new_instance[ $var ] );
		}

		return $instance;
	}

	function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );

 		global $post;
 		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
		$show_page_titles = isset( $instance['show_page_titles'] ) ? $instance['show_page_titles'] : false;
		$show_page_excerpts = isset( $instance['show_page_excerpts'] ) ? $instance['show_page_excerpts'] : false;

 		$page_array = array();
 		for( $i=0; $i<4; $i++ ) {
 			$var = 'page_id'.$i;
 			$page_id = isset( $instance[ $var ] ) ? $instance[ $var ] : '';
 			
 			if( !empty( $page_id ) )
 				array_push( $page_array, $page_id );// Push the page id in the array
 		}
		$get_services_pages = new WP_Query( array(
			'posts_per_page' 			=> -1,
			'post_type'					=>  array( 'page' ),
			'post__in'		 			=> $page_array,
			'orderby' 		 			=> 'post__in'
		) ); 
	?>
	<div class="container-fluid th-business-page-widget">
	<div class="container">
	<div class="row">
		<?php echo $before_widget; ?>
		<?php if ( !empty($title) ) {
			 echo $before_title . esc_html($title) . $after_title; 
		} ?>
		<?php while ($get_services_pages->have_posts()) : $get_services_pages->the_post(); ?>

			<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
				<div class="th-recentwork-box">
					
					<?php if ( has_post_thumbnail() ) : ?>
						<div class="recentwork-image"><a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'featured' ); ?></a></div>
					<?php endif; ?>
					
					<?php if ( ( $show_page_titles == true ) || ( ! has_post_thumbnail() ) )	: ?>						
						<div class="th-recentwork-title"><h1><a title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1></div>
					<?php endif; ?>

					<?php if ( ( $show_page_excerpts == true ) || ( ! has_post_thumbnail() ) ) : ?>
						<article class="th-front-page-summery">
						<?php
							if ( empty( $post->post_excerpt ) ) {
								echo thbusiness_excerpt(30); 
							} else {
								echo the_excerpt();
							}
						?>
						</article>
					<?php endif; ?>
				
				</div><!-- .thbusiness-services-box -->
			</div><!-- .col-xs-12 .col-sm-6 .col-md-3 .col-lg-3 -->
		
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
		<?php echo $after_widget; ?>
	</div><!-- .row -->
	</div><!-- .container -->
</div><!-- .container-fluid -->
<?php }

}

function thbusiness_register_recentwork_widget() {
	register_widget( 'Thbusiness_RecentWork_Widget' );
}
add_action( 'widgets_init', 'thbusiness_register_recentwork_widget');


/**
 * Widget to display call to action.
 */
class Thbusiness_CallTo_Action extends WP_Widget {

	function __construct() {
		parent::__construct(
			'thbusiness_callto_action', // Base ID
			__( 'THBusiness Call To Action', 'thbusiness' ), // Name
			array( 'description' => __( 'Displays a call to action widget.Best for Business Template Top/Bottom Area.', 'thbusiness' ), ) // Args
		);	
	}

	public function form( $instance ) {
		$thbusiness_defaults[ 'action_title' ] = '';
		$thbusiness_defaults[ 'action_text' ] = ''; 
		$thbusiness_defaults[ 'button_text' ] = '';
		$thbusiness_defaults[ 'button_url' ] = '';
		$instance = wp_parse_args( (array) $instance, $thbusiness_defaults );
		$action_title = esc_textarea( $instance['action_title'] );
		$action_text = esc_textarea( $instance['action_text'] );
		$button_text = esc_attr( $instance['button_text'] );
		$button_url = esc_url( $instance['button_url'] );
	?>

		<p><?php _e( 'Call to Action Main Text','thbusiness' ); ?></p>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('action_title'); ?>" name="<?php echo $this->get_field_name('action_title'); ?>"><?php echo $action_title; ?></textarea>
		<p><?php _e( 'Call to Action Additional Text','thbusiness' ); ?></p>
		<textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('action_text'); ?>" name="<?php echo $this->get_field_name('action_text'); ?>"><?php echo $action_text; ?></textarea>
		<p>
			<label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e( 'Button Text:', 'thbusiness' ); ?></label> 
			<input id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e( 'Button Redirect Link:', 'thbusiness' ); ?></label> 
			<input id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" />
		</p>
<?php }

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		if ( current_user_can( 'unfiltered_html' ) )
			$instance['action_title'] =  $new_instance['action_title'];
		else
			$instance['action_title'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['action_title']) ) ); 

		if ( current_user_can('unfiltered_html') )
			$instance['action_text'] =  $new_instance['action_text'];
		else
			$instance['action_text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['action_text']) ) ); 	

		$instance[ 'button_text' ] = strip_tags( $new_instance[ 'button_text' ] );
		$instance[ 'button_url' ] = esc_url_raw( $new_instance[ 'button_url' ] );

		return $instance;
	}

	public function widget( $args, $instance ) {
		extract( $args );
		extract( $instance );

		global $post;
		$action_title = empty( $instance[ 'action_title' ] ) ? '' : $instance[ 'action_title' ];
		$action_text = empty( $instance[ 'action_text' ] ) ? '' : $instance[ 'action_text' ];
		$button_text = isset( $instance[ 'button_text' ] ) ? $instance[ 'button_text' ] : '';
		$button_url	= isset( $instance[ 'button_url' ] ) ? $instance[ 'button_url' ] : '#';

	echo $before_widget; ?>

	<div class="container-fluid call-to-action-wrapper">
		<div class="container">
		<div class="row">

			<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
				<div class="call-to-action-content">
					<?php if( !empty( $action_title) ) { ?>
						<h3><?php echo esc_html( $action_title ); ?></h3>
					<?php } ?>
					<?php if( !empty( $action_text ) ) { ?>
						<p><?php echo esc_html( $action_text ); ?></p>
					<?php } ?>
				</div><!-- .call-to-action-content -->
			</div><!-- col-xs-9 col-sm-9 col-md-9 col-lg-9 -->

			<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
				<?php if( !empty($button_text) ) { ?>
					<a class="call-to-action-button" href="<?php echo $button_url; ?>" title="<?php echo esc_attr( $button_text ); ?>"><?php echo esc_html( $button_text ); ?></a>				
				<?php } ?>
			</div><!-- col-xs-3 col-sm-3 col-md-3 col-lg-3 -->

		</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- .container-fluid -->
	<?php echo $after_widget; 
	
	}

}

function thbusiness_register_callto_action_widget() {
	register_widget( 'Thbusiness_CallTo_Action' );
}
add_action( 'widgets_init', 'thbusiness_register_callto_action_widget' );



/**
 * Widget to display a Single Page inside the business page.
 */
class Thbusiness_SinglePage_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'thbusiness_singlepage_widget', // Base ID
			__( 'THBusiness Single Page Widget', 'thbusiness' ), // Name
			array( 'description' => __( 'Displays a single Page along with the featured image.', 'thbusiness' ), ) // Args
		);	
	}

	public function form( $instance ) {
 		$instance = wp_parse_args( (array) $instance, array( 'page_id' => '', 'title' => '', 'disable_feature_image' => 0 ) );
		$title = esc_attr( $instance[ 'title' ] );
		$page_id = absint( $instance[ 'page_id' ] );
		$disable_feature_image = $instance['disable_feature_image'] ? 'checked="checked"' : '';
	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title' , 'thbusiness' ); ?>:</label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />	
	</p>
	<p><?php _e( 'Displays the page title if this title field is empty', 'thbusiness' ); ?></p>

	<p>
		<label for="<?php echo $this->get_field_id( 'page_id' ); ?>"><?php _e( 'Page', 'thbusiness' ); ?></label>
		<?php wp_dropdown_pages( array( 'name' => $this->get_field_name( 'page_id' ), 'selected' => $instance['page_id'] ) ); ?>
	</p>
	<p>
		<input class="checkbox" type="checkbox" <?php echo $disable_feature_image; ?> id="<?php echo $this->get_field_id('disable_feature_image'); ?>" name="<?php echo $this->get_field_name('disable_feature_image'); ?>" /> <label for="<?php echo $this->get_field_id('disable_feature_image'); ?>"><?php _e( 'Remove Featured image', 'thbusiness' ); ?></label>
	</p>

	<?php }

	function update( $new_instance , $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'page_id' ] = absint( $new_instance[ 'page_id' ] );
		$instance[ 'disable_feature_image' ] = isset( $new_instance[ 'disable_feature_image' ] ) ? 1 : 0;

		return $instance;		
	}

	public function widget( $args, $instance ) {
 		extract( $args );
 		extract( $instance );
 		global $post;
 		$title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
 		$page_id = isset( $instance[ 'page_id' ] ) ? $instance[ 'page_id' ] : '';
 		$disable_feature_image = !empty( $instance[ 'disable_feature_image' ] ) ? 'true' : 'false';	

 		if( $page_id ) :
 			$the_query = new WP_Query( 'page_id='.$page_id );
 			while( $the_query->have_posts() ):$the_query->the_post();
 				$page_name = get_the_title();

	 		$before_widget; ?>
	 		<div class="th-singlepage-widget">
		 	 	
		 	 	<?php if ( $title ) { ?>
		 	 		<?php echo $before_title; ?><a href="<?php the_permalink(); ?>" title="<?php echo $title; ?>"><?php echo esc_attr( $title ); ?></a><?php echo $after_title; ?>
		 	 	<?php } else { ?> 
		 	 		<?php echo $before_title; ?><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a><?php echo $after_title; ?>
		 		<?php } ?> 
		 	 	<?php
		 	 	if( has_post_thumbnail() && $disable_feature_image != "true" ) { ?>
		 	 		<div class="th-singlepage-widget-image">
		 	 			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( 'large' ); ?></a> 
		 	 		</div>		
				<?php } ?>

				<article class="th-front-page-summery">
					<?php echo thbusiness_excerpt(45); ?>
				</article>
				<a class="singlepage-widget-moretag" title="<?php the_title_attribute(); ?>" href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'thbusiness' ) ?></a>
			</div><!-- th-singlepage-widget -->
	<?php 
		$after_widget;
	 	endwhile;
	 	// Reset Post Data
	 	wp_reset_postdata();
	 	
	endif;
}

}		

function thbusiness_register_singlepage_widget() {
	register_widget( 'Thbusiness_SinglePage_Widget' );
}
add_action( 'widgets_init', 'thbusiness_register_singlepage_widget' );


/**
 * Widget to display testimonial.
 */
class Thbusiness_Testimonial_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'thbusiness_testimonial', // Base ID
			__( 'THBusiness Testimonial', 'thbusiness' ), // Name
			array( 'description' => __( 'Displays a testimonial.Best for Business Template Left/Right Area.', 'thbusiness' ), ) // Args
		);	
	}

	public function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'image' => '', 'description' => '', 'name' => '', 'designation' => '', 'company_name' => '', 'company_url' => '' ) );
		$title = strip_tags( $instance['title'] );
		$image = strip_tags( $instance['image'] );
		$description = esc_textarea( $instance['description'] );
		$name = strip_tags( $instance['name'] );
		$designation = strip_tags( $instance['designation'] );
		$company_name = strip_tags( $instance['company_name'] );
		$company_url = strip_tags( $instance['company_url'] );

	?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'thbusiness' ); ?>:</label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($title); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'description' ); ?>"><?php _e( 'Description', 'thbusiness' ); ?>:</label>
		<textarea class="widefat" cols="20" rows="8" id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' )?>"><?php echo $description; ?></textarea>
	</p>
	<p>
		<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e( 'Name', 'thbusiness' ); ?>:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" type="text" value="<?php echo esc_attr($name); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'designation' ); ?>"><?php _e( 'designation', 'thbusiness' ); ?>:</label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'designation' ); ?>" name="<?php echo $this->get_field_name( 'designation' ); ?>" value="<?php echo esc_attr($designation); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'company_name' ); ?>"><?php _e( 'Company Name', 'thbusiness' ); ?>:</label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'company_name' ); ?>" name="<?php echo $this->get_field_name( 'company_name' ); ?>" value="<?php echo esc_attr($company_name); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'company_url' ); ?>"><?php _e( 'Company Url', 'thbusiness' ); ?>:</label>
		<input class="widefat" type="text" id="<?php echo $this->get_field_id( 'company_url' ); ?>" name="<?php echo $this->get_field_name( 'company_url' ); ?>" value="<?php echo esc_url_raw($company_url); ?>" />
	</p>
	<p>
		<label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e('Image', 'thbusiness') ?></label>
	</p>
	<p><?php _e( 'Upload a square image( width : height = 1 : 1). Do not upload large images, that will increase the site loading time.', 'thbusiness' ) ?></p>
	<div class="media-picker-wrap">
        <?php if(!empty($instance['image'])) { ?>
			<img style="max-width:100%; height:auto;" class="media-picker-preview" src="<?php echo esc_url($instance['image']); ?>" />
            <span class="media-picker-remove">X</span>
        <?php } ?>
        <input class="widefat media-picker" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" value="<?php echo esc_url( $instance['image'] ); ?>" type="hidden" />
        <a class="media-picker-button button" onclick="mediaPicker(this.id)" id="<?php echo $this->get_field_id( 'image' ).'mpick'; ?>"><?php _e('Select Image', 'thbusiness') ?></a>
    </div>	

	<?php }


	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'description' ] = strip_tags( $new_instance[ 'description' ] );
		$instance[ 'name' ] = strip_tags( $new_instance[ 'name' ] );
		$instance[ 'designation' ] = strip_tags( $new_instance[ 'designation' ] );		
		$instance[ 'company_name' ] = strip_tags( $new_instance[ 'company_name' ] );
		$instance[ 'company_url' ] = strip_tags( $new_instance[ 'company_url' ] );
		$instance[ 'image' ] = strip_tags( $new_instance[ 'image' ] );

		if ( current_user_can('unfiltered_html') )
			$instance['description'] =  $new_instance['description'];
		else
			$instance['description'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['description']) ) ); // wp_filter_post_kses() expects slashed
			$instance['filter'] = isset($new_instance['filter']);	

		return $instance;											
	}


	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );	
		$description = apply_filters( 'description', empty( $instance['description'] ) ? '' : $instance['description'], $instance );
		$name = apply_filters( 'name', empty( $instance['name'] ) ? '' : $instance['name'], $instance, $this->id_base );
		$company_name = apply_filters( 'company_name', empty( $instance['company_name'] ) ? '' : $instance['company_name'], $instance, $this->id_base );
		$company_url = apply_filters( 'company_url', empty( $instance['company_url'] ) ? '' : $instance['company_url'], $instance, $this->id_base );
		$designation = apply_filters( 'designation', empty( $instance['designation'] ) ? '' : $instance['designation'], $instance, $this->id_base );
		$image = apply_filters( 'image', empty( $instance['image'] ) ? '' : $instance['image'], $instance, $this->id_base );

		echo $before_widget; 
	 ?>

		<div class="th-testimonial-widget">
			<?php if ( !empty( $title ) ) { echo $before_title. esc_html( $title ) . $after_title; } ?>
			<article>
				<?php if ( !empty($image) ) : ?>
					<div class="th-testimonial-image">
						<img src="<?php echo esc_url($image)?>" title="<?php echo esc_attr($name); ?>" alt="<?php echo esc_attr($name); ?>" />
					</div>
				<?php endif; ?>
				<div class="testimonial-content">
					<p><?php echo esc_html( $description ); ?></p>
					<div class="testimonial-meta"> <strong><?php echo esc_html( $name ); ?>,</strong> <?php echo esc_html( $designation );  echo ' - '; ?> <a href="<?php echo esc_url($company_url); ?>" title="<?php echo $company_name; ?>" target="_blank"> <?php echo esc_html( $company_name ); ?></a> </div>
			    </div>
			</article> 
		</div>

	<?php }

}

function thbusiness_register_testimonial_widget() {
	register_widget( 'Thbusiness_Testimonial_Widget' );
}
add_action( 'widgets_init', 'thbusiness_register_testimonial_widget' );
 


/**
 * Widget to display clients list or featured images list.
 */
class Thbusiness_Featured_Images extends WP_Widget {

	function __construct() {
		parent::__construct(
			'thbusiness_featured_images', // Base ID
			__( 'THBusiness Featured Images', 'thbusiness' ), // Name
			array( 'description' => __( 'Displays images.You can show customer logos or any other images by this widget.Best for Business Template Top/Bottom Area.', 'thbusiness' ), ) // Args
		);	
	}

	public function form( $instance ) {
	
		for ( $i=0;  $i<4; $i++ ) {
			$image_url = 'image_url'.$i;
			$image_redirect_url = 'image_redirect_url'.$i;
			$defaults[$image_url] = '';
			$defaults[$image_redirect_url] = '';
		}
		$title = 'title';
		$defaults[$title] = '';
		
		$instance = wp_parse_args( (array) $instance, $defaults );
		$title = strip_tags($instance['title']);

		for ( $i=0; $i<4; $i++ ) {
			$image_url = 'image_url'.$i;
			$image_redirect_url = 'image_redirect_url'.$i;
			$instance[ $image_url ] = esc_url( $instance[ $image_url ] );
 			$instance[ $image_redirect_url ] = esc_url( $instance[ $image_redirect_url ] );
		}

		?>
	<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title', 'thbusiness' ); ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	<?php for( $i=0; $i<4; $i++ ) { ?>
	<?php $j = $i+1; ?>
	
	<p>
		<label for="<?php echo $this->get_field_id( 'image_url'.$i ); ?>"><?php _e('Image ', 'thbusiness'); echo $j; ?></label>
	</p>
	<div class="media-picker-wrap">
        <?php if(!empty($instance['image_url'.$i])) { ?>
			<img style="max-width:100%; height:auto;" class="media-picker-preview" src="<?php echo esc_url($instance['image_url'.$i]); ?>" />
            <span class="media-picker-remove">X</span>
        <?php } ?>
        <input class="widefat media-picker" id="<?php echo $this->get_field_id( 'image_url'.$i ); ?>" name="<?php echo $this->get_field_name( 'image_url'.$i ); ?>" value="<?php echo esc_url( $instance['image_url'.$i] ); ?>" type="hidden" />
        <a class="media-picker-button button" onclick="mediaPicker(this.id)" id="<?php echo $this->get_field_id( 'image_url'.$i ).'mpick'; ?>"><?php _e('Select Image', 'thbusiness') ?></a>
    </div>

	<p>
		<label for="<?php echo $this->get_field_id( 'image_redirect_url'.$i ); ?>"><?php _e( 'Image Redirect Link ', 'thbusiness' ); echo $j; ?></label>
		<input type="text" class="widefat" id="<?php echo $this->get_field_id('image_redirect_url'.$i); ?>" name="<?php echo $this->get_field_name( 'image_redirect_url'.$i ); ?>" value="<?php echo esc_url($instance['image_redirect_url'.$i]); ?>" />
	</p>
	<?php } ?>

<?php	}
	
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		for( $i=0; $i<4; $i++ ) {
			$instance['image_url'.$i] = esc_url( $new_instance['image_url'.$i] );
			$instance['image_redirect_url'.$i] = esc_url( $new_instance['image_redirect_url'.$i] );
		}

		return $instance;
	}


	public function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', $instance['title'] );
		
		for ( $i=0; $i<4; $i++ ) {
			$image_url[] = isset( $instance['image_url'.$i] ) ? esc_url( $instance['image_url'.$i] ) : '';
			$image_redirect_url[] = isset( $instance['image_redirect_url'.$i] ) ? esc_url( $instance['image_redirect_url'.$i] ) : '';
		}
	?>
	<div class="th-clients">
		<div class="container-fluid">
		<div class="container">
			<div class="row">
				
			<?php echo $before_title.$title.$after_title; ?>
			<?php for( $i=0; $i<4; $i++ ) {	?>
			<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3">
				<div class="th-client-item-image">
					<?php if ( ! empty($image_redirect_url[$i] ) ) { ?>
						<a href="<?php echo $image_redirect_url[$i]; ?>"><img src="<?php echo $image_url[$i]; ?>"/></a>
					<?php } else { ?> 
						<img src="<?php echo $image_url[$i]; ?>"/>
					<?php } ?>
				</div>	
			</div><!-- col-xs-12 col-sm-6 col-md-3 col-lg-3 -->
			<?php } ?>
			</div><!-- row -->
		</div><!--container -->
		</div><!--container-fluid -->
	</div><!-- .th_clients -->

<?php
	}

}



function thbusiness_featured_images() {
	register_widget( 'Thbusiness_Featured_Images' );
}
add_action( 'widgets_init', 'thbusiness_featured_images' );	
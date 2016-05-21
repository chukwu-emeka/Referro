<?php
/**
 * THBusiness info page
 *
 * @package THBusiness
 */


add_action('admin_menu', 'thbusiness_theme_info');

function thbusiness_theme_info() {
	add_theme_page('THBusiness WordPress Theme Information', 'THBusiness Info', 'edit_theme_options', 'thbusiness-info', 'thbusiness_info_display_content');
}


function thbusiness_info_display_content() { ?>
	
	<div class="thbusiness-theme-info">
		<?php 
			$thbusiness_details = wp_get_theme();
			$version = $thbusiness_details->get( 'Version' ); 
			$name = $thbusiness_details->get( 'Name' ); 
			$description = $thbusiness_details->get( 'Description' ); 
		?>
		<div class="thbusiness-info-header">
			<h1 class="thbusiness-info-title">
				<?php echo strtoupper( $name ) . ' ' . $version; ?>
			</h1>
		</div>
		<div class="thbusiness-info-body">
			<div class="thbusiness-theme-description">
				<p>
					<?php echo $description; ?>
				</p>
			</div>
			<div class="thbusiness-info-blocks">
				<div class="thbusiness-info-block aw-n-margin">
					<span class="dashicons dashicons-visibility"></span>
					<a href="<?php echo esc_url('http://themezhut.com/demo/thbusiness/'); ?>" target="_blank"><?php _e( 'View Demo', 'thbusiness' ); ?></a>
				</div>
				<div class="thbusiness-info-block">
					<span class="dashicons dashicons-book-alt"></span>
					<a href="<?php echo esc_url('http://themezhut.com/thbusiness-theme-documentation/'); ?>" target="_blank"><?php _e( 'Documentation', 'thbusiness' ); ?></a>
				</div>
				<div class="thbusiness-info-block">
					<span class="dashicons dashicons-businessman"></span>
					<a href="<?php echo esc_url('https://wordpress.org/support/theme/thbusiness'); ?>" target="_blank"><?php _e( 'Get Support', 'thbusiness' ); ?></a>
				</div>
				<div class="thbusiness-info-block aw-n-margin">
					<span class="dashicons dashicons-admin-generic"></span>
					<a href="<?php echo admin_url('customize.php'); ?>"><?php _e( 'Customize Site', 'thbusiness' ); ?></a>
				</div>
				<div class="thbusiness-info-block">
					<span class="dashicons dashicons-awards"></span>
					<a href="<?php echo esc_url('http://themezhut.com/themes/thbusiness-pro/'); ?>" target="_blank"><?php _e( 'THBusiness Pro', 'thbusiness' ); ?></a>
				</div>
				<div class="thbusiness-info-block">
					<span class="dashicons dashicons-search"></span>
					<a href="<?php echo esc_url('http://themezhut.com/demo/thbusiness-pro/'); ?>" target="_blank"><?php _e( 'THBusiness Pro Demo', 'thbusiness' ); ?></a>
				</div>

			</div>
		</div>
	</div>

<?php }

add_action( 'admin_menu', 'thbusiness_options_menu_item' );

function thbusiness_options_menu_item() {
	add_theme_page( 'THBusiness Options', 'Theme Options', 'manage_options', 'theme-options', 'thbusiness_options_page', 'dashicons-admin-generic', 100 ); 
}

function thbusiness_options_page() { ?>
	<div class="thbusiness-theme-info thbusiness-options">
		<p><?php _e( 'As per the new guidelines to remove theme options panels of the themes that are available on WordPress.org, we have completely removed the "Theme Options" panel with the new THBusiness 2.0 update. All the settings and options are now located in the theme customizer. Go to <b>"Appearence > Customize"</b> to find the Customizer or please use the "Contact Us" link below if you have run into any issues with the update.', 'thbusiness' ); ?></p>
		<p><a href="<?php echo admin_url('customize.php'); ?>"><?php _e( 'Go to customizer.', 'thbusiness' ); ?></a></p>
		<a href="<?php echo esc_url('http://themezhut.com/contact/'); ?>" target="_blank"><?php _e( 'Contact Us', 'thbusiness' ); ?></a>
	</div>
<?php }
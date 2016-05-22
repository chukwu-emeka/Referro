<div class="top-bar">
    <div class="top-logo">
        <div class="logo">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="http://localhost/project/wp-content/uploads/2016/05/logo.png" /></a>
        </div>
        <div class="site-name">
            <p><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Project Agape</a></p>
        </div>
        <div class="search">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="" method="get">
                <input type="text" value="" name="s" id="s" class="search-field"/>
                <input type="submit" value="<?php esc_attr_e( 'Search', 'thbusiness' ); ?>" />
            </form>
        </div>
    </div>
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-xs-12 col-sm-12">
				
				<?php  
					$tp_text = get_theme_mod( 'telephone_text', '' );
					$tp_num = get_theme_mod( 'telephone_number', '' );
					if ( ! empty( $tp_text ) || ! empty( $tp_num ) ) { ?>
						<div class="topbar-icon"><i class="fa fa-phone"></i></div><?php echo esc_html( $tp_text ) . ' ' . esc_html( $tp_num ) ?>
				<?php } ?>

				<?php 
					$email_text = get_theme_mod( 'email_text', '' );
					$email_address = get_theme_mod( 'email_address', '' );
					if( ! empty( $email_text ) || ! empty( $email_address ) ) { ?>
						<div class="topbar-icon"><i class="fa fa-envelope"></i></div><?php echo esc_html( $email_text ); ?><a href="mailto:<?php echo esc_html( $email_address ); ?>" target="_top"> <?php echo esc_attr($email_address); ?></a>
				<?php } ?>

				<?php 
					$top_bar_text = get_theme_mod( 'topbar_custom_text', '' );
					if( ! empty( $top_bar_text ) ) {
						echo '<div class="topbar-editor">' . esc_textarea( $top_bar_text ) . '</div>';
					} 
				?>

			</div>
			<div class="col-md-6 col-xs-12 col-sm-12">

			<?php
			if ( get_theme_mod( 'display_social_icons', '1' ) == '1' ) : ?>
				<div class="th-social-area">
				<?php 
					$social_text = get_theme_mod( 'social_media_text', '' ); 
					if( ! empty( $social_text ) ) {
						echo '<span class="social-text">' . esc_html( $social_text ) . '</span>'; 
					}
				?>
				<?php if ( get_theme_mod( 'facebook_url','' ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'facebook_url','') ) ?>" target="_blank"><div class="th-social-icon facebook"><i class="fa fa-facebook"></i></div></a>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'twitter_url','' ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'twitter_url','') ) ?>" target="_blank"><div class="th-social-icon twitter"><i class="fa fa-twitter"></i></div></a>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'googleplus_url','' ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'googleplus_url','') ) ?>" target="_blank"><div class="th-social-icon googleplus"><i class="fa fa-google-plus"></i></div></a>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'linkedin_url','' ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'linkedin_url','') ) ?>" target="_blank"><div class="th-social-icon linkedin"><i class="fa fa-linkedin"></i></div></a>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'youtube_url','' ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'youtube_url','') ) ?>" target="_blank"><div class="th-social-icon youtube"><i class="fa fa-youtube"></i></div></a>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'dribbble_url','' ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'dribbble_url','') ) ?>" target="_blank"><div class="th-social-icon dribbble"><i class="fa fa-dribbble"></i></div></a>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'github_url','' ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'github_url','') ) ?>" target="_blank"><div class="th-social-icon github"><i class="fa fa-github"></i></div></a>
				<?php endif; ?>
				<?php if ( get_theme_mod( 'flickr_url','' ) ) : ?>
					<a href="<?php echo esc_url( get_theme_mod( 'flickr_url','') ) ?>" target="_blank"><div class="th-social-icon flickr"><i class="fa fa-flickr"></i></div></a>
				<?php endif; ?>
				</div>
				
			<?php endif; ?>
			</div>
		</div>
	</div>
</div>
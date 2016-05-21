<?php
/**
 * Thbusiness Theme Customizer
 *
 * @package thbusiness
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function thbusiness_customize_register( $wp_customize ) {

	require( get_template_directory() . '/inc/customizer/custom-controls/control-custom-content.php' );

	$wp_customize->remove_section( 'themes' );
	$wp_customize->remove_control( 'display_header_text' );
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_section( 'static_front_page' )->panel 	= 'thbusiness_home_settings';
    $wp_customize->get_section( 'background_image' )->panel 	= 'thbusiness_styling';
    $wp_customize->get_section( 'header_image' )->panel 		= 'thbusiness_styling';
    $wp_customize->get_section( 'colors' )->panel 				= 'thbusiness_styling';
    


	/**
	 * Header Settings Panel
	 */
	$wp_customize->add_panel( 
		'thbusiness_header_settings', 
		array(
			'title' => __( 'Header Settings', 'thbusiness' ),
			'description' => __( 'Use this panel to set your header settings', 'thbusiness' ),
			'priority' => 25, 
		) 
	);


	// Logo image
    $wp_customize->add_setting(
        'site_logo',
        array(
            'sanitize_callback' => 'thbusiness_sanitize_image'
        ) 
    ); 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_logo',
            array(
                'label'         => __( 'Site Logo', 'thbusiness' ),
                'section'       => 'title_tagline',
                'settings'      => 'site_logo',
                'description' 	=> __( 'Upload a logo for your website. Recommended height for your logo is 135px.', 'thbusiness' ),
            )
        )
    );

    // Logo, title and description chooser
    $wp_customize->add_setting(
        'site_title_option',
        array (
            'default'           => 'text_only',
            'sanitize_callback' => 'thbusiness_sanitize_logo_title_select',
            'transport'         => 'refresh'
        )
    );
    $wp_customize->add_control(
        'site_title_option',
        array(
            'label'     	=> __( 'Display site title / logo.', 'thbusiness' ),
            'section'   	=> 'title_tagline',
            'type'      	=> 'radio',
            'description'	=> __( 'Choose your preferred option.', 'thbusiness' ),
            'choices'   => array (
                'text_only' 	=> __( 'Display site title and description only.', 'thbusiness' ),
                'logo_only'     => __( 'Display site logo image only.', 'thbusiness' ),
                'display_none'	=> __( 'Display none', 'thbusiness' )
            )
        )
    );

    // Site favicon
	$wp_customize->add_setting(
        'site_favicon',
        array(
            'sanitize_callback' => 'thbusiness_sanitize_image'
        ) 
    ); 
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'site_favicon',
            array(
                'label'         => __( 'Upload a favicon', 'thbusiness' ),
                'section'       => 'title_tagline',
                'settings'      => 'site_favicon',
                'description' 	=> __( 'Upload a favicon for your website.', 'thbusiness' ),
            )
        )
    );

    // Display site favicon?
    $wp_customize->add_setting(
		'display_site_favicon',
		array(
			'default'			=> false,
			'sanitize_callback'	=> 'thbusiness_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_site_favicon',
		array(
			'settings'		=> 'display_site_favicon',
			'section'		=> 'title_tagline',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display site favicon?', 'thbusiness' ),
		)
	);


    /**
     * General settings section.
     */
    $wp_customize->add_section( 
    	'thbusiness_general_settings', 
    	array(
			'title' => __( 'General Settings', 'thbusiness' ),
			'description' => __( 'Use this section to set general settings of the site.', 'thbusiness' ),
			'priority' => 30,
		) 
	);

	// Footer copyright text.
	$wp_customize->add_setting(
		'footer_copyright_text',
		array(
			'default'			=> sprintf( __( 'Copyright %s. All rights reserved.', 'thbusiness' ), esc_html( get_bloginfo( 'name' ) ) ),
			'sanitize_callback'	=> 'thbusiness_sanitize_html'
		)
	);
	$wp_customize->add_control(
		'footer_copyright_text',
		array(
			'settings'		=> 'footer_copyright_text',
			'section'		=> 'thbusiness_general_settings',
			'type'			=> 'textarea',
			'label'			=> __( 'Footer copyright text', 'thbusiness' ),
			'description'	=> __( 'Copyright or other text to be displayed in the site footer. HTML allowed.', 'thbusiness' )
		)
	);

    /**
     * Top bar section.
     */
    $wp_customize->add_section( 
    	'thbusiness_topbar_settings', 
    	array(
			'title' => __( 'Top Bar Settings', 'thbusiness' ),
			'priority' => 31,
		) 
	);

    // Display topbar?
    $wp_customize->add_setting(
		'display_topbar',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'thbusiness_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_topbar',
		array(
			'settings'		=> 'display_topbar',
			'section'		=> 'thbusiness_topbar_settings',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display top bar?', 'thbusiness' )
		)
	);

	$wp_customize->add_setting(
		'telephone_text',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_html'
		)
	);

	$wp_customize->add_control(
		'telephone_text',
		array(
			'settings'		=> 'telephone_text',
			'section'		=> 'thbusiness_topbar_settings',
			'type'			=> 'text',
			'label'			=> __( 'Call Us Text', 'thbusiness' ),
		)
	);	

	$wp_customize->add_setting(
		'telephone_number',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_nohtml'
		)
	);

	$wp_customize->add_control(
		'telephone_number',
		array(
			'settings'		=> 'telephone_number',
			'section'		=> 'thbusiness_topbar_settings',
			'type'			=> 'text',
			'label'			=> __( 'Telephone Number', 'thbusiness' ),
		)
	);	

	$wp_customize->add_setting(
		'email_text',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_nohtml'
		)
	);

	$wp_customize->add_control(
		'email_text',
		array(
			'settings'		=> 'email_text',
			'section'		=> 'thbusiness_topbar_settings',
			'type'			=> 'text',
			'label'			=> __( 'Email Text', 'thbusiness' ),
		)
	);	

	$wp_customize->add_setting(
		'email_address',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_email'
		)
	);

	$wp_customize->add_control(
		'email_address',
		array(
			'settings'		=> 'email_address',
			'section'		=> 'thbusiness_topbar_settings',
			'type'			=> 'email',
			'label'			=> __( 'Email Address', 'thbusiness' ),
		)
	);

	// Topbar custom text.
	$wp_customize->add_setting(
		'topbar_custom_text',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_nohtml'
		)
	);
	$wp_customize->add_control(
		'topbar_custom_text',
		array(
			'settings'		=> 'topbar_custom_text',
			'section'		=> 'thbusiness_topbar_settings',
			'type'			=> 'textarea',
			'label'			=> __( 'Custom Text', 'thbusiness' ),
			'description'	=> __( 'Add your custom text here.', 'thbusiness' )
		)
	);	

    /**
     * Home Settings section.
     */
    $wp_customize->add_panel( 
		'thbusiness_home_settings', 
		array(
			'title' => __( 'Homepage Settings', 'thbusiness' ),
			'description' => __( 'Use this panel to set your home page settings', 'thbusiness' ),
			'priority' => 32, 
		) 
	);

	/**
     * Slider Section.
     */
    $wp_customize->add_section( 
    	'thbusiness_slider', 
    	array(
			'title' => __( 'Homepage Slider', 'thbusiness' ),
			'panel' => 'thbusiness_home_settings'
		) 
	);

    // Display slider?
    $wp_customize->add_setting(
		'display_slider',
		array(
			'default'			=> true,
			'sanitize_callback'	=> 'thbusiness_sanitize_checkbox'
		)
	);
    $wp_customize->add_control(
		'display_slider',
		array(
			'settings'		=> 'display_slider',
			'section'		=> 'thbusiness_slider',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display slider on homepage ?', 'thbusiness' )
		)
	);

	for ( $i=1; $i <= 5; $i++ ) { 
		$wp_customize->add_setting(
	        'custom_slide_img_' . $i . '',
	        array(
	            'sanitize_callback' => 'thbusiness_sanitize_image'
	        ) 
	    ); 
	    $wp_customize->add_control(
	        new WP_Customize_Image_Control(
	            $wp_customize,
	            'custom_slide_img_' . $i . '',
	            array(
	                'label'         => sprintf( __( 'Slide %d image', 'thbusiness' ), $i ),
	                'section'       => 'thbusiness_slider',
	                'settings'      => 'custom_slide_img_' . $i . '',
	            )
	        )
	    );

	    $wp_customize->add_setting(
			'custom_slide_title_' . $i . '',
			array(
				'default'			=> '',
				'sanitize_callback'	=> 'thbusiness_sanitize_html'
			)
		);

		$wp_customize->add_control(
			'custom_slide_title_' . $i . '',
			array(
				'settings'		=> 'custom_slide_title_' . $i . '',
				'section'		=> 'thbusiness_slider',
				'type'			=> 'text',
				'label'			=> sprintf( __( 'Slide %d title', 'thbusiness' ), $i )
			)
		);

	    $wp_customize->add_setting(
			'custom_slide_description_' . $i . '',
			array(
				'default'			=> '',
				'sanitize_callback'	=> 'thbusiness_sanitize_html'
			)
		);

		$wp_customize->add_control(
			'custom_slide_description_' . $i . '',
			array(
				'settings'		=> 'custom_slide_description_' . $i . '',
				'section'		=> 'thbusiness_slider',
				'type'			=> 'textarea',
				'label'			=> sprintf( __( 'Slide %d description', 'thbusiness' ), $i )
			)
		);		

	    $wp_customize->add_setting(
			'custom_slide_url_' . $i . '',
			array(
				'default'			=> '',
				'sanitize_callback'	=> 'thbusiness_sanitize_url'
			)
		);

		$wp_customize->add_control(
			'custom_slide_url_' . $i . '',
			array(
				'settings'		=> 'custom_slide_url_' . $i . '',
				'section'		=> 'thbusiness_slider',
				'type'			=> 'text',
				'label'			=> sprintf( __( 'Slide %d redirect url', 'thbusiness' ), $i )
			)
		);

		$wp_customize->add_setting(
			'custom_slide_button_text_' . $i . '',
			array(
				'default'			=> '',
				'sanitize_callback'	=> 'thbusiness_sanitize_html'
			)
		);

		$wp_customize->add_control(
			'custom_slide_button_text_' . $i . '',
			array(
				'settings'		=> 'custom_slide_button_text_' . $i . '',
				'section'		=> 'thbusiness_slider',
				'type'			=> 'text',
				'label'			=> sprintf( __( 'Slide %d button text', 'thbusiness' ), $i )
			)
		);
    }		


	/**
     * Styling Options.
     */
	$wp_customize->add_panel( 
		'thbusiness_styling', 
		array(
			'title' 		=> __( 'Site Styling', 'thbusiness' ),
			'description' 	=> __( 'Use this section to setup the homepage slider and featured posts.', 'thbusiness' ),
			'priority' 		=> 33, 
		) 
	);

	$wp_customize->add_setting(
		'site_main_color',
		array(
			'default'			=> '#eb5937',
			'sanitize_callback'	=> 'thbusiness_sanitize_hex_color'
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'site_main_color',
			array(
				'settings'		=> 'site_main_color',
				'section'		=> 'colors',
				'label'			=> __( 'Site Main Color', 'thbusiness' ),
			)
		)
	);

	/**
     * Custom CSS section
     */
    $wp_customize->add_section( 
    	'thbusiness_custom_css', 
    	array(
			'title' 		=> __( 'Custom CSS', 'thbusiness' ),
			'panel' 		=> 'thbusiness_styling',
			'priority'		=> 50
		) 
	);

	$wp_customize->add_setting(
		'custom_css',
		array(
			'default'			=> '',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'thbusiness_sanitize_css'
		)
	);
	$wp_customize->add_control(
		'custom_css',
		array(
			'settings'		=> 'custom_css',
			'section'		=> 'thbusiness_custom_css',
			'type'			=> 'textarea',
			'label'			=> __( 'Custom CSS', 'thbusiness' ),
			'description'	=> __( 'Define custom CSS be used for your site. Do not enclose in script tags.', 'thbusiness' ),
		)
	);

	/**
     * Social Media
     */
    $wp_customize->add_section( 
    	'thbusiness_social_media', 
    	array(
			'title' 		=> __( 'Social Media', 'thbusiness' ),
			'priority'		=> 34
		) 
	);

	$wp_customize->add_setting(
		'display_social_icons',
		array(
			'default'			=> false,
			'sanitize_callback'	=> 'thbusiness_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'display_social_icons',
		array(
			'settings'		=> 'display_social_icons',
			'section'		=> 'thbusiness_social_media',
			'type'			=> 'checkbox',
			'label'			=> __( 'Display social icons?', 'thbusiness' ),
		)
	);

	$wp_customize->add_setting(
		'social_media_text',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_nohtml'
		)
	);

	$wp_customize->add_control(
		'social_media_text',
		array(
			'settings'		=> 'social_media_text',
			'section'		=> 'thbusiness_social_media',
			'type'			=> 'text',
			'label'			=> __( 'Follow Us Text', 'thbusiness' ),
		)
	);	


	$wp_customize->add_setting(
		'facebook_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'facebook_url',
		array(
			'settings'		=> 'facebook_url',
			'section'		=> 'thbusiness_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Facebook URL', 'thbusiness' ),
		)
	);

	$wp_customize->add_setting(
		'twitter_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'twitter_url',
		array(
			'settings'		=> 'twitter_url',
			'section'		=> 'thbusiness_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Twitter URL', 'thbusiness' ),
		)
	);

	$wp_customize->add_setting(
		'googleplus_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'googleplus_url',
		array(
			'settings'		=> 'googleplus_url',
			'section'		=> 'thbusiness_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Google Plus URL', 'thbusiness' ),
		)
	);

	$wp_customize->add_setting(
		'linkedin_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'linkedin_url',
		array(
			'settings'		=> 'linkedin_url',
			'section'		=> 'thbusiness_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Linkedin URL', 'thbusiness' ),
		)
	);

	$wp_customize->add_setting(
		'youtube_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'youtube_url',
		array(
			'settings'		=> 'youtube_url',
			'section'		=> 'thbusiness_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Youtube URL', 'thbusiness' ),
		)
	);		

	$wp_customize->add_setting(
		'dribbble_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'dribbble_url',
		array(
			'settings'		=> 'dribbble_url',
			'section'		=> 'thbusiness_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Dribbble URL', 'thbusiness' ),
		)
	);

	$wp_customize->add_setting(
		'github_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'github_url',
		array(
			'settings'		=> 'github_url',
			'section'		=> 'thbusiness_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Github URL', 'thbusiness' ),
		)
	);	

	$wp_customize->add_setting(
		'flickr_url',
		array(
			'default'			=> '',
			'sanitize_callback'	=> 'thbusiness_sanitize_url'
		)
	);

	$wp_customize->add_control(
		'flickr_url',
		array(
			'settings'		=> 'flickr_url',
			'section'		=> 'thbusiness_social_media',
			'type'			=> 'url',
			'label'			=> __( 'Flickr URL', 'thbusiness' ),
		)
	);	

    $wp_customize->add_section( 
    	'thbusiness_pro_details', 
    	array(
			'title' 		=> __( 'THBusiness Pro', 'thbusiness' ),
			'priority'		=> 120
		) 
	);

	$wp_customize->add_setting( 
		'thbusiness_pro_desc', 
		array(
			'sanitize_callback'	=> 'thbusiness_sanitize_html'
		) 
	);

	$wp_customize->add_control( 
		new Thbusiness_Custom_Content( 
			$wp_customize, 
			'thbusiness_pro_desc', 
			array(
				'section' 		=> 'thbusiness_pro_details',
				'priority' 		=> 20,
				'label' 		=> __( 'Do you want more features?', 'thbusiness' ),
				'content' 		=> __( 'Then consider buying <a href="http://themezhut.com/themes/thbusiness-pro/" target="_blank">Thbusiness Pro.</a><h4>Thbusiness Pro Features.</h4><ol><li>More Layouts.</li><li>Google Fonts.</li><li>Unlimited Colors.</li><li>More Page Templates.</li><li>More Widgets</li><li>More Customizer Options.</li><li>Released under GPL.</li></ol>And more..<p><a class="button" href="http://themezhut.com/demo/thbusiness-pro/" target="_blank">Thbusiness Pro Demo</a><a class="button button-primary" href="http://themezhut.com/themes/thbusiness-pro/" target="_blank">Thbusiness Pro Details</a></p>', 'thbusiness' ) . '</p>',
				//'description' 	=> __( 'Optional: Example Description.', 'thbusiness' ),
			) 
		) 
	);

}
add_action( 'customize_register', 'thbusiness_customize_register' );

/**
 * Image sanitization.
 * 
 * @see wp_check_filetype() https://developer.wordpress.org/reference/functions/wp_check_filetype/
 *
 * @param string               $image   Image filename.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The image filename if the extension is allowed; otherwise, the setting default.
 */

function thbusiness_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}

/**
 * Sanitize the logo title select option.
 *
 * @param string $logo_option.
 * @return string (text_only|logo_only|display_none).
 */
function thbusiness_sanitize_logo_title_select( $logo_option ) {
	if ( ! in_array( $logo_option, array( 'text_only', 'logo_only', 'display_none' ) ) ) {
        $logo_option = 'text_only';
    } 

    return $logo_option;
}

/**
 * Checkbox sanitization.
 * 
 * Sanitization callback for 'checkbox' type controls. This callback sanitizes `$checked`
 * as a boolean value, either TRUE or FALSE.
 *
 * @param bool $checked Whether the checkbox is checked.
 * @return bool Whether the checkbox is checked.
 */
function thbusiness_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * HTML sanitization 
 *
 * @see wp_filter_post_kses() https://developer.wordpress.org/reference/functions/wp_filter_post_kses/
 *
 * @param string $html HTML to sanitize.
 * @return string Sanitized HTML.
 */
function thbusiness_sanitize_html( $html ) {
	return wp_filter_post_kses( $html );
}

/**
 * CSS sanitization.
 * 
 * @see wp_strip_all_tags() https://developer.wordpress.org/reference/functions/wp_strip_all_tags/
 *
 * @param string $css CSS to sanitize.
 * @return string Sanitized CSS.
 */
function thbusiness_sanitize_css( $css ) {
	return wp_strip_all_tags( $css );
}

/**
 * Email sanitization callback.
 *
 * - Sanitization: email
 * - Control: text
 * 
 * Sanitization callback for 'email' type text controls. This callback sanitizes `$email`
 * as a valid email address.
 * 
 * @see sanitize_email() https://developer.wordpress.org/reference/functions/sanitize_key/
 * @link sanitize_email() https://codex.wordpress.org/Function_Reference/sanitize_email
 *
 * @param string               $email   Email address to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return string The sanitized email if not null; otherwise, the setting default.
 */
function thbusiness_sanitize_email( $email, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$email = sanitize_email( $email );
	
	// return sanitized $email
	return $email;
}

/**
 * HEX Color sanitization
 *
 * @see sanitize_hex_color() https://developer.wordpress.org/reference/functions/sanitize_hex_color/
 * @link sanitize_hex_color_no_hash() https://developer.wordpress.org/reference/functions/sanitize_hex_color_no_hash/
 *
 * @param string               $hex_color HEX color to sanitize.
 * @param WP_Customize_Setting $setting   Setting instance.
 * @return string The sanitized hex color if not empty; otherwise, the setting default.
 */
function thbusiness_sanitize_hex_color( $hex_color, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$hex_color = sanitize_hex_color( $hex_color );
	
	// If $input is a valid hex value, return it; otherwise, return the default.
	return ( ! empty( $hex_color ) ? $hex_color : $setting->default );
}

/**
 * Number sanitization callback example.
 *
 * - Sanitization: number_absint
 * - Control: number
 * 
 * Sanitization callback for 'number' type text inputs. This callback sanitizes `$number`
 * as an absolute integer (whole number, zero or greater).
 * 
 * NOTE: absint() can be passed directly as `$wp_customize->add_setting()` 'sanitize_callback'.
 * It is wrapped in a callback here merely for example purposes.
 * 
 * @see absint() https://developer.wordpress.org/reference/functions/absint/
 *
 * @param int                  $number  Number to sanitize.
 * @param WP_Customize_Setting $setting Setting instance.
 * @return int Sanitized number; otherwise, the setting default.
 */
function thbusiness_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );
	
	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}

/**
 * No-HTML sanitization callback example.
 *
 * - Sanitization: nohtml
 * - Control: text, textarea, password
 * 
 * Sanitization callback for 'nohtml' type text inputs. This callback sanitizes `$nohtml`
 * to remove all HTML.
 * 
 * NOTE: wp_filter_nohtml_kses() can be passed directly as `$wp_customize->add_setting()`
 * 'sanitize_callback'. It is wrapped in a callback here merely for example purposes.
 * 
 * @see wp_filter_nohtml_kses() https://developer.wordpress.org/reference/functions/wp_filter_nohtml_kses/
 *
 * @param string $nohtml The no-HTML content to sanitize.
 * @return string Sanitized no-HTML content.
 */
function thbusiness_sanitize_nohtml( $nohtml ) {
	return wp_filter_nohtml_kses( $nohtml );
}

/**
 * URL sanitization.
 * 
 * @see esc_url_raw() https://developer.wordpress.org/reference/functions/esc_url_raw/
 *
 * @param string $url URL to sanitize.
 * @return string Sanitized URL.
 */
function thbusiness_sanitize_url( $url ) {
	return esc_url_raw( $url );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function thbusiness_customize_preview_js() {
	wp_enqueue_script( 'thbusiness_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'thbusiness_customize_preview_js' );



/**
 * Enqueue the customizer stylesheet.
 */
function thbusiness_enqueue_customizer_stylesheets() {

    wp_register_style( 'thbusiness-customizer-css', get_template_directory_uri() . '/inc/customizer/assets/customizer.css', NULL, NULL, 'all' );
    wp_enqueue_style( 'thbusiness-customizer-css' );
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array(), '4.5.0' );

}
add_action( 'customize_controls_print_styles', 'thbusiness_enqueue_customizer_stylesheets' );



/**
 * Writes out the CSS as defined by the values in the Theme Customizer
 * to the `head` element of the header template.
 *
 * @package thbusiness
 */
function thbusiness_customize_css() {
	
	$color = get_theme_mod( 'site_main_color', '#eb5937' );
	
	if ( $color != '#eb5937' ) : 

?>

	<style type="text/css">
	<?php
		echo 
		'a:hover,
		a:focus,
		a:active {
			color: '.$color.';
		}
		blockquote {
			border-left: 3px solid '.$color.';
		}
		.main-navigation ul ul {
			border-top: 3px solid '.$color.';
		}
		.main-navigation li:hover > a {
			border-bottom: 3px solid '.$color.';
		}
		.main-navigation a:hover, 
		.main-navigation ul li.current-menu-item a, 
		.main-navigation ul li.current_page_ancestor a, 
		.main-navigation ul li.current-menu-ancestor a, 
		.main-navigation ul li.current_page_item a,
		.main-navigation ul li:hover > a {
			color: '.$color.';
		}
		.widget-title {
			border-bottom: 3px solid '.$color.';
		}
		.th-services-box:hover .th-services-icon {
			border: 1px solid '.$color.';
			color: '.$color.';
		}
		.th-services-box:hover .th-morelink {
			background: '.$color.';
		}
		.th-morelink {
			color: '.$color.';
		}
		.th-morelink:visited {
			color: '.$color.';
		}
		.call-to-action-button {
			background: '.$color.';
		}
		.singlepage-widget-moretag {
			background: '.$color.';
		}		
		.moretag {
			background: '.$color.';
		}
		.comment-author .fn,
		.comment-author .url,
		.comment-reply-link,
		.comment-reply-login {
			color: '.$color.';
		}
		a:hover.page-numbers {
			background-color: '.$color.';
		}
		.paging-navigation .current {
			background-color: '.$color.';
		}
		.page-links span a{
			background: '.$color.';
		}
		.page-links a:hover {
			background: '.$color.';
		}
		.th-slider-readmore-button a {
			background: '.$color.';
		}
		.site-footer a:hover {
			color: '.$color.';
		}
		.th-search-box-container {
			border-top: 3px solid '.$color.';
		}
		.topbar-icon {
			background: '.$color.'; 
		}
		#th-search-form input[type="submit"] {
			background-color: '.$color.';
		}';
	?>
	</style>
<?php
	endif;
}
add_action( 'wp_head', 'thbusiness_customize_css' );
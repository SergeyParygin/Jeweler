<?php
// ThemeCustomizer functionality
function saybusiness_custom_header_and_background() { 
	$saybusiness_default_background_color =  '#ffffff';
	$saybusiness_default_text_color       = '#007acc';

	//Filter the arguments used when adding 'custom-background' support in theme.
	add_theme_support( 'custom-background', apply_filters( 'saybusiness_custom_background_args', array(
		'default-color' => $saybusiness_default_background_color,
	) ) );

	//Filter the arguments used when adding 'custom-header' support in theme.
	add_theme_support( 'custom-header', apply_filters( 'saybusiness_custom_header_args', array(
		'default-text-color'     => $saybusiness_default_text_color,
		'width'                  => 1920,
		'height'                 => 380,
		'flex-height'            => true,
		'wp-head-callback'       => 'saybusiness_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'saybusiness_custom_header_and_background' );

if ( ! function_exists( 'saybusiness_header_style' ) ) :
//Styles the header text displayed on the site.
function saybusiness_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
	<style type="text/css" id="saybusiness-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}

		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // saybusiness_header_style
 
//Adds postMessage support for site title and description for the Customizer.
function saybusiness_customize_register( $wp_customize ) { 

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title a',
			'container_inclusive' => false,
			'render_callback' => 'saybusiness_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'saybusiness_customize_partial_blogdescription',
		) );
	}
 
	// Add background color setting and control.
	$wp_customize->add_setting( 'saybusiness_background_color', array(
		'default'           => '#ffffff',
		'sanitize_callback' => 'sanitize_hex_color', 
		'type' => 'theme_mod', 
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saybusiness_background_color', array(
		'label'       => __( 'Background Color', 'saybusiness' ),
		'section'     => 'colors',
		'settings'    => 'saybusiness_background_color',
	) ) );
 
	// Add link color setting and control.
	$wp_customize->add_setting( 'saybusiness_link_color', array(
		'default'           => '#007acc',
		'sanitize_callback' => 'sanitize_hex_color', 
		'type' 				=> 'theme_mod', 
	) );
	
	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );
	
	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'background_color' );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saybusiness_link_color', array(
		'label'       => __( 'Link Color', 'saybusiness' ),
		'section'     => 'colors',
		'settings'   => 'saybusiness_link_color',
	) ) );

	// Add text color setting and control.
	$wp_customize->add_setting( 'saybusiness_text_color', array(
		'default'           => '#686868',
		'sanitize_callback' => 'sanitize_hex_color', 
		'type' => 'theme_mod', 
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'saybusiness_text_color', array(
		'label'       => __( 'Text Color', 'saybusiness' ),
		'section'     => 'colors',
		'settings'   => 'saybusiness_text_color',
	) ) );
 
	// Text sanitization
	function saybusiness_text_sanitize( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}
	// Link sanitization
   function saybusiness_links_sanitize() {
      return false;
   }   
}
add_action( 'customize_register', 'saybusiness_customize_register', 11 );

function saybusiness_customize_register_pagearea( $wp_customize ) { 	
	// Page area boxes on front-page
	$wp_customize->add_section( 'saybusiness_pagearea_section' , array(
		'title' => __('Section featured content', 'saybusiness'),
		'description' => __('Select pages to show in boxes bellow slider on front-page', 'saybusiness'),
		'priority' => 210, 
	) );

	$wp_customize->add_setting('saybusiness_show_pagearea', array(
        'default' => 0,
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'saybusiness_sanitize_checkbox'
	) ); 
	
	$wp_customize->add_control('saybusiness_show_pagearea', array(
        'label'      => __( 'Enable this section', 'saybusiness' ),
        'section'    => 'saybusiness_pagearea_section',
        'settings'   => 'saybusiness_show_pagearea',
        'type'       => 'checkbox',
	) ); 
	
	$wp_customize->add_setting('saybusiness_page-box1',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('saybusiness_page-box1',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for box 1:','saybusiness'),
			'section'	=> 'saybusiness_pagearea_section'
	));	
	
	$wp_customize->add_setting('saybusiness_page-box2',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('saybusiness_page-box2',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for box 2:','saybusiness'),
			'section'	=> 'saybusiness_pagearea_section'
	));	
	
	$wp_customize->add_setting('saybusiness_page-box3',array(
			'default' => '0',
			'capability' => 'edit_theme_options',	
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('saybusiness_page-box3',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for box 3:','saybusiness'),
			'section'	=> 'saybusiness_pagearea_section'
	));		 
}
add_action( 'customize_register', 'saybusiness_customize_register_pagearea', 13 );

function saybusiness_customize_register_about( $wp_customize ) { 	
	// Page area boxes on front-page
	$wp_customize->add_section( 'saybusiness_about_section' , array(
		'title' => __('Section about', 'saybusiness'),
		'description' => __('Select pages to show in boxes bellow 3 boxes on front-page', 'saybusiness'),
		'priority' => 230, 
	) );

	$wp_customize->add_setting('saybusiness_show_about', array(
        'default' => 0,
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'saybusiness_sanitize_checkbox'
	) ); 
	
	$wp_customize->add_control('saybusiness_show_about', array(
        'label'      => __( 'Enable this section', 'saybusiness' ),
        'section'    => 'saybusiness_about_section',
        'settings'   => 'saybusiness_show_about',
        'type'       => 'checkbox',
	) ); 
	
	$wp_customize->add_setting('saybusiness_page-about',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('saybusiness_page-about',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for about section:','saybusiness'),
			'section'	=> 'saybusiness_about_section'
	));	
 
}
add_action( 'customize_register', 'saybusiness_customize_register_about', 14 );
 
function saybusiness_customize_register_action( $wp_customize ) { 	
	// Action section on front-page
	$wp_customize->add_section( 'saybusiness_action_section' , array(
		'title' => __('Section action', 'saybusiness'),
		'description' => __('Select pages to show action section on front-page', 'saybusiness'),
		'priority' => 240, 
	) );

	$wp_customize->add_setting('saybusiness_show_action', array(
        'default' => 0,
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'saybusiness_sanitize_checkbox'
	) ); 
	
	$wp_customize->add_control('saybusiness_show_action', array(
        'label'      => __( 'Enable this section', 'saybusiness' ),
        'section'    => 'saybusiness_action_section',
        'settings'   => 'saybusiness_show_action',
        'type'       => 'checkbox',
	) ); 
	
	$wp_customize->add_setting('saybusiness_page-action',array(
			'default' => '0',
			'capability' => 'edit_theme_options',
			'sanitize_callback'	=> 'absint'
	));
	
	$wp_customize->add_control('saybusiness_page-action',array(
			'type'	=> 'dropdown-pages',
			'label'	=> __('Select page for action section:','saybusiness'),
			'section'	=> 'saybusiness_action_section',
			'settings'   => 'saybusiness_page-action'
	));	
 
}
add_action( 'customize_register', 'saybusiness_customize_register_action', 15 );

function saybusiness_customize_register_footer( $wp_customize ) { 	
	// Footer text
	$wp_customize->add_section( 'saybusiness_footer_section' , array(
		'title' => __('Footer text', 'saybusiness'),
		'priority' => 250,
	) );
	$wp_customize->add_setting( 'saybusiness_copyright_text', array(
		'default' => 'Copyright 2017 by SayBusiness. All rights reserved.',  
		'sanitize_callback' => 'saybusiness_footer_text_sanitize',
		'type' => 'theme_mod', 
	) ); 
	$wp_customize->add_control( 'saybusiness_copyright_text', array(
		'label' => __( 'Copyright text', 'saybusiness' ),
		'type' => 'textarea',
		'section' => 'saybusiness_footer_section',
		'settings' => 'saybusiness_copyright_text',
	) ); 
	// Show credits
	$wp_customize->add_setting('saybusiness_show_credits', array(
        'default' => 1,
        'type'       => 'theme_mod',
        'capability' => 'edit_theme_options',
		'sanitize_callback' => 'saybusiness_sanitize_checkbox'
    ) ); 
	$wp_customize->add_control('saybusiness_show_credits', array(
        'label'      => __( 'Show link to WordPress', 'saybusiness' ),
        'section'    => 'saybusiness_footer_section',
        'settings'   => 'saybusiness_show_credits',
        'type'       => 'checkbox',
	) ); 
	
	// Text sanitization
	function saybusiness_footer_text_sanitize( $input ) {
	    return wp_kses_post( force_balance_tags( $input ) );
	}  
}
add_action( 'customize_register', 'saybusiness_customize_register_footer', 16 );

// Render the site title for the selective refresh partial.
function saybusiness_customize_partial_blogname() {
	bloginfo( 'name' );
}

// Render the site tagline for the selective refresh partial.
function saybusiness_customize_partial_blogdescription() {
	bloginfo( 'description' );
}
 
// Binds JS handlers to make the Customizer preview reload changes asynchronously.
function saybusiness_customize_preview_js() {
	wp_enqueue_script( 'saybusiness-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20170816', true );
}
add_action( 'customize_preview_init', 'saybusiness_customize_preview_js' );

//Enqueues front-end CSS for the background color.
function saybusiness_background_color_css() {  
	$saybusiness_background_color = get_theme_mod( 'saybusiness_background_color', '#fff' ); 
	
	$css = ' 
		body,
		.site,
		.button:hover,
		.woocommerce a.button:hover, 
		input[type="date"]:focus,
		input[type="time"]:focus,
		input[type="datetime-local"]:focus,
		input[type="week"]:focus,
		input[type="month"]:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="tel"]:focus,
		input[type="number"]:focus,
		textarea:focus{
			background-color: '. esc_html($saybusiness_background_color) . ' !important;
		}

		mark, 
		btn,
		button,
		.button, 
		.woocommerce a.button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination .prev,
		.pagination .next,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.pagination .nav-links:before,
		.pagination .nav-links:after,
		.widget_calendar tbody a,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus,
		.page-links a,
		.page-links a:hover,
		.saybusiness-filter ul li a:hover,  
		.woocommerce .button:hover,
		.entry-content a.button:hover,
		.entry-content .woocommerce a.button,
		.woocommerce button.button:hover,
		.button:hover::before, 
		.slider .button:hover,
		.button.wc-backward,
		.social-navigation a:hover:before,
		.social-navigation a:focus:before,
		.page-links a:focus {
			color: '. esc_html($saybusiness_background_color) .' !important; 
		} 
	'; 
	wp_add_inline_style( 'saybusiness-style', $css );
}
add_action( 'wp_enqueue_scripts', 'saybusiness_background_color_css', 10 );
 
//Enqueues front-end CSS for the link color.
function saybusiness_link_color_css() {  
	$saybusiness_link_color = get_theme_mod( 'saybusiness_link_color', '#007acc' ); 
	$css = '  
		.site a,
		#site-nav .screen-reader-text,
		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.post-navigation a:hover .post-title,
		.post-navigation a:focus .post-title,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.site-branding .site-title a:hover,
		.site-branding .site-title a:focus,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-footer a:hover,
		.entry-footer a:focus, 
		.main-nav li:hover > a, 
		.main-nav li.current_page_item > a, 
		.main-nav li.current-menu-item > a, 
		.main-nav li.current-menu-ancestor > a,
		.main-nav li:hover > a,
		.main-nav li.current_page_item > a,
		.main-nav li.current-menu-item > a,
		.main-nav li.current-menu-ancestor > a,
		.social-navigation a,
		.post-navigation a,
		.comment-metadata a,
		.comment-metadata a:hover,
		.comment-metadata a:focus,
		.pingback .comment-edit-link:hover,
		.pingback .comment-edit-link:focus,
		.form-allowed-tags,
		.widget_calendar tbody a,
		.widget-title a,
		.pagination a:hover,
		.pagination a:focus,
		.widget-title a,
		.site-branding .site-title a, 
		.entry-footer-content a,
		.entry-title a,  
		.entry-footer a,
		.entry-content a.button,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.sub-toggle,
		.search-top .icon-search,
		.icon-caret-down,
		.required,		 
		a.button,
		.menu-toggle .icon-menu, 
		.social-navigation a::before,
		.site-info a {
			color: '. esc_html($saybusiness_link_color) .' !important;
		}

		mark, 
		button:hover,
		button:focus,
		btn:hover,
		btn:focus
		btn:hover,
		btn:focus,  
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.widget_calendar tbody a,
		.page-links a:hover,
		.page-links a:focus,
		.service .fa:hover,
		.counter .fa:hover,
		.woocommerce span.onsale,  
		.saybusiness-filter ul li a:hover, 
		.woocommerce a.button,
		.woocommerce a.button:hover,
		.woocommerce .button:hover,
		.entry-content a.button:hover, 
		.button:hover::before,
		.saybusiness_counters_widget .entry-title h3::after,
		.woocommerce input.button:hover,
		.page-links a:focus {
			background-color: '. esc_html($saybusiness_link_color) .' !important;
		}

		input[type="date"]:focus,
		input[type="time"]:focus,
		input[type="datetime-local"]:focus,
		input[type="week"]:focus,
		input[type="month"]:focus,
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="tel"]:focus,
		input[type="number"]:focus, 
		textarea:focus, 
		.button,
		.woocommerce a.button,
		.woocommerce a.button:hover, 
		.woocommerce button.button.alt:hover,
		.woocommerce input.button:hover,
		.page-text .button:hover,
		.tagcloud a:hover,
		.tagcloud a:focus {
			border: 1px solid '. esc_html($saybusiness_link_color) .' !important; 
		}
	'; 
	wp_add_inline_style( 'saybusiness-style', $css );
}
add_action( 'wp_enqueue_scripts', 'saybusiness_link_color_css', 11 );

//Enqueues front-end CSS for text color.
function saybusiness_text_color_css() {  
	$saybusiness_text_color = get_theme_mod( 'saybusiness_text_color', '#555' ); 
	$css = ' 
		html,
		body,
		.site h1,
		.site h2,
		.site h3,
		.site h4,
		.site h5,
		.site h6,
		blockquote,
		textarea,
		blockquote cite,
		blockquote small, 
		.site-description, 
		.menu-toggle, 
		.dropdown-toggle, 
		.page-links > .page-links-title,
		.comment-author,
		.comment-reply-title small a:hover,
		.comment-reply-title small a:focus,
		.author-bio,
		.post-password-form label,
		.post-navigation .meta-nav, 
		.comment-navigation,
		.comment-reply-title small a:hover,
		.comment-reply-title small a:focus,
		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus,
		.widget .widget-title,
		.widget_recent_entries .post-date,
		.widget_rss cite, 
		.widget ul li + a, 
		.entry-content p,
		.sticky-post {
			color: '. esc_html($saybusiness_text_color) .' !important;
		}
		
		.taxonomy-description,
		.entry-caption,
		.pingback .edit-link,
		.entry-footer a:hover,
		.entry-footer a:focus,
		.site-info,		
		.site-info a:hover,
		.site-info a:focus,
		 blockquote, .site-description, 
		 body:not(.search-results) .entry-summary, 
		 body:not(.search-results) .entry-summary blockquote,  
		.comment-author, 
		.comment-metadata a, 
		.comment-notes, 
		.comment-awaiting-moderation,  
		.wp-caption .wp-caption-text, 
		.gallery-caption,
		.widecolumn .mu_register label, 
		.woocommerce ul.products li.product .price .amount, 
		.woocommerce ul.product_list_widget li a:hover,
		.woocommerce ul.products li.product .price,
		.woocommerce .woocommerce-Price-amount.amount,
		.woocommerce .entry-summary .price .amount, 
		.woocommerce div.product p.price, 
		.woocommerce div.product span.price,
		.woocommerce ul.products li.product .price {
			color: '. esc_html($saybusiness_text_color) .' !important;
		}
 
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,    
		.page-links a,
		.woocommerce input.button,
		.wpcf7 input[type="text"]:focus,
		.wpcf7 input[type="email"]:focus,
		.wpcf7 input[type="tel"]:focus,
		.wpcf7 input[type="file"]:focus,
		.wpcf7 textarea:focus {
			border:  1px solid '. esc_html($saybusiness_text_color) .' !important;
		}
	  
		.panel-heading,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,  
		a#scroll-up, 
		hr,
		code,
		.woocommerce button.button, 
		.woocommerce a.button:hover::before,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,  
		.woocommerce input.button.alt {
			background-color: '. esc_html($saybusiness_text_color) .' !important;
		} 
	'; 
	wp_add_inline_style( 'saybusiness-style',  $css );
}
add_action( 'wp_enqueue_scripts', 'saybusiness_text_color_css', 12 );
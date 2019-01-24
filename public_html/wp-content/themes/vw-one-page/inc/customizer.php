<?php
/**
 * VW One Page Theme Customizer
 *
 * @package VW One Page
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function vw_one_page_customize_register( $wp_customize ) {

	//add home page setting pannel
	$wp_customize->add_panel( 'vw_one_page_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => __( 'VW Settings', 'vw-one-page' ),
	    'description' => __( 'Description of what this panel does.', 'vw-one-page' ),
	) );

	$wp_customize->add_section( 'vw_one_page_left_right', array(
    	'title'      => __( 'General Settings', 'vw-one-page' ),
		'priority'   => 30,
		'panel' => 'vw_one_page_panel_id'
	) );

	// Add Settings and Controls for Layout
	$wp_customize->add_setting('vw_one_page_theme_options',array(
        'default' => __('Right Sidebar','vw-one-page'),
        'sanitize_callback' => 'vw_one_page_sanitize_choices'	        
	));
	$wp_customize->add_control('vw_one_page_theme_options',array(
        'type' => 'radio',
        'label' => __('Do you want this section','vw-one-page'),
        'section' => 'vw_one_page_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-one-page'),
            'Right Sidebar' => __('Right Sidebar','vw-one-page'),
            'One Column' => __('One Column','vw-one-page'),
            'Three Columns' => __('Three Columns','vw-one-page'),
            'Four Columns' => __('Four Columns','vw-one-page'),
            'Grid Layout' => __('Grid Layout','vw-one-page')
        ),
	) );

	$wp_customize->add_section( 'vw_one_page_topbar', array(
    	'title'      => __( 'Topbar Settings', 'vw-one-page' ),
		'priority'   => 30,
		'panel' => 'vw_one_page_panel_id'
	) );

	$wp_customize->add_setting('vw_one_page_phone_number',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_one_page_phone_number',array(
		'label'	=> __('Add Phone Number','vw-one-page'),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_email_address',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_one_page_email_address',array(
		'label'	=> __('Add Enail Address','vw-one-page'),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_one_page_timing',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_one_page_timing',array(
		'label'	=> __('Add Timming','vw-one-page'),
		'section'=> 'vw_one_page_topbar',
		'type'=> 'text'
	));
    
	//Slider
	$wp_customize->add_section( 'vw_one_page_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-one-page' ),
		'priority'   => null,
		'panel' => 'vw_one_page_panel_id'
	) );

	$wp_customize->add_setting('vw_one_page_slider_arrows',array(
       'default' => 'false',
       'sanitize_callback'	=> 'sanitize_text_field'
    ));
    $wp_customize->add_control('vw_one_page_slider_arrows',array(
       'type' => 'checkbox',
       'label' => __('Show / Hide slider','vw-one-page'),
       'section' => 'vw_one_page_slidersettings',
    ));

	for ( $count = 1; $count <= 4; $count++ ) {

		// Add color scheme setting and control.
		$wp_customize->add_setting( 'vw_one_page_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_one_page_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_one_page_slider_page' . $count, array(
			'label'    => __( 'Select Slide Image Page', 'vw-one-page' ),
			'description' => __('Slider image size (1500 x 590)','vw-one-page'),
			'section'  => 'vw_one_page_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//Services
	$wp_customize->add_section( 'vw_one_page_service_section' , array(
    	'title'      => __( 'Services', 'vw-one-page' ),
		'priority'   => null,
		'panel' => 'vw_one_page_panel_id'
	) );

	$categories = get_categories();
	$cat_post = array();
	$cat_post[]= 'select';
	$i = 0;	
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_post[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_one_page_services',array(
		'default'	=> 'select',
		'sanitize_callback' => 'vw_one_page_sanitize_choices',
	));
	$wp_customize->add_control('vw_one_page_services',array(
		'type'    => 'select',
		'choices' => $cat_post,
		'label' => __('Select Category to display services','vw-one-page'),
		'section' => 'vw_one_page_service_section',
	));	

	//About us
	$wp_customize->add_section( 'vw_one_page_about_section' , array(
    	'title'      => __( 'About us', 'vw-one-page' ),
		'priority'   => null,
		'panel' => 'vw_one_page_panel_id'
	) );

	$wp_customize->add_setting( 'vw_one_page_about_page', array(
		'default'           => '',
		'sanitize_callback' => 'vw_one_page_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'vw_one_page_about_page', array(
		'label'    => __( 'Select About Page', 'vw-one-page' ),
		'section'  => 'vw_one_page_about_section',
		'type'     => 'dropdown-pages'
	) );

	//Footer Text
	$wp_customize->add_section('vw_one_page_footer',array(
		'title'	=> __('Footer','vw-one-page'),
		'description'=> __('This section will appear in the footer','vw-one-page'),
		'panel' => 'vw_one_page_panel_id',
	));	
	
	$wp_customize->add_setting('vw_one_page_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_one_page_footer_text',array(
		'label'	=> __('Copyright Text','vw-one-page'),
		'section'=> 'vw_one_page_footer',
		'setting'=> 'vw_one_page_footer_text',
		'type'=> 'text'
	));	
}

add_action( 'customize_register', 'vw_one_page_customize_register' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_One_Page_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'VW_One_Page_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new VW_One_Page_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority'   => 9,
					'title'    => esc_html__( 'One Page Pro Theme', 'vw-one-page' ),
					'pro_text' => esc_html__( 'Upgrade Pro', 'vw-one-page' ),
					'pro_url'  => esc_url('https://www.vwthemes.com/themes/one-page-wordpress-theme/'),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-one-page-customize-controls', trailingslashit( get_template_directory_uri() ) . '/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-one-page-customize-controls', trailingslashit( get_template_directory_uri() ) . '/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_One_Page_Customize::get_instance();
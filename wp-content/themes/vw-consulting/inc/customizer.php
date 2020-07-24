<?php
/**
 * VW Consulting Theme Customizer
 *
 * @package VW Consulting
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

function vw_consulting_custom_controls() {
	load_template( trailingslashit( get_template_directory() ) . '/inc/custom-controls.php' );
}
add_action( 'customize_register', 'vw_consulting_custom_controls' );

function vw_consulting_customize_register( $wp_customize ) {

	load_template( trailingslashit( get_template_directory() ) . 'inc/customize-homepage/class-customize-homepage.php' );

	load_template( trailingslashit( get_template_directory() ) . '/inc/icon-picker.php' );

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage'; 
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'blogname', array( 
		'selector' => '.logo .site-title a', 
	 	'render_callback' => 'vw_consulting_customize_partial_blogname', 
	)); 

	$wp_customize->selective_refresh->add_partial( 'blogdescription', array( 
		'selector' => 'p.site-description', 
		'render_callback' => 'vw_consulting_customize_partial_blogdescription', 
	));

	//add home page setting pannel
	$VWConsultingParentPanel = new VW_Consulting_WP_Customize_Panel( $wp_customize, 'vw_consulting_panel_id', array(
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => 'VW Settings',
		'priority' => 10,
	));

	// Layout
	$wp_customize->add_section( 'vw_consulting_left_right', array(
    	'title'      => __( 'General Settings', 'vw-consulting' ),
		'panel' => 'vw_consulting_panel_id'
	) );

	$wp_customize->add_setting('vw_consulting_width_option',array(
        'default' => __('Full Width','vw-consulting'),
        'sanitize_callback' => 'vw_consulting_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Consulting_Image_Radio_Control($wp_customize, 'vw_consulting_width_option', array(
        'type' => 'select',
        'label' => __('Width Layouts','vw-consulting'),
        'description' => __('Here you can change the width layout of Website.','vw-consulting'),
        'section' => 'vw_consulting_left_right',
        'choices' => array(
            'Full Width' => get_template_directory_uri().'/assets/images/full-width.png',
            'Wide Width' => get_template_directory_uri().'/assets/images/wide-width.png',
            'Boxed' => get_template_directory_uri().'/assets/images/boxed-width.png',
    ))));

	$wp_customize->add_setting('vw_consulting_theme_options',array(
        'default' => __('Right Sidebar','vw-consulting'),
        'sanitize_callback' => 'vw_consulting_sanitize_choices'
	));
	$wp_customize->add_control('vw_consulting_theme_options',array(
        'type' => 'select',
        'label' => __('Post Sidebar Layout','vw-consulting'),
        'description' => __('Here you can change the sidebar layout for posts. ','vw-consulting'),
        'section' => 'vw_consulting_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-consulting'),
            'Right Sidebar' => __('Right Sidebar','vw-consulting'),
            'One Column' => __('One Column','vw-consulting'),
            'Three Columns' => __('Three Columns','vw-consulting'),
            'Four Columns' => __('Four Columns','vw-consulting'),
            'Grid Layout' => __('Grid Layout','vw-consulting')
        ),
	) );

	$wp_customize->add_setting('vw_consulting_page_layout',array(
        'default' => __('One Column','vw-consulting'),
        'sanitize_callback' => 'vw_consulting_sanitize_choices'
	));
	$wp_customize->add_control('vw_consulting_page_layout',array(
        'type' => 'select',
        'label' => __('Page Sidebar Layout','vw-consulting'),
        'description' => __('Here you can change the sidebar layout for pages. ','vw-consulting'),
        'section' => 'vw_consulting_left_right',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','vw-consulting'),
            'Right Sidebar' => __('Right Sidebar','vw-consulting'),
            'One Column' => __('One Column','vw-consulting')
        ),
	) );

	//Woocommerce Shop Page Sidebar
	$wp_customize->add_setting( 'vw_consulting_woocommerce_shop_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_woocommerce_shop_page_sidebar',array(
		'label' => esc_html__( 'Shop Page Sidebar','vw-consulting' ),
		'section' => 'vw_consulting_left_right'
    )));

    //Woocommerce Single Product page Sidebar
	$wp_customize->add_setting( 'vw_consulting_woocommerce_single_product_page_sidebar',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_woocommerce_single_product_page_sidebar',array(
		'label' => esc_html__( 'Single Product Sidebar','vw-consulting' ),
		'section' => 'vw_consulting_left_right'
    )));

	//Pre-Loader
	$wp_customize->add_setting( 'vw_consulting_loader_enable',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_loader_enable',array(
        'label' => esc_html__( 'Pre-Loader','vw-consulting' ),
        'section' => 'vw_consulting_left_right'
    )));

	$wp_customize->add_setting('vw_consulting_loader_icon',array(
        'default' => __('Two Way','vw-consulting'),
        'sanitize_callback' => 'vw_consulting_sanitize_choices'
	));
	$wp_customize->add_control('vw_consulting_loader_icon',array(
        'type' => 'select',
        'label' => __('Pre-Loader Type','vw-consulting'),
        'section' => 'vw_consulting_left_right',
        'choices' => array(
            'Two Way' => __('Two Way','vw-consulting'),
            'Dots' => __('Dots','vw-consulting'),
            'Rotate' => __('Rotate','vw-consulting')
        ),
	) );

	//Contact Info
	$wp_customize->add_section( 'vw_consulting_topbar', array(
    	'title'      => __( 'Contact Info Settings', 'vw-consulting' ),
		'panel' => 'vw_consulting_panel_id'
	) );

	$wp_customize->add_setting( 'vw_consulting_topbar_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_topbar_hide_show',
       array(
      'label' => esc_html__( 'Show / Hide Contact Info','vw-consulting' ),
      'section' => 'vw_consulting_topbar'
    )));

    //Sticky Header
	$wp_customize->add_setting( 'vw_consulting_sticky_header',array(
        'default' => 0,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_sticky_header',array(
        'label' => esc_html__( 'Sticky Header','vw-consulting' ),
        'section' => 'vw_consulting_topbar'
    )));

	$wp_customize->add_setting( 'vw_consulting_search_enable',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_search_enable',array(
      	'label' => esc_html__( 'Show / Hide Search','vw-consulting' ),
      	'section' => 'vw_consulting_topbar'
    )));

    $wp_customize->add_setting('vw_consulting_search_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_search_font_size',array(
		'label'	=> __('Search Font Size','vw-consulting'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_topbar',
		'type'=> 'text'
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_consulting_call', array( 
		'selector' => '.info-border p', 
		'render_callback' => 'vw_consulting_customize_partial_vw_consulting_call', 
	));

    $wp_customize->add_setting('vw_consulting_phone_icon',array(
		'default'	=> 'fas fa-phone',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Consulting_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_consulting_phone_icon',array(
		'label'	=> __('Add Phone Number Icon','vw-consulting'),
		'transport' => 'refresh',
		'section'	=> 'vw_consulting_topbar',
		'setting'	=> 'vw_consulting_phone_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_consulting_call',array(
		'default'=> '',
		'sanitize_callback'	=> 'vw_consulting_sanitize_phone_number'
	));
	$wp_customize->add_control('vw_consulting_call',array(
		'label'	=> __('Add Phone Number','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '+00 1234 567 890', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_consulting_email_icon',array(
		'default'	=> 'far fa-envelope',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Consulting_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_consulting_email_icon',array(
		'label'	=> __('Add Email Icon','vw-consulting'),
		'transport' => 'refresh',
		'section'	=> 'vw_consulting_topbar',
		'setting'	=> 'vw_consulting_email_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_consulting_email',array(
		'default'=> '',
		'sanitize_callback'	=> 'vw_consulting_sanitize_email'
	));
	$wp_customize->add_control('vw_consulting_email',array(
		'label'	=> __('Add Email Address','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( 'example@gmail.com', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_topbar',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_consulting_timing_icon',array(
		'default'	=> 'far fa-clock',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Consulting_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_consulting_timing_icon',array(
		'label'	=> __('Add Timing Icon','vw-consulting'),
		'transport' => 'refresh',
		'section'	=> 'vw_consulting_topbar',
		'setting'	=> 'vw_consulting_timing_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_consulting_time',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_time',array(
		'label'	=> __('Add Opening Time','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( 'Mon to Sat 11:00 am - 5:30pm Sunday: Closed', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_topbar',
		'type'=> 'text'
	));
   
	//Slider
	$wp_customize->add_section( 'vw_consulting_slidersettings' , array(
    	'title'      => __( 'Slider Settings', 'vw-consulting' ),
		'panel' => 'vw_consulting_panel_id'
	) );

	$wp_customize->add_setting( 'vw_consulting_slider_arrows',array(
    	'default' => 0,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_slider_arrows',array(
      	'label' => esc_html__( 'Show / Hide Slider','vw-consulting' ),
      	'section' => 'vw_consulting_slidersettings'
    )));

    //Selective Refresh
    $wp_customize->selective_refresh->add_partial('vw_consulting_slider_arrows',array(
		'selector'        => '#slider .inner_carousel h1',
		'render_callback' => 'vw_consulting_customize_partial_vw_consulting_slider_arrows',
	));

	for ( $count = 1; $count <= 4; $count++ ) {
		$wp_customize->add_setting( 'vw_consulting_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'vw_consulting_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'vw_consulting_slider_page' . $count, array(
			'label'    => __( 'Select Slider Page', 'vw-consulting' ),
			'description' => __('Slider image size (1600 x 800)','vw-consulting'),
			'section'  => 'vw_consulting_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	//content layout
	$wp_customize->add_setting('vw_consulting_slider_content_option',array(
        'default' => __('Left','vw-consulting'),
        'sanitize_callback' => 'vw_consulting_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Consulting_Image_Radio_Control($wp_customize, 'vw_consulting_slider_content_option', array(
        'type' => 'select',
        'label' => __('Slider Content Layouts','vw-consulting'),
        'section' => 'vw_consulting_slidersettings',
        'choices' => array(
            'Left' => get_template_directory_uri().'/assets/images/slider-content1.png',
            'Center' => get_template_directory_uri().'/assets/images/slider-content2.png',
            'Right' => get_template_directory_uri().'/assets/images/slider-content3.png',
    ))));

    //Slider excerpt
	$wp_customize->add_setting( 'vw_consulting_slider_excerpt_number', array(
		'default'              => 20,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_consulting_slider_excerpt_number', array(
		'label'       => esc_html__( 'Slider Excerpt length','vw-consulting' ),
		'section'     => 'vw_consulting_slidersettings',
		'type'        => 'range',
		'settings'    => 'vw_consulting_slider_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Opacity
	$wp_customize->add_setting('vw_consulting_slider_opacity_color',array(
      'default'              => 0.4,
      'sanitize_callback' => 'vw_consulting_sanitize_choices'
	));

	$wp_customize->add_control( 'vw_consulting_slider_opacity_color', array(
	'label'       => esc_html__( 'Slider Image Opacity','vw-consulting' ),
	'section'     => 'vw_consulting_slidersettings',
	'type'        => 'select',
	'settings'    => 'vw_consulting_slider_opacity_color',
	'choices' => array(
      '0' =>  esc_attr('0','vw-consulting'),
      '0.1' =>  esc_attr('0.1','vw-consulting'),
      '0.2' =>  esc_attr('0.2','vw-consulting'),
      '0.3' =>  esc_attr('0.3','vw-consulting'),
      '0.4' =>  esc_attr('0.4','vw-consulting'),
      '0.5' =>  esc_attr('0.5','vw-consulting'),
      '0.6' =>  esc_attr('0.6','vw-consulting'),
      '0.7' =>  esc_attr('0.7','vw-consulting'),
      '0.8' =>  esc_attr('0.8','vw-consulting'),
      '0.9' =>  esc_attr('0.9','vw-consulting')
	),
	));

	//Slider height
	$wp_customize->add_setting('vw_consulting_slider_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_slider_height',array(
		'label'	=> __('Slider Height','vw-consulting'),
		'description'	=> __('Specify the slider height (px).','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '500px', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_slidersettings',
		'type'=> 'text'
	));
 
	//Services Section
	$wp_customize->add_section( 'vw_consulting_services_section' , array(
    	'title'      => __( 'Services Settings', 'vw-consulting' ),
		'priority'   => null,
		'panel' => 'vw_consulting_panel_id'
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial( 'vw_consulting_section_title', array( 
		'selector' => '.heading h2', 
		'render_callback' => 'vw_consulting_customize_partial_vw_consulting_section_title',
	));

	$wp_customize->add_setting('vw_consulting_section_sub_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_section_sub_title',array(
		'label'	=> __('Add Section Text','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( 'INDUSTRIES', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_services_section',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_consulting_section_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_section_title',array(
		'label'	=> __('Add Section Title','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( 'OUR SERVICES', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_services_section',
		'type'=> 'text'
	));

	$categories = get_categories();
		$cat_posts = array();
			$i = 0;
			$cat_posts[]='Select';	
		foreach($categories as $category){
			if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cat_posts[$category->slug] = $category->name;
	}

	$wp_customize->add_setting('vw_consulting_services',array(
		'default'	=> 'select',
		'sanitize_callback' => 'sanitize_text_field',
	));
	$wp_customize->add_control('vw_consulting_services',array(
		'type'    => 'select',
		'choices' => $cat_posts,
		'label' => __('Select Category to display Services','vw-consulting'),
		'description'=> __('Size of image should be 370 x 270 ','vw-consulting'),
		'section' => 'vw_consulting_services_section',
	));

	//Services excerpt
	$wp_customize->add_setting( 'vw_consulting_services_excerpt_number', array(
		'default'              => 20,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_consulting_services_excerpt_number', array(
		'label'       => esc_html__( 'Services Excerpt length','vw-consulting' ),
		'section'     => 'vw_consulting_services_section',
		'type'        => 'range',
		'settings'    => 'vw_consulting_services_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog Post
	$wp_customize->add_panel( $VWConsultingParentPanel );

	$BlogPostParentPanel = new VW_Consulting_WP_Customize_Panel( $wp_customize, 'blog_post_parent_panel', array(
		'title' => __( 'Blog Post Settings', 'vw-consulting' ),
		'panel' => 'vw_consulting_panel_id',
	));

	$wp_customize->add_panel( $BlogPostParentPanel );

	// Add example section and controls to the middle (second) panel
	$wp_customize->add_section( 'vw_consulting_post_settings', array(
		'title' => __( 'Post Settings', 'vw-consulting' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_consulting_toggle_postdate', array( 
		'selector' => '.post-main-box h2 a', 
		'render_callback' => 'vw_consulting_customize_partial_vw_consulting_toggle_postdate', 
	));

	$wp_customize->add_setting( 'vw_consulting_toggle_postdate',array(
        'default' => 1,
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_toggle_postdate',array(
        'label' => esc_html__( 'Post Date','vw-consulting' ),
        'section' => 'vw_consulting_post_settings'
    )));

    $wp_customize->add_setting( 'vw_consulting_toggle_author',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_toggle_author',array(
		'label' => esc_html__( 'Author','vw-consulting' ),
		'section' => 'vw_consulting_post_settings'
    )));

    $wp_customize->add_setting( 'vw_consulting_toggle_comments',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_toggle_comments',array(
		'label' => esc_html__( 'Comments','vw-consulting' ),
		'section' => 'vw_consulting_post_settings'
    )));

    $wp_customize->add_setting( 'vw_consulting_toggle_tags',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_consulting_switch_sanitization'
	));
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_toggle_tags', array(
		'label' => esc_html__( 'Tags','vw-consulting' ),
		'section' => 'vw_consulting_post_settings'
    )));

    $wp_customize->add_setting( 'vw_consulting_excerpt_number', array(
		'default'              => 30,
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_consulting_excerpt_number', array(
		'label'       => esc_html__( 'Excerpt length','vw-consulting' ),
		'section'     => 'vw_consulting_post_settings',
		'type'        => 'range',
		'settings'    => 'vw_consulting_excerpt_number',
		'input_attrs' => array(
			'step'             => 2,
			'min'              => 0,
			'max'              => 50,
		),
	) );

	//Blog layout
    $wp_customize->add_setting('vw_consulting_blog_layout_option',array(
        'default' => __('Default','vw-consulting'),
        'sanitize_callback' => 'vw_consulting_sanitize_choices'
    ));
    $wp_customize->add_control(new VW_Consulting_Image_Radio_Control($wp_customize, 'vw_consulting_blog_layout_option', array(
        'type' => 'select',
        'label' => __('Blog Layouts','vw-consulting'),
        'section' => 'vw_consulting_post_settings',
        'choices' => array(
            'Default' => get_template_directory_uri().'/assets/images/blog-layout1.png',
            'Center' => get_template_directory_uri().'/assets/images/blog-layout2.png',
            'Left' => get_template_directory_uri().'/assets/images/blog-layout3.png',
    ))));

     $wp_customize->add_setting('vw_consulting_excerpt_settings',array(
        'default' => __('Excerpt','vw-consulting'),
        'transport' => 'refresh',
        'sanitize_callback' => 'vw_consulting_sanitize_choices'
	));
	$wp_customize->add_control('vw_consulting_excerpt_settings',array(
        'type' => 'select',
        'label' => __('Post Content','vw-consulting'),
        'section' => 'vw_consulting_post_settings',
        'choices' => array(
        	'Content' => __('Content','vw-consulting'),
            'Excerpt' => __('Excerpt','vw-consulting'),
            'No Content' => __('No Content','vw-consulting')
        ),
	) );

	$wp_customize->add_setting('vw_consulting_excerpt_suffix',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_excerpt_suffix',array(
		'label'	=> __('Add Excerpt Suffix','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '[...]', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_post_settings',
		'type'=> 'text'
	));

    // Button Settings
	$wp_customize->add_section( 'vw_consulting_button_settings', array(
		'title' => __( 'Button Settings', 'vw-consulting' ),
		'panel' => 'blog_post_parent_panel',
	));

	$wp_customize->add_setting('vw_consulting_button_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_button_padding_top_bottom',array(
		'label'	=> __('Padding Top Bottom','vw-consulting'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_consulting_button_padding_left_right',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_button_padding_left_right',array(
		'label'	=> __('Padding Left Right','vw-consulting'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_button_settings',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_consulting_button_border_radius', array(
		'default'              => '',
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_consulting_button_border_radius', array(
		'label'       => esc_html__( 'Button Border Radius','vw-consulting' ),
		'section'     => 'vw_consulting_button_settings',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_consulting_button_text', array( 
		'selector' => '.post-main-box .more-btn a', 
		'render_callback' => 'vw_consulting_customize_partial_vw_consulting_button_text', 
	));

	$wp_customize->add_setting('vw_consulting_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_button_text',array(
		'label'	=> __('Add Button Text','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( 'Read More', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_button_settings',
		'type'=> 'text'
	));

	// Related Post Settings
	$wp_customize->add_section( 'vw_consulting_related_posts_settings', array(
		'title' => __( 'Related Posts Settings', 'vw-consulting' ),
		'panel' => 'blog_post_parent_panel',
	));

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_consulting_related_post_title', array( 
		'selector' => '.related-post h3', 
		'render_callback' => 'vw_consulting_customize_partial_vw_consulting_related_post_title', 
	));

    $wp_customize->add_setting( 'vw_consulting_related_post',array(
		'default' => 1,
		'transport' => 'refresh',
		'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ) );
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_related_post',array(
		'label' => esc_html__( 'Related Post','vw-consulting' ),
		'section' => 'vw_consulting_related_posts_settings'
    )));

    $wp_customize->add_setting('vw_consulting_related_post_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_related_post_title',array(
		'label'	=> __('Add Related Post Title','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( 'Related Post', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_related_posts_settings',
		'type'=> 'text'
	));

   	$wp_customize->add_setting('vw_consulting_related_posts_count',array(
		'default'=> '3',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_related_posts_count',array(
		'label'	=> __('Add Related Post Count','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '3', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_related_posts_settings',
		'type'=> 'number'
	));

    //404 Page Setting
	$wp_customize->add_section('vw_consulting_404_page',array(
		'title'	=> __('404 Page Settings','vw-consulting'),
		'panel' => 'vw_consulting_panel_id',
	));	

	$wp_customize->add_setting('vw_consulting_404_page_title',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_consulting_404_page_title',array(
		'label'	=> __('Add Title','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '404 Not Found', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_consulting_404_page_content',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));

	$wp_customize->add_control('vw_consulting_404_page_content',array(
		'label'	=> __('Add Text','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( 'Looks like you have taken a wrong turn, Dont worry, it happens to the best of us.', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_404_page',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_consulting_404_page_button_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_404_page_button_text',array(
		'label'	=> __('Add Button Text','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( 'GO BACK', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_404_page',
		'type'=> 'text'
	));

	//Responsive Media Settings
	$wp_customize->add_section('vw_consulting_responsive_media',array(
		'title'	=> __('Responsive Media','vw-consulting'),
		'panel' => 'vw_consulting_panel_id',
	));

	$wp_customize->add_setting( 'vw_consulting_resp_contact_info_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_resp_contact_info_hide_show',array(
      'label' => esc_html__( 'Show / Hide Contact Info','vw-consulting' ),
      'section' => 'vw_consulting_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_consulting_stickyheader_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_stickyheader_hide_show',array(
          'label' => esc_html__( 'Sticky Header','vw-consulting' ),
          'section' => 'vw_consulting_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_consulting_resp_slider_hide_show',array(
      'default' => 0,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_resp_slider_hide_show',array(
      'label' => esc_html__( 'Show / Hide Slider','vw-consulting' ),
      'section' => 'vw_consulting_responsive_media'
    )));

	$wp_customize->add_setting( 'vw_consulting_metabox_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_metabox_hide_show',array(
      'label' => esc_html__( 'Show / Hide Metabox','vw-consulting' ),
      'section' => 'vw_consulting_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_consulting_sidebar_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_sidebar_hide_show',array(
      'label' => esc_html__( 'Show / Hide Sidebar','vw-consulting' ),
      'section' => 'vw_consulting_responsive_media'
    )));

    $wp_customize->add_setting( 'vw_consulting_resp_scroll_top_hide_show',array(
      'default' => 1,
      'transport' => 'refresh',
      'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_resp_scroll_top_hide_show',array(
      'label' => esc_html__( 'Show / Hide Scroll To Top','vw-consulting' ),
      'section' => 'vw_consulting_responsive_media'
    )));

    $wp_customize->add_setting('vw_consulting_res_open_menu_icon',array(
		'default'	=> 'fas fa-bars',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Consulting_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_consulting_res_open_menu_icon',array(
		'label'	=> __('Add Open Menu Icon','vw-consulting'),
		'transport' => 'refresh',
		'section'	=> 'vw_consulting_responsive_media',
		'setting'	=> 'vw_consulting_res_open_menu_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_consulting_res_menu_close_icon',array(
		'default'	=> 'fas fa-times',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Consulting_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_consulting_res_menu_close_icon',array(
		'label'	=> __('Add Close Menu Icon','vw-consulting'),
		'transport' => 'refresh',
		'section'	=> 'vw_consulting_responsive_media',
		'setting'	=> 'vw_consulting_res_menu_close_icon',
		'type'		=> 'icon'
	)));
	
	//Content Creation
	$wp_customize->add_section( 'vw_consulting_content_section' , array(
    	'title' => __( 'Customize Home Page Settings', 'vw-consulting' ),
		'priority' => null,
		'panel' => 'vw_consulting_panel_id'
	) );

	$wp_customize->add_setting('vw_consulting_content_creation_main_control', array(
		'sanitize_callback' => 'esc_html',
	) );

	$homepage= get_option( 'page_on_front' );

	$wp_customize->add_control(	new VW_Consulting_Content_Creation( $wp_customize, 'vw_consulting_content_creation_main_control', array(
		'options' => array(
			esc_html__( 'First select static page in homepage setting for front page.Below given edit button is to customize Home Page. Just click on the edit option, add whatever elements you want to include in the homepage, save the changes and you are good to go.','vw-consulting' ),
		),
		'section' => 'vw_consulting_content_section',
		'button_url'  => admin_url( 'post.php?post='.$homepage.'&action=edit'),
		'button_text' => esc_html__( 'Edit', 'vw-consulting' ),
	) ) );

	//Footer Text
	$wp_customize->add_section('vw_consulting_footer',array(
		'title'	=> __('Footer Settings','vw-consulting'),
		'panel' => 'vw_consulting_panel_id',
	));	

	//Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_consulting_footer_text', array( 
		'selector' => '.copyright p', 
		'render_callback' => 'vw_consulting_customize_partial_vw_consulting_footer_text', 
	));
	
	$wp_customize->add_setting('vw_consulting_footer_text',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('vw_consulting_footer_text',array(
		'label'	=> __('Copyright Text','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( 'Copyright 2019, .....', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_footer',
		'type'=> 'text'
	));	

	$wp_customize->add_setting('vw_consulting_copyright_alingment',array(
        'default' => __('center','vw-consulting'),
        'sanitize_callback' => 'vw_consulting_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Consulting_Image_Radio_Control($wp_customize, 'vw_consulting_copyright_alingment', array(
        'type' => 'select',
        'label' => __('Copyright Alignment','vw-consulting'),
        'section' => 'vw_consulting_footer',
        'settings' => 'vw_consulting_copyright_alingment',
        'choices' => array(
            'left' => get_template_directory_uri().'/assets/images/copyright1.png',
            'center' => get_template_directory_uri().'/assets/images/copyright2.png',
            'right' => get_template_directory_uri().'/assets/images/copyright3.png'
    ))));

    $wp_customize->add_setting('vw_consulting_copyright_padding_top_bottom',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_copyright_padding_top_bottom',array(
		'label'	=> __('Copyright Padding Top Bottom','vw-consulting'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_consulting_hide_show_scroll',array(
    	'default' => 1,
      	'transport' => 'refresh',
      	'sanitize_callback' => 'vw_consulting_switch_sanitization'
    ));  
    $wp_customize->add_control( new VW_Consulting_Toggle_Switch_Custom_Control( $wp_customize, 'vw_consulting_hide_show_scroll',array(
      	'label' => esc_html__( 'Show / Hide Scroll To Top','vw-consulting' ),
      	'section' => 'vw_consulting_footer'
    )));

    //Selective Refresh
	$wp_customize->selective_refresh->add_partial('vw_consulting_scroll_to_top_icon', array( 
		'selector' => '.scrollup i', 
		'render_callback' => 'vw_consulting_customize_partial_vw_consulting_scroll_to_top_icon', 
	));

    $wp_customize->add_setting('vw_consulting_scroll_to_top_icon',array(
		'default'	=> 'fas fa-long-arrow-alt-up',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control(new VW_Consulting_Fontawesome_Icon_Chooser(
        $wp_customize,'vw_consulting_scroll_to_top_icon',array(
		'label'	=> __('Add Scroll to Top Icon','vw-consulting'),
		'transport' => 'refresh',
		'section'	=> 'vw_consulting_footer',
		'setting'	=> 'vw_consulting_scroll_to_top_icon',
		'type'		=> 'icon'
	)));

	$wp_customize->add_setting('vw_consulting_scroll_to_top_font_size',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_scroll_to_top_font_size',array(
		'label'	=> __('Icon Font Size','vw-consulting'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_consulting_scroll_to_top_padding',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_scroll_to_top_padding',array(
		'label'	=> __('Icon Top Bottom Padding','vw-consulting'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_consulting_scroll_to_top_width',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_scroll_to_top_width',array(
		'label'	=> __('Icon Width','vw-consulting'),
		'description'	=> __('Enter a value in pixels Example:20px','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting('vw_consulting_scroll_to_top_height',array(
		'default'=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('vw_consulting_scroll_to_top_height',array(
		'label'	=> __('Icon Height','vw-consulting'),
		'description'	=> __('Enter a value in pixels. Example:20px','vw-consulting'),
		'input_attrs' => array(
            'placeholder' => __( '10px', 'vw-consulting' ),
        ),
		'section'=> 'vw_consulting_footer',
		'type'=> 'text'
	));

	$wp_customize->add_setting( 'vw_consulting_scroll_to_top_border_radius', array(
		'default'              => '',
		'type'                 => 'theme_mod',
		'transport' 		   => 'refresh',
		'sanitize_callback'    => 'absint',
		'sanitize_js_callback' => 'absint',
	) );
	$wp_customize->add_control( 'vw_consulting_scroll_to_top_border_radius', array(
		'label'       => esc_html__( 'Icon Border Radius','vw-consulting' ),
		'section'     => 'vw_consulting_footer',
		'type'        => 'range',
		'input_attrs' => array(
			'step'             => 1,
			'min'              => 1,
			'max'              => 50,
		),
	) );

	$wp_customize->add_setting('vw_consulting_scroll_top_alignment',array(
        'default' => __('Right','vw-consulting'),
        'sanitize_callback' => 'vw_consulting_sanitize_choices'
	));
	$wp_customize->add_control(new VW_Consulting_Image_Radio_Control($wp_customize, 'vw_consulting_scroll_top_alignment', array(
        'type' => 'select',
        'label' => __('Scroll To Top','vw-consulting'),
        'section' => 'vw_consulting_footer',
        'settings' => 'vw_consulting_scroll_top_alignment',
        'choices' => array(
            'Left' => get_template_directory_uri().'/assets/images/layout1.png',
            'Center' => get_template_directory_uri().'/assets/images/layout2.png',
            'Right' => get_template_directory_uri().'/assets/images/layout3.png'
    ))));

    // Has to be at the top
	$wp_customize->register_panel_type( 'VW_Consulting_WP_Customize_Panel' );
	$wp_customize->register_section_type( 'VW_Consulting_WP_Customize_Section' );
}

add_action( 'customize_register', 'vw_consulting_customize_register' );

load_template( trailingslashit( get_template_directory() ) . '/inc/logo/logo-resizer.php' );

if ( class_exists( 'WP_Customize_Panel' ) ) {
  	class VW_Consulting_WP_Customize_Panel extends WP_Customize_Panel {
	    public $panel;
	    public $type = 'vw_consulting_panel';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'type', 'panel', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;
	      return $array;
    	}
  	}
}

if ( class_exists( 'WP_Customize_Section' ) ) {
  	class VW_Consulting_WP_Customize_Section extends WP_Customize_Section {
	    public $section;
	    public $type = 'vw_consulting_section';
	    public function json() {

	      $array = wp_array_slice_assoc( (array) $this, array( 'id', 'description', 'priority', 'panel', 'type', 'description_hidden', 'section', ) );
	      $array['title'] = html_entity_decode( $this->title, ENT_QUOTES, get_bloginfo( 'charset' ) );
	      $array['content'] = $this->get_content();
	      $array['active'] = $this->active();
	      $array['instanceNumber'] = $this->instance_number;

	      if ( $this->panel ) {
	        $array['customizeAction'] = sprintf( 'Customizing &#9656; %s', esc_html( $this->manager->get_panel( $this->panel )->title ) );
	      } else {
	        $array['customizeAction'] = 'Customizing';
	      }
	      return $array;
    	}
  	}
}

// Enqueue our scripts and styles
function vw_consulting_customize_controls_scripts() {
  wp_enqueue_script( 'customizer-controls', get_theme_file_uri( '/assets/js/customizer-controls.js' ), array(), '1.0', true );
}
add_action( 'customize_controls_enqueue_scripts', 'vw_consulting_customize_controls_scripts' );

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class VW_Consulting_Customize {

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
		$manager->register_section_type( 'VW_Consulting_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section( new VW_Consulting_Customize_Section_Pro( $manager,'example_1', array(
			'priority'   => 1,
			'title'    => esc_html__( 'VW CONSULTING PRO', 'vw-consulting' ),
			'pro_text' => esc_html__( 'UPGRADE PRO', 'vw-consulting' ),
			'pro_url'  => esc_url('https://www.vwthemes.com/themes/consulting-wordpress-theme/'),
		) )	);

		$manager->add_section(new VW_Consulting_Customize_Section_Pro($manager,'example_2',array(
			'priority'   => 1,
			'title'    => esc_html__( 'DOCUMENTATION', 'vw-consulting' ),
			'pro_text' => esc_html__( 'DOCS', 'vw-consulting' ),
			'pro_url'  => admin_url('themes.php?page=vw_consulting_guide'),
		)));
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'vw-consulting-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'vw-consulting-customize-controls', trailingslashit( get_template_directory_uri() ) . '/assets/css/customize-controls.css' );
	}
}

// Doing this customizer thang!
VW_Consulting_Customize::get_instance();
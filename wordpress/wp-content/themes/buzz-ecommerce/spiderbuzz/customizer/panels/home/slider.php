<?php
/**
 * Slider Settings
 *
 * @package Buzz_Ecommerce
 */


function buzz_ecommerce_customize_register_slider( $wp_customize ) {
    
    
    
    //Slider Section 
    $wp_customize->add_section( 'frontpage_slider_section', array(
        'title'    => esc_html__( 'Slider Settings', 'buzz-ecommerce' ),
        'priority' => 1,
        'panel'    =>'buzz_ecommerce_homepage_setting'
    ) );

    /*****************************************************
     * Slider Categories List
     *****************************************************/
    $wp_customize->add_setting(
        'buzz_ecommerce_main_slider',
        array(
            'default'           => false,
            'sanitize_callback' => 'buzz_ecommerce_sanitize_checkbox',
        )
    );
    $wp_customize->add_control(
		new Buzz_Ecommerce_Toggle_Control( 
			$wp_customize,
			'buzz_ecommerce_main_slider',
			array(
				'section'	  => 'frontpage_slider_section',
				'label'		  => esc_html__( 'Main Slider (on/off)', 'buzz-ecommerce' ),
                'priority'    => 1,
			)
		)
    );


    /*****************************************************
     * Slider Categories List
     *****************************************************/
    $wp_customize->add_setting(
        'buzz_ecommerce_slider_category_list_enable',
        array(
            'default'           => true,
            'sanitize_callback' => 'buzz_ecommerce_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Buzz_Ecommerce_Toggle_Control( 
			$wp_customize,
			'buzz_ecommerce_slider_category_list_enable',
			array(
				'section'	  => 'frontpage_slider_section',
				'label'		  => esc_html__( 'Products Categories List(on/off)', 'buzz-ecommerce' ),
                'priority'    => 1,
			)
		)
    );
    
    /***************************************************************
     * Slide Button Text Change
     **************************************************************/
    $wp_customize->add_setting(
        'buzz_ecommerce_slider_category_list_header_text',
        array(
            'default'           => esc_html__( 'ALL CATEGORYES','buzz-ecommerce'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=>	'postMessage',
        )
    );
    $wp_customize->add_control(
		'buzz_ecommerce_slider_category_list_header_text',
		array(
			'section'	  => 'frontpage_slider_section',
			'label'		  => esc_html__( 'Slider Category List Header Text Change', 'buzz-ecommerce' ),
			'description' => esc_html__( 'Change the Slider Header Text: Eg: ALL CATEGORYES', 'buzz-ecommerce' ),
            'type'        => 'text',
            'priority'    => 2,
		)		
    );
    //select refresh
	$wp_customize->selective_refresh->add_partial( 'buzz_ecommerce_slider_category_list_header_text', array(
        'selector' 			=> '#buzz_ecommerce_slider_category_list_header_text',
        'render_callback' 	=> 'buzz_ecommerce_slider_category_list_header_text',
    ) );

    

    /***************************************************************
     * Slide Button Text Change
     **************************************************************/
    $wp_customize->add_setting(
        'slider_button_text_change',
        array(
            'default'           => esc_html__( 'Buy Now','buzz-ecommerce'),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'			=>	'postMessage',
        )
    );
    $wp_customize->add_control(
		'slider_button_text_change',
		array(
			'section'	  => 'frontpage_slider_section',
			'label'		  => esc_html__( 'Slider Button Text Change', 'buzz-ecommerce' ),
			'description' => esc_html__( 'Display the Slider Button Text Change', 'buzz-ecommerce' ),
            'type'        => 'text',
            'priority'    => 3,
		)		
    );
    //select refresh
	$wp_customize->selective_refresh->add_partial( 'slider_button_text_change', array(
        'selector' 			=> '.slider_button_text_change',
        'render_callback' 	=> 'slider_button_text_change_callback',
    ) );


    /*****************************************************
     * Custom Add Slider 
     *****************************************************/
    $wp_customize->add_setting( 
        new Buzz_Ecommerce_Repeater_Setting( 
            $wp_customize, 
            'homepage_slider_section', 
            array(
                'default' => array(
                        array(
                            'slider_text'       => esc_html__('Lorem Ipsum is simply dummy text of the printing and typesetting industry.', 'buzz-ecommerce'),
                            'slider_links'      => esc_url('#'),
                            'slider_btn_text'   => esc_html__('Shop Now', 'buzz-ecommerce'),
                            'slider_image'      => esc_url( get_template_directory_uri().'/assets/images/slider-item.jpg' ),                       
                        ),
                    )
                ,
                'sanitize_callback' => array( 'Buzz_Ecommerce_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Buzz_Ecommerce_Repeater_Control(
			$wp_customize,
			'homepage_slider_section',
			array(
                'section' => 'frontpage_slider_section',
                'priority'    => 4,				
				'label'	  => esc_html__( 'Slider Add', 'buzz-ecommerce' ),
				'fields'  => array(
                    'slider_text' => array(
                        'type'        => 'textarea',
                        'label'       => esc_html__( 'Slider Text', 'buzz-ecommerce' ),
                        'description' => esc_html__( 'Sider Text Type Hear.', 'buzz-ecommerce' ),
                    ),
                    'slider_links' => array(
                        'type'        => 'url',
                        'label'       => esc_html__( 'Slider Button Links', 'buzz-ecommerce' ),
                        'description' => esc_html__( 'Slider Links Section.', 'buzz-ecommerce' ),
                    ),
                    'slider_image' => array(
                        'type'        => 'image',
                        'label'       => esc_html__( 'Slider Image Upload', 'buzz-ecommerce' ),
                        'description' => esc_html__( 'Upload the slider image', 'buzz-ecommerce' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => esc_html__( 'Slider Item', 'buzz-ecommerce' ),
                    'field' => 'slider'
                )                        
			)
		)
	);
 

}
add_action( 'customize_register', 'buzz_ecommerce_customize_register_slider' );
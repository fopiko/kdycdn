<?php
/**
 * Stacker Theme Customizer
 *
 * @package Stacker
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function themefurnace_customize_register( $wp_customize )
{
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

	// custom handler - textarea
	class themefurnace_Textarea_Control extends WP_Customize_Control
	{
		public $type = 'textarea';

		public function render_content()
		{
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<textarea rows="5"
						  style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			</label>
		<?php
		}
	}

}

add_action( 'customize_register', 'themefurnace_customize_register' );

function themefurnace_sanitize_menu_position( $value )
{
	if ( !in_array( $value, array( 'left', 'top' ) ) ) {
		$value = 'left';
	}

	return $value;
}

function themefurnace_sanitize_color_hex( $value )
{
	if ( !preg_match( '/\#[a-fA-F0-9]{6}/', $value ) ) {
		$value = '#ffffff';
	}

	return $value;
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function themefurnace_customize_preview_js()
{
	wp_enqueue_script( 'themefurnace_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130524', true );
}

add_action( 'customize_preview_init', 'themefurnace_customize_preview_js' );


function themefurnace_customizer( $wp_customize )
{


	$wp_customize->add_section( 'themefurnacefooter', array(
		'title'       => 'Footer Text', // The title of section
		'priority'    => 50,
		'description' => 'Footer Text', // The description of section
	) );

	$wp_customize->add_setting( 'themefurnacefooter_footer_text', array(
		'default'           => 'Hello world',
		'sanitize_callback' => 'sanitize_text_field',
		// Let everything else default
	) );
	$wp_customize->add_control( 'themefurnacefooter_footer_text', array(
		// wptuts_welcome_text is a id of setting that this control handles
		'label'   => 'Footer Text',
		// 'type' =>, // Default is "text", define the content type of setting rendering.
		'section' => 'themefurnacefooter', // id of section to which the setting belongs
		// Let everything else default
	) );


	// $font_choices array from php file
	require_once( dirname( __FILE__ ) . '/google-fonts/fonts.php' );


	$wp_customize->add_section( 'google_fonts', array(
		'title'    => __( 'Fonts', 'themefurnace' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'themefurnace_google_fonts_heading_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'themefurnace_google_fonts_heading_font', array(
		'label'    => __( 'Header Font', 'themefurnace' ),
		'section'  => 'google_fonts',
		'settings' => 'themefurnace_google_fonts_heading_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	$wp_customize->add_setting( 'themefurnace_google_fonts_body_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'themefurnace_google_fonts_body_font', array(
		'label'    => __( 'Body Font', 'themefurnace' ),
		'section'  => 'google_fonts',
		'settings' => 'themefurnace_google_fonts_body_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );


	$wp_customize->add_section( 'themefurnace_colors', array(
			'title'    => __( 'Colors', 'themefurnace' ),
			'priority' => 35,
		)
	);

	$wp_customize->add_setting( 'themefurnace_content_color', array(
			'default'           => '#ffffff',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'content', array(
		'label'    => __( 'Content color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_content_color',
	) ) );


	$wp_customize->add_setting( 'themefurnace_text_color', array(
			'default'           => '#8b8989',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'text', array(
		'label'    => __( 'Text color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_text_color',
	) ) );


	$wp_customize->add_setting( 'themefurnace_headings_color', array(
			'default'           => '#141414',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'headings', array(
		'label'    => __( 'Headings color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_headings_color',
	) ) );

	$wp_customize->add_setting( 'themefurnace_footer_headings_color', array(
			'default'           => '#ffffff',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_headings', array(
		'label'    => __( 'Footer headings color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_footer_headings_color',
	) ) );

	$wp_customize->add_setting( 'themefurnace_footer_text_color', array(
			'default'           => '#8a8a8a',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text', array(
		'label'    => __( 'Footer text color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_footer_text_color',
	) ) );

	$wp_customize->add_setting( 'themefurnace_header_text_color', array(
			'default'           => '#b8b4b4',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_text', array(
		'label'    => __( 'Header text color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_header_text_color',
	) ) );

	$wp_customize->add_setting( 'themefurnace_header_color', array(
			'default'           => '#ffffff',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header', array(
		'label'    => __( 'Header color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_header_color',
	) ) );

	$wp_customize->add_setting( 'themefurnace_menu_color', array(
			'default'           => '#a2a2a2',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_menu', array(
		'label'    => __( 'Header menu color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_menu_color',
	) ) );

	$wp_customize->add_setting( 'themefurnace_menu_background_color', array(
			'default'           => '#f9f9f9',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_menu_background', array(
		'label'    => __( 'Header menu background color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_menu_background_color',
	) ) );

	$wp_customize->add_setting( 'themefurnace_link_color', array(
			'default'           => '#b8b4b4',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link', array(
		'label'    => __( 'Link color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_link_color',
	) ) );

	$wp_customize->add_setting( 'themefurnace_footer_color', array(
			'default'           => '#292e32',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer', array(
		'label'    => __( 'Footer color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_footer_color',
	) ) );

	$wp_customize->add_setting( 'themefurnace_footer_text_color', array(
			'default'           => '#8a8a8a',
			'type'              => 'theme_mod',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'themefurnace_sanitize_color_hex',
			'transport'         => 'postMessage'
		)
	);

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text', array(
		'label'    => __( 'Footer text color', 'themefurnace' ),
		'section'  => 'colors',
		'settings' => 'themefurnace_footer_text_color',
	) ) );

	$wp_customize->add_section( 'homepage_columns', array(
		'title'    => __( 'Home page columns', 'themefurnace' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'themefurnace_homepage_columns', array(
		'default'           => '3',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'themefurnace_homepage_columns', array(
		'label'    => __( 'Column count for home page', 'themefurnace' ),
		'section'  => 'homepage_columns',
		'settings' => 'themefurnace_homepage_columns',
		'type'     => 'select',
		'choices'  => array( 1 => 1, 2 => 2, 3 => 3, 4 => 4 ),
	) );

}

add_action( 'customize_register', 'themefurnace_customizer', 11 );


<?php
/*
Widgets Code, with thanks to ChillThemes
*/

/* stacker_Widgets class. */

class stacker_Widgets
{

	/*--------------------------------------------*
	 * Attributes
	 *--------------------------------------------*/

	/* Refers to a single instance of this class. */
	private static $instance = null;

	/* Refers to the slug of the plugin screen. */
	private $plugin_screen_slug = null;

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Creates or returns an instance of this class.
	 *
	 * @return stacker_Authors_Widget A single instance of this class.
	 */
	public static function get_instance()
	{
		return null == self::$instance ? new self : self::$instance;
	} // end get_instance;

	/* Initializes the plugin by setting localization, filters, and administration functions. */
	private function __construct()
	{
		// Load plugin textdomain.
		add_action( 'init', array( $this, 'stacker_widgets_plugin_textdomain' ) );

		// Load plugin widgets.
		add_action( 'widgets_init', array( $this, 'stacker_load_widgets' ), 1 );

	} // end constructor

	/* Loads the plugin text domain for translation. */
	public function stacker_widgets_plugin_textdomain()
	{
		// Define plugin domain name.
		$domain = 'stacker-widgets';
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain, false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' );

	} // end plugin_textdomain

	/* Registers and loads plugin-specific widgets. */
	public function stacker_load_widgets()
	{
		/* Load the Widgets. */
		require get_template_directory() . '/inc/widgets/widget-advertisement.php';
		require get_template_directory() . '/inc/widgets/widget-dribbble.php';
		require get_template_directory() . '/inc/widgets/widget-flickr.php';
		require get_template_directory() . '/inc/widgets/widget-recent-images.php';
		require get_template_directory() . '/inc/widgets/widget-social-profiles.php';

	} // end stacker_load_widgets
} // end class
// Instantiation call of your plugin to the name given at the class definition.
stacker_Widgets::get_instance();
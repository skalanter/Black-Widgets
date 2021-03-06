<?php

namespace Elementor;
namespace BW_Modernaweb\Includes\Widgets;
use Elementor\Plugin;

final class BW_Modernaweb_Plugin {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var BW_Modernaweb_Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return BW_Modernaweb_Plugin An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', [ $this, 'i18n' ] );
		add_action( 'plugins_loaded', [ $this, 'init' ] );
		add_action( 'admin_menu', [ $this, 'bw_reg_menu' ] );

		add_filter('upload_mimes', [ $this, 'add_file_types_to_uploads' ]);


	}

	/**
	 * Add dashboard menu
	 *
	 * Fired by `bw_reg_menu` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function bw_reg_menu() {

		$page_title = 'Black Widgets';
		$menu_title = 'Black Widgets';
		$capability = 'manage_options';
		$menu_slug  = 'black-widgets';
		$function   = 'black_widgets_options';
		$icon_url   = plugin_dir_url(__FILE__ ) . '../includes/admin/img/bw.svg';
		$position   = 9;
		add_menu_page(
			$page_title,
			$menu_title,
			$capability,
			$menu_slug,
			$function,
			$icon_url,
			$position
		);

	}

	/**
	 * Add SVG availablity
	 *
	 * Fired by `add_file_types_to_uploads` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function add_file_types_to_uploads($file_types){
		$new_filetypes = array();
		$new_filetypes['svg'] = 'image/svg+xml';
		$file_types = array_merge($file_types, $new_filetypes );
		return $file_types;
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'elementor-test-extension' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}

		// Add Plugin actions
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );

		// Add Category
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

        add_action( 'elementor/editor/after_enqueue_styles', function() {
            wp_register_style( 'style', plugins_url( '/admin/css/black-widgets-admin.css', __FILE__ ), array(), '1', 'all' );
			wp_enqueue_style( 'style' );
		});

		add_action('elementor/editor/before_enqueue_scripts', function() {
			wp_enqueue_script('bw-jquery-plugins', plugin_dir_url( __FILE__ ) . 'front/js/bw-jquery-plugins.js', array(), '1.0.0', 'true' );
			wp_enqueue_script('bw-public', plugin_dir_url( __FILE__ ) . 'front/js/bw-public.js', array(), '1.0.0', 'true' );
		});

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'This is Elementor extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor Plugin', 'elementor-test-extension' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'This is Elementor extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-test-extension' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'elementor-test-extension' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-test-extension' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
        require_once( __DIR__ . '/widgets/bw-title.php'   				);
        require_once( __DIR__ . '/widgets/bw-button.php'  				);
        require_once( __DIR__ . '/widgets/bw-image.php'					);
        require_once( __DIR__ . '/widgets/bw-flipix.php'				);
        require_once( __DIR__ . '/widgets/bw-title-animate.php'     	);
        require_once( __DIR__ . '/widgets/bw-magic-link.php'    		);
        require_once( __DIR__ . '/widgets/bw-dropcap.php'    			);
        require_once( __DIR__ . '/widgets/bw-fade.php'    				);
        require_once( __DIR__ . '/widgets/bw-alert.php'					);
        require_once( __DIR__ . '/widgets/bw-icon.php'					);
        require_once( __DIR__ . '/widgets/bw-list.php'					);
        require_once( __DIR__ . '/widgets/bw-social-links.php'			);
        require_once( __DIR__ . '/widgets/bw-icon-box.php'				);
        require_once( __DIR__ . '/widgets/bw-call-to-action.php'		);

        // Register widget
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Title() 				);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Button() 				);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Image() 				);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Flip_Ix() 				);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Title_Animate() 		);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Magic_Link() 			);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Dropcap() 				);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Fade() 				);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Alert() 				);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Icon() 				);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_List()					);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Social_Links()			);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Icon_Box()				);
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new BW_Call_To_Action()		);

	}

	function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'bw',
			[
				'title' => __( 'Black Widgets', 'bw' ),
				'icon' => 'fa fa-plug',
			]
		);
	
	}

}

BW_Modernaweb_Plugin::instance();
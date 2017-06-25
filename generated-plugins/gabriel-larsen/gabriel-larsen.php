<?php
/**
 * Plugin Name: Gabriel Larsen
 * Plugin URI: http://www.pehe.mobi
 * Description: Nihil alias exercitation voluptatem fugiat earum sed dolore cillum laborum Deserunt consequatur
 * Version: Quis qui explicabo Voluptas consequatur fugit itaque
 * Author: Quibusdam laborum Et exercitationem vel sint voluptatem voluptas minus voluptate dolorem qui cupidatat consequuntur
 * Author URI: http://www.movakahyhiwavo.us
 * Requires at least: Illo esse fugit Nam aute cumque aspernatur quis in fugit
 * Tested up to: Itaque explicabo Nostrum vel voluptatem consectetur ipsum
 *
 * Text Domain: gabriel-larsen
 * Domain Path: /i18n/languages/
 *
 * @package Gabriel_Larsen
 * @category Core
 * @author Quibusdam laborum Et exercitationem vel sint voluptatem voluptas minus voluptate dolorem qui cupidatat consequuntur
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Gabriel_Larsen' ) ) :

/**
 * Main Gabriel_Larsen Class.
 *
 * @class Gabriel_Larsen
 * @version	Quis qui explicabo Voluptas consequatur fugit itaque
 */
final class Gabriel_Larsen {

	/**
	 * Gabriel_Larsen version.
	 *
	 * @var string
	 */
	public $version = 'Quis qui explicabo Voluptas consequatur fugit itaque';

	/**
	 * The single instance of the class.
	 *
	 * @var Gabriel_Larsen
	 * @since Quis qui explicabo Voluptas consequatur fugit itaque
	 */
	protected static $_instance = null;

	/**
	 * Session instance.
	 *
	 * @var GL_Session|GL_Session_Handler
	 */
	public $session = null;

	/**
	 * Query instance.
	 *
	 * @var GL_Query
	 */
	public $query = null;

	/**
	 * Array of deprecated hook handlers.
	 *
	 * @var array of GL_Deprecated_Hooks
	 */
	public $deprecated_hook_handlers = array();

	/**
	 * Main Gabriel_Larsen Instance.
	 *
	 * Ensures only one instance of Gabriel_Larsen is loaded or can be loaded.
	 *
	 * @since Quis qui explicabo Voluptas consequatur fugit itaque
	 * @static
	 * @see GL()
	 * @return Gabriel_Larsen - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 * @since Quis qui explicabo Voluptas consequatur fugit itaque
	 */
	public function __clone() {
		wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'gabriel-larsen' ), 'Quis qui explicabo Voluptas consequatur fugit itaque' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @since Quis qui explicabo Voluptas consequatur fugit itaque
	 */
	public function __wakeup() {
		wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'gabriel-larsen' ), 'Quis qui explicabo Voluptas consequatur fugit itaque' );
	}

	/**
	 * Auto-load in-accessible properties on demand.
	 * @param mixed $key
	 * @return mixed
	 */
	public function __get( $key ) {
		return $this->$key();
	}

	/**
	 * Gabriel_Larsen Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'gabriel_larsen_loaded' );
	}

	/**
	 * Hook into actions and filters.
	 * @since  Quis qui explicabo Voluptas consequatur fugit itaque
	 */
	private function init_hooks() {
		register_activation_hook( __FILE__, array( 'GL_Install', 'install' ) );
		add_action( 'after_setup_theme', array( $this, 'setup_environment' ) );
		add_action( 'after_setup_theme', array( $this, 'include_template_functions' ), 11 );
		add_action( 'init', array( $this, 'init' ), 0 );
		add_action( 'init', array( 'GL_Shortcodes', 'init' ) );
		add_action( 'init', array( 'GL_Emails', 'init_transactional_emails' ) );
		add_action( 'init', array( $this, 'wpdb_table_fix' ), 0 );
		add_action( 'switch_blog', array( $this, 'wpdb_table_fix' ), 0 );
	}

	/**
	 * Define GL Constants.
	 */
	private function define_constants() {
		$upload_dir = wp_upload_dir();

		$this->define( 'GL_PLUGIN_FILE', __FILE__ );
		$this->define( 'GL_ABSPATH', dirname( __FILE__ ) . '/' );
		$this->define( 'GL_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'GL_VERSION', $this->version );
		$this->define( 'GABRIEL_LARSEN_VERSION', $this->version );
		$this->define( 'GL_TEMPLATE_DEBUG_MODE', false );
	}

	/**
	 * Define constant if not already set.
	 *
	 * @param  string $name
	 * @param  string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * What type of request is this?
	 *
	 * @param  string $type admin, ajax, cron or frontend.
	 * @return bool
	 */
	private function is_request( $type ) {
		switch ( $type ) {
			case 'admin' :
				return is_admin();
			case 'ajax' :
				return defined( 'DOING_AJAX' );
			case 'cron' :
				return defined( 'DOING_CRON' );
			case 'frontend' :
				return ( ! is_admin() || defined( 'DOING_AJAX' ) ) && ! defined( 'DOING_CRON' );
		}
	}

	/**
	 * Check the active theme.
	 *
	 * @since  2.6.9
	 * @param  string $theme Theme slug to check
	 * @return bool
	 */
	private function is_active_theme( $theme ) {
		return get_template() === $theme;
	}

	/**
	 * Include required core files used in admin and on the frontend.
	 */
	public function includes() {
		/**
		 * Class autoloader.
		 */
		include_once( GL_ABSPATH . 'includes/class-gl-autoloader.php' );

		/**
		 * Interfaces.
		 */

		include_once( GL_ABSPATH . 'includes/interfaces/class-gl-log-handler-interface.php' );

		/**
		 * Abstract classes.
		 */
		include_once( GL_ABSPATH . 'includes/abstracts/abstract-gl-data.php' ); // GL_Data for CRUD
		include_once( GL_ABSPATH . 'includes/abstracts/abstract-gl-object-query.php' ); // GL_Object_Query for CRUD
		include_once( GL_ABSPATH . 'includes/abstracts/abstract-gl-log-handler.php' );
		include_once( GL_ABSPATH . 'includes/abstracts/abstract-gl-deprecated-hooks.php' );
		include_once( GL_ABSPATH . 'includes/abstracts/abstract-gl-session.php' );

		/**
		 * Core classes.
		 */
		include_once( GL_ABSPATH . 'includes/gl-core-functions.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-datetime.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-post-types.php' ); // Registers post types
		include_once( GL_ABSPATH . 'includes/class-gl-install.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-geolocation.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-download-handler.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-comments.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-post-data.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-ajax.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-emails.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-data-exception.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-query.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-countries.php' ); // Defines countries and states
		include_once( GL_ABSPATH . 'includes/class-gl-integrations.php' ); // Loads integrations
		include_once( GL_ABSPATH . 'includes/class-gl-cache-helper.php' ); // Cache Helper
		include_once( GL_ABSPATH . 'includes/class-gl-https.php' ); // https Helper
		include_once( GL_ABSPATH . 'includes/class-gl-deprecated-action-hooks.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-deprecated-filter-hooks.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-background-emailer.php' );

		/**
		 * Data stores - used to store and retrieve CRUD object data from the database.
		 */
		include_once( GL_ABSPATH . 'includes/class-gl-data-store.php' );
		include_once( GL_ABSPATH . 'includes/data-stores/class-gl-data-store-wp.php' );


		/**
		 * REST API.
		 */
		include_once( GL_ABSPATH . 'includes/class-gl-legacy-api.php' );
 		include_once( GL_ABSPATH . 'includes/class-gl-api.php' ); // API Class
 		include_once( GL_ABSPATH . 'includes/class-gl-auth.php' ); // Auth Class
 		include_once( GL_ABSPATH . 'includes/class-gl-register-wp-admin-settings.php' );

		if ( defined( 'GL_CLI' ) && WP_CLI ) {
 			include_once( GL_ABSPATH . 'includes/class-gl-cli.php' );
 		}

		if ( $this->is_request( 'admin' ) ) {
			include_once( GL_ABSPATH . 'includes/admin/class-gl-admin.php' );
		}

		if ( $this->is_request( 'frontend' ) ) {
			$this->frontend_includes();
		}

		if ( $this->is_request( 'frontend' ) || $this->is_request( 'cron' ) ) {
			include_once( GL_ABSPATH . 'includes/class-gl-session-handler.php' );
		}

		if ( $this->is_request( 'cron' ) && 'yes' === get_option( 'gabriel_larsen_allow_tracking', 'no' ) ) {
			include_once( GL_ABSPATH . 'includes/class-gl-tracker.php' );
		}

		$this->query = new GL_Query();
		$this->api   = new GL_API();
	}

	/**
	 * Include required frontend files.
	 */
	public function frontend_includes() {
		include_once( GL_ABSPATH . 'includes/gl-notice-functions.php' );
		include_once( GL_ABSPATH . 'includes/gl-template-hooks.php' );
		include_once( GL_ABSPATH . 'includes/class-gl-template-loader.php' );                // Template Loader
		include_once( GL_ABSPATH . 'includes/class-gl-frontend-scripts.php' );               // Frontend Scripts
		include_once( GL_ABSPATH . 'includes/class-gl-form-handler.php' );                   // Form Handlers
		include_once( GL_ABSPATH . 'includes/class-gl-shortcodes.php' );                     // Shortcodes class
		include_once( GL_ABSPATH . 'includes/class-gl-embed.php' );                          // Embeds
		include_once( GL_ABSPATH . 'includes/class-gl-structured-data.php' );                // Structured Data class

		if ( $this->is_active_theme( 'twentyseventeen' ) ) {
			include_once( GL_ABSPATH . 'includes/theme-support/class-gl-twenty-seventeen.php' );
		}
	}

	/**
	 * Function used to Init Gabriel Larsen Template Functions - This makes them pluggable by plugins and themes.
	 */
	public function include_template_functions() {
		include_once( GL_ABSPATH . 'includes/gl-template-functions.php' );
	}

	/**
	 * Init Gabriel Larsen when WordPress Initialises.
	 */
	public function init() {
		// Before init action.
		do_action( 'before_gabriel_larsen_init' );

		// Set up localisation.
		$this->load_plugin_textdomain();

		// Load class instances.

		$this->countries                           = new GL_Countries(); // Countries class
		$this->integrations                        = new GL_Integrations(); // Integrations class
		$this->structured_data                     = new GL_Structured_Data(); // Structured Data class, generates and handles structured data
		$this->deprecated_hook_handlers['actions'] = new GL_Deprecated_Action_Hooks();
		$this->deprecated_hook_handlers['filters'] = new GL_Deprecated_Filter_Hooks();

		// Session class, handles session data for users - can be overwritten if custom handler is needed.
		if ( $this->is_request( 'frontend' ) || $this->is_request( 'cron' ) ) {
			$session_class  = apply_filters( 'gabriel_larsen_session_handler', 'GL_Session_Handler' );
			$this->session  = new $session_class();
		}

		// Classes/actions loaded for the frontend and for ajax requests.
		if ( $this->is_request( 'frontend' ) ) {
			$this->cart            = new GL_Cart();                                  // Cart class, stores the cart contents
			$this->customer        = new GL_Customer( get_current_user_id(), true ); // Customer class, handles data such as customer location
			add_action( 'shutdown', array( $this->customer, 'save' ), 10 );          // Customer should be saved during shutdown.
		}

		$this->load_webhooks();

		// Init action.
		do_action( 'gabriel_larsen_init' );
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/gabriel-larsen/gabriel-larsen-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/gabriel-larsen-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, 'gabriel-larsen' );

		unload_textdomain( 'gabriel-larsen' );
		load_textdomain( 'gabriel-larsen', WP_LANG_DIR . '/gabriel-larsen/gabriel-larsen-' . $locale . '.mo' );
		load_plugin_textdomain( 'gabriel-larsen', false, plugin_basename( dirname( __FILE__ ) ) . '/i18n/languages' );
	}

	/**
	 * Ensure theme and server variable compatibility and setup image sizes.
	 */
	public function setup_environment() {
		/**
		 * @deprecated 2.2 Use GL()->template_path()
		 */
		$this->define( 'GL_TEMPLATE_PATH', $this->template_path() );

		$this->add_thumbnail_support();
		$this->add_image_sizes();
	}

	/**
	 * Ensure post thumbnail support is turned on.
	 */
	private function add_thumbnail_support() {
		if ( ! current_theme_supports( 'post-thumbnails' ) ) {
			add_theme_support( 'post-thumbnails' );
		}
		add_post_type_support( 'product', 'thumbnail' );
	}

	/**
	 * Add GL Image sizes to WP.
	 *
	 * @since 2.3
	 */
	private function add_image_sizes() {
		$shop_thumbnail = gl_get_image_size( 'shop_thumbnail' );
		$shop_catalog	= gl_get_image_size( 'shop_catalog' );
		$shop_single	= gl_get_image_size( 'shop_single' );

		add_image_size( 'shop_thumbnail', $shop_thumbnail['width'], $shop_thumbnail['height'], $shop_thumbnail['crop'] );
		add_image_size( 'shop_catalog', $shop_catalog['width'], $shop_catalog['height'], $shop_catalog['crop'] );
		add_image_size( 'shop_single', $shop_single['width'], $shop_single['height'], $shop_single['crop'] );
	}

	/**
	 * Get the plugin url.
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Get the template path.
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'gabriel_larsen_template_path', 'gabriel-larsen/' );
	}

	/**
	 * Get Ajax URL.
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}

	/**
	 * Return the GL API URL for a given request.
	 *
	 * @param string $request
	 * @param mixed $ssl (default: null)
	 * @return string
	 */
	public function api_request_url( $request, $ssl = null ) {
		if ( is_null( $ssl ) ) {
			$scheme = parse_url( home_url(), PHP_URL_SCHEME );
		} elseif ( $ssl ) {
			$scheme = 'https';
		} else {
			$scheme = 'http';
		}

		if ( strstr( get_option( 'permalink_structure' ), '/index.php/' ) ) {
			$api_request_url = trailingslashit( home_url( '/index.php/gl-api/' . $request, $scheme ) );
		} elseif ( get_option( 'permalink_structure' ) ) {
			$api_request_url = trailingslashit( home_url( '/gl-api/' . $request, $scheme ) );
		} else {
			$api_request_url = add_query_arg( 'gl-api', $request, trailingslashit( home_url( '', $scheme ) ) );
		}

		return esc_url_raw( apply_filters( 'gabriel_larsen_api_request_url', $api_request_url, $request, $ssl ) );
	}

	/**
	 * Load & enqueue active webhooks.
	 *
	 * @since 2.2
	 */
	private function load_webhooks() {

		if ( ! is_blog_installed() ) {
			return;
		}

		if ( false === ( $webhooks = get_transient( 'gabriel_larsen_webhook_ids' ) ) ) {
			$webhooks = get_posts( array(
				'fields'         => 'ids',
				'post_type'      => 'shop_webhook',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			) );
			set_transient( 'gabriel_larsen_webhook_ids', $webhooks );
		}
		foreach ( $webhooks as $webhook_id ) {
			$webhook = new GL_Webhook( $webhook_id );
			$webhook->enqueue();
		}
	}

	/**
	 * WooCommerce Payment Token Meta API and Term/Order item Meta - set table names.
	 */
	public function wpdb_table_fix() {
		global $wpdb;
		$wpdb->payment_tokenmeta    = $wpdb->prefix . 'gabriel_larsen_payment_tokenmeta';
		$wpdb->order_itemmeta       = $wpdb->prefix . 'gabriel_larsen_order_itemmeta';
		$wpdb->tables[]             = 'gabriel_larsen_payment_tokenmeta';
		$wpdb->tables[]             = 'gabriel_larsen_order_itemmeta';

		if ( get_option( 'db_version' ) < 34370 ) {
			$wpdb->gabriel_larsen_termmeta = $wpdb->prefix . 'gabriel_larsen_termmeta';
			$wpdb->tables[]             = 'gabriel_larsen_termmeta';
		}
	}

	/**
	 * Get Checkout Class.
	 * @return GL_Checkout
	 */
	public function checkout() {
		return GL_Checkout::instance();
	}

	/**
	 * Get gateways class.
	 * @return GL_Payment_Gateways
	 */
	public function payment_gateways() {
		return GL_Payment_Gateways::instance();
	}

	/**
	 * Get shipping class.
	 * @return GL_Shipping
	 */
	public function shipping() {
		return GL_Shipping::instance();
	}

	/**
	 * Email Class.
	 * @return GL_Emails
	 */
	public function mailer() {
		return GL_Emails::instance();
	}
}

endif;

/**
 * Main instance of Gabriel_Larsen.
 *
 * Returns the main instance of GL to prevent the need to use globals.
 *
 * @since  Quis qui explicabo Voluptas consequatur fugit itaque
 * @return Gabriel_Larsen
 */
function GL() {
	return Gabriel_Larsen::instance();
}

// Global for backwards compatibility.
$GLOBALS['gabriel-larsen'] = GL();

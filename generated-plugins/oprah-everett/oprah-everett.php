<?php
/**
 * Plugin Name: Oprah Everett
 * Plugin URI: http://www.qewowuqefyqebuk.ca
 * Description: Recusandae Consectetur odit qui recusandae Quis quia autem dolor unde mollitia iusto vel
 * Version: Sed dolores blanditiis earum est veritatis assumenda qui mollitia ut voluptatibus ut dignissimos dignissimos irure id
 * Author: Incididunt vel error magna qui
 * Author URI: http://www.lofasehaja.cc
 * Requires at least: Enim non autem aut aliquam praesentium id molestiae quos deserunt velit sed laborum Impedit accusamus hic a
 * Tested up to: Eum laboris eos et voluptatem Sed nulla voluptas ipsum ratione ducimus quae qui
 *
 * Text Domain: oprah-everett
 * Domain Path: /i18n/languages/
 *
 * @package Oprah_Everett
 * @category Core
 * @author Incididunt vel error magna qui
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Oprah_Everett' ) ) :

/**
 * Main Oprah_Everett Class.
 *
 * @class Oprah_Everett
 * @version	Sed dolores blanditiis earum est veritatis assumenda qui mollitia ut voluptatibus ut dignissimos dignissimos irure id
 */
final class Oprah_Everett {

	/**
	 * Oprah_Everett version.
	 *
	 * @var string
	 */
	public $version = 'Sed dolores blanditiis earum est veritatis assumenda qui mollitia ut voluptatibus ut dignissimos dignissimos irure id';

	/**
	 * The single instance of the class.
	 *
	 * @var Oprah_Everett
	 * @since Sed dolores blanditiis earum est veritatis assumenda qui mollitia ut voluptatibus ut dignissimos dignissimos irure id
	 */
	protected static $_instance = null;

	/**
	 * Session instance.
	 *
	 * @var OE_Session|OE_Session_Handler
	 */
	public $session = null;

	/**
	 * Query instance.
	 *
	 * @var OE_Query
	 */
	public $query = null;

	/**
	 * Array of deprecated hook handlers.
	 *
	 * @var array of OE_Deprecated_Hooks
	 */
	public $deprecated_hook_handlers = array();

	/**
	 * Main Oprah_Everett Instance.
	 *
	 * Ensures only one instance of Oprah_Everett is loaded or can be loaded.
	 *
	 * @since Sed dolores blanditiis earum est veritatis assumenda qui mollitia ut voluptatibus ut dignissimos dignissimos irure id
	 * @static
	 * @see OE()
	 * @return Oprah_Everett - Main instance.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Cloning is forbidden.
	 * @since Sed dolores blanditiis earum est veritatis assumenda qui mollitia ut voluptatibus ut dignissimos dignissimos irure id
	 */
	public function __clone() {
		wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'oprah-everett' ), 'Sed dolores blanditiis earum est veritatis assumenda qui mollitia ut voluptatibus ut dignissimos dignissimos irure id' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @since Sed dolores blanditiis earum est veritatis assumenda qui mollitia ut voluptatibus ut dignissimos dignissimos irure id
	 */
	public function __wakeup() {
		wc_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'oprah-everett' ), 'Sed dolores blanditiis earum est veritatis assumenda qui mollitia ut voluptatibus ut dignissimos dignissimos irure id' );
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
	 * Oprah_Everett Constructor.
	 */
	public function __construct() {
		$this->define_constants();
		$this->includes();
		$this->init_hooks();

		do_action( 'oprah_everett_loaded' );
	}

	/**
	 * Hook into actions and filters.
	 * @since  Sed dolores blanditiis earum est veritatis assumenda qui mollitia ut voluptatibus ut dignissimos dignissimos irure id
	 */
	private function init_hooks() {
		register_activation_hook( __FILE__, array( 'OE_Install', 'install' ) );
		add_action( 'after_setup_theme', array( $this, 'setup_environment' ) );
		add_action( 'after_setup_theme', array( $this, 'include_template_functions' ), 11 );
		add_action( 'init', array( $this, 'init' ), 0 );
		add_action( 'init', array( 'OE_Shortcodes', 'init' ) );
		add_action( 'init', array( 'OE_Emails', 'init_transactional_emails' ) );
		add_action( 'init', array( $this, 'wpdb_table_fix' ), 0 );
		add_action( 'switch_blog', array( $this, 'wpdb_table_fix' ), 0 );
	}

	/**
	 * Define OE Constants.
	 */
	private function define_constants() {
		$upload_dir = wp_upload_dir();

		$this->define( 'OE_PLUGIN_FILE', __FILE__ );
		$this->define( 'OE_ABSPATH', dirname( __FILE__ ) . '/' );
		$this->define( 'OE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'OE_VERSION', $this->version );
		$this->define( 'OPRAH_EVERETT_VERSION', $this->version );
		$this->define( 'OE_TEMPLATE_DEBUG_MODE', false );
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
		include_once( OE_ABSPATH . 'includes/class-oe-autoloader.php' );

		/**
		 * Interfaces.
		 */

		include_once( OE_ABSPATH . 'includes/interfaces/class-oe-log-handler-interface.php' );

		/**
		 * Abstract classes.
		 */
		include_once( OE_ABSPATH . 'includes/abstracts/abstract-oe-data.php' ); // OE_Data for CRUD
		include_once( OE_ABSPATH . 'includes/abstracts/abstract-oe-object-query.php' ); // OE_Object_Query for CRUD
		include_once( OE_ABSPATH . 'includes/abstracts/abstract-oe-log-handler.php' );
		include_once( OE_ABSPATH . 'includes/abstracts/abstract-oe-deprecated-hooks.php' );
		include_once( OE_ABSPATH . 'includes/abstracts/abstract-oe-session.php' );

		/**
		 * Core classes.
		 */
		include_once( OE_ABSPATH . 'includes/oe-core-functions.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-datetime.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-post-types.php' ); // Registers post types
		include_once( OE_ABSPATH . 'includes/class-oe-install.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-geolocation.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-download-handler.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-comments.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-post-data.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-ajax.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-emails.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-data-exception.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-query.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-countries.php' ); // Defines countries and states
		include_once( OE_ABSPATH . 'includes/class-oe-integrations.php' ); // Loads integrations
		include_once( OE_ABSPATH . 'includes/class-oe-cache-helper.php' ); // Cache Helper
		include_once( OE_ABSPATH . 'includes/class-oe-https.php' ); // https Helper
		include_once( OE_ABSPATH . 'includes/class-oe-deprecated-action-hooks.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-deprecated-filter-hooks.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-background-emailer.php' );

		/**
		 * Data stores - used to store and retrieve CRUD object data from the database.
		 */
		include_once( OE_ABSPATH . 'includes/class-oe-data-store.php' );
		include_once( OE_ABSPATH . 'includes/data-stores/class-oe-data-store-wp.php' );


		/**
		 * REST API.
		 */
		include_once( OE_ABSPATH . 'includes/class-oe-legacy-api.php' );
 		include_once( OE_ABSPATH . 'includes/class-oe-api.php' ); // API Class
 		include_once( OE_ABSPATH . 'includes/class-oe-auth.php' ); // Auth Class
 		include_once( OE_ABSPATH . 'includes/class-oe-register-wp-admin-settings.php' );

		if ( defined( 'OE_CLI' ) && WP_CLI ) {
 			include_once( OE_ABSPATH . 'includes/class-oe-cli.php' );
 		}

		if ( $this->is_request( 'admin' ) ) {
			include_once( OE_ABSPATH . 'includes/admin/class-oe-admin.php' );
		}

		if ( $this->is_request( 'frontend' ) ) {
			$this->frontend_includes();
		}

		if ( $this->is_request( 'frontend' ) || $this->is_request( 'cron' ) ) {
			include_once( OE_ABSPATH . 'includes/class-oe-session-handler.php' );
		}

		if ( $this->is_request( 'cron' ) && 'yes' === get_option( 'oprah_everett_allow_tracking', 'no' ) ) {
			include_once( OE_ABSPATH . 'includes/class-oe-tracker.php' );
		}

		$this->query = new OE_Query();
		$this->api   = new OE_API();
	}

	/**
	 * Include required frontend files.
	 */
	public function frontend_includes() {
		include_once( OE_ABSPATH . 'includes/oe-notice-functions.php' );
		include_once( OE_ABSPATH . 'includes/oe-template-hooks.php' );
		include_once( OE_ABSPATH . 'includes/class-oe-template-loader.php' );                // Template Loader
		include_once( OE_ABSPATH . 'includes/class-oe-frontend-scripts.php' );               // Frontend Scripts
		include_once( OE_ABSPATH . 'includes/class-oe-form-handler.php' );                   // Form Handlers
		include_once( OE_ABSPATH . 'includes/class-oe-shortcodes.php' );                     // Shortcodes class
		include_once( OE_ABSPATH . 'includes/class-oe-embed.php' );                          // Embeds
		include_once( OE_ABSPATH . 'includes/class-oe-structured-data.php' );                // Structured Data class

		if ( $this->is_active_theme( 'twentyseventeen' ) ) {
			include_once( OE_ABSPATH . 'includes/theme-support/class-oe-twenty-seventeen.php' );
		}
	}

	/**
	 * Function used to Init Oprah Everett Template Functions - This makes them pluggable by plugins and themes.
	 */
	public function include_template_functions() {
		include_once( OE_ABSPATH . 'includes/oe-template-functions.php' );
	}

	/**
	 * Init Oprah Everett when WordPress Initialises.
	 */
	public function init() {
		// Before init action.
		do_action( 'before_oprah_everett_init' );

		// Set up localisation.
		$this->load_plugin_textdomain();

		// Load class instances.

		$this->countries                           = new OE_Countries(); // Countries class
		$this->integrations                        = new OE_Integrations(); // Integrations class
		$this->structured_data                     = new OE_Structured_Data(); // Structured Data class, generates and handles structured data
		$this->deprecated_hook_handlers['actions'] = new OE_Deprecated_Action_Hooks();
		$this->deprecated_hook_handlers['filters'] = new OE_Deprecated_Filter_Hooks();

		// Session class, handles session data for users - can be overwritten if custom handler is needed.
		if ( $this->is_request( 'frontend' ) || $this->is_request( 'cron' ) ) {
			$session_class  = apply_filters( 'oprah_everett_session_handler', 'OE_Session_Handler' );
			$this->session  = new $session_class();
		}

		// Classes/actions loaded for the frontend and for ajax requests.
		if ( $this->is_request( 'frontend' ) ) {
			$this->cart            = new OE_Cart();                                  // Cart class, stores the cart contents
			$this->customer        = new OE_Customer( get_current_user_id(), true ); // Customer class, handles data such as customer location
			add_action( 'shutdown', array( $this->customer, 'save' ), 10 );          // Customer should be saved during shutdown.
		}

		$this->load_webhooks();

		// Init action.
		do_action( 'oprah_everett_init' );
	}

	/**
	 * Load Localisation files.
	 *
	 * Note: the first-loaded translation file overrides any following ones if the same translation is present.
	 *
	 * Locales found in:
	 *      - WP_LANG_DIR/oprah-everett/oprah-everett-LOCALE.mo
	 *      - WP_LANG_DIR/plugins/oprah-everett-LOCALE.mo
	 */
	public function load_plugin_textdomain() {
		$locale = is_admin() && function_exists( 'get_user_locale' ) ? get_user_locale() : get_locale();
		$locale = apply_filters( 'plugin_locale', $locale, 'oprah-everett' );

		unload_textdomain( 'oprah-everett' );
		load_textdomain( 'oprah-everett', WP_LANG_DIR . '/oprah-everett/oprah-everett-' . $locale . '.mo' );
		load_plugin_textdomain( 'oprah-everett', false, plugin_basename( dirname( __FILE__ ) ) . '/i18n/languages' );
	}

	/**
	 * Ensure theme and server variable compatibility and setup image sizes.
	 */
	public function setup_environment() {
		/**
		 * @deprecated 2.2 Use OE()->template_path()
		 */
		$this->define( 'OE_TEMPLATE_PATH', $this->template_path() );

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
	 * Add OE Image sizes to WP.
	 *
	 * @since 2.3
	 */
	private function add_image_sizes() {
		$shop_thumbnail = oe_get_image_size( 'shop_thumbnail' );
		$shop_catalog	= oe_get_image_size( 'shop_catalog' );
		$shop_single	= oe_get_image_size( 'shop_single' );

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
		return apply_filters( 'oprah_everett_template_path', 'oprah-everett/' );
	}

	/**
	 * Get Ajax URL.
	 * @return string
	 */
	public function ajax_url() {
		return admin_url( 'admin-ajax.php', 'relative' );
	}

	/**
	 * Return the OE API URL for a given request.
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
			$api_request_url = trailingslashit( home_url( '/index.php/oe-api/' . $request, $scheme ) );
		} elseif ( get_option( 'permalink_structure' ) ) {
			$api_request_url = trailingslashit( home_url( '/oe-api/' . $request, $scheme ) );
		} else {
			$api_request_url = add_query_arg( 'oe-api', $request, trailingslashit( home_url( '', $scheme ) ) );
		}

		return esc_url_raw( apply_filters( 'oprah_everett_api_request_url', $api_request_url, $request, $ssl ) );
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

		if ( false === ( $webhooks = get_transient( 'oprah_everett_webhook_ids' ) ) ) {
			$webhooks = get_posts( array(
				'fields'         => 'ids',
				'post_type'      => 'shop_webhook',
				'post_status'    => 'publish',
				'posts_per_page' => -1,
			) );
			set_transient( 'oprah_everett_webhook_ids', $webhooks );
		}
		foreach ( $webhooks as $webhook_id ) {
			$webhook = new OE_Webhook( $webhook_id );
			$webhook->enqueue();
		}
	}

	/**
	 * WooCommerce Payment Token Meta API and Term/Order item Meta - set table names.
	 */
	public function wpdb_table_fix() {
		global $wpdb;
		$wpdb->payment_tokenmeta    = $wpdb->prefix . 'oprah_everett_payment_tokenmeta';
		$wpdb->order_itemmeta       = $wpdb->prefix . 'oprah_everett_order_itemmeta';
		$wpdb->tables[]             = 'oprah_everett_payment_tokenmeta';
		$wpdb->tables[]             = 'oprah_everett_order_itemmeta';

		if ( get_option( 'db_version' ) < 34370 ) {
			$wpdb->oprah_everett_termmeta = $wpdb->prefix . 'oprah_everett_termmeta';
			$wpdb->tables[]             = 'oprah_everett_termmeta';
		}
	}

	/**
	 * Get Checkout Class.
	 * @return OE_Checkout
	 */
	public function checkout() {
		return OE_Checkout::instance();
	}

	/**
	 * Get gateways class.
	 * @return OE_Payment_Gateways
	 */
	public function payment_gateways() {
		return OE_Payment_Gateways::instance();
	}

	/**
	 * Get shipping class.
	 * @return OE_Shipping
	 */
	public function shipping() {
		return OE_Shipping::instance();
	}

	/**
	 * Email Class.
	 * @return OE_Emails
	 */
	public function mailer() {
		return OE_Emails::instance();
	}
}

endif;

/**
 * Main instance of Oprah_Everett.
 *
 * Returns the main instance of OE to prevent the need to use globals.
 *
 * @since  Sed dolores blanditiis earum est veritatis assumenda qui mollitia ut voluptatibus ut dignissimos dignissimos irure id
 * @return Oprah_Everett
 */
function OE() {
	return Oprah_Everett::instance();
}

// Global for backwards compatibility.
$GLOBALS['oprah-everett'] = OE();

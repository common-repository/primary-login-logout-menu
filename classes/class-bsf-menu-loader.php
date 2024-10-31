<?php
/**
 * Responsible for setting up constants, classes and includes.
 *
 * @author BrainstormForce
 * @package PRIMARY-LOGIN-LOGOUT-MENU/Loader
 */

if ( ! class_exists( 'Class_BSF_Menu_Loader' ) ) {
	/**
	 * Responsible for setting up constants, classes and includes.
	 *
	 * @since 1.0
	 */
	final class Class_BSF_Menu_Loader {
		/**
		 * The unique instance of the plugin.
		 *
		 * @var Instance variable
		 */
		private static $instance;

		/**
		 * Gets an instance of our plugin.
		 */
		/**
		 * Gets an instance of our plugin.
		 */
		public static function get_instance() {

			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		/**
		 * Constructor.
		 */
		private function __construct() {

			$this->define_constants();
			$this->load_files();
			$this->init_hooks();
		}

		 /**
         * Initialization hooks
         *
         * @category Hooks
         */
        function init_hooks() {
            add_action( 'admin_menu', array( $this, 'register_options_menu' ), 99 );
            add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ), 10 );
            add_action( 'admin_init', array( $this, 'register_primary_login_logout_settings' ) );
        }

        /**
         * Regsiter option menu
         *
         * @category Filter
         */
        function register_options_menu() {
            add_submenu_page( 
                'options-general.php', 
                'Primary Login/Logout', 
                'Primary Login/Logout', 
                'manage_options', 
                'primary_login_logout_settings', 
                array(&$this, 'render_options_page')
            );
        }

        /**
         * Includes options page
         */
        function render_options_page() {
            require_once PRIMARY_LOGIN_LOGOUT_MENU_BASE_DIR . 'includes/primary-login-logout-options-page.php';
        }

        /**
         * Enqueue admin scripts.
         *
         * @since 1.0
         */
        function enqueue_admin_scripts() {
            wp_enqueue_style( 'primary-login-logout-style', PRIMARY_LOGIN_LOGOUT_MENU_BASE_URL . 'assets/css/admin.css' );
        }
        /**
         * Register setting option variables.
         */
        function register_primary_login_logout_settings() {
            // Register our settings.
            register_setting( 'primary-logoing-logout-settings-group', 'login_url' );
            register_setting( 'primary-logoing-logout-settings-group', 'logout_url' );
            // register_setting( 'primary-logoing-logout-settings-group', 'enable_admin_menu' );
        }

		/**
		 * Define constants.
		 *
		 * @since 1.0
		 * @return void
		 */
		private function define_constants() {

			$file = dirname( dirname( __FILE__ ) );
			define( 'PRIMARY_LOGIN_LOGOUT_MENU_VERSION', '1.0.0' );
			define( 'PRIMARY_LOGIN_LOGOUT_MENU_DIR_NAME', plugin_basename( $file ) );
			define( 'PRIMARY_LOGIN_LOGOUT_MENU_BASE_FILE', trailingslashit( $file ) . PRIMARY_LOGIN_LOGOUT_MENU_DIR_NAME . '.php' );
			define( 'PRIMARY_LOGIN_LOGOUT_MENU_BASE_DIR', plugin_dir_path( PRIMARY_LOGIN_LOGOUT_MENU_BASE_FILE ) );
			define( 'PRIMARY_LOGIN_LOGOUT_MENU_BASE_URL', plugins_url( '/', PRIMARY_LOGIN_LOGOUT_MENU_BASE_FILE ) );
		}

		/**
		 * Loads classes and includes.
		 *
		 * @since 1.0
		 * @return void
		 */
		static private function load_files() {
			require_once PRIMARY_LOGIN_LOGOUT_MENU_BASE_DIR . 'includes/class-bsf-primary-menu.php';
		}
	}

	$BSF_Primary_Loader = Class_BSF_Menu_Loader::get_instance();

}

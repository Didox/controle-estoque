<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://badah.com.br/controle-estoque
 * @since      1.0.0
 *
 * @package    Controle_Estoque
 * @subpackage Controle_Estoque/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Controle_Estoque
 * @subpackage Controle_Estoque/includes
 * @author     Daniel Hernandes <badah@badah.com.br>
 */
class Controle_Estoque {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Controle_Estoque_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $controle_estoque    The string used to uniquely identify this plugin.
	 */
	protected $controle_estoque;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->controle_estoque = 'controle-estoque';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Controle_Estoque_Loader. Orchestrates the hooks of the plugin.
	 * - Controle_Estoque_i18n. Defines internationalization functionality.
	 * - Controle_Estoque_Admin. Defines all hooks for the admin area.
	 * - Controle_Estoque_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-controle-estoque-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-controle-estoque-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-controle-estoque-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-controle-estoque-public.php';

		/**
		 * The ACF Include
		 */
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'vendor/advanced-custom-fields/acf.php' );

		/**
		 * ACF generated fields
		 */
		include_once( plugin_dir_path( dirname( __FILE__ ) ) . 'includes/advanced-custom-fields.php' );

		$this->loader = new Controle_Estoque_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Controle_Estoque_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Controle_Estoque_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Controle_Estoque_Admin( $this->get_controle_estoque(), $this->get_version() );
		// Loader example
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

		/**
		 * Simple hook example.
		 *
		 * @see add_plugins_link_to_admin_toolbar()
		 */
		$this->loader->add_action( 'admin_bar_menu', $plugin_admin, 'add_plugins_link_to_admin_toolbar' );

		// 1. customize ACF path
		$this->loader->add_filter( 'acf/settings/path', $plugin_admin, 'my_acf_settings_path' );

		// 2. customize ACF dir
		$this->loader->add_filter( 'acf/settings/dir', $plugin_admin, 'my_acf_settings_dir' );

		// 3. Hide ACF field group menu item
		$this->loader->add_filter( 'acf/settings/show_admin', $plugin_admin, '__return_false' );

		// CPT Produto.
		$this->loader->add_action( 'init', $plugin_admin, 'new_cpt_produto' );

		// CPT Cliente.
		$this->loader->add_action( 'init', $plugin_admin, 'new_cpt_cliente' );

		// CPT Pedido.
		$this->loader->add_action( 'init', $plugin_admin, 'new_cpt_pedido' );

		// Pedido auto-title.
		$this->loader->add_action( 'save_post', $plugin_admin, 'save_title' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Controle_Estoque_Public( $this->get_controle_estoque(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_controle_estoque() {
		return $this->controle_estoque;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Controle_Estoque_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://badah.com.br/controle-estoque
 * @since      1.0.0
 *
 * @package    Controle_Estoque
 * @subpackage Controle_Estoque/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Controle_Estoque
 * @subpackage Controle_Estoque/admin
 * @author     Daniel Hernandes <badah@badah.com.br>
 */
class Controle_Estoque_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $controle_estoque    The ID of this plugin.
	 */
	private $controle_estoque;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $controle_estoque       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $controle_estoque, $version ) {

		$this->controle_estoque = $controle_estoque;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Controle_Estoque_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Controle_Estoque_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->controle_estoque, plugin_dir_url( __FILE__ ) . 'css/controle-estoque-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Controle_Estoque_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Controle_Estoque_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->controle_estoque, plugin_dir_url( __FILE__ ) . 'js/controle-estoque-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Just an simple hook implemenation example
	 *
	 * @link https://github.com/OpenRange/add-plugins-link-to-toolbar
	 * @param [type] $wp_admin_bar [description].
	 */
	public function add_plugins_link_to_admin_toolbar( $wp_admin_bar ) {

		$args = array(
			'id'     => 'plugins',
			'title'  => 'Plugins',
			'href'   => admin_url( 'plugins.php' ),
			'parent' => 'appearance',
		);

		$wp_admin_bar->add_node( $args );
	}


	/**
	 * ACF path
	 *
	 * @param  [type] $path [description].
	 * @return [type]       [description].
	 */
	function my_acf_settings_path( $path ) {

	    // Update path.
	    $path = get_stylesheet_directory() . '/acf/';

	    return $path;
	}

	/**
	 * ACF dir
	 *
	 * @param  [type] $dir [description].
	 * @return [type]      [description].
	 */
	function my_acf_settings_dir( $dir ) {

	    // Update path.
	    $dir = get_stylesheet_directory_uri() . '/acf/';

	    return $dir;
	}

	/**
	 * Creates a new 'produto' custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public static function new_cpt_produto() {

		$cap_type 	= 'post';
		$plural 	= 'Produtos';
		$single 	= 'Produto';
		$cpt_name 	= 'produto';

		$opts['can_export']								= true;
		$opts['capability_type']						= $cap_type;
		$opts['description']							= '';
		$opts['exclude_from_search']					= false;
		$opts['has_archive']							= false;
		$opts['hierarchical']							= false;
		$opts['map_meta_cap']							= true;
		$opts['menu_icon']								= 'dashicons-admin-post';
		$opts['menu_position']							= 25;
		$opts['public']									= true;
		$opts['publicly_querable']						= true;
		$opts['query_var']								= true;
		$opts['register_meta_box_cb']					= '';
		$opts['rewrite']								= false;
		$opts['show_in_admin_bar']						= true;
		$opts['show_in_menu']							= true;
		$opts['show_in_nav_menu']						= true;
		$opts['show_ui']								= true;
		$opts['supports']								= array( 'title', 'editor', 'thumbnail' );
		$opts['taxonomies']								= array();

		$opts['capabilities']['delete_others_posts']	= "delete_others_{$cap_type}s";
		$opts['capabilities']['delete_post']			= "delete_{$cap_type}";
		$opts['capabilities']['delete_posts']			= "delete_{$cap_type}s";
		$opts['capabilities']['delete_private_posts']	= "delete_private_{$cap_type}s";
		$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
		$opts['capabilities']['edit_others_posts']		= "edit_others_{$cap_type}s";
		$opts['capabilities']['edit_post']				= "edit_{$cap_type}";
		$opts['capabilities']['edit_posts']				= "edit_{$cap_type}s";
		$opts['capabilities']['edit_private_posts']		= "edit_private_{$cap_type}s";
		$opts['capabilities']['edit_published_posts']	= "edit_published_{$cap_type}s";
		$opts['capabilities']['publish_posts']			= "publish_{$cap_type}s";
		$opts['capabilities']['read_post']				= "read_{$cap_type}";
		$opts['capabilities']['read_private_posts']		= "read_private_{$cap_type}s";

		$opts['labels']['add_new']						= esc_html__( "Adicionar Novo {$single}", 'controle-estoque' );
		$opts['labels']['add_new_item']					= esc_html__( "Adicionar Novo {$single}", 'controle-estoque' );
		$opts['labels']['all_items']					= esc_html__( "Todos os {$plural}", 'controle-estoque' );
		$opts['labels']['edit_item']					= esc_html__( "Editar {$single}" , 'controle-estoque' );
		$opts['labels']['menu_name']					= esc_html__( $plural, 'controle-estoque' );
		$opts['labels']['name']							= esc_html__( $plural, 'controle-estoque' );
		$opts['labels']['name_admin_bar']				= esc_html__( $single, 'controle-estoque' );
		$opts['labels']['new_item']						= esc_html__( "Novo {$single}", 'controle-estoque' );
		$opts['labels']['not_found']					= esc_html__( "Nenhum {$single} Encontrado", 'controle-estoque' );
		$opts['labels']['not_found_in_trash']			= esc_html__( "Nenhum {$single} Encontrado no Lixo", 'controle-estoque' );
		$opts['labels']['parent_item_colon']			= esc_html__( "{$single} Pai :", 'controle-estoque' );
		$opts['labels']['search_items']					= esc_html__( "Buscar {$plural}", 'controle-estoque' );
		$opts['labels']['singular_name']				= esc_html__( $single, 'controle-estoque' );
		$opts['labels']['view_item']					= esc_html__( "Ver {$single}", 'controle-estoque' );

		$opts['rewrite']['ep_mask']						= EP_PERMALINK;
		$opts['rewrite']['feeds']						= false;
		$opts['rewrite']['pages']						= true;
		$opts['rewrite']['slug']						= esc_html__( strtolower( $plural ), 'controle-estoque' );
		$opts['rewrite']['with_front']					= false;

		$opts = apply_filters( 'controle-estoque-cpt-options', $opts );

		register_post_type( strtolower( $cpt_name ), $opts );
	}

	/**
	 * Creates a new 'cliente' custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public static function new_cpt_cliente() {

		$cap_type 	= 'post';
		$plural 	= 'Clientes';
		$single 	= 'Cliente';
		$cpt_name 	= 'cliente';

		$opts['can_export']								= true;
		$opts['capability_type']						= $cap_type;
		$opts['description']							= '';
		$opts['exclude_from_search']					= false;
		$opts['has_archive']							= false;
		$opts['hierarchical']							= false;
		$opts['map_meta_cap']							= true;
		$opts['menu_icon']								= 'dashicons-businessman';
		$opts['menu_position']							= 25;
		$opts['public']									= true;
		$opts['publicly_querable']						= true;
		$opts['query_var']								= true;
		$opts['register_meta_box_cb']					= '';
		$opts['rewrite']								= false;
		$opts['show_in_admin_bar']						= true;
		$opts['show_in_menu']							= true;
		$opts['show_in_nav_menu']						= true;
		$opts['show_ui']								= true;
		$opts['supports']								= array( 'title', 'editor', 'thumbnail' );
		$opts['taxonomies']								= array();

		$opts['capabilities']['delete_others_posts']	= "delete_others_{$cap_type}s";
		$opts['capabilities']['delete_post']			= "delete_{$cap_type}";
		$opts['capabilities']['delete_posts']			= "delete_{$cap_type}s";
		$opts['capabilities']['delete_private_posts']	= "delete_private_{$cap_type}s";
		$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
		$opts['capabilities']['edit_others_posts']		= "edit_others_{$cap_type}s";
		$opts['capabilities']['edit_post']				= "edit_{$cap_type}";
		$opts['capabilities']['edit_posts']				= "edit_{$cap_type}s";
		$opts['capabilities']['edit_private_posts']		= "edit_private_{$cap_type}s";
		$opts['capabilities']['edit_published_posts']	= "edit_published_{$cap_type}s";
		$opts['capabilities']['publish_posts']			= "publish_{$cap_type}s";
		$opts['capabilities']['read_post']				= "read_{$cap_type}";
		$opts['capabilities']['read_private_posts']		= "read_private_{$cap_type}s";

		$opts['labels']['add_new']						= esc_html__( "Adicionar Novo {$single}", 'controle-estoque' );
		$opts['labels']['add_new_item']					= esc_html__( "Adicionar Novo {$single}", 'controle-estoque' );
		$opts['labels']['all_items']					= esc_html__( "Todos os {$plural}", 'controle-estoque' );
		$opts['labels']['edit_item']					= esc_html__( "Editar {$single}" , 'controle-estoque' );
		$opts['labels']['menu_name']					= esc_html__( $plural, 'controle-estoque' );
		$opts['labels']['name']							= esc_html__( $plural, 'controle-estoque' );
		$opts['labels']['name_admin_bar']				= esc_html__( $single, 'controle-estoque' );
		$opts['labels']['new_item']						= esc_html__( "Novo {$single}", 'controle-estoque' );
		$opts['labels']['not_found']					= esc_html__( "Nenhum {$single} Encontrado", 'controle-estoque' );
		$opts['labels']['not_found_in_trash']			= esc_html__( "Nenhum {$single} Encontrado no Lixo", 'controle-estoque' );
		$opts['labels']['parent_item_colon']			= esc_html__( "{$single} Pai :", 'controle-estoque' );
		$opts['labels']['search_items']					= esc_html__( "Buscar {$plural}", 'controle-estoque' );
		$opts['labels']['singular_name']				= esc_html__( $single, 'controle-estoque' );
		$opts['labels']['view_item']					= esc_html__( "Ver {$single}", 'controle-estoque' );

		$opts['rewrite']['ep_mask']						= EP_PERMALINK;
		$opts['rewrite']['feeds']						= false;
		$opts['rewrite']['pages']						= true;
		$opts['rewrite']['slug']						= esc_html__( strtolower( $plural ), 'controle-estoque' );
		$opts['rewrite']['with_front']					= false;

		$opts = apply_filters( 'controle-estoque-cpt-options', $opts );

		register_post_type( strtolower( $cpt_name ), $opts );
	}

	/**
	 * Creates a new 'pedido' custom post type
	 *
	 * @since 	1.0.0
	 * @access 	public
	 * @uses 	register_post_type()
	 */
	public static function new_cpt_pedido() {

		$cap_type 	= 'post';
		$plural 	= 'Pedidos';
		$single 	= 'Pedido';
		$cpt_name 	= 'pedido';

		$opts['can_export']								= true;
		$opts['capability_type']						= $cap_type;
		$opts['description']							= '';
		$opts['exclude_from_search']					= false;
		$opts['has_archive']							= false;
		$opts['hierarchical']							= false;
		$opts['map_meta_cap']							= true;
		$opts['menu_icon']								= 'dashicons-clipboard';
		$opts['menu_position']							= 25;
		$opts['public']									= true;
		$opts['publicly_querable']						= true;
		$opts['query_var']								= true;
		$opts['register_meta_box_cb']					= '';
		$opts['rewrite']								= false;
		$opts['show_in_admin_bar']						= true;
		$opts['show_in_menu']							= true;
		$opts['show_in_nav_menu']						= true;
		$opts['show_ui']								= true;
		$opts['supports']								= array( 'title', 'editor', 'thumbnail' );
		$opts['taxonomies']								= array();

		$opts['capabilities']['delete_others_posts']	= "delete_others_{$cap_type}s";
		$opts['capabilities']['delete_post']			= "delete_{$cap_type}";
		$opts['capabilities']['delete_posts']			= "delete_{$cap_type}s";
		$opts['capabilities']['delete_private_posts']	= "delete_private_{$cap_type}s";
		$opts['capabilities']['delete_published_posts']	= "delete_published_{$cap_type}s";
		$opts['capabilities']['edit_others_posts']		= "edit_others_{$cap_type}s";
		$opts['capabilities']['edit_post']				= "edit_{$cap_type}";
		$opts['capabilities']['edit_posts']				= "edit_{$cap_type}s";
		$opts['capabilities']['edit_private_posts']		= "edit_private_{$cap_type}s";
		$opts['capabilities']['edit_published_posts']	= "edit_published_{$cap_type}s";
		$opts['capabilities']['publish_posts']			= "publish_{$cap_type}s";
		$opts['capabilities']['read_post']				= "read_{$cap_type}";
		$opts['capabilities']['read_private_posts']		= "read_private_{$cap_type}s";

		$opts['labels']['add_new']						= esc_html__( "Adicionar Novo {$single}", 'controle-estoque' );
		$opts['labels']['add_new_item']					= esc_html__( "Adicionar Novo {$single}", 'controle-estoque' );
		$opts['labels']['all_items']					= esc_html__( "Todos os {$plural}", 'controle-estoque' );
		$opts['labels']['edit_item']					= esc_html__( "Editar {$single}" , 'controle-estoque' );
		$opts['labels']['menu_name']					= esc_html__( $plural, 'controle-estoque' );
		$opts['labels']['name']							= esc_html__( $plural, 'controle-estoque' );
		$opts['labels']['name_admin_bar']				= esc_html__( $single, 'controle-estoque' );
		$opts['labels']['new_item']						= esc_html__( "Novo {$single}", 'controle-estoque' );
		$opts['labels']['not_found']					= esc_html__( "Nenhum {$single} Encontrado", 'controle-estoque' );
		$opts['labels']['not_found_in_trash']			= esc_html__( "Nenhum {$single} Encontrado no Lixo", 'controle-estoque' );
		$opts['labels']['parent_item_colon']			= esc_html__( "{$single} Pai :", 'controle-estoque' );
		$opts['labels']['search_items']					= esc_html__( "Buscar {$plural}", 'controle-estoque' );
		$opts['labels']['singular_name']				= esc_html__( $single, 'controle-estoque' );
		$opts['labels']['view_item']					= esc_html__( "Ver {$single}", 'controle-estoque' );

		$opts['rewrite']['ep_mask']						= EP_PERMALINK;
		$opts['rewrite']['feeds']						= false;
		$opts['rewrite']['pages']						= true;
		$opts['rewrite']['slug']						= esc_html__( strtolower( $plural ), 'controle-estoque' );
		$opts['rewrite']['with_front']					= false;

		$opts = apply_filters( 'controle-estoque-cpt-options', $opts );

		register_post_type( strtolower( $cpt_name ), $opts );
	}

	/**
	 * Replace title by label + post ID
	 *
	 * @param  string $post_id Current post ID.
	 */
	public function save_title( $post_id ) {
		global $wpdb;

		$wpdb->update( $wpdb->posts, array( 'post_title' => "Pedido #{$post_id}" ), array( 'ID' => $post_id ) );
	}
}

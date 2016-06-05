<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://badah.com.br/controle-estoque
 * @since             1.0.0
 * @package           Controle de Estoque
 *
 * @wordpress-plugin
 * Plugin Name:       Controle de Estoque
 * Plugin URI:        http://badah.com.br/controle-estoque/
 * Description:       Sistema de controle de estoque.
 * Version:           1.0.0
 * Author:            Daniel Hernandes
 * Author URI:        http://badah.com.br
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       controle-estoque
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-controle-estoque-activator.php
 */
function activate_controle_estoque() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-controle-estoque-activator.php';
	Controle_Estoque_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-controle-estoque-deactivator.php
 */
function deactivate_controle_estoque() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-controle-estoque-deactivator.php';
	Controle_Estoque_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_controle_estoque' );
register_deactivation_hook( __FILE__, 'deactivate_controle_estoque' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-controle-estoque.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_controle_estoque() {

	$plugin = new Controle_Estoque();
	$plugin->run();

}
run_controle_estoque();

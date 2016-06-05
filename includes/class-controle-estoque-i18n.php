<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://badah.com.br/controle-estoque
 * @since      1.0.0
 *
 * @package    Controle_Estoque
 * @subpackage Controle_Estoque/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Controle_Estoque
 * @subpackage Controle_Estoque/includes
 * @author     Daniel Hernandes <badah@badah.com.br>
 */
class Controle_Estoque_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'controle-estoque',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}

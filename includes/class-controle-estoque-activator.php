<?php

/**
 * Fired during plugin activation
 *
 * @link       http://badah.com.br/controle-estoque
 * @since      1.0.0
 *
 * @package    Controle_Estoque
 * @subpackage Controle_Estoque/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Controle_Estoque
 * @subpackage Controle_Estoque/includes
 * @author     Daniel Hernandes <badah@badah.com.br>
 */
class Controle_Estoque_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		Controle_Estoque_Admin::new_cpt_produto();
		Controle_Estoque_Admin::new_cpt_cliente();
		Controle_Estoque_Admin::new_cpt_pedido();

		flush_rewrite_rules();
	}
}

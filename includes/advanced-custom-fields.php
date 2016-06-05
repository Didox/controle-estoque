<?php
/**
 * Advanced custom field exported code goes in here
 *
 * @package Controle_Estoque
 */

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_clientes',
		'title' => 'Clientes',
		'fields' => array (
			array (
				'key' => 'field_5754572fbf2d8',
				'label' => 'E-mail',
				'name' => 'email',
				'type' => 'email',
				'default_value' => '',
				'placeholder' => 'exemplo@dominio.com.br',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_57545789bf2d9',
				'label' => 'Telefone',
				'name' => 'telefone',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'cliente',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'author',
				7 => 'format',
				8 => 'featured_image',
				9 => 'categories',
				10 => 'tags',
				11 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_pedidos',
		'title' => 'Pedidos',
		'fields' => array (
			array (
				'key' => 'field_57545945d6e1f',
				'label' => 'Cliente',
				'name' => 'id_cliente',
				'type' => 'post_object',
				'post_type' => array (
					0 => 'cliente',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_57545902d6e1e',
				'label' => 'Produto',
				'name' => 'id_produto',
				'type' => 'relationship',
				'return_format' => 'id',
				'post_type' => array (
					0 => 'produto',
				),
				'taxonomy' => array (
					0 => 'all',
				),
				'filters' => array (
					0 => 'search',
				),
				'result_elements' => array (
					0 => 'post_title',
				),
				'max' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'pedido',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'author',
				7 => 'format',
				8 => 'featured_image',
				9 => 'categories',
				10 => 'tags',
				11 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_produtos',
		'title' => 'Produtos',
		'fields' => array (
			array (
				'key' => 'field_5754538de7ecb',
				'label' => 'Descrição',
				'name' => 'descricao',
				'type' => 'wysiwyg',
				'default_value' => '',
				'toolbar' => 'basic',
				'media_upload' => 'no',
			),
			array (
				'key' => 'field_575453d1e7ecc',
				'label' => 'Preço',
				'name' => 'preco',
				'type' => 'text',
				'default_value' => '',
				'placeholder' => '00,00',
				'prepend' => 'R$',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'produto',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
				0 => 'permalink',
				1 => 'the_content',
				2 => 'excerpt',
				3 => 'custom_fields',
				4 => 'discussion',
				5 => 'comments',
				6 => 'author',
				7 => 'format',
				8 => 'featured_image',
				9 => 'categories',
				10 => 'tags',
				11 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}

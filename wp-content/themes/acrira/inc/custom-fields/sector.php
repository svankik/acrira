<?php 

register_field_group ( array (
	'id'     => 'acf_secteur',
	'title'  => 'Secteur',
	'fields' => array (
		array (
			'key'      => 'field_5ad5ad1c610bf',
			'label'    => 'Secteur',
			'name'     => 'secteur',
			'type'     => 'select',
			'required' => 1,
			'choices'  => array (
				1 => 'Cinémas en réseau',
				2 => 'Lycéens & apprentis au cinéma',
				3 => 'Passeurs d\'images',
				4 => 'Outils d\'animation',
			),
			'default_value' => 1,
			'allow_null'    => 0,
			'multiple'      => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'page',
				'order_no' => 0,
				'group_no' => 0,
			),
		),
	),
	'options' => array (
		'position'       => 'side',
		'layout'         => 'default',
		'hide_on_screen' => array (),
	),
	'menu_order' => 0,
));
<?php

register_field_group ( array (
	'id'     => 'acf_informations-cinema-a-portee-de-main',
	'title'  => 'Informations cinéma à portée de main',
	'fields' => array (
		array (
			'key'        => 'field_5a82e2c10c102',
			'label'      => 'Bloc',
			'name'       => 'bloc',
			'type'       => 'repeater',
			'sub_fields' => array (
				array (
					'key'           => 'field_5a82e2ce0c103',
					'label'         => 'Texte',
					'name'          => 'texte',
					'type'          => 'wysiwyg',
					'required'      => 1,
					'column_width'  => '',
					'default_value' => '',
					'toolbar'       => 'full',
					'media_upload'  => 'yes',
				),
				array (
					'key'           => 'field_5a82e2f40c104',
					'label'         => 'Couleur de fond',
					'name'          => 'couleur',
					'type'          => 'color_picker',
					'required'      => 1,
					'column_width'  => '',
					'default_value' => '',
				),
				array (
					'key'           => 'field_5a82e2f401234',
					'label'         => 'Couleur de texte',
					'name'          => 'couleur-texte',
					'type'          => 'color_picker',
					'required'      => 1,
					'column_width'  => '',
					'default_value' => '#fff',
				),
			),
			'row_min'      => '',
			'row_limit'    => '',
			'layout'       => 'table',
			'button_label' => 'Ajouter un bloc',
		),
	),
	'location' => array (
		array (
			array (
				'param'    => 'page_template',
				'operator' => '==',
				'value'    => 'tpl-titre-intro-blocs.php',
				'order_no' => 0,
				'group_no' => 0,
			),
		),
	),
	'options' => array (
		'position'       => 'normal',
		'layout'         => 'default',
		'hide_on_screen' => array (
		),
	),
	'menu_order' => 0,
) );
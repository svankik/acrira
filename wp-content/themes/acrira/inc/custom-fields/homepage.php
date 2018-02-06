<?php

register_field_group ( array (
	'id'     => 'acf_accueil',
	'title'  => 'Accueil',
	'fields' => array (
		array (
			'key'        => 'field_5a6f8ef8d9c16',
			'label'      => 'Colonne',
			'name'       => 'colonne',
			'type'       => 'repeater',
			'required'   => 1,
			'sub_fields' => array (
				array (
					'key'           => 'field_5a6f8f08d9c17',
					'label'         => 'Titre',
					'name'          => 'titre',
					'type'          => 'text',
					'required'      => 1,
					'column_width'  => '',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'formatting'    => 'html',
					'maxlength'     => '',
				),
				array (
					'key'           => 'field_5a6f8f66d9c18',
					'label'         => 'ID menu',
					'name'          => 'id_menu',
					'type'          => 'number',
					'required'      => 1,
					'column_width'  => '',
					'default_value' => '',
					'placeholder'   => '',
					'prepend'       => '',
					'append'        => '',
					'min'           => '',
					'max'           => '',
					'step'          => 1,
				),
				array (
					'key'           => 'field_5a6f8fd8d9c19',
					'label'         => 'Texte',
					'name'          => 'texte',
					'type'          => 'wysiwyg',
					'required'      => 1,
					'column_width'  => '',
					'default_value' => '',
					'toolbar'       => 'full',
					'media_upload'  => 'yes',
				),
			),
			'row_min'      => '',
			'row_limit'    => '',
			'layout'       => 'row',
			'button_label' => 'Ajouter une colonne',
		),
		array (
			'key'        => 'field_5a6f90322ae5c',
			'label'      => 'Slider',
			'name'       => 'slider',
			'type'       => 'repeater',
			'required'   => 1,
			'sub_fields' => array (
				array (
					'key'          => 'field_5a6f90412ae5d',
					'label'        => 'Image',
					'name'         => 'image',
					'type'         => 'image',
					'required'     => 1,
					'column_width' => '',
					'save_format'  => 'object',
					'preview_size' => 'thumbnail',
					'library'      => 'all',
				),
			),
			'row_min'      => '',
			'row_limit'    => '',
			'layout'       => 'table',
			'button_label' => 'Ajouter une image',
		),
		array (
			'key'           => 'field_5a6f96be4b2cf',
			'label'         => 'Nombre de colonnes',
			'name'          => 'nombre_de_colonnes',
			'type'          => 'number',
			'required'      => 1,
			'default_value' => '',
			'placeholder'   => '',
			'prepend'       => '',
			'append'        => '',
			'min'           => 1,
			'max'           => '',
			'step'          => 1,
		),
	),
	'location' => array (
		array (
			array (
				'param'    => 'page',
				'operator' => '==',
				'value'    => '7',
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
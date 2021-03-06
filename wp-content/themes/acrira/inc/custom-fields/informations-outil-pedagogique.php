<?php 

register_field_group ( array (
	'id'     => 'acf_informations-outil-pedagogique',
	'title'  => 'Informations outil pédagogique',
	'fields' => array (
		array (
			'key'           => 'field_59a14ed02ec8f',
			'label'         => 'Sous-titre',
			'name'          => 'sous-titre',
			'type'          => 'text',
			'default_value' => '',
			'placeholder'   => '',
			'prepend'       => '',
			'append'        => '',
			'formatting'    => 'none',
			'maxlength'     => '',
		),
		array (
			'key'           => 'field_59a14efb2ec90',
			'label'         => 'Public',
			'name'          => 'public',
			'type'          => 'text',
			'required'      => 1,
			'default_value' => '',
			'placeholder'   => '',
			'prepend'       => '',
			'append'        => '',
			'formatting'    => 'none',
			'maxlength'     => '',
		),
		array (
			'key'           => 'field_59a14f112ec91',
			'label'         => 'Durée',
			'name'          => 'duree',
			'type'          => 'text',
			'required'      => 1,
			'default_value' => '',
			'placeholder'   => '',
			'prepend'       => '',
			'append'        => '',
			'formatting'    => 'none',
			'maxlength'     => '',
		),
		array (
			'key'           => 'field_59a14f2a2ec92',
			'label'         => 'Objectifs',
			'name'          => 'objectifs',
			'type'          => 'textarea',
			'required'      => 1,
			'default_value' => '',
			'placeholder'   => '',
			'maxlength'     => '',
			'rows'          => '',
			'formatting'    => 'br',
		),
		array (
			'key'           => 'field_59a14f872ec93',
			'label'         => 'Matériel',
			'name'          => 'materiel',
			'type'          => 'textarea',
			'required'      => 1,
			'default_value' => '',
			'placeholder'   => '',
			'maxlength'     => '',
			'rows'          => '',
			'formatting'    => 'br',
		),
	),
	'location' => array (
		array (
			array (
				'param'    => 'post_type',
				'operator' => '==',
				'value'    => 'educationaltool',
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
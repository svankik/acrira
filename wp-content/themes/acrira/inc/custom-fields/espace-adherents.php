<?php
register_field_group(array (
	'id' => 'acf_espace-adherents',
	'title' => 'Espace adhérents',
	'fields' => array (
		array (
			'key' => 'field_5bd5940820499',
			'label' => 'Parlons cinéma',
			'name' => 'parlons_cinema',
			'type' => 'wysiwyg',
			'toolbar' => 'full',
			'media_upload' => 'yes',
			'required' => 1,
			'default_value' => '',
		),
		array (
			'key' => 'field_5bd5944a2049a',
			'label' => 'Documents ressources',
			'name' => 'documents_ressources',
			'type' => 'wysiwyg',
			'toolbar' => 'full',
			'media_upload' => 'yes',
			'required' => 1,
			'default_value' => '',
		),
		array (
			'key' => 'field_5bd594572049b',
			'label' => 'Rapport annuel d’activités',
			'name' => 'rapport_annuel_activites',
			'type' => 'wysiwyg',
			'toolbar' => 'full',
			'media_upload' => 'yes',
			'required' => 1,
			'default_value' => '',
		),
		array (
			'key' => 'field_5bd594642049c',
			'label' => 'Comptes-rendus',
			'name' => 'comptes_rendus',
			'type' => 'wysiwyg',
			'toolbar' => 'full',
			'media_upload' => 'yes',
			'required' => 1,
			'default_value' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page',
				'operator' => '==',
				'value' => '735',
				'order_no' => 0,
				'group_no' => 0,
			),
		),
	),
	'options' => array (
		'position' => 'acf_after_title',
		'layout' => 'no_box',
		'hide_on_screen' => array (
		),
	),
	'menu_order' => 0,
));
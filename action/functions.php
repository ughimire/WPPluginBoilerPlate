<?php


function pp( $array = array(), $is_die = false ) {

	echo '<pre>';

	print_r( $array );
	echo '</pre>';

	if ( $is_die ) {

		die();
	}

}

function plugin_fields() {


	$fields = array(

		'plugin_name'      => array(

			'type' => 'text',

			'required' => true,

			'placeholder' => 'Plugin Name',

			'custom_style' => '',

		),
		'plugin_uri'       => array(

			'type' => 'url',

			'required' => true,

			'placeholder' => 'Plugin URI',

			'custom_style' => '',

		),
		'description'      => array(

			'type' => 'textarea',

			'required' => true,

			'placeholder' => 'Description',

			'custom_style' => 'height:131px;',

		),
		'version'          => array(

			'type' => 'text',

			'required' => true,

			'placeholder' => 'Plugin Name',

			'custom_style' => '',

		),
		'author'           => array(

			'type' => 'text',

			'required' => true,

			'placeholder' => 'Author',

			'custom_style' => '',

		),
		'author_uri'       => array(

			'type' => 'url',

			'required' => true,

			'placeholder' => 'Author URI',

			'custom_style' => '',

		),
		'require_at_least' => array(

			'type' => 'text',

			'required' => true,

			'placeholder' => 'Requires at least',

			'custom_style' => '',

		),
		'tested_up_to'     => array(

			'type' => 'text',

			'required' => true,

			'placeholder' => 'Tested up to',

			'custom_style' => '',

		),
		'text_domain'      => array(

			'type' => 'text',

			'required' => true,

			'placeholder' => 'Text Domain',

			'custom_style' => '',

		),
		'domain_path'      => array(

			'type' => 'text',

			'required' => true,

			'placeholder' => 'Domain Path',

			'custom_style' => '',

		),
		'class_prefix'    => array(

			'type' => 'text',

			'required' => true,

			'placeholder' => 'Class Prefix',

			'custom_style' => '',

		),


	);

	return $fields;
}


function render_plugin_files( $post ) {

	$plugin_name = $post['plugin_name'];

	$plugin_file_name = join( '-', explode( ' ', trim( strtolower( $plugin_name ) ) ) );

	$plugin_directory_name = $plugin_file_name;

	$plugin_file_name .= '.php';

	echo $plugin_file_name;

}
<?php

final class Structure {

	private static $file_prefix = "";

	private static $plugin_name = "";

	public static function set_file_prefix( $file_prefix ) {

		self::$file_prefix = strtolower( $file_prefix );

	}

	public static function set_plugin_name( $plugin_name ) {

		self::$plugin_name = strtolower( $plugin_name );

	}

	public static function get_plugin_name() {

		return self::$plugin_name;
	}

	public static function get_file_prefix() {

		return self::$file_prefix;
	}

	public static function get_structure() {

		if ( self::$plugin_name == "" || self::$file_prefix == "" ) {

			throw  new Exception( "file prefix or plugin name empty" );
		}

		$structure = array(

			'directory' => array(

				'admin' => array(

					'directory' => array(

						'meta-boxes' => array(

							'directory' => array(

								'view' => array(

									'directory' => array(),

									'files' => array()
								)
							),

							'files' => array()
						),
						'settings'   => array(

							'directory' => array(

								'views' => array()


							),
							'files'     => ''
						)
					),

					'files' => array(),
				),
				'interfaces',

				'libraries',

				'shortcodes',

				'theme-support',

				'vendor',

				'walker',

				'widgets',


			),
			'files'     => array(

				'{plugin_file_name}.php',

				'uninstall.php'
			)


		);

	}


}
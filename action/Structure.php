<?php

final class Structure {


	public static function get_structure() {
		$structure = array(

			'admin'    => array(

				'meta-boxes' => array(

					'view' => array( 'hurrey.txt' )

				),
				'settings'   => array(

					'views' => array( 'lol' => array( 'check.txt' ) )

				)

			),
			'includes' => array(

				'abstracts' => array(

					'abstract-{FILE_NAME_PREFIX}-session.php'
				),
				'class-{FILE_NAME_PREFIX}-query.php',
				'class-{FILE_NAME_PREFIX}-session-handler.php',
				'class-{FILE_NAME_PREFIX}-core-functions.php'
			),

			'interfaces' => array(),

			'libraries' => array(),

			'shortcodes' => array(),

			'theme-support' => array(),

			'vendor' => array(),

			'walker' => array(),

			'widgets' => array(),

			'{PLUGIN_FILE_NAME}.php',

			'uninstall.php'

		);

		return $structure;
	}


}
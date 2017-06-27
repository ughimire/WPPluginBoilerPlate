<?php

final class Structure {


	public static function get_structure() {
		$structure = array(

			'assets' => array(

				'css' => array(),

				'font' => array(),

				'images' => array(

					'icons' => array()
				),

				'js' => array(

					'admin' => array(),

					'frontend' => array()
				),

			),

			'i18n' => array(

				'languages' => array()
			),

			'includes'  => array(

				'abstracts' => array(

					'abstract-{FILE_NAME_PREFIX}-log-handler.php',

					'abstract-{FILE_NAME_PREFIX}-object-query.php',

					'abstract-{FILE_NAME_PREFIX}-session.php',

					'abstract-{FILE_NAME_PREFIX}-widget.php'
				),
				'admin'     => array(

					'meta-boxes' => array(

						'views' => array()
					),
					'settings'   => array(

						'views' => array()
					),
					'views'      => array(),

					'class-{FILE_NAME_PREFIX}-admin.php',

					'class-{FILE_NAME_PREFIX}-admin-assets.php',

					'class-{FILE_NAME_PREFIX}-admin-attributes.php',

					'class-{FILE_NAME_PREFIX}-admin-customize.php',

					'class-{FILE_NAME_PREFIX}-admin-dashboard.php',

					'class-{FILE_NAME_PREFIX}-admin-help.php',

					'class-{FILE_NAME_PREFIX}-admin-log-table-list.php',

					'class-{FILE_NAME_PREFIX}-admin-menus.php',

					'class-{FILE_NAME_PREFIX}-admin-meta-boxes.php',

					'class-{FILE_NAME_PREFIX}-admin-notices.php',

					'class-{FILE_NAME_PREFIX}-admin-permalink-settings.php',

					'class-{FILE_NAME_PREFIX}-admin-pointers.php',

					'class-{FILE_NAME_PREFIX}-admin-post-types.php',

					'class-{FILE_NAME_PREFIX}-admin-profile.php',

					'class-{FILE_NAME_PREFIX}-admin-settings.php',

					'class-{FILE_NAME_PREFIX}-admin-taxonomies.php',

					'{FILE_NAME_PREFIX}-admin-functions.php',

					'{FILE_NAME_PREFIX}-meta-box-functions.php',


				),

				'api' => array(),

				'cli' => array(),

				'emails' => array(

					'class-{FILE_NAME_PREFIX}-email.php',

				),


				'export' => array(),

				'import' => array(),

				'interfaces' => array(

					'class-{FILE_NAME_PREFIX}-log-handler-interface.php',

					'class-{FILE_NAME_PREFIX}-logger-interface.php',


				),

				'libraries' => array(

					'wp-async-request.php',

					'wp-background-process.php',

				),

				'log-handlers' => array(

					'class-{FILE_NAME_PREFIX}-log-handler-db.php',

					'class-{FILE_NAME_PREFIX}-log-handler-email.php',

					'class-{FILE_NAME_PREFIX}-log-handler-file.php',

				),

				'shortcodes' => array(

					'class-{FILE_NAME_PREFIX}-shortcodes.php',

				),

				'theme-support' => array(

					'class-{FILE_NAME_PREFIX}-twenty-seventeen.php',

				),

				'vendor' => array(

					'abstract-wp-rest-controller.php',

					'class-requests-ipv6.php',

					'wp-rest-functions.php',

				),

				'walker' => array(),

				'widgets' => array(

					'class-{FILE_NAME_PREFIX}-widget-test.php',

				),
				'class-{FILE_NAME_PREFIX}-ajax.php',

				'class-{FILE_NAME_PREFIX}-api.php',

				'class-{FILE_NAME_PREFIX}-auth.php',

				'class-{FILE_NAME_PREFIX}-autoloader.php',

				'class-{FILE_NAME_PREFIX}-background-emailer.php',

				'class-{FILE_NAME_PREFIX}-background-updater.php',

				'class-{FILE_NAME_PREFIX}-cache-helper.php',

				'class-{FILE_NAME_PREFIX}-cli.php',

				'class-{FILE_NAME_PREFIX}-datetime.php',

				'class-{FILE_NAME_PREFIX}-deprecated-action-hooks.php',

				'class-{FILE_NAME_PREFIX}-deprecated-filter-hooks.php',

				'class-{FILE_NAME_PREFIX}-download-handler.php',

				'class-{FILE_NAME_PREFIX}-emails.php',

				'class-{FILE_NAME_PREFIX}-frontend-scripts.php',

				'class-{FILE_NAME_PREFIX}-install.php',

				'class-{FILE_NAME_PREFIX}-logger.php',

				'class-{FILE_NAME_PREFIX}-post-types.php',

				'class-{FILE_NAME_PREFIX}-query.php',

				'class-{FILE_NAME_PREFIX}-register-wp-admin-settings.php',

				'class-{FILE_NAME_PREFIX}-session-handler.php',

				'class-{FILE_NAME_PREFIX}-shortcodes.php',

				'class-{FILE_NAME_PREFIX}-template-loader.php',

				'class-{FILE_NAME_PREFIX}-validation.php',

				'{FILE_NAME_PREFIX}-core-functions.php',

				'{FILE_NAME_PREFIX}-template-hooks.php',

				'{FILE_NAME_PREFIX}-user-functions.php',

				'{FILE_NAME_PREFIX}-widget-functions.php'
			),


			'{PLUGIN_FILE_NAME}.php',

			'uninstall.php',

			'readme.txt'
		,
			'templates' => array(),
		);

		return $structure;
	}


}
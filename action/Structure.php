<?php

final class Structure
{


    public static function get_structure()
    {
        $structure = array(

            'admin' => array(

                'meta-boxes' => array(

                    'view' => array()

                ),
                'settings' => array(

                    'views' => array('lol' => array())

                )

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
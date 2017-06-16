<?php

final class Structure
{


    public static function get_structure()
    {

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
                        'settings' => array(

                            'directory' => array(

                                'views' => array()


                            ),
                            'files' => ''
                        )
                    ),

                    'files' => array(),
                ),
                'interfaces' => array(),

                'libraries' => array(),

                'shortcodes' => array(),

                'theme-support' => array(),

                'vendor' => array(),

                'walker' => array(),

                'widgets' => array(),


            ),
            'files' => array(

                '{PLUGIN_FILE_NAME}.php',

                'uninstall.php'
            )


        );

        return $structure;
    }


}
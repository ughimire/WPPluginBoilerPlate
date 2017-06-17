<?php
require_once "Define.php";

function pp($array = array(), $is_die = false)
{

    echo '<pre>';

    print_r($array);
    echo '</pre>';

    if ($is_die) {

        die();
    }

}

function plugin_fields()
{


    $fields = array(

        'plugin_name' => array(

            'type' => 'text',

            'required' => true,

            'placeholder' => 'Plugin Name',

            'custom_style' => '',

        ),
        'plugin_uri' => array(

            'type' => 'url',

            'required' => true,

            'placeholder' => 'Plugin URI',

            'custom_style' => '',

        ),
        'description' => array(

            'type' => 'textarea',

            'required' => true,

            'placeholder' => 'Description',

            'custom_style' => 'height:131px;',

        ),
        'version' => array(

            'type' => 'text',

            'required' => true,

            'placeholder' => 'Plugin Name',

            'custom_style' => '',

        ),
        'author' => array(

            'type' => 'text',

            'required' => true,

            'placeholder' => 'Author',

            'custom_style' => '',

        ),
        'author_uri' => array(

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
        'tested_up_to' => array(

            'type' => 'text',

            'required' => true,

            'placeholder' => 'Tested up to',

            'custom_style' => '',

        ),
        'text_domain' => array(

            'type' => 'text',

            'required' => true,

            'placeholder' => 'Text Domain',

            'custom_style' => '',

        ),
        'domain_path' => array(

            'type' => 'text',

            'required' => true,

            'placeholder' => 'Domain Path',

            'custom_style' => '',

        ),
        'class_prefix' => array(

            'type' => 'text',

            'required' => true,

            'placeholder' => 'Class Prefix',

            'custom_style' => '',

        ),


    );

    return $fields;
}


function render_plugin_files($post)
{

    $plugin_name = $post['plugin_name'];

    $plugin_file_name_constant = join('-', explode(' ', trim(strtolower($plugin_name))));

    Define::constant('PLUGIN_FILE_NAME', $plugin_file_name_constant);

    $exploded_name = explode(' ', trim(strtolower($plugin_name)));

    $plugin_name_constant = join(' ', array_map('ucwords', $exploded_name));

    Define::constant('PLUGIN_NAME', $plugin_name_constant);

    Define::constant('PLUGIN_URI', $post['plugin_uri']);

    Define::constant('DESCRIPTION', $post['description']);

    Define::constant('VERSION', $post['version']);

    Define::constant('AUTHOR', $post['author']);

    Define::constant('AUTHOR_URI', $post['author_uri']);

    Define::constant('REQUIRES_AT_LEAST', $post['require_at_least']);

    Define::constant('TESTED_UP_TO', $post['tested_up_to']);

    Define::constant('TEXT_DOMAIN', PLUGIN_FILE_NAME);

    Define::constant('PLUGIN_MAIN_CLASS_NAME', implode(array_map('ucwords', $exploded_name), '_'));


    if (count($exploded_name) > 1) {

        $plugin_class_prefix = join('', array_map(function ($value) {
            return substr($value, 0, 1);
        }, $exploded_name));


    } else {

        $plugin_class_prefix = substr($exploded_name[0], 0, 3);
    }
    Define::constant('PLUGIN_CLASS_PREFIX', strtoupper($plugin_class_prefix));

    Define::constant('FILE_NAME_PREFIX', strtolower(PLUGIN_CLASS_PREFIX));

    Define::constant('HOOK_PREFIX', str_replace('-', '_', PLUGIN_FILE_NAME));

    render_core_recursively(Structure::get_structure());


    $plugin_directory_name = $plugin_file_name_constant;

    $plugin_file_name = $plugin_file_name_constant . '.php';

    echo $plugin_file_name;

}

function render_core_recursively($structures, $directory_path = "", $tree_index = 0)
{

    $index = 0;

    foreach ($structures as $structure_key => $structure_value) {


        if (gettype($structures[$structure_key]) == "array") {


            if (count($structures[$structure_key]) > 0) {

                $tree_index++;
                

                $directory_path .= $structure_key . DIRECTORY_SEPARATOR;


            }


            echo $structure_key . '<br/>';

            render_core_recursively($structure_value, $directory_path, $tree_index);


        } elseif (gettype($structures[$structure_key]) == "string") {


        }

//        echo $directory_path . '<br/>';
    }


}
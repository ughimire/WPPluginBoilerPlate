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

    Define::constant('PLUGIN_DIRECTORY_PATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'generated-plugins' . DIRECTORY_SEPARATOR);

    Define::constant('TEMPLATES_DIRECTORY', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR);


    Define::constant('PLUGIN_URI', $post['plugin_uri']);

    Define::constant('DESCRIPTION', $post['description']);

    Define::constant('VERSION', $post['version']);

    Define::constant('AUTHOR', $post['author']);

    Define::constant('AUTHOR_URI', $post['author_uri']);

    Define::constant('REQUIRES_AT_LEAST', $post['require_at_least']);

    Define::constant('TESTED_UP_TO', $post['tested_up_to']);

    Define::constant('TEXT_DOMAIN', PLUGIN_FILE_NAME);

    Define::constant('PLUGIN_HOOK_CLASS_NAME', str_replace('-', '_', PLUGIN_FILE_NAME));

    Define::constant('PLUGIN_MAIN_CLASS_NAME', implode(array_map('ucwords', $exploded_name), '_'));

    Define::constant('PLUGIN_MAIN_CLASS_NAME_UPPERCASE', strtoupper(PLUGIN_MAIN_CLASS_NAME));


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


    create_file(PLUGIN_FILE_NAME);
    render_core_recursively(Structure::get_structure());

    $plugin_directory_name = $plugin_file_name_constant;

    $plugin_file_name = $plugin_file_name_constant . '.php';


}

function create_file($path, $is_dir = true)
{


    if ($is_dir) {

        $path = PLUGIN_DIRECTORY_PATH . trim($path, DIRECTORY_SEPARATOR);
        mkdir($path);
        return;
    }


    create_file_from_template(trim(trim($path, DIRECTORY_SEPARATOR), DIRECTORY_SEPARATOR));

}

function render_core_recursively($structures, $directory_path = DIRECTORY_SEPARATOR)
{


    foreach ($structures as $structure_key => $structure_value) {


        if (gettype($structures[$structure_key]) == "array") {


            $directory_path .= $structure_key . DIRECTORY_SEPARATOR;


            create_file(PLUGIN_FILE_NAME . $directory_path);


            render_core_recursively($structure_value, $directory_path);


        } elseif (gettype($structures[$structure_key]) == "string") {

            $directory_path .= $structures[$structure_key] . DIRECTORY_SEPARATOR;

            create_file($directory_path, false);

        }
        $exploded_path = (explode(DIRECTORY_SEPARATOR, $directory_path));

        array_pop($exploded_path);

        array_pop($exploded_path);


        $directory_path = join(DIRECTORY_SEPARATOR, $exploded_path) . DIRECTORY_SEPARATOR;


    }


}

function create_file_from_template($file_path)
{
    $file_name_only_array = explode('.', $file_path);

    array_pop($file_name_only_array);

    $file_name_only = join('', $file_name_only_array);

    $tmpl = TEMPLATES_DIRECTORY . $file_name_only . '.tmpl';

    $constant_list_with_value = Define::get_defined_constant_with_value();

    if (file_exists($tmpl)) {


        $new_file_path = $file_path;

        $file_content = file_get_contents($tmpl);

        foreach ($constant_list_with_value as $list_key => $list_value) {


            $new_file_path = str_replace('{' . $list_key . '}', $list_value, $new_file_path);

            $file_content = str_replace('{' . $list_key . '}', $list_value, $file_content);
        }
        $final_file_path = PLUGIN_DIRECTORY_PATH . PLUGIN_FILE_NAME . DIRECTORY_SEPARATOR . $new_file_path;

        $fp = fopen($final_file_path, 'w');

        fwrite($fp, $file_content);

        fclose($fp);
    }

}
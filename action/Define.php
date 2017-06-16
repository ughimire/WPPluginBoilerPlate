<?php

class Define
{
    private static $constant_list = array();
    private static $constant_list_with_value = array();

    public static function constant($key, $value)
    {
        if (!defined($key)) {

            define($key, $value);

            array_push(self::$constant_list, $key);

            self::$constant_list_with_value[$key] = $value;
        }
    }

    public static function get_defined_constant()
    {

        return self::$constant_list;
    }

    public static function get_defined_constant_with_value()
    {

        return self::$constant_list_with_value;
    }


}

?>
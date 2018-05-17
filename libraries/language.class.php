<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 29.11.2017
 * Time: 13:14
 */

class Language {

    protected static $data;

    public static function load($lang_code) {

        $lang_file_path = ROOT.DS.'languages'.DS.strtolower($lang_code).'.php';

        if ( file_exists($lang_file_path) ) {

            self::$data = include($lang_file_path);

        } else {
            throw new Exception('Language file not found: ' . $lang_file_path);
        }
    }

    public static function get( $key, $default_value = '' ) {

        return isset( self::$data[strtolower($key)] ) ? self::$data[strtolower($key)] : $default_value;
    }
}
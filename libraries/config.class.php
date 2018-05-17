<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 28.11.2017
 * Time: 14:33
 */

class Config {

    protected static $settings = array();

    public static function get($key) {
        return isset( self::$settings[$key] ) ? self::$settings[$key] : null;
    }

    public static function set($key, $value) {
        self::$settings[$key] = $value;
    }
}
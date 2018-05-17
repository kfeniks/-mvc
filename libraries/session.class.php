<?php
/**
 * Created by PhpStorm.
 * User: Alexey
 * Date: 30.11.2017
 * Time: 12:09
 */

class Session {


    protected static $flash_message;

    public static function setFlash($message) {

        self::$flash_message = $message;

    }

    public static function hasFlash() {

        return !is_null(self::$flash_message);

    }

    public static function flash() {

        echo self::$flash_message;

        self::$flash_message = null;

    }

    public static function init() {
        @session_start();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if(isset($_SESSION[$key]))
            return $_SESSION[$key];
    }

    public static function delete($key) {
        if ( isset($_SESSION[$key]) ) {
            unset($_SESSION[$key]);
        }
    }

    public static function destroy() {
        // unset($_SESSION);
        session_destroy();
    }

}
<?php
/**
 * User: Elio
 * Date: 17.11.12
 *
 */

class Registry {
    /**@var PDO $db коннект для данных*/
    public static $db;
    /** @var bool $display */
    public static $debug=false;

    public static $vars = array();

    public static function set($key, $var) {
        if (isset(self::$vars[$key])) throw new Exception('Unable to set var `'.$key.'`. Already set.');
        self::$vars[$key] = $var;
        return true;
    }

    public static function set_f($key, $var){
        self::$vars[$key] = $var;
        return true;
    }

    public static function get($key) {
        if (!isset(self::$vars[$key])) return null;
        return self::$vars[$key];
    }

    public function remove($key) {
        unset(self::$vars[$key]);
    }

    static public function dump(){
        return self::$vars;
    }

    static public function generatePlaceholders(array $array){
        return implode(',', array_fill(0, count($array), '?'));
    }
}
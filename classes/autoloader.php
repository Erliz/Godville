<?php
/* Include needing class.
 *
 * check all directors in 'application' and include class.php
 *
 */
Class Autoloader
{
    public static $instance;

    /* initialize the autoloader class */
    public static function init()
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /* put the custom functions in the autoload register when the class is initialized */
    function __construct()
    {
        spl_autoload_register(array($this, 'load'));
    }

    /**
     * load controller
     *
     * @param $class string class name
     *
     * @throws Exception
     * @return bool
     */
    private function load($class)
    {
        $path = 'classes';
        $filename = strtolower($class) . '.php';
        if (is_file($file = $path . "/" . $filename)) {
            include_once ($file);
            return true;
        }
        throw new Exception('Not find class:' . $class . ', on path:' . $path);
    }
}

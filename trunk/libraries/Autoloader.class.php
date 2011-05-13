<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * @version 1.0.0
 */

/**
 * Autoloader Class
 *
 * @author Delespierre
 * @version 1.0.0
 * @subpackage Autoloader
 */
class Autoloader {
    
    /**
     * Autolaoder paths
     * @var array
     */
    protected static $_paths;
    
    /**
     * Start auloading handle.
     * Will return the spl_autoload_register status.
     * @param array $paths = array()
     * @return boolean
     */
    public static function start ($paths = array()) {
        $default = array(
            'controller' => dirname(dirname(__FILE__)) . '/application/controller',
            'model'      => dirname(dirname(__FILE__)) . '/application/model',
            'library'    => dirname(dirname(__FILE__)) . '/libraries',
            'helper'     => dirname(dirname(__FILE__)) . '/libraries/helpers',
        );
        
        self::$_paths = $default + $paths;
        if (set_include_path(implode(PATH_SEPARATOR, self::$_paths) . get_include_path()) === false)
            throw new RuntimeException("Could not register the new include path");
            
        return spl_autoload_register(array('Autoloader', 'load'));
    }
    
    /**
     * Add a path to the autoloader.
     * Note: you must start the autoloader when calling this
     * method or the changes since the last 'start' invocation
     * will not be effective.
     * @param string $path
     * @param string $name = null
     * @throws RuntimeException
     * @return boolean
     */
    public static function add ($path, $name = null) {
        if (file_exists($path)) {
            if (!$name) {
                $l = explode('/', $path);
                $name = array_pop($l);
            }
            self::$_paths[$name] = $path;
            return true;
        }
        else {
            throw new RuntimeException("Path $path not found");
        }
    }
    
    /**
     * Load a class
     * @param string $class
     * @return boolean
     */
    public static function load ($class) {
        return @include_once "$class.class.php";
    }
}
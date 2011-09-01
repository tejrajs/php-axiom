<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date$
 * $Id$
 */

/**
 * Autoloader Class
 *
 * @author Delespierre
 * @version $Rev$
 * @subpackage Autoloader
 */
class Autoloader {
    
    /**
     * Autoloader contfig
     * @var array
     */
    protected static $_config = array();
    
    protected static $_al_registered;
    
    /**
     * Set the Autoload configuration
     * @param array $config = array()
     * @return void
     */
    public static function setConfig ($config = array()) {
        $default = array(
            'paths' => array(
                APPLICATION_PATH . '/controller',
                APPLICATION_PATH . '/model',
                LIBRARY_PATH,
                LIBRARY_PATH . '/exceptions',
                LIBRARY_PATH . '/helpers',
                LIBRARY_PATH . '/loggers',
                LIBRARY_PATH . '/feeds',
				LIBRARY_PATH . '/uploader',
            ),
            'extensions' => '.class.php',
        );
        
        self::$_config = array_merge_recursive($default, $config);
    }
    
	/**
     * Add a path to the autoloader and return it.
     *
     * Note: you must start the autoloader when calling this
     * method or the changes since the last 'start' invocation
     * will not be effective.
     *
     * @param string $path
     * @param string $name = null
     * @throws RuntimeException
     * @return boolean
     */
    public static function add ($path) {
        if (!file_exists($path))
            throw new RuntimeException("Path $path not found", 2044);
            
        return self::$_config['paths'][] = $path;
    }
    
    /**
     * Start auloading handle.
     * Will return the spl_autoload_register status.
     * @param array $paths = array()
     * @return boolean
     */
    public static function start ($paths = array()) {
        $include_path = array_unique(array_merge(self::$_config['paths'], explode(PATH_SEPARATOR, get_include_path())));
        
        if (set_include_path(implode(PATH_SEPARATOR, $include_path)) === false)
            throw new RuntimeException("Could not register the new include path", 2045);
            
        spl_autoload_extensions(self::$_config['extensions']);
        if (!self::$_al_registered) {
            self::$_al_registered = true;
            return spl_autoload_register();
        }
        return true;
    }
    
    public static function load ($class, $ext = '.class.php') {
        return @include $class . $ext;
    }
}
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
 * Module Manager
 *
 * @author Delespierre
 * @version $Rev$
 * @subpackage ModuleManager
 */
class ModuleManager {
    
    /**
     * Module list cache
     * @var array
     */
    protected static $_module_list = array();
    
    /**
     * Internal configuration
     * @var array
     */
    protected static $_config;
    
    /**
     * Set configuration
     * @param arrat $config = array()
     * @return void
     */
    public static function setConfig ($config = array()) {
        $default = array(
            'module_path' => APPLICATION_PATH . '/module',
        );
        self::$_config = array_merge($default, $config);
        
        if (empty(self::$_module_list)) {
            foreach (self::getAvailableModules() as $fileinfo) {
                if ($fileinfo->isDir())
                    self::$_module_list[] = $fileinfo->getFilename();
            }
        }
    }
    
    /**
     * Get available modules
     * @return DirectoryFilterIterator
     */
    public static function getAvailableModules () {
        $dir = new DirectoryIterator(self::$_config['module_path']);
        return new DirectoryFilterIterator($dir);
    }
    
    /**
     * Get module meta-inf.
     * @param string $module
     * @return array
     */
    public static function getInformations ($module) {
        if (!file_exists($path = self::$_config['module_path'] . "/$module/module.ini"))
            return false;
        return parse_ini_file($path, false);
    }
    
    /**
     * Load the given module
     * @param strign $module
     * @return boolean
     */
    public static function load ($module) {
        return @include_once self::$_config['module_path'] . "/$module/config/bootstrap.php";
    }
    
    /**
     * Check if the module exists
     * @param string $module
     * @return boolena
     */
    public static function exists ($module) {
        return (bool)array_keys(self::$_module_list, $module, true);
    }
    
    /**
     * Check if updates are available for the given module
     * @param string $module
     * @return boolean
     */
    public static function checkUpdates ($module) {
        // TODO ModuleManager::checkUpdates
    }
}
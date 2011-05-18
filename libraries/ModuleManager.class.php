<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: ModuleManager.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Module Manager
 *
 * @author Delespierre
 * @version $Rev: 162 $
 * @subpackage ModuleManager
 */
class ModuleManager {
    
    /**
     * Module list cache
     * @var array
     */
    protected static $_module_list;
    
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
        
        if (empty(self::$_module_list))
            self::$_module_list = iterator_to_array(self::getAvailableModules(), false);
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
        return @include_once self::$_config['module_path'] . "/$module/config/bootstrap.ini";
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
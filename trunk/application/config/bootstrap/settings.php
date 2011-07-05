<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: settings.php 22988 2011-05-18 15:00:36Z delespierre $
 */

date_default_timezone_set("Europe/Paris");

error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
ini_set('log_errors', 1);
ini_set('ignore_repeated_errors', 1);
ini_set('error_prepend_string', 'AXIOM [' . AXIOM_VERSION . '] >> ');
ini_set('error_log', APPLICATION_PATH . '/ressources/temp/logs/error.log');

define('MESSAGE_WARNING', 'warnings');
define('MESSAGE_ALERT', 'alerts');
define('XML_HEADER', '<?xml version="1.0" encoding="UTF-8" ?>');

/**
 * User functions
 */
if (!function_exists("lcfirst")) {
    function lcfirst ($string) {
        $string{0} = strtolower($string{0});
        return $string;
    }
}

if (!function_exists("array_keys_prefix")) {
    function array_keys_prefix ($array, $prefix) {
        if (empty($array))
            return array();
        
        $keys = array_keys($array);
        foreach ($keys as $key => $value)
            $keys[$key] = $prefix . $value;
            
        return array_combine($keys, $array);
    }
}
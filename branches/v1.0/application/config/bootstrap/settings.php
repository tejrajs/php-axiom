<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category config
 * @package bootstrap
 * $Date$
 * $Id$
 */

date_default_timezone_set("Europe/Paris");

error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
/*
ini_set('log_errors', 1);
ini_set('ignore_repeated_errors', 1);
ini_set('error_prepend_string', 'AXIOM [' . AXIOM_VERSION . '] >> ');
ini_set('error_log', APPLICATION_PATH . '/ressources/temp/logs/error.log');

define('MESSAGE_WARNING', 'warnings');
define('MESSAGE_ALERT', 'alerts');
define('XML_HEADER', '<?xml version="1.0" encoding="UTF-8" ?>');
*/

/**
 * User functions
 */

/**
 * lcfirst doesn't exists in PHP 5.1,
 * Lowercase first character.
 * @param string
 * @return string
 */
if (!function_exists("lcfirst")) {
    function lcfirst ($string) {
        $string{0} = strtolower($string{0});
        return $string;
    }
}

/**
 * Prefix every key of the array with
 * the given prefix.
 * @param array $array
 * @param string $prefix
 * @return array
 */
if (!function_exists("array_keys_prefix")) {
    function array_keys_prefix (array $array, $prefix) {
        if (empty($array))
            return array();
        
        $keys = array_keys($array);
        foreach ($keys as $key => $value)
            $keys[$key] = $prefix . $value;
            
        return array_combine($keys, $array);
    }
}

/**
 * Filter all null, false, empty string or --
 * values of the given array
 * @param array $array
 * @return array
 */
if (!function_exists("array_safe_filter")) {
    function array_safe_filter (array $array) {
        foreach ($array as $key => $value) {
            if ($value === null || $value === false || $value === "" || $value === "--")
                unset($array[$key]);
        }
        return $array;
    }
}
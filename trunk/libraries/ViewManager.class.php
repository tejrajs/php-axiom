<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: ViewManager.class.php 22988 2011-05-18 15:00:36Z delespierre $
 */

/**
 * View Manager Class
 *
 * @author Delespierre
 * @version $Rev: 22988 $
 * @subpackage ViewManager
 */
class ViewManager {
    
    /**
     * Internal configuration
     * @internal
     * @var array
     */
    protected static $_config = array();
    
    /**
     * Layout vars
     * @var array
     */
    protected static $_layout_vars = array();
    
    /**
     * Response object
     * @var Response
     */
    protected static $_response;
    
    /**
     * Load and display the controller / action associated view
     * @param string $controller
     * @param string $action
     * @return void
     */
    public static function load ($controller, $action) {
        self::setContentType($format = ($f = self::$_response->getOutputFormat()) ? $f : self::$_config['default_output_format']);

        $section = lcfirst(str_replace('Controller', '', $controller));
        $view = ($v = self::$_response->getResponseView()) ? $v : $action;
        
        if (strpos(strtolower($section), 'admin') !== false) $section = 'admin';
        
        if (file_exists($__filename = realpath(self::$_config['view_path']) . "/{$section}/{$view}.{$format}.php")) { }
        elseif (file_exists($__filename = realpath(self::$_config['default_view_path']) . "/{$section}/{$view}.{$format}.php")) { }
        else return;
        
        try {
            ob_start();
            
            extract(self::$_layout_vars);
            extract(self::$_response->getResponseVars());
            foreach (self::$_response->getMessages() as $level => $message) {
                ${$level} = $message;
            }
            include $__filename;
            
            ${self::$_config['layout_content_var']} = ob_get_contents();
            ob_end_clean();
        }
        catch (Exception $e) {
            ob_end_clean();
            var_dump($e);
            Router::load('ErrorController', 'http500');
            return;
        }
        
        include dirname(dirname(__FILE__)) . "/application/view/layouts/" . self::$_config['layout_file'] . ".{$format}.php";
    }
    
    /**
     * Set the header for the given format
     * @param string $output_format = null
     * @throws RuntimeException
     * @return void
     */
    public static function setContentType ($output_format = null) {
        if (!$output_format)
            $output_format = self::$_config['default_output_format'];

        switch (strtolower($output_format)) {
            case 'html': header('Content-Type: text/html; charset=UTF-8'); break;
            case 'json': header('Content-Type: application/json; charset=UTF-8'); break;
            case 'csv' : header('Content-Type: application/csv; charset=UTF-8'); break;
            case 'xml' : header('Content-Type: text/xml; charset=UTF-8'); break;
            case 'text': header('Content-Type: text/plain; charset=UTF-8'); break;
            default: throw new RuntimeException("Format $output_format not recognized");
        }
    }
    
    /**
     * Set the configuration
     * @param array $configuration = array()
     * @return void
     */
    public static function setConfig ($configuration = array()) {
        $default = array(
            'default_output_format' => 'html',
            'default_view_path' => dirname(dirname(__FILE__)) . "/application/view",
            'view_path' => dirname(dirname(__FILE__)) . "/application/view/",
            'layout_file' => 'default',
            'layout_content_var' => 'page_content',
        );
        self::$_config = array_merge($default, $configuration);
    }
    
    /**
     * Set layout file
     * @param string $file
     * @return void
     */
    public static function setLayoutFile ($file) {
        self::$_config['layout_file'] = $file;
    }
    
    /**
     * Add layout vars at once
     * @param array $collection
     * @return void
     */
    public static function addLayoutVars ($collection) {
        if (!empty($collection))
            self::$_layout_vars = array_merge(self::$_layout_vars, (array)$collection);
    }
    
    /**
     * Get layout vars
     * @return array
     */
    public static function getLayoutVars () {
        return self::$_layout_vars;
    }
    
    /**
     * Get the given layout var
     * @param string $key
     * @return mixed
     */
    public static function getLayoutVar ($key) {
        return isset(self::$_layout_vars[$key]) ? self::$_layout_vars[$key] : null;
    }
    
    /**
     * Set the given layout var
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public static function setLayoutVar ($key, $value) {
        self::$_layout_vars[$key] = $value;
    }
    
    public static function setViewPath ($path) {
        if (file_exists($path)) {
            self::$_config['view_path'] = $path;
        }
        else
            throw new MissingFileException($path);
    }
    
    /**
     * Set the internal response object
     * @param Response $response
     * @return void
     */
    public static function setResponse (Response &$response) {
        self::$_response = $response;
    }
    
    /**
     * Perform a redirection
     * Trigger the exit of the script
     * @param string $url
     * @return void
     */
    public static function redirect ($url) {
        header("Location: $url");
        /*
         * TODO add redirection message here
        self::setLayoutVar('url', $url);
        self::load("ErrorController", "redirection");
         */
        exit();
    }
}

/**
 * (non PHP-doc)
 * @see ViewManager::redirect
 */
function redirect ($url) {
    ViewManager::redirect($url);
}
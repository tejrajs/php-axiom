<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date: 2011-05-20 16:32:08 +0200 (ven., 20 mai 2011) $
 * $Id: Router.class.php 23055 2011-05-20 14:32:08Z delespierre $
 */

/**
 * Router Class
 *
 * @author Delespierre
 * @version $Rev: 23055 $
 * @subpackage Router
 */
class Router {
    
    /**
     * Internal configuration
     * @internal
     * @var array
     */
    protected static $_config;
    
    /**
     * Routes
     * @var array
     */
    protected static $_routes;

    /**
     * Request object
     * @var Request
     */
    protected static $_request;
    
    /**
     * Response object
     * @var Response
     */
    protected static $_response;
    
    /**
     * Set configuration
     * @param array $config = array
     * @return void
     */
    public static function setConfig ($config = array()) {
        $default = array(
            'controller_path' => dirname(dirname(__FILE__)) . '/application/controller',
        );
        self::$_config = array_merge($config, $default);
    }
    
    /**
     * Add a route
     * @param string $route
     * @param array $config
     * @throws InvalidArgumentException
     * @return void
     */
    public static function addRoute ($route, $config) {
        if (!isset(self::$_routes))
            self::$_routes = array();
        
        if (!empty($config)) {
            if (empty($config[1])) $config[1] = "index";
            self::$_routes[$route] = $config;
        }
        else
            throw new InvalidArgumentException("Config parameter cannot be empty");
    }
    
    /**
     * Run router
     * @param string $route = null
     * @param string $action = null
     * @throws LogicException
     * @return void
     */
    public static function run ($route = null, $action = null) {
        if (!isset(self::$_request))
            self::$_request = new Request;
            
        if (!isset(self::$_response))
            self::$_response = new Response;
            
        if (empty($route) && !empty(self::$_routes) && ($url = self::$_request->url)) {
            foreach (self::$_routes as $pattern => $config) {
                if ($pattern !== 'default' && preg_match($pattern, $url, $matches)) {
                    self::$_request->addAll($matches);
                    list($route, $action) = array_merge($config, array('index'));
                    break;
                }
            }
        }
        
        if (empty($route)) {
            if (!isset(self::$_routes['default']))
                throw new LogicException("No default route defined");
                
            if ($url = self::$_request->url) {
                if (preg_match('`^((?<lang>[[:alnum:]]{2})/)?(?<route>[[:alnum:]]{3,})?/?(?<action>[[:alnum:]]{3,})?/?$`',$url,$matches)) {
                    $route = !empty($matches['route']) ? $matches['route'] : self::$_routes['default'][0];
                    $action = !empty($matches['action']) ? $matches['action'] : self::$_routes['default'][1];
                }
                else
                    return self::load('ErrorController', 'http404');
            }
            else
                list($route, $action) = array_merge(self::$_routes['default'], array('index'));
        }
        
        if (ModuleManager::exists($route))
            ModuleManager::load($route);
        
        if (!empty($matches['lang']) && $matches['lang'] != Lang::getLocale())
            ViewManager::setLayoutVar('lang', Lang::setLocale($matches['lang']));
            
        if (!Autoloader::load($controller = ucfirst("{$route}Controller")))
            list($controller, $action) = array('ErrorController', 'http404');
            
        self::load($controller, $action);
    }
    
    /**
     * Load the given controller and the given action
     * @param string $controller
     * @param string $action = null
     * @throws BadMethodCallException
     * @return void
     */
    public static function load ($controller, $action = null) {
        if (empty($action))
            $action = "index";
            
        try {
            call_user_func_array(array($controller, '_init'), array(&self::$_request, &self::$_response));
            if (!is_callable(array($controller, $action)))
                throw new BadMethodCallException("No such action for $controller");
            
            self::$_response->addAll(call_user_func(array($controller, $action)));
        }
        catch (BadMethodCallException $e) {
            return self::run("error", "http404");
        }
        catch (LoginException $e) {
            return self::run("error", "http403");
        }
        catch (Exception $e) {
            return self::run("error", "http500");
        }
        
        ViewManager::setResponse(self::$_response);
        try {
            ViewManager::load($controller, $action);
        }
        catch (Exception $e) {
            header("HTTP/1.0 500 Internal Server Error", true);
            die();
        }
    }
}
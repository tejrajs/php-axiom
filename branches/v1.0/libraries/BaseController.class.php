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
 * Base Controller Abstract Class
 *
 * @abstract
 * @author Delespierre
 * @version $Rev$
 * @subpackage BaseController
 */
abstract class BaseController {
    
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
     * Init the controller
     * @param Request $request
     * @param Response $response
     * @return void
     */
    public static function _init (Request &$request, Response &$response) {
        self::setRequest($request);
        self::setResponse($response);
    }
    
    /**
     * Set the request object
     * @param Request $request
     * @return void
     */
    final protected static function setRequest (Request &$request) {
        self::$_request = $request;
    }
    
    /**
     * Set the resoibse object
     * @param Response $response
     * @return void
     */
    final protected static function setResponse (Response &$response) {
        self::$_response = $response;
    }
    
    /**
     * Forward the action to another controller
     * @param string $controller
     * @param string $action = "index"
     * @throws RuntimeException
     * @throws ForwardException
     * @return void
     */
    final protected static function forward ($controller, $action = "index") {
        if (strpos($controller, 'Controller') === false)
            throw new RuntimeException("$controller is not a valid controller name");
        
        if ($controller == 'BaseController')
            throw new RuntimeException("Redirection is impossible on $controller");
        
        if (!Autoloader::load($controller))
            throw new BadMethodCallException("Cannot find $controller");
            
        throw new ForwardException($controller, $action);
    }
    
    /**
     * Triggers a redirection
     * @param string $url
     * @param int $method = RedirectException::REDIRECT_REFRESH
     * @throws InvalidArgumentException
     * @throws RedirectException
     * @return void
     */
    final protected static function redirect ($url, $method = RedirectException::REDIRECT_REFRESH) {
        if (!$url)
            throw new InvalidArgumentException("First parameter is expected to be a valid url");
            
        throw new RedirectException($url, $method);
    }
    
    /**
     * Index method
     * @abstract
     */
    abstract public static function index ();
}
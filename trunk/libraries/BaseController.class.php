<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: BaseController.class.php 22988 2011-05-18 15:00:36Z delespierre $
 */

/**
 * Base Controller Abstract Class
 *
 * @abstract
 * @author Delespierre
 * @version $Rev: 22988 $
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
    final public static function setRequest (Request &$request) {
        self::$_request = $request;
    }
    
    /**
     * Set the resoibse object
     * @param Response $response
     * @return void
     */
    final public static function setResponse (Response &$response) {
        self::$_response = $response;
    }
    
    /**
     * Index method
     * @abstract
     */
    abstract public static function index ();
}
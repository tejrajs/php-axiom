<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category Action
 * @package Controller
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: ErrorController.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Error Controller
 *
 * @author Delespierre
 * @version $Rev: 162 $
 * @subpackage ErrorController
 */
class ErrorController extends BaseController {
    
    public static function index () { }
    
    public static function http400 () { header("HTTP/1.0 400 Bad Request"); }
    public static function http401 () { header("HTTP/1.0 401 Unauthorized"); }
    public static function http403 () { header("HTTP/1.0 403 Forbidden"); }
    public static function http404 () { header("HTTP/1.0 404 Not Found"); }
    
    public static function http500 () { header("HTTP/1.0 500 Internal Server Error"); }
    public static function http501 () { header("HTTP/1.0 501 Not Implemented"); }
    public static function http503 () { header("HTTP/1.0 503 Service Unavailable"); }
}
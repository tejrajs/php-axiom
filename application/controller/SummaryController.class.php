<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category Action
 * @package Controller
 * @version 1.0.0
 */

/**
 * Summary Controller
 *
 * Note: This controller manages the landing page.
 *
 * @author Delespierre
 * @version 1.0.0
 * @subpackage SummaryController
 */
class SummaryController extends BaseController {

     public static function index () {
     }
     
     public static function test () {
         $param = self::$_request->param;
         return compact('param');
     }
}
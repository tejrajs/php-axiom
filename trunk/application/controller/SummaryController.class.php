<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category Action
 * @package Controller
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: SummaryController.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Summary Controller
 *
 * Note: This controller manages the landing page.
 *
 * @author Delespierre
 * @version $Rev: 162 $
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
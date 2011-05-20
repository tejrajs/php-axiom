<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category Action
 * @package Controller
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: SummaryController.class.php 22988 2011-05-18 15:00:36Z delespierre $
 */

/**
 * Summary Controller
 *
 * Note: This controller manages the landing page.
 *
 * @author Delespierre
 * @version $Rev: 22988 $
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
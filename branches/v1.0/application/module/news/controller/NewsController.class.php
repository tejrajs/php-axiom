<?php
/**
 * Axiom: a lightweight PHP framework
 *
 * @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
 * @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
 */

class NewsController extends BaseController {
    
    public static function index () {
        self::$_response->setResponseView('news');
        return self::news();
    }
    
    public static function news () {
        if ($id = self::$_request->id) {
            $news = new News($id);
        }
        return compact('news');
    }
    
    public static function addComment () {
        
        return self::index();
    }
    
    public static function getComments () {
        
    }
    
    public static function feed () {
        
    }
}
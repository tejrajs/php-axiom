<?php
/**
 * Axiom: a lightweight PHP framework
 *
 * @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
 * @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
 */

class AdminNewsController extends SecuredController {
    
    public static function index () {
        self::$_response->setResponseView('news');
        return self::news();
    }
    
    public static function news () {
        $news = News::getNews();
        return compact('news');
    }
}
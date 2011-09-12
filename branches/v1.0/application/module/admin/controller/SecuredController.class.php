<?php
/**
 * Axiom: a lightweight PHP framework
 *
 * @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
 * @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
 */

abstract class SecuredController extends BaseController {
    
    protected static  $_session;
    
    public static function _init (Request &$request, Response &$response) {
        parent::_init($request, $response);
        if (!Session::id())
            Session::start();
        
        self::$_session = new Session();
        if (!self::$_session->adm_user)
            throw new LoginException("Unconnected user", 11001);
        
        ViewManager::setLayoutVar("user", self::$_session->adm_user);
        ViewManager::setLayoutFile("admin");
    }
}
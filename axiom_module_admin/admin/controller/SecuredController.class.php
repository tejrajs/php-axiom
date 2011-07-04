<?php

abstract class SecuredController extends BaseController {
    
    protected static  $_session;
    
    public static function _init () {
        parent::_init($request, $response);
        
        self::$_session = new Session();
        
        if (!isset($_SESSION['user']) || !$_SESSION['user'])
            throw new LoginException("Unconnected user");
        
        ViewManager::setLayoutVar("user", $_SESSION['user']);
        ViewManager::setLayoutFile("admin");
    }
}
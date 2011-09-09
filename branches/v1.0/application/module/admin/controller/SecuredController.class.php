<?php

abstract class SecuredController extends BaseController {
    
    protected static  $_session;
    
    public static function _init (Request &$request, Response &$response) {
        parent::_init($request, $response);
        
        Log::debug("Starting Session");
        if (!Session::id())
            Session::start();
        
        self::$_session = new Session();
        
        Log::debug("Checking user presence");
        if (!self::$_session->user)
            throw new LoginException("Unconnected user", 11001);
        
        ViewManager::setLayoutVar("user", self::$_session->user);
        ViewManager::setLayoutFile("admin");
        
        Log::debug("Secured controller intitialized successfuly");
    }
}
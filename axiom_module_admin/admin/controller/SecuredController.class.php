<?php

abstract class SecuredController extends BaseController {
    
    public static function _init () {
        parent::_init($request, $response);
        
        if (!isset($_SESSION['user']) || !$_SESSION['user'])
            throw new LoginException("Unconnected user");
        
        ViewManager::setLayoutVar("user", $_SESSION['user']);
        ViewManager::setLayoutFile("admin");
    }
}
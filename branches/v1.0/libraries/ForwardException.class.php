<?php

class ForwardException extends LogicException {
    
    protected $_controller;
    
    protected $_action;
    
    public function __construct ($controller, $action = 'index') {
        parent::__construct("Forward action to $controller::$action");
        $this->_controller = $controller;
        $this->_action = $action;
    }
    
    public function getController () {
        return $this->_controller;
    }
    
    public function getAction () {
        return $this->_action;
    }
}
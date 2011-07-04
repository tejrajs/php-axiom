<?php

class Session {
    
    protected $_session_parameters;
    
    public function __construct () {
        if (!session_id())
            self::start();
        
        $this->_session_parameters = & $_SESSION;
    }
    
    public function __get ($key) {
        return isset($this->_session_parameters[$key]) ? $this->_session_parameters[$key] : null;
    }
    
    public function __set ($key, $value) {
        $this->_session_parameters[$key] = $value;
    }
    
    public static function start () {
        return session_start();
    }
    
    public static function destroy () {
        return session_destroy();
    }
    
    public static function id ($id = false) {
        return $id !== false ? session_id($id) : session_id();
    }
    
    public static function name ($name = false) {
        return $name !== false ? session_name($name) : session_name();
    }
}
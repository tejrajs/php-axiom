<?php

class Log {
    
    protected static $_config;
    
    protected static $_meta_inf;
    
    /**
     * First logger in the chain
     * @var Logger
     */
    protected static $_first;
    
    /**
     * Last logger in the chain
     * @var Logger
     */
    protected static $_last;
    
    protected static $_message_history = array();
    
    public static function setConfig (array $config = array()) {
        $defaults = array(
            'ignore_repeated_messages' => false,
            'log_errors' => true,
        );
        
        self::$_config = $config + $defaults;
        if (self::$_config['log_errors'])
            self::registerAsErrorHandler();
    }
    
    public static function message ($msg, $priority) {
        if (!isset(self::$_first))
            return;
        
        if (self::$_config['ignore_repeated_messages']) {
            if (array_search($msg, self::$_message_history) !== false)
                return;
        }
        
        self::$_first->message(self::$_message_history[] = $msg, $priority);
    }
    
    public static function error ($msg) {
        self::message($msg, Logger::ERR);
    }
    
    public static function notice ($msg) {
        self::message($msg, Logger::NOTICE);
    }
    
    public static function warning ($msg) {
        self::message($msg, Logger::WARNING);
    }
    
    public static function debug ($msg) {
        self::message($msg, Logger::DEBUG);
    }
    
    public static function addLogger (Logger $logger) {
        if (!isset(self::$_first))
            self::$_first = self::$_last = $logger;
        else
            self::$_last->setNext(self::$_last = $logger);
    }
    
    public static function registerAsErrorHandler ($error_types = -1) {
        set_error_handler(array(__CLASS__, 'handleError'));
    }
    
    public static function handleError ($errno, $errstr, $errfile, $errline) {
        $error = "$errstr in $errfile on line $errline";
        switch ($errno) {
            case E_USER_WARNING:
            case E_WARNING:
                self::warning($error);
                break;
                
            case E_USER_NOTICE:
            case E_NOTICE:
                self::notice($error);
                break;
            
            default:
            case E_RECOVERABLE_ERROR:
                $error = "\{$errno\} " . $error;
            case E_USER_ERROR:
                self::error($error);
                break;
        }
        
        // Allow axiom Router to catch this on most time
        if ($errno == E_RECOVERABLE_ERROR)
            throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
    }
    
    public static function getHistory () {
        return self::$_message_history;
    }
}
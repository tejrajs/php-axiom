<?php

class TextLogger extends Logger {
    
    protected $_file;
    
    /**
     * Log lines format.
     *
     * Note: 3 placeholder may be placed in
     * this string. In order:
     * 1- date (ISO 2822)
     * 2- error severity ("Error", "Warning"...)
     * 3- error message
     * @var string
     */
    public $format;
    
    public function __construct ($filename, $mask, $format = false) {
        parent::__construct($mask);
        try {
            $this->_file = new SplFileObject($filename, 'w');
        }
        catch (RuntimeException $e) {
            return;
        }
        if ($format)
            $this->format = $format;
    }
    
    public function writeMessage ($msg, $severity) {
        $format = isset($this->format) ? $this->format : "[%s] %s: %s\n";
        $this->_file->fwrite(sprintf($format, date('r'), $severity, $msg));
    }
}
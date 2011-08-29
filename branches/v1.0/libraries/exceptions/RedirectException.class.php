<?php

class RedirectException extends Exception {
    
    const REDIRECT_PERMANENT = 1;
    const REDIRECT_REFRESH = 2;
    
    /**
     * Expressed in seconds
     * @var integer
     */
    const REFRESH_DELAY = 5;
    
    protected $_url;
    protected $_method;
    
    public function __construct ($url, $method = self::REDIRECT_PERMANENT) {
        parent::__construct("Redirect to $url");
        $this->_url = $url;
        $this->_method = $method;
    }
    
    public function getUrl () {
        return $this->_url;
    }
    
    public function getMethod () {
        return $this->_method;
    }
    
    public function getHeaderString () {
        switch ($this->_method) {
            case self::REDIRECT_REFRESH:   return "Refresh: " . self::REFRESH_DELAY . ";url={$this->_url}"; break;
            case self::REDIRECT_PERMANENT: return "Location: {$this->_url}"; break;
        }
        return false;
    }
    
    public function __toString () {
        return ($header = $this->getHeaderString()) ? $header : "";
    }
}
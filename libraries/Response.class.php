<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * @version 1.0.0
 */

/**
 * Response Class
 *
 * @author Delespierre
 * @version 1.0.0
 * @subpackage Response
 */
class Response {
    
    /**
     * Response vars
     * @var array
     */
    protected $_response_vars;
    
    /**
     * View messages
     * @var array
     */
    protected $_messages;
    
    /**
     * Response view to be used
     * @var string
     */
    protected $_response_view;
    
    /**
     * Response output format
     * @var string
     */
    protected $_output_format;
    
    /**
     * Default constructor
     */
    public function __construct () {
        $this->_response_vars = array();
        $this->_messages = array();
    }
    
    /**
     * Getter for response vars
     * @param string $key
     * @return mixed
     */
    public function __get ($key) {
        return isset($this->_response_vars[$key]) ? $this->_response_vars[$key] : null;
    }
    
    /**
     * Setter for response vars
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set ($key, $value) {
        $this->_response_vars[$key] = $value;
    }
    
    /**
     * Get response vars
     * @return array
     */
    public function getResponseVars () {
        return $this->_response_vars;
    }
    
    /**
     * Add responses vars at once
     * @param array $collection
     * @return void
     */
    public function addAll ($collection = array(), $method = "merge") {
        if (empty($collection))
            return;
            
        switch (strtolower($method)) {
            default:
            case "merge":
                $this->_response_vars = array_merge($this->_response_vars, (array)$collection);
                break;
                
            case "add":
                $this->_response_vars += (array)$collection;
        }
    }
    
    /**
     * Add a message
     * @param string $message
     * @param integer $level = MESSAGE_WARNING
     * @return void
     */
    public function addMessage ($message, $level = MESSAGE_WARNING) {
        if (!isset($this->_messages[$level]))
            $this->_messages[$level] = array();
        
        $this->_messages[$level][] = $message;
    }
    
    /**
     * Get messages
     * @return array
     */
    public function getMessages () {
        return $this->_messages;
    }
    
    /**
     * Get response view
     * @return string
     */
    public function getResponseView () {
        return isset($this->_response_view) ? $this->_response_view : null;
    }
    
    /**
     * Set response view
     * @param string $view_name
     * @return void
     */
    public function setResponseView ($view_name) {
        $this->_response_view = $view_name;
    }
    
    /**
     * Get output format
     * @return string
     */
    public function getOutputFormat () {
        return isset($this->_output_format) ? $this->_output_format : null;
    }
    
    /**
     * Set output format
     * @param string $format
     * @return void
     */
    public function setOutputFormat ($format) {
        $this->_output_format = $format;
    }
    
    /**
     * Set output transformer
     * FIXME Not implemented
     * @param callback $callback
     * @throws InvalidArgumentException
     * @return void
     */
    public function setOutputTransformer ($callback) {
        if (is_callable($callback))
            $this->_output_transformer = $callback;
        else
            throw new InvalidArgumentException("Passed callback is not callable");
    }
}
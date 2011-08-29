<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date: 2011-07-27 18:44:09 +0200 (mer., 27 juil. 2011) $
 * $Id: MissingFileException.class.php 46 2011-07-27 16:44:09Z TchernoBen@gmail.com $
 */

/**
 * Foward Exception
 *
 * @author Delespierre
 * @version $Rev: 46 $
 * @subpackage ForwardException
 */
class ForwardException extends LogicException {
    
    /**
     * Controller to forward to
     * @internal
     * @var string
     */
    protected $_controller;
    
    /**
     * Action to forward to
     * @internal
     * @var string
     */
    protected $_action;
    
    /**
     * Default constructor
     * @param string $controller
     * @param string $action
     */
    public function __construct ($controller, $action = 'index') {
        parent::__construct("Forward action to $controller::$action");
        $this->_controller = $controller;
        $this->_action = $action;
    }
    
    /**
     * Get the destination controller
     * @return string
     */
    public function getController () {
        return $this->_controller;
    }
    
    /**
     * Get the destination action
     * @return string
     */
    public function getAction () {
        return $this->_action;
    }
}
<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package helper
 * $Date$
 * $Id$
 */

/**
 * Column Helper Class
 *
 * @author Delespierre
 * @version $Rev$
 * @subpackage ColHelper
 */
class ColHelper extends BaseHelper {
    
    /**
     * Default constructor
     */
    public function __construct () {
        parent::__construct('col');
    }
    
    /**
     * (non-PHPdoc)
     * @see BaseHelper::setValue()
     */
    public function setValue ($value) {
        throw new BadMethodCallException("Col tag cannot have value", 3007);
    }
    
    /**
     * (non-PHPdoc)
     * @see BaseHelper::appendChild()
     */
    public function appendChild ($node) {
        throw new BadMethodCallException("Col tag cannot have children", 3008);
    }
    
    /**
     * (non-PHPdoc)
     * @see BaseHelper::prependChild()
     */
    public function prependChild ($node) {
        throw new BadMethodCallException("Col tag cannot have children", 3008);
    }
    
    /**
     * Constructor static alias
     * @return ColHelper
     */
    public static function export () {
        return new self;
    }
}
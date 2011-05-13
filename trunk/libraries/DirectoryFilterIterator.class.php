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
 * Directory Filter Iterator
 *
 * This class is defined as a DirectoryIterator
 * wrapper where each valid elements are folder
 * (excluding .. and .)
 *
 * @author Delespierre
 * @version 1.0.0
 * @subpackage DirectoryFilterIterator
 */
class DirectoryFilterIterator extends FilterIterator {
    
    /**
     * Default constructor
     * @param DirectoryIterator $iterator
     */
    public function __construct(DirectoryIterator $iterator) {
        parent::__construct($iterator);
    }
    
    /**
     * (non-PHPdoc)
     * @see FilterIterator::accept()
     */
    public function accept () {
        return $this->current()->isDir() && !$this->current()->isDot();
    }
    
}
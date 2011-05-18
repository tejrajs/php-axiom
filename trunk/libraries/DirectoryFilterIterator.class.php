<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: DirectoryFilterIterator.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Directory Filter Iterator
 *
 * This class is defined as a DirectoryIterator
 * wrapper where each valid elements are folder
 * (excluding .. and .)
 *
 * @author Delespierre
 * @version $Rev: 162 $
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
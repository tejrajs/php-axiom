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
 * Column Group Helper Class
 *
 * @author Delespierre
 * @version $Rev$
 * @subpackage ColGroupHelper
 */
class ColGroupHelper extends BaseHelper {
    
    /**
     * Default constructor
     */
    public function __construct () {
        parent::__construct('colgroup');
    }
    
    /**
     * Add a column to the colgroup and
     * return it
     * @return ColHelper
     */
    public function addCol () {
        return $this->appendChild(ColHelper::export());
    }
    
    /**
     * Constructor static alias
     * @return ColGroupHelper
     */
    public static function export () {
        return new self ();
    }
}
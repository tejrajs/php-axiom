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
 * Helper Interface
 *
 * @author Delespierre
 * @version $Rev$
 * @subpackage Helper
 */
interface Helper {

    /**
     * Set any number of attributes at once
     * @param array $attributes
     * @return Helper
     */
    public function setAttributes ($attributes);

    /**
     * Set the node's value
     * @param mixed $value
     * @return Helper
     */
    public function setValue ($value);

    /**
     * Get the node's value
     * @return mixed
     */
    public function getValue ();

    /**
     * Appends a node to current node and return it
     * @param mixed $node
     * @return mixed
     */
    public function appendChild ($node);
    
    /**
     * Prepend a node to the current node and return it
     * @param mixed  $node
     * @return mixed
     */
    public function prependCHild ($node);

    /**
     * __toString overloading
     * Get a string represenation of
     * current node and its children
     * @return string
     */
    public function __toString ();
}
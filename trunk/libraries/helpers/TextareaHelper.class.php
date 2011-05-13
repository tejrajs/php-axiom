<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package helper
 * @version 1.0.0
 */

/**
 * Texarea Helper Class
 *
 * @author Delespierre
 * @version 1.0.0
 * @subpackage TextareaHelper
 */
class TextareaHelper extends BaseHelper {

    /**
     * Default constructor
     * @param string $name
     * @param mixed $value
     */
    public function __construct ($name, $value = "") {
        parent::__construct('textarea', array('name' => $name), $value);
        
        if (empty($value))
            $this->_children[] = null;
    }

    /**
     * Constructor static alias
     * @param string $name
     * @param mixed $value
     * @return TextareaHelper
     */
    public static function export ($name, $value = "") {
        return new self ($name, $value);
    }
}
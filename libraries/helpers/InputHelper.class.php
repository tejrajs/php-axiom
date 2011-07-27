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
 * Input Helper Class
 *
 * @author Delespierre
 * @version $Rev$
 * @subpackage InputHelper
 */
class InputHelper extends BaseHelper {

    /**
     * Default constructor
     * @param string $name
     * @param string $type = "text"
     * @param scalar $value = ""
     */
    public function __construct ($name, $type = "text", $value = "") {
        parent::__construct('input', array('name' => $name, 'value' => $value, 'type' => $type));
    }

    /**
     * (non-PHPdoc)
     * @see BaseHelper::getValue()
     */
    public function getValue () {
        return $this->_attributes['value'];
    }

    /**
     * (non-PHPdoc)
     * @see BaseHelper::setValue()
     */
    public function setValue ($value) {
        $this->_attributes['value'] = $value;
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see BaseHelper::appendChild()
     */
    public function appendChild ($node) {
        throw new LogicException("Cannot append nodes in input tags");
    }
    
	/**
     * Constructor static alias
     * @param string $name
     * @param string $type = "text"
     * @param scalar $value = ""
     * @return InputHelper
     */
    public static function export ($name, $type = "text", $value = "") {
        return new self($name, $type, $value);
    }
}
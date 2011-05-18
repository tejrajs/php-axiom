<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package helper
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: OptionHelper.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Option Helper CLass
 *
 * @author Delespierre
 * @version $Rev: 162 $
 * @subpackage OptionHelper
 */
class OptionHelper extends BaseHelper {

    /**
     * Default constructor
     * @param string $name
     * @param scalar $value
     */
    public function __construct ($name, $value = "") {
        parent::__construct('option', array('value' => $value), $name);
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
     * @see BaseHelper::getValue()
     */
    public function getValue () {
        return $this->_attributes['value'];
    }

    /**
     * Constructor static alias
     * @param strign $name
     * @param scalar $value = ""
     * @return OptionHelper
     */
    public static function export ($name, $value = "") {
        return new self ($name, $value);
    }
}
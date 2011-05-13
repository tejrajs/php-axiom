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
 * Label Helper Class
 *
 * @author Delespierre
 * @version 1.0.0
 * @subpackage LabelHelper
 */
class LabelHelper extends BaseHelper {

    /**
     * Default constructor
     * @param scalar $value
     * @param string $for = ""
     */
    public function __construct ($value, $for = "") {
        parent::__construct('label', array(), $value);
        if ($for)
            $this->setFor($for);
    }

    /**
     * Constructor static alias
     * @param scalar $value
     * @param string $for = ""
     * @return LabelHelper
     */
    public static function export ($value, $for = "") {
        return new self ($value, $for);
    }
}
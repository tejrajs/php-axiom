<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package helper
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: LabelHelper.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Label Helper Class
 *
 * @author Delespierre
 * @version $Rev: 162 $
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
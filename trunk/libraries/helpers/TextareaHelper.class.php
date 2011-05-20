<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package helper
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: TextareaHelper.class.php 22988 2011-05-18 15:00:36Z delespierre $
 */

/**
 * Texarea Helper Class
 *
 * @author Delespierre
 * @version $Rev: 22988 $
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
<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package helper
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: FieldsetHelper.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Fieldset Helper Class
 *
 * @author Delespierre
 * @version $Rev: 162 $
 * @subpackage FieldsetHelper
 */
class FieldsetHelper extends BaseHelper {

    /**
     * Default constructor
     * @param string $legend = ""
     */
    public function __construct ($legend = "") {
        parent::__construct('fieldset');
        if ($legend)
            $this->appendChild("<legend>$legend</legend>");
    }

    /**
     * Add a form-line to the fieldset.
     * @see FormLineHelper::export
     * @param string $name
     * @param string $display_name = null
     * @param string $type = "text"
     * @param scalar $value = ""
     * @return FieldsetHelper
     */
    public function addLine ($name, $display_name = null, $type = "text", $value = "", $class = "") {
        $this->appendChild(FormLineHelper::export($name, $display_name, $type, $value, $class));
        return $this;
    }
    
    /**
     * Fill the fieldset inner inputs automatically
     * with a descriptor.
     * The $desc parameter can be either an array
     * or a Model instance.
     * @param mixed $desc
     * @return FieldsetHelper
     */
    public function autoFill ($desc) {
        foreach ($this->_children as &$node) {
            if ($node instanceof Helper) {
                $name = $node->getName();
                if (is_object($desc) && $desc instanceof Model && isset($desc->$name)) {
                    $value = $desc->$name;
                }
                elseif (is_array($desc) && isset($desc[$name])) {
                    $value = $desc[$name];
                }
                else {
                    continue;
                }
                
                if ($node instanceof InputHelper && ($node->getType() == 'radio' || $node->getType() == 'checkbox')) {
                    if ($node->getValue() == $value)
                        $node->setChecked("checked");
                }
                else {
                    $node->setValue($value);
                }
                
                unset($name);
            }
        }
        return $this;
    }
    
	/**
     * Constructor static alias
     * @param string $legend = ""
     * @return FieldsetHelper
     */
    public static function export ($legend = "") {
        return new self ($legend);
        return $this;
    }
}
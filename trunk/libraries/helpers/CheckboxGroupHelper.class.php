<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package helper
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: CheckboxGroupHelper.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Checkbox Group Helper Class
 *
 * @author Delespierre
 * @version $Rev: 162 $
 * @subpackage CheckboxGroupHelper
 */
class CheckboxGroupHelper extends BaseHelper {

    /**
     * Inner input's name
     * @var string
     */
    protected $_name;

    /**
     * Current position
     * @internal
     * @var integer
     */
    protected static $_count = 1;

    /**
     * Default constructor
     * @param string $name
     * @param array $values = array()
     */
    public function __construct ($name, $values = array()) {
        parent::__construct('span');
        $this->_name = $name;

        if (!empty($values))
            $this->addOptions($values);
    }

    /**
     * Add an option (a checkbox) to the group
     * @param string $label
     * @param scalar $value
     * @return CheckboxGroupHelper
     */
    public function addOption ($label, $value) {
        $this->_children[] = InputHelper::export($this->_name, 'checkbox', $value)->setId($id = 'checkbox' . (self::$_count ++));
        $this->_children[] = LabelHelper::export($label, $id);
        return $this;
    }
    
    /**
     * Add multiple options at once.
     * The $values parameters must be formatted
     * as follow: { [key: value, ...] }
     * @param array $values
     * @return CheckboxGroupHelper
     */
    public function addOptions ($values) {
        foreach ($values as $key => $value)
            $this->addOption($key, $value);
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see BaseHelper::setValue()
     */
    public function setValue ($value) {
        foreach ($this->_children as &$node) {
            if (($node instanceof InputHelper) && $node->getValue() == $value) {
                $node->setChecked('checked');
            }
        }

        return $this;
    }
    
    /**
     * Get group's name
     * @return string
     */
    public function getName () {
        return $this->_name;
    }
    
    /**
     * Constructor static alias
     * @param string $name
     * @param array $values = array()
     * @return CheckboxGroupHelper
     */
    public static function export ($name, $values = array()) {
        return new self ($name, $values);
    }
}
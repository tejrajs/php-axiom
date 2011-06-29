<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package helper
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: RadioGroupHelper.class.php 22988 2011-05-18 15:00:36Z delespierre $
 */

/**
 * Radio Group Helper Class
 *
 * @author Delespierre
 * @version $Rev: 22988 $
 * @subpackage RadioGroupHelper
 */
class RadioGroupHelper extends BaseHelper {

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
     * @return RadioGroupHelper
     */
    public function addOption ($label, $value) {
        $this->_children[] = InputHelper::export($this->_name, 'radio', $value)->setId($id = 'radio' . (self::$_count ++));
        $this->_children[] = LabelHelper::export($label, $id);
        return $this;
    }

    /**
     * Add multiple options at once.
     * The $values parameters must be formatted
     * as follow: { [key: value, ...] }
     * @param array $values
     * @return RadioGroupHelper
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
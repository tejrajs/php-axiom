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
 * Form Line Helper Class
 *
 * @author Delespierre
 * @version 1.0.0
 * @subpackage FormLineHelper
 */
class FormLineHelper extends BaseHelper {
    
    /**
     * Default constructor
     * @param string $name
     * @param string $display_name = null
     * @param string $type = "text"
     * @param scalar $value = ""
     * @param array $classes = array()
     */
    public function __construct ($name, $display_name = null, $type = "text", $value = "", $class = "") {
        parent::__construct('div');

        if (!$display_name)
            $display_name = $name;

        $this->_children['label'] = LabelHelper::export($display_name, $name);

        switch (strtolower($type)) {
            case 'text':
            case 'image':
            case 'hidden':
            case 'checkbox':
            case 'radio':
            case 'submit':
            case 'button':
            case 'file':
            case 'password':
                $input = InputHelper::export($name, $type, $value);
                break;
                
            case 'textarea':
                $input  = TextareaHelper::export($name, $value);
                break;

            case 'select':
                $input = SelectHelper::export($name, $value);
                break;

            case 'radio-group':
                $input = RadioGroupHelper::export($name, $value);
                break;

            case 'checkbox-group':
                $input = CheckboxGroupHelper::export($name, $value);
                break;

            default:
                throw new LogicException("Give FormLineHelper type mismatch with available types");
        }

        $this->_children['input'] = $input;
        
        if ($class)
            $this->getInput()->setClass($class);
    }

    /**
     * (non-PHPdoc)
     * @see BaseHelper::setValue()
     */
    public function setValue ($value) {
        $this->getInput()->setValue($value);
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see BaseHelper::getValue()
     */
    public function getValue () {
        return $this->getInput()->getValue();
    }
    
    /**
     * Get the form line's input name
     * @return string
     */
    public function getName () {
        return $this->getInput()->getName();
    }

    /**
     * Get the form line's input
     * @return BaseHelper
     */
    public function getInput () {
        return $this->_children['input'];
    }

    /**
     * Get the form line's label
     * @return LabelHelper
     */
    public function getLabel () {
        return $this->_children['label'];
    }

    /**
     * Constructor static helper
     * @param string $name
     * @param string $display_name = null
     * @param string $type = "text"
     * @param scalar $value = ""
     * @return FormLineHelper
     */
    public static function export ($name, $display_name = null, $type = "text", $value = "", $class = "") {
        return new self ($name, $display_name, $type, $value, $class);
    }
}
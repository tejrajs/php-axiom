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
 * JSon Island Helper
 *
 * @author Delespierre
 * @version $Rev$
 * @subpackage JSonDataIslandHelper
 */
class JSonDataIslandHelper {
    
    /**
     * Island Data
     * @var array
     */
    public $data;
    
    /**
     * Island options
     * Bitmask of JSON_HEX_QUOT, JSON_HEX_TAG, JSON_HEX_AMP, JSON_HEX_APOS, JSON_FORCE_OBJECT
     * @see http://php.net/manual/en/function.json-encode.php
     * @var integer
     */
    public $options;
    
    /**
     * Default constructor
     * @param array $data = array()
     * @param integer $options = 0
     */
    public function __construct (array $data = array(), $options = 0) {
        $this->data = $data;
        $this->options = $options;
    }
    
    /**
     * __toString overloading
     * @return string
     */
    public function __toString () {
        return "<!-- " . json_encode($this->data, $this->options) . " -->";
    }
    
    /**
     * Constructor static alias
     * @param array $data = array()
     * @param integer $options = 0
     * @return JSonDataIslandHelper
     */
    public static function export (array $data = array(), $options = 0) {
        return new self ($data, $options);
    }
}
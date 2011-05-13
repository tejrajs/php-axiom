<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * @version 1.0.0
 */

/**
 * Missing File Exception
 *
 * @author Delespierre
 * @version 1.0.0
 * @subpackage MissingFileException
 */
class MissingFileException extends RuntimeException {
    
    /**
     * Default constructor
     * @param string $filename
     * @param integer $code = 0
     * @param Exception $previous = null
     */
    public function __construct ($filename, $code = 0, Exception $previous = null) {
        parent::__construct("File $filename not found", $code, $previous);
    }
}
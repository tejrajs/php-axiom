<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: MissingFileException.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Missing File Exception
 *
 * @author Delespierre
 * @version $Rev: 162 $
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
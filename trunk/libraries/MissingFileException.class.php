<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: MissingFileException.class.php 22988 2011-05-18 15:00:36Z delespierre $
 */

/**
 * Missing File Exception
 *
 * @author Delespierre
 * @version $Rev: 22988 $
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
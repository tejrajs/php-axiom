<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: PDOStatementIterator.class.php 22988 2011-05-18 15:00:36Z delespierre $
 */

/**
 * PDO Statement Iterator Class
 *
 * @author Delespierre
 * @version $Rev: 22988 $
 * @subpackage PDOStatementIterator
 */
class PDOStatementIterator extends IteratorIterator implements SeekableIterator, Countable {

    /**
     * Internal statement reference
     * @internal
     * @var PDOStatement
     */
    protected $_statement;
    
    /**
     * Internal counter
     * @internal
     * @var integer
     */
    protected $_count;
    
    /**
     * Default constructor
     * @param PDOStatement $statement
     */
    public function __construct (PDOStatement $statement) {
        parent::__construct($this->_statement = $statement);
    }
    
    /**
     * (non-PHPdoc)
     * @see SeekableIterator::seek()
     */
    public function seek ($position) {
        if ($position > $this->count())
            throw new OutOfBoundsException("Cannot seek to $position");
            
        if ($position < $this->key())
            throw new OutOfRangeException("Cannot seek to $position");
            
        for ($i = $this->key(); $i < $position; $i++)
            $this->next();
    }
    
    /**
     * (non-PHPdoc)
     * @see Countable::count()
     */
    public function count () {
        if (!isset($this->_count))
		    return $this->_count = $this->_statement->rowCount();
	    return $this->_count;
    }
    
    public function first () {
        $this->rewind();
        return $this->valid() ? $this->current() : null;
    }
    
    public function last () {
        $this->seek($this->count());
        return $this->valid() ? $this->current() : null;
    }
}
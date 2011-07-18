<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: Model.class.php 22988 2011-05-18 15:00:36Z delespierre $
 */

/**
 * Model Base Class
 *
 * @abstract
 * @author Delespierre
 * @version $Rev: 22988 $
 * @subpackage Model
 */
abstract class Model {

    /**
     * Model key id
     * @var string
     */
    protected $_id_key = 'id';

    /**
     * Model's data
     * @var array
     */
    protected $_data = array();

    /**
     * Statements cache
     * @var array
     */
    protected $_statements = array();

    /**
     * Initialize a model statement (part of CRUD)
     * @abstract
     * @param string $statement
     * @return PDOStatement
     */
    abstract protected function _init ($statement);

    /**
     * Default constructor
     * @param mixed $id
     * @throws RuntimeException
     */
    public function __construct ($id = null) {
        if ($id !== null && $id !== false && !$this->find($id))
            throw new RuntimeException("Cannot instanciate model");
    }

    /**
     * __sleep overloading
     * @return array
     */
    public function __sleep () {
        return array('_id_key', '_data');
    }

    /**
     * Getter
     * @param string $key
     * @return mixed
     */
    public function __get ($key) {
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
    }

    /**
     * Setter
     * @param string $key
     * @param mixed $value
     * @return void
     */
    public function __set ($key, $value) {
        $this->_data[$key] = $value;
    }

    /**
     * __isset overloading
     * @param string $key
     * @return boolean
     */
    public function __isset ($key) {
        return isset($this->_data[$key]);
    }

    /**
     * Get internal data
     * @internal
     * @return array
     */
    public function getData () {
        return $this->_data;
    }

    /**
     * Retrieve method
     * Will return false in case of error
     * @param mixed $id
     * @return Model
     */
    public function find ($id) {
        if (!$this->_init("retrieve"))
            throw new RuntimeException("Cannot initialize " . __METHOD__);
         
        if ($this->_statements['retrieve']->execute(array(":{$this->_id_key}" => $id))) {
            if ($this->_statements['retrieve']->rowCount()) {
                $this->_data = $this->_statements['retrieve']->fetch(PDO::FETCH_ASSOC);
                return $this;
            }
        }
        return false;
    }

    /**
     * Create methode
     * Will return false in case of error
     * @param array $data
     * @throws RuntimeException
     * @return Model
     */
    public function create ($data) {
        if (!$this->_init("create"))
            throw new RuntimeException("Cannot initialize " . __METHOD__);
         
        if ($this->_statements['create']->execute(array_keys_prefix($data, ':'))) {
            $id = Database::lastInsertId();
            return $this->find($id);
        }
        return false;
    }

    /**
     * Update method
     * @throws RuntimeException
     * @return boolean
     */
    public function update ($data = array()) {
        if (!$this->_init("update"))
            throw new RuntimeException("Cannot initialize " . __METHOD__);
         
        if (!empty($this->_data)) {
            $inputs = array_merge($this->_data, array_intersect_key($data, $this->_data));
            return $this->_statements['update']->execute(array_keys_prefix($inputs, ':'));
        }
        return false;
    }

    /**
     * Delete method
     * @throws RuntimeException
     * @return boolean
     */
    public function delete () {
        if (!$this->_init("delete"))
            throw new RuntimeException("Cannot initialize " . __METHOD__);
         
        if (!empty($this->_data))
        return $this->_statements['delete']->execute(array(":{$this->_id_key}" => $this->_data[$this->_id_key]));
        return false;
    }
}
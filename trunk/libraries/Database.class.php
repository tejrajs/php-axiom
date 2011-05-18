<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category libAxiom
 * @package library
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: Database.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Database Class
 *
 * @author Delespierre
 * @version $Rev: 162 $
 * @subpackage Database
 */
class Database {
    
    /**
     * Inner PDO instance
     * @var PDO
     */
    protected static $_pdo_instance;
    
    /**
     * The Database class cannot be instanciated
     * @internal
     */
    private function __construct () { }
    
    /**
     * Get instance or init the class
     *
     * Called with parameters will create
     * new instance (once per request time)
     * Called without parameters, will
     * simply return the existing instance
     *
     * @param string $dsn
     * @param string $username = ""
     * @param string $password = ""
     * @throws InvalidArgumentException
     * @throws BadMethodCallException
     * @return PDO
     */
    public static function instance () {
        if (!isset(self::$_pdo_instance)) {
            $args = func_get_args();
            try {
                switch (count($args)) {
                    case 0: throw new InvalidArgumentException("The first parameter (\$dsn) is mandatory"); break;
                    case 1: self::$_pdo_instance = new PDO($args[0]); break;
                    case 2: self::$_pdo_instance = new PDO($args[0], $args[1]); break;
                    case 3: self::$_pdo_instance = new PDO($args[0], $args[1], $args[2]); break;
                    case 4: self::$_pdo_instance = new PDO($args[0], $args[1], $args[2], $args[3]); break;
                    default: throw new BadMethodCallException(__METHOD__ . " takes at least 1 parameter and at most 4 parameters"); break;
                }
            }
            catch (Exception $e) {
                die('-- Database Connection Error --');
            }
        }
        return self::$_pdo_instance;
    }
    
    /**
     * Begin a transaction
     * @see PDO::beginTransaction
     * @return boolean
     */
    public static function beginTransaction () {
        return self::$_pdo_instance->beginTransaction();
    }
    
    /**
     * Commit a transaction
     * @see PDO::commit
     * @return boolean
     */
    public static function commit () {
        return self::$_pdo_instance->commit();
    }
    
    /**
     * Get error code
     * @see PDO::errorCode
     * @return mixed
     */
    public static function errorCode () {
        return self::$_pdo_instance->errorCode();
    }
    
    /**
     * Get error info
     * @see PDO::errorInfo
     * @return array
     */
    public static function errorInfo () {
        return self::$_pdo_instance->errorInfo();
    }
    
    /**
     * Exec an SQL statement
     * @see PDO::exec
     * @param string $statement
     * @return integer
     */
    public static function exec ($statement) {
        return self::$_pdo_instance->exec($statement);
    }
    
    /**
     * Get attribute
     * @see PDO::getAttribute
     * @param integer $attribute
     * @return mixed
     */
    public static function getAttribute ($attribute) {
        return self::$_pdo_instance->getAttribute($attribute);
    }
    
    /**
     * Get available drivers
     * @see PDO::getAvailableDrivers
     * @return array
     */
    public static function getAvailableDrivers () {
        return self::$_pdo_instance->getAvailableDrivers();
    }
    
    /**
     * Get last inserted id
     * @see PDO::lastInsertId
     * @param string $name = null
     * @return string
     */
    public static function lastInsertId ($name = null) {
        return self::$_pdo_instance->lastInsertId($name);
    }
    
    /**
     * Prepare a statement
     * @see PDO::prepare
     * @param string $statement
     * @param array $driver_options = array()
     * @return PDOStatement
     */
    public static function prepare ($statement, $driver_options = array()) {
        return self::$_pdo_instance->prepare($statement, $driver_options);
    }
    
    /**
     * Execute a query
     * @see PDO::query
     * @param string $statment
     * @return PDOStatement
     */
    public static function query ($statment) {
        return self::$_pdo_instance->query($statment);
    }
    
    /**
     * Quote string
     * @see PDO::quote
     * @param string $string
     * @param integer $parameter_type = PDO::PARAM_STR
     * @return string
     */
    public static function quote ($string, $parameter_type = PDO::PARAM_STR) {
        return self::$_pdo_instance->quote($string, $parameter_type);
    }
    
    /**
     * Rollback a transaction
     * @see PDO::rollBack
     * @return boolean
     */
    public static function rollBack () {
        return self::$_pdo_instance->rollBack();
    }
    
    /**
     * Sets an attribute
     * @see PDO::setAttribute
     * @param integer $attribute
     * @param mixed $value
     * @return boolean
     */
    public static function setAttribute ($attribute, $value) {
        return self::$_pdo_instance->setAttribute($attribute, $value);
    }
}
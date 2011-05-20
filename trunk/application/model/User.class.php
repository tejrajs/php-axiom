<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category Model
 * @package Model
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: User.class.php 22988 2011-05-18 15:00:36Z delespierre $
 */

/**
 * User Model
 *
 * @author Delespierre
 * @version $Rev: 22988 $
 * @subpackage User
 */
class User extends Model {
    
    protected function _init ($statement) {
        if (isset($this->_statements[$statement]))
            return $this->_statements[$statement];
        
        switch ($statement) {
            case 'create':
                $query = 'INSERT INTO `backoffice`.`users` (`login`,`password`,`name`,`surname`) VALUES (:login,:password,:name,:surname)';
                break;
            case 'retrieve':
                $query = 'SELECT * FROM `backoffice`.`users` WHERE `id`=:id';
                break;
            case 'update':
                $query = 'UPDATE `backoffice`.`users` SET `login`=:login, `password`=:password, `name`=:name, `surname`=:surname, '.
                		 '`creation`=:creation, `last_connection`=:last_connection WHERE `id`=:id';
                break;
            case 'delete':
                $query = 'DELETE FROM `backoffice`.`users` WHERE `id`=:id';
                break;
            default:
                throw new RuntimeException("$statement is unexepected for " . __METHOD__);
        }
        
        return $this->_statements[$statement] = Database::prepare($query);
    }
    
    public static function exists ($username, $password) {
        $query = "SELECT `id` FROM `backoffice`.`users` WHERE `login`=:login AND `password`=:password";
        $stmt = Database::prepare($query);
        
        $password = md5($password);
        $stmt->bindParam(':login', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            if ($stmt->rowCount()) {
                $row = $stmt->fetch();
                return new self($row['id']);
            }
            return false;
        }
        else
            throw new RuntimeException("Error with query");
    }
    
    public static function getUsers ($search_params = array()) {
        $query = "SELECT * FROM `backoffice`.`users`";
        
        if (!empty($search_params)) {
            $pieces = array();
            foreach ($search_params as $key => $value)
                $pieces[] = "`$key`=:$key";
            $query .= " WHERE " . implode(' AND ', $pieces);
        }
        
        $stmt = Database::prepare($query);
        if ($stmt->execute(array_keys_prefix($search_params, ':'))) {
            $user = new self;
            $stmt->setFetchMode(PDO::FETCH_INTO, $user);
            return new PDOStatementIterator($stmt);
        }
        return false;
    }
}
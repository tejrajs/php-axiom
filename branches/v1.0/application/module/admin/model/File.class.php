<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category Model
 * @package Model
 * $Date$
 * $Id$
 */

/**
 * File Model
 *
 * @author Delespierre
 * @version $Rev$
 * @subpackage File
 */
class File extends Model {
    
    protected function _init ($statement) {
        if (isset($this->_statements[$statement]))
            return $this->_statements[$statement];
        
        switch ($statement) {
            case 'create':
                $query = 'INSERT INTO `ax_files` (`filename`,`path`,`mime_type`,`upload`,`ax_users_id`) '.
                         'VALUES (:filename,:path,:mime_type,:upload,:ax_users_id)';
                break;
            case 'retrieve':
                $query = 'SELECT * FROM `ax_files` WHERE `id`=:id';
                break;
            case 'update':
                $query = 'UPDATE `ax_files` SET `filename`=:filename,`path`=:path,`mime_type`=:mime_type,`upload`=:upload,'.
                         '`ax_users_id`=:users_id WHERE `id`=:id';
                break;
            case 'delete':
                $query = 'DELETE FROM `ax_files` WHERE `id`=:id';
                break;
            default:
                throw new RuntimeException("$statement is unexepected for " . __METHOD__, 10003);
        }
        
        return $this->_statements[$statement] = Database::prepare($query);
    }
    
    public function delete () {
        if (!parent::delete())
            throw new RuntimeException("Cannot delete File database record", 10004);
            
        return unlink($this->path);
    }
    
    public static function getFiles ($search_params = array(), $order = array('mime_type', 'upload')) {
        $query = "SELECT * FROM `ax_files`";
        
        if (!empty($search_params)) {
            $pieces = array();
            foreach ($search_params as $key => $value)
                $pieces[] = "`$key`=:$key";
            $query .= " WHERE " . implode(' AND ', $pieces);
        }
        
        $query .= " ORDER BY `" . implode('`,`', $order) . "`";
        
        $stmt = Database::prepare($query);
        if ($stmt->execute(array_keys_prefix($search_params, ':'))) {
            $file = new self;
            $stmt->setFetchMode(PDO::FETCH_INTO, $file);
            return new PDOStatementIterator($stmt);
        }
        return false;
    }
    
    public function getSize () {
        if (empty($this->_data))
            throw new RuntimeException("Malformed instance", 10005);
            
        if (file_exists($this->path))
            return filesize($this->path);
        return false;
    }
    
    public function getUser () {
        if (empty($this->_data))
            throw new RuntimeException("Malformed instance", 10005);
            
        return new User($this->ax_users_id);
    }
    
    public function getType () {
        if (empty($this->_data))
            throw new RuntimeException("Malformed instance", 10005);
            
        $mime = $this->mime_type;
        return substr($mime, 0, strpos($mime, '/'));
    }
    
    public function getSubtype () {
        if (empty($this->_data))
            throw new RuntimeException("Malformed instance", 10005);
            
        $mime = $this->mime_type;
        return substr($mime, strpos($mime, '/') +1);
    }
}
<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category Model
 * @package Model
 * $Date: 2011-05-18 17:00:36 +0200 (mer., 18 mai 2011) $
 * $Id: File.class.php 22988 2011-05-18 15:00:36Z delespierre $
 */

/**
 * File Model
 *
 * @author Delespierre
 * @version $Rev: 22988 $
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
                throw new RuntimeException("$statement is unexepected for " . __METHOD__);
        }
        
        return $this->_statements[$statement] = Database::prepare($query);
    }
    
    public function delete () {
        if (!parent::delete())
            throw new RuntimeException("Cannot delete File database record");
            
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
            throw new RuntimeException("Malformed instance");
            
        if (file_exists($this->path))
            return filesize($this->path);
        return false;
    }
    
    public function getUser () {
        if (empty($this->_data))
            throw new RuntimeException("Malformed instance");
            
        return new User($this->ax_users_id);
    }
    
    public function getType () {
        if (empty($this->_data))
            throw new RuntimeException("Malformed instance");
            
        $mime = $this->mime_type;
        return substr($mime, 0, strpos($mime, '/'));
    }
    
    public function getSubtype () {
        if (empty($this->_data))
            throw new RuntimeException("Malformed instance");
            
        $mime = $this->mime_type;
        return substr($mime, strpos($mime, '/') +1);
    }
}
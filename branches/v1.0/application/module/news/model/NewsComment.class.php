<?php
/**
 * Axiom: a lightweight PHP framework
 *
 * @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
 * @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
 */

class NewsComment extends Model {
    
    protected function _init ($statement) {
        if (isset($this->_statements[$statement]))
            return $this->_statements[$statement];
        
        switch ($statement) {
            case 'create':
                $query = 'INSERT INTO `ax_news_comments` (`author`,`date`,`mail`,`website`,`ip`,`body`,`published`,`ax_news_id`)'.
                         ' VALUES (:author,:date,:mail,:website,:ip,:body,:published,:ax_news_id)';
                break;
            case 'retrieve':
                $query = 'SELECT * FROM `ax_news_comments` WHERE `id`=:id';
                break;
            case 'update':
                $query = 'UPDATE `ax_news_comments` SET' .
                         '`author`=:author,' .
                         '`date`=:date,' .
                         '`mail`=:mail,' .
                         '`website`=:website,' .
                         '`ip`=:ip,' .
                         '`body`=:body,' .
                         '`published`=:published,' .
                         '`ax_news_id`=:ax_news_id' .
                         ' WHERE `id`=:id';
                break;
            case 'delete':
                $query = 'DELETE FROM `ax_news_comments` WHERE `id`=:id';
                break;
            default:
                throw new RuntimeException("$statement is unexepected for " . __METHOD__, 10001);
        }
        
        return $this->_statements[$statement] = Database::prepare($query);
    }
    
    public static function getNewsComment ($search_params = array()) {
        $query = "SELECT * FROM `ax_news_comments`";
        
        if (!empty($search_params)) {
            $pieces = array();
            foreach ($search_params as $key => $value)
                $pieces[] = "`$key`=:$key";
            $query .= " WHERE " . implode(' AND ', $pieces);
        }
        
        $stmt = Database::prepare($query);
        if ($stmt->execute(array_keys_prefix($search_params, ':'))) {
            $news_comment = new self;
            $stmt->setFetchMode(PDO::FETCH_INTO, $news_comment);
            return new PDOStatementIterator($stmt);
        }
        return false;
    }
}
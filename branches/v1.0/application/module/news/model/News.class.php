<?php

class News extends Model {
    
    protected function _init ($statement) {
        if (isset($this->_statements[$statement]))
            return $this->_statements[$statement];
        
        switch ($statement) {
            case 'create':
                $query = 'INSERT INTO `ax_news` (`author`,`date`,`body`,`published`)'.
                         ' VALUES (:author,:date,:body,:published)';
                break;
            case 'retrieve':
                $query = 'SELECT * FROM `ax_news` WHERE `id`=:id';
                break;
            case 'update':
                $query = 'UPDATE `ax_news` SET' .
                         '`author`=:author,' .
                         '`date`=:date,' .
                         '`body`=:body,' .
                         '`published`=:published' .
                         ' WHERE `id`=:id';
                break;
            case 'delete':
                $query = 'DELETE FROM `ax_news` WHERE `id`=:id';
                break;
            default:
                throw new RuntimeException("$statement is unexepected for " . __METHOD__, 10001);
        }
        
        return $this->_statements[$statement] = Database::prepare($query);
    }
    
    public static function getNews ($search_params = array()) {
        $query = "SELECT * FROM `ax_news`";
        
        if (!empty($search_params)) {
            $pieces = array();
            foreach ($search_params as $key => $value)
                $pieces[] = "`$key`=:$key";
            $query .= " WHERE " . implode(' AND ', $pieces);
        }
        
        $stmt = Database::prepare($query);
        if ($stmt->execute(array_keys_prefix($search_params, ':'))) {
            $news = new self;
            $stmt->setFetchMode(PDO::FETCH_INTO, $news);
            return new PDOStatementIterator($stmt);
        }
        return false;
    }
    
    public function getComments () {
        if (empty($this->_data))
            throw new RuntimeException('Invalid instance');
            
        return NewsComment::getNewsComment(array('ax_news_id' => $this->id));
    }
}
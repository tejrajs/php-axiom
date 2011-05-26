<?php

abstract class FeedWriter extends DOMDocument {
    
    protected $_feed;
    
    public function __construct (Feed $feed) {
        parent::__construct('1.0', 'utf-8');
        $this->_feed = $feed;
    }
    
    abstract protected function buildFeedInfo ();
    
    abstract protected function buildItems ();
}
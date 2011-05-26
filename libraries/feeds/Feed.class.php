<?php

class Feed extends ArrayIterator {
    
    protected static $_meta_inf = array();
    
    protected static $_config = array();
    
    public static function setConfig ($config = array()) {
        $default = array(
            'default_type' => 'Rss',
        );
        
        self::$_config = $config + $defaults;
    }
    
    public static function setMetaInf ($meta_inf = array()) {
        $defaults = array(
            'title' => 'Axiom Generic Feed',
            'date' => date('r'),
            'author' => array(
            	'name' => 'Benjamin DELESPIERRE',
            	'mail' => 'benjamin.delespierre@gmail.com'),
            'lang' => Lang::getLocale(),
            'description' => 'Axiom Generic Feed',
            'copyright' => null,
            'link' => url('feed'),
            'id' => uniqid('axiom_'),
        );
        
        self::$_meta_inf = $meta_inf + $defaults;
    }
    
    public function __construct (array $items = array()) {
        parent::__construct(array(
            'meta' => self::$_meta_inf,
            'items' => $items,
        ));
    }
    
    public function __get ($key) {
        if (method_exists($this, $method = "get" . ucfirst($key)))
            return $this->$method();
        else
            throw new InvalidArgumentException("$key does not exist");
    }
    
    public function __set ($key, $value) {
        if (method_exists($this, $method = "get" . ucfirst($key)))
            return $this->$method($value);
        else
            throw new InvalidArgumentException("$key does not exist");
    }
    
    public static function export (array $items = array()) {
        return new self($items);
    }
    
    public function add (FeedEntry $entry = null) {
        if (!$entry)
            $entry = new FeedEntry;
            
        return $this['items'][] = $entry;
    }
    
    public function getEntries () {
        return $this['items'];
    }
    
    public function getId () {
        return $this['meta']['id'];
    }
    
    public function setId ($id) {
        if (!$id = filter_var($id, FILTER_SANITIZE_ENCODED))
            throw new InvalidArgumentException("Invalid ID");
            
        $this['meta']['id'] = $id;
    }
    
    public function getTitle () {
        return $this['meta']['title'];
    }
    
    public function setTitle ($title) {
        $title = strip_tags($title);
        $this['meta']['title'] = $title;
    }
    
    public function getDate () {
        return $this['meta']['date'];
    }
    
    public function setDate ($date) {
        if ($time = strtotime($date))
            $date = date('r', $time);
        else
            throw new InvalidArgumentException("Invalid date format");
            
        $this['meta']['date'] = $date;
    }
    
    public function getAuthor () {
        return $this['meta']['author'];
    }
    
    public function setAuthor (array $author) {
        $author = array_intersect_key($author, array_flip(array('mail', 'name', 'uri')));
        
        if (isset($author['mail']) && !Mail::validateEmail($author['mail']))
            throw new InvalidArgumentException("Invalid author email");
            
        if (isset($author['name']) && !$author['name'] = filter_var($author['name'], FILTER_SANITIZE_ENCODED))
            throw new InvalidArgumentException("Invalid author name");
            
        if (isset($author['uri']) && !filter_var($author['uri'], FILTER_VALIDATE_URL))
            throw new InvalidArgumentException("Invalid URI for author");
            
        if (empty($author))
            throw new InvalidArgumentException("Author description must contain at least a name or email or URI");
            
        $this['meta']['author'] = $author;
    }
    
    public function getLang () {
        return $this['meta']['lang'];
    }
    
    public function setLang ($lang) {
        $this['meta']['lang'] = $lang;
    }
    
    public function getDescription () {
        return $this['meta']['description'];
    }
    
    public function setDescription ($description) {
        $description = strip_tags($description);
        $this['meta']['description'] = $description;
    }
    
    public function getCopyright () {
        return $this['meta']['copyright'];
    }
    
    public function setCopyright ($copyright) {
        $this['meta']['copyright'] = $copyright;
    }
    
    public function getLink () {
        return $this['meta']['link'];
    }
    
    public function setLink ($url) {
        if (!$url = filter_var($url, FILTER_VALIDATE_URL))
            throw new InvalidArgumentException("Invalid URL");
            
        $this['meta']['link'];
    }
    
    public function build ($type = null) {
        if (!$type)
            $type = ucfirst(strtolower(self::$_config['default_type']));
        
        if (!Autoloader::load($class = "{$type}FeedWriter"))
            throw new RuntimeException("$type feed writer not found");
            
        $reflection = new ReflectionClass($class);
        if (!$reflection->isInstanciable())
            throw new RuntimeException("$class cannot be instanciated");
            
        if (!$reflextion->isSubclassOf("FeedWriter"))
            throw new RuntimeException("$class must extends FeedWriter");
            
        return new $class($this);
    }
}
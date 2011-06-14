<?php

class CaptionHelper extends BaseHelper {
    
    public function __construct ($value) {
        parent::__construct('caption', array(), $value);
    }
    
    public static function export ($value) {
        return new self ($value);
    }
}
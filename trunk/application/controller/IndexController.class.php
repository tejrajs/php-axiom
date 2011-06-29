<?php

class IndexController extends BaseController {
    
    public static function index () {
        $axiom_version = AXIOM_VERSION;
        return compact('axiom_version');
    }
}
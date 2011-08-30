<?php

class IndexController extends BaseController {
    
    public static function index () {
        $axiom_version = AXIOM_VERSION;
        return compact('axiom_version');
    }
    
    public static function test () {
        Log::error("test 1 (error)");
        Log::debug("test 2 (debug)");
        Log::notice("test 3 (notice)");
        Log::message("test 4 (unknown)", 42);
        Log::warning("test 5");
        
        1/0;
    }
}
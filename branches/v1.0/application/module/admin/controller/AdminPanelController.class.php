<?php

class PanelAdminController extends SecuredController {
    
    public static function index () {
        $modules = array();
        foreach (ModuleManager::getAvailableModules() as $directory) {
            $module_name = $directory->getFilename();
            
            if ($module_name == 'admin' || !$module_info = ModuleManager::getInformations($module_name))
                continue;
            
            $modules[$module_name] = $module_info + array('url' => url("admin/$module_name"));
        }
        return compact("modules");
    }
}
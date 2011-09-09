<?php
/**
 * Axiom: a lightweight PHP framework
 *
 * @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
 * @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
 */

class AdminPanelController extends SecuredController {
    
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
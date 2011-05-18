<?php
/**
 * PHP AXIOM
 *
 * @license LGPL
 * @author Benjamin DELESPIERRE <benjamin.delespierre@gmail.com>
 * @category Action
 * @package Controller
 * $Date: 2011-05-18 15:19:56 +0200 (mer., 18 mai 2011) $
 * $Id: AdminController.class.php 162 2011-05-18 13:19:56Z delespierre $
 */

/**
 * Admin Controller
 *
 * @author Delespierre
 * @version $Rev: 162 $
 * @subpackage AdminController
 */
class AdminController extends BaseController {
    
    public static function _init (Request &$request, Response &$response) {
        parent::_init($request, $response);
        
        if (!isset($_SESSION['user']) || !$_SESSION['user'])
            throw new LoginException("Unconnected user");
        
        ViewManager::setLayoutVar("user", $_SESSION['user']);
        ViewManager::setLayoutFile("admin");
    }
    
    public static function index () {
        return self::panel();
    }
    
    final public static function panel () {
        self::$_response->setResponseView("panel");
        
        $modules = array();
        foreach (ModuleManager::getAvailableModules() as $module_name) {
            if (!$module_info = ModuleManager::getInformations($module_name))
                continue;
            $modules[$module_name] = url('admin', $module_name);
        }
        
        return compact("modules");
    }
    
    // Users Management
    // -------------------------------------------------------------------------------------------------------------------------------------
    
    final public static function users () {
        self::$_response->setResponseView("users");
        $users = User::getUsers();
        
        return compact('users');
    }
    
    final public static function addUser () {
        self::$_response->setResponseView("edit_user");
    }
    
    final public static function editUser () {
        self::$_response->setResponseView("edit_user");
        
        if ($id = self::$_request->id) {
            $user_edit = new User($id);
        }
        
        return compact("user_edit");
    }
    
    final public static function saveUser () {
        if (self::$_request->cancel) {
            self::$_response->setResponseView("users");
            return self::users();
        }
        
        if (self::$_request->password != self::$_request->password_confirm) {
            self::$_response->addMessage(i18n('admin.users.edit.save.password_confirm_failed'), MESSAGE_ALERT);
            return self::editUser();
        }
        
        $defaults = array(
            'login' => null,
            'password' => null,
            'name' => null,
            'surname' => null,
        );
        
        $inputs = self::$_request->getRequestParameters();
        $inputs = array_merge($defaults, array_intersect_key($inputs, $defaults));
        
        if ($missing = array_keys($inputs, false)) {
            self::$_response->addMessage(i18n('admin.users.edit.save.missing', implode(',', $missing)), MESSAGE_ALERT);
            return self::editUser();
        }
        else {
            $inputs['password'] = md5($inputs['password']);
            
            if ($id = self::$_request->id) {
                $user = new User($id);
                if ($user->update($inputs)) {
                    self::$_response->addMessage(i18n('admin.users.edit.save.ok'));
                    self::$_response->setResponseView("users");
                    redirect(url('admin', 'users'));
                }
                else {
                    self::$_response->addMessage(i18n('admin.users.edit.save.nok'), MESSAGE_ALERT);
                    return self::editUser();
                }
            }
            else {
                $user = new User();
                if ($user->create($inputs)) {
                    self::$_response->addMessage(i18n('admin.users.edit.save.ok'));
                    self::$_response->setResponseView("users");
                    redirect(url('admin', 'users'));
                }
                else {
                    self::$_response->addMessage(i18n('admin.users.edit.save.nok'), MESSAGE_ALERT);
                    return self::editUser();
                }
            }
        }
    }
    
    final public static function deleteUser () {
        self::$_response->setResponseView('users');
        
        if ($id = self::$_request->id) {
            $user = new User($id);
            if ($user->delete()) {
                self::$_response->addMessage(i18n('admin.users.delete.ok'));
            }
            else {
                self::$_response->addMessage(i18n('admin.users.delete.nok', MESSAGE_ALERT));
            }
        }
        else {
            self::$_response->addMessage(i18n('admin.users.delete.no_user_selected', MESSAGE_ALERT));
        }
        
        return self::users();
    }
    
    // Files Management
    // -------------------------------------------------------------------------------------------------------------------------------------
    
    final public static function files () {
        self::$_response->setResponseView('files');
        $files = File::getFiles();

        return compact("files");
    }
    
    final public static function upload () {
        self::$_response->setResponseView('files');
        
        if (isset($_FILES["files"])) {
            foreach ($_FILES["files"]["error"] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["files"]["tmp_name"][$key];
                    $name = $_FILES["files"]["name"][$key];
                    $path = APPLICATION_PATH . "/webroot/upload/$name";
                    $file = new File();
                    $file_inputs = array(
                        'filename' => $name,
                        'path' => $path,
                        'mime_type' => $_FILES["files"]["type"][$key], // FIXME this value is unsafe
                        'upload' => time(),
                        'users_id' => $_SESSION['user']->id,
                    );
                    if (move_uploaded_file($tmp_name, $path) && $file->create($file_inputs)) {
                        self::$_response->addMessage(i18n('admin.files.upload.ok', $name), MESSAGE_WARNING);
                    }
                    else {
                        if (file_exists($path)) unlink($path);
                        self::$_response->addMessage(i18n('admin.files.upload.nok', $name), MESSAGE_ALERT);
                    }
                }
            }
        }
        
        return self::files();
    }
    
    final public static function getFileInfo () {
        self::$_response->setResponseView('file');
        if ($format = self::$_request->format)
            self::$_response->setOutputFormat($format);
        
        if ($id = self::$_request->id) {
            $file = new File($id);
        }
        
        return compact('file');
    }
    
    final public static function deleteFile () {
       self::$_response->setResponseView('file');
       if (self::$_request->format == 'json')
           self::$_response->setOutputFormat(self::$_request->format);
           
        if ($ids = self::$_request->id) {
            if (is_scalar($ids))
                $ids = array($ids);
                
            foreach ($ids as $id) {
                try {
                    $file = new File($id);
                    if ($file->delete())
                        self::$_response->addMessage(i18n('admin.files.delete.ok', $file->filename), MESSAGE_WARNING);
                    else
                        self::$_response->addMessage(i18n('admin.files.delete.nok', $file->filename), MESSAGE_ALERT);
                }
                catch (Exception $e) {
                    trigger_error("Cannot find file #$id");
                }
            }
        }
        
        // TODO add the webservice results to send for AJAX
        
        return self::files();
    }
    
    // Modules
    // -------------------------------------------------------------------------------------------------------------------------------------
    
    final public static function module () {
        if (!self::$_request->admrt)
            throw new BadMethodCallException('No route found');
            
        // FIXME find a better way to route through admin controllers
        if (in_array($method = self::$_request->admrt, get_class_methods(__CLASS__)))
            return self::$method();
            
        if (!file_exists($module_path = APPLICATION_PATH . '/module/' . self::$_request->admrt))
            throw new BadMethodCallException('Not such module: ' . self::$_request->admrt);
            
        if (!@require_once $module_path . '/config/bootstrap.php')
            throw new RuntimeException('Cannot bootstrap ' . self::$_request->admrt);
            
        $controller = ucfirst(self::$_request->admrt) . 'AdminController';
        Router::load($controller, self::$_request->admact);
        exit();
    }
}
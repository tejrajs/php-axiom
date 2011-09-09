<?php
/**
 * Axiom: a lightweight PHP framework
 *
 * @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
 * @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
 */

class UsersController extends SecuredController {
    
    public static function index () {
        self::$_response->setResponseView('users');
        return self::users();
    }
    
    public static function users () {
        $users = User::getUsers();
        return compact('users');
    }
    
    public static function add () {
        self::$_response->setResponseView("edit");
    }
    
    public static function edit () {
        if ($id = self::$_request->id)
            $user_edit = new User($id);
        
        return compact("user_edit");
    }
    
    public static function save () {
        if (self::$_request->cancel) {
            self::redirect(url('admin/users'), RedirectException::REDIRECT_PERMANENT);
        }
        
        if (self::$_request->password != self::$_request->password_confirm) {
            self::$_response->addMessage(i18n('admin.users.edit.save.password_confirm_failed'), MESSAGE_ALERT);
            self::$_response->setResponseView('edit');
            return self::edit();
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
            self::$_response->setResponseView('edit');
            return self::edit();
        }
        else {
            $inputs['password'] = md5($inputs['password']);
            if ($id = self::$_request->id) {
                $user = new User($id);
                $method = "update";
            }
            else {
                $user = new User();
                $method = "create";
            }
            
            if ($user->$method($inputs)) {
                self::$_response->addMessage(i18n('admin.users.edit.save.ok', $user->login));
                self::redirect(url('admin/users'), RedirectException::REDIRECT_REFRESH);
            }
            else {
                self::$_response->addMessage(i18n('admin.users.edit.save.nok'), MESSAGE_ALERT);
                self::$_response->setResponseView('edit');
                return self::edit();
            }
        }
    }
    
    public static function delete () {
        self::$_response->setResponseView('users');
        
        if ($id = self::$_request->id) {
            try {
                $user = new User($id);
                $login = $user->login;
                if ($user->delete())
                    self::$_response->addMessage(i18n('admin.users.delete.ok', $login));
                else
                    self::$_response->addMessage(i18n('admin.users.delete.nok', $login), MESSAGE_ALERT);
            }
            catch (RuntimeException $e) {
                self::$_response->addMessage(i18n('admin.users.delete.nok', ''), MESSAGE_ALERT);
            }
        }
        else
            self::$_response->addMessage(i18n('admin.users.delete.no_user_selected', MESSAGE_ALERT));
        
        return self::users();
    }
}
<?php

class UsersAdminController extends SecuredController {
    
    public static function index () {
        return self::users();
    }
    
    public static function users () {
        self::$_response->setResponseView("users");
        $users = User::getUsers();
        
        return compact('users');
    }
    
    public static function addUser () {
        self::$_response->setResponseView("edit_user");
    }
    
    public static function editUser () {
        self::$_response->setResponseView("edit_user");
        
        if ($id = self::$_request->id) {
            $user_edit = new User($id);
        }
        
        return compact("user_edit");
    }
    
    public static function saveUser () {
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
    
    public static function deleteUser () {
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
}
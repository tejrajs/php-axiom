<?php
/**
 * Axiom: a lightweight PHP framework
 *
 * @copyright Copyright 2010-2011, Benjamin Delespierre (http://bdelespierre.fr)
 * @licence http://www.gnu.org/licenses/lgpl.html Lesser General Public Licence version 3
 */

class FilesController extends SecuredController {
    
    public static function index () {
        self::$_response->setResponseView('files');
        return self::files();
    }
    
    public static function files () {
        $files = File::getFiles();
        return compact("files");
    }
    
    public static function upload () {
        self::$_response->setResponseView('files');
        
        if (isset($_FILES['files'])) {
            foreach ($_FILES['files']['error'] as $key => $error) {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES['files']['tmp_name'][$key];
                    $name = $_FILES['files']['name'][$key];
                    $path = APPLICATION_PATH . "/webroot/upload/$name";
                    $file = new File();
                    $file_inputs = array(
                        'filename' => $name,
                        'path' => $path,
                        'mime_type' => $_FILES['files']['type'][$key], // FIXME this value is unsafe
                        'upload' => date('Y-m-d H:i:s'),
                        'ax_users_id' => self::$_session->user->id,
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
    
    public static function info () {
        if ($format = self::$_request->format)
            self::$_response->setOutputFormat($format);
        
        if ($id = self::$_request->id) {
            $file = new File($id);
        }
        
        return compact('file');
    }
    
    public static function delete () {
        self::$_response->setResponseView('files');
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
}
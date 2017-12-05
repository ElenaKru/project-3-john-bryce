<?php
require_once 'controller.php';
require_once '../models/userModel.php';

class UserController extends Controller {
    private $db;

    function __construct() {
        // $this->db = new BL();
    }

    public static function Login ($email, $password){
        $user =  BL::login($email, $password);
        if($user == false){
            return false;
        }
        $loggedInUser = new UserModel($user);
        $_SESSION['user'] = [];
        $_SESSION['user']['id']= $loggedInUser->getId();
        $_SESSION['user']['name'] = $loggedInUser->getName();
        $_SESSION['user']['role'] = $loggedInUser->getRole();
        if(!isset($_SESSION['roles'])){
            BL::setRoles();
        }
    }

    function uploadFile($files){
        $image = $files['image'];
        //    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/uploads/'; NOT FOR XAMPP
        $uploaddir = dirname(__FILE__) . '/../uploads/';
        $fileName = basename($image['name']);
        $uploadfile = $uploaddir . $fileName;

        if (move_uploaded_file($image['tmp_name'], $uploadfile)) {
            $_SESSION['success'][] = 'File loaded successfully';
            return $fileName;
            //    $params['image'] = $fileName;
        } else {
            $_SESSION['error'][] = 'Error file loading';
            return '';
        }
    }

    function CreateUser($params) {
        if(!empty($params['files'])){
            $params['image'] = $this->uploadFile($params['files']);
        }

        $u = new UserModel($params);
        $result = BL::CreateEntity(UserModel::tableName, $u->jsonSerialize());
        if(isset($params['ajax']) && $params['ajax'] == 'false'){

            header("Location: " .SITE_ROOT. "/index.php#admin");
            exit();
        }
        return $result;
    }

     function getAllUsers() {
         $arrUsers = BL::getAll(UserModel::tableName);
         $result = [];
         foreach($arrUsers as $user){
             $model = new UserModel($user);
             $result[] = $model->jsonSerialize();
         }
         return json_encode($result);
     }

    function getUsersCount() {
        return json_encode(BL::getCount(UserModel::tableName));
    }

     function getUserById($params) {
         // CONNECT BL
 
         return BL::getOneById(UserModel::tableName, $params);

     }

     function DeleteUser($request_vars) {

         BL::deleteItem(UserModel::tableName, $request_vars["id"]);
         if(isset($request_vars['ajax']) && $request_vars['ajax'] == 'false'){
             header("Location: " .SITE_ROOT. "/index.php#admin");
             exit();
         }
         return 0;
     }

    function UpdateUser($params) {
        if(!empty($params['files'])){
            $params['image'] = $this->uploadFile($params['files']);
        }
        $u = new UserModel($params);
        $result = BL::updateItemById(UserModel::tableName, $params["id"], $u->jsonSerializeForUpdate());
        if(isset($params['ajax']) && $params['ajax'] == 'false'){

            header("Location: " .SITE_ROOT. "/index.php#admin:" . $params["id"]);
            exit();
        }
        return $result;
    }

}
?>
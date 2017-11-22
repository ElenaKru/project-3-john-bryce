<?php
require_once 'controller.php';
require_once '../models/studentModel.php';

class StudentController extends Controller {
    private $db;

    function __construct() {
        // $this->db = new BL();
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
    function CreateStudent($params) {
        if(!empty($params['files'])){
            $params['image'] = $this->uploadFile($params['files']);
        }

        $s = new StudentModel($params);
        $result = BL::CreateEntity(StudentModel::tableName, $s->jsonSerialize());
        if(isset($params['ajax']) && $params['ajax'] == 'false'){

            header("Location: " .SITE_ROOT. "/index.php#school");
            exit();
        }
        return $result;
    }

    function getAllStudents() {
        return json_encode(BL::getAll(StudentModel::tableName));
    }

    function getStudentById($params) {
        // CONNECT BL
//        $array = [
//            "id" => $id,
//            "name" => MD5($id)
//        ];
//
//        $s = new StudentModel($array);
//        return $s->jsonSerialize();

//        $s = new StudentModel($params);
        return BL::getOneById(StudentModel::tableName, $params);

    }


    function DeleteStudent($request_vars) {
      //  $s = new StudentModel($request_vars["id"]);
        return BL::deleteItem(StudentModel::tableName, $request_vars["id"]);
    }

    function UpdateStudent($params) {

        if(!empty($params['files'])){
            $params['image'] = $this->uploadFile($params['files']);
        }

        if($this->checkParams($params)){
            header("Location: " .SITE_ROOT. "/index.php#student:" . $params["id"]);
            exit();
        }
        $s = new StudentModel($params);
        $result = BL::updateItemById(StudentModel::tableName, $params["id"], $s->jsonSerialize());
        if(isset($params['ajax']) && $params['ajax'] == 'false'){

            header("Location: " .SITE_ROOT. "/index.php#student:" . $params["id"]);
            exit();
        }
        return $result;
    }

//    function UpdateStudent($request_vars) {
//        $s = new StudentModel($request_vars);
//        return BL::updateItemById(StudentModel::tableName, $request_vars["id"], $s->jsonSerialize());
//    }

    function checkParams($params){
        $required = 0;
        $error = 0;
        foreach ($params as $key => $value){
            if(in_array($key, StudentModel::requiredFields) && !empty($value)){
                $required ++;
            }
            switch ($key){
                case 'email':
                    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                        $error = 1;
                        $_SESSION['error'][] = 'Email address is considered invalid';
                    }
                    break;
            }
        }


        if($required < count(StudentModel::requiredFields)){
            $error = 1;
            $_SESSION['error'][] = 'You missed some fields';
        }
        if($error){
            return 1;
        }
    }
    function getStudentsCount() {
        return json_encode(BL::getCount(StudentModel::tableName));
    }
}
?>
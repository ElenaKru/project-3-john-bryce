<?php
require_once 'controller.php';
require_once '../models/courseModel.php';

class CourseController extends Controller {
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

    function CreateCourse($params) {
        if(!empty($params['files'])){
            $params['image'] = $this->uploadFile($params['files']);
        }

        $c = new CourseModel($params);
        $result = BL::CreateEntity(CourseModel::tableName, $c->jsonSerialize());
        if(isset($params['ajax']) && $params['ajax'] == 'false'){
            header("Location: " .SITE_ROOT. "/index.php#school");
            exit();
        }
        return $result;
    }

    function UpdateCourse($params) {
        if(!empty($params['files'])){
            $params['image'] = $this->uploadFile($params['files']);
        }
        $c = new CourseModel($params);
        $result = BL::updateItemById(CourseModel::tableName, $params["id"], $c->jsonSerialize());
        if(isset($params['ajax']) && $params['ajax'] == 'false'){

            header("Location: " .SITE_ROOT. "/index.php#course:" . $params["id"]);
            exit();
        }
        return $result;
    }

    function getAllCourses() {
        return json_encode(BL::getAll(CourseModel::tableName));
    }

    function getCoursesCount() {
        return json_encode(BL::getCount(CourseModel::tableName));
    }

    function getCourseById($id) {
        $data =  BL::getOneById(CourseModel::tableName, $id);
        $students = BL::getStudentsByCourse($id);
        $data['students'] = $students;
        return $data;

    }

    function DeleteCourse($request_vars) {
      //  $c = new CourseModel($request_vars["id"]);
        BL::deleteItem(CourseModel::tableName, $request_vars["id"]);
        if(isset($request_vars['ajax']) && $request_vars['ajax'] == 'false'){
            header("Location: " .SITE_ROOT. "/index.php#school");
            exit();
        }
        return 0;
    }
}
?>
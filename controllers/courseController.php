<?php
require_once 'controller.php';
require_once '../models/courseModel.php';

class CourseController extends Controller {
    private $db;

    function __construct() {
        // $this->db = new BL();
    }

    function CreateCourse($params) {
        $d = new CourseModel($params);
        return BL::CreateEntity(courseModel::tableName, $d->jsonSerialize());
        //$this->db->CreateEntity($c);

    }

    function getAllCourses() {
        return json_encode(BL::getAll(CourseModel::tableName));
    }

    function getCourseById($params) {
        // CONNECT BL
//        $array = [
//            "id" => $id,
//            "name" => MD5($id)
//        ];
//
//        $d = new CourseModel($array);
//        return $d->jsonSerialize();

//        $d = new CourseModel($params);
        return BL::getOneById(CourseModel::tableName, $params);

    }


    function DeleteCourse($request_vars) {
      //  $d = new CourseModel($request_vars["id"]);
        return BL::deleteItem(CourseModel::tableName, $request_vars["id"]);
    }

    function UpdateCourse($request_vars) {
        $d = new CourseModel($request_vars);
        return BL::updateItemById(CourseModel::tableName, $request_vars["id"], $d->jsonSerialize());
    }
}
?>
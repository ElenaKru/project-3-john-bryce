<?php
require_once 'abstract-api.php';
require_once '../controllers/courseController.php';

class CourseApi extends Api{

    function Create($params) {
        $d = new CourseController;
        return $d->CreateCourse($params);
    }

    function Read($params) {
        $d = new CourseController;

        if (array_key_exists("id", $params)) {
            $course = $d->getCourseById($params["id"]);
            return json_encode($course, JSON_PRETTY_PRINT);
        }
        else {
            return $d->getAllCourses($params);
        }
    }
    function Update($params) {

        $d = new CourseController;
        return $d->UpdateCourse($params);
    }
    function Delete($params) {

        $d = new CourseController;
        return $d->DeleteCourse($params);
    }
}
?>
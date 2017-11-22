<?php
require_once 'abstract-api.php';
require_once '../controllers/courseController.php';

class CourseApi extends Api{

    function Create($params) {
        $c = new CourseController;
        return $c->CreateCourse($params);
    }

    function Read($params) {
        $c = new CourseController;

        if (array_key_exists("id", $params)) {
            $course = $c->getCourseById($params["id"]);
            return json_encode($course, JSON_PRETTY_PRINT);
        } elseif(array_key_exists("search", $params)){
            switch ($params["search"]){
                case 'count':
                    return $c->getCoursesCount();
                    break;
            }
        }
        else {
            return $c->getAllCourses();
        }
    }
    function Update($params) {
        $c = new CourseController;
        return $c->UpdateCourse($params);
    }
    function Delete($params) {

        $c = new CourseController;
        return $c->DeleteCourse($params);
    }
}
?>
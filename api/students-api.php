<?php
require_once 'abstract-api.php';
require_once '../controllers/studentController.php';

class StudentApi extends Api{

    function Create($params) {
        $s = new StudentController;
        return $s->CreateStudent($params);
    }

    function Read($params) {
        $s = new StudentController;

        if (array_key_exists("id", $params)) {
            $student = $s->getStudentById($params["id"]);
            return json_encode($student, JSON_PRETTY_PRINT);
        } elseif(array_key_exists("search", $params)){
            switch ($params["search"]){
                case 'count':
                    return $s->getStudentsCount();
                    break;
            }
        }
        else {
            return $s->getAllStudents();
        }
    }
    function Update($params) {

        $s = new StudentController;
        return $s->UpdateStudent($params);
    }
    function Delete($params) {

        $s = new StudentController;
        return $s->DeleteStudent($params);
    }
}
?>
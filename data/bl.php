<?php
require_once 'DAL.php';

class BL {

    public static function login($email, $password){
        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT * FROM `administrator` WHERE `email`= :email AND `password`= :password;');
        $stmt->execute(['email' => $email, 'password' => md5($password)]);
        $row = $stmt->fetch();
        return $row;
    }

    public static function CreateEntity($table, $model){
        $connection = DAL::getInstance();
        $db = $connection->getDB();
        $str1 = implode(",", array_keys($model));
        $str2 = ':' . implode(",:", array_keys($model)) ;
        $query = "INSERT INTO " .  $table . " (" . $str1 . ") values (" . $str2 . ")";
        $stmt = $db->prepare($query);
        $stmt->execute($model);

        $id = $db->lastInsertId();
        if($id){
            return $id;
        }

        return false;
    }



    public static function updateItemById($table, $id, $data){
        $connection = DAL::getInstance();
        $db = $connection->getDB();
        $strUpdate = '';
        unset($data['id']);
        foreach ($data as $key => $value){
            $strUpdate .= $key . ' = :' . $key . ',';
        }
        $strUpdate = substr($strUpdate, 0, -1);
       $query = 'UPDATE ' .  $table . ' SET ' . $strUpdate . ' WHERE id = :id';
//        var_dump($query);
//        die();
        $stmt = $db->prepare($query);
        $data['id'] = $id;
        $stmt->execute($data);

        return 0;
    }

    public static function updateStudentCourses($student, $courses){
        $connection = DAL::getInstance();
        $db = $connection->getDB();
        $query = "DELETE FROM courses_students WHERE student = :student";
        $stmt = $db->prepare($query);
        $stmt->execute(['student' => $student]);
        $strCourses ="";
        $arrCourses = [];
        $step = 0;

        foreach ($courses as $course){
            $strCourses .= "(:course" .$step. ", :student" .$step. "),";
            $arrCourses['course' . $step] = $course;
            $arrCourses['student' . $step] = $student;
                $step++;
        }
        if(!empty($strCourses)){
            $strCourses = substr($strCourses, 0,-1);
            $query = "INSERT INTO courses_students (course,student) VALUES " . $strCourses ;
            $stmt = $db->prepare($query);
            $stmt->execute($arrCourses);
        }

    }

    public static function getAll($table){

        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT * FROM ' .  $table);
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch())
        {
            $result[] = $row;
        }

        return $result;
    }

    public static function getOneById($table, $id){

        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT * FROM ' .  $table . ' WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row;
    }

    public static function getStudentsByCourse($id){

        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT student.*
                                FROM student
                                INNER JOIN courses_students ON student.id = courses_students.student
                                WHERE courses_students.course = :course');
        $stmt->execute(['course' => $id]);
        return $stmt->fetchAll();
    }

    public static function getCoursesByStudent($id){

        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT course.id
                                FROM course
                                INNER JOIN courses_students ON course.id = courses_students.course
                                WHERE courses_students.student = :student');
        $stmt->execute(['student' => $id]);
        return $stmt->fetchAll();
    }

    public static function getAllIds($table){

        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT id FROM ' .  $table . ' ORDER BY id');
        $stmt->execute();
        $result = [];
        while ($row = $stmt->fetch())
        {
            $result[] = $row;
        }

        return $result;
    }

    public static function deleteItem($table, $id){
        $connection = DAL::getInstance();
        $db = $connection->getDB();
        $stmt = $db->prepare('DELETE FROM ' .  $table . ' WHERE id = :id');

        $stmt->execute(['id' => $id]);
     //   $row = $stmt->fetch();
        return 0;
    }

    public static function getCount($table){

        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT COUNT(id) FROM ' .  $table);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    public static function setRoles(){

        $connection = DAL::getInstance();
        $db = $connection->getDB();

        $stmt = $db->prepare('SELECT * FROM role');
        $stmt->execute();
        $_SESSION['roles'] = [];
        while ($row = $stmt->fetch())
        {
            $_SESSION['roles'][$row['id']] = $row['name'];
        }
    }
}
?>
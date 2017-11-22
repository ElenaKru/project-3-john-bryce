<?php
    require_once '../www/autoload.php';
    require_once 'students-api.php';
    require_once 'courses-api.php';
    require_once 'users-api.php';
    session_start();
    $method = $_SERVER['REQUEST_METHOD']; // verb
    unset($_SESSION['error']);
//    echo 'here';
//    die();
    if(!empty($_REQUEST)){
//        var_dump($_REQUEST);
        $data = $_REQUEST;
    } else {
       // var_dump($_REQUEST);
        parse_str(file_get_contents("php://input"), $request_vars);
        $data = $request_vars;
     //   var_dump($request_vars);
    }

    if(!empty($_FILES) && !empty($_FILES['image']) && !empty($_FILES['image']['tmp_name'])){
        $data["files"] = $_FILES;
    }

    switch ($data["ctrl"]) {
        case 'course':
            $api = new CourseApi();
            echo $api->gateway($method, $data);
            break;
         case 'student':
             $api = new StudentApi();
             echo $api->gateway($method, $data);
             break;
         case 'user':
             $api = new UserApi();
             echo $api->gateway($method, $data);
             break;
    }
?>
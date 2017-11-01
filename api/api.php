<?php
    require_once 'courses-api.php';
    // require_once 'directors-api.php';
    // require_once 'movies-api.php';

    $method = $_SERVER['REQUEST_METHOD']; // verb


    if(!empty($_REQUEST)){
        $data = $_REQUEST;
    } else {
       // var_dump($_REQUEST);
        parse_str(file_get_contents("php://input"), $request_vars);
        $data = $request_vars;
     //   var_dump($request_vars);
    }

    switch ($data["ctrl"]) {
        case 'course':
            $api = new CourseApi();
            echo $api->gateway($method, $data);
            break;
        // case 'director':
        //     $api = new DirectorApi();
        //     echo $api->gateway($method, $data);
        //     break;
        // case 'movie':
        //     $api = new MovieApi();
        //     echo $api->gateway($method, $data);
        //     break;
    }
?>
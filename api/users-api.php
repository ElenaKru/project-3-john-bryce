<?php
require_once 'abstract-api.php';
require_once '../controllers/userController.php';

class UserApi extends Api{

    function Create($params) {
        $u = new UserController;
        return $u->CreateUser($params);
    }

    function Read($params) {
        $u = new UserController;

        if (array_key_exists("id", $params)) {
            $user = $u->getUserById($params["id"]);
            return json_encode($user, JSON_PRETTY_PRINT);
        } elseif(array_key_exists("search", $params)) {
            switch ($params["search"]) {
                case 'count':
                    return $u->getUsersCount();
                    break;
            }
        }
        else {
            return $u->getAllUsers($params);
        }
    }
    function Update($params) {

        $u = new UserController;
        return $u->UpdateUser($params);
    }
    function Delete($params) {

        $u = new UserController;
        return $u->DeleteUser($params);
    }
}
?>
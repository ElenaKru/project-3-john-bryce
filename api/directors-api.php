<?php
require_once 'abstract-api.php';
require_once '../controllers/directorController.php';

class DirectorApi extends Api{

    function Create($params) {
        $d = new DirectorController;
        return $d->CreateDirector($params);
    }

    function Read($params) {
        $d = new DirectorController;

        if (array_key_exists("id", $params)) {
            $director = $d->getDirectorById($params["id"]);
            return json_encode($director, JSON_PRETTY_PRINT);
        }
        else {
            return $d->getAllDirectors($params);
        }
    }
    function Update($params) {

        $d = new DirectorController;
        return $d->UpdateDirector($params);
    }
    function Delete($params) {

        $d = new DirectorController;
        return $d->DeleteDirector($params);
    }
}
?>
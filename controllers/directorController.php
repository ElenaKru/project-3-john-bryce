<?php
require_once 'controller.php';
require_once '../models/directorModel.php';

class DirectorController extends Controller {
    private $db;

    function __construct() {
        // $this->db = new BL();
    }

    function CreateDirector($params) {
        $d = new DirectorModel($params);
        return BL::CreateEntity(directorModel::tableName, $d->jsonSerialize());
        //$this->db->CreateEntity($c);

    }

    function getAllDirectors($params) {
        return json_encode(BL::getAll(DirectorModel::tableName));
    }

    function getDirectorById($params) {
        // CONNECT BL
//        $array = [
//            "id" => $id,
//            "name" => MD5($id)
//        ];
//
//        $d = new DirectorModel($array);
//        return $d->jsonSerialize();

//        $d = new DirectorModel($params);
        return BL::getOneById(DirectorModel::tableName, $params);

    }


    function DeleteDirector($request_vars) {
      //  $d = new DirectorModel($request_vars["id"]);
        return BL::deleteItem(DirectorModel::tableName, $request_vars["id"]);
    }

    function UpdateDirector($request_vars) {
        $d = new DirectorModel($request_vars);
        return BL::updateItemById(DirectorModel::tableName, $request_vars["id"], $d->jsonSerialize());
    }
}
?>
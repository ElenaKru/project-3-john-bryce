<?php 
    require_once 'controller.php';
    require_once '../models/movieModel.php';

    class MovieController extends Controller {
        private $db;

        function __construct() {
            // $this->db = new BL();
        }
        
        function CreateMovie($params) {
            $m = new MovieModel($params);
            return BL::CreateEntity(movieModel::tableName, $m->jsonSerialize());

        }

        function getAllMovies() {
            return json_encode(BL::getAll(MovieModel::tableName));
        }

        function getMovieById($params) {
            // CONNECT BL
//            $array = [
//                "id" => $id,
//                "name" => MD5($id)
//            ];
//
//            $m = new MovieModel($array);
//            return $m->jsonSerialize();

            //        $m = new MovieModel($params);
            return BL::getOneById(MovieModel::tableName, $params);
        }

        function DeleteMovie($request_vars) {
            //  $m = new MovieModel($request_vars["id"]);
            return BL::deleteItem(MovieModel::tableName, $request_vars["id"]);
        }

        function UpdateMovie($request_vars) {
            $m = new MovieModel($request_vars);
            return BL::updateItemById(MovieModel::tableName, $request_vars["id"], $m->jsonSerialize());
        }

    }
?>
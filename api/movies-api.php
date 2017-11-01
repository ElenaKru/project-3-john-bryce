<?php
    require_once 'abstract-api.php';
    require_once '../controllers/movieController.php';

    class MovieApi extends Api{

        function Create($params) {
            $m = new MovieController;
            return $m->CreateMovie($params);
        }

        function Read($params) {
            $m = new MovieController;

            if (array_key_exists("id", $params)) {

                $movie = $m->getMovieById($params["id"]);

                return json_encode($movie, JSON_PRETTY_PRINT);
            }
            else {

                return $m->getAllMovies($params);

            }
        }
         function Update($params) {

             $m = new MovieController;
             return $m->UpdateMovie($params);
         }
         function Delete($params) {

             $m = new MovieController;
             return $m->DeleteMovie($params);
         }
    }
?>
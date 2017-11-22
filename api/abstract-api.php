<?php
    abstract class Api {
        abstract function Create($params);
        abstract function Read($params);
        abstract function Update($params);
        abstract function Delete($params);

        public function gateway($method, $params) {
//            var_dump($method);
//            die();
            /* Some applications dealing with browsers that doesn't support PUT or DELETE methods use this trick, a hidden field from the html, with the value of ex.:*/

            if($method == "POST" && !empty($params['id'])){
                if(isset($params['action']) && $params['action'] == 'delete'){
                    $method = "DELETE";
                } else {
                    $method = "PUT";
                }
            }
            switch ($method) {
                case "POST":
                    return $this->Create($params);
                case "GET":
                    return  $this->Read($params);
                case "PUT":
                    return $this->Update($params);
                case "DELETE":
                    return $this->Delete($params);

            }
        }
    }
?>
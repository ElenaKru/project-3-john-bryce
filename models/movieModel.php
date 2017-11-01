<?php
    require_once 'model.php';
    
    class MovieModel extends Model implements JsonSerializable {
        private $id;
        private $name;
        private $d_id;
        const tableName = 'movies';
        function __construct($params) {
            // parent::__construct('Customer');
            
        //    $this->tableName = 'Customer';
//            $this->id = $params["id"];
            $this->name = $params["name"];
            $this->d_id = $params["d_id"];
            
        }

        public function jsonSerialize() {
            return [
                "id" => $this->id,
                "name" => $this->name,
                "d_id" => $this->d_id
            ];
        }
    }

?>
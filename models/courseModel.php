<?php
require_once 'model.php';

class CourseModel extends Model implements JsonSerializable {
    private $id;
    private $name;
    const tableName = 'course';
    function __construct($params) {
        // parent::__construct('Customer');

    //    $this->tableName = 'Customer';
        // $this->id = $params["id"];
        $this->name = $params["name"];

    }

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "name" => $this->name
        ];
    }
}

?>
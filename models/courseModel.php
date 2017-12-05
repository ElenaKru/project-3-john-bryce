<?php
require_once 'model.php';

class CourseModel extends Model implements JsonSerializable {
    private $id;
    private $name;
    private $description;
    private $image;
    const tableName = 'course';
    function __construct($params) {
        // parent::__construct('Customer');

    //    $this->tableName = 'Customer';
        // $this->id = $params["id"];
        $this->name = $params["name"];
        $this->description = $params["description"];
        $this->image = $params["image"];
    }

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "description" => $this->description,
            "image" => $this->image
        ];
    }
}
?>
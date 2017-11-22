<?php
require_once 'model.php';

class StudentModel extends Model implements JsonSerializable {
    private $id;
    private $name;
    private $phone;
    private $email;
    private $image;
    const tableName = 'student';
    const requiredFields = [
        'name',
        'phone',
        'email'
    ];
    function __construct($params) {
        // parent::__construct('Customer');

    //    $this->tableName = 'Customer';
        // $this->id = $params["id"];
        $this->name = $params["name"];
        $this->phone = $params["phone"];
        $this->email = $params["email"];
        $this->image = $params["image"];
    }

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "phone" => $this->phone,
            "email" => $this->email,
            "image" => $this->image
        ];
    }
}

?>
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
        if(isset($params['phone'])) {
            $this->phone = $params["phone"];
        }
        if(isset($params['email'])) {
            $this->email = $params["email"];
        }
        if(isset($params['image'])) {
            $this->image = $params["image"];
        }
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
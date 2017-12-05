<?php
require_once 'model.php';

class UserModel extends Model implements JsonSerializable {
    private $id;
    private $name;
    private $phone;
    private $email;
    private $role;
    private $image;
    const tableName = 'administrator';
    function __construct($params) {
        $this->id = $params['id'];
        $this->name = $params['name'];
        $this->role = $params['role'];

        if(isset($params['phone'])){
            $this->phone = $params['phone'];
        }
        if(isset($params['email'])){
            $this->email = $params['email'];
        }
        if(isset($params['image'])){
            $this->image = $params["image"];
        }
    }

    public function getName() {
        return $this->name;
    }

    public function getId() {
        return $this->id;
    }

    public function getRole() {
        return $this->role;
    }

    public function getRoleName() {
        return $_SESSION['roles'][$this->role];
    }

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "role" => $this->role,
            "phone"=>$this->phone,
            "email"=>$this->email,
            "roleName"=> $this->getRoleName(),
            "image" => $this->image
        ];
    }

    public function jsonSerializeForUpdate() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "role" => $this->role,
            "phone"=>$this->phone,
            "email"=>$this->email,
            "image" => $this->image
        ];
    }
}
?>
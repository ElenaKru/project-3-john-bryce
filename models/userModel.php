<?php
require_once 'model.php';

class UserModel extends Model implements JsonSerializable {
    private $id;
    private $name;
    private $email;
    private $role;
    const tableName = 'admin';
    function __construct($params) {
        $this->id = $params['id'];
        $this->name = $params['name'];
        $this->role = $params['role'];


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

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "role" => $this->role,
        ];
    }
}

?>
<?php
class DAL {
    private $db;
    private $host = '127.0.0.1';
    private $dbname   = 'theschool';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8';
    private static $instance; //The single instance

    private $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
        $this->db = new PDO($dsn, $this->user, $this->pass, $this->opt);
    }

    /*
	Get an instance
	@return Instance
	*/
    public static function getInstance() {
        if(!self::$instance) { // If no instance then make one
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __clone() { }

    public function getDB() {
        return $this->db;
    }
}
?>
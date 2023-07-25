<?php
namespace db;

use PDO;
use PDOException;

class Config
{

    private $host = 'localhost';
    private $username = 'root';
    private  $password = '';
    private $database = 'academy';

    public $db;

    public function __construct(){
        $this->db = new PDO("mysql:host = $this->host;dbname = $this->database" , $this->username , $this->password , array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }

}
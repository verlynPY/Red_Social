<?php
    

$server = 'localhost';
$username = 'root';
$passaword = '';
$database = 'red_social';

try {
    $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$passaword);
} catch (PDOExcepcion $e) {
    die('Connected failed '.$e->getMessage());
}


    class DB{

    public $server;
    public $username;
    public $passaword;
    public $database;
    
    public function __construct(){
        $this->server = 'localhost';
        $this->username = 'root';
        $this->passaword = '';
        $this->database = 'red_social';
    }
    
    function connect(){
        try{
        $conn = new PDO("mysql:host=$this->server;dbname=$this->database;",$this->username,$this->passaword);
        return $conn;
    }
    catch (PDOExcepcion $e) {
        die('Connected failed '.$e->getMessage());
      
    }
    
    }
    
    }
?>
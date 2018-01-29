<?php
class DatabaseConnect{

private $server = "localhost:3306";
private $username = "root";
private $password= "MySQL";
private $db="audiodb";
private $charset = 'utf8mb4';

private $pdo=null;

public function getPdo(){
    return $this->pdo;
}

private $opt=[
    PDO::ATTR_ERRMODE   => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

public function __construct(){
try{
    $this->pdo = new PDO("mysql:host=$this->server;dbname=$this->db;charset=$this->charset",$this->username,$this->password,$this->opt);
    //echo "connected to db";
}catch(PDOException $e) {
    die("Something went wrong in the database.");
    $e->getMessage();

}
}
}






?>
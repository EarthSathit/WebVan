<?php
class Database {
private $host = "localhost";
private $username = "root";
private $password = "";
private $dbname = "van_service";

public $conn;
public function getConnection(){
    try{
        $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->dbname,
                              $this->username,$this->password);
        $this->conn->exec("set names utf8");
    }catch(PDOException $e){
        echo"Connection Error! : ".$e->getMessage();
    }
   return $this->conn;
 }
}
?>

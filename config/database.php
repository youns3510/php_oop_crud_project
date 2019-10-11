<?php


class Database{
  //specify your own database credenials
  private $host = "localhost";
  private $db_name = "php_oop_crud";
  private $username = "php_oop_crud_user";
  private $password ="245OXXJzKt48dBbN";
  public $conn;

  // get the database connection
  public function getConnection(){
    $this->conn = null;
    try{
      $this->conn = new PDO("mysql:host=".$this->host.";dbname=" . $this->db_name, $this->username, $this->password);
    }catch(PDOException $exception){
      echo "Connection error: ".$exception->getMessage();
    }
      return $this->conn;
  }

}

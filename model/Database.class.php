<?php

class Database {
  private $host = "localhost";
  private $user = "root";
  private $password = "1";
  private $dbname = "tiki";
  private $dbh; //used for PDO connection
  private $stmt; //the SQL statement to be used
  private $error; //for catching errors that are thrown

  public function __construct(){
    // Connects to the database
    $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
    $options = array(
      PDO::ATTR_PERSISTENT =>true,
      PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION
    );
    //Run PDO
    try {
      $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
    } catch (PDOException $e) {
      $this->error = $e->getMessage();
      echo $this->error;
    }
  }
  public function prepQuery($sql){
    //prepares the query
    $this->stmt = $this->dbh->prepare($sql);
  }
  public function execute(){
    $this->stmt->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }
}

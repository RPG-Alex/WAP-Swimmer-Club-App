<?php

class Database {
  private $host = "localhost";
  private $user = "root";
  private $password = "1";
  private $dbname = "swim";
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
  public function bind($param, $value, $type = null){
    //This function can probably be redone? Dunno but if I keep it need ot attribute to Traversy
    if(is_null($type)){
      switch(true){
        case is_int($value):
          $type = PDO::PARAM_INT;
          break;
        case is_bool($value):
          $type = PDO::PARAM_BOOL;
          break;
        case is_null($value):
          $type = PDO::PARAM_NULL;
          break;
        default:
          $type = PDO::PARAM_STR;
      }
    }

    $this->stmt->bindValue($param, $value, $type);
  }
  public function execute(){
    return $this->stmt->execute();
  }
  public function fetchResults(){
    $this->execute();
    return $this->stmt->fetchAll(PDO::FETCH_OBJ);
  }
  public function fetchSingleResult(){
    $this->execute();
    return $this->stmt->fetch(PDO::FETCH_OBJ);
  }
}

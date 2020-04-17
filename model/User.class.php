<?php
class Users extends Database {
  private $db;
  private $credentials;
  public function __construct(){
    $this->db = new Database;
  }
  public function login(){
    if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])) {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $loginData =[
          'username' => trim($_POST['userid']),
          'password' => trim($_POST['password'])
        ];

    } else {
      // if this is triggered than the POST array is wrong somehow
      echo "Invalid Login Method";
    }
  }
}

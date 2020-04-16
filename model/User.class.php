<?php
class Users extends Database {

  public function login(){
    if ($_SERVER['REQUEST_METHOD']=='POST') {
      $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
      
    }
  }
}

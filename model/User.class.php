<?php
class Users extends Database {
  private $db;
  private $credentials;
  public function __construct(){
    $this->db = new Database;
  }
  public function login($loginData){
    //This function grabs data to use for verifying login and setting session variables
    $this->db->prepQuery('SELECT login.userID, hash, username, typeID FROM login INNER JOIN users_type WHERE login.username = :username AND login.userID = users_type.userID');
    $this->db->bind(':username',$loginData['username']);
    $userData = $this->db->fetchSingleResult();
    //This checks that a row was returned, if not it returns false, if the row returns but the password doesn't match, it will also return false (false is used in controller as a simple way to verify logged in status)
    if (isset($userData->hash)) {
      if (password_verify($loginData['password'],$userData->hash)) {
        return $userData;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  public function getType($userID){
    //Not sure I need this function but good to have anyway if I do?
    $this->db->prepQuery('SELECT * FROM users_type WHERE userID = :userID');
    $this->db->bind(':userID',$userID);
    $userType = $this->db->fetchSingleResult();
    return $userType;
  }
}

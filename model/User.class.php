<?php
class Users extends Database {
  private $db;
  private $credentials;
  public function __construct(){
    $this->db = new Database;
  }
  public function login($username,$password){
    //This function grabs data to use for verifying login and setting session variables
    $this->db->prepQuery('SELECT login.userID, hash, username, typeID FROM login INNER JOIN users_type WHERE login.username = :username AND login.userID = users_type.userID');
    $this->db->bind(':username',$username);
    $userData = $this->db->fetchSingleResult();
    //This checks that a row was returned, if not it returns false, if the row returns but the password doesn't match, it will also return false (false is used in controller as a simple way to verify logged in status)
    if (isset($userData->hash)) {
      if (password_verify($password,$userData->hash)) {
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
  public function registerUser($DOB,$fname,$sname,$address,$post,$email,$phone){
        $this->db->prepQuery('INSERT INTO users(DOB, fname, sname, address, post, email, phone) VALUES(:dob, :fname, :sname:, :address, :post, :email, :phone)');
        $this->db->bind(':dob', $DOB);
        $this->db->bind(':fname', $fname);
        $this->db->bind(':sname', $sname);
        $this->db->bind(':address', $address);
        $this->db->bind(':post', $post);
        $this->db->bind(':email', $email);
        $this->db->bind(':phone', $phone);
        if($this->db->execute()){
          return true;
        } else {
            return false;
          }
      }
  public function verifyEmptyUserName($userNameChoice){
    //This function is used to verify that a username is still avialable as they are meant to be unique
    $this->db->prepQuery('SELECT username FROM login WHERE username = :username');
    $this->db->bind(':username',$userNameChoice);
    $usernames = $this->db->fetchSingleResult();
    if (!isset($usernames->username)) {
      return true;
    } else {
      return false;
    }
  }
  public function getUserID($fname,$sname,$email){
    //Used to return the userID for a user (such as during the registration process to help propagate the database)
    $this->db->prepQuery('SELECT uid FROM users WHERE fname = :fname AND sname = :sname AND email = :email');
    $this->db->bind(':fname', $fname);
    $this->db->bind(':sname', $sname);
    $this->db->bind(':email', $email);
    $idData = $this->db->fetchSingleResult();
    if (isset($idData->uid)) {
      return $idData->uid;
    } else {
      return false;
    }
  }
  public function addLoginCredentials($userID,$password,$username){
    //First password is hashed then credentials are added to the database.
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $this->db->prepQuery('INSERT INTO login(userID, hash, username) VALUES(:userID, :hash, :username)');
    $this->db->bind(':userID', $userID);
    $this->db->bind(':hash',$hashedPassword);
    $this->db->bind(':username',$username);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getUserTypes(){
    //This grabs the usertype table, used for viewing and assigning user privileges
    $this->db->prepQuery('SELECT * FROM usertype');
    $userTypes = $this->db->fetchResults();
    if (isset($userTypes)) {
      return $userTypes;
    } else {
      return false;
    }
  }
  public function addTypeForUser($userID,$userType){
    $this->db->prepQuery('INSERT INTO users_type(userID, typeID) VALUES(:userID, :typeID)');
    $this->db->bind(':userID',$userID);
    $this->db->bind(':typeID',$userType);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
}

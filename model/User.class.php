<?php
class Users extends Database {
  private $db;
  private $credentials;
  public function __construct(){
    $this->db = new Database;
  }
  public function login($username,$password){
    //This function grabs data to use for verifying login and setting session variables
    $this->db->prepQuery('SELECT login.userID, hash, username, users.userTYPE FROM login INNER JOIN users WHERE login.username = :username AND login.userID = users.uid');
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
    $this->db->prepQuery('SELECT userTYPE FROM users WHERE userID = :userID');
    $this->db->bind(':userID',$userID);
    $userType = $this->db->fetchSingleResult();
    return $userType;
  }
  public function registerUser($DOB,$fname,$sname,$address,$post,$email,$phone, $userType){
        $this->db->prepQuery('INSERT INTO users(DOB, fname, sname, address, post, email, phone, userTYPE) VALUES(:dob, :fname, :sname, :address, :post, :email, :phone, :userType)');
        $this->db->bind(':dob', $DOB);
        $this->db->bind(':fname', $fname);
        $this->db->bind(':sname', $sname);
        $this->db->bind(':address', $address);
        $this->db->bind(':post', $post);
        $this->db->bind(':email', $email);
        $this->db->bind(':phone', $phone);
        $this->db->bind(':userType', $userType);
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
  public function regexInput($firstName,$lastName,$email,$address,$post,$pass1,$pass2,$phone,$dob,$username){
    if (!preg_match('/^[A-Z \'.-]{2,20}$/i',$firstName)) {
      return "<font color ='red'> Invalid First Name Please use only letters </font>";
    }else if (!preg_match('/^[A-Z \'.-]{2,40}$/i',$lastName)) {
      return "<font color ='red'> Invalid Last Name Please use only letters </font>";
    } else if (!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/',$email)){
      return "<font color ='red'> Invalid email, please input a valid email address </font>";
    } elseif (!preg_match('/^[#.0-9a-zA-Z\s,-]{2,100}+$/i',$address)) {
      return "<font color ='red'> Invalid address, please input a valid address </font>";
    } else if (!preg_match('/^\w{4,20}$/',$pass1) OR $pass1 != $pass2) {
      return "<font color='red'>Invalid Password Character or Passwords Do Not Match</font>";
    } else if (!preg_match('/^\d{7,14}$/',$phone)) {
      return "<font color='red'>Invalid Phone Number</font>";
    } else if (!preg_match('/^(0?[1-9]|1[012])[-](0?[1-9]|[12][0-9]|3[01])[-](19|20)?[0-9]{2}$/',$dob)) {
      return "<font color='red'>Invalid Birthday</font>";
    } else if (!preg_match('/^[A-Z \'.-]{2,20}$/i',$username)){
      return "<font color='red'>Invalid username</font>";
    } else {
      return true;
    }
  }
}

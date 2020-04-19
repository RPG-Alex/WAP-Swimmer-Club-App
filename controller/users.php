<?php

// Login and Registration Controller
if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['login'])) {
  include_once "model/Database.class.php";
  include_once "model/User.class.php";
  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $loginData =[
      'username' => trim($_POST['userid']),
      'password' => trim($_POST['password']) // Need to hash this password to query the DB
    ];
    $loggingIn = new Users;
    $loginAttempt= $loggingIn->login($loginData);

    if ($loginAttempt != false) {
      $loggedIn = $loginAttempt;
      //This starts the session only if their password works
      $_SESSION['user'] =  $loggedIn->username;
      $_SESSION['userID'] = $loggedIn->userID;
      $_SESSION['userType'] = $loggedIn->typeID;
    } else {
      //Updates the usermessage variable to let user know they have failed to log in correctly
      $userMessage = "Login attempt failed. Please try logging in again or contact the Administrator to reset your password";
    }
  } else if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])) {
    $registrationData = [
      'fname' => trim($_POST['first_name']),
      'sname' => trim($_POST['surname']),
      'address' => trim($_POST['address']),
      'post' => trim($_POST['postal_code']),
      'DOB' => trim($_POST['birthday']),
      'pass1' => trim($_POST['pass1']),
      'pass2' => trim($_POST['pass2'])
    ];
    include_once "model/Database.class.php";
    include_once "model/User.class.php";

  }

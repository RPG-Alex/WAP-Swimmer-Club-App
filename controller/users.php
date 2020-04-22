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
    $loginAttempt= $loggingIn->login($loginData['username'],$loginData['password']);

    if ($loginAttempt != false) {
      $loggedIn = $loginAttempt;
      //This starts the session only if their password works
      $_SESSION['user'] =  $loggedIn->username;
      $_SESSION['userID'] = $loggedIn->userID;
      $_SESSION['userType'] = $loggedIn->userTYPE;
    } else {
      //Updates the usermessage variable to let user know they have failed to log in correctly
      $userMessage = "Login attempt failed. Please try logging in again or contact the Administrator to reset your password";
    }
  } else if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])) {
    //This checks that fields are acceptable expressions
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    if (!preg_match('/^[A-Z \'.-]{2,20}$/i',$_POST['first_name']) OR !preg_match('/^[A-Z \'.-]{2,40}$/i',$_POST['surname'])) {
      $userMessage = "<font color='red'>Invalid first or last name pleas only use letters</font> ";
      $repopulateFields = $_POST;
    } else if (!preg_match('/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/',$_POST['email'])) {
      $userMessage = "<font color='red'> Invalid Email</font>";
      $repopulateFields = $_POST;
    } elseif (!preg_match('/^\w{4,20}$/',$_POST['pass1']) OR $_POST['pass1'] != $_POST['pass2']) {
      $userMessage = "<font color='red'>Invalid Password Character or Passwords Do Not Match</font>";
      $repopulateFields = $_POST;
    } else {
      include_once "model/Database.class.php";
      include_once "model/User.class.php";
      $registrationData = [
        'fname' => trim($_POST['first_name']),
        'sname' => trim($_POST['surname']),
        'address' => trim($_POST['address']),
        'post' => trim($_POST['postal_code']),
        'DOB' => trim($_POST['birthday']),
        'pass1' => trim($_POST['pass1']),
        'email' => trim($_POST['email']),
        'phone' => trim($_POST['phone']),
        'userID' => '',
        'username' => trim($_POST['username']),
        'usertype' => trim($_POST['userTypes'])
      ];
      $register = new Users();
      if ($register->verifyEmptyUserName($registrationData['username']) == false) {
        $userMessage = "<font color='red'> Username already taken</font>";
        $repopulateFields = $_POST;
      } else {
        if ($register->registerUser($registrationData['DOB'],$registrationData['fname'],$registrationData['sname'],$registrationData['address'],$registrationData['post'],$registrationData['email'],$registrationData['phone'],$registrationData['usertype']) == true) {
          $registrationData['userID'] = $register->getUserID($registrationData['fname'],$registrationData['sname'],$registrationData['email']);
          if ($registrationData['userID'] != false) {
            if ($register->addLoginCredentials($registrationData['userID'],$registrationData['pass1'],$registrationData['username']) == true) {
                $userMessage = "Successfully Registered!";
            } else {
            $userMessage = "<font color='red'>Adding Login Credentials has failed</font>";
            }
          }
        } else {
          $userMessage = "<font color='red'>Registration process has failed, Please contact System Admin</font>";
        }
      }
    }
  }

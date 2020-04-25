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
      $userMessage = "<font color='red'>Login attempt failed. Please try logging in again or contact the Administrator to reset your password</font>";
    }
  } else if ($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['register'])) {
    //This checks that fields are acceptable expressions
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    include_once "model/Database.class.php";
    include_once "model/User.class.php";
    $register = new Users();
    $regexCheck = $register->regexInput($_POST['first_name'],$_POST['surname'],$_POST['email'],$_POST['address'],$_POST['postal_code'],$_POST['pass1'],$_POST['pass2'],$_POST['phone'],$_POST['birthday'],$_POST['username']);
    if ($regexCheck !== true) {
      $repopulateFields = $_POST;
      $userMessage = $regexCheck;
    } else if ($regexCheck == true AND $register->verifyEmptyUserName($registrationData['username']) == false) {
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
      if ($register->registerUser($registrationData['DOB'],$registrationData['fname'],$registrationData['sname'],$registrationData['address'],$registrationData['post'],$registrationData['email'],$registrationData['phone'],$registrationData['usertype']) == true) {
        $registrationData['userID'] = $register->getUserID($registrationData['fname'],$registrationData['sname'],$registrationData['email']);
        if ($registrationData['userID'] != false) {
          if ($register->addLoginCredentials($registrationData['userID'],$registrationData['pass1'],$registrationData['username']) == true) {
              $userMessage = "Successfully Registered!";
          } else {
            $userMessage = "<font color='red'> Failed to Add login Credentials, contact Administrator</font>";
          }
      }
    } else {
      $userMessage = "<font color='red'> Username already taken</font>";
      $repopulateFields = $_POST;
    }
  }
}

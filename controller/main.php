<?php

$userMessage = ""; // User message used to load messages related to logging in/out and registering. Is updated in the users.php controller only!
include_once "controller/viewLoader.php";
$currentView = new View();
//Page View Controller
if (isset($_GET['page'])) {
  $pagePrivelege = $currentView->viewPagePrivilege($_GET['page']);
  if ($pagePrivelege == false) {
    $loadedView = $currentView->loadView($_GET['page']);
  } else if (!isset($_SESSION['userType']) AND $pagePrivelege != false) {
    $userMessage = "<font color='red'> You are not logged in and cannot view this content!</font> <a href='index.php?page=login'>Please log in.</a>";
  } elseif (isset($_SESSION['userType']) AND $_SESSION['userType'] > $pagePrivelege) {
    $userMessage = "<font color='red'>You do not have the privileges to edit this page. Please consult with your Administrator</font> ";
  }
    else if (isset($_SESSION['userType']) AND $_SESSION['userType'] <= $pagePrivelege){
    $loadedView = $currentView->loadView($_GET['page']);
  }
}


//Loads the correct controller
if (isset($_POST['register'])) {
  include_once "controller/users.php";
} else if (isset($_POST['login'])) {
  include_once "controller/users.php";
} else {
  include_once "controller/swim.php";
}
//Logs user out
if ($_SERVER['REQUEST_METHOD']== 'GET' && isset($_GET['logout'])) {
  if ($_GET['logout'] =='yes') {
    if (isset($_SESSION['user'])) {
      $userMessage = "You have successfully logged out!";
    } else {
      //This is in case a user tries to access this view when not logged in.
      $userMessage = "You have not yet logged in! So you cannot log out!";
    }
    session_destroy();
  }
}

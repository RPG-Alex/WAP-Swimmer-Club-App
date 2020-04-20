<?php
$userMessage = ""; // User message used to load messages related to logging in/out and registering. Is updated in the users.php controller only!
include_once "controller/viewLoader.php";
$currentView = new View();
if (isset($_GET['page'])) {
  $loadedView = $currentView->loadView($_GET['page']);

} else {
  $loadedView = $currentView->loadView('splash');
}

if (isset($_POST['register'])) {
  include_once "controller/users.php";
} else if (isset($_POST['login'])) {
  include_once "controller/users.php";
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

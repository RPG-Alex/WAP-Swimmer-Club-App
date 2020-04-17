<?php
include_once "controller/viewLoader.php";
$currentView = new View();
if (isset($_GET['page'])) {
  $currentView->loadView($_GET['page']);
} else {
  $currentView->loadView('splash');
}
if (isset($_POST['register'])) {
  include_once "controller/users.php";
  echo "users loaded";
}

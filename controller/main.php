<?php
include_once "controller/viewLoader.php";
$currentView = new View();
if (isset($_GET['page'])) {
  $currentView->loadView($_GET['page']);
} else {
  $currentView->loadView('splash');
}


var_dump($_POST);

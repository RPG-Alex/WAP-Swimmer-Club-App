<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
include_once "model/Database.class.php";
include_once "model/User.class.php";
$getTypes = new Users;
$userTypes = $getTypes->getUserTypes();
var_dump($userTypes) ;
foreach ($userTypes as $userType) {
  echo "option value ='$userType->usID'>$userType->usertype</option>";
}
/*$test = new Users();
$result = $test->getUserTypes();
foreach ($result as $key) {
  echo $key->usID;
  echo " ";
  echo $key->usertype;
}
*/
include_once "controller/constants.init.php";
include_once "controller/main.php";
include_once "view/all/header.php";
if (isset($loadedView)) {
  include_once $loadedView;
}
include_once "view/all/footer.php";
var_dump($_GET);

<?php
if (isset($_POST['register'])) {
  $registrationData = [
    'fname' => trim($_POST['first_name']),
    'sname' => trim($_POST['surname']),
    'address' => trim($_POST['address']),
    'post' => trim($_POST['postal_code']),
    'DOB' => trim($_POST['birthday']),
    'pass1' => trim($_POST['pass1']),
    'pass2' => trim($_POST['pass2'])
  ];
  include_once "model/User.class.php";
  
}

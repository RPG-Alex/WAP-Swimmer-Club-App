<?php
if ($_SESSION['userType'] =='1') {
include_once "controller/users.php";
  echo "<form class='register' action='' method='post'>
      <input type='text' name='first name' placeholder='first name' value='".$repopulateFields['first_name']."'>
      <input type='text' name='surname' placeholder='surname' value='".$repopulateFields['surname']."'>
      <input type= 'email' name='email' placeholder='email' value='".$repopulateFields['email']."'>
      <input type='text' name='address' placeholder='street address' value='".$repopulateFields['address']."'>
      <input type='text' name='postal code' placeholder='postal code' value='".$repopulateFields['postal_code']."'>
      <input type='tel' name='phone' placeholder = 'phone number' value='".$repopulateFields['phone']."'>
      <label> Date of Birth</label>
      <input type='date' name='birthday' placeholder='DOB' >
      <input type='password' name='pass1' placeholder='enter password'>
      <input type='password' name='pass2' placeholder='re-enter password'>
      <input type='text' name= 'username' placeholder='select a username' value='".$repopulateFields['username']."'>
      <label> User Type</label>
      <select id='userTypes' name='userTypes'>
        ";
  $getTypes = new Users;
  $userTypes = $getTypes->getUserTypes();
  foreach ($userTypes as $userType) {
    echo "<option value ='$userType->usID'>$userType->usertype</option>";
  }
    echo  "</select>
      <input type='reset' name='reset' value='reset form'>
      <input type='submit' name='register' value='register'>
    </form>";} else {
      //any direct attempt to access this view will just yield the folowing message when not logged in as admin
  echo "You do not have the privileges to view this page";
  }

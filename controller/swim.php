<?php
$repopulateFields = '';
//Control intensifies
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  //Instantiate new Swim Object
  include_once "model/Database.class.php";
  include_once "model/Swim.class.php";
  $swim = new Swim();
  //Burn it with fire
  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  //Perform actions based on what is posted
  if (isset($_POST['addRace'])) {
    //combine the date and time
    $date = New DateTime(trim($_POST['date']));
    $time = New DateTime(trim($_POST['time']));
    $dateTime = new DateTime($date->format('Y-m-d').''.$time->format('H:i:s'));
    // associate and sanitize input data
    $addRace = [
      'date-time' => $dateTime->format('Y-m-d H:i:s'),
      'name' => trim($_POST['name']),
      'locID' => trim($_POST['locations'])
    ];
    //Input to DB
    if ($swim->addRace($addRace['date-time'],$addRace['name'],$addRace['locID']) == true) {
      $userMessage = "Race Added";
      //can output the details here and show them in the race details. Then just copy this code for if the user selects a race
    } else {
      $userMessage = "<font color = 'red'> Unable to Add Race";
      $repopulateFields = $_POST;
    }
  } else if (isset($_POST['selectRace'])){

  } elseif (isset($_POST['updateRace'])) {
    // code...
  }
}

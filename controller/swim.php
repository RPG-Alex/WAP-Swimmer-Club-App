<?php
//Load Models
include_once "model/Database.class.php";
include_once "model/Swim.class.php";

//Variable used for repopulating forms and showing details for user
$repopulateFields = '';
//New Swim model called and can be invoked when needed
$swim = new Swim();
$allLocations = $swim->getAllLocations();

//Control intensifies -- this will only execute if post is called
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
      $raceInfo = $swim->getRace($addRace['name'],$addRace['date-time'],$addRace['locID']);
    } else {
      $userMessage = "<font color = 'red'> Unable to Add Race";
      $repopulateFields = $_POST;
    }
  } elseif (isset($_POST['updateRace'])) {
    $date = New DateTime(trim($_POST['date']));
    $time = New DateTime(trim($_POST['time']));
    $dateTime = new DateTime($date->format('Y-m-d').''.$time->format('H:i:s'));

    $updateRace = $swim->editRace($dateTime,$_POST['']);
  }
}

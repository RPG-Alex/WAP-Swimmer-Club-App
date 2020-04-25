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
    $addRace = [
      'date' => trim($_POST['date']),
      'name' => trim($_POST['name']),
      'locID' => trim($_POST['locations'])
    ];
    if ($swim->addRace($addRace['date'],$addRace['name'],$addRace['locID']) == true) {
      $userMessage = "Race Added";
    } else {
      $userMessage = "<font color = 'red'> Unable to Add Race";
      $repopulateFields = $_POST;
    }
  } else if (isset($_POST['addRace'])) {
    // code...
  } else if (isset($_POST['selectRace'])){

  } elseif (isset($_POST['updateRace'])) {
    // code...
  }
}

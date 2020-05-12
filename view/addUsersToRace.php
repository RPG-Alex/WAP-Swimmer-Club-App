<?php
$availableRaces = $swim->getAllRaces();

  if (isset($_POST['selectThisRace'])) {
    $raceDetails = $swim->getRaceDetailsByID($_POST['locations']);
    $addableRacers = $swim->getAllSwimmers();
    echo "
    <fieldset>
    <form class='' action='' method='post'>
      <input type='hidden' name='race' value='1'>
      <label>$raceDetails->raceName</label>
      <input type='hidden' name='raceid' value='$raceDetails->raceID'>";
    foreach ($addableRacers as $racer) {
      echo "<input type='checkbox' name='check_list[]' value='$racer->uid'>$racer->fname $racer->sname ";
    }
    echo "
      <input type='submit' name='addRacer' value='Add Swimmer'>
    </form>
    </fieldset>";
  } elseif (isset($_POST['addRacer'])) {
    foreach ($_POST['check_list'] as $racer) {
        $addRacer = $swim->addSwimmerToRace(trim($racer),trim($_POST['raceid']));
    }
    $RaceDetails = $swim->getRaceDetailsByID(trim($_POST['raceid']));

  }
  else {
    echo "<fieldset>
    <label for='raceSelect'><b>Select A Race</b></label>
    <form class= action='' method='post' name='raceSelect'>
      <select class='' name='locations' id='locations'>";
      foreach ($availableRaces as $race) {
        echo "<option value='$race->raceID'>$race->raceName</option>";
      }
      echo "
      </select>
      <input type='submit' name='selectThisRace' value='Select Race'>
    </form>
    </fieldset>";
  }
 ?>


<h1>Races</h1>
<div class="makeRace">
<fieldset>
  <fieldset>
  <h3>Add a New Race</h3>
  <form class="" action="" method="post" id="addRace">
    <label for="addRace">Add a new race</label>
    <input type="date" name="date" value="">
    <input type="time" name="time" value="">
    <input type="text" name="name" value="" placeholder="name">
    <label for="locations">Locations</label>
    <select class="" name="locations" id="locations">
      <?php foreach ($allLocations as $location) {
        echo "<option value='$location->locID'>$location->name</option>";
      } ?>
    </select>
    <input type="submit" name="addRace" value="add Race">
  </form>
  </fieldset>
    <?php
    if (isset($_POST['selectRace']) OR isset($_POST['addRace'])) {
      if (!isset($raceInfo)) {
        $raceInfo = $swim->getRaceDetailsByID($_POST['race']);
      }
      $DateTime = New DateTime($raceInfo->date);
      $raceDate = $DateTime->format ('Y-m-d');
      $raceTime = $DateTime->format('H:i:s');
      foreach ($allLocations as $singleLocation) {
        if ($singleLocation->locID == $raceInfo->location) {
          $raceLocationName = $singleLocation->name;
          $raceLocationAddress = $singleLocation->address;
          $raceLocationPhone = $singleLocation->phone;
        }
      }
      echo "<fieldset>
        <table>
          <tr>
            <td><th>Race Details</th></td>
            <td></td>
          </tr>
          <tr>
            <td>Race Name: </td>
            <td>$raceInfo->raceName</td>
          </tr>
          <tr>
            <td>Race Location: </td>
            <td>$raceLocationName</td>
          </tr>
          <tr>
            <td>Race Date: </td>
            <td>$raceDate</td>
          </tr>
          <tr>
            <td>Race Time: </td>
            <td>$raceTime</td>
          </tr>
          <tr>
            <td> Location Address: </td>
            <td> $raceLocationAddress</td>

          </tr>
          <tr>
            <td> Location Phone: </td>
            <td> $raceLocationPhone</td>
          </tr>
        </table>
      </fieldset>";
    }

     ?>
</fieldset>
</div>
<div class="editRace">
<fieldset>
<fieldset>
  <h3>Select A Race to View/Edit</h3>
<form class="" action="" method="post" >
  <?php
  $races = $swim->getAllRaces();
   ?>
  <select id="race" name='race'>
    <label for="race"></label>
    <?php
    foreach ($races as $race) {
      echo "<option value='$race->raceID'>$race->raceName</option>";
    }
     ?>
  </select>
  <input type="submit" name="selectRace" value="Select Race">
</form>
</fieldset>

<?php
  if (isset($_POST['selectRace'])) {
      foreach ($allLocations as $singleLocation) {
        if ($singleLocation->locID == $raceInfo->location) {
          $raceLocationName = $singleLocation->name;
          $raceLocationID = $singleLocation->locID;
        }
      }
    echo "<fieldset>
    <h3>Update Race Details</h3>
    <form class='' action='' method='post' id='addRace'>
      <label for='addRace'>Update Race Details</label>
      <input type='date' name='date' value='$raceDate'>
      <input type='time' name='time' value='$raceTime'>
      <input type='hidden' name='raceID' value='$raceInfo->raceID'>
      <input type='text' name='name' value='$raceInfo->raceName' placeholder='name'>
      <label for='locations'>Locations</label>
      <select  name='location' id='locations'>
      <option value='$raceLocationID' selected='selected'>$raceLocationName</option>";
      foreach ($allLocations as $location) {
        if ($location->locID != $raceLocationID) {
          echo "<option value='$location->locID'>$location->name</option>";
        }
      }
    echo "</select>
      <input type='submit' name='updateRace' value='update Race'>
    </form>
    </fieldset>";
  }

 ?>

</fieldset>
</div>
<fieldset>
<h3>Add Users to Race:</h3>

<?php
$availableRaces = $swim->getAllRaces();

  if (isset($_POST['selectThisRace'])) {
    $raceDetails = $swim->getRaceDetailsByID($_POST['locations']);
    $addableRacers = $swim->getAllSwimmers();
    echo "
    <fieldset>
    <form class='' action='' method='post'>
      <input type='hidden' name='race' value='1'>
      <label>$raceDetails->raceName </label>
      <input type='hidden' name='raceid' value='$raceDetails->raceID'><ui style='list-style:none;'>";

      // this converts all the racer ids to one array for comparing to racers to add. If the id is a match, it will not list it
      $swimmersOnRace = $swim->getRaceResults($raceDetails->raceID);
      $alreadyOnRace = null;
      foreach ($swimmersOnRace as $individuals) {
        if (!isset($alreadyOnRace)) {
          $alreadyOnRace = [$individuals->swimID];
        } else {
          array_push($alreadyOnRace,$individuals->swimID);
        }
      }
    foreach ($addableRacers as $racer) {
      //this only lets the user add racers that are not on that race!
        if (in_array($racer->uid,$alreadyOnRace)) {
          echo "<li><b>$racer->fname $racer->sname</b> is already on the race!</li>";
        } else {
          echo "<li><input type='checkbox' name='check_list[]' value='$racer->uid'>$racer->fname $racer->sname </li>";
        }

      }
    echo "</ul>
      <input type='submit' name='addRacer' value='Add Swimmer'>
    </form>
    </fieldset>";

  } elseif (isset($_POST['addRacer'])) {
    foreach ($_POST['check_list'] as $racer) {
        $addRacer = $swim->addSwimmerToRace(trim($racer),trim($_POST['raceid']));
    }
    $RaceDetails = $swim->getRaceDetailsByID(trim($_POST['raceid']));
    echo "Racers Added! Window Will Refresh Shortly";
    echo "<script>
         setTimeout(function(){
            window.location.href = 'http://localhost/WAP-Swimmer-Club-App/index.php?page=editRace';
         }, 5000);
      </script>";
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
</fieldset>

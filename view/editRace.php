
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
    if (isset($raceInfo)) {
      foreach ($allLocations as $singleLocation) {
        if ($singleLocation->locID == $raceInfo->location) {
          $raceLocationName = $singleLocation->name;
        }
      }
      $DateTime = New DateTime($raceInfo->date);
      $raceDate = $DateTime->format ('Y-m-d');
      $raceTime = $DateTime->format('H:i:s');
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
        </table>
      </fieldset>";
    } elseif (isset($_POST['selectRace'])) {
      $raceInfo = $swim->getRaceDetailsByID($_POST['race']);
      $DateTime = New DateTime($raceInfo->date);
      $raceDate = $DateTime->format ('Y-m-d');
      $raceTime = $DateTime->format('H:i:s');
      foreach ($allLocations as $singleLocation) {
        if ($singleLocation->locID == $raceInfo->location) {
          $raceLocationName = $singleLocation->name;
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
        </table>
      </fieldset>";
    }
     ?>
</fieldset>
</div>
<div class="editRace">
<fieldset>
<fieldset>
  <h3>Select A Race to Edit</h3>
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

<fieldset>
<h3>Update Race Details</h3>
<form class="" action="" method="post" id="addRace">
  <label for="addRace">Add a new race</label>
  <input type="date" name="name" value="">
  <input type="text" name="name" value="" placeholder="name">
  <label for="locations">Locations</label>
  <select class="" name="" id="locations">
    <option value=""> option one</option>
  </select>
  <input type="submit" name="updateRace" value="update Race">
</form>
</fieldset>
</fieldset>
</div>

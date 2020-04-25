<?php
include_once "model/Database.class.php";
include_once "model/Swim.class.php";
$locationGetter = new Swim();
$allLocations = $locationGetter->getAllLocations();

?>

<h1>Races</h1>
<fieldset>
<h3>Add a New Race</h3>
<form class="" action="" method="post" id="addRace">
  <label for="addRace">Add a new race</label>
  <input type="date" name="date" value="">
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
<fieldset>
  <h3>Edit A Race's Details</h3>
<form class="" action="" method="post" >
  <select id="race" name='race'>
    <label for="race"></label>
    <option value='race'>race</option>
    <option value='race'>race</option>
  </select>
  <input type="submit" name="selectRace" value="select Race">
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

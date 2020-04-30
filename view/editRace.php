<?php
include_once "model/Database.class.php";
include_once "model/Swim.class.php";
$locationGetter = new Swim();
$allLocations = $locationGetter->getAllLocations();

?>

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
    <fieldset>
      <table>
        <tr>
          <td><th>Race Details</th></td>
          <td></td>
        </tr>
        <tr>
          <td>Race Name: </td>
          <td></td>
        </tr>
        <tr>
          <td>Race Location: </td>
          <td></td>
        </tr>
        <tr>
          <td>Race Date: </td>
          <td></td>
        </tr>
        <tr>
          <td>Race Time: </td>
          <td></td>
        </tr>
      </table>
    </fieldset>
</fieldset>
</div>
<div class="editRace">
<fieldset>
<fieldset>
  <h3>Select A Race to Edit</h3>
<form class="" action="" method="post" >
  <select id="race" name='race'>
    <label for="race"></label>
    <option value='race'>race</option>
    <option value='race'>race</option>
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

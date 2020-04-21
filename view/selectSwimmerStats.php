<form class="" action="" method="post">
  <fieldset>
    <table>
      <th>Select</th><th>Swimmer name</th>
      <tr>
        <td>
            <input type="checkbox" name="swimmer" value="swimmer">
        </td> <td>Swimmer Name</td>
      </tr>
      <tr>
        <td>
            <input type="checkbox" name="swimmer2" value="swimmer2">
        </td> <td>Swimmer Name</td>
      </tr>
    </table>
    <label for="startDate">Select Start Date</label> <input id='startDate' type="date" name="startDate">
    <label for="endDate">Select End Date</label> <input id='endDate' type="date" name="endDate">
  </fieldset>
  <fieldset>
      <input type="checkbox" name="race" value="race">Race Data
      <input type="checkbox" name="practice" value="practice"> Practice Data
      <input type="submit" name="view" value="view">
  </fieldset>
</form>
<?php
var_dump($_POST);

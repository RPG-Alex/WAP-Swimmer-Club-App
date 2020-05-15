<?php
$swimmers = $swim->getAllSwimmers();

 ?>

<form class='' action='' method='post'>
    <ul style='list-style:none;'>
      <li><input type="date" name="practiceDate" ></li>
      <select multiple='yes' name='swimmers[]'>
      <?php foreach ($swimmers as $swimmer): ?>
        <option value='<?php echo $swimmer->uid; ?>'><?php echo $swimmer->fname." ".$swimmer->sname ?></option>
      <?php endforeach; ?>
      </select>
    <li><select id="location" name='location'>
      <?php foreach ($allLocations as $location): ?>
        <option value='<?php echo $location->locID ?>'><?php echo $location->name; ?></option>
      <?php endforeach; ?>
      </li>
    <li><input type='submit' name='addPractice' value='Add Practice'></li>
    </ul>
</form>

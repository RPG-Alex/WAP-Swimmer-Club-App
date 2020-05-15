<?php
$raceSelection = $swim->getAllRaces();
//$practiceSelection = $swim->getAllPractices(); //needs to be implmeneted
 ?>

<?php if (!isset($_GET['type'])): ?>
<fieldset>
  <h3>Add Race or Practice Results?</h3>
  <table>
    <th><form class="" action="index.php?page=addRaceResults&type=race" method="post">
      <input type="submit" name="race" value="race">
    </form></th>
    <th><form class="" action="index.php?page=addRaceResults&type=practice" method="post">
      <input type="submit" name="practice" value="practice">
    </form></th>
  </table>
</fieldset>
<?php endif; ?>
<?php if ($_GET['type'] == 'race' && !isset($_GET['raceID'])): ?>
<fieldset>
  <ul>
  <?php foreach ($raceSelection as $race): ?>
    <li><a href="index.php?page=addRaceResults&type=race&raceID=<?php echo $race->raceID ?>"><?php echo $race->raceName ?></a></li>
  <?php endforeach; ?>
  </ul>

</fieldset>
<?php endif; ?>
<?php if ($_GET['type'] == 'race' && isset($_GET['raceID'])): ?>
  <fieldset>

    <?php
    $resultsAlreadyHave = $swim->getRaceResults($_GET['raceID']);

    $raceDetails = $swim->getRaceDetailsByID($_GET['raceID']);
    ?>
    <h3>Add Race Results For Race: <?php echo $raceDetails->raceName; ?></h3>
    <h4>Note you do not need to add all 10 laps. Only add the laps recorded</h4>
    <h4>Please Record values as a decimal: minutes.seconds </h4>
    <fieldset>
      <?php foreach ($resultsAlreadyHave as $individualsOnThisRace): ?>
        <form class="" action="index.php?page=addRaceResults&type=race&raceID=<?php echo $_GET['raceID'] ?>" method="post">
          <table><th><font color="blue"><?php echo $individualsOnThisRace->sname.", ".$individualsOnThisRace->fname; ?></font></th>
          <tr><td><b>Lap 1</b> <input type="number" step="0.01" min="0" max="10" name="lap1" value="<?php echo $individualsOnThisRace->lap1; ?>"></td></tr>
          <tr><td><b>Lap 2</b> <input type="number" step="0.01" min="0" max="10" name="lap2" value="<?php echo $individualsOnThisRace->lap2; ?>"></td></tr>
          <tr><td><b>Lap 3</b> <input type="number" step="0.01" min="0" max="10" name="lap3" value="<?php echo $individualsOnThisRace->lap3; ?>"></td></tr>
          <tr><td><b>Lap 4</b> <input type="number" step="0.01" min="0" max="10" name="lap4" value="<?php echo $individualsOnThisRace->lap4; ?>"></td></tr>
          <tr><td><b>Lap 5</b> <input type="number" step="0.01" min="0" max="10" name="lap5" value="<?php echo $individualsOnThisRace->lap5; ?>"></td></tr>
          <tr><td><b>Lap 6</b> <input type="number" step="0.01" min="0" max="10" name="lap6" value="<?php echo $individualsOnThisRace->lap6; ?>"></td></tr>
          <tr><td><b>Lap 7</b> <input type="number" step="0.01" min="0" max="10" name="lap7" value="<?php echo $individualsOnThisRace->lap7; ?>"></td></tr>
          <tr><td><b>Lap 8</b> <input type="number" step="0.01" min="0" max="10" name="lap8" value="<?php echo $individualsOnThisRace->lap8; ?>"></td></tr>
          <tr><td><b>Lap 9</b> <input type="number" step="0.01" min="0" max="10" name="lap9" value="<?php echo $individualsOnThisRace->lap9; ?>"></td></tr>
          <input type="hidden" name="swimmerID" value="<?php echo $individualsOnThisRace->uid; ?>">
          <tr><td><b>Lap 10</b><input type="number" step="0.01" min="0" max="10" name="lap10" name="lap10" value="<?php echo $individualsOnThisRace->lap10; ?>"></td></tr>
          <tr><td><input type="submit" name="addUserRaceResults" value="Add Results"></td></tr></table>
        </form>
        <hr>
      <?php endforeach; ?>
    </fieldset>
  </fieldset>

<?php endif; ?>


<?php //  THIS NEEDS TO BE WORKED ON!
if ($_GET['type'] == 'practice'&& !isset($_GET['raceID'])): ?>
  <form class="" action="index.php?page=addRaceResults&type=practice" method="post">
    <input type="date" name="practiceDate" >
    <input type="submit" name="selectPracticeDate" value="Select Date">
  </form>
  <?php if (isset($_POST['practiceDate'])){
    header("Location: index.php?page=addRaceResults&type=practice&date=".$_POST['practiceDate']);
  }
   ?>
   <?php if (isset($_GET['date']) && $_GET['date'] != ""): ?>


    <fieldset>

      <?php
      $practiceDate = $swim->getPracticeByDate($_GET['date']);

      if ($practiceDate == false) {
        echo "No practices are on this date";
      } else {
        $practiceDetails = $swim->getAllPracticeResults($_GET['date']);
      }

      ?>
      <h3>Add Results For This Practice Date: <?php echo $_GET['date']; ?></h3>
      <h4>Note you do not need to add all 10 laps. Only add the laps recorded</h4>
      <h4>Please Record values as a decimal: minutes.seconds </h4>
      <fieldset>

        <?php foreach ($practiceDetails as $individualSwimmers): ?>
          <form class="" action="index.php?page=addRaceResults&type=practice&date=<?php echo $_GET['date'] ?>" method="post">
            <table><th><font color="blue"><?php echo $individualSwimmers->sname.", ".$individualSwimmers->fname; ?></font></th>
            <tr><td><b>Lap 1</b> <input type="number" step="0.01" min="0" max="10" name="lap1" value="<?php echo $individualSwimmers->lap1; ?>"></td></tr>
            <tr><td><b>Lap 2</b> <input type="number" step="0.01" min="0" max="10" name="lap2" value="<?php echo $individualSwimmers->lap2; ?>"></td></tr>
            <tr><td><b>Lap 3</b> <input type="number" step="0.01" min="0" max="10" name="lap3" value="<?php echo $individualSwimmers->lap3; ?>"></td></tr>
            <tr><td><b>Lap 4</b> <input type="number" step="0.01" min="0" max="10" name="lap4" value="<?php echo $individualSwimmers->lap4; ?>"></td></tr>
            <tr><td><b>Lap 5</b> <input type="number" step="0.01" min="0" max="10" name="lap5" value="<?php echo $individualSwimmers->lap5; ?>"></td></tr>
            <tr><td><b>Lap 6</b> <input type="number" step="0.01" min="0" max="10" name="lap6" value="<?php echo $individualSwimmers->lap6; ?>"></td></tr>
            <tr><td><b>Lap 7</b> <input type="number" step="0.01" min="0" max="10" name="lap7" value="<?php echo $individualSwimmers->lap7; ?>"></td></tr>
            <tr><td><b>Lap 8</b> <input type="number" step="0.01" min="0" max="10" name="lap8" value="<?php echo $individualSwimmers->lap8; ?>"></td></tr>
            <tr><td><b>Lap 9</b> <input type="number" step="0.01" min="0" max="10" name="lap9" value="<?php echo $individualSwimmers->lap9; ?>"></td></tr>
            <input type="hidden" name="swimmerID" value="<?php echo $individualSwimmers->uid; ?>">
            <input type="hidden" name="practiceID" value="<?php echo $individualSwimmers->praID ?>">
            <tr><td><b>Lap 10</b><input type="number" step="0.01" min="0" max="10" name="lap10" name="lap10" value="<?php echo $individualSwimmers->lap10; ?>"></td></tr>
            <tr><td><input type="submit" name="addUserPracticeResults" value="Add Results"></td></tr></table>
          </form>
          <hr>
        <?php endforeach; ?>
      </fieldset>
    </fieldset>
  <?php endif; ?>
<?php endif;  ?>

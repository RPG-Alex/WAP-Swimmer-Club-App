<?php
//This will get the details for all swimmers
$swimmers = $swim->getAllSwimmers();

 ?>
<fieldset>
  <h2>All Swimmers:</h2>
  <table>
    <th>swimmers</th>
    <?php
      foreach ($swimmers as $swimmer) {
        echo "<tr>
          <td><a href='index.php?page=viewUserInfo&id=$swimmer->uid'>$swimmer->fname $swimmer->sname</a></td>
        </tr>";
      }
     ?>
  </table>
</fieldset>
<fieldset>
  <h2>Select Swimmers to Compare!</h2>
  <form class="" action="index.php?page=viewSwimmers&compare=true" method="post">
    <ul style='list-style:none;'>
      <?php foreach ($swimmers as $swimmer): ?>
        <li> <input type="checkbox" name="check_list[]" value="<?php echo $swimmer->uid ?>"><?php echo $swimmer->sname.", ".$swimmer->fname; ?></li>
      <?php endforeach; ?>
      <input type="submit" name="compare" value="compare">
    </ul>
  </form>
  <?php if (isset($_POST['compare']) && $_GET['compare']==true): ?>

    <fieldset>
      <table>
        <?php foreach ($_POST['check_list'] as $toBeCompared): ?>
          <?php foreach ($swimmers as $swimmer): ?>
            <?php if ($swimmer->uid == $toBeCompared): ?>
              <h3>Race Data For: <b><?php echo $swimmer->sname.", ".$swimmer->fname; ?></b></h3>
              <hr>

                <?php $swimmerRaceData = $swim->getSwimmerRaceStats($swimmer->uid); ?>
                <?php foreach ($swimmerRaceData as $race): ?>
                    <h4>Race: <?php echo $race->raceName; ?> </h4>
                    <p>Lap 1: <?php echo $race->lap1; ?> | Lap 2: <?php echo $race->lap2; ?> | Lap 3: <?php echo $race->lap3; ?> | Lap 4: <?php echo $race->lap4; ?> | Lap 5: <?php echo $race->lap6; ?> | Lap 6: <?php echo $race->lap6; ?> | Lap 7: <?php echo $race->lap7; ?> | Lap 8: <?php echo $race->lap8; ?> | Lap 9: <?php echo $race->lap9; ?> | Lap 10: <?php echo $race->lap10; ?> | </p>
                <?php endforeach; ?>
                <hr>
              <h3>Practice Data For: <b><?php echo $swimmer->sname.", ".$swimmer->fname; ?></b></h3>
              <hr>
              <?php $swimmerPracticeData = $swim->getSwimmerPracticeStats($swimmer->uid); ?>
              <?php foreach ($swimmerPracticeData as $swimmerPractice): ?>
                <h4>Practice Date: <?php echo $swimmerPractice->date; ?> </h4>
                <p>Lap 1: <?php echo $swimmerPractice->lap1; ?> | Lap 2: <?php echo $swimmerPractice->lap2; ?> | Lap 3: <?php echo $swimmerPractice->lap3; ?> | Lap 4: <?php echo $swimmerPractice->lap4; ?> | Lap 5: <?php echo $swimmerPractice->lap6; ?> | Lap 6: <?php echo $swimmerPractice->lap6; ?> | Lap 7: <?php echo $swimmerPractice->lap7; ?> | Lap 8: <?php echo $swimmerPractice->lap8; ?> | Lap 9: <?php echo $swimmerPractice->lap9; ?> | Lap 10: <?php echo $swimmerPractice->lap10; ?> | </p>
              <?php endforeach; ?>
            <?php endif; ?>

          <?php endforeach; ?>

        <?php endforeach; ?>
      </table>
    </fieldset>
  <?php endif; ?>
</fieldset>

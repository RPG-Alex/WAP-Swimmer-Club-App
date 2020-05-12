<?php
//This will get the details for all swimmers
$swimmers = $swim->getAllSwimmers();




 ?>
<h2>All Swimmers:</h2>
<table>
  <th>swimmers</th>
  <?php
    foreach ($swimmers as $swimmer) {
      echo "<tr>
        <td><a href='index.php?page=viewSwimmers&amp;id=$swimmer->uid'>$swimmer->fname $swimmer->sname</a></td>
      </tr>";
    }
   ?>
</table>


<h2>Swimmer Details:</h2>
<p><b></b></p>
<p><b></b></p>
<p><b></b></p>
<p><b></b></p>

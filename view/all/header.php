<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITENAME; ?></title>
  </head>
  <body>
<header>
  <?php
  echo "<div class='navbar'><a href='index.php'>".SITENAME."</a> ";
  if (!isset($_SESSION['user']) OR (isset($_GET['page']) && $_GET['page'] == 'logout')) {
    echo "<a href='index.php?page=login'>Log in</a>";
  } else {
    echo "Welcome <b>". $_SESSION['user']."!</b> <a href='index.php'>Log out</a>";
    if ($_SESSION['userType'] == '1') {
      //Regisration is only available to admin
      echo " Admin: <a href='index.php?page=register'>Register a new swimmer</a>";
    }
  }
   ?>
 </div>

</header>
<?php
  echo $userMessage;
 ?>

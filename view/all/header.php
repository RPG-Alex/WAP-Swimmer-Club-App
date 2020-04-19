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
    echo "<a href='index.php?page=login'>Log in</a>
    <a href='index.php?page=register'>Register</a>";
  } else {
    echo "Welcome ". $_SESSION['user']."! <a href='index.php?page=logout'>Log out</a>";
  }
   ?>
 </div>

</header>
<?php
  echo $userMessage;
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo SITENAME; ?></title>
  </head>
  <body>
<header>
  <?php
  echo "<div class='navbar'>".SITENAME." ";
  if ($_GET['page']=='home') {
    echo "<a href='?page=login'>Login</a></div>";
  } else {
    echo "<a href='?page=home'>Logout</a></div>";
  }
   ?>
</header>
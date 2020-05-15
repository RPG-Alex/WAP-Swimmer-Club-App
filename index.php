<?php
session_start();

include_once "controller/constants.init.php";
include_once "controller/main.php";
include_once "view/all/header.php";
if (isset($loadedView)) {
  include_once $loadedView;
}
include_once "view/all/footer.php";

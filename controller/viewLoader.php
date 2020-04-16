<?php
class View {
  private $view;

  public function __construct(){

  }
  public function loadView($view){
    if (file_exists('view/'.$view.'.php')) {
      include_once "view/all/header.php";
      include_once 'view/'.$view.'.php';
      include_once "view/all/footer.php";
    } else {
      //This will load the splash page if the a view is requested that doesnt exist.
      include_once "view/all/header.php";
      include_once 'view/splash.php';
      include_once "view/all/footer.php";
    }
  }

}

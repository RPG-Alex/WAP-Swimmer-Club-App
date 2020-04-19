<?php
class View {
  private $getView;

  public function loadView($view){
    if (file_exists('view/'.$view.'.php')) {
      $this->getView = 'view/'.$view.'.php';
      return $this->getView;

    } else {
      //This will load the splash page if the a view is requested that doesnt exist.
      $this->getView = 'view/splash.php';
      return $this->getView;
    }
  }
}

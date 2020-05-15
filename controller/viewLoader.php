<?php
class View {
  private $getView;
  private     $viewPrivileges = [
        'addPractice' => 2,
        'addRaceResults' => 2,
        'addUsersToRace' =>2,
        'editRace' =>2,
        'register' => 1,
        'selectSwimmerStats' => 4,
        'swimStats' => 4,
        'updateSwimmer' =>3,
        'viewSwimmers' => 4,
        'viewUserInfo' =>4
      ];
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
  public function viewPrivileges($userType,$viewToLoad){
    if (isset($this->viewPrivileges[$viewToLoad])) {
      if ($userType >= $$this->viewPrivileges[$viewToLoad]) {
        return true;
      } else {
        return false;
      }
    } else {
      return false;
    }
  }
  public function viewPagePrivilege($viewToCheck){
    if (isset($this->viewPrivileges[$viewToCheck])) {
      return $this->viewPrivileges[$viewToCheck];
    } else {
      return false;
    }
  }
  public function getViewsArray(){

    return $this->viewPrivileges;
  }
}

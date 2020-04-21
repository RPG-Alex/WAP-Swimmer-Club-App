<?php
class Swim extends Database {
  private $db;

  public function __construct(){
    $this->db = new Database;
  }
  public function addLocation($name,$address,$phone = null){
    $this->db->prepQuery('INSERT INTO raceLocations(name,address,phone) VALUES(:name, :address, :phone)');
    $this->db->bind(':name',$name);
    $this->db->bind(':address',$address);
    $this->db->bind(':phone',$phone);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getAllLocations(){
    $this->db->prepQuery('SELECT * FROM raceLocations');
    return $this->db->fetchResults();
  }
  public function addRace(){

  }
  public function editRace(){

  }
  public function addSwimmerToRace(){

  }
  public function removeSwimmerFromRace(){

  }
  public function addRaceResults(){

  }
  public function getRaceResults(){

  }
  public function updateRaceResults(){

  }
  public function addPractice(){

  }
  public function updatePractice(){

  }
  public function addSwimmerToPractice(){

  }
  public function removeSwimmerFromPractice(){

  }
  public function addPracticeResults(){

  }
  public function getPracticeResults(){

  }
  public function updatePracticeResults(){

  }
}

<?php
class Swim extends Database {
  private $db;

  public function __construct(){
    $this->db = new Database;
  }
  public function addLocation($name,$address,$phone = NULL){
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
    $locations = $this->db->fetchResults();
    if (isset($locations)) {
      return $locations;
    } else {
      return false;
    }
  }
  public function addRace($date,$raceName,$locationID){
    $this->db->prepQuery('INSERT INTO race(date,raceName,location) VALUES (:date,:raceName,:location)');
    $this->db->bind(':date',$date);
    $this->db->bind(':raceName',$raceName);
    $this->db->bind(':location',$locationID);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getAllRaces(){
    $this->db->prepQuery('SELECT * FROM race');
    $races = $this->db->fetchResults();
    if (isset($races)) {
      return $races;
    } else {
      return false;
    }
  }
  public function getRace($raceName,$raceDateTime,$locationID){
    $this->db->prepQuery('SELECT * FROM race WHERE raceName = :raceName AND date = :date AND location = :location');
    $this->db->bind(':raceName',$raceName);
    $this->db->bind(':date',$raceDateTime);
    $this->db->bind(':location',$locationID);
    $raceDetails = $this->db->fetchSingleResult();
    if (isset($raceDetails)) {
      return $raceDetails;
    } else {
      return false;
    }
  }
  public function getRaceDetailsByID($raceID){
    $this->db->prepQuery('SELECT * FROM race WHERE raceID = :raceID');
    $this->db->bind(':raceID',$raceID);
    $raceDetails = $this->db->fetchSingleResult();
    if (isset($raceDetails)) {
      return $raceDetails;
    } else {
      return false;
    }

  }
  public function editRace($date,$raceName,$locationID,$raceID){
    $this->db->prepQuery('UPDATE race SET date = :date, raceName = :raceName, location = :location WHERE raceID = :raceID ');
    $this->db->bind(':date',$date);
    $this->db->bind(':raceName',$raceName);
    $this->db->bind(':location',$locationID);
    $this->db->bind(':raceID',$raceID);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getAllSwimmers(){
    $this->db->prepQuery('SELECT * FROM users');
    $swimmers = $this->db->fetchResults();
    if (isset($swimmers)) {
      return $swimmers;
    } else {
      return false;
    }
  }
  public function addSwimmerToRace($swimmerID,$raceID){
    $this->db->prepQuery('INSERT INTO swimmersOnRace(swimID,raceID) VALUES(:swimID, :raceID)');
    $this->db->bind(':swimID',$swimmerID);
    $this->db->bind(':raceID',$raceID);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function removeSwimmerFromRace(){

  }
  //This function can be used to add and update race results
  public function addRaceResults($raceID,$swimmerID,$lap1 = NULL, $lap2 = NULL, $lap3= NULL, $lap4= NULL, $lap5= NULL, $lap6= NULL, $lap7 = NULL, $lap8 = NULL, $lap9= NULL, $lap10= NULL){
    $this->db->prepQuery('UPDATE swimmersOnRace SET lap1 =:lap1,lap2 = :lap2, lap3=:lap3, lap4 =:lap4, lap5 = :lap5, lap6=:lap6, lap7 = :lap7, lap8 = :lap8, lap9 = :lap9, lap10 = :lap10 WHERE swimID = :swimID AND raceID = :raceID');
    $this->db->bind(':raceID',$raceID);
    $this->db->bind(':swimID',$swimmerID);
    $this->db->bind(':lap1',$lap1);
    $this->db->bind(':lap2',$lap2);
    $this->db->bind(':lap3',$lap3);
    $this->db->bind(':lap4',$lap4);
    $this->db->bind(':lap5',$lap5);
    $this->db->bind(':lap6',$lap6);
    $this->db->bind(':lap7',$lap7);
    $this->db->bind(':lap8',$lap8);
    $this->db->bind(':lap9',$lap9);
    $this->db->bind(':lap10',$lap10);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getRaceResults($raceID){
    $this->db->prepQuery('SELECT * FROM race INNER JOIN swimmersOnRace INNER JOIN users INNER JOIN raceLocations WHERE race.raceID = :raceID AND race.raceID=swimmersOnRace.raceID AND swimmersOnRace.swimID = users.uid AND race.location = raceLocations.locID');
    $this->db->bind(':raceID',$raceID);
    $result = $this->db->fetchResults();
    if (isset($result)) {
      return $result;
    }else {
      return false;
    }
  }
  public function addPractice($date,$locationID){
    $this->db->prepQuery('INSERT INTO practice(date,location) VALUES (:date,:location)');
      $this->db->bind(':date',$date);
      $this->db->bind(':location',$locationID);
      if ($this->db->execute()) {
        return true;
      } else {
        return false;
      }
    }
  public function getPracticeByDate($date){
    $this->db->prepQuery('SELECT * FROM practice WHERE date = :date');
    $this->db->bind(':date',$date);
    $result = $this->db->fetchSingleResult();
    if (isset($result)) {
      return $result;
    } else {
      return false;
    }
  }
  public function addSwimmerToPractice($swimmerID,$practiceID){
    $this->db->prepQuery('INSERT INTO swimmersOnPractice(swimmerID,practiceID) VALUES(:swimID, :practiceID)');
    $this->db->bind(':swimID',$swimmerID);
    $this->db->bind(':raceID',$raceID);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function removeSwimmerFromPractice(){

  }
  public function addPracticeResults($practiceID,$swimmerID,$lap1 = NULL, $lap2 = NULL, $lap3= NULL, $lap4= NULL, $lap5= NULL, $lap6= NULL, $lap7 = NULL, $lap8 = NULL, $lap9= NULL, $lap10= NULL){
    $this->db->prepQuery('UPDATE swimmersOnPractice SET lap1 =:lap1,lap2 = :lap2, lap3=:lap3, lap4 =:lap4, lap5 = :lap5, lap6=:lap6, lap7 = :lap7, lap8 = :lap8, lap9 = :lap9, lap10 = :lap10 WHERE swimmerID = :swimID AND practiceID = :practiceID');
    $this->db->bind(':practiceID',$practiceID);
    $this->db->bind(':swimID',$swimmerID);
    $this->db->bind(':lap1',$lap1);
    $this->db->bind(':lap2',$lap2);
    $this->db->bind(':lap3',$lap3);
    $this->db->bind(':lap4',$lap4);
    $this->db->bind(':lap5',$lap5);
    $this->db->bind(':lap6',$lap6);
    $this->db->bind(':lap7',$lap7);
    $this->db->bind(':lap8',$lap8);
    $this->db->bind(':lap9',$lap9);
    $this->db->bind(':lap10',$lap10);
    if ($this->db->execute()) {
      return true;
    } else {
      return false;
    }
  }
  public function getUsersOnRace($userID,$raceID){
    //$this->db->prepQuery('')
  }
  public function getUserPracticeResults(){

  }
  public function getUserRaceResults($swimmerID){

    //still being written
    $this->db->prepQuery('
    SELECT `users`.*, `swimmersOnPractice`.*
    FROM `users`
	   INNER JOIN `swimmersOnPractice` ON `swimmersOnPractice`.`swimmerID` = `users`.`uid`;
    ');
  }
  public function getAllPractices(){

  }
  public function getAllPracticeResults($date){
    $this->db->prepQuery('SELECT * FROM practice INNER JOIN swimmersOnPractice INNER JOIN users INNER JOIN raceLocations WHERE practice.date = :date AND practice.praID=swimmersOnPractice.practiceID AND swimmersOnPractice.swimmerID = users.uid AND practice.location = raceLocations.locID');
    $this->db->bind(':date',$date);
    $result = $this->db->fetchResults();
    if (isset($result)) {
      return $result;
    }else {
      return false;
    }
  }
  public function updatePracticeResults(){

  }
}

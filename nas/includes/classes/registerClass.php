<?php

require_once "connection.php";

class register extends connection{

  var $username;
  var $name;
  var $email;
  var $hashedPass;
  var $path;

  public function signUp(){
    $stmt = $this->DBH->prepare("INSERT INTO account (username, password, email, name, photoPath)  values ('$this->username','$this->hashedPass','$this->email','$this->name','$this->path')");
    // Send Date to DataBase
    try{
      $stmt->execute();

      session_start();
      $_SESSION['username'] = $username;
      header ('Location: home.php'); // Redirect To Home after Register
      exit();
    }catch(PDOException $e){
      echo "Erro: ".$e;
    }

  }

}


 ?>

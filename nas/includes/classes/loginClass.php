<?php

  require_once "connection.php";

  class loginClass extends connection
  {

    var $username;
    var $password;
    var $count;

    public function login(){

      // Search with prepare for more security
      $stmt = $this->DBH->prepare("SELECT username, password FROM account WHERE username = ? AND password = ? ");
      $stmt ->execute(array($this->username,$this->password));

      // Number of elements found
      $this->count = $stmt->rowCount();

      if($this->count>0){
        session_start();
        $_SESSION['username'] = $this->username; // Register SESSION Name

        header('Location: home.php'); // Redirect to home
        exit();
      }

    }
    
  }

?>

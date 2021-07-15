<?php
    include 'config.php';
    include 'saloon_class.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $saloon = new saloon(Null);
      $saloon->setname($_POST["Name"]);
      $saloon->setphoneno($_POST["PhoneNum"]);
      $saloon->setloc($_POST["Location"]);
      session_start();
      $saloon->setagent_id( $_SESSION["uname"]);

      $saloon->addintodb();

      $_SESSION["saloon"]=$saloon->getID();

      header("Location: employee_signup.html");
      exit();

    }
?>
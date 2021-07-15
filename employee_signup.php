<?php
    include 'config.php';
    include_once 'saloon_class.php';
    include_once 'user_class.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      session_start();
      $user = new employee($_POST["username"]);
      $user->setpw($_POST["password"]);
      $user->setname($_POST["Name"]);
      $user->setphoneno($_POST["PhoneNum"]);
      $user->set_salary($_POST["salary"]);
      echo$_SESSION["saloon"];
      $saloon = new saloon($_SESSION["saloon"]);
      $user->set_saloon($saloon);
      $user->addintodb();
      $user->add_into_table();
      
      header("Location: login_page.html");
      exit();

    }
?>
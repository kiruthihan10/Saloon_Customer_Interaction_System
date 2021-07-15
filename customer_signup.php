<?php
    include 'config.php';
    include 'data_preprocessing.php';
    include_once 'user_class.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

      $user = new customer($_POST["username"]);
      $user->setpw($_POST["password"]);
      $user->setname($_POST["Name"]);
      $user->setphoneno($_POST["PhoneNum"]);
      $user->set_email($_POST["email"]);
      $user->addintodb();
      $user->add_into_table();

      
      header("Location: login_page.html");
      exit();

    }
?>
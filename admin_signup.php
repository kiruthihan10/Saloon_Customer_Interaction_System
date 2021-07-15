<?php
    include 'user_class.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      
      $user = new admin($_POST["username"]);
      $user->setpw($_POST["password"]);
      $user->setname($_POST["Name"]);
      $user->setphoneno($_POST["PhoneNum"]);
      $user->set_email($_POST["email"]);
      //$user->addintodb();
      $user->add_into_table();

      header("Location: login_page.html");
      exit();
    }
?>
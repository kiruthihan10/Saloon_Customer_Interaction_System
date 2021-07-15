<?php
    include_once "user_class.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      session_start();
      $user = new admin($_SESSION["uname"]);
      if ($user->is_admin()==False)
      {
        $user = new customer($_SESSION["uname"]);
        if ($user->is_customer()==False)
        {
          $user = new employee($_SESSION["uname"]);
        }
      }
      $user->setpw($_POST["password"]);
      $user->setname($_POST["Name"]);
      $user->setphoneno($_POST["PhoneNum"]);
      $user->updateintodb();
    
      header("Location: login_page.html");
      exit();

    }
?>
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
      $creater =  new employee($_SESSION["uname"]);
      $saloon = $creater->get_saloon();
      $user->set_saloon($saloon);
      $user->addintodb();
      $user->add_into_table();
      
      $uname = $_SESSION["uname"];
      $user = new employee($uname);
      if ($user->is_employee()){
         header("Location: employee_interface.html");
         exit();
      }
      else {
        header("Location: admin_menu.html");
        exit();
      }

      header("Location: login_page.html");
      exit();

    }
?>
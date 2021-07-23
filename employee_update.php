<?php
    include 'user_class.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      session_start();

      $user =new employee($_POST["username"]);
      $user->getfromdb();
      $user->get_from_table();
      $user->setpw($_POST["password"]);
      $user->set_salary($_POST["salary"]);
      $saloon = new saloon($_SESSION["saloon"]);
      $user->set_saloon($saloon);
      $user->updateintodb();
      $user->update_table();
      
      header("Location: admin_menu.html");
      exit();

    }
?>
<?php
    include "user_class.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
      $uname = $_POST["username"];
      $user = new customer($uname);
      
      $user->setpw($_POST["password"]);
      if ($user->check_login())
      {
        if($user->is_customer())
        {
          session_start();
          $_SESSION["uname"] = $uname;
          $_SESSION["user_class"]="customer";
          header("Location: customer_menu.html");
          exit();
        }
        else
        {
          $user = new employee($uname);
          if($user->is_employee())
          {
            session_start();
            $_SESSION["uname"] = $uname;
            $_SESSION["user_class"]="employee";
            header("Location: Employee_interface.html");
            exit();
          }
          else
          {
            $user = new admin($uname);
            if($user->is_admin())
            {
              session_start();
              $_SESSION["uname"] = $uname;
              $_SESSION["user_class"]="system_admins";
              header("Location: admin_menu.html");
              exit();
            }
            else
            {
              echo '<script>alert("Wrong User Name or Password")</script>';
              header("Location: login_page.html");
              exit();              
            }            
          }
        }
      }
      echo '<script>alert("Wrong User Name or Password")</script>';
      header("Location: login_page.html");
      exit();   
    }
    echo '<script>alert("Wrong User Name or Password")</script>';
    header("Location: login_page.html");
    exit();      
?>
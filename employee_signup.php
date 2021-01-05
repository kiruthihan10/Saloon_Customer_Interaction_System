<?php
    include 'config.php';
    include 'data_preprocessing.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $uname = text_preprocessing(strtolower($_POST["username"]));
      $pw = $_POST["password"];
      $pw = password_hash($pw,PASSWORD_DEFAULT);
      $name = text_preprocessing($_POST["Name"]);
      $phoneno = text_preprocessing($_POST["PhoneNum"]);
      $salary = $_POST["salary"];
      session_start();
      $saloon = text_preprocessing($_SESSION["saloon"]);
      $sql = "INSERT INTO Users (User_ID,Pword,Name,Phone_Number) VALUES ('$uname','$pw','$name','$phoneno')";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        echo "<br>";
      }
      
      $sql = "INSERT INTO employee (User_ID,Salary,Saloon_ID) VALUES ('$uname','$salary','$saloon')";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
      $conn->close();
      header("Location: login_page.html");
      exit();

    }
?>
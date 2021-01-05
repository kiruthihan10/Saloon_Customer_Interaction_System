<?php
    include 'config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $name = $_POST["Name"];
      $phoneno = $_POST["PhoneNum"];
      $loc = $_POST["Location"];

      session_start();
      $agent_id = $_SESSION["uname"];

      $sql = "INSERT INTO saloon (Saloon_Name,Location,Phone_Number,Agent_ID) VALUES ('$name','$loc','$phoneno','$agent_id')";

      if ($conn->query($sql) === TRUE) {
        $saloon = $conn->insert_id;
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }

      $conn->close();

      session_start();

      $_SESSION["saloon"]=$saloon;

      header("Location: employee_signup.html");
      exit();

    }
?>
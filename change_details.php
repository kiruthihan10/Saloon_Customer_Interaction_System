<?php
    include 'config.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $uname = $_POST["username"];
      $pw = $_POST["password"];
      $pw = password_hash($pw,PASSWORD_DEFAULT);
      $name = $_POST["Name"];
      $phoneno = $_POST["PhoneNum"];
      $mail = $_POST["email"];

      $sql = "UPDATE Users (Password,Name,Phone_Number) VALUES ('$pw','$name','$phoneno') WHERE User_ID = '$uname'";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
      $user_class = $_SESSION["user_class"];
      $sql = "UPDATE '$user_class' (email) VALUES ('$mail') WHERE User_ID = '$uname'";

      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
      $conn->close();
      #header("Location: login_page.html");
      #exit();

    }
?>